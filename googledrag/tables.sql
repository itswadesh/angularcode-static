-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2011 at 06:46 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `circles`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(9) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(220) NOT NULL,
  `sort` int(9) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `sort`, `date`) VALUES
(1, 'friends', 0, '2011-07-20 00:00:00'),
(2, 'family', 1, '2011-07-20 11:30:47'),
(3, 'following', 4, '2011-07-20 11:31:05'),
(4, 'acqaintances', 3, '2011-07-20 11:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(9) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(220) NOT NULL,
  `member_image` text NOT NULL,
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_image`, `dated`) VALUES
(1, 'Swadesh', 'Swadesh.JPG', '2011-07-20 11:35:46'),
(2, 'Vimla', 'Vimla.jpg', '2011-07-20 11:36:17'),
(3, 'Anjana', 'Anjana.jpg', '2011-07-20 11:36:30'),
(4, 'Brijesh', 'Brijesh.jpg', '2011-07-20 11:36:48'),
(5, 'Mahesh', 'Mahesh.jpg', '2011-07-20 11:37:02'),
(6, 'Niharika', 'Niharika.jpg', '2011-07-20 11:37:14'),
(7, 'Ipsita', 'Ipsita.jpg', '2011-07-20 11:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `user_id` int(9) NOT NULL,
  `group_id` int(9) NOT NULL,
  `member_id` int(9) NOT NULL,
  `sort` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=289 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`, `member_id`, `sort`) VALUES
(288, 1, 4, 1, 1);
