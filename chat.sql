-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2015 at 11:42 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `firstName`, `lastName`) VALUES
(1, 'Jamie', 'Labutap'),
(2, 'Rovie', 'Labutap'),
(3, 'Louie', 'Almeda');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `message` text NOT NULL,
  `dateTime` date NOT NULL,
  PRIMARY KEY (`messageID`),
  KEY `senderID` (`senderID`),
  KEY `receiverID` (`receiverID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `senderID`, `receiverID`, `message`, `dateTime`) VALUES
(3, 1, 2, 'One last time...', '0000-00-00'),
(4, 2, 1, 'I need to be the who takes you home.', '2015-07-10');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `accounts` (`accountID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiverID`) REFERENCES `accounts` (`accountID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
