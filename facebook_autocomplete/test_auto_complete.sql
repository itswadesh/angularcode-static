-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2012 at 05:26 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2lessons`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_auto_complete`
--

CREATE TABLE IF NOT EXISTS `test_auto_complete` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `media` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_auto_complete`
--

INSERT INTO `test_auto_complete` (`uid`, `username`, `email`, `media`, `country`) VALUES
(64, 'Swadesh', '99points.in', 'https://api.twitter.com/1/users/profile_image?id=86659280&size=bigger', ''),
(63, 'Dharitri Behera', 'dharitri@yahoo.com', 'https://graph.facebook.com/100002537262432/picture&type=small', ''),
(62, 'Afriend In', 'afriend.in', 'https://graph.facebook.com/100003591469382/picture&type=small', ''),
(61, 'Ipsita Sahoo', '2lessons@gmail.com', 'https://graph.facebook.com/100004095664738/picture&type=small', ''),
(60, 'Swadesh Behera', 'itswadesh.wordpress.com', 'https://graph.facebook.com/1084643494/picture&type=small', ''),
(49, 'Admin', 'admin', '', ''),
(1, 'Swadesh', 'blog.afriend.in', '', ''),
(2, 'Brijesh', 'brijesh@gmail.com', '', ''),
(3, 'Vimla', 'vimla@gmail.com', '', ''),
(59, 'Ipsita Sahoo', '2lessons.com', 'https://api.twitter.com/1/users/profile_image?id=598307001&size=bigger', ''),
(56, 'Swadesh Behera', 'itswadesh@gmail.com', 'https://graph.facebook.com/1468831042/picture&type=small', ''),
(65, 'hacking tutorials', 'hackingtutorials.info', 'https://api.twitter.com/1/users/profile_image?id=579937206&size=bigger', ''),
(66, 'Anonymous', 'a@a.com', '', '');
