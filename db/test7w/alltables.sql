CREATE TABLE `tags_and_array` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key_` varchar(200) NOT NULL,
  `array1` varchar(1000) DEFAULT NULL,
  `array2` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `raz_dva_tri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_` varchar(20) NOT NULL,
  `value_` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `random_sql` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `array2d` (
  `c00` varchar(20) DEFAULT NULL,
  `c01` varchar(20) DEFAULT NULL,
  `c02` varchar(20) DEFAULT NULL,
  `c03` varchar(20) DEFAULT NULL,
  `c04` varchar(20) DEFAULT NULL,
  `c05` varchar(20) DEFAULT NULL,
  `c06` varchar(20) DEFAULT NULL,
  `c07` varchar(20) DEFAULT NULL,
  `c08` varchar(20) DEFAULT NULL,
  `c09` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
