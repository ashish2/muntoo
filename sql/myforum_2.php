<?php

/*
 * -- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2011 at 08:01 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1
*/

$q = array();

$q[] = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*
 * 
--
-- Database: `myforum_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--
*/

$q[] = "CREATE TABLE IF NOT EXISTS `topics` (
  `tid` int(4) NOT NULL AUTO_INCREMENT,
  `tname` varchar(512) NOT NULL,
  `tdesc` longtext NOT NULL,
  `tdate` varchar(64) NOT NULL,
  `tcreatedby` varchar(64) NOT NULL,
  `tcreatedbyuid` int(4) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ";

/*
 * --
-- Dumping data for table `topics`
--
*/

/*
 * 
$q[] = "INSERT INTO `topics` (`tid`, `tname`, `tdesc`, `tdate`, `tcreatedby`, `tcreatedbyid`) VALUES
(1, 'topic 1', 'this is topic 1.\r\nthis is topic 1.\r\nthis is topic 1.', '', 'ash2', 14),
(2, 'topic1', 'this is topic 1.rnthis is topic 1.rnthis is topic 1.', '', 'ash2', 14),
(20, 'next topic', 'this is the next topic for all of us.\\r\\nits obvicously a nice topic.', '12/Sep/10 - 16:49:28', 'ash4', 16),
(4, 'topic1', 'this is topic 1.rnthis is topic 1.rnthis is topic 1.', '10/09/10 - 12:09:54', 'ash2', 14),
(5, 'topic1', 'this is topic 1.rnthis is topic 1.rnthis is topic 1.', '10/09/10 - 12:09:10', 'ash2', 14),
(6, 'topic1', 'this is topic 1.rnthis is topic 1.rnthis is topic 1.', '10/09/10 - 12:09:43', 'ash2', 14),
(7, 'topic1', 'this is topic 1.rnthis is topic 1.rnthis is topic 1.', '10/09/10 - 12:09:34', 'ash2', 14),
(21, 'topic 21', 'this is topic 21.\\r\\nthere have been 21 topics in this forum \\r\\nuptill now.', '12/Sep/10 - 16:50:55', 'ash4', 16),
(9, 'topic1', 'this is topic 1.rnthis is topic 1.rnthis is topic 1.', '10/Sep/10 - 12:09:21', 'ash2', 14),
(10, 'topic2', 'this is topic 2.rntopic 2.rnthis is topic 2.', '10/Sep/10 - 12:09:57', 'ash2', 14),
(12, 'topic2', 'this is topic 2.rntopic 2.rnthis is topic 2.', '10/Sep/10 - 01:01:37', 'ash2', 14),
(14, 'topic2', 'this is topic 2.rntopic 2.rnthis is topic 2.', '10/Sep/10 - 01:02:03', 'ash2', 14),
(23, 'topic 23', 'topic number 23 here.<br><br>another topic of the forum.<br><br>there are a lot of topics in the forum.', '12/Sep/10 - 22:07:50', 'ash4', 16),
(16, 'topic 16', 'this is topic 16.\\r\\nthis topic is a cool topic.\\r\\ntopic number \\''16\\'' are always kool topics.\\r\\nthis topic is so kool, that there is not \\r\\nother topic which can ever be as kool \\r\\nas topic 16.\\r\\nand thats the bottom line, \\r\\ncoz stone cold said so.', '10/Sep/10 - 12:59:08', 'ash2', 14),
(17, 'topic 17', 'this is a dangerous topic.\\r\\nits called topic number 17.\\r\\nheee haaahaahahahaha.', '10/Sep/10 - 17:31:22', 'ash1', 1),
(18, 'topic 18', 'this shud be a good topic.\\r\\ncoz i think the code has become better, \\r\\nso lets c if this one is a good topic.\\r\\n', '10/Sep/10 - 17:39:32', 'ash4', 16),
(22, 'topic 22', 'creating topic number 22 here.<br><br>this is another topic created in the forum.', '12/Sep/10 - 22:01:35', 'ash4', 16),
(24, 'topic 24', 'this is topic number 24.<br><br>this forum has quite a number of topics.<br><br>you can check different topics here.', '12/Sep/10 - 22:22:13', 'ash7', 18)";

*/

/*
 * -- --------------------------------------------------------

--
-- Table structure for table `users`
--
*/

$q[] = "CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `salt` varchar(3) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ";

//--
//-- Dumping data for table `users`
//--

/*
$q[] = "INSERT INTO `users` (`uid`, `username`, `password`, `email`, `salt`) VALUES
(1, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(2, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(3, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(4, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(5, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(6, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(7, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(8, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(9, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(10, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(11, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(12, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(13, 'ash1', '0fc03fae44e621f6a32b12c16796e6ba', 'ash1@email.com', ''),
(14, 'ash2', '88890f88787eadcd0e11c8e4d07dd838', 'ash2@in.com', ''),
(15, 'ash3', '89be6a4db5d7ef5ea64773d4b673fbfa', 'ash3@email.com', ''),
(16, 'ash4', '5d210cb69fd9ebfb4645a3f2e92dcd2e', 'ash4@000..00..in', ''),
(17, 'ash5', '5c7f8d75fa46e1e87ec57def7cdd9959', 'ash5@email.com', ''),
(18, 'ash7', '696d29e0940a4957748fe3fc9efd22a3', 'ash7@email.com', '')";
*/

/*
$w = array();

$w[1] = "Select * FROM tables";
*/




?>
