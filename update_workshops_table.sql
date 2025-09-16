-- Update workshops table structure to ensure compatibility with enhanced poster upload system
-- Run this SQL script to update your existing workshops table

-- First, check if the table exists and has the correct structure
DESCRIBE workshops;

-- Add any missing columns or modify existing ones if needed
-- Note: The thumbnail field already exists in your current structure

-- Ensure the thumbnail field allows NULL values for optional posters
ALTER TABLE `workshops`
	MODIFY COLUMN `thumbnail` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_general_ci' AFTER `max_participants`;

-- Add additional useful fields for enhanced workshop management (optional)
-- Uncomment the following lines if you want to add these fields:

-- Add poster_alt_text for accessibility
-- ALTER TABLE `workshops` ADD COLUMN `poster_alt_text` VARCHAR(255) NULL DEFAULT NULL AFTER `thumbnail`;

-- Add poster_upload_date to track when poster was uploaded
-- ALTER TABLE `workshops` ADD COLUMN `poster_upload_date` TIMESTAMP NULL DEFAULT NULL AFTER `thumbnail`;

-- Add poster_file_size to track file size
-- ALTER TABLE `workshops` ADD COLUMN `poster_file_size` INT(11) NULL DEFAULT NULL AFTER `thumbnail`;

-- Ensure proper indexes for performance
-- Add index on status for faster filtering
ALTER TABLE `workshops` ADD INDEX `idx_status` (`status`);

-- Add index on type for faster filtering
ALTER TABLE `workshops` ADD INDEX `idx_type` (`type`);

-- Add index on created_at for sorting
ALTER TABLE `workshops` ADD INDEX `idx_created_at` (`created_at`);

-- Add composite index for common queries
ALTER TABLE `workshops` ADD INDEX `idx_status_type` (`status`, `type`);

-- Verify the final table structure
DESCRIBE workshops;

-- Optional: Update existing records to ensure data consistency
-- Uncomment if you want to run data cleanup:

-- UPDATE workshops SET thumbnail = NULL WHERE thumbnail = '';
-- UPDATE workshops SET updated_at = CURRENT_TIMESTAMP WHERE updated_at IS NULL;

-- Create the uploads directory if it doesn't exist (run this on your server)
-- mkdir -p uploads/workshops
-- chmod 755 uploads/workshops

-- Sample data for testing (optional)
-- INSERT INTO workshops (title, slug, description, type, price, start_datetime, end_datetime, location, max_participants, status)
-- VALUES
-- ('Workshop PHP Modern', 'workshop-php-modern', 'Belajar PHP dengan teknik modern', 'workshop', 150000.00, '2025-10-01 09:00:00', '2025-10-01 17:00:00', 'Online', 50, 'published'),
-- ('Seminar Web Development', 'seminar-web-development', 'Seminar pengembangan web terkini', 'seminar', 0.00, '2025-10-05 13:00:00', '2025-10-05 16:00:00', 'Jakarta', 100, 'published');