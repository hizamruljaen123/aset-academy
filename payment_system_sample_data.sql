-- Sample Data for Payment System Enhancement
-- Run this after creating the tables

-- Insert sample bank account data
INSERT INTO `company_bank_accounts` (`bank_name`, `bank_code`, `account_number`, `account_holder`, `is_active`, `display_order`)
VALUES
('Bank Central Asia (BCA)', 'BCA', '1234567890', 'CV ASET MEDIA CEMERLANG', 1, 1),
('Bank Rakyat Indonesia (BRI)', 'BRI', '0234567890', 'CV ASET MEDIA CEMERLANG', 1, 2),
('Bank Negara Indonesia (BNI)', 'BNI', '3456789012', 'CV ASET MEDIA CEMERLANG', 1, 3),
('Bank Mandiri', 'Mandiri', '7890123456', 'CV ASET MEDIA CEMERLANG', 1, 4),
('CIMB Niaga', 'CIMB', '0145678901', 'CV ASET MEDIA CEMERLANG', 1, 5);

-- Optional: Update existing verified payments to generate invoice numbers
-- Uncomment and modify as needed

/*
-- Generate invoice numbers for existing verified payments
UPDATE `payments`
SET `invoice_number` = CONCAT('INV-', DATE_FORMAT(`created_at`, '%Y%m%d'), '-', LPAD(`user_id`, 4, '0'), '-', LPAD(FLOOR(RAND() * 10000), 4, '0')),
    `invoice_generated_at` = NOW()
WHERE `status` = 'Verified' AND `invoice_number` IS NULL;
*/

-- Verification queries (run these to check if data was inserted correctly)
/*
-- Check bank accounts
SELECT * FROM company_bank_accounts ORDER BY display_order;

-- Check payments table structure
DESCRIBE payments;

-- Check sample payments with new fields
SELECT id, user_id, class_id, amount, payment_method, bank_name, account_number,
       bank_account_id, payment_description, user_bank_name, user_account_holder,
       invoice_number, invoice_generated_at, status, created_at
FROM payments
ORDER BY created_at DESC
LIMIT 10;
*/