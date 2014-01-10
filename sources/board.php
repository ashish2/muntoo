<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function board()
{
	global $themedir, $theme, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $qu;
	
	$theme['name'] = 'board';
	$theme['call_theme_func'] = 'board';
	$theme['page_title'] = 'MainBoard';
	
	//~loadlang();
	//~fheader('MainBoard');
	
	// $q = "SELECT * FROM `board`";
	$q = "SELECT * FROM `board` `b` JOIN `users` `u` WHERE `b`.`bcreatedbyuid`=`u`.`uid`";
	
	$qu = mysql_query($q);
	
	// printrr( $GLOBALS );
	// printrr( $_SESSION );
	
	
}


function topics()
{
	global $themedir, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $qu; 
	global $board;
	
	$theme['name'] = 'board';
	$theme['call_theme_func'] = 'topics';
	$theme['page_title'] = 'Logout';
	
	
	// why should assignment like this, $l = 'board' , create a problem
	// $l = 'board' , is actually creating unpredictable behaviour
	///loadlang($l = 'board');
	// bcoz $l is a global, and its an array containing other stuff from language files.
	$theme['langdir'] = 'board';
	//~loadlang('board');
	
	//$q1 = "SELECT `bname` FROM `board` WHERE `bid` = $_GET[board]";
	$q1 = "SELECT * FROM `board` WHERE `bid` = $_GET[board] LIMIT 1";
	$qu1 = mysql_query($q1);
	$board = mysql_fetch_assoc($qu1);
	//printrr($board);
	
	// want to display the title as, General Discussion, 
	// so fetching it from the DB, so made the previous query 
	//~fheader($board['bname'] );
	$theme['page_title'] = $board['bname'];
	
	
	// actual query to get users
	$q = "SELECT * FROM `topics` WHERE `board_bid` = '$_GET[board]' ";
	// $q = "SELECT * FROM `topics` WHERE `board_bid` = '$_GET[board]'";
	// echo $q;
	// firing another mysql_query, bcoz, 
	// otherwise, mysql_fetch_array takes up 1st row of the query.
	// firing query to be used in theme page
	$qu = mysql_query($q);
	
	// Add new thing $board, 
	// which will have the details of Board
	
	
	// Make query for all the threads in the Board
	// with pagination,
	// and all these details will go in $board
	
	
	
}

function topicReplies()
{
	global $themedir, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $qu; 
	global $board;
	
	$theme['name'] = 'board';
	$theme['call_theme_func'] = 'topicReplies';
	$theme['page_title'] = 'Topic Replies to '. $_GET['topic'];
	$theme['langfile'] = 'board';
	
	// This is creating some funny problem of $l first character being something else
	// as $l is an array, & then we are then assigning $l as a string 'board'
	//loadlang($l = 'board');
	//~loadlang('board');
	//~fheader("Topic Replies to $_GET[topic]");
	
	//~printrr( $user );
	//printrr( debug_backtrace() );
	
	// $q = "select * from `topics` where `tid` = $_GET[topic]";
	//$q = "select * from `topics` where `tid` = $_GET[topic] LIMIT 1";
	//~$q = "SELECT * from `topics` `t` RIGHT JOIN `users` `u` ON `t`.`tcreatedbyuid`=`u`.`uid` WHERE `t`.`tid` = $_GET[topic] LIMIT 1";
	$q = "SELECT * from `topics` `t` RIGHT JOIN `users` `u` ON `t`.`tcreatedbyuid`=`u`.`uid` WHERE `t`.`tid` = $_GET[topic]";
	$qu[1] = db_query($q);
	
	// to show ip addresses in human readable format
	///while($my = mysql_fetch_assoc($q2_2 ) )
		///printrr( inet_ntop ($my['tcreatedbyuid_IPv4'] ) );
	
	
	
	//~$q = "SELECT * FROM `replies` WHERE `topic_tid` = $_GET[topic]";
	$q = "SELECT * FROM `replies` `r` 
		LEFT JOIN `users` `u` ON  `u`.`uid` = `r`.`poster_users_uid`
		WHERE `r`.`topic_tid` = $_GET[topic]
	";
	
	$qu[2] = db_query($q);
	
	//echo date("g:i a d-F-Y");
	
	
	// input time as (int) in DB, 
	// and when pulling, read it & convert it into date string
	//echo time();
	
	//printrr($_SERVER);
	
	
	
	
}

?>
