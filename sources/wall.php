<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

//hanmannlahel();

function wall()
{
	global $themedir, $theme, $l;
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user, $time;
	global $qu, $reqPrivs;
	
	$theme['name'] = 'wall';
	$theme['call_theme_func'] = 'wall';
	
	// 	echo ( $qu == 0 ) ? "yes" : "no" ? "under" : "not";
	loadlang(); 
	fheader('Wall');
	
	// Base64encode for everything coming from URL
	// Checking input, checking everything coming from $_GET url, 
	// sanitizing it, and casting it into an (int) datatype
	// $uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
	
	// if get uid set, see if user has permission to view this profile, if yes then allow, else error, no permission
	if( isset($_GET['uid']) )
	{
		// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
		// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
		// so redirect him to login page
		// if( $reqPrivs['board']['loginReq'] )
			if( !userUidSet() )
				redirect("$globals[boardurl]$globals[only_ind]action=login");
				
			// if( $user['perms'] & $reqPrivs['view']['a_priv'] )
			if( $user['g_priv'] & $reqPrivs['view']['a_priv'] )
				$uid = $_GET['uid'];
			else
			{
				$error['perms_denied'] = 'No permission to view this page.';
				return false;
			}
		
	}
	// if !$_GET['uid'] set, but $user[uid] set that means user logged in, show his own profile
	else if( isset($user['uid']) )
	{
		$uid = $user['uid'];
	}
	// else ask him to login
	else
	{
		// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
		// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
		// so redirect him to login page
		// if( $reqPrivs['board']['loginReq'] )
			if( !userUidSet() )
				redirect("$globals[boardurl]$globals[only_ind]action=login");
	}
	
	//if( isset($_POST['wall_sub']) && !empty($_POST['post'] ) )
	if( isset($_POST['wall_sub']) )
	{
		
		$reply = mandff(check_input( $_POST['post'] ), 'Wall Post Empty' );
		
		if(empty($error) && empty($errors))
		{
			$now = round( $time->scriptTime() ) ;
			
			/*
			$qI = "INSERT INTO wall_post(`wp_on_uid`, `wp_by_uid`, `wp_post`, `wp_date`) 
			VALUES ( $_GET[uid], $user[uid], '$reply', $now )";
			*/
			$qI = "INSERT INTO wall_post(`wp_on_uid`, `wp_by_uid`, `wp_post`, `wp_date`) 
			VALUES ( $uid, $user[uid], '$reply', $now )";
			$qI_e = db_query($qI);
		}
		
	}
	
	// $_GET[uid] below signifies, that on whose wall all the post are getting made
	//$q = "SELECT * FROM `wall_post` `wp` JOIN `users` `u` ON `wp`.`wp_by_uid` = `u`.`uid` WHERE `wp`.`wp_on_uid`='$_GET[uid]' ORDER BY `wp`.`wp_date` DESC";
	$q = "SELECT * FROM `wall_post` `wp` JOIN `users` `u` ON `wp`.`wp_by_uid` = `u`.`uid` WHERE `wp`.`wp_on_uid`='$uid' ORDER BY `wp`.`wp_date` DESC";
	$qu = db_query($q);
	
	//mail("vickyojha2@yahoo.com", "Hi Ashish", "Message for u buddy");
	// printrr( $GLOBALS );
	// printrr( $_SESSION );
	
}

/*
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
	
	fheader("Topic Replies to $_GET[topic]");
	
	//printrr( $user );
	//printrr( debug_backtrace() );
	
	//
	//$q2 = "select * from `topics` where `board_bid` = 2";
	//$q2_2 = db_query($q2);
		
	// to show ip addresses in human readable format
	///while($my = mysql_fetch_assoc($q2_2 ) )
		///printrr( inet_ntop ($my['tcreatedbyuid_IPv4'] ) );
	//
	
	$q = "SELECT * FROM `replies` WHERE `topic_tid` = ".$_GET["topic"];
	$qu = mysql_query($q);
	
	
	//echo date("g:i a d-F-Y");
	
	
	// input time as (int) in DB, 
	// and when pulling, read it & convert it into date string
	//echo time();
	
	//printrr($_SERVER);
	
	
	
	
}

*/

?>
