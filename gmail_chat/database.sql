
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=539 ;


CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(8) NOT NULL,
  `dob` varchar(16) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `profile_image` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `gender`, `dob`, `phone`, `profile_image`) VALUES
(1, 'Swadesh', 'pass1', 'blog.afriend.in', '', '', '', ''),
(2, 'Brijesh', 'pass1', 'brijesh@gmail.com', '', '', '', ''),
(3, 'Vimla',  'pass1', 'vimla@gmail.com', '', '', '','');