-- Forum Tables for Aset Academy

-- Main categories for the forum
CREATE TABLE `forum_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(255) NULL,
  `slug` VARCHAR(120) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Forum threads or topics
CREATE TABLE `forum_threads` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL, -- Will store Quill's HTML output
  `views` INT DEFAULT 0,
  `is_pinned` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `forum_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Posts or replies within a thread
CREATE TABLE `forum_posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `thread_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `parent_id` INT NULL, -- For nested replies, references id of this table
  `content` TEXT NOT NULL, -- Will store Quill's HTML output
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`thread_id`) REFERENCES `forum_threads`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`parent_id`) REFERENCES `forum_posts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Likes for threads and posts
CREATE TABLE `forum_likes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `thread_id` INT NULL,
  `post_id` INT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_like` (`user_id`, `thread_id`, `post_id`), -- A user can only like a specific item once
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`thread_id`) REFERENCES `forum_threads`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`post_id`) REFERENCES `forum_posts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping structure for table academy_lite.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `class_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Transfer','Cash','Other') NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL COMMENT 'Path to proof image',
  `status` enum('Pending','Verified','Rejected') NOT NULL DEFAULT 'Pending',
  `verified_by` int DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `class_id` (`class_id`),
  KEY `verified_by` (`verified_by`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `kelas_programming` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert some initial categories
INSERT INTO `forum_categories` (`name`, `description`, `slug`) VALUES
('Diskusi Umum', 'Topik umum yang tidak masuk ke kategori lain.', 'diskusi-umum'),
('Pemrograman Web', 'Diskusi seputar HTML, CSS, JavaScript, PHP, dll.', 'pemrograman-web'),
('UI/UX Design', 'Semua tentang desain antarmuka dan pengalaman pengguna.', 'ui-ux-design'),
('Tools & Produktivitas', 'Tips dan trik seputar tools developer dan produktivitas.', 'tools-produktivitas');
