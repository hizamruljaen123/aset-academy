-- Update users table to support multi-level roles
ALTER TABLE `users` MODIFY COLUMN `role` enum('super_admin','admin','guru','siswa','user') NOT NULL DEFAULT 'user';

-- Add level field for more granular access control
ALTER TABLE `users` ADD COLUMN `level` enum('1','2','3','4','5') NOT NULL DEFAULT '5' COMMENT '1=Super Admin, 2=Admin, 3=Guru, 4=Siswa, 5=User' AFTER `role`;

-- Add department/division field for organizational structure
ALTER TABLE `users` ADD COLUMN `department` varchar(50) DEFAULT NULL COMMENT 'Department or division' AFTER `level`;

-- Update existing users to have proper levels
UPDATE `users` SET `level` = '1' WHERE `role` = 'admin';
UPDATE `users` SET `level` = '3' WHERE `role` = 'guru';
UPDATE `users` SET `level` = '5' WHERE `role` = 'user';

-- Create table for user permissions
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert default permissions
-- Super Admin (Level 1) - Full access
INSERT INTO `user_permissions` (`role`, `level`, `module`, `action`, `allowed`) VALUES
('super_admin', '1', 'dashboard', 'view', 1),
('super_admin', '1', 'siswa', 'create', 1),
('super_admin', '1', 'siswa', 'read', 1),
('super_admin', '1', 'siswa', 'update', 1),
('super_admin', '1', 'siswa', 'delete', 1),
('super_admin', '1', 'kelas', 'create', 1),
('super_admin', '1', 'kelas', 'read', 1),
('super_admin', '1', 'kelas', 'update', 1),
('super_admin', '1', 'kelas', 'delete', 1),
('super_admin', '1', 'materi', 'create', 1),
('super_admin', '1', 'materi', 'read', 1),
('super_admin', '1', 'materi', 'update', 1),
('super_admin', '1', 'materi', 'delete', 1),
('super_admin', '1', 'guru', 'create', 1),
('super_admin', '1', 'guru', 'read', 1),
('super_admin', '1', 'guru', 'update', 1),
('super_admin', '1', 'guru', 'delete', 1);

-- Admin (Level 2) - Limited admin access
INSERT INTO `user_permissions` (`role`, `level`, `module`, `action`, `allowed`) VALUES
('admin', '2', 'dashboard', 'view', 1),
('admin', '2', 'siswa', 'create', 1),
('admin', '2', 'siswa', 'read', 1),
('admin', '2', 'siswa', 'update', 1),
('admin', '2', 'siswa', 'delete', 0),
('admin', '2', 'kelas', 'create', 1),
('admin', '2', 'kelas', 'read', 1),
('admin', '2', 'kelas', 'update', 1),
('admin', '2', 'kelas', 'delete', 0),
('admin', '2', 'materi', 'create', 1),
('admin', '2', 'materi', 'read', 1),
('admin', '2', 'materi', 'update', 1),
('admin', '2', 'materi', 'delete', 0);

-- Guru (Level 3) - Teacher access
INSERT INTO `user_permissions` (`role`, `level`, `module`, `action`, `allowed`) VALUES
('guru', '3', 'teacher', 'view', 1),
('guru', '3', 'siswa', 'read', 1),
('guru', '3', 'kelas', 'read', 1),
('guru', '3', 'materi', 'read', 1),
('guru', '3', 'materi', 'update', 1);

-- Siswa (Level 4) - Student access
INSERT INTO `user_permissions` (`role`, `level`, `module`, `action`, `allowed`) VALUES
('siswa', '4', 'student', 'view', 1),
('siswa', '4', 'materi', 'read', 1),
('siswa', '4', 'kelas', 'read', 1);

-- Create sample users with different levels
INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `role`, `level`, `department`, `status`) VALUES
('superadmin', MD5('superadmin123'), 'Super Administrator', 'superadmin@academy.com', 'super_admin', '1', 'IT', 'Aktif'),
('admin1', MD5('admin123'), 'Admin Akademik', 'admin@academy.com', 'admin', '2', 'Akademik', 'Aktif'),
('guru2', MD5('guru123'), 'Siti Nurhaliza', 'siti.guru@academy.com', 'guru', '3', 'Programming', 'Aktif'),
('siswa1', MD5('siswa123'), 'Ahmad Rizki', 'ahmad.siswa@academy.com', 'siswa', '4', NULL, 'Aktif');
