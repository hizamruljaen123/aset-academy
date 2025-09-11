-- Workshop Management System Tables
-- File: workshop_tables.sql

-- Workshops table
CREATE TABLE `workshops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `description` text NOT NULL,
  `type` enum('workshop','seminar') NOT NULL DEFAULT 'workshop',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_participants` int(11) NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','completed') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Workshop materials table
CREATE TABLE `workshop_materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  CONSTRAINT `workshop_materials_ibfk_1` FOREIGN KEY (`workshop_id`) 
    REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Workshop participants table
CREATE TABLE `workshop_participants` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `external_name` varchar(255) DEFAULT NULL,
  `external_email` varchar(255) DEFAULT NULL,
  `role` enum('student','teacher','external') NOT NULL DEFAULT 'external',
  `status` enum('registered','attended','cancelled') NOT NULL DEFAULT 'registered',
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `workshop_id` (`workshop_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `workshop_participants_ibfk_1` FOREIGN KEY (`workshop_id`) 
    REFERENCES `workshops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `workshop_participants_ibfk_2` FOREIGN KEY (`user_id`) 
    REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
