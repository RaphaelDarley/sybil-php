 CREATE TABLE `notes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` TEXT NOT NULL,
  `category` INT,
  `source` VARCHAR(1023),
  `tags` VARCHAR(1023),
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id`));


 CREATE TABLE `categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));


 CREATE TABLE `tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));