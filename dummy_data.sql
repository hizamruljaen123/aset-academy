-- Expanded Dummy Data for Academy Lite (V2)
-- Run this script after importing scheme.sql to populate the database.

-- Disable foreign key checks to allow truncating tables in any order.
SET FOREIGN_KEY_CHECKS = 0;

-- Truncate tables in the correct order to respect foreign key constraints.
-- Child tables are truncated before parent tables.
TRUNCATE TABLE `free_class_progress`;
TRUNCATE TABLE `free_class_discussions`;
TRUNCATE TABLE `free_class_enrollments`;
TRUNCATE TABLE `free_class_materials`;
TRUNCATE TABLE `guru_kelas`;
TRUNCATE TABLE `materi_parts`;
TRUNCATE TABLE `materi`;
TRUNCATE TABLE `free_classes`;
TRUNCATE TABLE `kelas_programming`;
TRUNCATE TABLE `siswa`;
TRUNCATE TABLE `users`;

-- Re-enable foreign key checks.
SET FOREIGN_KEY_CHECKS = 1;

-- Insert Users (Expanded V2)
-- Passwords are MD5 hash of 'password'.
INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `role`, `level`, `department`, `status`) VALUES
(1, 'superadmin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Super Admin', 'superadmin@academylite.com', 'super_admin', '1', 'IT', 'Aktif'),
(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin Akademik', 'admin@academylite.com', 'admin', '2', 'Akademik', 'Aktif'),
(3, 'gurubudi', '5f4dcc3b5aa765d61d8327deb882cf99', 'Budi Hartono', 'budi.guru@academylite.com', 'guru', '3', 'Programming', 'Aktif'),
(4, 'gurucitra', '5f4dcc3b5aa765d61d8327deb882cf99', 'Citra Lestari', 'citra.guru@academylite.com', 'guru', '3', 'Programming', 'Aktif'),
(5, 'gurudian', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dian Sastro', 'dian.guru@academylite.com', 'guru', '3', 'Design', 'Aktif'),
(6, 'gurueko', '5f4dcc3b5aa765d61d8327deb882cf99', 'Eko Kurniawan', 'eko.guru@academylite.com', 'guru', '3', 'Database', 'Aktif'),
(7, 'gurufajar', '5f4dcc3b5aa765d61d8327deb882cf99', 'Fajar Nugroho', 'fajar.guru@academylite.com', 'guru', '3', 'Networking', 'Aktif'),
(8, 'gurugita', '5f4dcc3b5aa765d61d8327deb882cf99', 'Gita Savitri', 'gita.guru@academylite.com', 'guru', '3', 'Cloud', 'Aktif'),
(9, 'siswaahmad', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ahmad Rizki', 'ahmad.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(10, 'siswadewi', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dewi Anggraini', 'dewi.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(11, 'siswafitri', '5f4dcc3b5aa765d61d8327deb882cf99', 'Fitriani', 'fitri.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(12, 'siswagalih', '5f4dcc3b5aa765d61d8327deb882cf99', 'Galih Pratama', 'galih.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(13, 'siswahana', '5f4dcc3b5aa765d61d8327deb882cf99', 'Hana Yulita', 'hana.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(14, 'siswaindra', '5f4dcc3b5aa765d61d8327deb882cf99', 'Indra Wijaya', 'indra.siswa@academylite.com', 'siswa', '4', NULL, 'Tidak Aktif'),
(15, 'siswajoko', '5f4dcc3b5aa765d61d8327deb882cf99', 'Joko Susilo', 'joko.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(16, 'siswakartika', '5f4dcc3b5aa765d61d8327deb882cf99', 'Kartika Sari', 'kartika.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(17, 'siswalutfi', '5f4dcc3b5aa765d61d8327deb882cf99', 'Lutfi Halimawan', 'lutfi.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif'),
(18, 'siswamaya', '5f4dcc3b5aa765d61d8327deb882cf99', 'Maya Indah', 'maya.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif');

-- Insert Programming Classes (Expanded V2)
INSERT INTO `kelas_programming` (`id`, `nama_kelas`, `deskripsi`, `level`, `bahasa_program`, `durasi`, `harga`, `status`) VALUES
(1, 'Dasar Pemrograman Web', 'Pelajari fondasi web development dengan HTML, CSS, dan JavaScript.', 'Dasar', 'HTML, CSS, JS', 40, 500000.00, 'Aktif'),
(2, 'Backend Development dengan PHP', 'Kuasai backend development menggunakan PHP dan MySQL untuk membangun aplikasi web dinamis.', 'Menengah', 'PHP, MySQL', 60, 750000.00, 'Aktif'),
(3, 'Frontend Modern dengan React', 'Bangun antarmuka pengguna yang interaktif dan responsif dengan React.', 'Lanjutan', 'React, JS', 50, 650000.00, 'Aktif'),
(4, 'Advanced JavaScript', 'Topik lanjutan JavaScript termasuk asynchronous, closures, dan design patterns.', 'Lanjutan', 'JavaScript', 45, 800000.00, 'Aktif'),
(5, 'Database Design & SQL', 'Pelajari cara merancang skema database yang efisien dan menguasai SQL.', 'Menengah', 'SQL', 55, 700000.00, 'Tidak Aktif'),
(6, 'Cloud Fundamentals with AWS', 'Pengenalan layanan cloud computing dari Amazon Web Services.', 'Dasar', 'AWS', 30, 450000.00, 'Aktif'),
(7, 'UI/UX Design for Beginners', 'Prinsip dasar desain antarmuka dan pengalaman pengguna.', 'Dasar', 'Figma, Sketch', 35, 400000.00, 'Aktif');

-- Update classes with meeting links
UPDATE `kelas_programming` SET `online_meet_link` = 'https://meet.google.com/abc-xyz-pqr' WHERE `id` = 1;
UPDATE `kelas_programming` SET `online_meet_link` = 'https://zoom.us/j/123456789' WHERE `id` = 3;

-- Insert Teacher Assignments (Expanded V2)
INSERT INTO `guru_kelas` (`guru_id`, `kelas_id`, `status`) VALUES
(3, 1, 'Aktif'), -- Budi Hartono -> Dasar Web
(3, 2, 'Aktif'), -- Budi Hartono -> Backend PHP
(4, 3, 'Aktif'), -- Citra Lestari -> React
(5, 7, 'Aktif'), -- Dian Sastro -> UI/UX Design
(6, 5, 'Aktif'), -- Eko Kurniawan -> Database
(7, 4, 'Tidak Aktif'), -- Fajar Nugroho -> Advanced JS (Kelas Tidak Aktif)
(8, 6, 'Aktif'); -- Gita Savitri -> Cloud AWS

-- Insert Student Profiles (Expanded V2)
INSERT INTO `siswa` (`nis`, `nama_lengkap`, `email`, `no_telepon`, `kelas`, `jurusan`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `status`) VALUES
('S001', 'Ahmad Rizki', 'ahmad.siswa@academylite.com', '081234567890', 'XII-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Merdeka 10, Jakarta', '2005-04-12', 'L', 'Aktif'),
('S002', 'Dewi Anggraini', 'dewi.siswa@academylite.com', '081234567891', 'XII-TKJ', 'Teknik Komputer & Jaringan', 'Jl. Pahlawan 22, Bandung', '2005-08-19', 'P', 'Aktif'),
('S003', 'Fitriani', 'fitri.siswa@academylite.com', '081234567892', 'XI-MM', 'Multimedia', 'Jl. Asia Afrika 30, Surabaya', '2006-01-15', 'P', 'Aktif'),
('S004', 'Galih Pratama', 'galih.siswa@academylite.com', '081234567893', 'XI-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Diponegoro 5, Yogyakarta', '2006-03-20', 'L', 'Aktif'),
('S005', 'Hana Yulita', 'hana.siswa@academylite.com', '081234567894', 'X-TKJ', 'Teknik Komputer & Jaringan', 'Jl. Sudirman 88, Medan', '2007-07-07', 'P', 'Aktif'),
('S006', 'Indra Wijaya', 'indra.siswa@academylite.com', '081234567895', 'X-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Gajah Mada 12, Semarang', '2007-11-25', 'L', 'Tidak Aktif'),
('S007', 'Joko Susilo', 'joko.siswa@academylite.com', '081234567896', 'XII-MM', 'Multimedia', 'Jl. Hayam Wuruk 15, Denpasar', '2005-02-28', 'L', 'Aktif'),
('S008', 'Kartika Sari', 'kartika.siswa@academylite.com', '081234567897', 'XI-TKJ', 'Teknik Komputer & Jaringan', 'Jl. Teuku Umar 45, Makassar', '2006-06-10', 'P', 'Aktif'),
('S009', 'Lutfi Halimawan', 'lutfi.siswa@academylite.com', '081234567898', 'X-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Imam Bonjol 9, Palembang', '2007-09-01', 'L', 'Aktif'),
('S010', 'Maya Indah', 'maya.siswa@academylite.com', '081234567899', 'XII-RPL', 'Rekayasa Perangkat Lunak', 'Jl. Gatot Subroto 101, Jakarta', '2005-12-12', 'P', 'Aktif');

-- Insert Course Materials (Expanded V2)
INSERT INTO `materi` (`id`, `kelas_id`, `judul`, `deskripsi`) VALUES
(1, 1, 'Pengenalan HTML', 'Dasar-dasar HTML, elemen, dan struktur dokumen.'),
(2, 1, 'Styling dengan CSS', 'Mempelajari cara menghias halaman web dengan CSS.'),
(3, 2, 'Dasar-dasar PHP', 'Sintaks dasar, variabel, dan struktur kontrol dalam PHP.'),
(4, 3, 'Setup Proyek React', 'Menginisialisasi proyek React dan memahami struktur folder.'),
(5, 4, 'Asynchronous JavaScript', 'Memahami Promises dan Async/Await.'),
(6, 5, 'Normalisasi Database', 'Konsep normalisasi dari 1NF hingga 3NF.'),
(7, 6, 'Introduction to AWS S3', 'Dasar penyimpanan objek di cloud dengan AWS S3.'),
(8, 7, 'Prinsip-prinsip Desain UI', 'Mempelajari prinsip fundamental dalam desain antarmuka pengguna.');

-- Insert Material Parts (Expanded V2)
INSERT INTO `materi_parts` (`materi_id`, `part_order`, `part_type`, `part_title`, `part_content`) VALUES
(1, 1, 'video', 'Video: Apa itu HTML?', 'https://www.youtube.com/watch?v=example_html'),
(1, 2, 'pdf', 'Referensi Tag HTML', 'ref_html.pdf'),
(2, 1, 'link', 'Game Interaktif CSS Diner', 'https://flukeout.github.io/'),
(3, 1, 'video', 'Video: Variabel di PHP', 'https://www.youtube.com/watch?v=example_php'),
(5, 1, 'video', 'Video: Penjelasan Promises', 'https://www.youtube.com/watch?v=example_promise'),
(6, 1, 'image', 'Diagram: Bentuk Normal', 'db_normalization.png'),
(7, 1, 'pdf', 'Panduan AWS S3', 'aws_s3_guide.pdf'),
(8, 1, 'link', 'Contoh Desain UI di Dribbble', 'https://dribbble.com/');

-- Insert Free Classes (Expanded V2)
INSERT INTO `free_classes` (`id`, `title`, `description`, `level`, `category`, `duration`, `mentor_id`, `status`) VALUES
(1, 'Pengenalan Git & GitHub', 'Pelajari dasar-dasar version control dengan Git dan cara berkolaborasi di GitHub.', 'Dasar', 'Tools', 2, 3, 'Published'),
(2, 'Tips Produktivitas untuk Developer', 'Tingkatkan produktivitas Anda sebagai developer dengan tools dan teknik modern.', 'Menengah', 'Soft Skills', 1, 4, 'Published'),
(3, 'Dasar-dasar Desain UI/UX', 'Pengenalan prinsip desain antarmuka dan pengalaman pengguna untuk pemula.', 'Dasar', 'Design', 3, 5, 'Draft'),
(4, 'Keamanan Jaringan 101', 'Pengenalan konsep dasar keamanan jaringan untuk pemula.', 'Dasar', 'Networking', 2, 7, 'Published');

-- Update free classes with meeting links
UPDATE `free_classes` SET `online_meet_link` = 'https://meet.google.com/git-123-xyz' WHERE `id` = 1;
UPDATE `free_classes` SET `online_meet_link` = 'https://meet.google.com/prod-456-abc' WHERE `id` = 2;
UPDATE `free_classes` SET `online_meet_link` = 'https://zoom.us/j/987654321' WHERE `id` = 3;
UPDATE `free_classes` SET `online_meet_link` = 'https://meet.google.com/security-789-klm' WHERE `id` = 4;

-- Insert Free Class Enrollments (Expanded V2)
INSERT INTO `free_class_enrollments` (`class_id`, `student_id`, `status`, `progress`) VALUES
(1, 9, 'Enrolled', 50), -- Ahmad Rizki (ID 9) terdaftar di kelas Git
(1, 10, 'Completed', 100), -- Dewi Anggraini (ID 10) menyelesaikan kelas Git
(2, 9, 'Enrolled', 25), -- Ahmad Rizki (ID 9) terdaftar di kelas Produktivitas
(2, 11, 'Enrolled', 0), -- Fitriani (ID 11) terdaftar di kelas Produktivitas
(1, 12, 'Enrolled', 75), -- Galih Pratama (ID 12) terdaftar di kelas Git
(4, 13, 'Enrolled', 10), -- Hana Yulita (ID 13) terdaftar di kelas Keamanan Jaringan
(4, 15, 'Completed', 100), -- Joko Susilo (ID 15) menyelesaikan kelas Keamanan Jaringan
(2, 16, 'Dropped', 40); -- Kartika Sari (ID 16) drop dari kelas Produktivitas

-- Insert Free Class Materials
INSERT INTO `free_class_materials` (`id`, `class_id`, `title`, `description`, `content_type`, `content`, `order`) VALUES
(1, 1, 'Instalasi Git', 'Panduan langkah demi langkah untuk menginstal Git di berbagai sistem operasi.', 'text', 'Silakan unduh Git dari situs resminya dan ikuti petunjuk instalasi untuk Windows, macOS, atau Linux.', 1),
(2, 1, 'Perintah Dasar Git', 'Mempelajari perintah dasar seperti git init, git add, git commit, dan git push.', 'video', 'https://www.youtube.com/watch?v=example_git_basics', 2),
(3, 2, 'Manajemen Waktu dengan Pomodoro', 'Teknik Pomodoro untuk fokus dan manajemen waktu yang lebih baik.', 'pdf', 'pomodoro_technique.pdf', 1),
(4, 4, 'Apa itu IP Address?', 'Memahami konsep dasar alamat IP dan Subnetting.', 'text', 'IP Address adalah label numerik yang ditetapkan untuk setiap perangkat yang terhubung ke jaringan komputer.', 1);

-- Insert Free Class Progress
-- Note: This assumes the enrollment IDs are generated sequentially starting from 1.
INSERT INTO `free_class_progress` (`enrollment_id`, `material_id`, `status`) VALUES
(1, 1, 'Completed'), -- Ahmad di kelas Git, materi Instalasi Git
(1, 2, 'In Progress'), -- Ahmad di kelas Git, materi Perintah Dasar
(2, 1, 'Completed'), -- Dewi di kelas Git, materi Instalasi Git
(2, 2, 'Completed'), -- Dewi di kelas Git, materi Perintah Dasar
(3, 3, 'In Progress'); -- Ahmad di kelas Produktivitas, materi Pomodoro

-- Insert Free Class Discussions
INSERT INTO `free_class_discussions` (`class_id`, `user_id`, `parent_id`, `message`) VALUES
(1, 9, NULL, 'Halo, saya kesulitan saat instalasi Git di Windows 11. Apakah ada yang bisa membantu?'), -- Ahmad (user_id 9) bertanya di kelas Git
(1, 3, 1, 'Tentu, Ahmad. Coba pastikan Anda mencentang opsi "Add to PATH" saat proses instalasi. Itu biasanya menyelesaikan masalah.'), -- Guru Budi (user_id 3) menjawab
(1, 9, 2, 'Terima kasih, Pak Budi! Sekarang sudah berhasil. Mantap.'), -- Ahmad membalas
(2, 11, NULL, 'Teknik Pomodoro ini sangat membantu, terima kasih materinya!'); -- Fitriani (user_id 11) di kelas Produktivitas