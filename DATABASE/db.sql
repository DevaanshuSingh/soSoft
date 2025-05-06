-- Active: 1742668335270@@127.0.0.1@3306
CREATE DATABASE `social_software`;

USE `social_software`;

CREATE TABLE `users` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `userRegSeriolNo` BIGINT(20) NOT NULL,
    `userName` varchar(255) NOT NULL,
    `fullName` varchar(255) DEFAULT NULL,
    `userPassword` varchar(255) DEFAULT NULL,
    `bio` text DEFAULT NULL,
    `location` varchar(255) DEFAULT NULL,
    `dob` date DEFAULT NULL,
    `interests` text DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `profile_picture` blob DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) NOT NULL, -- Datatype ko VARCHAR(50) banaya gaya
    `content` text NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `myFeatures` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `featureName` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO
    myFeatures (featureName)
VALUES ('Friends'),
    ('Posts'),
    ('About'),
    ('Be Friends');


CREATE TABLE friend_requests (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    requested_from_id BIGINT(20) UNSIGNED DEFAULT NULL,
    requested_to_id BIGINT(20) UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);


CREATE TABLE `myFriends` (
    `id` BIGINT(11) NOT NULL AUTO_INCREMENT,
    `myId` BIGINT NOT NULL,
    `friendId` BIGINT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);