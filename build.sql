CREATE DATABASE metrics;

CREATE TABLE `metrics`.`data` (
        `value` INT NOT NULL,
        `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `metric_id` INT NOT NULL,
        INDEX(`time`),
        INDEX(`metric_id`),
        PRIMARY KEY (`time`,`metric_id`)
);

CREATE TABLE `metrics`.`meta` (
        `source_id` INT NOT NULL,
        `metric_id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL, /* metric name */
        `device` VARCHAR(255) NOT NULL, /* actual device name, not to be confused with the source_id which is just a shorthand of key+ip */
        `period` INT DEFAULT 30 NOT NULL, /* defaults to assuming data is reported every 30 seconds */
        `alert_threshold_maximum` INT NOT NULL,
        `alert_threshold_minimum` INT NOT NULL,
        `decimal_format` BIT(1) NOT NULL, /* 0 = integer, 1 = decimal @ 4 digit precision [e.g. 1.0001, 1.2391] */
	`average_summarize` BIT(1) NOT NULL, /* 0 = Metric @ :30 + Metric @ :00, 1 = (Metric @ :30 + Metric @ :00)/2 */
        PRIMARY KEY (`metric_id`)
);

CREATE DATABASE authentication;

CREATE TABLE `authentication`.`api_keys` (
        `source_id` INT NOT NULL AUTO_INCREMENT,
        `key` VARCHAR(255) NOT NULL, /* Stores a hashed key of fixed length but going to leave extra space 'just in case' */
        `ip` varbinary(16) NOT NULL, /* Keys are only valid from the target IP address */
        PRIMARY KEY(`source_id`)
);

CREATE TABLE `authentication`.`users` (
        `account_id` INT NOT NULL AUTO_INCREMENT,
        `email` VARCHAR(255) NOT NULL, /* RFC max is 255 */
        `password` VARCHAR(255) NOT NULL, /* Same as key, both the api_key and the password are the same basic idea...fixed length hashes a-hoy */
        PRIMARY KEY(`account_id`),
        INDEX(`email`)
);

/*
Generates a test user with the username = admin@localhost, password=vagrant - replace with an appropriate email/password combo for your installation. If you need to generate the hash, feel free to use:
classes/unstable/api/test.php
Just modify the $password variable and call the url to get the result. test.php is used to sort out if things are installed correctly (e.g. Calls the MySQL server, tests the password_hash function)
*/
INSERT INTO `authentication`.`users` SET `email`='admin@localhost', `password`='$2y$10$ug6YdlBgdvS2DmzIeacrVekKRNyldVn5p3TCMDX33LSQ7gH\/DR2xy';

