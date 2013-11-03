<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

// QnA main Index
function qna()
{
	global $themedir, $theme, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $qu;
	
	$subPage = ( isset( $_GET['qid'] ) && !empty($_GET['qid']) ? $_GET['qid'] : null );
	
	$subPage = (int) $subPage;
	
	switch ($subPage) {
		
		// If there is a subpage, saying that its a question,
		// then run the function for the question & qid
		// case !0 , is true, when, $subPage is not 0,
		// instead of evaluating !0 as true, 
		// case statement is evaluating, this as,
		// is $subPage == 0 or Not ,when, $subPage is != 0 , then, it will go inside the condition.
		case !0:
			qnaQ();
			break;
			
		// Else default case is show the QnA Main Index
		default:
			qnaMain();
			break;
			
			
	}
	
	
}

function qnaMain()
{
	global $themedir, $theme, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $qu;
	
	
	$theme['name'] = 'qna';
	$theme['call_theme_func'] = 'qna';
	$theme['page_title'] = 'Q n A';
	
	//~loadlang();
	//~fheader('MainBoard');
	
	// type field as enum, having values as, enum(Q, A);
	// can add, and type = Q
	$q = "SELECT * FROM `qna_post` WHERE `parent_id` IS NULL AND `status`=1 LIMIT 10";
	
	$qu = mysql_query($q);
	
}

// The particular question and its answers.
function qnaQ()
{
	global $themedir, $theme, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $qu;
	
	
	$theme['name'] = 'qna';
	$theme['call_theme_func'] = 'qnaQ';
	
	// DANGER! DANGER! DANGER! 
	// Before using it in an SQL query, 
	// Purify this $_GET variable
	$qid = $_GET['qid'];
	$qid = mysql_real_escape_string( $qid );
	
	$qna_post_tablename = 'qna_post';
	
	$qq = "SELECT `title` FROM `$qna_post_tablename` WHERE `id`= $qid";
	$qqu = mysql_query($qq);
	$r = mysql_fetch_assoc($qqu);
	
	mysql_free_result($qqu);
	
	$theme['page_title'] = "$r[title]";
	
	
	// $q = "SELECT * FROM `qna_post` `q` JOIN `qna_post` `a` WHERE `q`.`id` = `a`.`parent_id` AND `q`.`id`= $qid";
	
	
	$q = "
	SELECT * FROM `$qna_post_tablename` WHERE `id` = $qid AND `parent_id` IS NULL 
	UNION ALL 
	SELECT * FROM `$qna_post_tablename` WHERE `parent_id` = $qid";
	/*
	// For the replies
	SELECT child.*
		FROM comments AS parent
			 LEFT JOIN comments AS child 
			 ON child.parent_id = parent.id
	WHERE parent.parent_id = 0 
	AND child.parent_id = 1
	
	*/
	
	$qu = mysql_query($q);
	
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
	
	//printrr($l);
	
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
	
	//printrr( $user );
	//printrr( debug_backtrace() );
	
	// $q = "select * from `topics` where `tid` = $_GET[topic]";
	//$q = "select * from `topics` where `tid` = $_GET[topic] LIMIT 1";
	$q = "select * from `topics` `t` RIGHT JOIN `users` `u` ON `t`.`tcreatedbyuid`=`u`.`uid` WHERE `t`.`tid` = $_GET[topic] LIMIT 1";
	
	$qu[1] = db_query($q);
		
	// to show ip addresses in human readable format
	///while($my = mysql_fetch_assoc($q2_2 ) )
		///printrr( inet_ntop ($my['tcreatedbyuid_IPv4'] ) );
	
	
	
	$q = "SELECT * FROM `replies` WHERE `topic_tid` = $_GET[topic]";
	$qu[2] = db_query($q);
	
	//echo date("g:i a d-F-Y");
	
	
	// input time as (int) in DB, 
	// and when pulling, read it & convert it into date string
	//echo time();
	
	//printrr($_SERVER);
	
	
	
	
}

?>
