-- SQL script to improve relationships between attendance, schedule, and class tables.
-- This script assumes the new tables `jadwal_kelas` and `absensi_guru` exist.

SET FOREIGN_KEY_CHECKS=0;

-- Step 1: Add `guru_id` to the `jadwal_kelas` table to assign a teacher to each session.
ALTER TABLE `jadwal_kelas`
ADD COLUMN `guru_id` INT NOT NULL AFTER `class_type`,
ADD CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`guru_id`) REFERENCES `users`(`id`) ON DELETE CASCADE;

-- Step 2: Overhaul the `absensi` table to link directly to a schedule.
-- First, drop the old foreign key constraints if they exist.
-- (Assuming the old constraints were named absensi_ibfk_1, absensi_ibfk_2, absensi_ibfk_3)
-- ALTER TABLE `absensi` DROP FOREIGN KEY `absensi_ibfk_1`;
-- ALTER TABLE `absensi` DROP FOREIGN KEY `absensi_ibfk_2`;
-- ALTER TABLE `absensi` DROP FOREIGN KEY `absensi_ibfk_3`;

-- Rename the old table for backup purposes.
RENAME TABLE `absensi` TO `absensi_old`;

-- Create the new, improved `absensi` table.
CREATE TABLE `absensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jadwal_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_absensi_siswa` (`jadwal_id`,`siswa_id`),
  CONSTRAINT `fk_absensi_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_absensi_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Step 3: Verify the `absensi_guru` table structure (it should already be correct).
-- The existing `absensi_guru` table is already linked to `jadwal_kelas` and is well-structured.
-- No changes are needed for it.

SET FOREIGN_KEY_CHECKS=1;

-- Note: After running this script, you will need to update the application code
-- (controllers, models, and views) to work with this new, more robust structure.
-- The `absensi_old` table can be dropped later after migrating any necessary data.
