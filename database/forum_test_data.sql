-- Insert test data for forum
INSERT INTO `forum_categories` (`id`, `name`, `description`, `slug`, `created_at`) VALUES
(1, 'Pembahasan Umum', 'Diskusi umum tentang pembelajaran', 'pembahasan-umum', NOW()),
(2, 'Bantuan Teknis', 'Pertanyaan teknis dan bantuan', 'bantuan-teknis', NOW());

-- Insert test thread
INSERT INTO `forum_threads` (`id`, `user_id`, `category_id`, `title`, `content`, `views`, `is_pinned`, `created_at`, `updated_at`, `slug`) VALUES
(2, 1, 1, 'Pengenalan Dasar Pemrograman', 'Halo semuanya, saya ingin memulai belajar pemrograman. Apa yang harus saya pelajari terlebih dahulu?', 0, 0, NOW(), NOW(), 'pengenalan-dasar-pemrograman');

-- Insert test posts/replies
INSERT INTO `forum_posts` (`id`, `thread_id`, `user_id`, `parent_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, 'Selamat datang di forum diskusi! Untuk memulai belajar pemrograman, saya sarankan untuk memilih bahasa pemrograman yang sesuai dengan minat Anda. Beberapa pilihan populer adalah Python, JavaScript, atau Java.', NOW(), NOW()),
(2, 2, 2, NULL, 'Saya setuju! Python adalah pilihan yang bagus untuk pemula karena sintaksnya yang mudah dipahami.', NOW(), NOW()),
(3, 2, 3, 1, 'Terima kasih atas sarannya! Apakah ada rekomendasi sumber belajar yang baik untuk pemula?', NOW(), NOW()),
(4, 2, 4, 2, 'Saya merekomendasikan platform online seperti Codecademy atau freeCodeCamp untuk memulai.', NOW(), NOW()),
(5, 2, 5, 3, 'Selain itu, jangan lupa untuk banyak berlatih dengan membuat proyek kecil-kecil.', NOW(), NOW()),
(6, 2, 6, 1, 'Benar! Praktik adalah kunci utama dalam belajar pemrograman.', NOW(), NOW()),
(7, 2, 7, 4, 'Ada juga banyak tutorial di YouTube yang bisa diikuti.', NOW(), NOW()),
(8, 2, 8, 5, 'Saya juga menyarankan untuk bergabung dengan komunitas pemrograman online.', NOW(), NOW()),
(9, 2, 9, 6, 'Jangan takut membuat kesalahan, karena kesalahan adalah bagian dari proses belajar.', NOW(), NOW()),
(10, 2, 10, 7, 'GitHub juga sangat berguna untuk menyimpan dan berbagi kode Anda.', NOW(), NOW()),
(11, 2, 11, 8, 'Saya pikir yang terpenting adalah konsisten dalam belajar setiap hari.', NOW(), NOW()),
(12, 2, 12, 9, 'Ya, konsistensi adalah kunci kesuksesan dalam belajar apapun.', NOW(), NOW()),
(13, 2, 13, 10, 'Selain itu, jangan lupa untuk membaca dokumentasi resmi dari bahasa pemrograman yang dipilih.', NOW(), NOW()),
(14, 2, 14, 11, 'Saya juga menyarankan untuk mencoba berbagai jenis proyek untuk mengasah skill.', NOW(), NOW()),
(15, 2, 15, 12, 'Terima kasih banyak atas semua saran yang diberikan!', NOW(), NOW());

-- Insert test likes
INSERT INTO `forum_likes` (`id`, `user_id`, `thread_id`, `post_id`, `created_at`) VALUES
(1, 2, 2, 1, NOW()),
(2, 3, 2, 1, NOW()),
(3, 4, 2, 2, NOW()),
(4, 5, 2, 3, NOW()),
(5, 6, 2, 4, NOW()),
(6, 7, 2, 5, NOW()),
(7, 8, 2, 6, NOW()),
(8, 9, 2, 7, NOW()),
(9, 10, 2, 8, NOW()),
(10, 11, 2, 9, NOW()),
(11, 12, 2, 10, NOW()),
(12, 13, 2, 11, NOW()),
(13, 14, 2, 12, NOW()),
(14, 15, 2, 13, NOW()),
(15, 1, 2, 14, NOW()),
(16, 2, 2, 15, NOW());

-- Insert test thread views
INSERT INTO `forum_thread_views` (`id`, `thread_id`, `user_id`, `viewed_at`) VALUES
(1, 2, 1, NOW()),
(2, 2, 2, NOW()),
(3, 2, 3, NOW()),
(4, 2, 4, NOW()),
(5, 2, 5, NOW());