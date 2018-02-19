SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `fsearch`
--

CREATE TABLE IF NOT EXISTS `fsearch` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `media` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fsearch`
--

INSERT INTO `fsearch` (`uid`, `username`, `email`, `media`, `country`) VALUES
(1, 'codenx', 'info@codenx.com', 'codenx.jpg', 'India'),
(2, '2lessons', 'info@2lessons.info', '2lessons.jpg', 'India'),
(3, 'Swadesh', 'swadesh@gmail.com', 'swadesh.jpg', 'India'),
(4, 'Ipsita Sahoo', 'ipsita@gmail.com', 'ipsita.jpg', 'India'),
(5, 'Tamanna Priyadarsini', 'tamanna@gmail.com', 'tamanna.jpg', 'India'),
(6, 'Tapaswini Sahoo', 'tapaswini@gmail.com', 'linky.jpg', 'India'),
(7, 'Sandhya Samant', 'sandhya@gmail.com', 'sandhya.jpg', 'India'),
(8, 'Satvik Mohanty', 'satvik@gmail.com', 'satvik.jpg', 'India');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
