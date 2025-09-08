CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `siswa_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `tanggal_absensi` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `siswa_id` (`siswa_id`),
  KEY `kelas_id` (`kelas_id`),
  KEY `guru_id` (`guru_id`),
  CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
