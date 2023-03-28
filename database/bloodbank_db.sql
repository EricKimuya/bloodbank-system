DROP DATABASE IF EXISTS bloodbank_db;
CREATE DATABASE bloodbank_db;
use bloodbank_db;

CREATE TABLE `blood_inventory` (
 `id` int(30) NOT NULL AUTO_INCREMENT,
 `blood_group` varchar(10) NOT NULL,
 `volume` float NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = in -stock,2=out',
 `donor_id` int(30) NOT NULL,
 `request_id` int(30) NOT NULL,
 `date_created` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `donors` (
 `id` int(30) NOT NULL AUTO_INCREMENT,
 `blood_group` varchar(10) NOT NULL,
 `name` text NOT NULL,
 `address` text NOT NULL,
 `contact` varchar(20) NOT NULL,
 `email` varchar(50) NOT NULL,
 `user_id` int(11) DEFAULT 0,
 `date_created` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
	
CREATE TABLE `handedover_request` (
 `id` int(30) NOT NULL AUTO_INCREMENT,
 `request_id` int(30) NOT NULL,
 `picked_up_by` text NOT NULL,
 `date_created` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `manager` (
 `id` int(200) NOT NULL AUTO_INCREMENT,
 `username` varchar(200) NOT NULL,
 `password` varchar(200) NOT NULL,
 `created_at` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `messages` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `subject` varchar(200) NOT NULL,
 `contact` varchar(50) NOT NULL,
 `message` text NOT NULL,
 `response` varchar(500) DEFAULT NULL,
 `user_id` int(11) NOT NULL,
 `created_at` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `requests` (
 `id` int(30) NOT NULL AUTO_INCREMENT,
 `ref_code` varchar(20) NOT NULL,
 `patient` text NOT NULL,
 `blood_group` varchar(10) NOT NULL,
 `volume` float NOT NULL,
 `physician_name` text NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= pending,1= approved',
 `date_created` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `system_settings` (
 `id` int(30) NOT NULL AUTO_INCREMENT,
 `name` text NOT NULL,
 `email` varchar(200) NOT NULL,
 `contact` varchar(20) NOT NULL,
 `cover_img` text NOT NULL,
 `about_content` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
 `id` int(30) NOT NULL AUTO_INCREMENT,
 `name` text NOT NULL,
 `username` varchar(200) NOT NULL,
 `password` text NOT NULL,
 `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff, 3= subscriber',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4