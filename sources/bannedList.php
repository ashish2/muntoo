<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function bannedList()
{
	global $themedir, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user, $notice, $reqPrivs;
	global $qu;
	
	$theme['name'] = 'bannedList';
	$theme['call_theme_func'] = 'bannedList';
	
	loadlang();
	
	//printrr( $reqPrivs );
	
	fheader('Banned List');
	
	//if ( $notLogged )
	if ( !userUidSet() )
	{
		$notice['login'] = "Please login <a href='index.php?action=login'>here</a>, you will need to login before proceeding.";
		return false;
	}
	
	$q = "SELECT * FROM `banned` b left join `users` u on b.ban_uid = u.uid";
	
	$qu = mysql_query($q);
	
	
	
}

// passing $uid, either, data will come from the URL, 
// or else, it will come as Function Parameters, not Both.
// Preference given to the url, as it can also be called with CURL.
function ban($userId=null)
{
	global $themedir, $l;
	global $globals, $mysql, $theme, $done, $errors;
	global $user, $notice, $reqPrivs;
	global $qu;
	
	$theme['name'] = 'bannedList';
	$theme['call_theme_func'] = 'ban';
	
	loadlang();
	
	//printrr( $reqPrivs );
	
	fheader('Ban/Unban');
	
	/*
	//if ( $notLogged )
	if ( !userUidSet() )
	{
		$notice['login'] = "Please login <a href='index.php?action=login'>here</a>, you will need to login before proceeding.";
		return false;
	}
	*/
	
	
	// Check this line again, y putting 0 in last?
	// $uid = ( isset($_GET['uid'] ) ? (int) check_input( $_GET['uid'] ) : 0 );
	// For banning, a user[uid] has to be present in the URL, 
	// it its not, then it has to be passed in the function, 
	// still if its not, then take it as null, or just return with an error[user_id_empty]
	$uid = ( isset($_GET['uid'] ) ? (int) check_input( $_GET['uid'] ) : $userId );
	
	if( isset($_GET['action'] ) && $_GET['action'] == 'unban' )
	{
		$q = "DELETE FROM `banned` WHERE `ban_uid`=$uid";
		$qu = mysql_query($q);
		
		if( $qu )
			$notice['unbanned'] = 'User unbanned successfully.';
		else
			$error['unbanning_error'] = 'Error while unbanning the user, please try again.';
		return;
	}
	
	// $q = "SELECT * FROM `banned` b left join `users` u on b.ban_uid = u.uid";
	$q = "SELECT * FROM `banned` WHERE `ban_uid`=$uid";
	$qu = mysql_query($q);
	
	// mysql num rows is zero, so user is not banned, so show ban link & ban him
	// fire an INSERT query
	if ( mysql_num_rows($qu) == 0 )
	{
		$qI1 = "INSERT INTO `banned`(`ban_uid`, `banned`) VALUES($uid, 1)";
		$qI1_e = db_query($qI1);
		
		$qU1 = "UPDATE `users` set `is_banned`=1 WHERE `uid`='$uid'";
		$qU1_e = db_query($qU1);
		
		
		if( $qI1_e && $qU1_e )
			$notice['banned'] = 'User banned successfully!!!';
		else
			$error['cudnt_ban'] = 'Couldn\'t ban the user, please try again.';
	}
	else
	{
		// user already exists in ban list, so show unban link, and unban him
		$notice['banned'] = 'User already exists in ban list!!!';
	}
	
	
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
	
	loadlang($l = 'board');
	
	//$q1 = "SELECT `bname` FROM `board` WHERE `bid` = $_GET[board]";
	$q1 = "SELECT * FROM `board` WHERE `bid` = $_GET[board] LIMIT 1";
	$qu1 = mysql_query($q1);
	$board = mysql_fetch_assoc($qu1);
	
	//printrr($board);
	
	// want to display the title as, General Discussion, 
	// so fetching it from the DB, so made the previous query 
	fheader($board['bname'] );
	
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
	
	loadlang($l = 'board');
	
	//printrr( $user );
	
	//printrr( debug_backtrace() );
	
	$q = "SELECT * FROM `replies` WHERE `topic_tid` = ".$_GET['topic'];
	$qu = mysql_query($q);
	
	
	//echo date("g:i a d-F-Y");
	
	
	// input time as (int) in DB, 
	// and when pulling, read it & convert it into date string
	//echo time();
	
	//printrr($_SERVER);
	
	
	
	
}

?>
