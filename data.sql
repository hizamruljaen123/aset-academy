-- --------------------------------------------------------
-- Host:                         103.76.120.91
-- Server version:               10.3.39-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             12.11.0.7065
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_absensi_siswa` (`jadwal_id`,`siswa_id`),
  KEY `fk_absensi_siswa` (`siswa_id`),
  CONSTRAINT `fk_absensi_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_absensi_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.absensi_guru
CREATE TABLE IF NOT EXISTS `absensi_guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL,
  `catatan` text DEFAULT NULL,
  `waktu_absensi` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_absensi` (`jadwal_id`,`guru_id`),
  KEY `jadwal_id` (`jadwal_id`),
  KEY `guru_id` (`guru_id`),
  CONSTRAINT `absensi_guru_ibfk_1` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensi_guru_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.assignments
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `class_type` enum('premium','gratis') NOT NULL COMMENT 'To distinguish between kelas_premium and kelas_gratis',
  `teacher_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `grades_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.class_access_logs
CREATE TABLE IF NOT EXISTS `class_access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` enum('Grant Access','Revoke Access','Suspend Access','Restore Access','Update Status') NOT NULL,
  `previous_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `access_logs_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `access_logs_enrollment_fk` FOREIGN KEY (`enrollment_id`) REFERENCES `premium_class_enrollments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.class_categories
CREATE TABLE IF NOT EXISTS `class_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `class_type` enum('premium','free') NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_class_categories_slug` (`slug`),
  KEY `idx_class_categories_class_type` (`class_type`),
  KEY `idx_class_categories_is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.company_bank_accounts
CREATE TABLE IF NOT EXISTS `company_bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `bank_code` varchar(20) DEFAULT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_holder` varchar(100) NOT NULL DEFAULT 'CV ASET MEDIA CEMERLANG',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.daftar_bank
CREATE TABLE IF NOT EXISTS `daftar_bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bank` char(3) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bank`),
  UNIQUE KEY `kode_bank` (`kode_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.forum_categories
CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.forum_likes
CREATE TABLE IF NOT EXISTS `forum_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_like` (`user_id`,`thread_id`,`post_id`),
  KEY `thread_id` (`thread_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `forum_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_likes_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_likes_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.forum_posts
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_posts_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.forum_threads
CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `views` int(11) DEFAULT 0,
  `is_pinned` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `slug` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`slug`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `idx_slug` (`slug`),
  CONSTRAINT `forum_threads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_threads_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `forum_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.forum_thread_views
CREATE TABLE IF NOT EXISTS `forum_thread_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `viewed_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_view` (`thread_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `forum_thread_views_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_thread_views_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.free_classes
CREATE TABLE IF NOT EXISTS `free_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `level` enum('Dasar','Menengah','Lanjutan') NOT NULL DEFAULT 'Dasar',
  `category` varchar(100) NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 1 COMMENT 'Duration in hours',
  `mentor_id` int(11) DEFAULT NULL,
  `max_students` int(11) DEFAULT NULL COMMENT 'Maximum number of students allowed',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Draft','Coming Soon','Published','Archived') NOT NULL DEFAULT 'Draft' COMMENT 'Status kelas: Draft (belum siap), Coming Soon (sudah dibuat tapi menunggu persiapan), Published (sudah siap), Archived (diarsipkan)',
  `online_meet_link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `mentor_id` (`mentor_id`),
  KEY `fk_free_classes_category` (`category_id`),
  CONSTRAINT `fk_free_classes_category` FOREIGN KEY (`category_id`) REFERENCES `free_class_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `free_classes_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.free_class_discussions
CREATE TABLE IF NOT EXISTS `free_class_discussions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `free_class_discussions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_discussions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_discussions_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `free_class_discussions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.free_class_enrollments
CREATE TABLE IF NOT EXISTS `free_class_enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Enrolled','Completed','Dropped') NOT NULL DEFAULT 'Enrolled',
  `progress` int(11) NOT NULL DEFAULT 0 COMMENT 'Progress percentage',
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`class_id`,`student_id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `free_class_enrollments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_enrollments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.free_class_materials
CREATE TABLE IF NOT EXISTS `free_class_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content_type` enum('text','video','pdf','link') NOT NULL DEFAULT 'text',
  `content` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `free_class_materials_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.free_class_progress
CREATE TABLE IF NOT EXISTS `free_class_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` timestamp NULL DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_progress` (`enrollment_id`,`material_id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `material_id` (`material_id`),
  CONSTRAINT `free_class_progress_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `free_class_enrollments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_class_progress_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `free_class_materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.guru_kelas
CREATE TABLE IF NOT EXISTS `guru_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `assigned_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `guru_id` (`guru_id`),
  KEY `kelas_id` (`kelas_id`),
  CONSTRAINT `guru_kelas_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.jadwal_kelas
CREATE TABLE IF NOT EXISTS `jadwal_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `pertemuan_ke` int(11) NOT NULL COMMENT 'Meeting number (e.g., 1, 2, 3)',
  `class_type` varchar(50) DEFAULT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `judul_pertemuan` varchar(255) NOT NULL,
  `tanggal_pertemuan` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Selesai','Proses','Ditunda','Dibatalkan','Belum Mulai') DEFAULT 'Proses',
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
  KEY `fk_jadwal_guru` (`guru_id`),
  CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `jadwal_kelas_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for view academy_lite.jadwal_kelas_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `jadwal_kelas_view` (
	`id` INT(11) NOT NULL,
	`kelas_id` INT(11) NOT NULL,
	`class_type` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`guru_id` INT(11) NULL,
	`pertemuan_ke` INT(11) NOT NULL COMMENT 'Meeting number (e.g., 1, 2, 3)',
	`judul_pertemuan` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tanggal_pertemuan` DATE NOT NULL,
	`waktu_mulai` TIME NOT NULL,
	`waktu_selesai` TIME NOT NULL,
	`created_at` TIMESTAMP NULL,
	`updated_at` TIMESTAMP NULL,
	`nama_kelas` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`deskripsi_kelas` MEDIUMTEXT NULL COLLATE 'utf8mb4_general_ci',
	`level_kelas` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`kategori_kelas` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`status_kelas` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`nama_guru` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`username_guru` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`role_guru` ENUM('super_admin','admin','guru','siswa','user') NULL COLLATE 'utf8mb4_general_ci',
	`durasi_kelas` INT(11) NULL,
	`harga_kelas` DECIMAL(10,2) NULL
);

-- Dumping structure for table academy_lite.kelas_programming
CREATE TABLE IF NOT EXISTS `kelas_programming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `level` enum('Dasar','Menengah','Lanjutan') NOT NULL,
  `bahasa_program` varchar(50) DEFAULT NULL,
  `durasi` int(11) NOT NULL DEFAULT 1 COMMENT 'Durasi dalam jam',
  `harga` decimal(10,2) NOT NULL,
  `diskon` decimal(5,2) DEFAULT 0.00,
  `gambar` text DEFAULT NULL,
  `status` enum('Tidak Aktif','Coming Soon','Aktif') NOT NULL DEFAULT 'Tidak Aktif' COMMENT 'Status kelas: Tidak Aktif (belum siap), Coming Soon (sudah dibuat tapi menunggu persiapan), Aktif (sudah siap)',
  `online_meet_link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_kelas` (`nama_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.materi
CREATE TABLE IF NOT EXISTS `materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.materi_parts
CREATE TABLE IF NOT EXISTS `materi_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `part_order` int(11) NOT NULL,
  `part_type` enum('image','video','pdf','link') NOT NULL,
  `part_title` varchar(255) NOT NULL,
  `part_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `materi_id` (`materi_id`),
  CONSTRAINT `materi_parts_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.materi_progress
CREATE TABLE IF NOT EXISTS `materi_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` timestamp NULL DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_progress` (`materi_id`,`siswa_id`),
  CONSTRAINT `materi_progress_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Transfer','Cash','Other') NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `bank_account_id` int(11) DEFAULT NULL,
  `payment_description` text DEFAULT NULL,
  `user_bank_name` varchar(100) DEFAULT NULL,
  `user_account_holder` varchar(100) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `invoice_generated_at` timestamp NULL DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL COMMENT 'Path to proof image',
  `status` enum('Pending','Verified','Rejected') NOT NULL DEFAULT 'Pending',
  `enrollment_status` enum('Not Enrolled','Enrolled','Access Revoked') NOT NULL DEFAULT 'Not Enrolled',
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `enrollment_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `class_id` (`class_id`),
  KEY `verified_by` (`verified_by`),
  KEY `fk_payments_bank_account` (`bank_account_id`),
  CONSTRAINT `fk_payments_bank_account` FOREIGN KEY (`bank_account_id`) REFERENCES `company_bank_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.premium_class_discussions
CREATE TABLE IF NOT EXISTS `premium_class_discussions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `premium_class_discussions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_class_discussions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_class_discussions_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `premium_class_discussions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.premium_class_enrollments
CREATE TABLE IF NOT EXISTS `premium_class_enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Active','Suspended','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `access_granted_by` int(11) DEFAULT NULL COMMENT 'Admin who granted access',
  `access_granted_at` timestamp NULL DEFAULT NULL,
  `access_expires_at` timestamp NULL DEFAULT NULL COMMENT 'Optional expiration date',
  `progress` int(11) NOT NULL DEFAULT 0 COMMENT 'Progress percentage',
  `completion_date` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL COMMENT 'Admin notes about enrollment',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`class_id`,`student_id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  KEY `payment_id` (`payment_id`),
  KEY `access_granted_by` (`access_granted_by`),
  CONSTRAINT `premium_enrollments_admin_fk` FOREIGN KEY (`access_granted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `premium_enrollments_class_fk` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_enrollments_payment_fk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_enrollments_student_fk` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.premium_class_progress
CREATE TABLE IF NOT EXISTS `premium_class_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment_material` (`enrollment_id`,`material_id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `material_id` (`material_id`),
  KEY `status` (`status`),
  CONSTRAINT `premium_class_progress_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `premium_class_enrollments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `premium_class_progress_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.reg_districts
CREATE TABLE IF NOT EXISTS `reg_districts` (
  `id` char(6) NOT NULL,
  `regency_id` char(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_regency` (`regency_id`),
  CONSTRAINT `fk_regency` FOREIGN KEY (`regency_id`) REFERENCES `reg_regencies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.reg_provinces
CREATE TABLE IF NOT EXISTS `reg_provinces` (
  `id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.reg_regencies
CREATE TABLE IF NOT EXISTS `reg_regencies` (
  `id` char(4) NOT NULL,
  `province_id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_province` (`province_id`),
  CONSTRAINT `fk_province` FOREIGN KEY (`province_id`) REFERENCES `reg_provinces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.reg_villages
CREATE TABLE IF NOT EXISTS `reg_villages` (
  `id` char(10) NOT NULL,
  `district_id` char(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district` (`district_id`),
  CONSTRAINT `fk_district` FOREIGN KEY (`district_id`) REFERENCES `reg_districts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telepon` varchar(100) DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto_profil` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif','Lulus') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`),
  KEY `idx_nis` (`nis`),
  KEY `idx_nama` (`nama_lengkap`),
  KEY `idx_kelas` (`kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.student_submissions
CREATE TABLE IF NOT EXISTS `student_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submission_content` text DEFAULT NULL,
  `submission_file` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `grade` float DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `status` enum('submitted','graded','late') NOT NULL DEFAULT 'submitted',
  PRIMARY KEY (`id`),
  KEY `assignment_id` (`assignment_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `student_submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` tinyint(3) unsigned DEFAULT 5,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('super_admin','admin','guru','siswa','user') NOT NULL DEFAULT 'user',
  `level` enum('1','2','3','4','5') NOT NULL DEFAULT '5' COMMENT '1=Super Admin, 2=Admin, 3=Guru, 4=Siswa, 5=User',
  `department` varchar(50) DEFAULT NULL COMMENT 'Department or division',
  `timezone` varchar(50) DEFAULT 'Asia/Jakarta' COMMENT 'User timezone for attendance calculations',
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK1_users` (`user_id`),
  CONSTRAINT `FK1_users` FOREIGN KEY (`user_id`) REFERENCES `siswa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.user_permissions
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('super_admin','admin','guru','siswa','user') NOT NULL,
  `level` enum('1','2','3','4','5') NOT NULL,
  `module` varchar(50) NOT NULL COMMENT 'Module name (dashboard, siswa, kelas, etc)',
  `action` varchar(50) NOT NULL COMMENT 'Action (create, read, update, delete, view)',
  `allowed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_permission` (`role`,`level`,`module`,`action`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for view academy_lite.view_region_complete
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_region_complete` (
	`village_id` CHAR(10) NOT NULL COLLATE 'utf8_general_ci',
	`village_name` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`district_id` CHAR(6) NOT NULL COLLATE 'utf8_general_ci',
	`district_name` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`regency_id` CHAR(4) NOT NULL COLLATE 'utf8_general_ci',
	`regency_name` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`province_id` CHAR(2) NOT NULL COLLATE 'utf8_general_ci',
	`province_name` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci'
);

-- Dumping structure for view academy_lite.view_workshop_all_participants
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_workshop_all_participants` (
	`participant_id` INT(10) UNSIGNED NOT NULL,
	`workshop_id` INT(10) UNSIGNED NOT NULL,
	`user_id` INT(11) NULL,
	`nama_lengkap` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci',
	`user_role` ENUM('super_admin','admin','guru','siswa','user') NULL COLLATE 'utf8mb4_general_ci',
	`participant_role` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`status` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`registered_at` TIMESTAMP NOT NULL,
	`province_id` CHAR(2) NULL COLLATE 'utf8_general_ci',
	`regency_id` CHAR(4) NULL COLLATE 'utf8_general_ci',
	`district_id` CHAR(6) NULL COLLATE 'utf8_general_ci',
	`village_id` CHAR(10) NULL COLLATE 'utf8_general_ci',
	`participant_type` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_general_ci'
);

-- Dumping structure for table academy_lite.workshops
CREATE TABLE IF NOT EXISTS `workshops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('workshop','seminar') NOT NULL DEFAULT 'workshop',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_participants` int(11) NOT NULL DEFAULT 0,
  `thumbnail` text DEFAULT NULL,
  `status` enum('draft','published','completed','coming soon') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `online_meet` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_status` (`status`),
  KEY `idx_type` (`type`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_status_type` (`status`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.workshop_guests
CREATE TABLE IF NOT EXISTS `workshop_guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int(10) unsigned NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `asal_kampus_sekolah` varchar(255) NOT NULL,
  `usia` int(11) NOT NULL,
  `pekerjaan` enum('Pelajar','Mahasiswa','Karyawan','Wirausaha','PNS','Guru/Dosen','Lainnya') NOT NULL DEFAULT 'Pelajar',
  `no_wa_telegram` varchar(20) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `province_id` char(2) DEFAULT NULL,
  `regency_id` char(4) DEFAULT NULL,
  `district_id` char(6) DEFAULT NULL,
  `village_id` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  KEY `idx_province` (`province_id`),
  KEY `idx_regency` (`regency_id`),
  KEY `idx_district` (`district_id`),
  KEY `idx_village` (`village_id`),
  CONSTRAINT `fk_workshop_guest_district` FOREIGN KEY (`district_id`) REFERENCES `reg_districts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_workshop_guest_province` FOREIGN KEY (`province_id`) REFERENCES `reg_provinces` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_workshop_guest_regency` FOREIGN KEY (`regency_id`) REFERENCES `reg_regencies` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_workshop_guest_village` FOREIGN KEY (`village_id`) REFERENCES `reg_villages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `workshop_guests_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.workshop_materials
CREATE TABLE IF NOT EXISTS `workshop_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  CONSTRAINT `workshop_materials_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table academy_lite.workshop_participants
CREATE TABLE IF NOT EXISTS `workshop_participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int(10) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `external_name` varchar(255) DEFAULT NULL,
  `external_email` varchar(255) DEFAULT NULL,
  `role` enum('student','teacher','external') NOT NULL DEFAULT 'external',
  `status` enum('registered','attended','cancelled') NOT NULL DEFAULT 'registered',
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `province_id` char(2) DEFAULT NULL,
  `regency_id` char(4) DEFAULT NULL,
  `district_id` char(6) DEFAULT NULL,
  `village_id` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `workshop_participants_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `workshop_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `jadwal_kelas_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `jadwal_kelas_view` AS select `jk`.`id` AS `id`,`jk`.`kelas_id` AS `kelas_id`,`jk`.`class_type` AS `class_type`,`jk`.`guru_id` AS `guru_id`,`jk`.`pertemuan_ke` AS `pertemuan_ke`,`jk`.`judul_pertemuan` AS `judul_pertemuan`,`jk`.`tanggal_pertemuan` AS `tanggal_pertemuan`,`jk`.`waktu_mulai` AS `waktu_mulai`,`jk`.`waktu_selesai` AS `waktu_selesai`,`jk`.`created_at` AS `created_at`,`jk`.`updated_at` AS `updated_at`,case when `jk`.`class_type` = 'premium' then `kp`.`nama_kelas` when `jk`.`class_type` = 'gratis' then `fc`.`title` else 'Unknown Class' end AS `nama_kelas`,case when `jk`.`class_type` = 'premium' then `kp`.`deskripsi` when `jk`.`class_type` = 'gratis' then `fc`.`description` else NULL end AS `deskripsi_kelas`,case when `jk`.`class_type` = 'premium' then `kp`.`level` when `jk`.`class_type` = 'gratis' then `fc`.`level` else NULL end AS `level_kelas`,case when `jk`.`class_type` = 'premium' then `kp`.`bahasa_program` when `jk`.`class_type` = 'gratis' then `fc`.`category` else NULL end AS `kategori_kelas`,case when `jk`.`class_type` = 'premium' then `kp`.`status` when `jk`.`class_type` = 'gratis' then `fc`.`status` else 'Unknown' end AS `status_kelas`,`u`.`nama_lengkap` AS `nama_guru`,`u`.`username` AS `username_guru`,`u`.`role` AS `role_guru`,case when `jk`.`class_type` = 'premium' then `kp`.`durasi` else NULL end AS `durasi_kelas`,case when `jk`.`class_type` = 'premium' then `kp`.`harga` else 0 end AS `harga_kelas` from (((`jadwal_kelas` `jk` left join `kelas_programming` `kp` on(`jk`.`kelas_id` = `kp`.`id` and `jk`.`class_type` = 'premium')) left join `free_classes` `fc` on(`jk`.`kelas_id` = `fc`.`id` and `jk`.`class_type` = 'gratis')) left join `users` `u` on(`jk`.`guru_id` = `u`.`id`)) where `jk`.`class_type` is not null and `jk`.`guru_id` is not null and (`jk`.`class_type` = 'premium' and `kp`.`status` in ('Aktif','Coming Soon') or `jk`.`class_type` = 'gratis' and `fc`.`status` in ('Published','Coming Soon'))
;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_region_complete`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_region_complete` AS select `v`.`id` AS `village_id`,`v`.`name` AS `village_name`,`d`.`id` AS `district_id`,`d`.`name` AS `district_name`,`r`.`id` AS `regency_id`,`r`.`name` AS `regency_name`,`p`.`id` AS `province_id`,`p`.`name` AS `province_name` from (((`reg_villages` `v` join `reg_districts` `d` on(`v`.`district_id` = `d`.`id`)) join `reg_regencies` `r` on(`d`.`regency_id` = `r`.`id`)) join `reg_provinces` `p` on(`r`.`province_id` = `p`.`id`))
;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_workshop_all_participants`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_workshop_all_participants` AS select `p`.`id` AS `participant_id`,`p`.`workshop_id` AS `workshop_id`,`u`.`id` AS `user_id`,coalesce(`u`.`nama_lengkap`,convert(`p`.`external_name` using utf8mb4)) AS `nama_lengkap`,coalesce(`u`.`email`,convert(`p`.`external_email` using utf8mb4)) AS `email`,`u`.`role` AS `user_role`,`p`.`role` AS `participant_role`,`p`.`status` AS `status`,`p`.`registered_at` AS `registered_at`,`p`.`province_id` AS `province_id`,`p`.`regency_id` AS `regency_id`,`p`.`district_id` AS `district_id`,`p`.`village_id` AS `village_id`,'registered_user' AS `participant_type` from (`workshop_participants` `p` left join `users` `u` on(`p`.`user_id` = `u`.`id`)) union all select `g`.`id` AS `participant_id`,`g`.`workshop_id` AS `workshop_id`,NULL AS `user_id`,`g`.`nama_lengkap` AS `nama_lengkap`,NULL AS `email`,NULL AS `user_role`,'guest' AS `participant_role`,'registered' AS `status`,`g`.`registered_at` AS `registered_at`,`g`.`province_id` AS `province_id`,`g`.`regency_id` AS `regency_id`,`g`.`district_id` AS `district_id`,`g`.`village_id` AS `village_id`,'guest' AS `participant_type` from `workshop_guests` `g`
;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
