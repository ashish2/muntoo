<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

// the link of this friends.php will go in the viewProfile() page, or other pages, 
// and users can add other users as friends
function like()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors, $notice;
	global $l;
	global $time;
	global $user;
	global $par;
	global $db;
	
	$theme["name"] = "like";
	$theme["call_theme_func"] = "like";
	
	loadlang();
	
	fheader("Add Friend");
	
	//$con = array();
	//$con["dbname"] = "myforum_3_testing";
	//dbconn( $con );
	//echo round($time->scriptTime() );
	
	$fl = "friends_list";
	
//	if( isset($_REQUEST["uid"]) && empty( $_REQUEST["uid"] ) )
	if( !isset($_REQUEST["uid"]) || empty( $_REQUEST["uid"] ) )
	{
		$error[] = "No Post specified to be liked";
		return false;
	}
	// Only the logged in user will like it.
	$uid = $user['uid'];
	
	// Remove user if he is present in the friends_list
	if( $_GET['action'] == 'like' )
	{
		if( in_array($_REQUEST["uid"], $user["$fl"] ) )
		{
			$user["$fl"] = array_diff($user["$fl"], array($_REQUEST["uid"]));
			$_SESSION['notice'][0] = 'Friend removed';
		}
	}
	
	// or add if user not present in ur friends_list, and if its not u!
	if( $_GET['action'] == 'unlike' )
	{
		if( $user["uid"] != $_REQUEST["uid"] && !(in_array($_REQUEST["uid"], $user["$fl"] ) ) )
		{
			$user["$fl"][] = $_REQUEST["uid"];
			$_SESSION['notice'][1] = 'Friend added';
		}
		// else user exists in friend list, so redirect to previous page
		else
		{
			$_SESSION['notice'][0] = 'Friend already exists';
			// instead of HTTP_REFERER, do history.back(1); , REFERER not really that reliable
			//header( "Location: $_SERVER[HTTP_REFERER]" );
			//header( "Location: $_SERVER[HTTP_REFERER]" );
			header( "Location: index.php?action=viewProfile" );
			//return ;
			exit();
		}
	}
	
	$q1 = "UPDATE `users` SET 
			`$fl`='$user[$fl]' 
			WHERE `uid`=$user[uid]
		";
	
	// remove this below comment, to run db_query()
	$q11 = db_query($q1);
	
	/*
	if( $q11 )
		//notice['frnd_added'] = 'Friend added';
		$_SESSION['notice'][0] = 'Friend removed';
		$_SESSION['notice'][1] = 'Friend added';
	else
		$error['frnd_add_err'] = 'Error while adding friend';
	*/
	
	// redirect to HTTP_REFERER page
	// header("Location: " );
	//header( "Location: $globals[ind]action=board" );
	header( "Location: $_SERVER[HTTP_REFERER]" );
	exit();
	
}


/* All Likes, List, still to do */
function friendsList()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors, $notice;
	global $l;
	global $time;
	global $user;
	global $par;
	global $db, $qu, $show;
	
	$theme["name"] = "friends";
	$theme["call_theme_func"] = "friendsList";
	
	loadlang();
	
	fheader("Friends List");
	
	$fl = 'friends_list';
	
	// getting friendsList of a user
	$uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
	
	$q1 = "SELECT * FROM `users` WHERE `uid` IN ($user[$fl]) ";
	$qu = db_query( $q1 );
	
	if ( is_resource($qu) )
		$show = 1;
	else 
		$notice['no_friends'] = 'No friends to show.';
	
	
}

?>
