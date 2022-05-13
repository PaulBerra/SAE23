CREATE TABLE IF NOT EXISTS `auth`.`users` (
  id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `user` VARCHAR(50) DEFAULT NULL,
  `pass` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (id)) ENGINE=MyISAM;
INSERT INTO `auth`.`users` (`user`,`pass`) VALUES ('alice','abcd1234'),('bob','toto34!'),('admin','S3cr3tPWD');
