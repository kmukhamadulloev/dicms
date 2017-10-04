DROP TABLE IF EXISTS `params`;
DROP TABLE IF EXISTS `types`;
DROP TABLE IF EXISTS `posts`;

CREATE TABLE `params` (
	`id` INT AUTO_INCREMENT NOT NULL,
	`param_name` VARCHAR(255) NOT NULL,
	`param_value` VARCHAR(255) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB;

CREATE TABLE `types` (
	`id` INT AUTO_INCREMENT NOT NULL,
	`title` VARCHAR(120) NOT NULL,
	`description` VARCHAR(255),
	`logo` VARCHAR(120),
	PRIMARY KEY(`id`)
) ENGINE=InnoDB;

CREATE TABLE `posts` (
	`id` INT AUTO_INCREMENT NOT NULL,
	`post_date` TIMESTAMP NOT NULL,
	`post_status` VARCHAR(50) NOT NULL,
	`post_type` INT NOT NULL,
	`post_logo` VARCHAR(120),
	`title` VARCHAR(120) NOT NULL,
	`description` VARCHAR(255),
	`content` TEXT,
	`author` VARCHAR(80),
	`keywords` VARCHAR(255),
	PRIMARY KEY(`id`),
	FOREIGN KEY(`post_type`) REFERENCES `types`(`id`)
) ENGINE=InnoDB;