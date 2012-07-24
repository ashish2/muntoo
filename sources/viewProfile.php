<?php


if(!defined('F'))
	die('You are doing the wrong thing son.');

function viewProfile()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $errors, $notice;
	global $l;
	global $time;
	global $user, $reqPrivs;
	global $q, $qu;
	
	$theme['name'] = 'viewProfile';
	$theme['call_theme_func'] = 'viewProfile';
	
	loadlang();
	
	// fheader($title = 'View Profile');
	fheader("View Profile");
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			redirect("$globals[boardurl]$globals[only_ind]action=login");
		
	// Base64encode for everything coming from URL
	// Checking input, checking everything coming from $_GET url, 
	// sanitizing it, and casting it into an (int) datatype
	$uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
	
	// Add if $user['uid'] != $_GET['uid'] , then, see if he is Admin or Editor
	// Else, Not allowed to access this area, permission denied & return false
	// ---Permission stuff here---
	
	
	// or probably uid=$_GET[id] to see other's profile
	// $q  = "SELECT * FROM `users` `u` RIGHT JOIN `profile` `p` ON u.uid=p.users_uid WHERE `users_uid`=$uid";
	// Working
	// $q  = "SELECT * FROM `users` `u` RIGHT JOIN `profile` `p` ON u.uid=p.users_uid WHERE `u`.`uid`=$uid";
	
	$qu = array();
	
	// $q  = "SELECT * FROM `users` `u` RIGHT JOIN `profile` `p` ON `u`.`uid`=`p`.`users_uid` JOIN `banned` `b` on `u`.`uid`=`b`.`ban_uid` WHERE `u`.`uid`=$uid";
	$q1  = "SELECT * FROM `users` `u` RIGHT JOIN `profile` `p` ON `u`.`uid`=`p`.`users_uid` WHERE `u`.`uid`=$uid";
	// JOIN `banned` `b` on `u`.`uid`=`b`.`ban_uid`
	$qu[1] = db_query($q1);
	
	$q2 = "SELECT * FROM `banned` `b` WHERE  `ban_uid`=$uid";
	$qu[2] = db_query($q2);
	
	
}


?>
