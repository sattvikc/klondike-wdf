CREATE TABLE IF NOT EXISTS `{[dbPrefix]}users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createdOn` datetime NOT NULL,
  `lastLogedInOn` datetime NULL,
  `lastLoginIP` varchar(15) NULL,
  PRIMARY KEY (`username`)
);