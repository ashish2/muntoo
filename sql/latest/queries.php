<?php

/*

-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2012 at 12:21 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8
*/

///SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
///SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*
--
-- Database: `myforum_3_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `actions` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `a_priv` int(10) unsigned NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;
";

/*
--
-- Dumping data for table `actions`
--
*/

$q[] = "
INSERT INTO `actions` (`a_id`, `a_name`, `a_priv`) VALUES
(1, 'view', 1),
(2, 'publish', 2),
(5, 'edit', 4),
(6, 'delete', 8);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_actions`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_actions` (
  `ai_actions_id` int(5) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(255) DEFAULT NULL COMMENT '#Action function to run#',
  `a_severity_level` int(4) DEFAULT NULL,
  `unit_of_time` varchar(255) DEFAULT NULL COMMENT '#Unit of time to keep the action alive#',
  `params_for_action_name` text,
  PRIMARY KEY (`ai_actions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
";

/*
--
-- Dumping data for table `ai_actions`
--
*/

$q[] = "
INSERT INTO `ai_actions` (`ai_actions_id`, `action_name`, `a_severity_level`, `unit_of_time`, `params_for_action_name`) VALUES
(1, 'warn_ip', 1, '1', NULL),
(2, 'ban', 1, '1', NULL),
(3, 'ban', 2, '2', NULL),
(4, 'ban', 3, '0', NULL);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_actions_taken`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_actions_taken` (
  `ai_actions_taken_id` int(4) NOT NULL AUTO_INCREMENT,
  `users_uid` int(4) DEFAULT NULL,
  `ban` tinyint(1) DEFAULT NULL,
  `ban_ip` tinyint(1) DEFAULT NULL,
  `warn_ip` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ai_actions_taken_id`),
  UNIQUE KEY `users_uid` (`users_uid`),
  KEY `users_uid_2` (`users_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
";

/*
--
-- Dumping data for table `ai_actions_taken`
--
*/

$q[] = "
INSERT INTO `ai_actions_taken` (`ai_actions_taken_id`, `users_uid`, `ban`, `ban_ip`, `warn_ip`) VALUES
(1, 0, NULL, NULL, NULL),
(3, 8, NULL, NULL, NULL);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_causes`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_causes` (
  `ai_cause_id` int(5) NOT NULL AUTO_INCREMENT,
  `cause_name` varchar(255) DEFAULT NULL,
  `c_severity_level` int(4) DEFAULT NULL,
  `ai_e_effect_name` varchar(255) DEFAULT NULL COMMENT '#Corresponds to the effect name column of the ai_effects table#',
  PRIMARY KEY (`ai_cause_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
";

/*
--
-- Dumping data for table `ai_causes`
--
*/

$q[] = "
INSERT INTO `ai_causes` (`ai_cause_id`, `cause_name`, `c_severity_level`, `ai_e_effect_name`) VALUES
(1, 'spam_words', 1, 'warn_for_ip'),
(2, 'spam_words', 2, 'ban_ip');
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_effects`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_effects` (
  `ai_effect_id` int(5) NOT NULL AUTO_INCREMENT,
  `effect_name` varchar(255) DEFAULT NULL COMMENT '#Name of the final effect that is the resultant#',
  `ai_action_actname` varchar(255) DEFAULT NULL COMMENT '#Corresponds to the action_name column in the ai_actions table#',
  PRIMARY KEY (`ai_effect_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
";

/*
--
-- Dumping data for table `ai_effects`
--
*/

$q[] = "
INSERT INTO `ai_effects` (`ai_effect_id`, `effect_name`, `ai_action_actname`) VALUES
(1, 'warn_for_ip', 'warn_ip'),
(2, 'ban_ip', 'ban');
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_error_logs`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_error_logs` (
  `ai_error_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_uid` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL COMMENT 'whether cause happened or action was taken etc for the effect to happen',
  `type` varchar(255) DEFAULT NULL COMMENT 'which type of reason happened, like spam_words was the type of reason cause',
  `any_definition` text COMMENT 'any definition abt the cause or action taken, etc, like cause spam_words happened at this time etc, the why?',
  `datetime` int(5) DEFAULT '0',
  `aiul_ai_u_l_id` int(5) DEFAULT NULL COMMENT '#corresponding id (ai_u_l_id) of the ai_user_logs table, foreign key for that column#',
  PRIMARY KEY (`ai_error_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_keyword_definitions`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_keyword_definitions` (
  `ai_keydef_id` int(5) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL COMMENT '#keywords that have some defintions#',
  `definition` text COMMENT '#the definition of the keyword#',
  PRIMARY KEY (`ai_keydef_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
";

/*
--
-- Dumping data for table `ai_keyword_definitions`
--
*/

$q[] = "
INSERT INTO `ai_keyword_definitions` (`ai_keydef_id`, `keyword`, `definition`) VALUES
(1, 'spam_words', 'fuck,sex');
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_logs`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_logs` (
  `ai_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_uid` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL COMMENT 'whether cause happened or action was taken etc for the effect to happen',
  `type` varchar(255) DEFAULT NULL COMMENT 'which type of reason happened, like spam_words was the type of reason cause',
  `any_definition` text COMMENT 'any definition abt the cause or action taken, etc, like cause spam_words happened at this time etc, the why?',
  `datetime` int(5) DEFAULT '0',
  `aiul_ai_u_l_id` int(5) DEFAULT NULL COMMENT '#corresponding id (ai_u_l_id) of the ai_user_logs table, foreign key for that column#',
  PRIMARY KEY (`ai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
";

/*
--
-- Dumping data for table `ai_logs`
--
*/

$q[] = "
INSERT INTO `ai_logs` (`ai_id`, `users_uid`, `reason`, `type`, `any_definition`, `datetime`, `aiul_ai_u_l_id`) VALUES
(1, 3, 'cause', 'spam_words', NULL, 0, NULL),
(2, 3, 'cause', 'spam_words', NULL, 0, NULL),
(3, 1, 'cause', 'spam_words', '', 1339334770, 0);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `ai_user_logs`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `ai_user_logs` (
  `ai_u_l_id` int(5) NOT NULL AUTO_INCREMENT,
  `users_uid` int(5) DEFAULT NULL,
  `event` text COMMENT '#what event happened, like, what did the user do at this time, what happened?#',
  `time` int(5) DEFAULT '0',
  PRIMARY KEY (`ai_u_l_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `banned`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `banned` (
  `ban_uid` int(5) NOT NULL DEFAULT '0',
  `banned` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ban_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";

/*
--
-- Dumping data for table `banned`
--
*/

$q[] = "
INSERT INTO `banned` (`ban_uid`, `banned`) VALUES
(100, 1),
(5, 1);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `board`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `board` (
  `bid` int(4) NOT NULL AUTO_INCREMENT,
  `bname` varchar(500) DEFAULT NULL,
  `bdesc` longtext,
  `bdate` varchar(64) DEFAULT NULL,
  `bcreatedby` varchar(64) DEFAULT NULL,
  `bcreatedbyuid` int(4) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
";

/*
--
-- Dumping data for table `board`
--
*/

$q[] = "
INSERT INTO `board` (`bid`, `bname`, `bdesc`, `bdate`, `bcreatedby`, `bcreatedbyuid`) VALUES
(1, 'General Discussion', 'Place where you can discuss anything in general.', '06-05-2011', 'a1u', 1),
(2, 'Funny', 'funny topics here', 'today', 'a1u', 1);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `groups`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `groups` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `g_priv` int(11) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;
";

/*
--
-- Dumping data for table `groups`
--
*/

$q[] = "
INSERT INTO `groups` (`g_id`, `g_name`, `g_priv`) VALUES
(1, 'guest', 1),
(3, 'publisher', 3),
(4, 'editor', 5),
(5, 'administrator', 15);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `pm`
--
*/

$q[] = "
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
";

/*
--
-- Dumping data for table `pm`
--
*/

$q[] = "
INSERT INTO `pm` (`pm_id`, `pm_id_head`, `pm_from_uid`, `pm_deleted_by_sender`, `pm_from_name`, `pm_sent_time`, `pm_subject`, `pm_body`) VALUES
(1, 0, 1, 0, 'a1u', 0, 'hi', 'how are u dude?'),
(2, 0, 1, 0, 'a1u', 0, 'hi', 'how are u dude?'),
(3, 0, 1, 0, 'a1u', 0, 'Hi.', 'haalooo'),
(4, 0, 1, 0, 'a1u', 0, 'Hi.', 'haalooo');
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `pm_recepients`
--
*/

$q[] = "
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
";

/*
--
-- Dumping data for table `pm_recepients`
--
*/

$q[] = "
INSERT INTO `pm_recepients` (`pm_id`, `pm_sent_to_uid`, `pm_labels`, `pm_is_read`, `pm_is_new`, `pm_is_deleted`) VALUES
(3, 1, '-1', 0, 1, 0),
(3, 2, '-1', 0, 1, 0),
(4, 1, '-1', 0, 1, 0),
(4, 2, '-1', 0, 1, 0);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `profile`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `profile` (
  `users_uid` int(5) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(32) DEFAULT NULL,
  `about` longtext,
  `dob` int(10) unsigned DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `display_pic_url` varchar(255) DEFAULT NULL,
  `perfume` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
";

/*
--
-- Dumping data for table `profile`
--
*/

$q[] = "
INSERT INTO `profile` (`users_uid`, `display_name`, `about`, `dob`, `sex`, `display_pic_url`, `perfume`) VALUES
(1, '', 'im this and also i m that.', 0, 'm', '', 'html'),
(2, 'A2U', 'whats this?\r\ni think its the &quot;about me section&quot;.', 0, 'm', '', ''),
(3, '', 'i m a3u.', 0, '', '', ''),
(4, NULL, NULL, 0, NULL, NULL, NULL),
(5, '', 'i m user 5.', 0, 'm', '', 'ck'),
(6, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `replies`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `replies` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rsubject` varchar(255) DEFAULT NULL,
  `rbody` text NOT NULL,
  `topic_tid` int(10) unsigned NOT NULL DEFAULT '0',
  `poster_users_uid` int(5) NOT NULL DEFAULT '0',
  `date` int(10) unsigned NOT NULL DEFAULT '0',
  `user_ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `topic_tid` (`topic_tid`),
  KEY `poster_users_uid` (`poster_users_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;
";

/*
--
-- Dumping data for table `replies`
--
*/

$q[] = "
INSERT INTO `replies` (`rid`, `rsubject`, `rbody`, `topic_tid`, `poster_users_uid`, `date`, `user_ip`) VALUES
(1, 'reply to topic 1', 'this is reply1 topic 1, \r\nall u frends enjoy topic 1\r\n', 1, 1, 1312046377, '127.0.0.1'),
(2, 'reply to topic 1', 'this is reply2 to topic 1.\r\nenjoy topic 1, guys.\r\n', 1, 1, 1312046380, '127.0.0.1'),
(3, '0', 'reply to top 3', 1, 1, 1332687504, '127.0.0.1'),
(4, '0', 'reply to top 3', 1, 1, 1332687531, '127.0.0.1'),
(6, '0', 'this is a reply too', 1, 1, 1332687560, '127.0.0.1'),
(7, '0', 'this is a reply too', 1, 1, 1332687560, '127.0.0.1'),
(8, NULL, 'this is a reply too', 1, 1, 1332692233, '127.0.0.1'),
(9, NULL, 'this is a reply too', 1, 1, 1332692238, '127.0.0.1'),
(15, NULL, 'this is a reply too', 1, 1, 1332692493, '127.0.0.1'),
(16, NULL, 'this is a reply too', 1, 1, 1332692497, '127.0.0.1'),
(17, NULL, 'ya yaa ok.o k ok.', 1, 1, 1332692511, '127.0.0.1'),
(18, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332692615, '127.0.0.1'),
(21, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332692663, '127.0.0.1'),
(52, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332694653, '127.0.0.1'),
(53, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332694836, '127.0.0.1'),
(54, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332695143, '127.0.0.1'),
(55, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332695160, '127.0.0.1'),
(56, 'subject', 'reply', 0, 0, 0, '_SERVER[REMOTE_ADDR]'),
(57, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332695263, '127.0.0.1'),
(71, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332695736, '127.0.0.1'),
(77, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332704994, '127.0.0.1'),
(78, 'ok', 'ya yaa ok.o k ok.', 1, 1, 1332705013, '127.0.0.1'),
(79, 'hi', 'this is another response.', 1, 1, 1332705752, '127.0.0.1'),
(80, 'hi', 'this is another response.', 1, 1, 1332705774, '127.0.0.1'),
(81, 'hi', 'this is another response.', 1, 1, 1332705787, '127.0.0.1'),
(99, 'hi', 'this is another response.', 1, 1, 1332706886, '127.0.0.1'),
(108, 'hi', 'this is another response.', 1, 1, 1332707170, '127.0.0.1'),
(109, 'hi', 'this is another response.', 1, 1, 1332707196, '127.0.0.1'),
(110, 'hi', 'this is another response.', 1, 1, 1332707223, '127.0.0.1'),
(111, 'hi to 2', 'this is a reply nmbher 1, to 2.', 2, 1, 1332707329, '127.0.0.1'),
(112, 'ok subj2 for top 2', 'this is reply nmbhr 2 to topic 2.\r\nthank u.', 2, 1, 1332709134, '127.0.0.1'),
(114, 'subj: 5_!', 'hi there, \r\nsubj: 5_!.', 35, 1, 1333829071, '127.0.0.1'),
(116, 'reply to topic 37', 'this is reply to topic 37, \r\nreply nmbr 1.', 37, 1, 1334088990, '127.0.0.1'),
(117, 'rep1', 'reply 1 to topic 31', 38, 1, 1334258748, '127.0.0.1'),
(118, 'rep2', 'reply nmbr 2 to topic nmbr 31', 38, 1, 1334258792, '127.0.0.1');
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `test`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `test` (
  `about` longtext,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sex` char(1) DEFAULT NULL,
  `displaypic_url` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `perfume` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";

/*
--
-- Dumping data for table `test`
--
*/

$q[] = "
INSERT INTO `test` (`about`, `dob`, `sex`, `displaypic_url`, `website_url`, `perfume`) VALUES
('hi hi hi', '2011-10-27 19:19:21', '', NULL, NULL, NULL);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `topics`
--
*/

$q[] = "
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;
";

/*
--
-- Dumping data for table `topics`
--
*/

/*
$q[] = "
INSERT INTO `topics` (`tid`, `tname`, `tdesc`, `tdate`, `tcreatedby`, `tcreatedbyuid`, `tcreatedbyuid_IPv4`, `tcreatedbyuid_IPv6`, `board_bid`) VALUES
(1, 'topic1', 'this is topic 1', 'today', 'a1u', 1, NULL, NULL, 1),
(2, 'topic2', 'this is topic2', 'today2', 'a1u', 1, NULL, NULL, 1),
(3, 'topic3', 'this is topic3', 'today3', 'a1u', 1, NULL, NULL, 1),
(4, 'funnyTopic1', 'description of top', '1319668760', '', 1, NULL, 'þ€ €\0\0\0\0\0\0\0\0\0\0\0', 2),
(18, 'funnyTopic2', 'this is funny topic number2.', '1319669908', '', 1, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 2),
(20, 'funnyTopic1', 'akjfkj haksjh hf kh', '1319711460', '', 1, '\0\0', NULL, 2),
(24, '', '', '1327016747', '', 1, '\0\0', NULL, 1),
(26, 'topic3', 'this is topic number 3.', '1327016779', '', 1, '\0\0', NULL, 1),
(28, 'topic4', 'topic number 4', '1327016820', '', 1, '\0\0', NULL, 1),
(31, '', '', '1327016866', '', 1, '\0\0', NULL, 1),
(33, 'topic no 6', 'this is topic 6.', '1333664713', '', 1, '\0\0', NULL, 1),
(36, 'topic no 7', 'description of topic number 7.', '1333664917', '', 1, '\0\0', NULL, 1),
(37, 'topic 20', 'this is topic nmbr 20.', '1334088951', 'admin', 1, '\0\0', NULL, 1),
";
*/

$q[] = "
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
(32, '', '', '1327090467', '', 1, '\0\0', NULL, 1),
(33, 'topic no 6', 'this is topic 6.', '1333664713', '', 1, '\0\0', NULL, 1),
(34, 'topic no 6', 'this is topic 6.', '1333664752', '', 1, '\0\0', NULL, 1),
(35, 'topic no 6', 'this is topic 6.', '1333664789', '', 1, '\0\0', NULL, 1),
(36, 'topic no 7', 'description of topic number 7.', '1333664917', '', 1, '\0\0', NULL, 1),
(37, 'topic 20', 'this is topic nmbr 20.', '1334088951', 'admin', 1, '\0\0', NULL, 1),
(38, 'topic 31', 'this is topic nmbr 31', '1334258724', 'admin', 1, '\0\0', NULL, 1);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `users`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(64) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `salt` varchar(3) NOT NULL,
  `group` int(11) NOT NULL,
  `friends_list` text NOT NULL,
  `is_banned` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `group` (`group`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
";

/*
--
-- Dumping data for table `users`
--
*/

$q[] = "
INSERT INTO `users` (`uid`, `username`, `password`, `email`, `url`, `salt`, `group`, `friends_list`, `is_banned`) VALUES
(1, 'admin', 'e38561d99e538eb7d936acb92bd847b0', 'a1@a.com', 'a1.com', 'abc', 5, '', NULL),
(2, 'a2u', 'f9a3362e3ce11bd9ab7551a56a88270c', 'a2@a.com', 'a2.com', 'abc', 1, '3,1,4', NULL),
(3, 'a3u', '2eaad4845d03750ddcf7ca22e438e4a6', 'a3@a.com', 'a3.com', 'abc', 3, '2,1,4', NULL),
(4, 'a4u', '8cadf36e608112936566d862986bd19e', 'a4@a.com', 'a4.com', 'abc', 4, '', NULL),
(5, 'a5u', 'fc0534ff85195edd9bdcec845f8e3822', 'a5@a.com', 'a5.com', 'abc', 0, '', 1),
(6, 'a6u', 'e92616e1292392fe4a0f22dc061b9d70', 'a6@a.com', 'a6.com', 'abc', 1, '', NULL),
(7, 'a7u', '34b3c04aed77a3ba7555c2627eb24f00', 'a7@a.com', 'a7.com', 'abc', 1, '', NULL),
(8, 'a8u', '2f82ddd8a34b632f53e2bc266eded98e', 'a8@a.com', 'a8.com', 'abc', 1, '', NULL);
";

/*
-- --------------------------------------------------------

--
-- Table structure for table `wall_post`
--
*/

$q[] = "
CREATE TABLE IF NOT EXISTS `wall_post` (
  `wp_id` int(10) NOT NULL AUTO_INCREMENT,
  `wp_on_uid` int(10) unsigned DEFAULT NULL,
  `wp_by_uid` int(10) unsigned DEFAULT NULL,
  `wp_post` text,
  `wp_date` int(10) unsigned NOT NULL DEFAULT '0',
  `wpr_id` text COMMENT '#Replies associated with this post id, (wall_post_reply table ids associated with this wall_post table id)#',
  PRIMARY KEY (`wp_id`),
  KEY `idx_on_uid` (`wp_on_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;
";


/*
--
-- Dumping data for table `wall_post`
--
*/

$q[] = "
INSERT INTO `wall_post` (`wp_id`, `wp_on_uid`, `wp_by_uid`, `wp_post`, `wp_date`, `wpr_id`) VALUES
(1, 3, 1, 'hi '' \\ kajfdh &quot;ok&quot;;', 1332583192, NULL),
(2, 3, 1, 'hi '' \\ kajfdh &quot;ok&quot;;', 1332583228, NULL),
(6, 3, 1, 'hi \r\nwashhup.', 1332585374, NULL),
(9, 3, 1, 'hi washhup.', 1332585458, NULL),
(10, 3, 1, 'hi \r\nwashhup.', 1332585546, NULL),
(16, 3, 1, 'hi \r\nwashhup.', 1332585740, '19,20'),
(17, 3, 1, 'hi \r\nwashhup.', 1332585816, '18'),
(18, 3, 1, 'hy budie.', 1332587336, '15,16,0,0,0,0,0,0,0,17'),
(19, 3, 1, 'wat r u doing?', 1332587365, '1,12,13,14'),
(20, 1, 1, 'hi there, i m me.', 1334032733, '21,22,26,27,28'),
(21, 1, 1, 'i m thinking about somthing.', 1334258872, '23,24,25'),
(22, 1, 1, 'hi wat is going on?', 1338324683, '30,31,32,33,34,35,36,37,38,39,40'),
(23, 5, 5, 'Hi im, a5u.', 1338326028, '29');
";


/*
-- --------------------------------------------------------

--
-- Table structure for table `wall_post_reply`
--
*/


$q[] = "
CREATE TABLE IF NOT EXISTS `wall_post_reply` (
  `wpr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wpr_content` text,
  `wpr_by_uid` int(10) unsigned DEFAULT NULL,
  `wpr_date` int(10) unsigned DEFAULT NULL,
  `wp_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`wpr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;
";

/*
--
-- Dumping data for table `wall_post_reply`
--
*/


$q[] = "
INSERT INTO `wall_post_reply` (`wpr_id`, `wpr_content`, `wpr_by_uid`, `wpr_date`, `wp_id`) VALUES
(1, 'hi reply', 3, 1333405128, 19),
(2, '', 1, 1333405196, 19),
(3, '', 1, 1333405217, 19),
(4, '', 1, 1333405249, 19),
(5, '', 1, 1333405289, 19),
(6, '', 1, 1333405305, 19),
(7, '', 1, 1333405330, 19),
(8, '', 1, 1333405367, 19),
(9, '', 1, 1333405384, 19),
(10, '', 1, 1333405498, 19),
(11, '', 1, 1333405537, 19),
(12, 'hi reply 12', 1, 1333405556, 19),
(13, 'hi reply 13', 1, 1333405713, 19),
(14, 'hi reply 14', 1, 1333405723, 19),
(15, 'hi reply , ok ok.', 1, 1333486709, 18),
(16, 'hi ok yo.', 1, 1333486748, 18),
(17, 'so sossoosos', 1, 1333487317, 18),
(18, 'ok reply to 17.', 1, 1333561880, 17),
(19, 'reply to 16.', 1, 1333562275, 16),
(20, 'reply 2 to 16.', 1, 1333562303, 16),
(21, 'reply to post nmbr 20.', 1, 1334032751, 20),
(22, 'reply to post nmbr 20.', 1, 1334033642, 20),
(23, 'hi dude, waht are u thinking.', 1, 1334258885, 21),
(24, 'im thinking yar, i m htiniking a lot.', 1, 1334258913, 21),
(25, 'ok buddy, nice thought.', 1, 1334258927, 21),
(26, 'Hi admin, how are u?', 1, 1335852984, 20),
(27, 'hi there admin, wat are u doing?', 3, 1335853393, 20),
(28, 'admin, how are u?', 3, 1335853967, 20),
(29, 'hi a5u, how are u?', 5, 1338326046, 23),
(30, 'hi.', 1, 1338636361, 22),
(31, '', 1, 1339235408, 22),
(32, '', 1, 1339235486, 22),
(33, '', 1, 1339235631, 22),
";

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

?>
