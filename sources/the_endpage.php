<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function the_endpage()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $l;
	global $time;
	global $user;
	
	global $endpage_msg;
	
	$theme['name'] = "the_endpage";
	$theme['call_theme_func'] = "the_endpage";
	
	loadlang();
	
	fheader($title = "the EndPage :P");
	
	
	
}


function viewMessage()
{
	
	
	
}


?>
