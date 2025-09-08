-- Complete Dummy Data for Academy Lite (with Attendance)
-- This script resets and populates all necessary tables.

-- Disable foreign key checks to allow truncating tables.
SET FOREIGN_KEY_CHECKS = 0;

-- Truncate tables in the correct order (child tables first).
TRUNCATE TABLE `absensi`;
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

-- Insert Users
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
(10, 'siswadewi', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dewi Anggraini', 'dewi.siswa@academylite.com', 'siswa', '4', NULL, 'Aktif');

-- Insert Siswa Profiles
INSERT INTO `siswa` (`id`, `nis`, `nama_lengkap`, `email`, `no_telepon`, `kelas`, `jurusan`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `status`) VALUES
(1, 'S001', 'Ahmad Rizki', 'ahmad.siswa@academylite.com', '081234567890', 'Dasar Pemrograman Web', 'Rekayasa Perangkat Lunak', 'Jl. Merdeka 10, Jakarta', '2005-04-12', 'L', 'Aktif'),
(2, 'S002', 'Dewi Anggraini', 'dewi.siswa@academylite.com', '081234567891', 'Dasar Pemrograman Web', 'Teknik Komputer & Jaringan', 'Jl. Pahlawan 22, Bandung', '2005-08-19', 'P', 'Aktif'),
(3, 'S003', 'Fitriani', 'fitri.siswa@academylite.com', '081234567892', 'Dasar Pemrograman Web', 'Multimedia', 'Jl. Asia Afrika 30, Surabaya', '2006-01-15', 'P', 'Aktif'),
(4, 'S004', 'Galih Pratama', 'galih.siswa@academylite.com', '081234567893', 'Backend Development dengan PHP', 'Rekayasa Perangkat Lunak', 'Jl. Diponegoro 5, Yogyakarta', '2006-03-20', 'L', 'Aktif'),
(5, 'S005', 'Hana Yulita', 'hana.siswa@academylite.com', '081234567894', 'Backend Development dengan PHP', 'Teknik Komputer & Jaringan', 'Jl. Sudirman 88, Medan', '2007-07-07', 'P', 'Aktif'),
(7, 'S007', 'Joko Susilo', 'joko.siswa@academylite.com', '081234567896', 'Frontend Modern dengan React', 'Multimedia', 'Jl. Hayam Wuruk 15, Denpasar', '2005-02-28', 'L', 'Aktif'),
(8, 'S008', 'Kartika Sari', 'kartika.siswa@academylite.com', '081234567897', 'Frontend Modern dengan React', 'Teknik Komputer & Jaringan', 'Jl. Teuku Umar 45, Makassar', '2006-06-10', 'P', 'Aktif');

-- Insert Programming Classes
INSERT INTO `kelas_programming` (`id`, `nama_kelas`, `deskripsi`, `level`, `bahasa_program`, `durasi`, `harga`, `status`, `online_meet_link`) VALUES
(1, 'Dasar Pemrograman Web', 'Pelajari fondasi web development dengan HTML, CSS, dan JavaScript.', 'Dasar', 'HTML, CSS, JS', 40, 500000.00, 'Aktif', 'https://meet.google.com/abc-def-ghi'),
(2, 'Backend Development dengan PHP', 'Kuasai backend development menggunakan PHP dan MySQL.', 'Menengah', 'PHP, MySQL', 60, 750000.00, 'Aktif', NULL),
(3, 'Frontend Modern dengan React', 'Bangun antarmuka pengguna yang interaktif dengan React.', 'Lanjutan', 'React, JS', 50, 650000.00, 'Aktif', 'https://meet.google.com/jkl-mno-pqr');

-- Insert Teacher Assignments
INSERT INTO `guru_kelas` (`guru_id`, `kelas_id`, `status`) VALUES
(3, 1, 'Aktif'),
(3, 2, 'Aktif'),
(4, 3, 'Aktif');

-- Insert Attendance Data
-- Day 1
INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`) VALUES
(1, 1, 3, '2025-09-01', 'Hadir', 'Tepat waktu'),
(2, 1, 3, '2025-09-01', 'Hadir', 'Aktif di kelas'),
(3, 1, 3, '2025-09-01', 'Sakit', 'Surat dokter menyusul'),
(4, 2, 3, '2025-09-01', 'Hadir', ''),
(5, 2, 3, '2025-09-01', 'Hadir', ''),
(7, 3, 4, '2025-09-01', 'Izin', 'Acara keluarga'),
(8, 3, 4, '2025-09-01', 'Hadir', '');

-- Day 2
INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`) VALUES
(1, 1, 3, '2025-09-02', 'Hadir', ''),
(2, 1, 3, '2025-09-02', 'Alpa', 'Tanpa keterangan'),
(3, 1, 3, '2025-09-02', 'Sakit', 'Masih dalam pemulihan'),
(4, 2, 3, '2025-09-02', 'Hadir', 'Sangat baik'),
(5, 2, 3, '2025-09-02', 'Hadir', ''),
(7, 3, 4, '2025-09-02', 'Hadir', ''),
(8, 3, 4, '2025-09-02', 'Hadir', '');

-- Day 3
INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`) VALUES
(1, 1, 3, '2025-09-03', 'Hadir', ''),
(2, 1, 3, '2025-09-03', 'Hadir', ''),
(3, 1, 3, '2025-09-03', 'Hadir', ''),
(4, 2, 3, '2025-09-03', 'Izin', 'Mengurus dokumen'),
(5, 2, 3, '2025-09-03', 'Hadir', ''),
(7, 3, 4, '2025-09-03', 'Alpa', 'Tidak ada kabar'),
(8, 3, 4, '2025-09-03', 'Hadir', 'Partisipasi baik');

-- Re-enable foreign key checks.
SET FOREIGN_KEY_CHECKS = 1;
