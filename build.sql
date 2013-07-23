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
        `period` INT NOT NULL,
        `alert_threshold_maximum` INT NOT NULL,
        `alert_threshold_minimum` INT NOT NULL,
        `decimal_format` BIT(1) NOT NULL,
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
)

