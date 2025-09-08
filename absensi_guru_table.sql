CREATE TABLE IF NOT EXISTS `absensi_guru` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jadwal_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL,
  `catatan` text,
  `waktu_absensi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_absensi` (`jadwal_id`,`guru_id`),
  KEY `jadwal_id` (`jadwal_id`),
  KEY `guru_id` (`guru_id`),
  CONSTRAINT `absensi_guru_ibfk_1` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_guru_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
