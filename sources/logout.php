<?php

if(!defined('F'))
	die("You are doing the wrong thing son.");

function logout()
{
	global $globals, $mysql, $theme, $done, $error;
	global $user;
	global $l;
	
	//$theme['name'] = 'logout';
	//$theme['call_theme_func'] = 'logout';
	
	loadlang();
	
	fheader($title = 'Logout');
	
	if( isset($_GET["action"]) && $_GET["action"] == "logout")
	{
		session_destroy();
//		foreach( $user as $k => $v )
//			unset( $user["$k"] );
//		printrr( $user );
	}
	
	header("Location:index.php");
	
}

?>
