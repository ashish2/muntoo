<?php
session_start();

// Define a Constant to use later
define('F', 1, true);

// Setting magic quotes off
if( function_exists('set_magic_quotes_runtime') )
{
	@set_magic_quotes_runtime(0);
}

// -1 is report all PHP errors
error_reporting(-1);
//error_reporting(1);
//error_reporting(1);
//error_reporting(E_ALL);

// if config.php file does not exists, check if DB exists
///if(!file_exists('config.php') && !db_select(DB_NAME) )
////if(!file_exists('config.php') )
if(!file_exists('config.php') )
{
	// AI: search for config.php.bak whether its present in this directory
	// if it is, then make it config, else search for config.php in this & sub-directories, 
	// else see if u can dynamically create another config, if u can, create it, 
	// else go to header install.php
	// searchForFile('.config.php.bak', './', 0);
	if( file_exists('.config.php.bak') )
	{
		// there may be different errors while copying, like, 
		// permissions error, check for the errors, what are those errors, 
		// and try to fix those errors if u can, and then try the 'copy' again.
		if(!copy('.config.php.bak', 'config.php') )
		{
			
			// pass array to write with a filename, string to write, time, etc, 
			// and probably a format in which to write the array into the file
			// $format is array consist of, 
			// so convert array into probably, 's_s': string with spaces, 
			// or, write each array element as 'nl' newLine etc.
			// Write a procedure instead for errorLogging()
			// check the filesize(), if greater than 5MB, then, 
			// change error filename with todays timestamp, 
			// else log errors in that file.
			// write a errorLoggingProc() function (errorLoggingProcedure function)
			// which will be in the Procedure.php file, which normally will have 
			// all the procedures, which are called frequently, 
			// Procedure functions will in turn will have different algos 
			// doing the job for it.
			// Code Still To be Done
			//#// errorLoggingProc($array, $format); // errorLoggingProcedure() func.
			//#// errorLogging($array, $format);
			
			header('Location: install.php');
			exit();
		}
	}
	else
	{
		header('Location: install.php');
		exit();
		
	}
}

// Including the major required files
include_once('config.php'); 
include_once($rootdir . '/functions/func.php');

// Setting default timezone
date_default_timezone_set('Europe/London');

// start time
$time = new Script_Timer;
$time->timer_start();

// ob_start
ob_start();

// DBCONN
include_once($rootdir . '/functions/dbconn.php');

// connecting db
dbconn();

// call the DB for user

// Permissions

//printrr( $_SESSION["uid"] );

//echo "$globals[only_ind]action=login " ;

//echo "$boardurl/";
//exit();

//$user['logged'] = 0;
// No need to check for SESSION[uid], 
// bcoz its a forum, & we are allowing guest to view & browse 
// it as well, 
// check for this, only on pages u dont want to allow guest to browse.
//if( !$_SESSION["uid"] )
if( !isset($user['uid'] ) )
{
	$user['notLogged'] = 1;
//	header("Location: $globals[only_ind]action=login");
//	header("Location: $boardurl$globals[only_ind]action=login");
}


// printrr( $_SESSION );

// cant be echoing errors here, put it in the default files' corresponding theme file
/*
if(!empty($error))
{
	echo '<br >';
	echo 'Index, Errors: ';
	printrr($error);
}
*/

// Setting some Defaults
setSomeDefaults();
// a few things that can be used in the setSomeDefaults function, or else,
// supposed to be used from the select query for user from DB
// REMOVE IT LATER, bcoz u have to take this values from DB
$user['ip'] = $_SERVER['REMOTE_ADDR'];


//$_SESSION['user']['loggedIn'] = 1;
// if user has logged in from login page successfully, then call the function to set the $user array
if( isset( $_SESSION['user']['loggedIn'] ) && $_SESSION['user']['loggedIn'] )
{
	fillUserArr();
}


// printrr( $user );

/*
function nn()
{
	return ~11;
}
$nn = nn();
echo $nn;
exit;
*/


// loading some Required Permissions & Privileges
$reqPrivs = array();
$reqPrivs = loadPrivsFromActionsTable();

// Adding some more to the reqPrivs array
// whether login is required to see Board, no or yes, 0 or 1
$reqPrivs['board']['loginReq'] = 1;


//printrr( $reqPrivs );
//printrr( $user );
//exit();

// Required privileges
//$required = array();


// including header and footer and navigation bar themes
include_once($rootdir . '/hnf.php');

// fheader($title = 'Mainboard');
// fnav();

// Start dynamically loading some stuff
// if admin['settings']['ai'] = 1, then load ai
if($admin['settings']['ai'])
{
	include $funcdir.'/ai.php';
	$ai = new AI_Execute;
}

call_user_func( main() );

function main()
{
	
	global $globals, $sourcedir;
	
	// get all the Permissions/Privileges of the User now
	global $user;
	// make the select query for all the permissions based on user_id
	// $user["priv"] = loadUserPrivileges();
	// if ( $_SESSION["uid"] ) then Load user
	// $user = loadUser();
	
	global $endpage_msg;
	
	
	$php = '.php';
	echbr(1);
	
	
	
	if( isset( $user['is_banned']) && $user['is_banned'] && $_GET['action'] != 'logout')
	{
		// get this reason from database, the endpage table reasons
		// for the moment hard coding it.
		$endpage_msg['reason'] = 'Wow dude, u have been banned!!!';
		include_once($sourcedir . "/the_endpage".$php);
		return "the_endpage";
	}
	
	
	// printrr( $user );
	
	/*
	// simple logout, can simply use this to logout, 
	// instead of adding the logout in the action array, etc.
	if( isset($_GET["action"]) && $_GET["action"] == "logout")
	{
		foreach( $user as $k => $v)
			unset( $user["$k"] );
			
		//session_destroy();
		header("Location:index.php");
	}
	*/
	
	if(isset($_GET["action"]))
	{
		// ?action=actionname is array of page.php to be included 
		// and func to be run
		// so, board => array('pageName', 'funcName') 
		// so, board => array('board', 'topics') 
		// ?action="board" in url, will result in, board.php included, & topics() function runs
		$actionarr = array(
			// "ACTION" => array("PAGE", "FUNC")
			"addFriend" => array( "friends", "addOrDelFriend" ),
			"addReply" => array("addReply", "addReply" ),
			"admin" => array("admin", "adminMain" ),
			"ban" => array("bannedList", "ban"),
			"bannedList" => array("bannedList", "bannedList"),
			"board" => array("board", "topics"),
			"createTopic" => array("addReply", "createTopic"),
			"friendsList" => array("friends", "friendsList"),
			"listUsers" => array("list", "listUsers" ),
			"login" => array("login", "login"),
			"logout" => array("logout", "logout"),
			"mainBoard" => array("board", "board"),
			"messages" => array("messages", "sendMessage" ),
			"modifyprofile" => array("modifyprofile", "modifyprofile"),
//			"permissions" => array("permissions", "permissions" ),
			"permissions" => array("permissions", "permissions_test" ),
			"register" => array("register", "register"),
			"topic" => array("board", "topicReplies"),
			"unban" => array("bannedList", "ban"),
			"unFriend" => array( "friends", "addOrDelFriend" ),
			"viewProfile" => array("viewProfile", "viewProfile"),
			"wall" => array( "wall", "wall" ),
		
		
		// /opt/lampp/htdocs/www/forums/myForum/3/sources/register.php
		// /opt/lampp/htdocs/www/forums/myForum/3/sources/login.php
		);
		
	}
	/*
	else if(isset($_GET['board']))
	{
		include_once($sourcedir . '/display.php');
		return 'board';
		
	}
	*/
	else 
	{
		/*
		$actionarr = array
		(
			'' => array('board.php', 'board')
		);
		*/
		
		include_once($sourcedir . "/board".$php);
		return "board";
		
		
//		return 'nothing';
		
	}
	
	if( isset($_GET['action']) && !@$actionarr[$_REQUEST['action']] )
	{
		// We can also goto the "What" page, What? Which page is this, huh??? Which page did u want, hunh?!!!
		// Redirecting u to the index page. Smarty! :)
		include_once($sourcedir . "/the_whatpage".$php);
		return "the_whatpage";
	}
	
	
	include_once($sourcedir . '/' . $actionarr[$_REQUEST['action']][0] . $php);
	return $actionarr[$_REQUEST['action']][1];
	
}
// func main ends

// Calling the Navigation bar
fnav();
echbr(3);

if(isset($theme['name']))
{
	include_once($globals['themedir'].'/'.$user['theme_type'].'/'.$theme['name'].'_theme.php');
}
else
{
	//call default theme
}

if(isset($theme['call_theme_func']))
{
	$theme_func = $theme['call_theme_func'] . '_theme';
	call_user_func($theme_func);
	//call_user_func($theme['call_theme_func']);
}
else
{
	//call some default theme func
}

//printrr(get_included_files() );

echbr(3);

// stop time
$time->timer_stop();

ffooter($time->time_elapsed(6));

// Put session_destroy later
// session_destroy();

// echo "<br />all cook: <br />";
// printrr( $_COOKIE );
// printrr( $_SERVER);
// exit();
// printrr( get_included_files() );


?>
