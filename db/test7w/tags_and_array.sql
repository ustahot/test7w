USE test7w;

CREATE TABLE `tags_and_array` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key_` varchar(200) NOT NULL,
  `array1` varchar(1000) DEFAULT NULL,
  `array2` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


