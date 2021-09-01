CREATE DATABASE `invoice` /*!40100 DEFAULT CHARACTER SET latin1 */;<br>
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `discount_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
