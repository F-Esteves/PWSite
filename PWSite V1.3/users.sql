CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
     `email` varchar(40) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB CHARSET=utf8;