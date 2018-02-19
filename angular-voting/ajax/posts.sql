-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-ipg99.eigbox.net
-- Generation Time: Apr 20, 2016 at 03:51 AM
-- Server version: 5.5.43
-- PHP Version: 4.4.9
-- 
-- Database: `demos`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `posts`
-- 

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL,
  `url` varchar(200) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `posts`
-- 

INSERT INTO `posts` VALUES (1, 'Google', 'Search Engine', 'http://google.com', 538);
INSERT INTO `posts` VALUES (2, 'Angular Code', 'AngularJS tutorials', 'http://angularcode.com', 549);
INSERT INTO `posts` VALUES (3, 'Envato', 'Tuts Plus Community', 'http://envato.com', 78);
INSERT INTO `posts` VALUES (4, 'Stack Overflow', 'Question Answer Website', 'http://stackoverflow.com', 123);
