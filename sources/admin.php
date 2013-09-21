<?php


if(!defined('F'))
	die('You are doing the wrong thing son.');

	
function adminMain()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $errors;
	global $l;
	global $time;
	global $user;
	global $q;
	global $reqPrivs;
	
	$theme['name'] = 'admin';
	$theme['call_theme_func'] = 'adminMain';
	$theme['page_title'] = 'Admin Section';
	
	$theme['langfile'] = 'admin';
	
	//~loadlang('admin');
	//~fheader($title = 'Admin Section');
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			redirect("$globals[boardurl]$globals[only_ind]action=login");
		
	//printrr( $user );
	//echo 1;
	//printrr( $reqPrivs );
	
	
	//if( !($user['priv'] & $reqPrivs['priv'] ) || $user['level'] != $reqPrivs['level'] )
	if( isset($user['g_name']) && $user['g_name'] != 'administrator' )
	{
		$errors['permission_denied'] = $l['permission_denied'];
		return false;
	}
	
	/*
	if( isset($_GET['area'] ) )
	{
		switch $_GET['area']
		{
			case: 
		}
		
	}
	
	*/
	
	
}


?>
