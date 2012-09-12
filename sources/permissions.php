<?php

if(!defined('F'))
	die("You are doing the wrong thing son.");

function permissions()
{
	
	global $globals, $mysql, $theme, $done, $error;
	global $user;
	global $l;
	
	$theme['name'] = 'permissions';
	$theme['call_theme_func'] = 'permissions';
	
	loadlang();
	
	//fheader($title = 'Permissions');
	fheader('Permissions');
	
	include "$globals[rootdir]".'/classes/User.php';
	
	//$actions = array( 'view', 'edit', 'publish', 'delete' );
	//$users = array( 'a1u', 'a2u', 'a3u', 'a4u' );
	
	$action = ( isset( $_GET['action'] ) && in_array( $_GET['action'], $actions ) ) ? $_GET['action'] : 'view';
	$user = ( isset( $_GET['user'] ) && in_array( $_GET['user'], $users) ) ? $_GET['user'] : 'a1u';
	
	
	$q1 = "SELECT `groups`.`priv`, `groups`.`name` FROM `users` 
	JOIN 
	`groups` ON `users`.`group` = `groups`.`id` 
	WHERE `users`.`uname` = '%s' 
	'LIMIT 1'
	";
	
	$qq1 = db_query( sprintf ($q1, $user ) );
	
	if( !$qq1) 
		error_reporting( 'Cud not select from DB' ); 
	
	$temp = mysql_fetch_object( $qq1 );
	
	$userClass = new User();
	$userClass->setGroup( $temp->name );
	$userClass->setPriv( $temp->priv );
	
	$q1 = "SELECT `priv` FROM `actions` WHERE `name` = '%s' ";
	
	$qq1 = db_query( sprintf( $q1, $action) );
	
	if( !$qq1 )
		error_reporting( 'Cud not select frm DB' );
	
	$temp = mysql_fetch_object( $qq1 );
	
	
	
}

function permissions_test()
{
	
	//fheader('Permissions');
	
	$u = 7; // 00000111
	$n = 1; // 00000001
	
	//$d = $u & $n;
	//$d = $u | $n;
	$d = $u ^ $n;
	
	echo "d: " . $d;
	
	
}

?>
