CREATE TABLE `notes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `text` TEXT NOT NULL,
    `category_id` INT,
    `source` VARCHAR(1023),
    `timestamp` timestamp NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `categories` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
);

CREATE TABLE `tags` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
);

CREATE TABLE `tag_junction` (
    `note_id` INT NOT NULL,
    `tag_id` INT NOT NULL,
    PRIMARY KEY (`note_id`, `tag_id`)
);