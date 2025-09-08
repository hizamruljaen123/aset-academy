-- Update users table to add guru role
ALTER TABLE `users` MODIFY COLUMN `role` enum('admin','user','guru') NOT NULL DEFAULT 'user';

-- Create table for teacher-class assignments
CREATE TABLE IF NOT EXISTS `guru_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guru_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `assigned_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `guru_id` (`guru_id`),
  KEY `kelas_id` (`kelas_id`),
  CONSTRAINT `guru_kelas_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert sample guru user
INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `role`, `status`) VALUES
('guru1', MD5('password123'), 'Budi Santoso', 'budi.guru@academy.com', 'guru', 'Aktif');

-- Get the inserted guru ID and assign to first class (if exists)
SET @guru_id = LAST_INSERT_ID();
INSERT INTO `guru_kelas` (`guru_id`, `kelas_id`) 
SELECT @guru_id, `id` FROM `kelas_programming` LIMIT 1;
