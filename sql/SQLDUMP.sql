-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.34-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for users
CREATE DATABASE IF NOT EXISTS `users` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `users`;

-- Dumping structure for table users.a1
CREATE TABLE IF NOT EXISTS `a1` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.a1: ~4 rows (approximately)
/*!40000 ALTER TABLE `a1` DISABLE KEYS */;
INSERT INTO `a1` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 70),
	(1007998998, 'Stanley', 'Wright', 100),
	(100789333, 'Marley', 'Uless', 87),
	(100790777, 'Carly', 'Cakes', 67);
/*!40000 ALTER TABLE `a1` ENABLE KEYS */;

-- Dumping structure for table users.a2
CREATE TABLE IF NOT EXISTS `a2` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.a2: ~4 rows (approximately)
/*!40000 ALTER TABLE `a2` DISABLE KEYS */;
INSERT INTO `a2` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 50),
	(1007998998, 'Stanley', 'Wright', 60),
	(100789333, 'Marley', 'Uless', 83),
	(100790777, 'Carly', 'Cakes', 63);
/*!40000 ALTER TABLE `a2` ENABLE KEYS */;

-- Dumping structure for table users.a3
CREATE TABLE IF NOT EXISTS `a3` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.a3: ~4 rows (approximately)
/*!40000 ALTER TABLE `a3` DISABLE KEYS */;
INSERT INTO `a3` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 75),
	(1007998998, 'Stanley', 'Wright', 88),
	(100789333, 'Marley', 'Uless', 89),
	(100790777, 'Carly', 'Cakes', 90);
/*!40000 ALTER TABLE `a3` ENABLE KEYS */;

-- Dumping structure for table users.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `question` varchar(255) NOT NULL,
  `answer` varchar(10000) DEFAULT NULL,
  `instructor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.feedback: ~5 rows (approximately)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`question`, `answer`, `instructor`) VALUES
	('a', 'I thought the teaching style was very good and clear.', 'Bill Who'),
	('b', 'I think you should slow down when talking', 'Bill Who'),
	('c', 'The labs had relevant information to the course', 'Bill Who'),
	('d', 'We should have the TAs do a revew during the labs', 'Bill Who'),
	('e', 'Good course overall, would recommend!', 'Bill Who');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table users.final
CREATE TABLE IF NOT EXISTS `final` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.final: ~4 rows (approximately)
/*!40000 ALTER TABLE `final` DISABLE KEYS */;
INSERT INTO `final` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 81),
	(1007998998, 'Stanley', 'Wright', 75),
	(100789333, 'Marley', 'Uless', 82),
	(100790777, 'Carly', 'Cakes', 68);
/*!40000 ALTER TABLE `final` ENABLE KEYS */;

-- Dumping structure for table users.logininfo
CREATE TABLE IF NOT EXISTS `logininfo` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.logininfo: ~8 rows (approximately)
/*!40000 ALTER TABLE `logininfo` DISABLE KEYS */;
INSERT INTO `logininfo` (`username`, `password`, `email`, `studentId`, `firstName`, `lastName`, `userType`) VALUES
	('bbrown', '987654321', 'bobbrown@hotmail.com', 1002436698, 'Bob', 'Brown', 'Student'),
	('billy77', 'harrietcat', 'bill.who@utoronto.ca', NULL, 'Bill', 'Who', 'Instructor'),
	('carlyrules', 'mypassword', 'carlyrules@hotmail.ca', 100790777, 'Carly', 'Cakes', 'Student'),
	('jpe123', '12344321', 'joepest@gmail.com', NULL, 'Joe', 'Pest', 'TA'),
	('marleyu', 'password', 'marley200@gmail.com', 100789333, 'Marley', 'Uless', 'Student'),
	('stanley21', '123456', 'stanleyw@live.com', 1007998998, 'Stanley', 'Wright', 'Student'),
	('Susan.ly', 'goodpassword', 'susan.ly@utoronto.ca', NULL, 'Susan', 'Ly', 'Instructor'),
	('vincentla', 'ilikepizza', 'vincentla@utoronto.ca', NULL, 'Vincent', 'La', 'TA');
/*!40000 ALTER TABLE `logininfo` ENABLE KEYS */;

-- Dumping structure for table users.midterm
CREATE TABLE IF NOT EXISTS `midterm` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.midterm: ~4 rows (approximately)
/*!40000 ALTER TABLE `midterm` DISABLE KEYS */;
INSERT INTO `midterm` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 74),
	(1007998998, 'Stanley', 'Wright', 84),
	(100789333, 'Marley', 'Uless', 86),
	(100790777, 'Carly', 'Cakes', 96);
/*!40000 ALTER TABLE `midterm` ENABLE KEYS */;

-- Dumping structure for table users.quiz1
CREATE TABLE IF NOT EXISTS `quiz1` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.quiz1: ~4 rows (approximately)
/*!40000 ALTER TABLE `quiz1` DISABLE KEYS */;
INSERT INTO `quiz1` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 66),
	(1007998998, 'Stanley', 'Wright', 75),
	(100789333, 'Marley', 'Uless', 88),
	(100790777, 'Carly', 'Cakes', 67);
/*!40000 ALTER TABLE `quiz1` ENABLE KEYS */;

-- Dumping structure for table users.quiz2
CREATE TABLE IF NOT EXISTS `quiz2` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.quiz2: ~4 rows (approximately)
/*!40000 ALTER TABLE `quiz2` DISABLE KEYS */;
INSERT INTO `quiz2` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 76),
	(1007998998, 'Stanley', 'Wright', 68),
	(100789333, 'Marley', 'Uless', 82),
	(100790777, 'Carly', 'Cakes', 77);
/*!40000 ALTER TABLE `quiz2` ENABLE KEYS */;

-- Dumping structure for table users.quiz3
CREATE TABLE IF NOT EXISTS `quiz3` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  UNIQUE KEY `studentId` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.quiz3: ~4 rows (approximately)
/*!40000 ALTER TABLE `quiz3` DISABLE KEYS */;
INSERT INTO `quiz3` (`studentId`, `firstName`, `lastName`, `grade`) VALUES
	(1002436698, 'Bob', 'Brown', 71),
	(1007998998, 'Stanley', 'Wright', 85),
	(100789333, 'Marley', 'Uless', 85),
	(100790777, 'Carly', 'Cakes', 88);
/*!40000 ALTER TABLE `quiz3` ENABLE KEYS */;

-- Dumping structure for table users.remarkrequests
CREATE TABLE IF NOT EXISTS `remarkrequests` (
  `studentId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `assessment` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  UNIQUE KEY `assessment` (`assessment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table users.remarkrequests: ~2 rows (approximately)
/*!40000 ALTER TABLE `remarkrequests` DISABLE KEYS */;
INSERT INTO `remarkrequests` (`studentId`, `firstName`, `lastName`, `assessment`, `reason`) VALUES
	(1002436698, 'Bob', 'Brown', 'a1', 'can you please remark the css, i think it is correct.'),
	(1002436698, 'Bob', 'Brown', 'midterm', 'can you please remark question 2?');
/*!40000 ALTER TABLE `remarkrequests` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
