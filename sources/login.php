<?php

//if(!defined('F'))
//	die("You are doing the wrong thing son.");

function login()
{
	
	global $globals, $mysql, $theme, $done, $error;
	global $user;
	global $l;
	
	$theme['name'] = 'login';
	$theme['call_theme_func'] = 'login';
	$theme['page_title'] = 'Login';
	
	
	// Y m i not loading langs now?
	// is it because of the ajax framework?
	// i hv stopped loading, the languages folder in lotsa files, i suppose?
	loadlang();
	//~loadlang();
	//~fheader($title = 'Login');
	
	
	if(isset($_POST['sub_register']))
	{
		
		$email = isset( $_POST['email'] ) ? mandff( $_POST['email'], $l['user_email_req']) : null;
		$password = isset($_POST['password']) ? mandff($_POST['password'], $l['pass_req']) : null;
		
		$email = check_input($email);
		$password = check_input($password);
		
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
		//--- commented ---
		// Select only 1 column from email or username
		$q1 = "SELECT * FROM `users` WHERE 
		( 
		( `email` = '$email' OR username = '$email' ) 
		AND 
		`password` = '$password' 
		) ";
		// AND  `password` = '$password'
//		$q1 = "SELECT u.uid, u.username, u.email, u.url, u.group, g.g_name, g.g_priv  
		*/
		
		/*
		$q1 = "SELECT * 
		FROM `users` `u` 
		LEFT JOIN 
		`groups` `g` ON `u`.`group` = `g`.`g_id` 
		WHERE 
		( `u`.`email` = '$email' 
		OR 
		`u`.`username` = '$email' ) AND `u`.`password` = '$password' 
		";
		*/
		
		$q1 = "SELECT * 
		FROM `users` `u`  
		WHERE 
		( `u`.`email` = '$email' 
		OR 
		`u`.`username` = '$email' ) AND `u`.`password` = '$password' 
		";
		
		$qq1 = db_query($q1);
		
		if(mysql_num_rows($qq1) == 1)
		{
			
			$_SESSION['user']['loggedIn'] = 1;
			
			$data = array();
			$data = mysql_fetch_assoc($qq1);
			
			$_SESSION['user']['uid'] = $data['uid'];
			
			/*
			$done = true;
			// if successful login, set sessions, redirect to index.php
			$data = array();
			while( $data = mysql_fetch_assoc($qq1) )
			{
				// set $_SESSION; else set the object $user & its properties
				// $user->setAttributes();
				foreach( $data as $k => $v )
				{
					$_SESSION["user"]["$k"] = $user["$k"] =  $v;
					
					if( $k == "password" || $k == "salt" )
					{
						unset( $_SESSION["user"]["$k"] );
						unset( $user["$k"] );
						unset( $data["$k"] );
					}
					// if $key of $data has been copied into $user,
					// then, we will not require $data, so unloading php baggage 
					// by unsetting and emptying the memory with $data
					if(isset($user["$k"] ) )
						unset( $data["$k"] );
				}
				
			}
			
			*/
			
			/*
			if( $_SERVER['QUERY_STRING'] )
				$qs = $_SERVER['QUERY_STRING'];
			*/
			
			header("Location: index.php?action=wall");
			exit('Redirected');
		}
		else
		{
			$error[] = 'Username/Email not valid';
		}
		
		
	}
	
}

?>
