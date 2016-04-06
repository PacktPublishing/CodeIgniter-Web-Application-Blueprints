
CREATE TABLE `signups` (
  `signup_id` int(11) NOT NULL AUTO_INCREMENT,
  `signup_email` varchar(255) NOT NULL,
  `signup_opt1` int(1) NOT NULL,
  `signup_opt2` int(1) NOT NULL,
  `signup_active` int(1) NOT NULL,
  `signup_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`signup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
