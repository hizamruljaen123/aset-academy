SET FOREIGN_KEY_CHECKS=0;

-- Script SQL untuk menambahkan status 'Coming Soon' ke semua jenis kelas
-- Status ini untuk kelas yang sudah dibuat dan muncul di web namun masih menunggu persiapan

-- =====================================================
-- Update tabel free_classes
-- =====================================================
ALTER TABLE `free_classes`
MODIFY COLUMN `status` ENUM('Draft','Coming Soon','Published','Archived') NOT NULL DEFAULT 'Draft' COMMENT 'Status kelas: Draft (belum siap), Coming Soon (sudah dibuat tapi menunggu persiapan), Published (sudah siap), Archived (diarsipkan)';

-- =====================================================
-- Update tabel kelas_programming
-- =====================================================
ALTER TABLE `kelas_programming`
MODIFY COLUMN `status` ENUM('Tidak Aktif','Coming Soon','Aktif') NOT NULL DEFAULT 'Tidak Aktif' COMMENT 'Status kelas: Tidak Aktif (belum siap), Coming Soon (sudah dibuat tapi menunggu persiapan), Aktif (sudah siap)';

-- =====================================================
-- Update tabel workshops
ALTER TABLE `workshops`
MODIFY COLUMN `status` ENUM('draft','coming_soon','published','completed') NOT NULL DEFAULT 'draft' COMMENT 'Status workshop: draft (belum siap), coming_soon (sudah dibuat tapi menunggu persiapan), published (sudah siap), completed (selesai)';

-- =====================================================
-- Update view jadwal_kelas_view untuk handle status baru
-- Update view jadwal_kelas_view untuk handle status baru
DROP VIEW IF EXISTS `jadwal_kelas_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `jadwal_kelas_view` AS
SELECT
    -- Data jadwal asli
    jk.id,
    jk.kelas_id,
    jk.class_type,
    jk.guru_id,
    jk.pertemuan_ke,
    jk.judul_pertemuan,
    jk.tanggal_pertemuan,
    jk.waktu_mulai,
    jk.waktu_selesai,
    jk.created_at,
    jk.updated_at,

    -- Informasi kelas (unified dari kedua tabel)
    CASE
        WHEN jk.class_type = 'premium' THEN kp.nama_kelas
        WHEN jk.class_type = 'gratis' THEN fc.title
        ELSE 'Unknown Class'
    END as nama_kelas,

    CASE
        WHEN jk.class_type = 'premium' THEN kp.deskripsi
        WHEN jk.class_type = 'gratis' THEN fc.description
        ELSE NULL
    END as deskripsi_kelas,

    CASE
        WHEN jk.class_type = 'premium' THEN kp.level
        WHEN jk.class_type = 'gratis' THEN fc.level
        ELSE NULL
    END as level_kelas,

    CASE
        WHEN jk.class_type = 'premium' THEN kp.bahasa_program
        WHEN jk.class_type = 'gratis' THEN fc.category
        ELSE NULL
    END as kategori_kelas,

    -- Status kelas
    CASE
        WHEN jk.class_type = 'premium' THEN kp.status
        WHEN jk.class_type = 'gratis' THEN fc.status
        ELSE 'Unknown'
    END as status_kelas,

    -- Informasi guru
    u.nama_lengkap as nama_guru,
    u.username as username_guru,
    u.role as role_guru,

    -- Durasi kelas (khusus premium)
    CASE
        WHEN jk.class_type = 'premium' THEN kp.durasi
        ELSE NULL
    END as durasi_kelas,

    -- Harga kelas (khusus premium)
    CASE
        WHEN jk.class_type = 'premium' THEN kp.harga
        ELSE 0
    END as harga_kelas

FROM jadwal_kelas jk
LEFT JOIN kelas_programming kp ON jk.kelas_id = kp.id AND jk.class_type = 'premium'
LEFT JOIN free_classes fc ON jk.kelas_id = fc.id AND jk.class_type = 'gratis'
LEFT JOIN users u ON jk.guru_id = u.id

WHERE jk.class_type IS NOT NULL
  AND jk.guru_id IS NOT NULL
  AND (
      (jk.class_type = 'premium' AND kp.status IN ('Aktif', 'Coming Soon'))
      OR
      (jk.class_type = 'gratis' AND fc.status IN ('Published', 'Coming Soon'))
  );

-- =====================================================
-- VERIFICATION QUERIES
-- =====================================================
-- Check free_classes status options
-- SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
-- WHERE TABLE_NAME = 'free_classes' AND COLUMN_NAME = 'status';

-- Check kelas_programming status options
-- SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
-- WHERE TABLE_NAME = 'kelas_programming' AND COLUMN_NAME = 'status';

-- Check workshops status options
-- SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
-- WHERE TABLE_NAME = 'workshops' AND COLUMN_NAME = 'status';

SET FOREIGN_KEY_CHECKS=1;
