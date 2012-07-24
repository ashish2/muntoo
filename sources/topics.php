<?php


if(!defined('F'))
	die('You are doing the wrong thing son.');


function topics()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	
	
	$theme['name'] = 'board';
	$theme['call_theme_func'] = 'board_theme';
	
	fheader($title = 'Start Board');
	
	$q = "SELECT * FROM `board` ";
	
	$qu = mysql_query($q);
	
	/*
	 * 
	for($i =0; $i = mysql_fetch_assoc($qu); $i++)
	{
		echo 'this: ii: ';
		printrr($i);
	}
	*/
	
	
	printrr($_POST);
	
	if(isset($_POST))
	{
		
		
		
		
	}
	
	
	
}


?>
