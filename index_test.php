<?php
session_start();

define('F', 1, true);

if(!file_exists('config.php'))
{
	header('Location: install.php');
}

/*
echo 'Welcome to the index page!!!';
echo ' Congratulations!!! You have completed one 
of the most important parts of your software, The Installation!!!';
echo '<br /><br />';
*/

// Including the major required files
include_once('config.php');
include_once($rootdir . '/functions/func.php');
include_once($rootdir . '/functions/dbconn.php');

// TESTING

printrr(session_id());

echo '<a href="/index2.php">index2</a>';

// TESTING


// connecting to db
dbconn();

// globals
// global $globals, $error, $l;

// cant be echoing errors here
if(!empty($error))
{
	echo '<br >';
	echo 'Index, Errors: ';
	printrr($error);
}

// including header and footer and navigation bar themes
include_once($rootdir . '/hnf.php');

/*
if(isset($_GET['action']))
{
	fheader($title = ucfirst($_GET['action']));	
}
else
{
	fheader($title = 'MainBoard');	
}
*/

// fheader($title = 'Mainboard');
// fnav();

call_user_func(main());

function nothing()
{
	return 'do nothing';
}

function main()
{
	global $sourcedir;
	
	echo '<br />';
	
	
	if(isset($_GET['action']))
	{
		// ?action=actionname is array of page.php to be included and func to be run
		$actionarr = array(
			'board' => array('board.php', 'board'),
			'modifyprofile' => array('modifyprofile.php', 'modifyprofile'),
			'register' => array('register.php', 'register'),
		
		
		
		
		);
	
	}
	else if(isset($_GET['board']))
	{
		include_once($sourcedir . '/display.php');
		return 'board';		
				
	}
	else 
	{
		/*
		$actionarr = array
		(
			'' => array('board.php', 'board')
		);
		*/
		include_once($sourcedir . '/display.php');
		return 'display';
		
		
//		return 'nothing';
		
	}
	
	include_once($sourcedir . '/' . $actionarr[$_REQUEST['action']][0]);
	return $actionarr[$_REQUEST['action']][1];
	
}
// func main ends

// Calling the Nav  bar
fnav();
echo '<br /><br /><br />';


if(isset($theme['name']))
{
	// lets keep for the moment, user selected lang as 'en' as default
	$user['selected_lang'] = 'en';
	include_once($globals['themedir'] . '/'.$user['selected_lang'].'/'.$theme['name'].'_theme.php');
	
}
else
{
	//call default theme	
}

if(isset($theme['call_theme_func']))
{
	call_user_func($theme['call_theme_func']);
}
else
{
	//call some default theme func
}


echo '<br /><br /><br />';

ffooter();

// Put session_destroy later
// session_destroy();

?>
