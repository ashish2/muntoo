<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

// Create, Question or Poll (On an Image, or Post), 
// Insert Number of Options
// Insert Options Values
// Show poll, on that Image/Post etc.

function poll()
{
	
	global $user;
	global $theme;
	global $user, $reqPrivs, $qe, $error, $errors;
	
	//~$theme['folder'] = __FUNCTION__;
	//~$theme['name'] = __FUNCTION__;
	
	$theme['call_theme_func'] = __FUNCTION__;
	$theme['page_title'] = 'Poll';
	
	$uid = $user['uid'];
	
	$AND = 'AND';
	
	$module_table_id = '';
	$module_table_id_str = '';
	if( isset( $_GET['id'] ) && !empty($_GET['id']) )
	{
		$module_table_id = $_GET['id'];
		$module_table_id_str = "$AND `module_table_id` = $module_table_id";
	}
	
	$module_table_name = '';
	$module_table_name_str = '';
	if( isset( $_GET['mod'] ) && !empty($_GET['mod']) )
	{
		$module_table_name= $_GET['mod'];
		$module_table_name_str = "$AND `module_table_name` = $module_table_name";
	}
	
	$query = "SELECT * FROM `poll` WHERE `user_id`= $uid $module_table_id_str $module_table_name_str;";
	
	$qe = db_query($query);
}

// Create Album
function createpoll()
{
	
	global $globals;
	global $user;
	global $theme;
	global $error, $errors, $row, $done, $notice;
	
	
	//~$theme['folder'] = __FUNCTION__;
	//~$theme['lang'] = 'imagegallery';
	//~$theme['name'] = 'imagegallery';
	
	$theme['call_theme_func'] = __FUNCTION__;
	$theme['page_title'] = 'Image Gallery: Create Album';
	
	$uid = $user['uid'];
	
	$done = false;
	
	if(isset( $_POST['submit'] ) && !empty($_POST['submit']))
	{
		
		
		$question = mandff(check_input($_POST['question']), 'Question Empty' );
		$options = array();
		foreach( $_POST['options'] as $k => $v )
			$options[$k] = mandff(check_input($v), 'Options Empty' );
		
		$module_table_id = $_GET['id'];
		$module_table_name= $_GET['mod'];
		
		
		if($error || $errors)
			return false;
		
		$query  = "INSERT INTO `poll` 
			(
			`question`,
			`user_id`,
			`module_table_id`,
			`module_table_name`,
			`date`
			)
			VALUES ( '$question', '$uid', '$module_table_id', '$module_table_name', NOW());
			";
		
		$qe = mysql_query($query);
		
		$mysql_ins_id = null;
		$mysql_ins_id = mysql_insert_id();
		
		if( $mysql_ins_id )
		{
			foreach( $options as $k => $v )
			{
				$query = "INSERT INTO `poll_options` (`poll_id`, `option_key`, `option_text`, `date`) 
				VALUES ( $mysql_ins_id, $k, '$v',  NOW() );";
				$qe = db_query($query);
				
			}
			
			$done = true;
			$notice[] = "Poll created. Please go <a href='$globals[ind]action=poll&subaction=view&pollid=$mysql_ins_id'>here</a> to see the poll.";
		}
		else
		{
			$error[] = "There was some problem while creating the Poll. Please try again later.";
			return false;
		}
		 
	}
	
}

function viewpoll()
{
	global $user;
	global $theme;
	global $error, $errors, $qe, $imageid;
	
	$theme['call_theme_func'] = __FUNCTION__;
	$theme['page_title'] = 'Image Gallery: View Image';
	
	$imageid = ( isset($_GET["imageid"] ) ? (int) check_input( $_GET["imageid"] ) : null );
	
	
	$poll_id = null;
	if ( isset( $_GET['pollid'] ) && !empty( $_GET['pollid']) )
		$poll_id = $_GET['pollid'];
		
	if( !$poll_id )
	{
		$error[] = "No poll id mentioned to show, Please go back and try again.";
		return false;
	}
	
	
	// This query applicable in certain cases,
	// Like when you are coming from poll main page
	//~$query = "SELECT *, SUM( `pv`.`vote` ) 'SUM' FROM  `poll_options`  `po` LEFT JOIN  `poll_votes`  `pv` ON  `pv`.`poll_options_id` =  `po`.`id` WHERE  `po`.`poll_id`= $poll_id GROUP BY  `pv`.`poll_options_id`;";
	
	$query = "SELECT *, SUM( `pv`.`vote` ) 'SUM' FROM `poll` `p` LEFT JOIN `poll_options` `po` ON `p`.`id` = `po`.`poll_id` LEFT JOIN `poll_votes` `pv` ON `pv`.`poll_options_id` = `po`.`id` WHERE `po`.`poll_id`= $poll_id GROUP BY `po`.`option_key`;";
	
	// When coming from an image poll creation, page.
	$qe = db_query($query);
	
}

// Main runs here
// and routes to other pages/functions
function _main()
{
	
	global $theme, $reqPrivs, $error;
	
	
	// Folder not getting used for the moment
	//~$theme['folder'] = __FUNCTION__;
	
	$theme['lang'] = 'poll';
	$theme['name'] = 'poll';
	
	$theme['call_theme_func'] = __FUNCTION__;
	$theme['page_title'] = 'Poll: Main';
	
	$subaction = '';
	$subaction = isset( $_GET['subaction'] ) && !empty($_GET['subaction']) ? $_GET['subaction'] : '';
	
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
		{
			$error[] = "User not logged in. Please login and try again";
			//~redirect("$globals[boardurl]$globals[only_ind]action=login");
			return false;
		}
	
	switch($subaction)
	{
		case 'create':
			// Call createpoll func
			createpoll();
			break;
		
		case 'view':
			// Show poll with module & its id(primary key) image id
			viewpoll();
			break;
		
		default:
			// Else show main function
			poll();
			// maybe break not needed, but still
			break;
		
	}
	
	
}




?>

