-- Dummy Data for Absensi Table

-- Assuming the following relationships:
-- Kelas 1 (Dasar Web) is taught by Guru 3 (Budi Hartono)
-- Siswa 1, 2, 3 are in Kelas 1

-- Kelas 2 (Backend PHP) is taught by Guru 3 (Budi Hartono)
-- Siswa 4, 5 are in Kelas 2

-- Kelas 3 (Frontend React) is taught by Guru 4 (Citra Lestari)
-- Siswa 7, 8 are in Kelas 3

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
