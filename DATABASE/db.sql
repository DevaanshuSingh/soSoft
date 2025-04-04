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
) ;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `myFeatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `featureName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);
