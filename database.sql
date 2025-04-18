CREATE TABLE IF NOT EXISTS `programs` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `students` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `student_number` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `program_id` smallint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_number` (`student_number`),
  KEY `fk_student_program_id` (`program_id`),
  CONSTRAINT `fk_student_program_id` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB;
