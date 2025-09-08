-- Dummy Data for Absensi Table (V3 - Dynamic & Safe)

-- This script dynamically fetches IDs to ensure foreign key constraints are met.

-- Clear previous dummy data to prevent duplicates
TRUNCATE TABLE `absensi`;

-- Set variables for teacher IDs
SET @guru_budi = (SELECT id FROM users WHERE username = 'gurubudi');
SET @guru_citra = (SELECT id FROM users WHERE username = 'gurucitra');

-- Set variables for class IDs
SET @kelas_web = (SELECT id FROM kelas_programming WHERE nama_kelas = 'Dasar Pemrograman Web');
SET @kelas_php = (SELECT id FROM kelas_programming WHERE nama_kelas = 'Backend Development dengan PHP');
SET @kelas_react = (SELECT id FROM kelas_programming WHERE nama_kelas = 'Frontend Modern dengan React');

-- Set variables for student IDs
SET @siswa_ahmad = (SELECT id FROM siswa WHERE nis = 'S001');
SET @siswa_dewi = (SELECT id FROM siswa WHERE nis = 'S002');
SET @siswa_fitri = (SELECT id FROM siswa WHERE nis = 'S003');
SET @siswa_galih = (SELECT id FROM siswa WHERE nis = 'S004');
SET @siswa_hana = (SELECT id FROM siswa WHERE nis = 'S005');
SET @siswa_joko = (SELECT id FROM siswa WHERE nis = 'S007');
SET @siswa_kartika = (SELECT id FROM siswa WHERE nis = 'S008');

-- Insert attendance data using variables
-- Day 1
INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_web, @guru_budi, '2025-09-01', 'Hadir', 'Tepat waktu' FROM siswa WHERE nis = 'S001';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_web, @guru_budi, '2025-09-01', 'Hadir', 'Aktif di kelas' FROM siswa WHERE nis = 'S002';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_web, @guru_budi, '2025-09-01', 'Sakit', 'Surat dokter menyusul' FROM siswa WHERE nis = 'S003';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_php, @guru_budi, '2025-09-01', 'Hadir', '' FROM siswa WHERE nis = 'S004';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_php, @guru_budi, '2025-09-01', 'Hadir', '' FROM siswa WHERE nis = 'S005';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_react, @guru_citra, '2025-09-01', 'Izin', 'Acara keluarga' FROM siswa WHERE nis = 'S007';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_react, @guru_citra, '2025-09-01', 'Hadir', '' FROM siswa WHERE nis = 'S008';

-- Day 2
INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_web, @guru_budi, '2025-09-02', 'Hadir', '' FROM siswa WHERE nis = 'S001';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_web, @guru_budi, '2025-09-02', 'Alpa', 'Tanpa keterangan' FROM siswa WHERE nis = 'S002';

INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_web, @guru_budi, '2025-09-02', 'Sakit', 'Masih dalam pemulihan' FROM siswa WHERE nis = 'S003';

-- Day 3
INSERT INTO `absensi` (`siswa_id`, `kelas_id`, `guru_id`, `tanggal_absensi`, `status`, `catatan`)
SELECT id, @kelas_php, @guru_budi, '2025-09-03', 'Izin', 'Mengurus dokumen' FROM siswa WHERE nis = 'S004';
