-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2012 at 01:35 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `list`
--

-- --------------------------------------------------------

--
-- Table structure for table `photoUpload`
--

CREATE TABLE IF NOT EXISTS `photoupload` (
  `uid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `profile_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photoUpload`
--

INSERT INTO `photoUpload` (`uid`, `username`, `profile_image`) VALUES
(100, '2lessons', 'donald-duck.jpg');
