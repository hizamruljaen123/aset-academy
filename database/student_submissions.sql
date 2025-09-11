-- Struktur tabel student_submissions
-- File: database/student_submissions.sql

CREATE TABLE IF NOT EXISTS `student_submissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assignment_id` int NOT NULL,
  `student_id` int NOT NULL,
  `content` text,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(500) DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` decimal(5,2) DEFAULT NULL,
  `feedback` text,
  `graded_at` timestamp NULL DEFAULT NULL,
  `graded_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_submission` (`assignment_id`,`student_id`),
  KEY `fk_submissions_assignment` (`assignment_id`),
  KEY `fk_submissions_student` (`student_id`),
  KEY `fk_submissions_grader` (`graded_by`),
  CONSTRAINT `fk_submissions_assignment` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_submissions_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_submissions_grader` FOREIGN KEY (`graded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Sample data
INSERT INTO `student_submissions` (`assignment_id`, `student_id`, `content`, `file_name`, `file_path`, `submitted_at`, `grade`, `feedback`, `graded_at`, `graded_by`) VALUES
(1, 3, 'Jawaban untuk tugas pertama', 'tugas1.pdf', 'tugas1_20250911_101530.pdf', NOW(), NULL, NULL, NULL, NULL),
(2, 4, 'Tugas kedua sudah selesai', 'tugas2.docx', 'tugas2_20250911_143020.docx', NOW(), NULL, NULL, NULL, NULL);
