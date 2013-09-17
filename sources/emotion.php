<?php

// Avoiding Directory Travsersal here.
if(!defined('F'))
	die('You are doing the wrong thing son.');

// The link of this friends.php will go in the viewProfile() page, or other pages, 
// and users can add other users as friends
function emotion()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors, $notice;
	global $l;
	global $time;
	global $user;
	global $par;
	global $db;
	
	$theme["name"] = "emotion";
	$theme["call_theme_func"] = "emotion";
	
	loadlang();
	
	fheader("Emotion");
	
	// $_REQUEST will accept, $_GET as well as $_POST
	if( !isset($_REQUEST["post"]) || empty( $_REQUEST["post"] ) )
	{
		$error[] = "No Post specified to be liked";
		return false;
	}
	
	if( !isset( $_SERVER['HTTP_REFERER'] ) )
	{
		$error[] = "Something is just not right here. :-O";
		return false;
	}
	
	// Only the logged in user will like it.
	$uid = $user['uid'];
	$postId = $_REQUEST['post'];
	
	// If it is already liked, and still some user hard codes like in url with his user_id,
	// Give Already liked notice
	if(  $_GET['e'] == 'like' )
	{
		
		// If post(wpwpr_id) present, the user has liked it before
		$q = "SELECT `wpwpr_id` FROM `like` WHERE `users_id` = $uid";
		$qu = db_query($q);
		
		$post_arr = array();
		while( $r = mysql_fetch_assoc($qu) )
			$post_arr[] = $r['wpwpr_id'];
		
		// Remove user if he is present in the friends_list
		if( !in_array( $postId, $post_arr) )
		{
			
			$q = "INSERT INTO `like`  (`users_id`,  `wpwpr_id`)  VALUES($uid, $postId)";
			$qu = db_query($q);
			
			// If $qu successful, then ' successfully liked'
			// Log it in the log_table all about this action committed, page_name , function name, parameters passed, time etc
			if($qu)
				$_SESSION['notice'][0] = "Post: $postId Liked";
			// else, There was a mysql error, log mysql errors into mysql_error table
			else
				$_SESSION['notice'][0] = 'Couldn\'t like the post, Please try again.';
			
		}
		// else u have already liked
		else
			$_SESSION['notice'][0] = 'You have already liked it before.';
		
	}
	
	// or add if user not present in ur friends_list, and if its not u!
	if( $_GET['e'] == 'unlike' )
	{
		
		// If post(wpwpr_id) present, the user has liked it before
		$q = "SELECT `wpwpr_id` FROM `like` WHERE `users_id` = $uid";
		$qu = db_query($q);
		
		$post_arr = array();
		while( $r = mysql_fetch_assoc($qu) )
			$post_arr[] = $r['wpwpr_id'];
		
		// IF it is present in the like array (in_array), only then u can dislike
		if (in_array( $postId, $post_arr ) )
		{
			
			$q = "DELETE FROM `like` WHERE `users_id`=$uid AND `wpwpr_id`=$postId";
			$qu = db_query($q);
			
			// If $qu successful, then ' successfully Unliked'
			// Log it in the log_table all about this action committed, page_name , function name, parameters passed etc
			if($qu)
				$_SESSION['notice'][0] = 'Unliked';
			// else, There was a mysql error, log mysql errors into mysql_error table
			else
				$_SESSION['notice'][0] = 'Couldn\'t unlike the post, Please try again.';
			
		}
		// Else you have unliked it before
		else
			$_SESSION['notice'][0] = 'You have already unliked it before.';
		
		
	}
	
	
	// redirect to HTTP_REFERER page
	// header("Location: " );
	//header( "Location: $globals[ind]action=board" );
	
	
	
	header( "Location: $_SERVER[HTTP_REFERER]" );
	exit();
	
}


/* All Likes, List, still to do */

?>
