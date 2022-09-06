CREATE TABLE `notes`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `text` TEXT NULL,
    `category` INT NOT NULL,
    `source` VARCHAR(255) NULL,
    `tags` VARCHAR(255) NULL,
    `timestamp` TIMESTAMP NOT NULL
);
ALTER TABLE
    `notes` ADD PRIMARY KEY `notes_id_primary`(`id`);
CREATE TABLE `categories`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `categories` ADD PRIMARY KEY `categories_id_primary`(`id`);
CREATE TABLE `tags`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `tags` ADD PRIMARY KEY `tags_id_primary`(`id`);
ALTER TABLE
    `notes` ADD CONSTRAINT `notes_category_foreign` FOREIGN KEY(`category`) REFERENCES `categories`(`id`);