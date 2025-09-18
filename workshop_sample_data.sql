-- Sample workshop data for testing
-- Insert sample workshops with status 'published'

INSERT INTO `workshops` (`id`, `title`, `slug`, `description`, `type`, `price`, `start_datetime`, `end_datetime`, `location`, `max_participants`, `thumbnail`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Workshop Laravel untuk Pemula', 'workshop-laravel-pemula', 'Pelajari dasar-dasar Laravel framework untuk membangun aplikasi web modern. Cocok untuk pemula yang ingin memulai karir sebagai web developer.', 'workshop', 150000.00, '2025-10-15 09:00:00', '2025-10-15 17:00:00', 'Gedung Aset Academy, Jakarta', 30, 'uploads/workshops/laravel-workshop.jpg', 'published', '2025-09-15 10:00:00', '2025-09-15 10:00:00'),

(2, 'Seminar AI & Machine Learning', 'seminar-ai-ml', 'Eksplorasi tren terbaru dalam Artificial Intelligence dan Machine Learning. Dapatkan insight dari para praktisi industri.', 'seminar', 50000.00, '2025-10-20 13:00:00', '2025-10-20 16:00:00', 'Auditorium Universitas Indonesia', 100, 'uploads/workshops/ai-seminar.jpg', 'published', '2025-09-16 08:00:00', '2025-09-16 08:00:00'),

(3, 'Workshop React Native Mobile Apps', 'workshop-react-native', 'Bangun aplikasi mobile cross-platform dengan React Native. Hands-on workshop dengan project nyata.', 'workshop', 250000.00, '2025-11-05 09:00:00', '2025-11-05 17:00:00', 'Aset Academy Training Center', 25, 'uploads/workshops/react-native-workshop.jpg', 'published', '2025-09-17 14:00:00', '2025-09-17 14:00:00'),

(4, 'Seminar Cyber Security Awareness', 'seminar-cyber-security', 'Pentingnya keamanan siber di era digital. Pelajari cara melindungi data dan sistem dari serangan cyber.', 'seminar', 0.00, '2025-10-25 09:00:00', '2025-10-25 12:00:00', 'Online via Zoom', 200, 'uploads/workshops/cyber-security-seminar.jpg', 'published', '2025-09-18 09:00:00', '2025-09-18 09:00:00'),

(5, 'Workshop UI/UX Design Fundamentals', 'workshop-ui-ux-design', 'Desain antarmuka yang user-friendly dan menarik. Pelajari prinsip dasar UI/UX untuk aplikasi modern.', 'workshop', 200000.00, '2025-11-12 09:00:00', '2025-11-12 16:00:00', 'Design Studio Aset Academy', 20, 'uploads/workshops/ui-ux-workshop.jpg', 'published', '2025-09-18 11:00:00', '2025-09-18 11:00:00');

-- Sample materials for workshop ID 1 (Laravel)
INSERT INTO `workshop_materials` (`workshop_id`, `title`, `file_path`, `file_type`) VALUES
(1, 'Materi Dasar Laravel', 'uploads/materials/laravel-basics.pdf', 'pdf'),
(1, 'Video Tutorial Laravel', 'uploads/materials/laravel-video.mp4', 'video'),
(1, 'Source Code Contoh', 'https://github.com/aset-academy/laravel-workshop', 'link');

-- Sample materials for workshop ID 2 (AI/ML)
INSERT INTO `workshop_materials` (`workshop_id`, `title`, `file_path`, `file_type`) VALUES
(2, 'Slide Presentasi AI', 'uploads/materials/ai-slides.pdf', 'pdf'),
(2, 'Contoh Kode Machine Learning', 'uploads/materials/ml-examples.zip', 'zip');

-- Sample materials for workshop ID 3 (React Native)
INSERT INTO `workshop_materials` (`workshop_id`, `title`, `file_path`, `file_type`) VALUES
(3, 'Setup Environment React Native', 'uploads/materials/react-native-setup.pdf', 'pdf'),
(3, 'Project Starter Template', 'uploads/materials/react-native-starter.zip', 'zip');
