<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function the_whatpage()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $l;
	global $time;
	global $user;
	
	global $endpage_msg;
	
	$theme['name'] = "the_whatpage";
	$theme['call_theme_func'] = "the_whatpage";
	
	loadlang();
	
	fheader($title = "the WhatPage :P");
	
	
	
}


function viewMessage()
{
	
	
	
}


?>
