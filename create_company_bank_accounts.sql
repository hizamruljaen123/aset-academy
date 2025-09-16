-- Create company bank accounts table
CREATE TABLE IF NOT EXISTS `company_bank_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `bank_code` varchar(20) DEFAULT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_holder` varchar(100) NOT NULL DEFAULT 'CV ASET MEDIA CEMERLANG',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Insert sample bank accounts data
INSERT INTO `company_bank_accounts` (`bank_name`, `bank_code`, `account_number`, `account_holder`, `is_active`, `display_order`)
VALUES
('Bank Central Asia (BCA)', 'BCA', '1234567890', 'CV ASET MEDIA CEMERLANG', 1, 1),
('Bank Rakyat Indonesia (BRI)', 'BRI', '0234567890', 'CV ASET MEDIA CEMERLANG', 1, 2),
('Bank Negara Indonesia (BNI)', 'BNI', '3456789012', 'CV ASET MEDIA CEMERLANG', 1, 3),
('Bank Mandiri', 'Mandiri', '7890123456', 'CV ASET MEDIA CEMERLANG', 1, 4),
('CIMB Niaga', 'CIMB', '0145678901', 'CV ASET MEDIA CEMERLANG', 1, 5);

-- Create payments table
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `class_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Transfer','Cash','Other') NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `bank_account_id` int DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL COMMENT 'Path to proof image',
  `status` enum('Pending','Verified','Rejected') NOT NULL DEFAULT 'Pending',
  `enrollment_status` enum('Not Enrolled','Enrolled','Access Revoked') NOT NULL DEFAULT 'Not Enrolled',
  `verified_by` int DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `notes` text,
  `enrollment_notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);