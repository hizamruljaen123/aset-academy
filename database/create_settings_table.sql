-- Create settings table for storing system settings like maintenance mode
CREATE TABLE IF NOT EXISTS `settings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `setting_key` varchar(100) NOT NULL UNIQUE,
    `setting_value` text,
    `setting_type` enum('string','boolean','integer','json') DEFAULT 'string',
    `description` text,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default maintenance mode setting
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`, `description`) VALUES
('maintenance_mode', 'false', 'boolean', 'Enable/disable maintenance mode for the website'),
('maintenance_message', 'Website sedang dalam pemeliharaan. Kami akan segera kembali melayani Anda.', 'string', 'Message to display during maintenance mode');

-- Add index for better performance
ALTER TABLE `settings` ADD INDEX `idx_setting_key` (`setting_key`);
