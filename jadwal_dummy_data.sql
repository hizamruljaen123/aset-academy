-- Dummy Data for Jadwal Kelas

-- Jadwal untuk Kelas Programming
INSERT INTO `jadwal_kelas` (`kelas_id`, `class_type`, `pertemuan_ke`, `judul_pertemuan`, `tanggal_pertemuan`, `waktu_mulai`, `waktu_selesai`) VALUES
-- Dasar Pemrograman Web
(1, 'programming', 1, 'Introduction to HTML', '2025-09-01', '08:00:00', '10:00:00'),
(1, 'programming', 2, 'Styling with CSS', '2025-09-03', '08:00:00', '10:00:00'),
(1, 'programming', 3, 'JavaScript Fundamentals', '2025-09-05', '08:00:00', '10:00:00'),

-- Backend Development dengan PHP
(2, 'programming', 1, 'PHP Basics', '2025-09-02', '10:00:00', '12:00:00'),
(2, 'programming', 2, 'Connecting to MySQL', '2025-09-04', '10:00:00', '12:00:00'),

-- Frontend Modern dengan React
(3, 'programming', 1, 'React Components', '2025-09-01', '13:00:00', '15:00:00'),
(3, 'programming', 2, 'State and Props', '2025-09-03', '13:00:00', '15:00:00');

-- Jadwal untuk Free Classes (contoh)
-- Asumsikan free_classes memiliki ID yang dimulai dari 1
-- Introduction to Python
INSERT INTO `jadwal_kelas` (`kelas_id`, `class_type`, `pertemuan_ke`, `judul_pertemuan`, `tanggal_pertemuan`, `waktu_mulai`, `waktu_selesai`) VALUES
(1, 'free', 1, 'Python Basics', '2025-09-08', '15:00:00', '16:00:00'),
(1, 'free', 2, 'Data Structures in Python', '2025-09-10', '15:00:00', '16:00:00');
