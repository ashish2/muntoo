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
	
	fheader($title = 'Permissions');
	
	if( isset( $_POST['sub_register'] ) )
	{
		
		$email = mandff( $_POST['email'], $l['user_email_req'] );
		$password = mandff( $_POST['password'], $l['pass_req'] );
		
		if($error)
		{
			return false;
		}
		
		// cleanup of $_POST not happening.
		// now cleanup of POST happening
		foreach( $_POST as $k => $v )
		{
			$v = check_input($v);
		}
		
		$email = $email;
		$password = $password;
		
		$salt = 'abc';
		
		// Password & Salt getting md5()'d 
		$password = md5($password.$salt);
		
		/*
		 * Select only 1 column from email or username
		$q1 = "SELECT * FROM `users` WHERE 
		( 
		( `email` = '$email' OR username = '$email' ) 
		AND 
		`password` = '$password' 
		) ";
		*/
		$q1 = "SELECT * FROM `users` WHERE 
		`email` = '$email' AND `password` = '$password' 
		OR 
		username = '$email' AND `password` = '$password' 
		";
		
		$qq1 = db_query($q1);
		
		if(mysql_num_rows($qq1) > 0)
		{
			$done = true;
			// if successful login, redirect to index.php
			header("Location: index.php");
		}
		else
		{
			$error[] = 'Username/Email not valid';
		}
		
		
		
	}
	
	

	
	
}

?>
