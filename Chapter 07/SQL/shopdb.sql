CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_url_name` varchar(15) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `categories` VALUES (1,'Shirts','shirts'),(2,'Footware','footware'),(3,'Books','books'),(4,'Beauty','beauty'),(5,'Software','software'),(6,'Computers','computers'),(7,'Kitchen Ware','kitchenware'),(8,'Luggage','luggage'),(9,'Camping','camping'),(10,'Sports','sports');

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_bin DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_first_name` varchar(125) NOT NULL,
  `cust_last_name` varchar(125) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `cust_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cust_address` text NOT NULL COMMENT 'card holder address',
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `order_details` text NOT NULL,
  `order_subtotal` int(11) NOT NULL,
  `order_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_closed` int(1) NOT NULL COMMENT '0 = open, 1 = closed',
  `order_fulfilment_code` varchar(255) NOT NULL COMMENT 'the unique code sent to a payment provider',
  `order_delivery_address` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `products` VALUES (1,'Running Shoes',423423,'These are some shoes',2,50),(2,'Hawaiian Shirt',34234,'This is a shirt',1,25),(3,'Slippers',23134,'Nice comfortable  slippers',2,4),(4,'Shirt',2553245,'White Office Shirt',1,25),(5,'CodeIgniter Blueprints',5442342,'Some excellent projects to make and do (in CodeIgniter) - it\'s good value too!',3,25),(6,'Office Suite',34234123,'Writer, Calc, Presentation software',5,299),(7,'Anti-Virus',324142,'Get rid of those pesky viruses from your computer',5,29),(8,'Operating System',12341,'This can run your computer',5,30),(9,'Web Browser',42412,'Browse the web with a web browser (that\'s what they\'re for)',5,5),(10,'Dinner set',3241235,'6 dinner plates, 6 side plates, 6 cups',7,45),(11,'Champagne Glasses',1454352,'Crystal glasses to drink fizzy French plonk from ',7,45),(12,'Toaster',523234,'Capable of toasting 4 slices at once!',7,35),(13,'Kettle',62546245,'Heat water with this amazing kettle',7,25);
