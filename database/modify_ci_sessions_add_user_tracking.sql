-- --------------------------------------------------------
-- Migration: Add User Tracking to CI Sessions
-- Description: Menambahkan kolom untuk tracking user login
-- Created: 2025-10-11
-- --------------------------------------------------------

-- Step 1: Add new columns to ci_sessions table
ALTER TABLE `ci_sessions` 
ADD COLUMN `user_id` INT(11) NULL DEFAULT NULL AFTER `ip_address`,
ADD COLUMN `user_agent` VARCHAR(255) NULL DEFAULT NULL AFTER `user_id`,
ADD COLUMN `login_time` TIMESTAMP NULL DEFAULT NULL AFTER `user_agent`,
ADD COLUMN `last_activity_time` TIMESTAMP NULL DEFAULT NULL AFTER `login_time`,
ADD COLUMN `is_active` TINYINT(1) NOT NULL DEFAULT 1 AFTER `last_activity_time`;

-- Step 2: Add foreign key constraint to users table
ALTER TABLE `ci_sessions`
ADD CONSTRAINT `fk_ci_sessions_user` 
FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) 
ON DELETE CASCADE ON UPDATE CASCADE;

-- Step 3: Add indexes for better performance
ALTER TABLE `ci_sessions`
ADD INDEX `idx_user_id` (`user_id`),
ADD INDEX `idx_is_active` (`is_active`),
ADD INDEX `idx_login_time` (`login_time`);

-- Step 4: Create session_logs table for historical tracking
CREATE TABLE IF NOT EXISTS `session_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `session_id` VARCHAR(128) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `user_agent` VARCHAR(255) NULL DEFAULT NULL,
  `login_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` TIMESTAMP NULL DEFAULT NULL,
  `session_duration` INT(11) NULL DEFAULT NULL COMMENT 'Duration in seconds',
  `logout_type` ENUM('manual', 'timeout', 'admin_force', 'system') NULL DEFAULT NULL,
  `location_data` TEXT NULL DEFAULT NULL COMMENT 'JSON data from IP geolocation',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_session_id` (`session_id`),
  INDEX `idx_user_id` (`user_id`),
  INDEX `idx_login_time` (`login_time`),
  CONSTRAINT `fk_session_logs_user` 
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) 
  ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Step 5: Create view for active sessions with user info
CREATE OR REPLACE VIEW `view_active_sessions` AS
SELECT 
    s.id AS session_id,
    s.user_id,
    s.ip_address,
    s.user_agent,
    s.timestamp,
    s.login_time,
    s.last_activity_time,
    s.is_active,
    u.username,
    u.nama_lengkap,
    u.email,
    u.role,
    u.foto_profil,
    FROM_UNIXTIME(s.timestamp) AS last_activity,
    TIMESTAMPDIFF(MINUTE, s.login_time, NOW()) AS session_duration_minutes,
    CASE 
        WHEN s.timestamp > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 5 MINUTE)) THEN 'Active'
        WHEN s.timestamp > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 MINUTE)) THEN 'Idle'
        ELSE 'Inactive'
    END AS session_status
FROM ci_sessions s
LEFT JOIN users u ON s.user_id = u.id
WHERE s.is_active = 1
ORDER BY s.timestamp DESC;

-- Step 6: Create stored procedure to cleanup old sessions
DELIMITER $$

CREATE PROCEDURE `cleanup_old_sessions`(IN hours_old INT)
BEGIN
    -- Log sessions before deleting
    INSERT INTO session_logs (session_id, user_id, ip_address, user_agent, login_time, logout_time, session_duration, logout_type)
    SELECT 
        id,
        user_id,
        ip_address,
        user_agent,
        login_time,
        NOW() AS logout_time,
        TIMESTAMPDIFF(SECOND, login_time, NOW()) AS session_duration,
        'timeout' AS logout_type
    FROM ci_sessions
    WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL hours_old HOUR))
    AND login_time IS NOT NULL;
    
    -- Delete old sessions
    DELETE FROM ci_sessions 
    WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL hours_old HOUR));
    
    SELECT ROW_COUNT() AS deleted_sessions;
END$$

DELIMITER ;

-- Step 7: Create trigger to log session on delete
DELIMITER $$

CREATE TRIGGER `before_session_delete` 
BEFORE DELETE ON `ci_sessions`
FOR EACH ROW
BEGIN
    IF OLD.user_id IS NOT NULL AND OLD.login_time IS NOT NULL THEN
        INSERT INTO session_logs (session_id, user_id, ip_address, user_agent, login_time, logout_time, session_duration, logout_type)
        VALUES (
            OLD.id,
            OLD.user_id,
            OLD.ip_address,
            OLD.user_agent,
            OLD.login_time,
            NOW(),
            TIMESTAMPDIFF(SECOND, OLD.login_time, NOW()),
            'system'
        );
    END IF;
END$$

DELIMITER ;

-- Note: To rollback these changes, run:
-- DROP TRIGGER IF EXISTS before_session_delete;
-- DROP PROCEDURE IF EXISTS cleanup_old_sessions;
-- DROP VIEW IF EXISTS view_active_sessions;
-- DROP TABLE IF EXISTS session_logs;
-- ALTER TABLE ci_sessions DROP FOREIGN KEY fk_ci_sessions_user;
-- ALTER TABLE ci_sessions DROP COLUMN user_id, DROP COLUMN user_agent, DROP COLUMN login_time, DROP COLUMN last_activity_time, DROP COLUMN is_active;

