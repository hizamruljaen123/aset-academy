-- SQL Update Script for Payment System Enhancement
-- Based on existing data.sql structure
-- Run these commands in your MySQL database

-- 1. Create company_bank_accounts table
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 2. Add new fields to existing payments table
ALTER TABLE `payments`
ADD COLUMN `bank_account_id` int DEFAULT NULL AFTER `account_number`,
ADD COLUMN `payment_description` TEXT AFTER `bank_account_id`,
ADD COLUMN `user_bank_name` varchar(100) DEFAULT NULL AFTER `payment_description`,
ADD COLUMN `user_account_holder` varchar(100) DEFAULT NULL AFTER `user_bank_name`,
ADD COLUMN `invoice_number` varchar(50) DEFAULT NULL AFTER `user_account_holder`,
ADD COLUMN `invoice_generated_at` timestamp NULL DEFAULT NULL AFTER `invoice_number`;

-- 3. Add foreign key constraint for bank_account_id
ALTER TABLE `payments`
ADD CONSTRAINT `fk_payments_bank_account`
FOREIGN KEY (`bank_account_id`) REFERENCES `company_bank_accounts` (`id`) ON DELETE SET NULL;

-- 4. Insert sample bank account data
INSERT INTO `company_bank_accounts` (`bank_name`, `bank_code`, `account_number`, `account_holder`, `is_active`, `display_order`)
VALUES
('Bank Central Asia (BCA)', 'BCA', '1234567890', 'CV ASET MEDIA CEMERLANG', 1, 1),
('Bank Rakyat Indonesia (BRI)', 'BRI', '0234567890', 'CV ASET MEDIA CEMERLANG', 1, 2),
('Bank Negara Indonesia (BNI)', 'BNI', '3456789012', 'CV ASET MEDIA CEMERLANG', 1, 3),
('Bank Mandiri', 'Mandiri', '7890123456', 'CV ASET MEDIA CEMERLANG', 1, 4),
('CIMB Niaga', 'CIMB', '0145678901', 'CV ASET MEDIA CEMERLANG', 1, 5);

-- 5. Optional: Update existing payments to generate invoice numbers for verified payments
-- Uncomment the following lines if you want to generate invoice numbers for existing verified payments

/*
UPDATE `payments`
SET `invoice_number` = CONCAT('INV-', DATE_FORMAT(`created_at`, '%Y%m%d'), '-', LPAD(`user_id`, 4, '0'), '-', LPAD(FLOOR(RAND() * 10000), 4, '0')),
    `invoice_generated_at` = NOW()
WHERE `status` = 'Verified' AND `invoice_number` IS NULL;
*/

-- 6. Verify the changes
-- You can run these queries to check if everything was created correctly:

-- Check company_bank_accounts table
-- SELECT * FROM company_bank_accounts;

-- Check payments table structure
-- DESCRIBE payments;

-- Check existing payments with new fields
-- SELECT id, user_id, class_id, amount, payment_method, bank_name, account_number,
--        bank_account_id, payment_description, user_bank_name, user_account_holder,
--        invoice_number, invoice_generated_at, status, created_at
-- FROM payments LIMIT 5;