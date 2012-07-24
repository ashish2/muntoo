-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2012 at 10:26 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myforum_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `a_priv` int(10) unsigned NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`a_id`, `a_name`, `a_priv`) VALUES
(1, 'view', 1),
(2, 'publish', 2),
(5, 'edit', 4),
(6, 'delete', 8);

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `ban_uid` int(5) NOT NULL DEFAULT '0',
  `banned` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ban_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banned`
--

INSERT INTO `banned` (`ban_uid`, `banned`) VALUES
(100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `bid` int(4) NOT NULL AUTO_INCREMENT,
  `bname` varchar(500) DEFAULT NULL,
  `bdesc` longtext,
  `bdate` varchar(64) DEFAULT NULL,
  `bcreatedby` varchar(64) DEFAULT NULL,
  `bcreatedbyuid` int(4) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`bid`, `bname`, `bdesc`, `bdate`, `bcreatedby`, `bcreatedbyuid`) VALUES
(1, 'General Discussion', 'Place where you can discuss anything in general.', '06-05-2011', 'a1u', 1),
(2, 'Funny', 'funny topics here', 'today', 'a1u', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `g_priv` int(11) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`g_id`, `g_name`, `g_priv`) VALUES
(1, 'guest', 1),
(3, 'publisher', 3),
(4, 'editor', 5),
(5, 'administrator', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `pm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pm_id_head` int(10) unsigned NOT NULL,
  `pm_from_uid` int(5) unsigned NOT NULL,
  `pm_deleted_by_sender` tinyint(3) unsigned NOT NULL,
  `pm_from_name` varchar(255) DEFAULT NULL,
  `pm_sent_time` int(10) unsigned DEFAULT NULL,
  `pm_subject` varchar(100) DEFAULT NULL,
  `pm_body` text,
  PRIMARY KEY (`pm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pm`
--

INSERT INTO `pm` (`pm_id`, `pm_id_head`, `pm_from_uid`, `pm_deleted_by_sender`, `pm_from_name`, `pm_sent_time`, `pm_subject`, `pm_body`) VALUES
(1, 0, 1, 0, 'a1u', 0, 'hi', 'how are u dude?'),
(2, 0, 1, 0, 'a1u', 0, 'hi', 'how are u dude?'),
(3, 0, 1, 0, 'a1u', 0, 'Hi.', 'haalooo'),
(4, 0, 1, 0, 'a1u', 0, 'Hi.', 'haalooo');

-- --------------------------------------------------------

--
-- Table structure for table `pm_recepients`
--

CREATE TABLE IF NOT EXISTS `pm_recepients` (
  `pm_id` int(5) unsigned NOT NULL,
  `pm_sent_to_uid` mediumint(5) unsigned NOT NULL,
  `pm_labels` varchar(60) NOT NULL DEFAULT '-1',
  `pm_is_read` tinyint(3) NOT NULL,
  `pm_is_new` tinyint(3) NOT NULL,
  `pm_is_deleted` tinyint(3) NOT NULL,
  KEY `pm_id_idx` (`pm_id`) USING BTREE,
  KEY `pm_sent_to_uid_idx` (`pm_sent_to_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pm_recepients`
--

INSERT INTO `pm_recepients` (`pm_id`, `pm_sent_to_uid`, `pm_labels`, `pm_is_read`, `pm_is_new`, `pm_is_deleted`) VALUES
(3, 1, '-1', 0, 1, 0),
(3, 2, '-1', 0, 1, 0),
(4, 1, '-1', 0, 1, 0),
(4, 2, '-1', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `users_uid` int(5) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(32) DEFAULT NULL,
  `about` longtext,
  `dob` int(10) unsigned DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `display_pic_url` varchar(255) DEFAULT NULL,
  `perfume` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`users_uid`, `display_name`, `about`, `dob`, `sex`, `display_pic_url`, `perfume`) VALUES
(1, '', NULL, 0, 'm', NULL, '&lt;html&gt;'),
(2, NULL, NULL, 0, NULL, NULL, NULL),
(3, NULL, NULL, 0, NULL, NULL, NULL),
(4, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rsubject` varchar(255) NOT NULL DEFAULT '0',
  `rbody` text NOT NULL,
  `topic_tid` int(10) unsigned NOT NULL DEFAULT '0',
  `poster_users_uid` int(5) NOT NULL DEFAULT '0',
  `date` int(10) unsigned NOT NULL DEFAULT '0',
  `user_ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `topic_tid` (`topic_tid`),
  KEY `poster_users_uid` (`poster_users_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`rid`, `rsubject`, `rbody`, `topic_tid`, `poster_users_uid`, `date`, `user_ip`) VALUES
(1, 'reply to topic 1', 'this is reply1 topic 1, \r\nall u frends enjoy topic 1\r\n', 1, 1, 1312046377, '127.0.0.1'),
(2, 'reply to topic 1', 'this is reply2 to topic 1.\r\nenjoy topic 1, guys.\r\n', 1, 1, 1312046380, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `about` longtext,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sex` char(1) DEFAULT NULL,
  `displaypic_url` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `perfume` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`about`, `dob`, `sex`, `displaypic_url`, `website_url`, `perfume`) VALUES
('hi hi hi', '2011-10-28 00:49:21', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `tid` int(4) NOT NULL AUTO_INCREMENT,
  `tname` varchar(512) NOT NULL,
  `tdesc` longtext NOT NULL,
  `tdate` varchar(64) NOT NULL,
  `tcreatedby` varchar(64) NOT NULL,
  `tcreatedbyuid` int(4) NOT NULL,
  `tcreatedbyuid_IPv4` binary(4) DEFAULT NULL,
  `tcreatedbyuid_IPv6` binary(16) DEFAULT NULL,
  `board_bid` int(5) NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `board_bid` (`board_bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`tid`, `tname`, `tdesc`, `tdate`, `tcreatedby`, `tcreatedbyuid`, `tcreatedbyuid_IPv4`, `tcreatedbyuid_IPv6`, `board_bid`) VALUES
(1, 'topic1', 'this is topic 1', 'today', 'a1u', 1, NULL, NULL, 1),
(2, 'topic2', 'this is topic2', 'today2', 'a1u', 1, NULL, NULL, 1),
(3, 'topic3', 'this is topic3', 'today3', 'a1u', 1, NULL, NULL, 1),
(4, 'funnyTopic1', 'description of top', '1319668760', '', 1, NULL, 'þ€ €\0\0\0\0\0\0\0\0\0\0\0', 2),
(18, 'funnyTopic2', 'this is funny topic number2.', '1319669908', '', 1, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 2),
(17, 'funnyTopic2', 'this is funny topic number2.', '1319669903', '', 1, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 2),
(19, 'funnyTopic1', 'akjfkj haksjh hf kh', '1319711428', '', 1, '\0\0', NULL, 2),
(20, 'funnyTopic1', 'akjfkj haksjh hf kh', '1319711460', '', 1, '\0\0', NULL, 2),
(21, 'funnyTopic1', 'akjfkj haksjh hf kh', '1319711497', '', 1, '\0\0', NULL, 2),
(22, 'funnyTopic1', 'akjfkj haksjh hf kh', '1319711516', '', 1, '\0\0', NULL, 2),
(23, 'funnyTopic1', 'akjfkj haksjh hf kh', '1319711554', '', 1, '\0\0', NULL, 2),
(24, '', '', '1327016747', '', 1, '\0\0', NULL, 1),
(25, '', '', '1327016761', '', 1, '\0\0', NULL, 1),
(26, 'topic3', 'this is topic number 3.', '1327016779', '', 1, '\0\0', NULL, 1),
(27, '', '', '1327016805', '', 1, '\0\0', NULL, 1),
(28, 'topic4', 'topic number 4', '1327016820', '', 1, '\0\0', NULL, 1),
(29, '', '', '1327016836', '', 1, '\0\0', NULL, 1),
(30, 'topic5', 'topic number 5', '1327016847', '', 1, '\0\0', NULL, 1),
(31, '', '', '1327016866', '', 1, '\0\0', NULL, 1),
(32, '', '', '1327090467', '', 1, '\0\0', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(64) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `salt` varchar(3) NOT NULL,
  `group` int(11) NOT NULL,
  `friends_list` text NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `group` (`group`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `url`, `salt`, `group`, `friends_list`) VALUES
(1, 'a1u', '5ab39f92a0d226eac552661548dea5f7', 'a1@a.com', 'a1.com', 'abc', 5, ''),
(2, 'a2u', 'f9a3362e3ce11bd9ab7551a56a88270c', 'a2@a.com', 'a2.com', 'abc', 1, ''),
(3, 'a3u', '2eaad4845d03750ddcf7ca22e438e4a6', 'a3@a.com', 'a3.com', 'abc', 3, ''),
(4, 'a4u', '8cadf36e608112936566d862986bd19e', 'a4@a.com', 'a4.com', 'abc', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `wall_post`
--

CREATE TABLE IF NOT EXISTS `wall_post` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `on_uid` int(10) unsigned DEFAULT NULL,
  `by_uid` int(10) unsigned DEFAULT NULL,
  `content` text,
  `date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_on_uid` (`on_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wall_post`
--

