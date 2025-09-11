-- Premium Class Enrollment Management System
-- This system allows admins to control class access after payment verification

-- Create premium class enrollments table
CREATE TABLE IF NOT EXISTS `premium_class_enrollments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `student_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Active','Suspended','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `access_granted_by` int DEFAULT NULL COMMENT 'Admin who granted access',
  `access_granted_at` timestamp NULL DEFAULT NULL,
  `access_expires_at` timestamp NULL DEFAULT NULL COMMENT 'Optional expiration date',
  `progress` int NOT NULL DEFAULT '0' COMMENT 'Progress percentage',
  `completion_date` timestamp NULL DEFAULT NULL,
  `notes` text COMMENT 'Admin notes about enrollment',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`class_id`,`student_id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  KEY `payment_id` (`payment_id`),
  KEY `access_granted_by` (`access_granted_by`),
  CONSTRAINT `premium_enrollments_class_fk` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_enrollments_student_fk` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_enrollments_payment_fk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_enrollments_admin_fk` FOREIGN KEY (`access_granted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Update payments table to include enrollment status
ALTER TABLE `payments` 
ADD COLUMN `enrollment_status` enum('Not Enrolled','Enrolled','Access Revoked') NOT NULL DEFAULT 'Not Enrolled' AFTER `status`,
ADD COLUMN `enrollment_notes` text AFTER `notes`;

-- Create class access logs for audit trail
CREATE TABLE IF NOT EXISTS `class_access_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enrollment_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `action` enum('Grant Access','Revoke Access','Suspend Access','Restore Access','Update Status') NOT NULL,
  `previous_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) NOT NULL,
  `reason` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `access_logs_enrollment_fk` FOREIGN KEY (`enrollment_id`) REFERENCES `premium_class_enrollments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `access_logs_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
