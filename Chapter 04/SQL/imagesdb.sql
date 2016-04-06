CREATE DATABASE `imagesdb`;
USE `imagesdb`;


DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url_code` varchar(10) NOT NULL,
  `img_url_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_image_name` varchar(255) NOT NULL,
  `img_dir_name` varchar(8) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;