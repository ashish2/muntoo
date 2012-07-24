<?php


if(!defined('F'))
	die('You are doing the wrong thing son.');

// lists, paginated
// boards
// groups
// members
// 

function listUsers()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $errors;
	global $l;
	global $time;
	global $user, $reqPrivs;
	global $q;
	
	$theme['name'] = 'list';
	$theme['call_theme_func'] = 'listUsers';
	
	loadlang();
	
	// fheader($title = 'View Profile');
	fheader("List Users");
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			redirect("$globals[boardurl]$globals[only_ind]action=login");
		
	// Base64encode for everything coming from URL
	// Checking input, checking everything coming from $_GET url, 
	// sanitizing it, and casting it into an (int) datatype
	//$uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
	
	// Add if $user['uid'] != $_GET['uid'] , then, see if he is Admin or Editor
	// Else, Not allowed to access this area, permission denied & return false
	// ---Permission stuff here---
	
	
	// or probably uid=$_GET[id] to see other's profile
	// $q  = "SELECT * FROM `users` `u` RIGHT JOIN `profile` `p` ON u.uid=p.users_uid WHERE `users_uid`=$uid";
	//$q  = "SELECT * FROM `users` `u` RIGHT JOIN `profile` `p` ON u.uid=p.users_uid WHERE `u`.`uid`=$uid";
	$q  = "SELECT * FROM `users`";
	$q = db_query($q);
	
	
	
}


?>
