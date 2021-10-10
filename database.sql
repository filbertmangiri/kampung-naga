CREATE DATABASE IF NOT EXISTS `kampung_naga`;

USE `kampung_naga`;

CREATE TABLE IF NOT EXISTS `accounts` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`email` VARCHAR(255),
	`username` VARCHAR(128),
	`password` VARCHAR(255),
	`first_name` VARCHAR(128),
	`last_name` VARCHAR(128),
	`birth_date` DATE,
	`gender` BIT DEFAULT 0,
	`profile_picture` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`last_login_at` DATETIME,
	`is_admin` BIT DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE (`email`),
	UNIQUE (`username`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `articles` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`title` VARCHAR(128),
	`author_id` INTEGER UNSIGNED,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`author_id`) REFERENCES `accounts`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `articles_likes` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`account_id` INTEGER UNSIGNED,
	`article_id` INTEGER UNSIGNED,
	`body` LONGTEXT,
	PRIMARY KEY (`id`),
	CONSTRAINT `pk_article_like` UNIQUE (`account_id`, `article_id`),
	FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `articles_comments` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`account_id` INTEGER UNSIGNED,
	`article_id` INTEGER UNSIGNED,
	`comment` MEDIUMTEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	CONSTRAINT `pk_article_comment` UNIQUE (`account_id`, `article_id`),
	FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `comments_likes` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`account_id` INTEGER UNSIGNED,
	`comment_id` INTEGER UNSIGNED,
	PRIMARY KEY (`id`),
	CONSTRAINT `pk_comment_like` UNIQUE (`account_id`, `comment_id`),
	FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`comment_id`) REFERENCES `articles_comments`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `admin_log` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`datetime` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`admin_id` INTEGER UNSIGNED,
	`admin_name` VARCHAR(255),
	`action` VARCHAR(255),
	PRIMARY KEY (`id`),
	FOREIGN KEY (`admin_id`) REFERENCES `accounts`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;