CREATE DATABASE IF NOT EXISTS sqli;
USE sqli;

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `tid` int(10) NOT NULL,
  `description` varchar(25) NOT NULL,
  `amount` int(10) NOT NULL,
  `balance` int(15) NOT NULL
);

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Debin', 'Gao', 'debin', 'password'),
(2, 'Watson', 'Shane', 'watson', 'hello'),
(3, 'Steve', 'Rogers', 'chris', 'pizza@123'),
(4, 'Aron', 'Stone', 'aron', 'stonebank'),
(5, 'John', 'Wick', 'john', 'cardinal88');

INSERT INTO `transaction` (`id`, `date`, `tid`, `description`, `amount`, `balance`) VALUES
(2, '2020-01-31', 12387, 'tele bill', 250, 15000),
(2, '2020-02-23', 13678, 'hotel pay', 5000, 10000),
(2, '2020-02-27', 14578, 'Incoming Credit', 7500, 17500),
(2, '2020-03-17', 14590, 'travel', 800, 16700),
(2, '2020-04-24', 14670, 'tele bill', 250, 16450),
(2, '2020-05-28', 15890, 'fees - overdraft', 450, 16000),
(3, '2020-01-31', 12387, 'tele bill', 250, 15000),
(3, '2020-02-23', 13678, 'hotel pay', 5000, 10000),
(3, '2020-02-27', 14578, 'Incoming Credit', 7500, 17500),
(3, '2020-03-17', 14590, 'travel', 800, 16700),
(3, '2020-04-24', 14670, 'tele bill', 250, 16450),
(4, '2020-05-28', 15890, 'fees - overdraft', 450, 16000),
(4, '2020-01-31', 12387, 'tele bill', 250, 15000),
(4, '2020-02-23', 13678, 'hotel pay', 5000, 10000),
(4, '2020-02-27', 14578, 'Incoming Credit', 7500, 17500),
(4, '2020-03-17', 14590, 'travel', 800, 16700),
(4, '2020-04-24', 14670, 'tele bill', 250, 16450),
(4, '2020-05-28', 15890, 'fees - overdraft', 450, 16000),
(5, '2020-01-31', 12387, 'tele bill', 250, 15000),
(5, '2020-02-23', 13678, 'hotel pay', 5000, 10000),
(5, '2020-02-27', 14578, 'Incoming Credit', 7500, 17500),
(5, '2020-03-17', 14590, 'travel', 800, 16700),
(5, '2020-04-24', 14670, 'tele bill', 250, 16450),
(5, '2020-05-28', 15890, 'fees - overdraft', 450, 16000);
