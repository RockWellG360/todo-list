CREATE DATABASE
IF NOT EXISTS `todo_db`;

CREATE TABLE
IF NOT EXISTS `todo_db`.`todos` (
	`id` INT AUTO_INCREMENT,
	`title` VARCHAR (255) NOT NULL,
	`description` VARCHAR (255) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE = INNODB;