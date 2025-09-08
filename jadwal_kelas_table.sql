CREATE TABLE IF NOT EXISTS `jadwal_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas_id` int NOT NULL,
  `class_type` enum('programming','free') NOT NULL DEFAULT 'programming' COMMENT 'Type of class (programming or free)',
  `pertemuan_ke` int NOT NULL COMMENT 'Meeting number (e.g., 1, 2, 3)',
  `judul_pertemuan` varchar(255) NOT NULL,
  `tanggal_pertemuan` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
