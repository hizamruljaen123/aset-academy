-- Database: academy_lite
CREATE DATABASE IF NOT EXISTS academy_lite;
USE academy_lite;

-- Tabel untuk menyimpan data siswa
CREATE TABLE IF NOT EXISTS siswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL UNIQUE,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_telepon VARCHAR(15) NOT NULL,
    kelas VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    alamat TEXT,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    status ENUM('Aktif', 'Tidak Aktif', 'Lulus') NOT NULL DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk menyimpan daftar kelas programming
CREATE TABLE IF NOT EXISTS kelas_programming (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(100) NOT NULL UNIQUE,
    deskripsi TEXT,
    level ENUM('Dasar', 'Menengah', 'Lanjutan') NOT NULL,
    bahasa_program VARCHAR(50) NOT NULL,
    durasi INT(11) NOT NULL COMMENT 'Durasi dalam jam',
    harga DECIMAL(10,2) NOT NULL,
    status ENUM('Aktif', 'Tidak Aktif') NOT NULL DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk menyimpan data users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    status ENUM('Aktif', 'Tidak Aktif') NOT NULL DEFAULT 'Aktif',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data default admin
INSERT INTO users (username, password, nama_lengkap, email, role, status) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@academylite.com', 'admin', 'Aktif');

-- Insert data dummy kelas programming
INSERT INTO kelas_programming (nama_kelas, deskripsi, level, bahasa_program, durasi, harga, status) VALUES
('Web Programming Dasar', 'Belajar dasar-dasar pembuatan website HTML, CSS, dan JavaScript', 'Dasar', 'HTML/CSS/JS', 40, 500000.00, 'Aktif'),
('JavaScript & PHP Dasar', 'Belajar JavaScript dan PHP untuk pemula', 'Dasar', 'JavaScript/PHP', 60, 750000.00, 'Aktif'),
('React.js Dasar', 'Belajar framework React.js untuk pembuatan aplikasi web modern', 'Menengah', 'JavaScript/React', 80, 1000000.00, 'Aktif'),
('Laravel Framework', 'Belajar framework Laravel untuk pengembangan web dengan PHP', 'Menengah', 'PHP/Laravel', 100, 1200000.00, 'Aktif'),
('Node.js & Express', 'Belajar backend dengan Node.js dan Express framework', 'Menengah', 'JavaScript/Node.js', 90, 1100000.00, 'Aktif'),
('Python Django', 'Belajar framework Django untuk pengembangan web dengan Python', 'Menengah', 'Python/Django', 100, 1150000.00, 'Aktif'),
('Vue.js Advanced', 'Belajar framework Vue.js untuk aplikasi web yang interaktif', 'Lanjutan', 'JavaScript/Vue.js', 120, 1500000.00, 'Aktif'),
('API Development', 'Belajar pembuatan RESTful API dengan berbagai teknologi', 'Lanjutan', 'PHP/Node.js', 80, 1300000.00, 'Aktif'),
('Mobile App Development', 'Belajar pembuatan aplikasi mobile dengan React Native', 'Lanjutan', 'JavaScript/React Native', 100, 1400000.00, 'Aktif'),
('DevOps & Deployment', 'Belajar deployment dan DevOps untuk aplikasi web', 'Lanjutan', 'DevOps', 60, 900000.00, 'Aktif');

-- Insert data dummy kelas programming
INSERT INTO kelas_programming (nama_kelas, deskripsi, level, bahasa_program, durasi, harga, status) VALUES
('Web Programming Dasar', 'Belajar dasar-dasar pembuatan website HTML, CSS, dan JavaScript', 'Dasar', 'HTML/CSS/JS', 40, 500000.00, 'Aktif'),
('JavaScript & PHP Dasar', 'Belajar JavaScript dan PHP untuk pemula', 'Dasar', 'JavaScript/PHP', 60, 750000.00, 'Aktif'),
('React.js Dasar', 'Belajar framework React.js untuk pembuatan aplikasi web modern', 'Menengah', 'JavaScript/React', 80, 1000000.00, 'Aktif'),
('Laravel Framework', 'Belajar framework Laravel untuk pengembangan web dengan PHP', 'Menengah', 'PHP/Laravel', 100, 1200000.00, 'Aktif'),
('Node.js & Express', 'Belajar backend dengan Node.js dan Express framework', 'Menengah', 'JavaScript/Node.js', 90, 1100000.00, 'Aktif'),
('Python Django', 'Belajar framework Django untuk pengembangan web dengan Python', 'Menengah', 'Python/Django', 100, 1150000.00, 'Aktif'),
('Vue.js Advanced', 'Belajar framework Vue.js untuk aplikasi web yang interaktif', 'Lanjutan', 'JavaScript/Vue.js', 120, 1500000.00, 'Aktif'),
('API Development', 'Belajar pembuatan RESTful API dengan berbagai teknologi', 'Lanjutan', 'PHP/Node.js', 80, 1300000.00, 'Aktif'),
('Mobile App Development', 'Belajar pembuatan aplikasi mobile dengan React Native', 'Lanjutan', 'JavaScript/React Native', 100, 1400000.00, 'Aktif'),
('DevOps & Deployment', 'Belajar deployment dan DevOps untuk aplikasi web', 'Lanjutan', 'DevOps', 60, 900000.00, 'Aktif');

-- Index untuk pencarian yang lebih cepat
CREATE INDEX idx_nis ON siswa(nis);
CREATE INDEX idx_nama ON siswa(nama_lengkap);
CREATE INDEX idx_kelas ON siswa(kelas);

-- Tabel untuk menyimpan materi pembelajaran
CREATE TABLE IF NOT EXISTS `materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk menyimpan bagian-bagian dari materi (konten)
CREATE TABLE IF NOT EXISTS `materi_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `part_order` int(11) NOT NULL,
  `part_type` enum('image','video','pdf','link') NOT NULL,
  `part_title` varchar(255) NOT NULL,
  `part_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `materi_id` (`materi_id`),
  CONSTRAINT `materi_parts_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;