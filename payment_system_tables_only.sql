-- Payment System Tables Only - Based on existing data.sql structure
-- This script creates the necessary tables and adds fields to existing payments table

-- Create company_bank_accounts table
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

-- Add new columns to existing payments table
ALTER TABLE `payments`
ADD COLUMN `bank_account_id` int DEFAULT NULL AFTER `account_number`,
ADD COLUMN `payment_description` TEXT AFTER `bank_account_id`,
ADD COLUMN `user_bank_name` varchar(100) DEFAULT NULL AFTER `payment_description`,
ADD COLUMN `user_account_holder` varchar(100) DEFAULT NULL AFTER `user_bank_name`,
ADD COLUMN `invoice_number` varchar(50) DEFAULT NULL AFTER `user_account_holder`,
ADD COLUMN `invoice_generated_at` timestamp NULL DEFAULT NULL AFTER `invoice_number`;

-- Add foreign key constraint
ALTER TABLE `payments`
ADD CONSTRAINT `fk_payments_bank_account`
FOREIGN KEY (`bank_account_id`) REFERENCES `company_bank_accounts` (`id`) ON DELETE SET NULL;