-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2025 at 04:03 AM
-- Server version: 8.0.43-cll-lve
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assetaca_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int NOT NULL,
  `jadwal_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id` int NOT NULL,
  `jadwal_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL,
  `catatan` text,
  `waktu_absensi` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `class_type` enum('premium','gratis') NOT NULL COMMENT 'To distinguish between kelas_premium and kelas_gratis',
  `teacher_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `due_date` datetime DEFAULT NULL,
  `grades_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_access_logs`
--

CREATE TABLE `class_access_logs` (
  `id` int NOT NULL,
  `enrollment_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `action` enum('Grant Access','Revoke Access','Suspend Access','Restore Access','Update Status') NOT NULL,
  `previous_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) NOT NULL,
  `reason` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_categories`
--

CREATE TABLE `class_categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `class_type` enum('premium','free') NOT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_bank_accounts`
--

CREATE TABLE `company_bank_accounts` (
  `id` int NOT NULL,
  `bank_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bank_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `account_holder` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CV ASET MEDIA CEMERLANG',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_bank`
--

CREATE TABLE `daftar_bank` (
  `id_bank` int NOT NULL,
  `kode_bank` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_bank` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_likes`
--

CREATE TABLE `forum_likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `thread_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `id` int NOT NULL,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE `forum_threads` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `views` int DEFAULT '0',
  `is_pinned` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_thread_views`
--

CREATE TABLE `forum_thread_views` (
  `id` int NOT NULL,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL,
  `viewed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_classes`
--

CREATE TABLE `free_classes` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `level` enum('Dasar','Menengah','Lanjutan') NOT NULL DEFAULT 'Dasar',
  `category` varchar(100) NOT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `duration` int NOT NULL DEFAULT '1' COMMENT 'Duration in hours',
  `mentor_id` int DEFAULT NULL,
  `max_students` int DEFAULT NULL COMMENT 'Maximum number of students allowed',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Draft','Coming Soon','Published','Archived') NOT NULL DEFAULT 'Draft' COMMENT 'Status kelas: Draft (belum siap), Coming Soon (sudah dibuat tapi menunggu persiapan), Published (sudah siap), Archived (diarsipkan)',
  `online_meet_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_class_discussions`
--

CREATE TABLE `free_class_discussions` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_class_enrollments`
--

CREATE TABLE `free_class_enrollments` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `student_id` int NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Enrolled','Completed','Dropped') NOT NULL DEFAULT 'Enrolled',
  `progress` int NOT NULL DEFAULT '0' COMMENT 'Progress percentage',
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_class_materials`
--

CREATE TABLE `free_class_materials` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `content_type` enum('text','video','pdf','link') NOT NULL DEFAULT 'text',
  `content` text NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_class_progress`
--

CREATE TABLE `free_class_progress` (
  `id` int NOT NULL,
  `enrollment_id` int NOT NULL,
  `material_id` int NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` timestamp NULL DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` int NOT NULL,
  `guru_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `assigned_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `id` int NOT NULL,
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
  `status` enum('Selesai','Proses','Ditunda','Dibatalkan','Belum Mulai') DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `jadwal_kelas_view`
-- (See below for the actual view)
--
CREATE TABLE `jadwal_kelas_view` (
`id` int
,`kelas_id` int
,`class_type` varchar(50)
,`guru_id` int
,`pertemuan_ke` int
,`judul_pertemuan` varchar(255)
,`tanggal_pertemuan` date
,`waktu_mulai` time
,`waktu_selesai` time
,`created_at` timestamp
,`updated_at` timestamp
,`nama_kelas` varchar(255)
,`deskripsi_kelas` mediumtext
,`level_kelas` varchar(8)
,`kategori_kelas` varchar(100)
,`status_kelas` varchar(11)
,`nama_guru` varchar(100)
,`username_guru` varchar(50)
,`role_guru` enum('super_admin','admin','guru','siswa','user')
,`durasi_kelas` bigint
,`harga_kelas` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_programming`
--

CREATE TABLE `kelas_programming` (
  `id` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `deskripsi` text,
  `level` enum('Dasar','Menengah','Lanjutan') NOT NULL,
  `bahasa_program` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `durasi` int NOT NULL DEFAULT '1' COMMENT 'Durasi dalam jam',
  `harga` decimal(10,2) NOT NULL,
  `diskon` decimal(5,2) DEFAULT '0.00',
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` enum('Tidak Aktif','Coming Soon','Aktif') NOT NULL DEFAULT 'Tidak Aktif' COMMENT 'Status kelas: Tidak Aktif (belum siap), Coming Soon (sudah dibuat tapi menunggu persiapan), Aktif (sudah siap)',
  `online_meet_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi_parts`
--

CREATE TABLE `materi_parts` (
  `id` int NOT NULL,
  `materi_id` int NOT NULL,
  `part_order` int NOT NULL,
  `part_type` enum('image','video','pdf','link') NOT NULL,
  `part_title` varchar(255) NOT NULL,
  `part_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi_progress`
--

CREATE TABLE `materi_progress` (
  `id` int NOT NULL,
  `materi_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `status` enum('Not Started','In Progress','Completed') NOT NULL DEFAULT 'Not Started',
  `last_accessed` timestamp NULL DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premium_class_discussions`
--

CREATE TABLE `premium_class_discussions` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premium_class_enrollments`
--

CREATE TABLE `premium_class_enrollments` (
  `id` int NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premium_class_progress`
--

CREATE TABLE `premium_class_progress` (
  `id` int NOT NULL,
  `enrollment_id` int NOT NULL,
  `material_id` int NOT NULL,
  `status` enum('Not Started','In Progress','Completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Started',
  `last_accessed` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg_districts`
--

CREATE TABLE `reg_districts` (
  `id` char(6) NOT NULL,
  `regency_id` char(4) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `reg_provinces`
--

CREATE TABLE `reg_provinces` (
  `id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `reg_regencies`
--

CREATE TABLE `reg_regencies` (
  `id` char(4) NOT NULL,
  `province_id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `reg_villages`
--

CREATE TABLE `reg_villages` (
  `id` char(10) NOT NULL,
  `district_id` char(6) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `nis` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_telepon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kelas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jurusan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text,
  `foto_profil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif','Lulus') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_submissions`
--

CREATE TABLE `student_submissions` (
  `id` int NOT NULL,
  `assignment_id` int NOT NULL,
  `student_id` int NOT NULL,
  `submission_content` text,
  `submission_file` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` float DEFAULT NULL,
  `feedback` text,
  `status` enum('submitted','graded','late') NOT NULL DEFAULT 'submitted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` tinyint UNSIGNED DEFAULT '5',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('super_admin','admin','guru','siswa','user') NOT NULL DEFAULT 'user',
  `level` enum('1','2','3','4','5') NOT NULL DEFAULT '5' COMMENT '1=Super Admin, 2=Admin, 3=Guru, 4=Siswa, 5=User',
  `department` varchar(50) DEFAULT NULL COMMENT 'Department or division',
  `timezone` varchar(50) DEFAULT 'Asia/Jakarta' COMMENT 'User timezone for attendance calculations',
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int NOT NULL,
  `role` enum('super_admin','admin','guru','siswa','user') NOT NULL,
  `level` enum('1','2','3','4','5') NOT NULL,
  `module` varchar(50) NOT NULL COMMENT 'Module name (dashboard, siswa, kelas, etc)',
  `action` varchar(50) NOT NULL COMMENT 'Action (create, read, update, delete, view)',
  `allowed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `id` int UNSIGNED NOT NULL,
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
  `status` enum('draft','published','completed','coming soon') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `online_meet` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `workshop_guests`
--

CREATE TABLE `workshop_guests` (
  `id` int UNSIGNED NOT NULL,
  `workshop_id` int UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `asal_kampus_sekolah` varchar(255) NOT NULL,
  `usia` int NOT NULL,
  `pekerjaan` enum('Pelajar','Mahasiswa','Karyawan','Wirausaha','PNS','Guru/Dosen','Lainnya') NOT NULL DEFAULT 'Pelajar',
  `no_wa_telegram` varchar(20) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `workshop_materials`
--

CREATE TABLE `workshop_materials` (
  `id` int UNSIGNED NOT NULL,
  `workshop_id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `workshop_participants`
--

CREATE TABLE `workshop_participants` (
  `id` int UNSIGNED NOT NULL,
  `workshop_id` int UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `external_name` varchar(255) DEFAULT NULL,
  `external_email` varchar(255) DEFAULT NULL,
  `role` enum('student','teacher','external') NOT NULL DEFAULT 'external',
  `status` enum('registered','attended','cancelled') NOT NULL DEFAULT 'registered',
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_absensi_siswa` (`jadwal_id`,`siswa_id`),
  ADD KEY `fk_absensi_siswa` (`siswa_id`);

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_absensi` (`jadwal_id`,`guru_id`),
  ADD KEY `jadwal_id` (`jadwal_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `class_access_logs`
--
ALTER TABLE `class_access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_id` (`enrollment_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `class_categories`
--
ALTER TABLE `class_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_class_categories_slug` (`slug`),
  ADD KEY `idx_class_categories_class_type` (`class_type`),
  ADD KEY `idx_class_categories_is_active` (`is_active`);

--
-- Indexes for table `company_bank_accounts`
--
ALTER TABLE `company_bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_bank`
--
ALTER TABLE `daftar_bank`
  ADD PRIMARY KEY (`id_bank`),
  ADD UNIQUE KEY `kode_bank` (`kode_bank`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `forum_likes`
--
ALTER TABLE `forum_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`user_id`,`thread_id`,`post_id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_unique` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `idx_slug` (`slug`);

--
-- Indexes for table `forum_thread_views`
--
ALTER TABLE `forum_thread_views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_view` (`thread_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `free_classes`
--
ALTER TABLE `free_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`mentor_id`),
  ADD KEY `fk_free_classes_category` (`category_id`);

--
-- Indexes for table `free_class_discussions`
--
ALTER TABLE `free_class_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `free_class_enrollments`
--
ALTER TABLE `free_class_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_enrollment` (`class_id`,`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `free_class_materials`
--
ALTER TABLE `free_class_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `free_class_progress`
--
ALTER TABLE `free_class_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_progress` (`enrollment_id`,`material_id`),
  ADD KEY `enrollment_id` (`enrollment_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `fk_jadwal_guru` (`guru_id`);

--
-- Indexes for table `kelas_programming`
--
ALTER TABLE `kelas_programming`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kelas` (`nama_kelas`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `materi_parts`
--
ALTER TABLE `materi_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materi_id` (`materi_id`);

--
-- Indexes for table `materi_progress`
--
ALTER TABLE `materi_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_progress` (`materi_id`,`siswa_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `verified_by` (`verified_by`),
  ADD KEY `fk_payments_bank_account` (`bank_account_id`);

--
-- Indexes for table `premium_class_discussions`
--
ALTER TABLE `premium_class_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `premium_class_enrollments`
--
ALTER TABLE `premium_class_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_enrollment` (`class_id`,`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `access_granted_by` (`access_granted_by`);

--
-- Indexes for table `premium_class_progress`
--
ALTER TABLE `premium_class_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_enrollment_material` (`enrollment_id`,`material_id`),
  ADD KEY `enrollment_id` (`enrollment_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `reg_districts`
--
ALTER TABLE `reg_districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_regency` (`regency_id`);

--
-- Indexes for table `reg_provinces`
--
ALTER TABLE `reg_provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_regencies`
--
ALTER TABLE `reg_regencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_province` (`province_id`);

--
-- Indexes for table `reg_villages`
--
ALTER TABLE `reg_villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_district` (`district_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `idx_nis` (`nis`),
  ADD KEY `idx_nama` (`nama_lengkap`),
  ADD KEY `idx_kelas` (`kelas`);

--
-- Indexes for table `student_submissions`
--
ALTER TABLE `student_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `FK1_users` (`user_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_permission` (`role`,`level`,`module`,`action`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_status_type` (`status`,`type`);

--
-- Indexes for table `workshop_guests`
--
ALTER TABLE `workshop_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `workshop_materials`
--
ALTER TABLE `workshop_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `workshop_participants`
--
ALTER TABLE `workshop_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshop_id` (`workshop_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_access_logs`
--
ALTER TABLE `class_access_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_categories`
--
ALTER TABLE `class_categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_bank_accounts`
--
ALTER TABLE `company_bank_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daftar_bank`
--
ALTER TABLE `daftar_bank`
  MODIFY `id_bank` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_likes`
--
ALTER TABLE `forum_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_thread_views`
--
ALTER TABLE `forum_thread_views`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_classes`
--
ALTER TABLE `free_classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_class_discussions`
--
ALTER TABLE `free_class_discussions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_class_enrollments`
--
ALTER TABLE `free_class_enrollments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_class_materials`
--
ALTER TABLE `free_class_materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_class_progress`
--
ALTER TABLE `free_class_progress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas_programming`
--
ALTER TABLE `kelas_programming`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi_parts`
--
ALTER TABLE `materi_parts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi_progress`
--
ALTER TABLE `materi_progress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `premium_class_discussions`
--
ALTER TABLE `premium_class_discussions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `premium_class_enrollments`
--
ALTER TABLE `premium_class_enrollments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `premium_class_progress`
--
ALTER TABLE `premium_class_progress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_submissions`
--
ALTER TABLE `student_submissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workshop_guests`
--
ALTER TABLE `workshop_guests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workshop_materials`
--
ALTER TABLE `workshop_materials`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workshop_participants`
--
ALTER TABLE `workshop_participants`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Structure for view `jadwal_kelas_view`
--
DROP TABLE IF EXISTS `jadwal_kelas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwal_kelas_view`  AS SELECT `jk`.`id` AS `id`, `jk`.`kelas_id` AS `kelas_id`, `jk`.`class_type` AS `class_type`, `jk`.`guru_id` AS `guru_id`, `jk`.`pertemuan_ke` AS `pertemuan_ke`, `jk`.`judul_pertemuan` AS `judul_pertemuan`, `jk`.`tanggal_pertemuan` AS `tanggal_pertemuan`, `jk`.`waktu_mulai` AS `waktu_mulai`, `jk`.`waktu_selesai` AS `waktu_selesai`, `jk`.`created_at` AS `created_at`, `jk`.`updated_at` AS `updated_at`, (case when (`jk`.`class_type` = 'premium') then `kp`.`nama_kelas` when (`jk`.`class_type` = 'gratis') then `fc`.`title` else 'Unknown Class' end) AS `nama_kelas`, (case when (`jk`.`class_type` = 'premium') then `kp`.`deskripsi` when (`jk`.`class_type` = 'gratis') then `fc`.`description` else NULL end) AS `deskripsi_kelas`, (case when (`jk`.`class_type` = 'premium') then `kp`.`level` when (`jk`.`class_type` = 'gratis') then `fc`.`level` else NULL end) AS `level_kelas`, (case when (`jk`.`class_type` = 'premium') then `kp`.`bahasa_program` when (`jk`.`class_type` = 'gratis') then `fc`.`category` else NULL end) AS `kategori_kelas`, (case when (`jk`.`class_type` = 'premium') then `kp`.`status` when (`jk`.`class_type` = 'gratis') then `fc`.`status` else 'Unknown' end) AS `status_kelas`, `u`.`nama_lengkap` AS `nama_guru`, `u`.`username` AS `username_guru`, `u`.`role` AS `role_guru`, (case when (`jk`.`class_type` = 'premium') then `kp`.`durasi` else NULL end) AS `durasi_kelas`, (case when (`jk`.`class_type` = 'premium') then `kp`.`harga` else 0 end) AS `harga_kelas` FROM (((`jadwal_kelas` `jk` left join `kelas_programming` `kp` on(((`jk`.`kelas_id` = `kp`.`id`) and (`jk`.`class_type` = 'premium')))) left join `free_classes` `fc` on(((`jk`.`kelas_id` = `fc`.`id`) and (`jk`.`class_type` = 'gratis')))) left join `users` `u` on((`jk`.`guru_id` = `u`.`id`))) WHERE ((`jk`.`class_type` is not null) AND (`jk`.`guru_id` is not null) AND (((`jk`.`class_type` = 'premium') AND (`kp`.`status` in ('Aktif','Coming Soon'))) OR ((`jk`.`class_type` = 'gratis') AND (`fc`.`status` in ('Published','Coming Soon'))))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_absensi_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD CONSTRAINT `absensi_guru_ibfk_1` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_guru_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_access_logs`
--
ALTER TABLE `class_access_logs`
  ADD CONSTRAINT `access_logs_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `access_logs_enrollment_fk` FOREIGN KEY (`enrollment_id`) REFERENCES `premium_class_enrollments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_likes`
--
ALTER TABLE `forum_likes`
  ADD CONSTRAINT `forum_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_likes_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_likes_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_posts_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD CONSTRAINT `forum_threads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_threads_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `forum_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_thread_views`
--
ALTER TABLE `forum_thread_views`
  ADD CONSTRAINT `forum_thread_views_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_thread_views_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `free_classes`
--
ALTER TABLE `free_classes`
  ADD CONSTRAINT `fk_free_classes_category` FOREIGN KEY (`category_id`) REFERENCES `free_class_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `free_classes_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `free_class_discussions`
--
ALTER TABLE `free_class_discussions`
  ADD CONSTRAINT `free_class_discussions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `free_class_discussions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `free_class_discussions_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `free_class_discussions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `free_class_enrollments`
--
ALTER TABLE `free_class_enrollments`
  ADD CONSTRAINT `free_class_enrollments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `free_class_enrollments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `free_class_materials`
--
ALTER TABLE `free_class_materials`
  ADD CONSTRAINT `free_class_materials_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `free_classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `free_class_progress`
--
ALTER TABLE `free_class_progress`
  ADD CONSTRAINT `free_class_progress_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `free_class_enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `free_class_progress_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `free_class_materials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD CONSTRAINT `guru_kelas_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jadwal_kelas_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materi_parts`
--
ALTER TABLE `materi_parts`
  ADD CONSTRAINT `materi_parts_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materi_progress`
--
ALTER TABLE `materi_progress`
  ADD CONSTRAINT `materi_progress_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_bank_account` FOREIGN KEY (`bank_account_id`) REFERENCES `company_bank_accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `premium_class_discussions`
--
ALTER TABLE `premium_class_discussions`
  ADD CONSTRAINT `premium_class_discussions_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `premium_class_discussions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `premium_class_discussions_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `premium_class_discussions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `premium_class_enrollments`
--
ALTER TABLE `premium_class_enrollments`
  ADD CONSTRAINT `premium_enrollments_admin_fk` FOREIGN KEY (`access_granted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `premium_enrollments_class_fk` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `premium_enrollments_payment_fk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `premium_enrollments_student_fk` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `premium_class_progress`
--
ALTER TABLE `premium_class_progress`
  ADD CONSTRAINT `premium_class_progress_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `premium_class_enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `premium_class_progress_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reg_districts`
--
ALTER TABLE `reg_districts`
  ADD CONSTRAINT `fk_regency` FOREIGN KEY (`regency_id`) REFERENCES `reg_regencies` (`id`);

--
-- Constraints for table `reg_regencies`
--
ALTER TABLE `reg_regencies`
  ADD CONSTRAINT `fk_province` FOREIGN KEY (`province_id`) REFERENCES `reg_provinces` (`id`);

--
-- Constraints for table `reg_villages`
--
ALTER TABLE `reg_villages`
  ADD CONSTRAINT `fk_district` FOREIGN KEY (`district_id`) REFERENCES `reg_districts` (`id`);

--
-- Constraints for table `student_submissions`
--
ALTER TABLE `student_submissions`
  ADD CONSTRAINT `student_submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK1_users` FOREIGN KEY (`user_id`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `workshop_guests`
--
ALTER TABLE `workshop_guests`
  ADD CONSTRAINT `workshop_guests_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workshop_materials`
--
ALTER TABLE `workshop_materials`
  ADD CONSTRAINT `workshop_materials_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workshop_participants`
--
ALTER TABLE `workshop_participants`
  ADD CONSTRAINT `workshop_participants_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `workshop_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;