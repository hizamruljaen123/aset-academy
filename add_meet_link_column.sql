-- Add online_meet_link column to kelas_programming table
ALTER TABLE `kelas_programming`
ADD COLUMN `online_meet_link` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Link for online meeting (Zoom, Google Meet, etc.)' AFTER `gambar`;

-- Add online_meet_link column to free_classes table
ALTER TABLE `free_classes`
ADD COLUMN `online_meet_link` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Link for online meeting (Zoom, Google Meet, etc.)' AFTER `thumbnail`;
