-- Dummy Data for Absensi Table (V2 - Corrected Foreign Keys)

-- This script assumes the student, class, and teacher IDs from the main dummy_data.sql file.

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
