<?php

// if not defined

//modifyprofile_theme();

function the_whatpage_theme()
{
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user, $privs, $row;
	global $q, $q1;
	
	global $endpage_msg;
	
	error_handler($errors);
	//error_handler($endpage_msg);
	error_handler($endpage_msg);
	
	if( !userLoggedIn() )
		return false;
	
	if( !empty($errors) || !empty( $endpage_msg) )
	{
		return false;
	}
	
	//printrr( $user['g_priv'] );
	
	// CHecking Permissions
	//if( !allowedTo() )
		//return false;
	
	//printrr( $user );
	//printrr( $privs );
	//printrr( $row );
	
	
	//echo 1 & 5;
	
	//if( ( 1 & 5 ) == 5 )  echo "oh";
	
	//echo $user['g_priv'] . " " ;
	//echo $privs['editor']['g_priv'];
	/*
	if( $user['g_priv'] != $privs['editor']['g_priv'] )
//	if( $user['g_priv'] & $privs['guest']['g_priv'] )
	{
		$error['access_denied'] = "Not allowed to access this area.";
		return false;
	}
	* */
	
	//if( $_GET['id']  != $user['uid'] || $user['uid'] != 1 )
	{
//		isAllowedTo();
	}
	
	echo '<center>';
	
	echo '<h1>What?</h1>';
	echo '<h2>Which page is this, huh?</h2>';
	echo '<h3>Which page did you want, hunh!!!</h3>';
	echo '<h3>Redirecting you to the index page, lol :P :)</h3>';
	//echo '<h3>Awrite Cowboy, redirecting you to the index page, :P lol :)</h3>';
	
	echo '</center>';
	
}


?>
