-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table academy_lite.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jadwal_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_absensi_siswa` (`jadwal_id`,`siswa_id`),
  KEY `fk_absensi_siswa` (`siswa_id`),
  CONSTRAINT `fk_absensi_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_absensi_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.absensi: ~22 rows (approximately)

-- Dumping structure for table academy_lite.absensi_guru
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

-- Dumping data for table academy_lite.absensi_guru: ~0 rows (approximately)

-- Dumping structure for table academy_lite.absensi_old
CREATE TABLE IF NOT EXISTS `absensi_old` (
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
  CONSTRAINT `absensi_old_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_old_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_old_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.absensi_old: ~21 rows (approximately)
INSERT INTO `absensi_old` (`id`, `siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
	(22, 1, 1, 3, '2025-09-01', 'Hadir', 'Tepat waktu', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(23, 2, 1, 3, '2025-09-01', 'Hadir', 'Aktif di kelas', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(24, 3, 1, 3, '2025-09-01', 'Sakit', 'Surat dokter menyusul', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(25, 4, 2, 3, '2025-09-01', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(26, 5, 2, 3, '2025-09-01', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(27, 7, 3, 4, '2025-09-01', 'Izin', 'Acara keluarga', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(28, 8, 3, 4, '2025-09-01', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(29, 1, 1, 3, '2025-09-02', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(30, 2, 1, 3, '2025-09-02', 'Alpa', 'Tanpa keterangan', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(31, 3, 1, 3, '2025-09-02', 'Sakit', 'Masih dalam pemulihan', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(32, 4, 2, 3, '2025-09-02', 'Hadir', 'Sangat baik', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(33, 5, 2, 3, '2025-09-02', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(34, 7, 3, 4, '2025-09-02', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(35, 8, 3, 4, '2025-09-02', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(36, 1, 1, 3, '2025-09-03', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(37, 2, 1, 3, '2025-09-03', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(38, 3, 1, 3, '2025-09-03', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(39, 4, 2, 3, '2025-09-03', 'Izin', 'Mengurus dokumen', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(40, 5, 2, 3, '2025-09-03', 'Hadir', '', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(41, 7, 3, 4, '2025-09-03', 'Alpa', 'Tidak ada kabar', '2025-09-08 20:48:30', '2025-09-08 20:48:30'),
	(42, 8, 3, 4, '2025-09-03', 'Hadir', 'Partisipasi baik', '2025-09-08 20:48:30', '2025-09-08 20:48:30');

-- Dumping structure for table academy_lite.free_classes
CREATE TABLE IF NOT EXISTS `free_classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `level` enum('Dasar','Menengah','Lanjutan') NOT NULL DEFAULT 'Dasar',
  `category` varchar(100) NOT NULL,
  `duration` int NOT NULL DEFAULT '1' COMMENT 'Duration in hours',
  `mentor_id` int DEFAULT NULL,
  `max_students` int DEFAULT NULL COMMENT 'Maximum number of students allowed',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Draft','Published','Archived') NOT NULL DEFAULT 'Draft',
  `online_meet_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mentor_id` (`mentor_id`),
  CONSTRAINT `free_classes_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_classes: ~4 rows (approximately)
INSERT INTO `free_classes` (`id`, `title`, `description`, `thumbnail`, `level`, `category`, `duration`, `mentor_id`, `max_students`, `start_date`, `end_date`, `status`, `online_meet_link`, `created_at`, `updated_at`) VALUES
	(1, 'Pengenalan Git & GitHub', 'Pelajari dasar-dasar version control dengan Git dan cara berkolaborasi di GitHub.', NULL, 'Dasar', 'Tools', 2, 3, NULL, NULL, NULL, 'Published', 'https://meet.google.com/git-123-xyz', '2025-09-08 06:06:48', '2025-09-08 06:19:56'),
	(2, 'Tips Produktivitas untuk Developer', 'Tingkatkan produktivitas Anda sebagai developer dengan tools dan teknik modern.', NULL, 'Menengah', 'Soft Skills', 1, 4, NULL, NULL, NULL, 'Published', 'https://meet.google.com/prod-456-abc', '2025-09-08 06:06:48', '2025-09-08 06:19:56'),
	(3, 'Dasar-dasar Desain UI/UX', 'Pengenalan prinsip desain antarmuka dan pengalaman pengguna untuk pemula.', NULL, 'Dasar', 'Design', 3, 5, NULL, NULL, NULL, 'Draft', 'https://zoom.us/j/987654321', '2025-09-08 06:06:48', '2025-09-08 06:19:56'),
	(4, 'Keamanan Jaringan 101', 'Pengenalan konsep dasar keamanan jaringan untuk pemula.', NULL, 'Dasar', 'Networking', 2, 7, NULL, NULL, NULL, 'Published', 'https://meet.google.com/security-789-klm', '2025-09-08 06:06:48', '2025-09-08 06:19:56');

-- Dumping structure for table academy_lite.free_class_discussions
CREATE TABLE IF NOT EXISTS `free_class_discussions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `free_class_discussions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_discussions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_discussions_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `free_class_discussions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_discussions: ~4 rows (approximately)
INSERT INTO `free_class_discussions` (`id`, `class_id`, `user_id`, `parent_id`, `message`, `created_at`, `updated_at`) VALUES
	(1, 1, 9, NULL, 'Halo, saya kesulitan saat instalasi Git di Windows 11. Apakah ada yang bisa membantu?', '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(2, 1, 3, 1, 'Tentu, Ahmad. Coba pastikan Anda mencentang opsi "Add to PATH" saat proses instalasi. Itu biasanya menyelesaikan masalah.', '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(3, 1, 9, 2, 'Terima kasih, Pak Budi! Sekarang sudah berhasil. Mantap.', '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(4, 2, 11, NULL, 'Teknik Pomodoro ini sangat membantu, terima kasih materinya!', '2025-09-08 06:06:48', '2025-09-08 06:06:48');

-- Dumping structure for table academy_lite.free_class_enrollments
CREATE TABLE IF NOT EXISTS `free_class_enrollments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `student_id` int NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Enrolled','Completed','Dropped') NOT NULL DEFAULT 'Enrolled',
  `progress` int NOT NULL DEFAULT '0' COMMENT 'Progress percentage',
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`class_id`,`student_id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `free_class_enrollments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_enrollments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_enrollments: ~8 rows (approximately)
INSERT INTO `free_class_enrollments` (`id`, `class_id`, `student_id`, `enrollment_date`, `status`, `progress`, `completion_date`, `created_at`, `updated_at`) VALUES
	(1, 1, 9, '2025-09-08 06:06:48', 'Completed', 100, '2025-09-08 13:01:23', '2025-09-08 06:06:48', '2025-09-08 20:01:23'),
	(2, 1, 10, '2025-09-08 06:06:48', 'Completed', 100, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(3, 2, 9, '2025-09-08 06:06:48', 'Enrolled', 25, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(4, 2, 11, '2025-09-08 06:06:48', 'Enrolled', 0, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(5, 1, 12, '2025-09-08 06:06:48', 'Enrolled', 75, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(6, 4, 13, '2025-09-08 06:06:48', 'Enrolled', 10, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(7, 4, 15, '2025-09-08 06:06:48', 'Completed', 100, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(8, 2, 16, '2025-09-08 06:06:48', 'Dropped', 40, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(9, 1, 5, '2025-09-08 06:07:20', 'Enrolled', 0, NULL, '2025-09-08 06:07:20', '2025-09-08 06:07:20');

-- Dumping structure for table academy_lite.free_class_materials
CREATE TABLE IF NOT EXISTS `free_class_materials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `content_type` enum('text','video','pdf','link') NOT NULL DEFAULT 'text',
  `content` text NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `free_class_materials_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_materials: ~4 rows (approximately)
INSERT INTO `free_class_materials` (`id`, `class_id`, `title`, `description`, `content_type`, `content`, `order`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Instalasi Git', 'Panduan langkah demi langkah untuk menginstal Git di berbagai sistem operasi.', 'text', 'Silakan unduh Git dari situs resminya dan ikuti petunjuk instalasi untuk Windows, macOS, atau Linux.', 1, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(2, 1, 'Perintah Dasar Git', 'Mempelajari perintah dasar seperti git init, git add, git commit, dan git push.', 'video', 'https://www.youtube.com/watch?v=example_git_basics', 2, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(3, 2, 'Manajemen Waktu dengan Pomodoro', 'Teknik Pomodoro untuk fokus dan manajemen waktu yang lebih baik.', 'pdf', 'pomodoro_technique.pdf', 1, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(4, 4, 'Apa itu IP Address?', 'Memahami konsep dasar alamat IP dan Subnetting.', 'text', 'IP Address adalah label numerik yang ditetapkan untuk setiap perangkat yang terhubung ke jaringan komputer.', 1, '2025-09-08 06:06:48', '2025-09-08 06:06:48');

-- Dumping structure for table academy_lite.free_class_progress
CREATE TABLE IF NOT EXISTS `free_class_progress` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enrollment_id` int NOT NULL,
  `material_id` int NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` timestamp NULL DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_progress` (`enrollment_id`,`material_id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `material_id` (`material_id`),
  CONSTRAINT `free_class_progress_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `free_class_enrollments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_progress_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `free_class_materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_progress: ~7 rows (approximately)
INSERT INTO `free_class_progress` (`id`, `enrollment_id`, `material_id`, `status`, `last_accessed`, `completion_date`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Completed', NULL, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(2, 1, 2, 'Completed', '2025-09-08 13:01:23', '2025-09-08 13:01:23', '2025-09-08 06:06:48', '2025-09-08 20:01:23'),
	(3, 2, 1, 'Completed', NULL, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(4, 2, 2, 'Completed', NULL, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(5, 3, 3, 'In Progress', NULL, NULL, '2025-09-08 06:06:48', '2025-09-08 06:06:48'),
	(6, 9, 1, 'In Progress', '2025-09-07 23:08:56', NULL, '2025-09-08 06:07:20', '2025-09-08 06:08:56'),
	(7, 9, 2, 'In Progress', '2025-09-07 23:08:59', NULL, '2025-09-08 06:07:20', '2025-09-08 06:08:59');

-- Dumping structure for table academy_lite.guru_kelas
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.guru_kelas: ~7 rows (approximately)
INSERT INTO `guru_kelas` (`id`, `guru_id`, `kelas_id`, `assigned_at`, `status`) VALUES
	(1, 3, 1, '2025-09-08 06:03:43', 'Aktif'),
	(2, 3, 2, '2025-09-08 06:03:43', 'Aktif'),
	(3, 4, 3, '2025-09-08 06:03:43', 'Aktif'),
	(4, 5, 7, '2025-09-08 06:03:43', 'Aktif'),
	(5, 6, 5, '2025-09-08 06:03:43', 'Aktif'),
	(6, 7, 4, '2025-09-08 06:03:43', 'Tidak Aktif'),
	(7, 8, 6, '2025-09-08 06:03:43', 'Aktif'),
	(8, 3, 6, '2025-09-08 06:35:28', 'Aktif');

-- Dumping structure for table academy_lite.jadwal_kelas
CREATE TABLE IF NOT EXISTS `jadwal_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas_id` int NOT NULL,
  `pertemuan_ke` int NOT NULL COMMENT 'Meeting number (e.g., 1, 2, 3)',
  `class_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `guru_id` int DEFAULT NULL,
  `judul_pertemuan` varchar(255) NOT NULL,
  `tanggal_pertemuan` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
  KEY `fk_jadwal_guru` (`guru_id`),
  CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `jadwal_kelas_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.jadwal_kelas: ~0 rows (approximately)
INSERT INTO `jadwal_kelas` (`id`, `kelas_id`, `pertemuan_ke`, `class_type`, `guru_id`, `judul_pertemuan`, `tanggal_pertemuan`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'programming', NULL, 'Introduction to HTML', '2025-09-01', '08:00:00', '10:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(2, 1, 2, 'programming', NULL, 'Styling with CSS', '2025-09-03', '08:00:00', '10:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(3, 1, 3, 'programming', NULL, 'JavaScript Fundamentals', '2025-09-05', '08:00:00', '10:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(4, 2, 1, 'programming', NULL, 'PHP Basics', '2025-09-02', '10:00:00', '12:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(5, 2, 2, 'programming', NULL, 'Connecting to MySQL', '2025-09-04', '10:00:00', '12:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(6, 3, 1, 'programming', NULL, 'React Components', '2025-09-01', '13:00:00', '15:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(7, 3, 2, 'programming', NULL, 'State and Props', '2025-09-03', '13:00:00', '15:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(8, 1, 1, 'free', NULL, 'Python Basics', '2025-09-08', '15:00:00', '16:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31'),
	(9, 1, 2, 'free', NULL, 'Data Structures in Python', '2025-09-10', '15:00:00', '16:00:00', '2025-09-08 21:32:31', '2025-09-08 21:32:31');

-- Dumping structure for table academy_lite.kelas_programming
CREATE TABLE IF NOT EXISTS `kelas_programming` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `deskripsi` text,
  `level` enum('Dasar','Menengah','Lanjutan') NOT NULL,
  `bahasa_program` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `durasi` int NOT NULL DEFAULT '1' COMMENT 'Durasi dalam jam',
  `harga` decimal(10,2) NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `online_meet_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_kelas` (`nama_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.kelas_programming: ~7 rows (approximately)
INSERT INTO `kelas_programming` (`id`, `nama_kelas`, `deskripsi`, `level`, `bahasa_program`, `durasi`, `harga`, `gambar`, `status`, `online_meet_link`, `created_at`, `updated_at`) VALUES
	(1, 'Dasar Pemrograman Web', 'Pelajari fondasi web development dengan HTML, CSS, dan JavaScript.', 'Dasar', 'HTML, CSS, JS', 40, 500000.00, NULL, 'Aktif', 'https://meet.google.com/abc-xyz-pqr', '2025-09-08 06:03:43', '2025-09-08 06:16:19'),
	(2, 'Backend Development dengan PHP', 'Kuasai backend development menggunakan PHP dan MySQL untuk membangun aplikasi web dinamis.', 'Menengah', 'PHP, MySQL', 60, 750000.00, NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(3, 'Frontend Modern dengan React', 'Bangun antarmuka pengguna yang interaktif dan responsif dengan React.', 'Lanjutan', 'React, JS', 50, 650000.00, NULL, 'Aktif', 'https://zoom.us/j/123456789', '2025-09-08 06:03:43', '2025-09-08 06:16:19'),
	(4, 'Advanced JavaScript', 'Topik lanjutan JavaScript termasuk asynchronous, closures, dan design patterns.', 'Lanjutan', 'JavaScript', 45, 800000.00, NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(5, 'Database Design & SQL', 'Pelajari cara merancang skema database yang efisien dan menguasai SQL.', 'Menengah', 'SQL', 55, 700000.00, NULL, 'Tidak Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(6, 'Cloud Fundamentals with AWS', 'Pengenalan layanan cloud computing dari Amazon Web Services.', 'Dasar', 'AWS', 30, 450000.00, NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(7, 'UI/UX Design for Beginners', 'Prinsip dasar desain antarmuka dan pengalaman pengguna.', 'Dasar', 'Figma, Sketch', 35, 400000.00, NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43');

-- Dumping structure for table academy_lite.materi
CREATE TABLE IF NOT EXISTS `materi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas_id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.materi: ~8 rows (approximately)
INSERT INTO `materi` (`id`, `kelas_id`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Pengenalan HTML', 'Dasar-dasar HTML, elemen, dan struktur dokumen.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(2, 1, 'Styling dengan CSS', 'Mempelajari cara menghias halaman web dengan CSS.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(3, 2, 'Dasar-dasar PHP', 'Sintaks dasar, variabel, dan struktur kontrol dalam PHP.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(4, 3, 'Setup Proyek React', 'Menginisialisasi proyek React dan memahami struktur folder.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(5, 4, 'Asynchronous JavaScript', 'Memahami Promises dan Async/Await.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(6, 5, 'Normalisasi Database', 'Konsep normalisasi dari 1NF hingga 3NF.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(7, 6, 'Introduction to AWS S3', 'Dasar penyimpanan objek di cloud dengan AWS S3.', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(8, 7, 'Prinsip-prinsip Desain UI', 'Mempelajari prinsip fundamental dalam desain antarmuka pengguna.', '2025-09-08 06:03:43', '2025-09-08 06:03:43');

-- Dumping structure for table academy_lite.materi_parts
CREATE TABLE IF NOT EXISTS `materi_parts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `materi_id` int NOT NULL,
  `part_order` int NOT NULL,
  `part_type` enum('image','video','pdf','link') NOT NULL,
  `part_title` varchar(255) NOT NULL,
  `part_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `materi_id` (`materi_id`),
  CONSTRAINT `materi_parts_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.materi_parts: ~8 rows (approximately)
INSERT INTO `materi_parts` (`id`, `materi_id`, `part_order`, `part_type`, `part_title`, `part_content`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'video', 'Video: Apa itu HTML?', 'https://www.youtube.com/watch?v=example_html', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(2, 1, 2, 'pdf', 'Referensi Tag HTML', 'ref_html.pdf', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(3, 2, 1, 'link', 'Game Interaktif CSS Diner', 'https://flukeout.github.io/', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(4, 3, 1, 'video', 'Video: Variabel di PHP', 'https://www.youtube.com/watch?v=example_php', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(5, 5, 1, 'video', 'Video: Penjelasan Promises', 'https://www.youtube.com/watch?v=example_promise', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(6, 6, 1, 'image', 'Diagram: Bentuk Normal', 'db_normalization.png', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(7, 7, 1, 'pdf', 'Panduan AWS S3', 'aws_s3_guide.pdf', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(8, 8, 1, 'link', 'Contoh Desain UI di Dribbble', 'https://dribbble.com/', '2025-09-08 06:03:43', '2025-09-08 06:03:43');

-- Dumping structure for table academy_lite.materi_progress
CREATE TABLE IF NOT EXISTS `materi_progress` (
  `id` int NOT NULL AUTO_INCREMENT,
  `materi_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` timestamp NULL DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_progress` (`materi_id`,`siswa_id`),
  CONSTRAINT `materi_progress_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.materi_progress: ~0 rows (approximately)

-- Dumping structure for table academy_lite.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` text,
  `foto_profil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `status` enum('Aktif','Tidak Aktif','Lulus') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`),
  KEY `idx_nis` (`nis`),
  KEY `idx_nama` (`nama_lengkap`),
  KEY `idx_kelas` (`kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.siswa: ~10 rows (approximately)
INSERT INTO `siswa` (`id`, `nis`, `nama_lengkap`, `email`, `no_telepon`, `kelas`, `jurusan`, `alamat`, `foto_profil`, `tanggal_lahir`, `jenis_kelamin`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'S001', 'Ahmad Rizki', 'ahmad.siswa@academylite.com', '081234567890', 'XII-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Merdeka 10, Jakarta', NULL, '2005-04-12', 'L', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(2, 'S002', 'Dewi Anggraini', 'dewi.siswa@academylite.com', '081234567891', 'XII-TKJ', 'Teknik Komputer & Jaringan', 'Jl. Pahlawan 22, Bandung', NULL, '2005-08-19', 'P', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(4, 'S004', 'Galih Pratama', 'galih.siswa@academylite.com', '081234567893', 'XI-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Diponegoro 5, Yogyakarta', NULL, '2006-03-20', 'L', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(5, 'S005', 'Hana Yulita', 'hana.siswa@academylite.com', '081234567894', 'X-TKJ', 'Teknik Komputer & Jaringan', 'Jl. Sudirman 88, Medan', NULL, '2007-07-07', 'P', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(6, 'S006', 'Indra Wijaya', 'indra.siswa@academylite.com', '081234567895', 'Dasar Pemrograman Web', 'Rekayasa Perangkat Lunak', 'Jl. Gajah Mada 12, Semarang', NULL, '2007-11-25', 'L', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 20:08:40'),
	(7, 'S007', 'Joko Susilo', 'joko.siswa@academylite.com', '081234567896', 'XII-MM', 'Multimedia', 'Jl. Hayam Wuruk 15, Denpasar', NULL, '2005-02-28', 'L', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(8, 'S008', 'Kartika Sari', 'kartika.siswa@academylite.com', '081234567897', 'XI-TKJ', 'Teknik Komputer & Jaringan', 'Jl. Teuku Umar 45, Makassar', NULL, '2006-06-10', 'P', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(9, 'S009', 'Lutfi Halimawan', 'lutfi.siswa@academylite.com', '081234567898', 'X-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Imam Bonjol 9, Palembang', NULL, '2007-09-01', 'L', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(10, 'S010', 'Maya Indah', 'maya.siswa@academylite.com', '081234567899', 'XII-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Gatot Subroto 101, Jakarta', NULL, '2005-12-12', 'P', 'Aktif', '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(11, 'S999', 'Test Siswa Updated', 'test.siswa@academylite.com', '081234567890', 'Dasar Pemrograman Web', 'Rekayasa Perangkat Lunak', 'Jl. Test Academy No. 123, Jakarta', NULL, '2025-09-24', 'L', 'Aktif', '2025-09-08 19:45:57', '2025-09-08 19:46:39');

-- Dumping structure for table academy_lite.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` tinyint unsigned DEFAULT '5',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.testimonials: ~5 rows (approximately)
INSERT INTO `testimonials` (`id`, `name`, `position`, `photo`, `content`, `rating`, `created_at`) VALUES
	(1, 'Ahmad Rizki', 'Web Developer', NULL, 'Kelas Full-Stack sangat lengkap! Dari dasar sampai advanced, cocok banget buat yang mau jadi web developer profesional.', 5, '2025-09-08 21:55:00'),
	(2, 'Sari Dewi', 'Data Analyst', NULL, 'Materi Data Science sangat terstruktur dan mudah dipahami. Instrukturnya juga sangat helpful dalam menjawab pertanyaan.', 5, '2025-09-08 21:55:00'),
	(3, 'Budi Santoso', 'Mobile Developer', NULL, 'Setelah ikut kelas Flutter, sekarang saya bisa bikin aplikasi mobile sendiri. Terima kasih Aset Academy!', 5, '2025-09-08 21:55:00'),
	(4, 'Rina Wati', 'UI/UX Designer', NULL, 'Belajar desain UI/UX di sini sangat menyenangkan. Materinya up-to-date dan banyak studi kasus nyata.', 4, '2025-09-08 21:55:00'),
	(5, 'Eko Prasetyo', 'Mahasiswa', NULL, 'Sangat membantu untuk tugas kuliah dan persiapan magang. Kelas gratisnya pun daging semua!', 5, '2025-09-08 21:55:00');

-- Dumping structure for table academy_lite.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('super_admin','admin','guru','siswa','user') NOT NULL DEFAULT 'user',
  `level` enum('1','2','3','4','5') NOT NULL DEFAULT '5' COMMENT '1=Super Admin, 2=Admin, 3=Guru, 4=Siswa, 5=User',
  `department` varchar(50) DEFAULT NULL COMMENT 'Department or division',
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.users: ~18 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `role`, `level`, `department`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Super Admin', 'superadmin@academylite.com', 'super_admin', '1', 'IT', 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin Akademik', 'admin@academylite.com', 'admin', '2', 'Akademik', 'Aktif', '2025-09-09 03:53:26', '2025-09-08 06:03:43', '2025-09-09 03:53:26'),
	(3, 'guru', '5f4dcc3b5aa765d61d8327deb882cf99', 'Budi Hartono', 'budi.guru@academylite.com', 'guru', '3', 'Programming', 'Aktif', '2025-09-09 03:56:20', '2025-09-08 06:03:43', '2025-09-09 03:56:20'),
	(4, 'gurucitra', '5f4dcc3b5aa765d61d8327deb882cf99', 'Citra Lestari', 'citra.guru@academylite.com', 'guru', '3', 'Programming', 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(5, 'gurudian', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dian Sastro', 'dian.guru@academylite.com', 'guru', '3', 'Design', 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(6, 'gurueko', '5f4dcc3b5aa765d61d8327deb882cf99', 'Eko Kurniawan', 'eko.guru@academylite.com', 'guru', '3', 'Database', 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(7, 'gurufajar', '5f4dcc3b5aa765d61d8327deb882cf99', 'Fajar Nugroho', 'fajar.guru@academylite.com', 'guru', '3', 'Networking', 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(8, 'gurugita', '5f4dcc3b5aa765d61d8327deb882cf99', 'Gita Savitri', 'gita.guru@academylite.com', 'guru', '3', 'Cloud', 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(9, 'siswa', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ahmad Rizki', 'ahmad.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', '2025-09-08 20:49:01', '2025-09-08 06:03:43', '2025-09-08 20:49:01'),
	(10, 'siswadewi', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dewi Anggraini', 'dewi.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(11, 'siswafitri', '5f4dcc3b5aa765d61d8327deb882cf99', 'Fitriani', 'fitri.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(12, 'siswagalih', '5f4dcc3b5aa765d61d8327deb882cf99', 'Galih Pratama', 'galih.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(13, 'siswahana', '5f4dcc3b5aa765d61d8327deb882cf99', 'Hana Yulita', 'hana.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(14, 'siswaindra', '5f4dcc3b5aa765d61d8327deb882cf99', 'Indra Wijaya', 'indra.siswa@academylite.com', 'siswa', '4', NULL, 'Tidak Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(15, 'siswajoko', '5f4dcc3b5aa765d61d8327deb882cf99', 'Joko Susilo', 'joko.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(16, 'siswakartika', '5f4dcc3b5aa765d61d8327deb882cf99', 'Kartika Sari', 'kartika.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(17, 'siswalutfi', '5f4dcc3b5aa765d61d8327deb882cf99', 'Lutfi Halimawan', 'lutfi.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43'),
	(18, 'siswamaya', '5f4dcc3b5aa765d61d8327deb882cf99', 'Maya Indah', 'maya.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif', NULL, '2025-09-08 06:03:43', '2025-09-08 06:03:43');

-- Dumping structure for table academy_lite.user_permissions
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` enum('super_admin','admin','guru','siswa','user') NOT NULL,
  `level` enum('1','2','3','4','5') NOT NULL,
  `module` varchar(50) NOT NULL COMMENT 'Module name (dashboard, siswa, kelas, etc)',
  `action` varchar(50) NOT NULL COMMENT 'Action (create, read, update, delete, view)',
  `allowed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_permission` (`role`,`level`,`module`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.user_permissions: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
