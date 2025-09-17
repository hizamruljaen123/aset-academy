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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.absensi: ~20 rows (approximately)
INSERT INTO `absensi` (`id`, `jadwal_id`, `siswa_id`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
	(111, 1, 1, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(112, 1, 2, 'Izin', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(113, 1, 3, 'Sakit', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(114, 1, 4, 'Alpa', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(115, 1, 5, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(116, 1, 6, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(117, 1, 7, 'Izin', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(118, 1, 8, 'Sakit', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(119, 1, 9, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(120, 1, 10, 'Alpa', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(121, 1, 11, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(122, 1, 12, 'Izin', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(123, 1, 13, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(124, 1, 14, 'Sakit', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(125, 1, 15, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(126, 1, 16, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(127, 1, 17, 'Alpa', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(128, 1, 18, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(129, 1, 19, 'Izin', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58'),
	(130, 1, 20, 'Hadir', NULL, '2025-09-16 11:08:58', '2025-09-16 11:08:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.absensi_guru: ~10 rows (approximately)
INSERT INTO `absensi_guru` (`id`, `jadwal_id`, `guru_id`, `status`, `catatan`, `waktu_absensi`) VALUES
	(15, 1, 1, 'Hadir', NULL, '2025-09-16 11:09:34'),
	(16, 1, 2, 'Tidak Hadir', 'Sakit', '2025-09-16 11:09:34'),
	(17, 1, 3, 'Hadir', NULL, '2025-09-16 11:09:34'),
	(18, 1, 4, 'Hadir', NULL, '2025-09-16 11:09:34'),
	(19, 1, 5, 'Tidak Hadir', 'Izin Dinas', '2025-09-16 11:09:34'),
	(20, 1, 6, 'Hadir', NULL, '2025-09-16 11:09:34'),
	(21, 1, 7, 'Hadir', NULL, '2025-09-16 11:09:34'),
	(22, 1, 8, 'Tidak Hadir', 'Cuti', '2025-09-16 11:09:34'),
	(23, 1, 9, 'Hadir', NULL, '2025-09-16 11:09:34'),
	(24, 1, 10, 'Hadir', NULL, '2025-09-16 11:09:34');

-- Dumping structure for table academy_lite.assignments
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `class_type` enum('premium','gratis') NOT NULL COMMENT 'To distinguish between kelas_premium and kelas_gratis',
  `teacher_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `due_date` datetime DEFAULT NULL,
  `grades_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.assignments: ~5 rows (approximately)
INSERT INTO `assignments` (`id`, `class_id`, `class_type`, `teacher_id`, `title`, `description`, `due_date`, `grades_published`, `created_at`) VALUES
	(1, 101, 'premium', 1, 'Tugas 1: Algoritma Dasar', 'Kerjakan soal tentang logika pemrograman.', '2025-09-20 23:59:59', 0, '2025-09-16 11:10:38'),
	(2, 102, 'gratis', 1, 'Tugas 2: HTML & CSS', 'Buat halaman web sederhana menggunakan HTML dan CSS.', '2025-09-22 23:59:59', 0, '2025-09-16 11:10:38'),
	(3, 103, 'premium', 1, 'Tugas 3: Struktur Data', 'Implementasi stack dan queue dalam bahasa pemrograman pilihanmu.', '2025-09-25 23:59:59', 0, '2025-09-16 11:10:38'),
	(4, 104, 'gratis', 1, 'Tugas 4: JavaScript Dasar', 'Buat kalkulator sederhana menggunakan JavaScript.', '2025-09-27 23:59:59', 0, '2025-09-16 11:10:38'),
	(5, 105, 'premium', 1, 'Tugas 5: Database MySQL', 'Rancang dan buat database sederhana untuk sistem perpustakaan.', '2025-09-30 23:59:59', 0, '2025-09-16 11:10:38');

-- Dumping structure for table academy_lite.class_access_logs
CREATE TABLE IF NOT EXISTS `class_access_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enrollment_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `action` enum('Grant Access','Revoke Access','Suspend Access','Restore Access','Update Status') NOT NULL,
  `previous_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) NOT NULL,
  `reason` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `access_logs_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `access_logs_enrollment_fk` FOREIGN KEY (`enrollment_id`) REFERENCES `premium_class_enrollments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.class_access_logs: ~0 rows (approximately)

-- Dumping structure for table academy_lite.company_bank_accounts
CREATE TABLE IF NOT EXISTS `company_bank_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_code` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `account_holder` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CV ASET MEDIA CEMERLANG',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.company_bank_accounts: ~5 rows (approximately)
INSERT INTO `company_bank_accounts` (`id`, `bank_name`, `bank_code`, `account_number`, `account_holder`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES
	(1, 'Bank Central Asia', '014', '1234567890', 'CV ASET MEDIA CEMERLANG', 1, 1, '2025-09-16 11:11:11', '2025-09-16 11:11:11'),
	(2, 'Bank Mandiri', '008', '9876543210', 'CV ASET MEDIA CEMERLANG', 1, 2, '2025-09-16 11:11:11', '2025-09-16 11:11:11'),
	(3, 'Bank Negara Indonesia', '009', '1122334455', 'CV ASET MEDIA CEMERLANG', 1, 3, '2025-09-16 11:11:11', '2025-09-16 11:11:11'),
	(4, 'Bank Rakyat Indonesia', '002', '5566778899', 'CV ASET MEDIA CEMERLANG', 1, 4, '2025-09-16 11:11:11', '2025-09-16 11:11:11'),
	(5, 'Bank Syariah Indonesia', '451', '6677889900', 'CV ASET MEDIA CEMERLANG', 0, 5, '2025-09-16 11:11:11', '2025-09-16 11:11:11');

-- Dumping structure for table academy_lite.forum_categories
CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.forum_categories: ~5 rows (approximately)
INSERT INTO `forum_categories` (`id`, `name`, `description`, `slug`, `created_at`) VALUES
	(1, 'Pembahasan Umum', 'Excepturi magnam repudiandae sint perspiciatis. Doloremque iste tempore praesentium exercitationem aspernatur voluptatem. Odio reprehenderit quidem sed aperiam ut quas velit.', 'side-again-year', '2025-01-03 02:39:51'),
	(2, 'Pertanyaan Teknis', 'Doloremque quidem sit illum ipsum culpa. Nihil soluta ratione excepturi accusamus adipisci.', 'think-young-scene', '2025-02-02 15:22:22'),
	(3, 'Proyek', 'Odio quibusdam dicta accusantium. Quisquam maiores nemo mollitia nihil.', 'easy-hotel-artist', '2025-09-09 06:59:38'),
	(4, 'Tips dan Trik', 'Nisi cupiditate officia dignissimos reprehenderit. Incidunt fugiat minus dolores nisi.', 'room-reach-well', '2025-06-28 21:00:15'),
	(5, 'Pengumuman', 'Sed molestiae placeat occaecati totam quas veritatis repudiandae. Ratione sequi culpa id. Nostrum perspiciatis ipsa recusandae veritatis fugiat dolor.', 'conference-cause', '2025-07-11 02:41:10');

-- Dumping structure for table academy_lite.forum_likes
CREATE TABLE IF NOT EXISTS `forum_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `thread_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_like` (`user_id`,`thread_id`,`post_id`),
  KEY `thread_id` (`thread_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `forum_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_likes_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_likes_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.forum_likes: ~10 rows (approximately)
INSERT INTO `forum_likes` (`id`, `user_id`, `thread_id`, `post_id`, `created_at`) VALUES
	(1, 1, 1001, NULL, '2025-09-16 11:11:41'),
	(2, 2, 1001, NULL, '2025-09-16 11:11:41'),
	(3, 3, 1002, NULL, '2025-09-16 11:11:41'),
	(4, 4, 1003, NULL, '2025-09-16 11:11:41'),
	(5, 5, 1001, 2001, '2025-09-16 11:11:41'),
	(6, 1, 1001, 2002, '2025-09-16 11:11:41'),
	(7, 2, 1002, 2003, '2025-09-16 11:11:41'),
	(8, 3, 1002, 2004, '2025-09-16 11:11:41'),
	(9, 4, 1003, 2005, '2025-09-16 11:11:41'),
	(10, 5, 1003, NULL, '2025-09-16 11:11:41');

-- Dumping structure for table academy_lite.forum_posts
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_posts_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.forum_posts: ~100 rows (approximately)
INSERT INTO `forum_posts` (`id`, `thread_id`, `user_id`, `parent_id`, `content`, `created_at`, `updated_at`) VALUES
	(1, 18, 16, NULL, 'Laudantium tenetur corrupti dolores nesciunt. A quam officiis beatae.', '2025-06-06 23:04:34', '2025-06-19 13:04:32'),
	(2, 14, 10, NULL, 'Ea non asperiores nostrum aut necessitatibus. Laboriosam ipsa quibusdam necessitatibus. Cupiditate animi minima ducimus quia odio.', '2025-03-20 14:04:21', '2025-05-07 06:31:09'),
	(3, 12, 33, NULL, 'Exercitationem explicabo ipsum consectetur. Ducimus quos cupiditate inventore animi sapiente.', '2025-01-08 16:53:29', '2025-01-15 20:57:10'),
	(4, 8, 35, NULL, 'Quae et doloremque fuga nesciunt maiores veniam.', '2025-05-21 18:27:14', '2025-02-24 03:52:40'),
	(5, 9, 20, 3, 'Saepe laborum ratione similique deserunt ducimus deserunt. Harum perferendis ex asperiores.', '2025-02-10 06:22:44', '2025-02-21 16:13:13'),
	(6, 1, 36, NULL, 'Aspernatur cupiditate tempore recusandae quo.', '2025-06-07 03:10:32', '2025-06-22 23:33:46'),
	(7, 6, 43, NULL, 'Hic sequi reprehenderit aliquid molestias animi. Est itaque blanditiis incidunt facilis reiciendis dolore enim. Rem recusandae sit adipisci quis autem nulla.', '2025-06-25 14:51:18', '2025-01-24 07:11:44'),
	(8, 16, 48, NULL, 'Eveniet adipisci eligendi quibusdam. Inventore molestiae asperiores repudiandae architecto. Ad suscipit ullam nam laudantium ab beatae expedita.', '2025-07-31 16:57:34', '2025-09-10 09:55:33'),
	(9, 13, 3, NULL, 'Expedita ut animi doloribus vel vitae dolorum. Earum maxime modi et. Aperiam at possimus nihil hic maiores incidunt.', '2025-05-06 23:31:43', '2025-06-16 10:39:37'),
	(10, 20, 50, NULL, 'Dolore quisquam dicta eius hic minima assumenda voluptate. Ab quibusdam officiis unde nobis distinctio facilis. Ullam cumque dolore eligendi laboriosam rerum.', '2025-02-12 07:31:08', '2025-04-08 20:23:00'),
	(11, 9, 48, 7, 'Quidem voluptatum temporibus illo ullam.', '2025-01-03 12:27:26', '2025-05-08 12:28:43'),
	(12, 8, 24, NULL, 'Omnis at enim est nostrum aliquam.', '2025-06-10 11:18:58', '2025-09-04 06:18:33'),
	(13, 9, 25, 8, 'Autem omnis nisi. Ab esse itaque ab amet asperiores. Tempora officiis ullam recusandae veniam nostrum harum laudantium.', '2025-06-24 14:34:31', '2025-07-22 11:06:50'),
	(14, 4, 49, 7, 'Quis aspernatur mollitia ad recusandae officia. Inventore ad fugit ab deserunt adipisci iure dignissimos. Nobis optio impedit atque ipsam enim. Et iste cupiditate quam voluptates non.', '2025-03-29 13:26:14', '2025-08-24 22:24:09'),
	(15, 18, 31, NULL, 'Suscipit reiciendis nam dolorem magnam. Rerum reprehenderit similique.', '2025-08-01 11:26:53', '2025-02-15 16:09:50'),
	(16, 4, 42, 4, 'Eligendi consequatur aliquam. Beatae voluptatem deleniti eligendi quibusdam cupiditate corrupti ipsa.', '2025-07-01 13:23:27', '2025-09-04 22:04:31'),
	(17, 5, 26, 11, 'Reprehenderit accusantium facilis omnis reiciendis unde. Debitis repellat possimus veniam.', '2025-06-18 05:58:06', '2025-03-30 20:18:05'),
	(18, 18, 11, NULL, 'Nemo recusandae quo sed. Inventore ex praesentium nesciunt sunt nesciunt. Laudantium optio voluptas hic in doloribus ab.', '2025-01-29 09:53:33', '2025-01-09 19:52:31'),
	(19, 4, 47, NULL, 'Dolorum adipisci eum. Consequatur labore ex. Perspiciatis corrupti a.', '2025-01-28 13:30:53', '2025-01-06 23:07:07'),
	(20, 5, 40, 6, 'Accusamus atque quidem quasi saepe. Alias natus architecto nihil minus. Possimus alias doloremque deleniti architecto quasi. Ducimus libero ut eligendi dolorum minima facilis.', '2025-08-24 16:51:24', '2025-03-29 12:56:09'),
	(21, 9, 4, 11, 'Reiciendis cum beatae delectus officiis.', '2025-05-19 18:05:26', '2025-02-07 20:42:48'),
	(22, 9, 42, NULL, 'Qui sunt et eligendi mollitia. Sequi vel illum accusamus. Deleniti amet eaque reiciendis officia.', '2025-02-11 01:06:22', '2025-05-28 19:41:39'),
	(23, 14, 41, NULL, 'Earum atque magni corrupti suscipit nemo vel. Voluptates impedit dolores nam impedit perferendis dolorem. Eius quasi iure optio.', '2025-07-28 01:01:33', '2025-05-10 10:05:09'),
	(24, 3, 5, 22, 'Quos eaque saepe aut commodi voluptas consequatur. Nostrum a at distinctio iure quos.', '2025-07-17 00:20:45', '2025-07-21 08:57:13'),
	(25, 4, 44, 13, 'Quae sunt optio consequuntur fuga voluptatum. Eius impedit tempore eaque quia.', '2025-01-04 17:37:04', '2025-08-08 17:11:48'),
	(26, 8, 10, 20, 'Adipisci natus aspernatur reprehenderit aliquam saepe corporis. Numquam harum doloremque dolorem sint error. Harum minima doloribus accusantium omnis libero.', '2025-08-01 00:03:44', '2025-04-21 21:55:44'),
	(27, 12, 19, NULL, 'Neque rerum delectus repellendus.', '2025-02-25 04:09:07', '2025-05-09 04:08:19'),
	(28, 10, 1, NULL, 'Cumque voluptatibus quos esse nisi placeat. Ab alias cupiditate porro iusto quis accusantium nulla.', '2025-02-25 13:31:46', '2025-07-01 09:27:23'),
	(29, 6, 18, 17, 'Error sint dicta consectetur voluptas temporibus iste. Inventore inventore quidem amet provident deserunt debitis. Maxime ratione fugiat doloremque esse.', '2025-02-16 19:13:05', '2025-01-28 18:42:05'),
	(30, 10, 15, NULL, 'Praesentium iste nesciunt culpa autem. Ex ipsam quae illo.', '2025-02-15 09:14:04', '2025-06-12 14:02:06'),
	(31, 17, 5, 9, 'Facere odio at magni eveniet possimus. Quas dicta voluptatibus impedit est. Et doloremque quod similique culpa. Minima asperiores est quae cupiditate aut voluptas.', '2025-07-07 17:26:14', '2025-08-14 10:58:13'),
	(32, 16, 48, NULL, 'Culpa dolores dolor nam. Reiciendis dolor nesciunt iusto veniam veritatis ea.', '2025-02-23 22:52:58', '2025-08-28 11:32:15'),
	(33, 20, 25, NULL, 'Similique architecto expedita culpa pariatur natus vel. Molestias esse nulla itaque pariatur illum.', '2025-04-30 08:23:52', '2025-04-18 14:49:04'),
	(34, 16, 41, NULL, 'Iure quaerat commodi. Nam aut suscipit quo non omnis laborum. Suscipit quo iure nulla perferendis.', '2025-02-26 01:38:43', '2025-04-17 16:15:27'),
	(35, 9, 45, 13, 'Architecto vitae vero occaecati pariatur dolorem minus. Tenetur atque placeat assumenda exercitationem. Placeat rerum ex nam.', '2025-03-01 16:24:05', '2025-01-12 13:38:06'),
	(36, 8, 46, 24, 'Odio debitis ab aperiam dolores dolorum. Tempora repellat ut illo quis voluptate maiores. Molestias quod veritatis rem maiores numquam reiciendis.', '2025-06-25 00:42:32', '2025-05-28 02:43:39'),
	(37, 5, 12, NULL, 'Saepe earum fugiat voluptas possimus sed. Dolor dolor assumenda iste similique at at.', '2025-07-04 06:27:24', '2025-07-12 22:38:57'),
	(38, 11, 14, NULL, 'Deserunt ad aperiam inventore suscipit aspernatur. Rerum error voluptate reiciendis aliquid odio at. Debitis amet laboriosam voluptates error ratione harum.', '2025-04-27 16:10:37', '2025-03-19 13:11:12'),
	(39, 12, 36, NULL, 'In ad ea nemo atque ullam cupiditate asperiores. Beatae similique quidem tempora laborum possimus deserunt. Dolores voluptates sit ullam.', '2025-01-28 13:19:54', '2025-07-31 02:29:48'),
	(40, 3, 24, NULL, 'Nihil quis cum asperiores autem aut.', '2025-01-24 14:35:46', '2025-03-18 07:17:53'),
	(41, 3, 38, NULL, 'Debitis eligendi dolor dolores odio occaecati consectetur. Numquam occaecati dolorum maiores est reiciendis fugiat. Nulla ipsum doloremque modi laborum temporibus sapiente cumque.', '2025-02-28 21:55:06', '2025-04-12 06:28:22'),
	(42, 6, 42, 27, 'Enim delectus dicta. Illum commodi sunt animi magnam voluptate voluptatem.', '2025-05-15 09:25:07', '2025-02-04 05:14:34'),
	(43, 10, 35, 15, 'Tempora nisi magnam ea in similique. At quam itaque delectus necessitatibus eos.', '2025-04-08 08:43:31', '2025-07-17 19:30:54'),
	(44, 14, 49, NULL, 'Sint possimus optio quod tempore voluptatum quos eius.', '2025-08-27 02:07:25', '2025-05-30 13:50:50'),
	(45, 19, 12, NULL, 'Fugit excepturi laudantium beatae voluptatem velit neque. Nisi itaque dolores assumenda maxime.', '2025-01-20 03:30:34', '2025-07-16 03:05:52'),
	(46, 15, 17, NULL, 'Repellendus quisquam inventore quisquam incidunt. Voluptatum nobis alias omnis dolores labore velit.', '2025-02-27 12:41:59', '2025-05-21 12:31:19'),
	(47, 5, 50, 21, 'Ea harum ad distinctio dolorem. Voluptas at et qui numquam recusandae quod. Modi voluptatum illum molestiae. Blanditiis dolores possimus autem facere ullam sed.', '2025-09-14 07:21:41', '2025-09-10 00:19:53'),
	(48, 11, 47, NULL, 'Dolores doloremque ipsum rerum dignissimos rem vero. Qui eius delectus suscipit quidem. Accusantium voluptatibus eum enim labore animi.', '2025-02-09 12:02:02', '2025-08-30 12:56:49'),
	(49, 4, 10, NULL, 'Voluptatum asperiores accusamus at recusandae. Necessitatibus quisquam eaque amet. Cumque autem a quaerat voluptates. Laborum quasi eligendi non temporibus.', '2025-07-29 10:06:33', '2025-06-17 12:25:19'),
	(50, 14, 30, NULL, 'Deserunt debitis soluta quod optio voluptatibus. Repellat nisi sequi quibusdam suscipit veniam laudantium.', '2025-03-11 23:37:17', '2025-05-03 21:59:32'),
	(51, 14, 31, NULL, 'Excepturi eveniet quasi sed nihil sint tempora. Autem repellat quae perspiciatis vitae illum occaecati.', '2025-08-14 22:11:57', '2025-07-04 12:28:50'),
	(52, 18, 36, NULL, 'Magni asperiores aspernatur repellat accusantium. Nulla quo dolorem accusantium id harum illum.', '2025-06-30 22:07:08', '2025-02-22 22:10:51'),
	(53, 9, 17, NULL, 'Deleniti illum atque. Quisquam ut tempore pariatur porro. Sapiente facilis aliquam aperiam.', '2025-08-25 08:54:41', '2025-07-04 06:54:29'),
	(54, 20, 3, NULL, 'Recusandae pariatur provident occaecati sunt accusantium. Ea excepturi doloribus reprehenderit. Totam alias accusantium quas similique.', '2025-02-15 08:06:27', '2025-01-03 06:06:07'),
	(55, 13, 35, NULL, 'Expedita ea praesentium vitae modi quia eaque. Temporibus ratione veritatis doloribus nam labore voluptate numquam.', '2025-08-26 08:16:29', '2025-01-11 23:19:50'),
	(56, 16, 42, NULL, 'Numquam doloremque iure fugit unde explicabo quia. Aperiam enim hic quia earum aut dignissimos. Velit sunt accusantium quaerat natus harum neque.', '2025-07-20 02:57:50', '2025-04-03 21:46:17'),
	(57, 2, 17, NULL, 'Unde et quam atque architecto voluptatum. Ut dolor nihil cum quisquam numquam distinctio necessitatibus.', '2025-05-13 09:11:10', '2025-03-25 05:35:54'),
	(58, 5, 36, NULL, 'Tempora distinctio sint porro. Eveniet amet commodi incidunt. Delectus et voluptates perferendis.', '2025-02-24 22:11:05', '2025-01-28 12:58:41'),
	(59, 15, 38, NULL, 'Quisquam unde accusamus voluptatem.', '2025-08-07 21:39:57', '2025-06-14 01:24:53'),
	(60, 15, 29, NULL, 'Possimus neque culpa earum incidunt necessitatibus. Numquam asperiores reiciendis nemo consequatur. Quibusdam totam aliquid dolorem. Atque minima corrupti cupiditate dolor dolorum.', '2025-05-30 00:26:15', '2025-05-16 12:18:51'),
	(61, 5, 6, NULL, 'Expedita alias deleniti eius iste.', '2025-01-05 19:07:58', '2025-03-29 01:42:49'),
	(62, 19, 32, NULL, 'Praesentium doloribus quibusdam quibusdam odit. Totam voluptate aliquam provident magnam officiis nam.', '2025-08-16 01:32:12', '2025-07-15 16:46:41'),
	(63, 18, 24, NULL, 'Incidunt itaque enim sequi. Consectetur animi ab.', '2025-04-13 04:49:22', '2025-02-09 17:20:25'),
	(64, 17, 48, NULL, 'Natus iure ipsum natus quae. Deleniti ex voluptas aspernatur aliquid accusamus temporibus officiis.', '2025-07-03 05:59:20', '2025-04-16 22:54:14'),
	(65, 3, 40, 14, 'Ipsa eius alias temporibus distinctio suscipit quasi repudiandae. In quod ad quo maxime neque fugiat suscipit.', '2025-05-22 12:32:26', '2025-06-15 19:04:33'),
	(66, 20, 46, NULL, 'Dolores numquam explicabo eligendi. Cupiditate nihil porro eveniet.', '2025-04-20 02:00:06', '2025-03-01 02:39:40'),
	(67, 9, 1, NULL, 'Totam nihil mollitia quo officiis at facilis. Delectus consequatur omnis maxime.', '2025-08-18 21:39:35', '2025-05-27 11:14:56'),
	(68, 20, 21, NULL, 'Soluta eum doloribus culpa culpa. Id maxime adipisci incidunt ab repellendus inventore.', '2025-01-25 22:13:50', '2025-06-10 16:28:12'),
	(69, 19, 43, 54, 'Nihil consequuntur tempore veniam eaque. Atque sint unde.', '2025-06-14 00:14:35', '2025-02-16 09:01:24'),
	(70, 16, 38, 56, 'Assumenda modi quam odit dolore molestias. Eveniet assumenda sed quas. Consectetur repellendus dolorum reprehenderit in cupiditate maiores.', '2025-08-25 22:15:09', '2025-08-18 05:02:07'),
	(71, 19, 45, NULL, 'Quibusdam quis molestiae enim modi adipisci nam. Molestias eaque assumenda quam temporibus est expedita eaque. Tempore necessitatibus sapiente voluptatum officia quod doloremque.', '2025-04-05 07:40:55', '2025-08-26 00:13:27'),
	(72, 6, 23, 22, 'Nesciunt cumque eos a blanditiis quibusdam officia minus. Ipsam repellat natus.', '2025-07-11 17:49:27', '2025-07-31 15:09:44'),
	(73, 12, 36, NULL, 'Magnam illo adipisci hic eligendi expedita. Dolor sapiente ut excepturi odit. Vero quod ut fuga tempora placeat aperiam.', '2025-03-20 16:39:34', '2025-04-13 07:27:36'),
	(74, 20, 14, NULL, 'Laudantium accusantium amet eius eius adipisci maiores. Itaque itaque ipsam eveniet.', '2025-06-16 21:55:26', '2025-06-15 00:48:16'),
	(75, 3, 50, 53, 'Natus ut temporibus ipsam inventore velit. Velit recusandae iste provident maxime neque laudantium quos.', '2025-03-17 16:20:11', '2025-03-19 23:18:48'),
	(76, 13, 23, NULL, 'Consequatur magni minus iure libero. Architecto fugiat quo amet neque alias. Pariatur magni sequi.', '2025-03-03 01:28:08', '2025-01-25 19:50:07'),
	(77, 7, 24, 74, 'Id error aliquam earum facere voluptatem. Cupiditate nobis assumenda numquam. Quos in cum suscipit. Adipisci recusandae tenetur.', '2025-09-12 06:47:08', '2025-03-07 12:02:08'),
	(78, 13, 24, 40, 'Similique facere quisquam suscipit modi. Dolores ipsa doloribus veritatis eveniet porro.', '2025-06-06 19:28:12', '2025-09-03 07:24:37'),
	(79, 1, 4, NULL, 'Unde aut eum fugit modi odio. In illo harum quas.', '2025-02-10 11:59:13', '2025-01-31 13:03:08'),
	(80, 19, 23, NULL, 'In illum non neque.', '2025-08-08 12:33:45', '2025-08-29 08:44:39'),
	(81, 8, 36, 64, 'Sit debitis laboriosam voluptas eos hic. Repudiandae aperiam eius quasi cupiditate nisi.', '2025-01-17 19:38:01', '2025-04-11 04:57:55'),
	(82, 7, 8, NULL, 'Architecto vero cumque ea. Excepturi unde recusandae praesentium. Recusandae provident non temporibus quis laborum vel cumque.', '2025-09-01 19:43:58', '2025-04-18 20:04:20'),
	(83, 3, 49, NULL, 'Nobis corrupti amet. Molestiae officiis hic.', '2025-06-16 06:51:53', '2025-08-18 19:20:21'),
	(84, 9, 46, 60, 'Ad laboriosam veniam qui labore suscipit et. Quis nesciunt totam eaque qui repellendus deleniti. Repellat qui maiores rem pariatur.', '2025-05-13 05:11:29', '2025-04-28 09:25:41'),
	(85, 18, 33, NULL, 'Iure magni tempora velit veniam tempore.', '2025-05-14 18:42:00', '2025-01-20 13:16:25'),
	(86, 19, 36, NULL, 'Nihil quibusdam ducimus optio ullam nisi veniam. Molestias rem repellat suscipit.', '2025-01-18 10:59:45', '2025-02-19 03:51:51'),
	(87, 4, 3, NULL, 'Tenetur illum eveniet consequatur ex dolorum. Excepturi atque inventore culpa fuga in aliquam facilis. Soluta sapiente temporibus at vero laudantium soluta.', '2025-06-02 02:18:29', '2025-03-25 00:06:20'),
	(88, 13, 45, NULL, 'Animi beatae quidem impedit. Ratione alias voluptatem.', '2025-08-30 11:53:12', '2025-07-30 07:52:25'),
	(89, 5, 10, NULL, 'Neque natus omnis officiis. Sint laudantium voluptatum ut sed fugit.', '2025-04-21 19:03:24', '2025-08-02 05:05:30'),
	(90, 12, 2, NULL, 'Consectetur natus officiis dolores itaque sunt. Suscipit itaque sint vero illo eligendi amet ea.', '2025-02-27 04:45:25', '2025-02-14 21:32:07'),
	(91, 20, 3, 33, 'Dolores ea recusandae quas id velit. Consequatur molestiae iste placeat harum. Eligendi provident mollitia eveniet doloremque.', '2025-09-07 09:24:31', '2025-01-09 03:58:52'),
	(92, 5, 34, 46, 'Repellendus deserunt totam velit velit unde impedit. Tempora quidem corporis ullam.', '2025-03-27 19:34:26', '2025-04-11 06:30:42'),
	(93, 9, 28, NULL, 'Voluptatum rerum eveniet sunt quod explicabo. Possimus soluta ratione repellat. A dolore officiis laborum.', '2025-01-10 10:31:40', '2025-04-18 00:28:02'),
	(94, 11, 21, NULL, 'Numquam cumque libero molestias. Soluta fugit tenetur.', '2025-06-27 00:19:35', '2025-03-31 20:08:08'),
	(95, 8, 35, 28, 'Totam quis labore cum. Inventore rerum tempore aliquid asperiores nesciunt.', '2025-04-22 17:42:21', '2025-01-12 06:39:09'),
	(96, 20, 2, NULL, 'Nostrum ipsam impedit natus quos veritatis.', '2025-01-21 04:41:19', '2025-01-15 13:49:56'),
	(97, 9, 30, NULL, 'Dolores officiis repellat consequatur totam optio. Aliquam molestias animi iusto dicta rerum aliquam quas.', '2025-08-11 02:23:27', '2025-09-04 14:26:20'),
	(98, 14, 33, 46, 'Nihil explicabo expedita ipsum temporibus. Corrupti perspiciatis commodi.', '2025-05-24 20:03:41', '2025-07-05 15:44:35'),
	(99, 1, 46, NULL, 'Quisquam iure aperiam inventore recusandae. Mollitia totam similique ipsum consequatur.', '2025-08-20 15:57:37', '2025-08-30 05:27:25'),
	(100, 18, 16, NULL, 'Corrupti aperiam eos. Dolor eligendi adipisci placeat eius. Et earum asperiores voluptatibus itaque ab.', '2025-09-02 08:07:10', '2025-01-04 05:22:32');

-- Dumping structure for table academy_lite.forum_threads
CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `views` int DEFAULT '0',
  `is_pinned` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slug` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`slug`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `idx_slug` (`slug`),
  CONSTRAINT `forum_threads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_threads_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `forum_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.forum_threads: ~20 rows (approximately)
INSERT INTO `forum_threads` (`id`, `user_id`, `category_id`, `title`, `content`, `views`, `is_pinned`, `created_at`, `updated_at`, `slug`) VALUES
	(1, 23, 2, 'Ab nobis id.', 'Velit et eius amet adipisci. Veritatis porro distinctio minima distinctio reiciendis architecto.\r\n\r\nIpsum temporibus architecto saepe delectus nobis. Quae at recusandae.\r\n\r\nTenetur commodi minus omnis nam. Nulla reprehenderit harum totam rerum molestias. Quaerat inventore voluptate amet iusto quo.', 357, 0, '2025-02-05 05:04:11', '2025-02-14 03:32:38', 'rise-serious-great'),
	(2, 22, 1, 'Aperiam perferendis quia illo.', 'Blanditiis tenetur aliquid. Tempore voluptatibus quidem quia officiis distinctio a non. Fugiat et autem libero eaque facere dignissimos sunt.\r\n\r\nQuaerat cupiditate consectetur error dolorum at iure. Consectetur molestiae soluta harum culpa nisi eius.\r\n\r\nNam perferendis perspiciatis eaque odio accusantium dolorum. Iste recusandae repellendus sunt sunt voluptate deleniti. Facere placeat odit quibusdam fugiat consequuntur doloribus similique.', 924, 1, '2025-03-19 09:31:10', '2025-02-24 15:41:46', 'skin-ten-here'),
	(3, 7, 5, 'Sunt hic natus.', 'Pariatur maxime sequi voluptatem. Consectetur voluptas aut facilis pariatur recusandae suscipit. Blanditiis veniam ex vel. Consequatur mollitia necessitatibus ea inventore nesciunt adipisci.\r\n\r\nIpsam sit consequatur. Aspernatur eaque quasi quod et. Laudantium quisquam rem dolorem. Quisquam quibusdam ipsum qui quod corrupti id.\r\n\r\nTemporibus hic laboriosam. Vero adipisci nobis nemo accusantium officia quos fuga. Quo nihil omnis magni asperiores nesciunt delectus id. Autem explicabo nulla illo quidem veritatis totam.', 790, 1, '2025-01-07 09:48:30', '2025-03-10 12:51:58', 'scientist'),
	(4, 39, 5, 'Cumque ad possimus quia laborum.', 'Ab nostrum eius alias excepturi minus. Aut voluptate illum libero atque. Modi repudiandae explicabo laudantium porro facilis dignissimos.\r\n\r\nAnimi animi dolor.\r\n\r\nQuia fuga consequatur accusamus. Inventore perspiciatis id recusandae necessitatibus.', 579, 0, '2025-04-27 18:29:30', '2025-02-13 04:10:14', 'break-sometimes'),
	(5, 11, 4, 'Minus quos cumque soluta.', 'Placeat vitae voluptatem non iusto cumque. Est sunt distinctio cupiditate. Eligendi ratione nihil tempora iste doloribus sapiente.\r\n\r\nDucimus maiores laboriosam possimus magni ut doloribus. Dignissimos aliquid reprehenderit officia possimus id quam. Ea maxime itaque eos ipsum quaerat in praesentium.\r\n\r\nMagnam nostrum reiciendis in eum modi. Consequuntur repellat recusandae explicabo. Eveniet nisi architecto velit necessitatibus.', 820, 1, '2025-08-12 11:13:39', '2025-04-10 16:02:56', 'respond-hotel'),
	(6, 1, 5, 'Consequuntur adipisci officiis sequi eaque quod sed nihil.', 'Quaerat corporis non. Sunt deserunt autem aliquid. Voluptatibus iure sit accusamus.\r\n\r\nAtque velit cum. Culpa blanditiis odit neque repellendus.\r\n\r\nIllum suscipit dignissimos beatae porro enim nam. Ducimus accusantium voluptate rerum perspiciatis tempora. Atque dolorem dolorum minus.', 83, 1, '2025-04-13 23:27:08', '2025-03-11 01:55:45', 'model-investment'),
	(7, 5, 1, 'Maxime libero dignissimos tenetur.', 'Nam facere perspiciatis fugit rerum provident error. Temporibus facilis beatae. Voluptates cumque ex sapiente.\r\n\r\nNostrum quibusdam repellat laboriosam fugiat facilis. Quo at dolorum asperiores aspernatur dolorum. Unde ex exercitationem voluptates rem ut molestiae.\r\n\r\nSaepe animi maxime ratione magni. Animi magnam at quasi ipsam delectus. Illum et ea consequuntur. Accusantium rem assumenda dolore iusto placeat ea aliquam.', 406, 1, '2025-01-29 20:48:36', '2025-06-03 16:30:41', 'series-will-foreign'),
	(8, 4, 3, 'Occaecati quisquam eveniet cumque.', 'Aliquam quam harum natus debitis et est. Ea atque quasi facere vitae alias. Et dolorem voluptate magni similique quasi quod voluptatum.\r\n\r\nMaiores distinctio occaecati necessitatibus aperiam suscipit voluptatibus. Vero nobis architecto nulla vitae dolorum.\r\n\r\nDebitis qui porro rem neque qui quos. Autem nesciunt recusandae doloribus eaque.', 340, 1, '2025-07-07 14:41:51', '2025-01-28 09:52:24', 'bill-position'),
	(9, 10, 5, 'Inventore sed magni vitae.', 'Minus doloremque ratione sed perferendis rerum. Minima velit accusamus magnam omnis. Eligendi porro voluptatibus.\r\n\r\nSint similique illum est. Atque corrupti natus at. Nulla veniam reprehenderit at reprehenderit.\r\n\r\nUt vitae accusamus et. Mollitia provident enim nostrum nostrum vitae.', 252, 1, '2025-07-30 19:21:30', '2025-02-26 12:34:17', 'short-how-parent'),
	(10, 41, 1, 'Asperiores vitae dolorum error impedit explicabo praesentium.', 'Architecto ducimus labore qui quod delectus corrupti suscipit. Doloribus labore nulla illo commodi. Vel iusto totam repellendus adipisci aspernatur.\r\n\r\nDignissimos sed maiores aut officia. Neque magni voluptatum velit rem.\r\n\r\nTenetur hic maiores quo labore accusantium et. Laborum ex accusantium asperiores laboriosam nesciunt.', 766, 1, '2025-09-04 11:42:04', '2025-04-28 00:52:19', 'require-everything'),
	(11, 8, 5, 'Eligendi adipisci rerum id.', 'Repellat assumenda voluptatum aliquam tempore voluptas voluptas.\r\n\r\nNon dolorum deserunt dolor dolores fugiat. Numquam quos illum natus enim.\r\n\r\nDolorem molestiae quod tenetur. Magnam labore aut ad quos temporibus eius. Et assumenda sunt accusantium.', 799, 0, '2025-02-18 04:03:05', '2025-05-11 23:50:13', 'buy-environment'),
	(12, 10, 5, 'Officiis magnam quas officia eos in iusto.', 'Adipisci adipisci corrupti nisi eum voluptas esse. Natus nihil velit nulla.\r\n\r\nCum tempore laudantium quia. Nisi voluptas ratione a voluptatem quis.\r\n\r\nError repellendus maxime aspernatur ea doloribus numquam delectus. Reprehenderit officiis ipsam veritatis officia modi cum dignissimos. Quibusdam officiis iure illum odit cupiditate quae.', 487, 1, '2025-04-09 12:18:18', '2025-02-16 08:24:45', 'out-data-leave'),
	(13, 5, 3, 'Suscipit natus alias ab quidem quidem.', 'Facilis quod numquam quia. Perferendis rerum quisquam assumenda deleniti.\r\n\r\nEius dolores voluptatum sapiente saepe consequuntur. Excepturi laboriosam veritatis similique cum reiciendis aperiam voluptatem.\r\n\r\nEaque dolorum debitis laborum velit. Perspiciatis inventore ullam debitis sed facere. Placeat tenetur itaque reprehenderit fugit sunt deserunt.', 169, 0, '2025-05-23 04:52:14', '2025-01-07 02:58:06', 'bit-environmental'),
	(14, 48, 3, 'Dignissimos vero iure dolore impedit cumque deserunt excepturi.', 'Illum hic dolor eos fugit nam doloremque. Ipsa incidunt nobis maxime mollitia ut.\r\n\r\nIn tempora recusandae sed ex dolores. Velit expedita minus nemo nostrum pariatur.\r\n\r\nMollitia tempore blanditiis exercitationem. Officia molestias assumenda non placeat ipsa.', 704, 0, '2025-06-21 01:57:04', '2025-04-27 23:00:48', 'become-age-indeed'),
	(15, 22, 1, 'Cum expedita nisi ipsa exercitationem.', 'Harum voluptatibus hic laboriosam libero harum.\r\n\r\nArchitecto illum veritatis vel ad fugiat. Aliquid repudiandae necessitatibus mollitia natus.\r\n\r\nSequi eveniet voluptate est tenetur nemo temporibus. Repellendus pariatur in doloribus placeat.', 101, 1, '2025-07-07 14:55:56', '2025-03-19 19:57:11', 'believe-us-game'),
	(16, 6, 5, 'Saepe autem laborum hic atque quod.', 'Hic quaerat suscipit distinctio. Exercitationem atque quibusdam placeat rem quis.\r\n\r\nAlias ipsam asperiores. Voluptatum velit tempore dolores delectus.\r\n\r\nSed dolorum possimus.', 68, 1, '2025-02-27 17:23:42', '2025-01-23 19:07:23', 'see-research-such'),
	(17, 20, 2, 'Natus quo fuga totam deserunt laudantium praesentium.', 'Magnam mollitia saepe consequuntur hic.\r\n\r\nSunt beatae quaerat.\r\n\r\nIllum fugiat autem hic labore nulla. Dignissimos nesciunt sint dolorem nihil ducimus itaque.', 175, 1, '2025-07-19 21:34:45', '2025-03-11 03:37:06', 'either-your-he-than'),
	(18, 23, 4, 'Placeat ipsum praesentium ullam modi ratione.', 'Officia eius velit error. Dolores nostrum optio facere architecto ipsa vero. Voluptates cumque quod illum omnis.\r\n\r\nAb velit odit similique optio occaecati. Architecto blanditiis modi.\r\n\r\nPlaceat doloremque id nulla aliquid. Architecto nulla corrupti suscipit assumenda a modi.', 315, 0, '2025-07-23 19:12:32', '2025-08-29 17:35:29', 'attorney-music'),
	(19, 29, 2, 'Officia totam doloribus officiis necessitatibus eveniet.', 'Vero adipisci porro deserunt eligendi illum velit. Maiores aliquid sit consequuntur.\r\n\r\nCommodi soluta iusto dicta molestiae possimus eum. Minus quam numquam nulla beatae dolorum.\r\n\r\nAutem libero corrupti minima est harum. Sequi animi repellat sint molestias non hic. Velit sint commodi provident.', 697, 0, '2025-04-07 18:33:12', '2025-08-06 16:41:35', 'put-fly-character'),
	(20, 50, 2, 'Aperiam praesentium praesentium perferendis minus.', 'Quae a dolorum molestias totam illo occaecati earum. Atque nulla amet.\r\n\r\nUllam quo voluptatem perferendis rem. Quod dicta reiciendis officiis consequatur deserunt laborum. Explicabo id magnam vitae.\r\n\r\nReprehenderit pariatur molestiae hic expedita. Accusamus voluptates sit animi. Aut eum nostrum ut. Dignissimos enim enim tempore.', 516, 0, '2025-05-16 16:30:48', '2025-07-14 03:29:43', 'rather-through');

-- Dumping structure for table academy_lite.forum_thread_views
CREATE TABLE IF NOT EXISTS `forum_thread_views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL,
  `viewed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_view` (`thread_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `forum_thread_views_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_thread_views_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.forum_thread_views: ~10 rows (approximately)
INSERT INTO `forum_thread_views` (`id`, `thread_id`, `user_id`, `viewed_at`) VALUES
	(1, 1001, 1, '2025-09-16 11:12:28'),
	(2, 1001, 2, '2025-09-16 11:12:28'),
	(3, 1001, 3, '2025-09-16 11:12:28'),
	(4, 1002, 1, '2025-09-16 11:12:28'),
	(5, 1002, 4, '2025-09-16 11:12:28'),
	(6, 1002, 5, '2025-09-16 11:12:28'),
	(7, 1003, 2, '2025-09-16 11:12:28'),
	(8, 1003, 3, '2025-09-16 11:12:28'),
	(9, 1003, 4, '2025-09-16 11:12:28'),
	(10, 1003, 5, '2025-09-16 11:12:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_classes: ~3 rows (approximately)
INSERT INTO `free_classes` (`id`, `title`, `description`, `thumbnail`, `level`, `category`, `duration`, `mentor_id`, `max_students`, `start_date`, `end_date`, `status`, `online_meet_link`, `created_at`, `updated_at`) VALUES
	(1, 'Pengenalan Teknologi Dasar', 'Kelas gratis untuk pemula yang ingin mengenal teknologi sehari-hari, mulai dari penggunaan komputer, internet, dan aplikasi dasar.', 'https://kidsintech.org/wp-content/uploads/2023/02/Kids-in-tech-donation-pic-1024x683.jpg', 'Dasar', 'Teknologi', 3, NULL, 100, '2025-09-20', '2025-09-27', 'Published', 'https://meet.example.com/tech-basic', '2025-09-16 12:10:19', '2025-09-16 12:12:14'),
	(2, 'Belajar Internet untuk Pemula', 'Kelas ini membimbing peserta memahami penggunaan internet secara aman, termasuk browsing, email, dan komunikasi online.', 'https://kids.kaspersky.com/wp-content/uploads/2017/01/internetkids-1040x440.jpg', 'Dasar', 'Teknologi', 3, NULL, 100, '2025-09-25', '2025-10-02', 'Published', 'https://meet.example.com/internet-basic', '2025-09-16 12:10:19', '2025-09-16 12:22:06'),
	(3, 'Dasar Pemrograman dengan Python', 'Kelas ini memperkenalkan konsep pemrograman menggunakan Python dengan cara sederhana, cocok untuk pemula tanpa pengalaman coding.', 'https://i0.wp.com/www.ossblog.org/wp-content/uploads/2018/08/BASIC-screenshot.png', 'Dasar', 'Pemrograman', 3, NULL, 100, '2025-09-30', '2025-10-07', 'Published', 'https://meet.example.com/python-basic', '2025-09-16 12:10:19', '2025-09-16 12:24:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_discussions: ~8 rows (approximately)
INSERT INTO `free_class_discussions` (`id`, `class_id`, `user_id`, `parent_id`, `message`, `created_at`, `updated_at`) VALUES
	(1, 201, 1, NULL, 'Halo teman-teman, ada yang butuh bantuan materi HTML?', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(2, 201, 2, NULL, 'Menurutku bagian CSS cukup tricky, ada yang punya tips?', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(3, 201, 3, NULL, 'Saya kesulitan di JavaScript, terutama event handling.', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(4, 201, 2, 1, 'Saya bisa bantu jelasin dasar-dasar HTML.', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(5, 201, 3, 1, 'Saya juga sempat bingung, tapi coba buka w3schools.', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(6, 201, 4, 2, 'CSS memang susah, terutama flexbox.', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(7, 201, 1, 3, 'Coba latihan pakai addEventListener dulu.', '2025-09-16 11:13:34', '2025-09-16 11:13:34'),
	(8, 201, 2, 3, 'Betul, dan jangan lupa console.log biar mudah debug.', '2025-09-16 11:13:34', '2025-09-16 11:13:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_enrollments: ~10 rows (approximately)
INSERT INTO `free_class_enrollments` (`id`, `class_id`, `student_id`, `enrollment_date`, `status`, `progress`, `completion_date`, `created_at`, `updated_at`) VALUES
	(51, 201, 1, '2025-09-16 11:14:14', 'Enrolled', 10, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(52, 201, 2, '2025-09-16 11:14:14', 'Completed', 100, '2025-09-16 11:14:14', '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(53, 201, 3, '2025-09-16 11:14:14', 'Dropped', 20, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(54, 202, 4, '2025-09-16 11:14:14', 'Enrolled', 0, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(55, 202, 5, '2025-09-16 11:14:14', 'Enrolled', 50, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(56, 202, 6, '2025-09-16 11:14:14', 'Completed', 100, '2025-09-16 11:14:14', '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(57, 203, 7, '2025-09-16 11:14:14', 'Enrolled', 30, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(58, 203, 8, '2025-09-16 11:14:14', 'Dropped', 5, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(59, 203, 9, '2025-09-16 11:14:14', 'Enrolled', 70, NULL, '2025-09-16 11:14:14', '2025-09-16 11:14:14'),
	(60, 203, 10, '2025-09-16 11:14:14', 'Completed', 100, '2025-09-16 11:14:14', '2025-09-16 11:14:14', '2025-09-16 11:14:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_materials: ~8 rows (approximately)
INSERT INTO `free_class_materials` (`id`, `class_id`, `title`, `description`, `content_type`, `content`, `order`, `created_at`, `updated_at`) VALUES
	(1, 201, 'Pendahuluan HTML', 'Dasar-dasar HTML untuk pemula', 'text', 'HTML adalah bahasa markup...', 1, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(2, 201, 'Video: Struktur Dasar HTML', 'Penjelasan tentang struktur dokumen HTML', 'video', 'https://youtube.com/example-html', 2, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(3, 201, 'Tag Dasar HTML', 'Belajar tag <p>, <h1> - <h6>, <a>', 'pdf', 'https://example.com/html-tags.pdf', 3, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(4, 201, 'Latihan Membuat Halaman HTML', 'Tugas pertama membuat halaman sederhana', 'text', 'Buatlah halaman berisi judul dan paragraf.', 4, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(5, 201, 'Pendahuluan CSS', 'Dasar styling dengan CSS', 'text', 'CSS digunakan untuk mengatur tampilan...', 5, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(6, 201, 'Video: CSS Layout', 'Belajar layout dengan flexbox dan grid', 'video', 'https://youtube.com/example-css', 6, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(7, 201, 'Materi Tambahan CSS', 'Dokumentasi CSS resmi dari MDN', 'link', 'https://developer.mozilla.org/en-US/docs/Web/CSS', 7, '2025-09-16 11:15:14', '2025-09-16 11:15:14'),
	(8, 201, 'Latihan CSS', 'Praktek membuat halaman dengan style', 'text', 'Tambahkan style pada halaman HTML yang sudah dibuat.', 8, '2025-09-16 11:15:14', '2025-09-16 11:15:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.free_class_progress: ~12 rows (approximately)
INSERT INTO `free_class_progress` (`id`, `enrollment_id`, `material_id`, `status`, `last_accessed`, `completion_date`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Completed', '2025-09-16 11:15:55', '2025-09-16 11:15:55', '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(2, 1, 2, 'In Progress', '2025-09-16 11:15:55', NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(3, 1, 3, 'Not Started', NULL, NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(4, 1, 4, 'Not Started', NULL, NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(5, 2, 1, 'Completed', '2025-09-16 11:15:55', '2025-09-16 11:15:55', '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(6, 2, 2, 'Completed', '2025-09-16 11:15:55', '2025-09-16 11:15:55', '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(7, 2, 3, 'In Progress', '2025-09-16 11:15:55', NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(8, 2, 4, 'Not Started', NULL, NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(9, 3, 1, 'In Progress', '2025-09-16 11:15:55', NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(10, 3, 2, 'Not Started', NULL, NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(11, 3, 3, 'Not Started', NULL, NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55'),
	(12, 3, 4, 'Not Started', NULL, NULL, '2025-09-16 11:15:55', '2025-09-16 11:15:55');

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

-- Dumping data for table academy_lite.guru_kelas: ~8 rows (approximately)
INSERT INTO `guru_kelas` (`id`, `guru_id`, `kelas_id`, `assigned_at`, `status`) VALUES
	(1, 101, 301, '2025-09-16 11:16:25', 'Aktif'),
	(2, 102, 301, '2025-09-16 11:16:25', 'Aktif'),
	(3, 103, 302, '2025-09-16 11:16:25', 'Aktif'),
	(4, 104, 303, '2025-09-16 11:16:25', 'Aktif'),
	(5, 101, 304, '2025-09-16 11:16:25', 'Tidak Aktif'),
	(6, 102, 302, '2025-09-16 11:16:25', 'Aktif'),
	(7, 103, 303, '2025-09-16 11:16:25', 'Tidak Aktif'),
	(8, 104, 304, '2025-09-16 11:16:25', 'Aktif');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.jadwal_kelas: ~50 rows (approximately)
INSERT INTO `jadwal_kelas` (`id`, `kelas_id`, `pertemuan_ke`, `class_type`, `guru_id`, `judul_pertemuan`, `tanggal_pertemuan`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, 'premium', NULL, 'In non optio quo velit nisi.', '2025-08-13', '08:00:00', '09:30:00', '2025-02-16 09:16:04', '2025-04-14 09:08:53'),
	(2, 10, 14, 'gratis', 34, 'Ex occaecati eveniet occaecati.', '2025-08-24', '08:00:00', '09:30:00', '2025-01-19 05:44:41', '2025-07-21 05:39:25'),
	(3, 7, 13, NULL, 10, 'Assumenda tempora deleniti recusandae nihil eaque ex.', '2025-03-02', '08:00:00', '09:30:00', '2025-04-02 14:51:19', '2025-08-08 20:13:00'),
	(4, 6, 3, 'premium', NULL, 'Molestiae velit vel possimus deserunt sequi ut.', '2025-03-26', '08:00:00', '09:30:00', '2025-05-12 18:38:31', '2025-09-11 12:01:16'),
	(5, 7, 18, 'gratis', NULL, 'Laborum deserunt eum laudantium quasi.', '2025-05-19', '08:00:00', '09:30:00', '2025-03-26 09:56:59', '2025-05-02 08:59:30'),
	(6, 10, 3, 'gratis', NULL, 'Quis aut soluta placeat.', '2025-08-24', '08:00:00', '09:30:00', '2025-02-08 23:55:37', '2025-08-04 10:54:34'),
	(7, 10, 10, NULL, NULL, 'Iusto dicta veritatis beatae impedit.', '2025-08-09', '08:00:00', '09:30:00', '2025-07-10 02:42:56', '2025-01-11 01:31:30'),
	(8, 9, 2, NULL, NULL, 'Quam consequatur rem corporis cumque.', '2025-05-27', '08:00:00', '09:30:00', '2025-03-21 10:58:26', '2025-09-15 10:30:17'),
	(9, 4, 4, NULL, NULL, 'Non necessitatibus dignissimos sunt.', '2025-06-16', '08:00:00', '09:30:00', '2025-03-25 12:46:07', '2025-04-21 16:00:19'),
	(10, 8, 4, NULL, NULL, 'Ipsa perferendis rerum quo.', '2025-07-09', '08:00:00', '09:30:00', '2025-04-19 20:16:47', '2025-01-10 05:44:20'),
	(11, 4, 15, NULL, 42, 'Occaecati consectetur quae cumque quo.', '2025-06-07', '08:00:00', '09:30:00', '2025-03-20 07:02:31', '2025-03-27 11:48:25'),
	(12, 5, 7, 'gratis', NULL, 'Occaecati necessitatibus minima eaque iste culpa hic.', '2025-05-20', '08:00:00', '09:30:00', '2025-06-07 03:30:31', '2025-05-06 16:00:17'),
	(13, 6, 20, 'gratis', NULL, 'Sequi temporibus vitae culpa illum sequi reprehenderit distinctio.', '2025-01-03', '08:00:00', '09:30:00', '2025-06-28 22:03:15', '2025-04-28 17:32:28'),
	(14, 1, 10, NULL, NULL, 'Non ipsum a fugiat perferendis enim minus.', '2025-04-08', '08:00:00', '09:30:00', '2025-01-12 23:30:20', '2025-01-18 19:41:57'),
	(15, 9, 7, NULL, 42, 'Distinctio eveniet id animi possimus voluptatum dolorem.', '2025-03-29', '08:00:00', '09:30:00', '2025-04-05 06:15:02', '2025-02-23 03:08:22'),
	(16, 9, 1, 'gratis', NULL, 'Assumenda neque corporis unde.', '2025-02-14', '08:00:00', '09:30:00', '2025-07-30 06:43:01', '2025-04-24 12:59:32'),
	(17, 2, 10, 'gratis', NULL, 'Deserunt consectetur consequatur dicta accusamus quia.', '2025-08-03', '08:00:00', '09:30:00', '2025-01-16 06:39:37', '2025-02-10 14:24:17'),
	(18, 7, 14, 'gratis', 39, 'Nulla ipsum saepe rem veniam magni.', '2025-06-22', '08:00:00', '09:30:00', '2025-04-14 16:39:07', '2025-02-24 14:32:41'),
	(19, 5, 11, NULL, NULL, 'Deserunt iusto distinctio dolorum.', '2025-09-04', '08:00:00', '09:30:00', '2025-06-11 14:43:08', '2025-08-28 21:22:05'),
	(20, 9, 14, NULL, NULL, 'Cum quae illo aperiam odit aliquid.', '2025-04-16', '08:00:00', '09:30:00', '2025-02-05 04:37:58', '2025-05-18 14:50:59'),
	(21, 8, 6, 'premium', 42, 'Dicta autem nisi pariatur.', '2025-07-04', '08:00:00', '09:30:00', '2025-07-23 09:25:35', '2025-01-26 06:18:54'),
	(22, 10, 2, 'gratis', NULL, 'Nulla illo excepturi enim harum quas similique.', '2025-06-15', '08:00:00', '09:30:00', '2025-01-20 19:28:20', '2025-09-08 06:57:42'),
	(23, 7, 7, 'premium', NULL, 'Eum inventore ea deleniti aspernatur iure.', '2025-03-14', '08:00:00', '09:30:00', '2025-06-23 10:06:53', '2025-01-26 12:47:49'),
	(24, 1, 4, 'gratis', 34, 'Veniam sequi natus quae atque.', '2025-05-12', '08:00:00', '09:30:00', '2025-06-07 00:26:50', '2025-04-24 18:07:01'),
	(25, 9, 18, 'gratis', 34, 'Eveniet libero labore vero porro optio quam sequi.', '2025-05-27', '08:00:00', '09:30:00', '2025-05-25 00:20:51', '2025-07-05 18:14:23'),
	(26, 10, 15, 'premium', NULL, 'Voluptate illo voluptatibus sunt id illo.', '2025-05-03', '08:00:00', '09:30:00', '2025-07-28 23:25:23', '2025-06-30 15:16:16'),
	(27, 3, 4, 'gratis', 34, 'Perferendis dolores ratione eius in.', '2025-03-24', '08:00:00', '09:30:00', '2025-06-30 23:57:03', '2025-03-11 11:18:32'),
	(28, 7, 7, NULL, NULL, 'Laborum voluptate ut cum.', '2025-05-11', '08:00:00', '09:30:00', '2025-06-12 20:07:28', '2025-04-13 13:34:08'),
	(29, 3, 15, 'gratis', NULL, 'Asperiores nesciunt tenetur quis voluptatum blanditiis dolorem.', '2025-08-27', '08:00:00', '09:30:00', '2025-09-05 10:44:54', '2025-08-02 06:37:23'),
	(30, 10, 10, 'premium', NULL, 'Repellendus perferendis occaecati labore debitis facere.', '2025-03-18', '08:00:00', '09:30:00', '2025-06-01 06:10:50', '2025-05-06 18:33:25'),
	(31, 5, 11, NULL, NULL, 'Commodi amet nam itaque aliquam ut quae.', '2025-05-20', '08:00:00', '09:30:00', '2025-05-23 19:50:20', '2025-02-15 03:40:54'),
	(32, 5, 7, NULL, NULL, 'Quo placeat delectus quam.', '2025-05-31', '08:00:00', '09:30:00', '2025-03-20 14:26:21', '2025-09-01 01:29:50'),
	(33, 1, 17, 'premium', NULL, 'Corporis nisi laborum doloremque explicabo fuga.', '2025-01-18', '08:00:00', '09:30:00', '2025-08-20 23:57:18', '2025-01-04 06:14:06'),
	(34, 5, 3, 'premium', NULL, 'Asperiores in aliquid adipisci nobis alias ab.', '2025-09-05', '08:00:00', '09:30:00', '2025-08-20 06:49:27', '2025-02-02 23:11:36'),
	(35, 1, 18, 'gratis', NULL, 'Reiciendis non aut totam eos.', '2025-07-10', '08:00:00', '09:30:00', '2025-05-13 11:27:28', '2025-06-23 09:46:16'),
	(36, 4, 4, 'gratis', NULL, 'Repellendus deleniti illo sunt maxime sunt quod culpa.', '2025-09-09', '08:00:00', '09:30:00', '2025-04-03 22:06:19', '2025-01-30 09:28:16'),
	(37, 2, 5, 'gratis', 10, 'Harum adipisci dolore harum ea perspiciatis amet.', '2025-06-13', '08:00:00', '09:30:00', '2025-07-29 20:31:08', '2025-08-18 05:30:48'),
	(38, 9, 2, 'premium', NULL, 'Ut dolor praesentium aliquid dolorem quasi earum fugiat.', '2025-05-18', '08:00:00', '09:30:00', '2025-01-22 02:37:05', '2025-08-24 01:25:58'),
	(39, 1, 8, NULL, NULL, 'Dolor fugiat atque placeat dicta.', '2025-04-26', '08:00:00', '09:30:00', '2024-12-31 21:29:32', '2025-07-20 00:13:57'),
	(40, 9, 1, 'premium', 34, 'Ad aspernatur laboriosam quibusdam excepturi totam amet.', '2025-08-31', '08:00:00', '09:30:00', '2025-05-31 06:46:26', '2025-04-17 14:05:52'),
	(41, 7, 16, 'gratis', NULL, 'Velit excepturi necessitatibus fuga tempore eaque ullam.', '2025-06-08', '08:00:00', '09:30:00', '2025-05-27 17:09:49', '2025-06-30 15:51:53'),
	(42, 4, 17, NULL, 39, 'Cupiditate rerum laboriosam aliquid repudiandae enim cumque.', '2025-03-10', '08:00:00', '09:30:00', '2025-04-18 08:32:25', '2025-09-14 13:50:24'),
	(43, 4, 20, 'premium', 10, 'Perspiciatis quisquam ducimus illum.', '2025-08-04', '08:00:00', '09:30:00', '2025-07-01 11:42:47', '2025-05-15 11:55:22'),
	(44, 1, 4, 'premium', NULL, 'Provident amet quisquam amet officiis enim.', '2025-05-28', '08:00:00', '09:30:00', '2025-06-10 23:58:53', '2025-08-20 20:15:25'),
	(45, 1, 11, 'premium', NULL, 'Perferendis soluta maxime neque ut.', '2025-08-04', '08:00:00', '09:30:00', '2025-07-24 18:00:52', '2025-07-03 20:39:13'),
	(46, 8, 4, NULL, NULL, 'Provident excepturi beatae quas nostrum ex.', '2025-08-06', '08:00:00', '09:30:00', '2025-08-30 12:03:38', '2025-03-16 12:11:54'),
	(47, 3, 6, NULL, NULL, 'Ea neque non nesciunt vero debitis.', '2025-07-21', '08:00:00', '09:30:00', '2025-06-01 22:20:53', '2025-01-06 02:42:33'),
	(48, 2, 15, 'premium', NULL, 'Natus nostrum suscipit deserunt doloribus cupiditate.', '2025-02-16', '08:00:00', '09:30:00', '2025-09-14 00:33:37', '2025-03-19 11:57:48'),
	(49, 6, 5, 'gratis', NULL, 'Eveniet perferendis doloribus sequi.', '2025-08-31', '08:00:00', '09:30:00', '2025-01-27 04:23:36', '2025-08-01 09:38:07'),
	(50, 3, 19, NULL, NULL, 'Labore beatae assumenda voluptate at voluptatum.', '2025-07-06', '08:00:00', '09:30:00', '2025-01-20 19:36:33', '2025-03-04 07:44:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.kelas_programming: ~10 rows (approximately)
INSERT INTO `kelas_programming` (`id`, `nama_kelas`, `deskripsi`, `level`, `bahasa_program`, `durasi`, `harga`, `gambar`, `status`, `online_meet_link`, `created_at`, `updated_at`) VALUES
	(1, 'Kelas C# Dasar', 'Distinctio nisi dicta minus neque. Placeat dolore eaque a. Necessitatibus deleniti consectetur officia hic sit.', 'Menengah', 'C#', 80, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Aktif', NULL, '2025-05-04 15:22:03', '2025-09-16 12:26:38'),
	(2, 'Kelas JavaScript Lanjutan', 'Harum nobis porro dolor.', 'Dasar', 'C++', 80, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Tidak Aktif', NULL, '2025-01-06 15:56:08', '2025-09-16 12:26:40'),
	(3, 'Kelas PHP Lanjutan', 'Explicabo quam alias delectus quidem. Assumenda asperiores voluptate veniam. Inventore quaerat sapiente explicabo ea nostrum nesciunt.', 'Lanjutan', 'C++', 71, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Aktif', NULL, '2025-09-03 16:44:40', '2025-09-16 12:26:41'),
	(4, 'Kelas C# Lanjutan', 'Cupiditate suscipit natus natus possimus tempore. Praesentium perspiciatis laborum dolorem.', 'Menengah', 'Python', 30, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Tidak Aktif', NULL, '2025-02-08 06:10:04', '2025-09-16 12:26:42'),
	(5, 'Kelas JavaScript Menengah', 'Ea quia doloribus odio voluptatem occaecati. Natus explicabo velit ipsam nulla sunt. Ipsum optio quod dolor non ipsa.', 'Lanjutan', 'Ruby', 53, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Tidak Aktif', NULL, '2025-04-05 13:20:34', '2025-09-16 12:26:43'),
	(6, 'Kelas Go Dasar', 'Atque sapiente excepturi maiores voluptatum magnam nihil. Minus pariatur quos. Voluptatum labore labore et illo delectus quas. Iure ipsam sequi accusantium molestiae.', 'Menengah', 'Ruby', 61, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Tidak Aktif', NULL, '2025-06-23 00:34:05', '2025-09-16 12:26:44'),
	(7, 'Kelas Python Lanjutan1', 'Sint voluptate repellendus illo. Inventore numquam amet rerum. Inventore omnis sapiente vitae ducimus veniam.', 'Lanjutan', 'C#', 89, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Aktif', NULL, '2025-04-10 09:01:36', '2025-09-16 12:26:45'),
	(8, 'Kelas Python Lanjutan', 'Natus autem unde dicta iste. Quo culpa porro porro itaque sit.', 'Dasar', 'C#', 82, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Aktif', 'https://cv.go.id/', '2025-05-14 16:23:15', '2025-09-16 12:26:46'),
	(9, 'Kelas Go Menengah', 'Occaecati culpa magnam possimus nisi repellat aliquam nihil. Autem labore voluptatibus fugit.', 'Menengah', 'JavaScript', 87, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Aktif', NULL, '2025-05-27 16:04:15', '2025-09-16 12:26:48'),
	(10, 'Kelas PHP Menengah', 'Impedit tempora explicabo adipisci iste. Deleniti omnis velit.', 'Dasar', 'PHP', 80, 250000.00, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/How-to-Choose-the-Right-Programming-Language-for-a-New-Project.jpg', 'Tidak Aktif', NULL, '2025-04-22 22:19:14', '2025-09-16 12:26:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.materi: ~8 rows (approximately)
INSERT INTO `materi` (`id`, `kelas_id`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 301, 'Pengenalan HTML', 'Belajar dasar-dasar struktur HTML.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(2, 301, 'Tag Dasar HTML', 'Mengenal heading, paragraf, link, dan gambar.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(3, 301, 'Pengenalan CSS', 'Dasar styling untuk mempercantik halaman web.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(4, 301, 'CSS Layout', 'Membuat layout dengan Flexbox dan Grid.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(5, 302, 'Pengenalan JavaScript', 'Memahami variabel, tipe data, dan operator.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(6, 302, 'Fungsi & Scope', 'Mempelajari cara kerja fungsi dan lingkup variabel.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(7, 302, 'DOM Manipulation', 'Mengubah elemen HTML dengan JavaScript.', '2025-09-16 11:16:55', '2025-09-16 11:16:55'),
	(8, 302, 'Event Handling', 'Menangani interaksi pengguna dengan event listener.', '2025-09-16 11:16:55', '2025-09-16 11:16:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.materi_parts: ~7 rows (approximately)
INSERT INTO `materi_parts` (`id`, `materi_id`, `part_order`, `part_type`, `part_title`, `part_content`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'video', 'Video Pengantar HTML', 'https://youtube.com/example-html-intro', '2025-09-16 11:17:25', '2025-09-16 11:17:25'),
	(2, 1, 2, 'pdf', 'Slide Materi HTML', 'https://example.com/slides/html-intro.pdf', '2025-09-16 11:17:25', '2025-09-16 11:17:25'),
	(3, 1, 3, 'link', 'Dokumentasi MDN HTML', 'https://developer.mozilla.org/en-US/docs/Web/HTML', '2025-09-16 11:17:25', '2025-09-16 11:17:25'),
	(4, 2, 1, 'image', 'Contoh Struktur HTML', 'https://example.com/images/html-structure.png', '2025-09-16 11:17:25', '2025-09-16 11:17:25'),
	(5, 2, 2, 'video', 'Video Tutorial Tag HTML', 'https://youtube.com/example-html-tags', '2025-09-16 11:17:25', '2025-09-16 11:17:25'),
	(6, 2, 3, 'pdf', 'Ringkasan Tag Dasar', 'https://example.com/pdf/html-tags.pdf', '2025-09-16 11:17:25', '2025-09-16 11:17:25'),
	(7, 2, 4, 'link', 'Referensi W3Schools HTML', 'https://www.w3schools.com/html/', '2025-09-16 11:17:25', '2025-09-16 11:17:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.materi_progress: ~9 rows (approximately)
INSERT INTO `materi_progress` (`id`, `materi_id`, `siswa_id`, `status`, `last_accessed`, `completion_date`, `created_at`, `updated_at`) VALUES
	(1, 1, 201, 'Completed', '2025-09-16 11:17:54', '2025-09-16 11:17:54', '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(2, 2, 201, 'In Progress', '2025-09-16 11:17:54', NULL, '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(3, 3, 201, 'Not Started', NULL, NULL, '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(4, 1, 202, 'In Progress', '2025-09-16 11:17:54', NULL, '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(5, 2, 202, 'Not Started', NULL, NULL, '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(6, 3, 202, 'Not Started', NULL, NULL, '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(7, 1, 203, 'Completed', '2025-09-16 11:17:54', '2025-09-16 11:17:54', '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(8, 2, 203, 'Completed', '2025-09-16 11:17:54', '2025-09-16 11:17:54', '2025-09-16 11:17:54', '2025-09-16 11:17:54'),
	(9, 3, 203, 'In Progress', '2025-09-16 11:17:54', NULL, '2025-09-16 11:17:54', '2025-09-16 11:17:54');

-- Dumping structure for table academy_lite.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `class_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Transfer','Cash','Other') NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `bank_account_id` int DEFAULT NULL,
  `payment_description` text,
  `user_bank_name` varchar(100) DEFAULT NULL,
  `user_account_holder` varchar(100) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `invoice_generated_at` timestamp NULL DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL COMMENT 'Path to proof image',
  `status` enum('Pending','Verified','Rejected') NOT NULL DEFAULT 'Pending',
  `enrollment_status` enum('Not Enrolled','Enrolled','Access Revoked') NOT NULL DEFAULT 'Not Enrolled',
  `verified_by` int DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `notes` text,
  `enrollment_notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `class_id` (`class_id`),
  KEY `verified_by` (`verified_by`),
  KEY `fk_payments_bank_account` (`bank_account_id`),
  CONSTRAINT `fk_payments_bank_account` FOREIGN KEY (`bank_account_id`) REFERENCES `company_bank_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.payments: ~20 rows (approximately)
INSERT INTO `payments` (`id`, `user_id`, `class_id`, `amount`, `payment_method`, `bank_name`, `account_number`, `bank_account_id`, `payment_description`, `user_bank_name`, `user_account_holder`, `invoice_number`, `invoice_generated_at`, `payment_proof`, `status`, `enrollment_status`, `verified_by`, `verified_at`, `notes`, `enrollment_notes`, `created_at`, `updated_at`) VALUES
	(1, 39, 10, 807655.58, 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verified', 'Enrolled', NULL, NULL, 'Sequi quia fugit non quaerat. Eligendi molestias eligendi dolorem repellat accusantium tempora. Quam excepturi laboriosam corrupti quod.', NULL, '2025-01-22 15:19:46', '2025-02-22 20:14:52'),
	(2, 4, 2, 2212788.49, 'Cash', NULL, 'GB08TMQD298101613926', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rejected', 'Access Revoked', 31, NULL, 'Suscipit autem architecto omnis harum neque. Soluta error illum inventore fuga quas.', 'Error consequatur quaerat eveniet at harum mollitia.', '2025-02-18 02:53:29', '2025-02-05 01:16:04'),
	(3, 32, 3, 3423002.35, 'Cash', NULL, 'GB07WMQZ937111504789', NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/payments/proof_3.jpg', 'Pending', 'Not Enrolled', 10, NULL, 'Libero ratione aspernatur quis aspernatur nulla perspiciatis ipsa. Dolorum corrupti deleniti consequuntur illo est.', 'Beatae illo fugit non adipisci voluptate.', '2025-06-05 14:01:00', '2025-08-24 16:48:11'),
	(4, 35, 9, 4412084.71, 'Transfer', 'UD Rahayu (Persero) Tbk', 'GB88RDIQ392172080292', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rejected', 'Enrolled', NULL, '2025-07-17 11:39:58', 'Quam atque illum deserunt nobis vero eos magni. Sit nam tempora voluptate corrupti. Vitae eaque magnam.', 'Quidem dolore quam praesentium officiis.', '2025-04-21 03:42:24', '2025-03-17 16:16:14'),
	(5, 29, 10, 1758447.31, 'Transfer', NULL, 'GB64TTBC973831396871', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rejected', 'Access Revoked', NULL, '2025-06-20 14:51:15', 'Vitae tenetur harum possimus. Ipsa provident harum doloremque tenetur eveniet consequuntur. Voluptates quae autem illo.', 'Similique consectetur assumenda delectus aliquam sequi asperiores.', '2025-05-15 23:19:12', '2025-01-01 14:32:46'),
	(6, 30, 10, 3095006.15, 'Other', NULL, 'GB73OOZH380156210910', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'Enrolled', NULL, '2025-03-09 17:37:22', 'Quibusdam libero minus omnis. Doloremque aliquam fugit illo. Voluptatem reprehenderit illum doloremque.', NULL, '2025-05-21 17:21:14', '2025-07-24 04:08:27'),
	(7, 42, 10, 4403751.67, 'Other', 'Perum Najmudin Pradana (Persero) Tbk', 'GB12OHYV132521454410', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rejected', 'Enrolled', 23, '2025-06-15 00:58:11', 'Accusamus ad assumenda repellat officiis. Alias mollitia accusantium vero ratione dicta. Ratione delectus vel qui.', 'Earum in vero suscipit.', '2025-07-28 08:40:45', '2025-08-18 06:57:43'),
	(8, 1, 1, 1840868.68, 'Other', 'UD Utami Handayani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/payments/proof_8.jpg', 'Pending', 'Access Revoked', 15, '2025-08-23 15:51:56', NULL, 'Cumque totam corrupti rem quidem.', '2025-03-07 04:15:21', '2025-02-28 00:10:03'),
	(9, 39, 8, 4278717.19, 'Other', NULL, 'GB78AHEK508553384567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verified', 'Not Enrolled', 21, NULL, NULL, 'Odio perferendis eum a exercitationem voluptate.', '2025-04-07 12:42:37', '2025-04-15 01:52:37'),
	(10, 25, 2, 2321370.33, 'Cash', 'Perum Habibi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rejected', 'Not Enrolled', 41, NULL, NULL, NULL, '2025-02-16 00:25:02', '2025-02-13 16:56:30'),
	(11, 32, 6, 2275704.90, 'Transfer', 'CV Nashiruddin Wibowo', 'GB11JEXH352293448160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'Enrolled', NULL, NULL, 'Aut reprehenderit quaerat quaerat dignissimos. Nobis alias voluptatum perferendis optio dolores facere. Ducimus earum corporis iure rem. Magni esse aliquid quidem excepturi omnis.', NULL, '2025-06-20 19:11:57', '2025-01-03 22:43:59'),
	(12, 45, 7, 2175736.33, 'Other', 'CV Prayoga', 'GB77CNDG875053985285', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verified', 'Enrolled', 34, '2025-03-10 22:09:07', NULL, 'Excepturi dolorem velit voluptatum.', '2025-02-24 11:51:59', '2025-09-12 15:02:38'),
	(13, 13, 4, 882069.18, 'Other', 'Perum Susanti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verified', 'Not Enrolled', NULL, '2025-09-04 21:33:13', 'Magni assumenda laboriosam laudantium odio vitae. Ab ab aperiam eius. Error alias necessitatibus.', 'Saepe maxime eligendi.', '2025-07-15 01:33:49', '2025-06-27 02:02:27'),
	(14, 35, 1, 1526729.15, 'Transfer', 'Perum Lailasari Hasanah', 'GB74LUPN255161318593', NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/payments/proof_14.jpg', 'Rejected', 'Access Revoked', NULL, NULL, 'Illo ea commodi fugit iure assumenda. Libero pariatur libero beatae amet.', 'Voluptas sunt eveniet totam maxime cupiditate vero.', '2025-01-19 12:19:21', '2025-03-27 18:43:46'),
	(15, 16, 3, 1457593.90, 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/payments/proof_15.jpg', 'Rejected', 'Access Revoked', 32, NULL, 'Sapiente rem ad perspiciatis. Dignissimos laboriosam asperiores aliquam. Recusandae voluptatibus maiores quo quisquam commodi.', 'Ipsum blanditiis quasi maiores voluptas delectus ratione iste.', '2025-01-18 16:53:38', '2025-01-25 22:29:15'),
	(16, 10, 10, 4283853.63, 'Transfer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'Enrolled', NULL, NULL, 'Facere saepe laudantium esse repellendus doloribus culpa. Corporis odit ullam ab tempora soluta.', 'Esse amet sunt sunt ea.', '2025-04-09 08:57:51', '2025-03-11 04:00:08'),
	(17, 32, 1, 644321.11, 'Cash', 'PD Mulyani Rajasa Tbk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', 'Access Revoked', NULL, '2025-08-05 10:29:17', 'Dicta saepe quam asperiores veritatis ex dolores. Vero quia odit corrupti dicta illo. Velit quisquam dolore ipsam officiis.', 'Aspernatur molestias quod dicta ab quis amet mollitia.', '2025-07-19 12:01:10', '2025-03-12 16:40:45'),
	(18, 46, 3, 4281762.65, 'Cash', 'PD Budiman Nainggolan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verified', 'Not Enrolled', 37, NULL, 'Quaerat in similique quod repellat eligendi. Animi quod deleniti soluta magni.', 'Ratione occaecati corrupti accusantium earum.', '2025-05-20 01:01:51', '2025-07-26 10:48:55'),
	(19, 50, 6, 1154502.08, 'Other', 'CV Sinaga Tbk', 'GB94IVUZ262891561523', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verified', 'Enrolled', NULL, '2025-06-20 00:52:09', 'Architecto est expedita veritatis porro tenetur hic. Odio repellat architecto.', 'Odio eligendi aspernatur beatae eum quasi corrupti.', '2025-09-16 09:25:29', '2025-02-04 10:21:06'),
	(20, 8, 7, 4240199.47, 'Transfer', 'PT Pudjiastuti Saragih Tbk', 'GB07SINA070164002674', NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/payments/proof_20.jpg', 'Pending', 'Access Revoked', 21, NULL, 'Doloremque impedit laudantium impedit. Similique assumenda maxime dolores. Asperiores minus quisquam neque.', NULL, '2025-01-14 15:19:12', '2025-09-02 08:21:47');

-- Dumping structure for table academy_lite.premium_class_enrollments
CREATE TABLE IF NOT EXISTS `premium_class_enrollments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `student_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Active','Suspended','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `access_granted_by` int DEFAULT NULL COMMENT 'Admin who granted access',
  `access_granted_at` timestamp NULL DEFAULT NULL,
  `access_expires_at` timestamp NULL DEFAULT NULL COMMENT 'Optional expiration date',
  `progress` int NOT NULL DEFAULT '0' COMMENT 'Progress percentage',
  `completion_date` timestamp NULL DEFAULT NULL,
  `notes` text COMMENT 'Admin notes about enrollment',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.premium_class_enrollments: ~30 rows (approximately)
INSERT INTO `premium_class_enrollments` (`id`, `class_id`, `student_id`, `payment_id`, `enrollment_date`, `status`, `access_granted_by`, `access_granted_at`, `access_expires_at`, `progress`, `completion_date`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 5, 40, 8, '2025-02-06 01:00:41', 'Cancelled', 33, NULL, '2025-07-19 02:26:49', 91, NULL, 'Facere beatae sapiente nisi ab eum recusandae. Et occaecati minima quae ad doloribus. Commodi at ullam voluptates quisquam quo voluptatum.', '2025-09-14 19:58:24', '2025-05-25 07:09:19'),
	(2, 3, 50, 16, '2025-01-07 23:54:30', 'Pending', 39, NULL, '2025-09-01 09:42:49', 42, NULL, 'Ipsum consequuntur non natus officiis minima quo. Quae magnam commodi cum velit.', '2025-04-03 08:16:57', '2025-05-28 04:58:03'),
	(3, 8, 3, 18, '2025-02-23 01:18:56', 'Completed', NULL, '2025-06-07 22:07:07', '2025-08-27 02:28:45', 24, NULL, 'Neque quos dolorem labore dignissimos. Suscipit fugiat possimus. Molestiae molestias perferendis reprehenderit.', '2025-03-24 01:04:04', '2025-07-14 00:00:54'),
	(4, 1, 25, 20, '2025-04-26 03:23:12', 'Suspended', 34, NULL, '2025-07-02 05:02:56', 4, '2025-06-29 21:22:01', 'Id libero quas ea recusandae. Eveniet in quae eius est eos.', '2025-09-07 02:55:09', '2025-05-29 23:11:39'),
	(5, 4, 6, 17, '2025-05-27 06:19:18', 'Pending', NULL, '2025-08-01 11:28:01', '2025-04-09 20:18:39', 50, NULL, 'Ea non omnis nostrum. Vero ex velit officia perspiciatis.', '2025-08-24 07:10:45', '2025-08-29 18:32:24'),
	(6, 10, 2, 3, '2025-08-13 20:20:01', 'Pending', 16, '2025-09-07 06:09:58', '2025-07-02 07:08:18', 100, NULL, 'Magni consequuntur repudiandae beatae ipsum.', '2025-01-16 18:23:54', '2025-09-15 13:11:47'),
	(7, 9, 2, 2, '2025-06-08 02:06:01', 'Completed', NULL, NULL, NULL, 32, '2025-02-14 14:28:00', 'Est perspiciatis occaecati laboriosam porro officiis. Quos sit eaque rem culpa unde. Accusamus possimus saepe eveniet voluptas repellat error.', '2025-04-02 06:41:59', '2025-03-12 06:34:23'),
	(8, 7, 2, 8, '2025-05-25 12:17:54', 'Cancelled', 8, NULL, NULL, 1, '2025-07-25 17:10:58', 'Voluptate dolores culpa libero autem praesentium quam. Itaque perspiciatis porro quas tenetur nostrum. Alias quae voluptatum.', '2025-07-29 02:45:19', '2025-06-14 06:44:01'),
	(9, 8, 22, 10, '2025-03-31 11:08:47', 'Active', NULL, '2025-01-23 15:35:23', NULL, 88, '2025-08-01 03:27:36', 'Quis sint at labore iusto cum. Ipsum unde est doloribus soluta. Tenetur laboriosam laudantium nobis.', '2025-02-15 14:23:21', '2025-08-30 01:12:34'),
	(10, 10, 38, 2, '2025-08-06 15:19:43', 'Pending', NULL, NULL, '2025-06-03 04:49:35', 79, NULL, NULL, '2025-08-28 07:48:12', '2025-03-24 06:06:41'),
	(11, 10, 9, 8, '2025-08-13 08:20:53', 'Active', NULL, NULL, '2025-03-21 18:37:23', 85, NULL, 'Labore pariatur eligendi dolores. Neque voluptatibus accusantium. Repellat quasi necessitatibus doloribus inventore ad.', '2025-01-22 03:00:18', '2025-09-07 16:02:31'),
	(12, 4, 13, 9, '2025-04-26 20:48:49', 'Completed', NULL, '2025-03-30 12:36:22', '2025-07-26 17:04:41', 82, NULL, NULL, '2025-05-18 22:11:24', '2025-04-03 03:42:24'),
	(13, 1, 36, 10, '2025-09-04 17:06:36', 'Suspended', 39, '2025-05-06 01:09:31', '2025-04-22 08:08:17', 90, NULL, 'Libero tempora excepturi. Neque quisquam impedit quod sint. Ullam consequuntur odit eaque sit reiciendis error.', '2025-05-20 04:37:37', '2025-07-19 16:08:44'),
	(14, 10, 17, 20, '2025-02-05 22:04:58', 'Active', NULL, NULL, '2025-05-29 21:03:42', 27, '2025-02-15 15:11:55', NULL, '2025-05-12 23:09:12', '2025-08-14 15:37:42'),
	(15, 8, 42, 11, '2025-04-25 14:00:32', 'Active', 40, NULL, '2025-05-23 04:57:50', 2, NULL, 'Esse architecto tempore. Alias possimus consequatur pariatur rerum voluptatum. Aspernatur voluptatem molestias corporis eos quibusdam.', '2025-09-05 20:02:34', '2025-01-25 00:44:23'),
	(16, 1, 2, 12, '2025-05-12 23:00:38', 'Completed', NULL, NULL, '2025-02-02 02:04:59', 61, '2025-07-01 06:29:37', 'Excepturi ex temporibus rem vitae quidem tempore. In magnam necessitatibus eligendi ducimus impedit molestias. Culpa fugiat pariatur perspiciatis.', '2025-06-05 08:14:22', '2025-01-28 21:11:46'),
	(17, 4, 27, 20, '2025-03-14 03:57:46', 'Active', 15, NULL, NULL, 87, '2025-05-23 11:12:24', 'Dicta repellendus magni mollitia maxime qui cupiditate eaque.', '2025-03-17 17:51:25', '2025-02-24 23:53:01'),
	(18, 10, 35, 3, '2025-01-15 15:38:43', 'Cancelled', NULL, '2025-06-08 20:57:50', NULL, 59, NULL, NULL, '2025-07-03 00:50:45', '2024-12-31 23:39:08'),
	(19, 5, 49, 19, '2025-01-04 14:34:10', 'Suspended', NULL, NULL, NULL, 35, NULL, 'Amet similique quis quaerat repellat. Rerum voluptatem eaque nostrum non tempora harum.', '2025-03-15 04:19:07', '2025-08-10 16:02:13'),
	(20, 4, 39, 15, '2025-05-28 08:17:38', 'Pending', NULL, NULL, '2025-09-11 22:17:34', 68, '2025-05-04 15:45:26', NULL, '2025-04-30 14:28:13', '2025-07-18 05:10:08'),
	(21, 4, 10, 9, '2025-07-25 16:22:29', 'Active', NULL, NULL, '2025-08-02 00:47:00', 74, '2025-05-10 04:06:06', 'Accusamus veniam sapiente est mollitia. Reprehenderit excepturi nulla ad veritatis delectus eaque.', '2025-05-29 06:01:52', '2025-07-07 11:13:03'),
	(22, 1, 38, 5, '2025-03-19 03:20:37', 'Active', 46, '2025-09-06 04:30:55', NULL, 40, '2025-07-03 23:50:30', NULL, '2025-08-15 04:56:16', '2025-04-12 07:18:22'),
	(23, 7, 32, 11, '2025-09-13 11:45:45', 'Active', NULL, '2025-03-10 05:54:26', '2025-03-29 15:23:36', 94, NULL, 'Itaque rem voluptatem. Amet nostrum fugit repudiandae recusandae.', '2025-04-04 09:10:50', '2025-07-21 19:44:04'),
	(24, 5, 4, 17, '2025-07-09 13:45:55', 'Suspended', NULL, '2025-04-16 23:32:15', NULL, 71, '2025-04-24 08:01:05', 'Earum provident a exercitationem distinctio facere. Impedit eaque cum facere nesciunt.', '2025-01-29 09:22:10', '2025-01-28 14:33:53'),
	(25, 2, 46, 19, '2025-02-25 16:20:26', 'Cancelled', NULL, NULL, '2025-02-16 10:59:50', 36, NULL, 'Dolore earum assumenda ullam consectetur. Tenetur cum temporibus voluptatum suscipit voluptates.', '2025-02-11 11:31:30', '2025-08-02 22:53:42'),
	(26, 3, 10, 15, '2025-04-06 18:22:14', 'Active', 48, NULL, '2025-01-06 06:08:09', 53, NULL, NULL, '2025-05-10 12:47:57', '2025-07-13 11:06:18'),
	(27, 1, 30, 10, '2025-01-25 23:01:42', 'Active', 7, NULL, '2025-03-27 06:18:55', 88, '2025-02-11 19:41:28', 'Quas quod ipsa quia omnis ab. Sint sed quis maiores placeat. Fugit suscipit deserunt quos. Totam libero hic quo autem.', '2025-07-21 22:35:21', '2025-05-28 14:43:10'),
	(28, 1, 4, 12, '2025-08-31 17:07:36', 'Cancelled', 40, NULL, '2025-05-18 14:24:14', 11, NULL, NULL, '2025-07-30 04:30:32', '2025-03-05 16:09:13'),
	(29, 10, 39, 3, '2025-08-18 12:21:25', 'Completed', NULL, '2025-08-02 15:46:36', '2025-04-05 17:33:40', 33, NULL, 'Ducimus at omnis ad nemo. Omnis maxime eligendi debitis iste. Dolores ut rerum dignissimos fuga accusantium voluptates. Quod repellendus fugit.', '2025-02-02 05:12:18', '2025-02-18 09:29:34'),
	(30, 8, 10, 6, '2025-04-09 08:48:01', 'Cancelled', 37, NULL, '2025-03-07 14:37:56', 86, '2025-06-26 10:07:33', 'Deserunt suscipit eaque suscipit tenetur. Vel assumenda ratione nobis dicta.', '2025-02-06 05:48:00', '2025-06-24 20:46:23');

-- Dumping structure for table academy_lite.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.siswa: ~30 rows (approximately)
INSERT INTO `siswa` (`id`, `nis`, `nama_lengkap`, `email`, `no_telepon`, `kelas`, `jurusan`, `alamat`, `foto_profil`, `tanggal_lahir`, `jenis_kelamin`, `status`, `created_at`, `updated_at`) VALUES
	(1, '807303', 'Dalima Gunawan', 'kania62@example.com', '+62 (734) 449-4958', 'XII Teknik Informatika', 'Manajemen Informatika', 'Jalan R.E Martadinata No. 3\r\nTangerang, RI 96660', '/uploads/profiles/student_1.jpg', '2007-10-18', 'P', 'Aktif', '2025-07-11 18:25:40', '2025-07-22 13:40:07'),
	(2, '386021', 'Nilam Rajasa', 'balapati87@example.net', '0838546636', 'X Manajemen Informatika', 'Teknik Informatika', 'Gang HOS. Cokroaminoto No. 3\r\nKendari, SR 06354', '/uploads/profiles/student_2.jpg', '2002-03-02', 'L', 'Tidak Aktif', '2025-01-28 02:23:17', '2025-05-30 01:44:07'),
	(3, '274965', 'Jamal Saefullah', 'kfirgantoro@example.net', '+62-066-269-0876', 'XI Sistem Informasi', 'Teknik Informatika', 'Gang Rajiman No. 960\r\nDepok, JB 94520', '/uploads/profiles/student_3.jpg', '2002-12-20', 'L', 'Tidak Aktif', '2025-09-03 09:55:38', '2025-08-05 22:10:53'),
	(4, '528876', 'Oskar Hartati', 'oktavianimargana@example.org', '+62-0467-083-6274', 'XI Teknik Komputer', 'Teknik Informatika', 'Gg. Merdeka No. 659\r\nSubulussalam, RI 78946', NULL, '2003-05-01', 'L', 'Tidak Aktif', '2025-08-19 20:25:13', '2025-03-20 02:52:10'),
	(5, '892023', 'Jasmin Hutapea, S.E.', 'kemalusada@example.org', '+62 (165) 513 4613', 'XII Sistem Informasi', 'Sistem Informasi', 'Gg. Cihampelas No. 20\r\nTangerang, Bengkulu 89756', '/uploads/profiles/student_5.jpg', '2007-06-28', 'P', 'Lulus', '2025-03-09 06:58:36', '2025-05-12 03:39:32'),
	(6, '948318', 'Karna Setiawan', 'bahuwarnamandasari@example.net', '+62 (084) 041-4001', 'XI Sistem Informasi', 'Sistem Informasi', 'Gg. Moch. Ramdan No. 18\r\nSukabumi, PA 11725', '/uploads/profiles/student_6.jpg', '2002-01-11', 'L', 'Tidak Aktif', '2025-09-04 18:47:55', '2025-03-01 23:18:54'),
	(7, '399100', 'Galak Latupono', 'malika96@example.net', '+62 (010) 724-3558', 'XI Teknik Informatika', 'Sistem Informasi', 'Gg. Jamika No. 46\r\nLubuklinggau, Sumatera Selatan 12901', '/uploads/profiles/student_7.jpg', '2004-08-09', 'L', 'Tidak Aktif', '2025-04-29 18:27:18', '2025-02-22 20:05:51'),
	(8, '955695', 'Ir. Marsito Maheswara', 'yprasetyo@example.net', '088 837 0029', 'XI Manajemen Informatika', 'Sistem Informasi', 'Jalan Waringin No. 5\r\nJambi, JK 71245', '/uploads/profiles/student_8.jpg', '2000-10-16', 'P', 'Tidak Aktif', '2025-03-14 19:46:48', '2025-03-13 15:34:59'),
	(9, '481870', 'Nova Laksita', 'usman74@example.net', '+62 (078) 675 7734', 'XII Teknik Komputer', 'Teknik Komputer', 'Gang S. Parman No. 759\r\nPagaralam, Sumatera Selatan 07758', '/uploads/profiles/student_9.jpg', '2003-12-01', 'P', 'Aktif', '2025-06-12 15:40:35', '2025-08-22 11:20:43'),
	(10, '951306', 'Emin Pranowo', 'agustinachandra@example.com', '+62 (084) 006 3612', 'XII Teknik Informatika', 'Teknik Komputer', 'Jalan Tebet Barat Dalam No. 696\r\nSurabaya, Aceh 90311', '/uploads/profiles/student_10.jpg', '2005-08-20', 'P', 'Lulus', '2025-02-19 21:16:02', '2025-05-09 16:29:37'),
	(11, '811326', 'Puti Wulan Winarno', 'oskar59@example.com', '(0971) 265 1429', 'XII Teknik Informatika', 'Sistem Informasi', 'Gg. Raya Ujungberung No. 241\r\nBogor, Sulawesi Selatan 46846', NULL, '2005-09-18', 'L', 'Lulus', '2025-04-10 14:21:21', '2025-01-16 16:25:57'),
	(12, '480659', 'Nadia Anggriawan', 'lalita08@example.com', '+62 (0110) 574 8175', 'X Teknik Informatika', 'Manajemen Informatika', 'Jl. Jamika No. 22\r\nTomohon, BA 30775', NULL, '2004-10-23', 'P', 'Lulus', '2025-03-26 03:49:36', '2025-06-19 09:45:34'),
	(13, '771371', 'Wisnu Prabowo', 'luthfifirgantoro@example.net', '(0955) 731-5546', 'XII Manajemen Informatika', 'Teknik Informatika', 'Gg. Stasiun Wonokromo No. 864\r\nCilegon, BE 23994', NULL, '1999-10-11', 'P', 'Lulus', '2025-01-03 10:48:12', '2025-01-04 10:43:03'),
	(14, '309614', 'Nrima Firgantoro, S.E.', 'damanikcemeti@example.net', '(043) 459 2712', 'XII Manajemen Informatika', 'Teknik Informatika', 'Gg. Merdeka No. 64\r\nMakassar, DI Yogyakarta 79371', NULL, '2004-02-18', 'P', 'Aktif', '2025-04-24 11:43:29', '2025-06-19 00:43:38'),
	(15, '120283', 'Siti Anggriawan, S.E.', 'putrataufik@example.org', '+62 (0706) 798 5654', 'XI Manajemen Informatika', 'Sistem Informasi', 'Gang Dr. Djunjunan No. 291\r\nBengkulu, Kepulauan Riau 31344', '/uploads/profiles/student_15.jpg', '2009-11-11', 'L', 'Lulus', '2025-02-26 13:42:18', '2025-05-29 06:20:29'),
	(16, '744308', 'Cut Rika Wibisono', 'briyanti@example.org', '+62 (06) 749-9593', 'Kelas Go Menengah', 'Teknik Komputer dan Jaringan', 'Jl. M.T Haryono No. 5\r\nPalangkaraya, Sulawesi Tengah 54987', NULL, '2002-08-08', 'L', 'Aktif', '2025-07-27 05:20:24', '2025-09-16 11:40:20'),
	(17, '728491', 'drg. Cagak Andriani', 'phakim@example.org', '(096) 126-4550', 'XII Sistem Informasi', 'Manajemen Informatika', 'Jl. Moch. Ramdan No. 01\r\nPayakumbuh, Aceh 71290', NULL, '2010-05-03', 'P', 'Aktif', '2025-02-20 06:42:31', '2025-04-05 07:47:20'),
	(18, '788766', 'Darmanto Farida, S.Pd', 'luwar25@example.net', '+62 (087) 866-8535', 'XI Manajemen Informatika', 'Teknik Informatika', 'Jalan Rumah Sakit No. 7\r\nManado, KB 35188', '/uploads/profiles/student_18.jpg', '2001-02-11', 'P', 'Tidak Aktif', '2025-03-09 05:28:03', '2025-08-20 19:40:13'),
	(19, '948317', 'Prakosa Kurniawan', 'opanwasita@example.net', '+62 (583) 402-4786', 'XI Sistem Informasi', 'Teknik Komputer', 'Jalan Ahmad Yani No. 572\r\nBanjar, Riau 37444', '/uploads/profiles/student_19.jpg', '2001-12-11', 'L', 'Tidak Aktif', '2025-04-03 06:20:27', '2025-04-15 22:05:28'),
	(20, '561615', 'Clara Wibowo', 'tutama@example.net', '(030) 501 5142', 'X Teknik Komputer', 'Teknik Komputer', 'Jl. Tebet Barat Dalam No. 85\r\nSibolga, Jawa Barat 42782', '/uploads/profiles/student_20.jpg', '2008-10-15', 'P', 'Aktif', '2025-04-06 05:05:48', '2025-03-27 19:25:05'),
	(21, '298721', 'Dt. Jono Astuti', 'anggrainirestu@example.net', '(0339) 250 1256', 'XI Sistem Informasi', 'Teknik Komputer', 'Gang Pacuan Kuda No. 525\r\nBatu, Bengkulu 97397', '/uploads/profiles/student_21.jpg', '2000-02-02', 'P', 'Tidak Aktif', '2025-09-10 22:25:36', '2025-04-01 19:30:43'),
	(22, '457602', 'Oni Prasetyo, M.M.', 'lnatsir@example.net', '+62-058-967-7660', 'XII Sistem Informasi', 'Teknik Komputer', 'Gang Pasir Koja No. 28\r\nSawahlunto, Sulawesi Tenggara 88743', NULL, '2007-10-07', 'P', 'Aktif', '2025-08-16 07:05:57', '2025-05-24 07:33:47'),
	(23, '176803', 'KH. Kenes Agustina', 'ssantoso@example.org', '+62 (040) 227 9332', 'XII Teknik Komputer', 'Teknik Komputer', 'Gg. Waringin No. 331\r\nTebingtinggi, Jawa Tengah 43982', '/uploads/profiles/student_23.jpg', '2008-09-26', 'L', 'Aktif', '2025-05-28 21:40:08', '2025-06-26 19:56:02'),
	(24, '145271', 'dr. Michelle Hidayat', 'ellisfirmansyah@example.net', '+62 (470) 202-5573', 'X Teknik Komputer', 'Sistem Informasi', 'Gg. Peta No. 85\r\nBogor, Papua Barat 12851', NULL, '2006-06-04', 'L', 'Aktif', '2025-02-16 07:19:17', '2025-02-27 18:07:45'),
	(25, '440320', 'Asman Kuswoyo, S.IP', 'qsirait@example.com', '0823345780', 'X Teknik Komputer', 'Teknik Komputer', 'Jalan Ronggowarsito No. 36\r\nMakassar, Jambi 39062', NULL, '2007-01-12', 'P', 'Aktif', '2025-08-30 17:16:28', '2025-04-26 11:49:42'),
	(26, '358144', 'R. Farah Kusumo', 'ulailasari@example.net', '085 152 2134', 'XII Manajemen Informatika', 'Manajemen Informatika', 'Jalan Joyoboyo No. 242\r\nMetro, Aceh 54647', NULL, '2000-02-03', 'P', 'Aktif', '2025-08-02 09:28:31', '2025-01-17 15:14:51'),
	(27, '148546', 'T. Danu Maryati, S.T.', 'atmajaiswahyudi@example.com', '(072) 375 8191', 'XI Manajemen Informatika', 'Teknik Informatika', 'Gg. Tubagus Ismail No. 61\r\nBatam, Gorontalo 49249', '/uploads/profiles/student_27.jpg', '2002-08-25', 'L', 'Aktif', '2025-07-10 01:21:40', '2025-09-04 23:13:21'),
	(28, '334349', 'Puti Ayu Usada, S.I.Kom', 'balamantri48@example.org', '0804040752', 'XII Teknik Informatika', 'Teknik Komputer', 'Jalan Cikutra Timur No. 6\r\nCimahi, DKI Jakarta 59721', NULL, '2006-06-25', 'P', 'Lulus', '2025-01-21 11:56:40', '2025-01-12 04:32:51'),
	(29, '977589', 'Ade Hakim', 'malapadmasari@example.net', '+62-042-405-3777', 'X Teknik Komputer', 'Sistem Informasi', 'Gang Moch. Toha No. 03\r\nPayakumbuh, Bengkulu 59020', '/uploads/profiles/student_29.jpg', '1999-11-18', 'L', 'Aktif', '2025-02-08 06:31:14', '2025-03-02 22:13:40'),
	(30, '522171', 'Hartana Pradana', 'mutia94@example.org', '(008) 232 4636', 'XII Manajemen Informatika', 'Sistem Informasi', 'Gg. Medokan Ayu No. 346\r\nSingkawang, MA 28075', NULL, '2008-04-01', 'L', 'Lulus', '2025-01-20 05:25:29', '2025-04-21 01:41:42');

-- Dumping structure for table academy_lite.student_submissions
CREATE TABLE IF NOT EXISTS `student_submissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assignment_id` int NOT NULL,
  `student_id` int NOT NULL,
  `submission_content` text,
  `submission_file` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` float DEFAULT NULL,
  `feedback` text,
  `status` enum('submitted','graded','late') NOT NULL DEFAULT 'submitted',
  PRIMARY KEY (`id`),
  KEY `assignment_id` (`assignment_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `student_submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.student_submissions: ~10 rows (approximately)
INSERT INTO `student_submissions` (`id`, `assignment_id`, `student_id`, `submission_content`, `submission_file`, `submitted_at`, `grade`, `feedback`, `status`) VALUES
	(1, 501, 201, 'Membuat halaman HTML dengan heading dan paragraf.', 'submissions/201_html1.zip', '2025-09-16 11:18:29', 85, 'Bagus, tapi masih ada tag yang kurang.', 'graded'),
	(2, 501, 202, 'Latihan HTML selesai dengan tambahan link.', 'submissions/202_html1.zip', '2025-09-16 11:18:29', 90, 'Sangat baik, sudah rapi.', 'graded'),
	(3, 501, 203, 'Tugas HTML terlambat saya kumpulkan.', 'submissions/203_html1.zip', '2025-09-16 11:18:29', 70, 'Nilai dikurangi karena telat.', 'late'),
	(4, 501, 204, 'Saya membuat form sederhana.', NULL, '2025-09-16 11:18:29', NULL, NULL, 'submitted'),
	(5, 501, 205, 'Belum sempat upload file, ini jawaban text saja.', NULL, '2025-09-16 11:18:29', NULL, NULL, 'submitted'),
	(6, 502, 201, 'Membuat halaman dengan style warna dan font.', 'submissions/201_css1.zip', '2025-09-16 11:18:29', 95, 'Sangat bagus, styling lengkap.', 'graded'),
	(7, 502, 202, 'Menambahkan flexbox untuk layout.', 'submissions/202_css1.zip', '2025-09-16 11:18:29', 88, 'Bagus, hanya sedikit kesalahan.', 'graded'),
	(8, 502, 203, 'CSS saya error, jadi saya kumpul seadanya.', 'submissions/203_css1.zip', '2025-09-16 11:18:29', 65, 'Harus diperbaiki.', 'graded'),
	(9, 502, 204, 'Saya sedang revisi, jadi terlambat.', 'submissions/204_css1.zip', '2025-09-16 11:18:29', NULL, NULL, 'late'),
	(10, 502, 205, 'Masih proses, belum selesai.', NULL, '2025-09-16 11:18:29', NULL, NULL, 'submitted');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table academy_lite.testimonials: ~10 rows (approximately)
INSERT INTO `testimonials` (`id`, `name`, `position`, `photo`, `content`, `rating`, `created_at`) VALUES
	(1, 'drg. Cemplunk Pratiwi', 'Mahasiswa', NULL, 'Impedit facilis eius magnam commodi inventore. Error necessitatibus incidunt qui blanditiis ipsum soluta. Ea eveniet odit fugit quae nihil iste. Similique molestiae quaerat veniam sunt.', 5, '2025-04-19 19:18:51'),
	(2, 'R. Rachel Prastuti', 'Professional', NULL, 'Aliquam inventore id minus sed. Officia ipsum earum veritatis occaecati.', 3, '2025-02-14 05:17:13'),
	(3, 'Tantri Tamba', 'Professional', '/uploads/testimonials/testimonial_3.jpg', 'Sequi cum cum. Quo blanditiis libero eaque occaecati neque enim.', 3, '2025-02-12 09:11:49'),
	(4, 'Lalita Suryono', 'Developer', NULL, 'Eaque harum sit officiis cum. Perspiciatis ipsam asperiores quia maiores aspernatur doloremque nobis. Culpa earum cumque mollitia aspernatur.', 5, '2025-04-07 04:07:50'),
	(5, 'Citra Tampubolon', 'Professional', '/uploads/testimonials/testimonial_5.jpg', 'Vero magnam sit pariatur. Iusto quis quidem earum accusantium. Exercitationem libero nisi eos corrupti et vero earum.', 5, '2025-06-01 00:59:06'),
	(6, 'Ida Wahyuni, S.Ked', 'Student', '/uploads/testimonials/testimonial_6.jpg', 'Repellat eligendi pariatur soluta animi. Expedita distinctio consectetur.', 4, '2025-06-08 14:57:19'),
	(7, 'Ghani Kurniawan', 'IT Manager', '/uploads/testimonials/testimonial_7.jpg', 'Sunt excepturi ratione ut. Enim velit numquam corrupti ipsam nulla.', 5, '2025-04-15 14:09:55'),
	(8, 'Dr. Titi Riyanti, M.M.', 'Student', NULL, 'Omnis accusantium assumenda sunt. Dolorum culpa assumenda totam ratione nisi aliquam error. Iure iure voluptatum maxime.', 5, '2025-08-11 09:02:15'),
	(9, 'Ir. Paiman Anggriawan, S.Psi', 'Professional', NULL, 'Eos ullam odit beatae quis omnis modi. Voluptatum delectus quisquam totam quibusdam reiciendis. Libero iste facilis ea beatae reiciendis hic perferendis.', 5, '2025-03-23 09:04:02'),
	(10, 'R.M. Luwes Suwarno, S.Pd', 'Developer', '/uploads/testimonials/testimonial_10.jpg', 'Occaecati harum soluta reprehenderit dolor illum atque enim. Error eius ducimus perspiciatis inventore ullam et. Ea ipsam unde officia.', 4, '2025-03-30 04:53:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.users: ~50 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `role`, `level`, `department`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'bajraginhidayat1', '7c6a180b36896a0a8c02787eeafb0e4c', 'Usyi Pertiwi', 'iswahyudicengkir@example.com', 'siswa', '4', 'CV Hartati Marpaung', 'Aktif', '2025-03-27 11:24:06', '2025-04-23 04:03:54', '2025-02-08 12:59:18'),
	(2, 'novitasariazalea2', '6cb75f652a9b52798eb6cf2201057c73', 'Ilsa Lestari', 'lulut48@example.net', 'user', '5', 'CV Prakasa Hutagalung (Persero) Tbk', 'Tidak Aktif', '2025-01-19 06:36:45', '2025-01-13 20:49:40', '2025-04-27 11:26:15'),
	(3, 'setiawancapa3', '819b0643d6b89dc9b579fdfc9094f28e', 'dr. Genta Hidayanto', 'luwesirawan@example.com', 'admin', '2', NULL, 'Aktif', '2025-04-06 02:15:58', '2025-01-21 05:26:33', '2025-03-28 22:39:18'),
	(4, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Fitriani Wijayanti', 'adriansyahzalindra@example.org', 'super_admin', '1', 'PT Rahmawati Tbk', 'Aktif', '2025-09-16 11:23:00', '2025-02-08 02:10:27', '2025-09-16 11:23:00'),
	(5, 'niyagausamah5', 'db0edd04aaac4506f7edab03ac855d56', 'R. Paris Oktaviani, S.Pd', 'ssantoso@example.com', 'siswa', '4', NULL, 'Tidak Aktif', '2025-04-22 01:21:17', '2025-08-21 07:19:26', '2025-04-11 03:58:45'),
	(6, 'spradipta6', '218dd27aebeccecae69ad8408d9a36bf', 'Dr. Tina Suwarno', 'banara40@example.org', 'user', '5', NULL, 'Tidak Aktif', NULL, '2025-09-10 22:22:19', '2025-01-24 16:48:41'),
	(7, 'mahendrabagas7', '00cdb7bb942cf6b290ceb97d6aca64a3', 'Narji Dongoran, M.TI.', 'fmandasari@example.net', 'admin', '2', NULL, 'Aktif', '2025-02-05 05:53:22', '2025-07-23 03:54:56', '2025-04-01 12:30:35'),
	(8, 'imam548', 'b25ef06be3b6948c0bc431da46c2c738', 'R. Diah Lailasari', 'carubprasetyo@example.org', 'admin', '2', NULL, 'Tidak Aktif', '2025-08-25 10:56:06', '2025-07-16 12:56:27', '2025-09-11 03:50:00'),
	(9, 'hwidiastuti9', '5d69dd95ac183c9643780ed7027d128a', 'Daliman Sinaga', 'aslijanmaryadi@example.org', 'user', '5', 'UD Pangestu Budiyanto Tbk', 'Tidak Aktif', NULL, '2025-09-04 23:02:17', '2025-09-05 15:38:44'),
	(10, 'zulaikhapermadi10', '87e897e3b54a405da144968b2ca19b45', 'Dr. Paramita Rajasa, S.IP', 'unjaniprasetyo@example.com', 'guru', '3', NULL, 'Tidak Aktif', '2025-03-10 11:09:20', '2025-02-17 16:51:06', '2025-06-15 06:21:27'),
	(11, 'karsa0811', '1e5c2776cf544e213c3d279c40719643', 'Rini Thamrin', 'usyi34@example.com', 'admin', '2', 'CV Wasita Wibisono', 'Tidak Aktif', '2025-08-13 17:10:59', '2025-08-16 05:24:50', '2025-08-31 07:21:03'),
	(12, 'xwinarno12', 'c24a542f884e144451f9063b79e7994e', 'Kawaya Ardianto', 'devi85@example.com', 'user', '5', 'CV Prasetya (Persero) Tbk', 'Tidak Aktif', NULL, '2025-06-02 01:40:09', '2025-05-07 14:57:22'),
	(13, 'hasanhidayat13', 'ee684912c7e588d03ccb40f17ed080c9', 'Cornelia Simanjuntak', 'rnashiruddin@example.net', 'user', '5', NULL, 'Tidak Aktif', '2025-06-10 00:07:53', '2025-01-27 05:20:45', '2025-03-01 20:17:02'),
	(14, 'vicky6714', '8ee736784ce419bd16554ed5677ff35b', 'R. Radika Saputra', 'safitritaufan@example.net', 'siswa', '4', 'UD Mangunsong Hutapea (Persero) Tbk', 'Tidak Aktif', NULL, '2025-06-30 09:50:08', '2025-06-25 21:50:03'),
	(15, 'yuliawacana15', '9141fea0574f83e190ab7479d516630d', 'Padma Gunawan', 'suwarnobalijan@example.net', 'user', '5', NULL, 'Tidak Aktif', '2025-04-07 02:09:47', '2025-02-16 17:20:00', '2025-02-08 19:59:42'),
	(16, 'hmaulana16', '2b40aaa979727c43411c305540bbed50', 'Dt. Umay Lazuardi', 'baktiadipermadi@example.net', 'user', '5', 'UD Sihotang (Persero) Tbk', 'Tidak Aktif', '2025-03-21 15:05:58', '2025-07-14 16:52:02', '2025-05-12 12:04:46'),
	(17, 'kenziewaluyo17', 'a63f9709abc75bf8bd8f6e1ba9992573', 'Caraka Narpati', 'dwijaya@example.org', 'super_admin', '1', NULL, 'Tidak Aktif', '2025-03-04 06:53:52', '2025-08-14 16:17:01', '2025-07-01 11:04:26'),
	(18, 'ywulandari18', '80b8bdceb474b5127b6aca386bb8ce14', 'H. Tomi Suartini', 'vrajasa@example.org', 'user', '5', 'Perum Suryono (Persero) Tbk', 'Aktif', '2025-04-18 10:47:16', '2025-04-07 19:43:51', '2025-08-19 08:05:20'),
	(19, 'qsitompul19', 'e532ae6f28f4c2be70b500d3d34724eb', 'Yance Pradana', 'ikhsanfirgantoro@example.org', 'super_admin', '1', 'UD Wacana Tbk', 'Aktif', '2025-01-23 07:09:48', '2025-04-03 12:04:37', '2025-07-04 22:13:02'),
	(20, 'puspaanggraini20', 'aee67d9bb569ad1562f7b67cfccbd2ef', 'Adika Hasanah', 'legalestari@example.com', 'admin', '2', 'Perum Pranowo Rajata', 'Aktif', '2025-03-16 22:34:03', '2025-06-01 06:53:31', '2025-07-24 06:01:30'),
	(21, 'jaeman4121', '568c31f0f2406ab70255a1d83291220f', 'Faizah Fujiati', 'najwa22@example.net', 'admin', '2', NULL, 'Tidak Aktif', '2025-07-23 22:48:47', '2025-05-31 11:03:10', '2025-05-21 04:20:33'),
	(22, 'wahyudinkarsa22', '069103d83d40b742a336dee5fb92f4e5', 'Damar Pratama', 'isuwarno@example.com', 'user', '5', NULL, 'Tidak Aktif', '2025-01-16 08:13:18', '2025-05-14 06:33:39', '2025-03-04 08:32:37'),
	(23, 'jayadi0823', '1f82cdf9195b31244721c6026587fb78', 'H. Cager Andriani', 'jaeman06@example.com', 'admin', '2', NULL, 'Tidak Aktif', '2025-06-21 22:30:18', '2025-08-10 22:15:28', '2025-06-15 20:56:46'),
	(24, 'pudjiastutibaktianto24', '58bad6b697dff48f4927941962f23e90', 'Oni Haryanti, S.IP', 'qthamrin@example.com', 'super_admin', '1', NULL, 'Tidak Aktif', '2025-01-03 08:03:26', '2025-09-15 16:28:17', '2025-09-07 05:09:05'),
	(25, 'zmelani25', '6982e82c0b21af5526754d83df2d1635', 'drg. Siti Saragih', 'susantiayu@example.net', 'siswa', '4', 'Perum Suwarno', 'Aktif', NULL, '2025-06-21 09:10:10', '2025-04-09 09:14:06'),
	(26, 'usyimarpaung26', 'dc2d937cba912f093445d008f0461c83', 'Wani Saputra', 'nasyiahsetya@example.net', 'super_admin', '1', NULL, 'Tidak Aktif', NULL, '2025-09-13 01:52:11', '2025-07-17 21:17:49'),
	(27, 'budiyantounjani27', 'ccf08fd9a560b266470bf8ab97fc7c26', 'Qori Nainggolan', 'belindasetiawan@example.com', 'super_admin', '1', NULL, 'Aktif', '2025-05-29 05:25:20', '2025-04-21 10:23:28', '2025-07-01 21:58:20'),
	(28, 'ivan3328', '3b635d4df2c9ece93b97759531d6ed01', 'Dian Winarsih', 'nasyiahdarmana@example.net', 'admin', '2', NULL, 'Aktif', NULL, '2025-05-21 22:17:13', '2025-04-08 06:54:18'),
	(29, 'nainggolandina29', '926742e502de7d22686bb1d4a07fe635', 'Labuh Aryani', 'darmanlailasari@example.net', 'siswa', '4', 'PD Budiman Napitupulu (Persero) Tbk', 'Aktif', '2025-03-09 07:37:00', '2025-01-29 06:50:39', '2025-01-20 07:23:53'),
	(30, 'eardianto30', '3dc94727dbba08bdd21d7b318b410600', 'Asmianto Winarno', 'gadingpratama@example.org', 'siswa', '4', NULL, 'Aktif', NULL, '2025-05-28 17:20:56', '2025-07-13 06:19:04'),
	(31, 'safina4331', '0c75f443030c092d82b67ef876fa4e4e', 'Ganep Maheswara', 'uprakasa@example.com', 'siswa', '4', 'PD Fujiati', 'Tidak Aktif', '2025-03-19 06:21:12', '2025-01-02 08:44:16', '2025-07-26 06:21:45'),
	(32, 'tugiman9832', 'f849618fac31084ff0bafe6f877562e3', 'KH. Ismail Oktaviani, M.Farm', 'verahalimah@example.net', 'admin', '2', NULL, 'Tidak Aktif', '2025-06-28 13:18:00', '2025-04-10 15:46:45', '2025-01-28 04:02:16'),
	(33, 'dasa3233', 'd61af90de34e181dcb619fdc9c9f817d', 'Drs. Najwa Mayasari, S.E.I', 'czulaika@example.com', 'siswa', '4', NULL, 'Tidak Aktif', '2025-09-10 17:58:05', '2025-07-19 14:44:18', '2025-04-18 03:13:59'),
	(34, 'rsimbolon34', '7aa4106f8d30c77db0517e813ace4a3b', 'Violet Mahendra', 'prayoga52@example.com', 'guru', '3', NULL, 'Tidak Aktif', '2025-03-12 11:03:09', '2025-06-15 14:35:32', '2025-09-01 00:27:07'),
	(35, 'juliasitumorang35', '48ad74b74844fadd28274afd5c617ccf', 'Ellis Wulandari', 'kuwais@example.net', 'super_admin', '1', NULL, 'Aktif', '2025-03-06 12:55:26', '2025-01-29 21:47:31', '2025-06-17 12:49:32'),
	(36, 'ratih5336', '8ba4260f47598cece4813a294952f7f3', 'Tugiman Adriansyah', 'ina01@example.net', 'admin', '2', 'PT Anggraini (Persero) Tbk', 'Aktif', '2025-02-20 18:33:46', '2025-05-22 12:20:44', '2025-03-01 08:00:29'),
	(37, 'dasasihombing37', '9ab4b766ba920fca672112a4d81464df', 'Damar Hastuti', 'gadangpradipta@example.org', 'admin', '2', 'PT Wibowo Hutagalung', 'Aktif', '2025-03-09 20:15:46', '2025-03-27 08:42:38', '2024-12-31 23:36:06'),
	(38, 'vino8638', 'b30628ea30edfe26e7650e7bd89cc8a1', 'Sadina Usada', 'ynurdiyanti@example.net', 'siswa', '4', NULL, 'Tidak Aktif', '2025-07-19 03:56:30', '2025-09-04 16:51:15', '2025-05-02 01:54:10'),
	(39, 'prahimah39', 'be961c906e3b375dced446d4cf0b6856', 'Ayu Kusumo', 'karmahalim@example.com', 'guru', '3', 'PT Firgantoro Uyainah', 'Tidak Aktif', '2025-02-28 00:41:31', '2025-06-02 11:07:33', '2025-02-14 04:05:58'),
	(40, 'wulanwastuti40', '831fc3acf61a6ac7f44f73287ece2942', 'Mila Lestari', 'kusumadabukke@example.org', 'super_admin', '1', 'PD Samosir', 'Tidak Aktif', '2025-03-13 14:18:28', '2025-04-02 16:01:08', '2025-06-09 19:03:53'),
	(41, 'fitriani7741', 'decb7cb773821f0e6486650c6f062be5', 'Pia Haryanti', 'cakrajiyautami@example.net', 'admin', '2', 'Perum Rahimah', 'Tidak Aktif', '2025-06-12 06:10:32', '2025-06-08 15:44:00', '2025-07-29 16:52:58'),
	(42, 'kamaria9442', 'b1a6a20d781fde908b1dd9af34deb8ea', 'Nurul Habibi', 'cakrajiya07@example.org', 'guru', '3', NULL, 'Aktif', NULL, '2025-05-07 16:09:55', '2025-06-01 19:56:59'),
	(43, 'prakasabakidin43', 'a5669b4e80cfb179cdd36be6eeada2cd', 'Bakda Sudiati', 'yaninamaga@example.com', 'user', '5', NULL, 'Tidak Aktif', '2025-01-10 10:25:49', '2025-05-11 17:33:03', '2025-04-08 04:27:23'),
	(44, 'ahalim44', '9608e3da7f00ffa26507d1aa9a575197', 'Vanya Puspita, S.Psi', 'gsuryatmi@example.com', 'super_admin', '1', 'UD Sitompul', 'Aktif', '2025-01-09 04:51:51', '2025-04-11 23:24:05', '2025-08-29 19:43:48'),
	(45, 'pertiwimakuta45', '0009fa95022c5c2c1276227121652c60', 'Cici Halimah', 'mmegantara@example.net', 'user', '5', NULL, 'Tidak Aktif', '2025-02-19 19:12:33', '2025-01-08 20:52:43', '2025-04-14 21:38:20'),
	(46, 'qsiregar46', '6ea84fafdeb8b3857abe9410c7144ccb', 'Karimah Sudiati', 'fnamaga@example.com', 'super_admin', '1', NULL, 'Tidak Aktif', '2025-01-12 02:12:45', '2025-05-07 13:37:47', '2025-07-24 08:35:57'),
	(47, 'mansurcemani47', 'ea716d443f74ecc54957c884c0d05612', 'Melinda Wulandari', 'widya09@example.net', 'super_admin', '1', NULL, 'Tidak Aktif', NULL, '2025-03-10 18:06:56', '2025-01-13 13:01:02'),
	(48, 'kuncara2348', '458c7a67e7b9126ae7a9df4b821ea745', 'Cindy Mayasari', 'bwasita@example.org', 'admin', '2', NULL, 'Aktif', '2025-04-11 01:29:28', '2025-04-17 06:15:51', '2025-07-30 14:10:21'),
	(49, 'mitra8549', '0659a802af127843be2e35e0e36c310a', 'Iriana Rahayu', 'enashiruddin@example.net', 'siswa', '4', NULL, 'Tidak Aktif', '2025-03-16 04:04:12', '2025-07-21 04:38:59', '2025-08-18 08:45:46'),
	(50, 'gutama50', 'ed645bbf72d0c71176142d93c99942c2', 'Manah Palastri', 'lidyarajata@example.com', 'admin', '2', NULL, 'Tidak Aktif', '2025-06-08 08:33:57', '2025-04-14 08:51:02', '2025-08-12 18:38:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table academy_lite.user_permissions: ~158 rows (approximately)
INSERT INTO `user_permissions` (`id`, `role`, `level`, `module`, `action`, `allowed`, `created_at`) VALUES
	(23, 'super_admin', '1', 'dashboard', 'create', 1, '2025-09-16 11:34:58'),
	(24, 'super_admin', '1', 'dashboard', 'read', 1, '2025-09-16 11:34:58'),
	(25, 'super_admin', '1', 'dashboard', 'update', 1, '2025-09-16 11:34:58'),
	(26, 'super_admin', '1', 'dashboard', 'delete', 1, '2025-09-16 11:34:58'),
	(27, 'super_admin', '1', 'dashboard', 'view', 1, '2025-09-16 11:34:58'),
	(28, 'super_admin', '1', 'siswa', 'create', 1, '2025-09-16 11:34:58'),
	(29, 'super_admin', '1', 'siswa', 'read', 1, '2025-09-16 11:34:58'),
	(30, 'super_admin', '1', 'siswa', 'update', 1, '2025-09-16 11:34:58'),
	(31, 'super_admin', '1', 'siswa', 'delete', 1, '2025-09-16 11:34:58'),
	(32, 'super_admin', '1', 'siswa', 'view', 1, '2025-09-16 11:34:58'),
	(33, 'super_admin', '1', 'kelas', 'create', 1, '2025-09-16 11:34:58'),
	(34, 'super_admin', '1', 'kelas', 'read', 1, '2025-09-16 11:34:58'),
	(35, 'super_admin', '1', 'kelas', 'update', 1, '2025-09-16 11:34:58'),
	(36, 'super_admin', '1', 'kelas', 'delete', 1, '2025-09-16 11:34:58'),
	(37, 'super_admin', '1', 'kelas', 'view', 1, '2025-09-16 11:34:58'),
	(38, 'super_admin', '1', 'guru', 'create', 1, '2025-09-16 11:34:59'),
	(39, 'super_admin', '1', 'guru', 'read', 1, '2025-09-16 11:34:59'),
	(40, 'super_admin', '1', 'guru', 'update', 1, '2025-09-16 11:34:59'),
	(41, 'super_admin', '1', 'guru', 'delete', 1, '2025-09-16 11:34:59'),
	(42, 'super_admin', '1', 'guru', 'view', 1, '2025-09-16 11:34:59'),
	(43, 'super_admin', '1', 'jadwal', 'create', 1, '2025-09-16 11:34:59'),
	(44, 'super_admin', '1', 'jadwal', 'read', 1, '2025-09-16 11:34:59'),
	(45, 'super_admin', '1', 'jadwal', 'update', 1, '2025-09-16 11:34:59'),
	(46, 'super_admin', '1', 'jadwal', 'delete', 1, '2025-09-16 11:34:59'),
	(47, 'super_admin', '1', 'jadwal', 'view', 1, '2025-09-16 11:34:59'),
	(48, 'super_admin', '1', 'absensi', 'create', 1, '2025-09-16 11:34:59'),
	(49, 'super_admin', '1', 'absensi', 'read', 1, '2025-09-16 11:34:59'),
	(50, 'super_admin', '1', 'absensi', 'update', 1, '2025-09-16 11:34:59'),
	(51, 'super_admin', '1', 'absensi', 'delete', 1, '2025-09-16 11:34:59'),
	(52, 'super_admin', '1', 'absensi', 'view', 1, '2025-09-16 11:34:59'),
	(53, 'super_admin', '1', 'materi', 'create', 1, '2025-09-16 11:34:59'),
	(54, 'super_admin', '1', 'materi', 'read', 1, '2025-09-16 11:34:59'),
	(55, 'super_admin', '1', 'materi', 'update', 1, '2025-09-16 11:34:59'),
	(56, 'super_admin', '1', 'materi', 'delete', 1, '2025-09-16 11:34:59'),
	(57, 'super_admin', '1', 'materi', 'view', 1, '2025-09-16 11:34:59'),
	(58, 'super_admin', '1', 'assignments', 'create', 1, '2025-09-16 11:34:59'),
	(59, 'super_admin', '1', 'assignments', 'read', 1, '2025-09-16 11:34:59'),
	(60, 'super_admin', '1', 'assignments', 'update', 1, '2025-09-16 11:34:59'),
	(61, 'super_admin', '1', 'assignments', 'delete', 1, '2025-09-16 11:34:59'),
	(62, 'super_admin', '1', 'assignments', 'view', 1, '2025-09-16 11:34:59'),
	(63, 'super_admin', '1', 'forum', 'create', 1, '2025-09-16 11:34:59'),
	(64, 'super_admin', '1', 'forum', 'read', 1, '2025-09-16 11:34:59'),
	(65, 'super_admin', '1', 'forum', 'update', 1, '2025-09-16 11:34:59'),
	(66, 'super_admin', '1', 'forum', 'delete', 1, '2025-09-16 11:34:59'),
	(67, 'super_admin', '1', 'forum', 'view', 1, '2025-09-16 11:34:59'),
	(68, 'super_admin', '1', 'payment', 'create', 1, '2025-09-16 11:34:59'),
	(69, 'super_admin', '1', 'payment', 'read', 1, '2025-09-16 11:34:59'),
	(70, 'super_admin', '1', 'payment', 'update', 1, '2025-09-16 11:34:59'),
	(71, 'super_admin', '1', 'payment', 'delete', 1, '2025-09-16 11:34:59'),
	(72, 'super_admin', '1', 'payment', 'view', 1, '2025-09-16 11:34:59'),
	(73, 'super_admin', '1', 'users', 'create', 1, '2025-09-16 11:34:59'),
	(74, 'super_admin', '1', 'users', 'read', 1, '2025-09-16 11:34:59'),
	(75, 'super_admin', '1', 'users', 'update', 1, '2025-09-16 11:34:59'),
	(76, 'super_admin', '1', 'users', 'delete', 1, '2025-09-16 11:34:59'),
	(77, 'super_admin', '1', 'users', 'view', 1, '2025-09-16 11:34:59'),
	(78, 'super_admin', '1', 'permissions', 'create', 1, '2025-09-16 11:34:59'),
	(79, 'super_admin', '1', 'permissions', 'read', 1, '2025-09-16 11:34:59'),
	(80, 'super_admin', '1', 'permissions', 'update', 1, '2025-09-16 11:34:59'),
	(81, 'super_admin', '1', 'permissions', 'delete', 1, '2025-09-16 11:34:59'),
	(82, 'super_admin', '1', 'permissions', 'view', 1, '2025-09-16 11:34:59'),
	(83, 'super_admin', '1', 'free_classes', 'create', 1, '2025-09-16 11:34:59'),
	(84, 'super_admin', '1', 'free_classes', 'read', 1, '2025-09-16 11:34:59'),
	(85, 'super_admin', '1', 'free_classes', 'update', 1, '2025-09-16 11:34:59'),
	(86, 'super_admin', '1', 'free_classes', 'delete', 1, '2025-09-16 11:34:59'),
	(87, 'super_admin', '1', 'free_classes', 'view', 1, '2025-09-16 11:34:59'),
	(88, 'super_admin', '1', 'workshops', 'create', 1, '2025-09-16 11:34:59'),
	(89, 'super_admin', '1', 'workshops', 'read', 1, '2025-09-16 11:34:59'),
	(90, 'super_admin', '1', 'workshops', 'update', 1, '2025-09-16 11:34:59'),
	(91, 'super_admin', '1', 'workshops', 'delete', 1, '2025-09-16 11:34:59'),
	(92, 'super_admin', '1', 'workshops', 'view', 1, '2025-09-16 11:34:59'),
	(93, 'super_admin', '1', 'testimonials', 'create', 1, '2025-09-16 11:34:59'),
	(94, 'super_admin', '1', 'testimonials', 'read', 1, '2025-09-16 11:34:59'),
	(95, 'super_admin', '1', 'testimonials', 'update', 1, '2025-09-16 11:34:59'),
	(96, 'super_admin', '1', 'testimonials', 'delete', 1, '2025-09-16 11:34:59'),
	(97, 'super_admin', '1', 'testimonials', 'view', 1, '2025-09-16 11:34:59'),
	(98, 'super_admin', '1', 'enrollment', 'create', 1, '2025-09-16 11:34:59'),
	(99, 'super_admin', '1', 'enrollment', 'read', 1, '2025-09-16 11:34:59'),
	(100, 'super_admin', '1', 'enrollment', 'update', 1, '2025-09-16 11:34:59'),
	(101, 'super_admin', '1', 'enrollment', 'delete', 1, '2025-09-16 11:34:59'),
	(102, 'super_admin', '1', 'enrollment', 'view', 1, '2025-09-16 11:34:59'),
	(103, 'admin', '2', 'dashboard', 'read', 1, '2025-09-16 11:34:59'),
	(104, 'admin', '2', 'dashboard', 'view', 1, '2025-09-16 11:34:59'),
	(105, 'admin', '2', 'siswa', 'create', 1, '2025-09-16 11:34:59'),
	(106, 'admin', '2', 'siswa', 'read', 1, '2025-09-16 11:34:59'),
	(107, 'admin', '2', 'siswa', 'update', 1, '2025-09-16 11:34:59'),
	(108, 'admin', '2', 'siswa', 'view', 1, '2025-09-16 11:34:59'),
	(109, 'admin', '2', 'kelas', 'create', 1, '2025-09-16 11:34:59'),
	(110, 'admin', '2', 'kelas', 'read', 1, '2025-09-16 11:34:59'),
	(111, 'admin', '2', 'kelas', 'update', 1, '2025-09-16 11:34:59'),
	(112, 'admin', '2', 'kelas', 'view', 1, '2025-09-16 11:34:59'),
	(113, 'admin', '2', 'guru', 'read', 1, '2025-09-16 11:34:59'),
	(114, 'admin', '2', 'guru', 'view', 1, '2025-09-16 11:34:59'),
	(115, 'admin', '2', 'jadwal', 'create', 1, '2025-09-16 11:34:59'),
	(116, 'admin', '2', 'jadwal', 'read', 1, '2025-09-16 11:34:59'),
	(117, 'admin', '2', 'jadwal', 'update', 1, '2025-09-16 11:34:59'),
	(118, 'admin', '2', 'jadwal', 'view', 1, '2025-09-16 11:34:59'),
	(119, 'admin', '2', 'absensi', 'read', 1, '2025-09-16 11:34:59'),
	(120, 'admin', '2', 'absensi', 'view', 1, '2025-09-16 11:34:59'),
	(121, 'admin', '2', 'materi', 'create', 1, '2025-09-16 11:34:59'),
	(122, 'admin', '2', 'materi', 'read', 1, '2025-09-16 11:34:59'),
	(123, 'admin', '2', 'materi', 'update', 1, '2025-09-16 11:34:59'),
	(124, 'admin', '2', 'materi', 'view', 1, '2025-09-16 11:34:59'),
	(125, 'admin', '2', 'assignments', 'read', 1, '2025-09-16 11:34:59'),
	(126, 'admin', '2', 'assignments', 'view', 1, '2025-09-16 11:34:59'),
	(127, 'admin', '2', 'forum', 'read', 1, '2025-09-16 11:34:59'),
	(128, 'admin', '2', 'forum', 'view', 1, '2025-09-16 11:34:59'),
	(129, 'admin', '2', 'payment', 'read', 1, '2025-09-16 11:34:59'),
	(130, 'admin', '2', 'payment', 'view', 1, '2025-09-16 11:34:59'),
	(131, 'admin', '2', 'free_classes', 'create', 1, '2025-09-16 11:34:59'),
	(132, 'admin', '2', 'free_classes', 'read', 1, '2025-09-16 11:34:59'),
	(133, 'admin', '2', 'free_classes', 'update', 1, '2025-09-16 11:34:59'),
	(134, 'admin', '2', 'free_classes', 'view', 1, '2025-09-16 11:34:59'),
	(135, 'guru', '3', 'dashboard', 'read', 1, '2025-09-16 11:34:59'),
	(136, 'guru', '3', 'dashboard', 'view', 1, '2025-09-16 11:34:59'),
	(137, 'guru', '3', 'jadwal', 'read', 1, '2025-09-16 11:34:59'),
	(138, 'guru', '3', 'jadwal', 'view', 1, '2025-09-16 11:34:59'),
	(139, 'guru', '3', 'absensi', 'create', 1, '2025-09-16 11:34:59'),
	(140, 'guru', '3', 'absensi', 'read', 1, '2025-09-16 11:34:59'),
	(141, 'guru', '3', 'absensi', 'update', 1, '2025-09-16 11:34:59'),
	(142, 'guru', '3', 'absensi', 'view', 1, '2025-09-16 11:34:59'),
	(143, 'guru', '3', 'materi', 'create', 1, '2025-09-16 11:34:59'),
	(144, 'guru', '3', 'materi', 'read', 1, '2025-09-16 11:34:59'),
	(145, 'guru', '3', 'materi', 'update', 1, '2025-09-16 11:34:59'),
	(146, 'guru', '3', 'materi', 'view', 1, '2025-09-16 11:34:59'),
	(147, 'guru', '3', 'assignments', 'create', 1, '2025-09-16 11:34:59'),
	(148, 'guru', '3', 'assignments', 'read', 1, '2025-09-16 11:34:59'),
	(149, 'guru', '3', 'assignments', 'update', 1, '2025-09-16 11:34:59'),
	(150, 'guru', '3', 'assignments', 'view', 1, '2025-09-16 11:34:59'),
	(151, 'guru', '3', 'forum', 'read', 1, '2025-09-16 11:34:59'),
	(152, 'guru', '3', 'forum', 'view', 1, '2025-09-16 11:34:59'),
	(153, 'siswa', '4', 'dashboard', 'read', 1, '2025-09-16 11:34:59'),
	(154, 'siswa', '4', 'dashboard', 'view', 1, '2025-09-16 11:34:59'),
	(155, 'siswa', '4', 'jadwal', 'read', 1, '2025-09-16 11:34:59'),
	(156, 'siswa', '4', 'jadwal', 'view', 1, '2025-09-16 11:34:59'),
	(157, 'siswa', '4', 'absensi', 'read', 1, '2025-09-16 11:34:59'),
	(158, 'siswa', '4', 'absensi', 'view', 1, '2025-09-16 11:34:59'),
	(159, 'siswa', '4', 'materi', 'read', 1, '2025-09-16 11:34:59'),
	(160, 'siswa', '4', 'materi', 'view', 1, '2025-09-16 11:34:59'),
	(161, 'siswa', '4', 'assignments', 'read', 1, '2025-09-16 11:34:59'),
	(162, 'siswa', '4', 'assignments', 'update', 1, '2025-09-16 11:34:59'),
	(163, 'siswa', '4', 'assignments', 'view', 1, '2025-09-16 11:34:59'),
	(164, 'siswa', '4', 'forum', 'create', 1, '2025-09-16 11:34:59'),
	(165, 'siswa', '4', 'forum', 'read', 1, '2025-09-16 11:34:59'),
	(166, 'siswa', '4', 'forum', 'update', 1, '2025-09-16 11:34:59'),
	(167, 'siswa', '4', 'forum', 'view', 1, '2025-09-16 11:34:59'),
	(168, 'siswa', '4', 'payment', 'create', 1, '2025-09-16 11:34:59'),
	(169, 'siswa', '4', 'payment', 'read', 1, '2025-09-16 11:34:59'),
	(170, 'siswa', '4', 'payment', 'view', 1, '2025-09-16 11:34:59'),
	(171, 'siswa', '4', 'free_classes', 'read', 1, '2025-09-16 11:34:59'),
	(172, 'siswa', '4', 'free_classes', 'view', 1, '2025-09-16 11:34:59'),
	(173, 'user', '5', 'dashboard', 'read', 1, '2025-09-16 11:34:59'),
	(174, 'user', '5', 'dashboard', 'view', 1, '2025-09-16 11:34:59'),
	(175, 'user', '5', 'kelas', 'read', 1, '2025-09-16 11:34:59'),
	(176, 'user', '5', 'kelas', 'view', 1, '2025-09-16 11:34:59'),
	(177, 'user', '5', 'forum', 'read', 1, '2025-09-16 11:34:59'),
	(178, 'user', '5', 'forum', 'view', 1, '2025-09-16 11:34:59'),
	(179, 'user', '5', 'free_classes', 'read', 1, '2025-09-16 11:34:59'),
	(180, 'user', '5', 'free_classes', 'view', 1, '2025-09-16 11:34:59');

-- Dumping structure for table academy_lite.workshops
CREATE TABLE IF NOT EXISTS `workshops` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('workshop','seminar') NOT NULL DEFAULT 'workshop',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_participants` int NOT NULL DEFAULT '0',
  `thumbnail` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `status` enum('draft','published','completed') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_status` (`status`),
  KEY `idx_type` (`type`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_status_type` (`status`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table academy_lite.workshops: ~10 rows (approximately)
INSERT INTO `workshops` (`id`, `title`, `slug`, `description`, `type`, `price`, `start_datetime`, `end_datetime`, `location`, `max_participants`, `thumbnail`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Accusamus rem eos.', 'letter-last-bad', 'Iste dolor animi necessitatibus. Asperiores voluptatibus in quam facilis a.\r\n\r\nNemo cupiditate sapiente sed explicabo quod sed. Laboriosam ut perspiciatis molestias quisquam. Alias modi expedita a saepe pariatur.\r\n\r\nCorrupti fugit ducimus id aspernatur. Numquam quisquam doloremque eaque eos itaque expedita. Debitis consequuntur excepturi distinctio.', 'workshop', 182186.44, '2025-02-03 22:48:20', '2025-02-04 00:48:20', 'Gg. Veteran No. 3\r\nMalang, MU 49148', 132, NULL, 'draft', '2025-07-26 13:52:01', NULL),
	(2, 'Ducimus et nostrum nulla et.', 'when-special-return', 'Quaerat delectus aut eveniet. Pariatur repellat at saepe. Explicabo natus laudantium dolorum nemo. Rerum aliquid hic expedita.\r\n\r\nDolor maxime quis expedita explicabo itaque. Vitae voluptatem cupiditate ipsam eligendi.\r\n\r\nDolorem magnam mollitia sapiente repellendus. Explicabo sapiente veniam exercitationem illo. Delectus nobis dolor fugiat laborum et consequuntur explicabo.', 'seminar', 12920.85, '2025-07-21 11:49:51', '2025-07-21 13:49:51', 'Gang Kapten Muslihat No. 04\r\nSabang, SS 95837', 167, '/uploads/workshops/workshop_2.jpg', 'draft', '2025-06-25 17:28:05', '2025-08-21 10:47:27'),
	(3, 'Porro quidem consequuntur dolorum dolorum officiis libero dolores.', 'later-business', 'Necessitatibus ab maxime aliquid. Fugit dolorem id ea accusamus perferendis sint.\r\n\r\nLabore unde dolorum incidunt. Eligendi possimus ducimus sit repellendus odit dolorum.\r\n\r\nAliquid nihil asperiores cupiditate perspiciatis necessitatibus. Ab illum fugiat alias minus nesciunt tenetur. Molestiae veniam alias eaque incidunt aliquam ut. Nisi eaque occaecati laborum accusantium.', 'workshop', 868489.57, '2025-07-25 00:06:35', '2025-07-25 07:06:35', 'Gg. Rajawali Timur No. 4\r\nSorong, AC 15248', 89, '/uploads/workshops/workshop_3.jpg', 'published', '2025-02-01 22:44:56', NULL),
	(4, 'Ut tempore eum doloremque neque.', 'scientist-bring', 'Atque odit tenetur velit. Voluptatibus dolor quidem aliquid neque nesciunt sunt.\r\n\r\nRepudiandae fugiat corrupti minus. Ex temporibus cupiditate cumque vel. Iure omnis libero vel.\r\n\r\nDolorem quo error quis. Modi ad distinctio odio deleniti animi. Quia laboriosam blanditiis et repellendus.', 'seminar', 130334.24, '2025-02-24 05:16:01', '2025-02-24 10:16:01', 'Gang Sadang Serang No. 89\r\nPontianak, SU 40286', 140, NULL, 'published', '2025-07-05 09:34:11', NULL),
	(5, 'Laboriosam consequatur laborum laboriosam incidunt eos veritatis a.', 'job-although', 'Qui maiores eius necessitatibus accusamus reiciendis inventore reprehenderit. Nobis suscipit animi non quia.\r\n\r\nDignissimos eius ea itaque libero saepe ipsam. Sed fuga possimus eveniet voluptas.\r\n\r\nCommodi voluptates odio magni. Deleniti distinctio voluptatum cumque reprehenderit doloribus voluptate. Ipsam a doloremque quos.', 'seminar', 911095.09, '2025-07-13 19:55:16', '2025-07-14 03:55:16', 'Jl. W.R. Supratman No. 894\r\nPrabumulih, JI 65961', 99, NULL, 'published', '2025-04-29 18:42:12', NULL),
	(6, 'Harum dignissimos enim blanditiis.', 'even-form-yet', 'Unde asperiores cupiditate cum expedita soluta. Deserunt corporis ab libero voluptates dignissimos.\r\n\r\nTemporibus illum fugit ea. Explicabo distinctio iste ad blanditiis reprehenderit. Natus ipsum laborum cum voluptatem omnis.\r\n\r\nEa asperiores doloribus quia quo ex. Animi quo error labore quia. Animi at voluptate explicabo praesentium.', 'workshop', 552740.70, '2025-03-26 13:31:21', '2025-03-26 21:31:21', 'Jl. Setiabudhi No. 1\r\nCirebon, DI Yogyakarta 03494', 51, NULL, 'draft', '2025-02-17 07:17:48', '2025-07-27 22:06:37'),
	(7, 'Ex repellendus dignissimos debitis architecto beatae deleniti.', 'thank-letter-or', 'Provident quae id doloremque consectetur odit rem. Necessitatibus corrupti blanditiis dolorum officia ratione. Voluptas temporibus alias totam.\r\n\r\nEligendi sed quis nostrum voluptatem accusantium. Quia corrupti suscipit libero.\r\n\r\nReprehenderit quasi necessitatibus nemo illo.', 'seminar', 433659.30, '2025-03-20 14:05:46', '2025-03-20 16:05:46', 'Gang Stasiun Wonokromo No. 35\r\nPangkalpinang, SS 87531', 189, '/uploads/workshops/workshop_7.jpg', 'completed', '2025-07-05 16:18:31', '2025-01-23 16:43:17'),
	(8, 'Labore sapiente in aperiam illo quibusdam.', 'yet-value-reason', 'Magni odit numquam accusantium tempore sit aut. Expedita hic ipsam ex adipisci assumenda. Sapiente vero explicabo ipsa.\r\n\r\nSunt aliquam illum quidem repudiandae quos. Deleniti qui nostrum fugit voluptates. Dignissimos molestias distinctio tempora voluptas laborum.\r\n\r\nVoluptatem totam consequatur. Aliquid fugiat ut nobis eius voluptatum.', 'seminar', 683316.43, '2025-04-25 08:31:14', '2025-04-25 13:31:14', 'Jalan R.E Martadinata No. 09\r\nTangerang, Jawa Barat 24870', 57, '/uploads/workshops/workshop_8.jpg', 'published', '2025-05-15 13:32:18', '2025-07-10 22:03:14'),
	(9, 'Perferendis ipsum fugit sunt.', 'rise-source', 'Saepe accusantium in illum quod.\r\n\r\nA dicta amet animi aperiam molestias minus. Optio assumenda nihil odit.\r\n\r\nVoluptate maxime optio harum cumque beatae. Vero repellendus laudantium dolorum mollitia. Laudantium adipisci a ducimus.', 'seminar', 370737.27, '2025-09-14 22:22:05', '2025-09-15 04:22:05', 'Gg. Rajiman No. 0\r\nBima, SU 68048', 59, '/uploads/workshops/workshop_9.jpg', 'published', '2025-05-10 14:45:20', '2025-03-21 01:14:15'),
	(10, 'Laborum rerum necessitatibus suscipit totam.', 'option-civil-soon', 'Aperiam laborum voluptates. Vero adipisci ea ut illo distinctio doloribus.\r\n\r\nTempora inventore quia omnis provident.\r\n\r\nDoloremque tenetur quibusdam perferendis veniam laboriosam neque saepe. Illum dolore saepe ducimus dicta nobis. Neque numquam corrupti in architecto.', 'workshop', 500779.99, '2025-08-07 17:29:38', '2025-08-07 19:29:38', 'Jl. H.J Maemunah No. 5\r\nTanjungbalai, Kalimantan Selatan 44656', 42, '/uploads/workshops/workshop_10.jpg', 'published', '2025-06-26 09:58:17', '2025-08-27 15:08:12');

-- Dumping structure for table academy_lite.workshop_materials
CREATE TABLE IF NOT EXISTS `workshop_materials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  CONSTRAINT `workshop_materials_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table academy_lite.workshop_materials: ~10 rows (approximately)
INSERT INTO `workshop_materials` (`id`, `workshop_id`, `title`, `file_path`, `file_type`, `created_at`) VALUES
	(1, 701, 'Introduction to HTML', 'materials/workshop701/html_intro.pdf', 'pdf', '2025-09-16 11:19:41'),
	(2, 701, 'CSS Basics Slides', 'materials/workshop701/css_basics.pptx', 'pptx', '2025-09-16 11:19:41'),
	(3, 701, 'JavaScript Demo', 'materials/workshop701/js_demo.mp4', 'mp4', '2025-09-16 11:19:41'),
	(4, 702, 'Python for Data Science', 'materials/workshop702/python_ds.pdf', 'pdf', '2025-09-16 11:19:41'),
	(5, 702, 'Jupyter Notebook Example', 'materials/workshop702/example_notebook.ipynb', 'ipynb', '2025-09-16 11:19:41'),
	(6, 702, 'Dataset Sample', 'materials/workshop702/sample_dataset.csv', 'csv', '2025-09-16 11:19:41'),
	(7, 703, 'Design Principles', 'materials/workshop703/design_principles.pdf', 'pdf', '2025-09-16 11:19:41'),
	(8, 703, 'Figma Prototype', 'materials/workshop703/prototype.fig', 'fig', '2025-09-16 11:19:41'),
	(9, 703, 'Case Study Video', 'materials/workshop703/case_study.mp4', 'mp4', '2025-09-16 11:19:41'),
	(10, 703, 'Assets Pack', 'materials/workshop703/assets.zip', 'zip', '2025-09-16 11:19:41');

-- Dumping structure for table academy_lite.workshop_participants
CREATE TABLE IF NOT EXISTS `workshop_participants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int unsigned NOT NULL,
  `user_id` int DEFAULT NULL,
  `external_name` varchar(255) DEFAULT NULL,
  `external_email` varchar(255) DEFAULT NULL,
  `role` enum('student','teacher','external') NOT NULL DEFAULT 'external',
  `status` enum('registered','attended','cancelled') NOT NULL DEFAULT 'registered',
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `workshop_participants_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `workshop_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table academy_lite.workshop_participants: ~12 rows (approximately)
INSERT INTO `workshop_participants` (`id`, `workshop_id`, `user_id`, `external_name`, `external_email`, `role`, `status`, `registered_at`) VALUES
	(1, 701, 201, NULL, NULL, 'student', 'registered', '2025-09-16 11:20:05'),
	(2, 701, 202, NULL, NULL, 'student', 'attended', '2025-09-16 11:20:05'),
	(3, 701, 203, NULL, NULL, 'student', 'cancelled', '2025-09-16 11:20:05'),
	(4, 701, 301, NULL, NULL, 'teacher', 'attended', '2025-09-16 11:20:05'),
	(5, 701, NULL, 'Andi Pratama', 'andi@example.com', 'external', 'registered', '2025-09-16 11:20:05'),
	(6, 701, NULL, 'Siti Nurhaliza', 'siti@example.com', 'external', 'attended', '2025-09-16 11:20:05'),
	(7, 702, 204, NULL, NULL, 'student', 'registered', '2025-09-16 11:20:05'),
	(8, 702, 205, NULL, NULL, 'student', 'attended', '2025-09-16 11:20:05'),
	(9, 702, 302, NULL, NULL, 'teacher', 'attended', '2025-09-16 11:20:05'),
	(10, 702, NULL, 'Budi Santoso', 'budi.s@example.com', 'external', 'registered', '2025-09-16 11:20:05'),
	(11, 702, NULL, 'Clara Wijaya', 'clara@example.com', 'external', 'cancelled', '2025-09-16 11:20:05'),
	(12, 702, NULL, 'David Lee', 'david@example.com', 'external', 'attended', '2025-09-16 11:20:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
