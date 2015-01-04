-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2013 at 03:03 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wonder`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eID` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `genre` enum('music','nature','bar','house','dance','sport') NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sdate_time` datetime NOT NULL,
  `edate_time` datetime NOT NULL,
  PRIMARY KEY (`eID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eID`, `eventName`, `location`, `genre`, `day`, `month`, `year`, `url`, `sdate_time`, `edate_time`) VALUES
(1, 'johnsDance', 'johns cardboard box', '', 18, 9, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'johnsDance', 'johnsToilet', 'dance', 9, 7, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'danielsJig', 'daniels Room', 'music', 3, 11, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'hello', 'hello', 'nature', 13, 9, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'dark', 'dark', 'house', 14, 9, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'fart', 'fart', 'sport', 15, 7, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'solo', 'riding solo', 'dance', 12, 7, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'TEN', 'tenday', 'music', 10, 10, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'shwaty', 'in my head', 'bar', 31, 0, 0, '', '2013-08-10 00:00:00', '2013-08-10 01:00:00'),
(10, 'johns rage', 'death', 'nature', 30, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'calm down', 'srsly', 'bar', 29, 7, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'walk', 'park', 'nature', 28, 7, 0, '', '2013-07-28 06:00:00', '2013-07-28 17:00:00'),
(13, 'hello', 'myoldfriend', 'dance', 27, 7, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'hello darkness', 'my old friend', 'house', 26, 7, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'rufles', 'chips', 'bar', 25, 7, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'penis', 'vagina', 'dance', 20, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'SUPERHUMAN', 'KRYPTONITE', 'sport', 6, 8, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '2NDEVENT', 'ADAD', 'sport', 6, 7, 2013, '', '2013-08-09 00:00:00', '2013-08-09 02:00:00'),
(19, 'testtest', 'PLEAASSE', 'nature', 14, 7, 2013, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_members`
--

CREATE TABLE IF NOT EXISTS `temp_members` (
  `confirm_code` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `d_o_b` date NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_members`
--

INSERT INTO `temp_members` (`confirm_code`, `username`, `email`, `password`, `first_name`, `gender`, `d_o_b`, `last_name`) VALUES
('', '', '', '', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_events` varchar(255) NOT NULL,
  `d_o_b` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `friends` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `firstName`, `lastName`, `email`, `password`, `reg_events`, `d_o_b`, `gender`, `friends`) VALUES
(1, 'johnSlee', 'John', '', 'shepjohnlee@gmail.com', 'john', '1, 2, 4, 12', '0000-00-00', 'Male', 'john'),
(3, 'john', 'john', 'lee', 'john', 'john', '1, 19, 15, 15, 14, 12, 18', '0000-00-00', 'Male', 'john, johnSlee'),
(4, 'john2', 'johnf', 'johnl', 'email@email.com', 'john2', '1, 13, 19', '0000-00-00', 'Male', 'john, johnSlee');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
