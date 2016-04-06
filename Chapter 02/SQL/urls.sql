CREATE DATABASE `urls`;
USE `urls`;

DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls` (
  `url_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_code` varchar(10) NOT NULL,
  `url_address` text NOT NULL,
  `url_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;