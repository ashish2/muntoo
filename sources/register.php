<?php

//register();


function register()
{
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user, $time;
	global $l;
	
	$theme['name'] = 'register';
	$theme['call_theme_func'] = 'register';
	
	loadlang();
	
	fheader('Registration');
	
	if(isset($_POST['sub_register']))
	{
		// special characters, etc not allowed
		// only AlphaNumeric and _ (underscore) charachters allowed
		$username = mandff( $_POST['username'], $l['user_req'] );
		$password = mandff( $_POST['password'], $l['pass_req'] );
		$email = mandff( $_POST['email'], $l['email_req'] );
		$url = $_POST['url'];
		
		$subButton = 'sub_register';
		
		
		//echo preg_match('s!a!A!g', $username);
		//echo preg_match('s#a#A#g', $username);
		//echo preg_match_all('s!a\!A!g', $username, $sub);
		//preg_match_all('/[abc]/', $username, $sub);
		//echo $username;
		//preg_match_all('![ab]!', $username, $sub);
		//printrr($sub);
		
		if($error || $errors)
		{
			return false;
		}
		
		foreach( $_POST as $k => &$v )
		{
			// if difference between $k and 'sub_register' is zero, means they are equal, then dont go inside the condition, as we dont want to purify sub_register value
			// the other keys we want to purify
			if( strcmp($k, $subButton) )
			{
				// purify email
				if($k == 'email')
				{
					if(preg_match('/[^a-zA-Z0-9_\.\@-]/i', $v))
					{
						$l['alphaNumCharsNew'] = str_replace('&munt1;', ucwords($k), $l['alphaNumCharsEmail']);
						$errors[] = $l['alphaNumCharsNew'];
						continue;
					}
				}
				
				// if it contains illegal characters then go in and fill up errors
				// purify url
				if( $k == 'url')
				{
					if(preg_match('/[^a-zA-Z0-9_\.-]/i', $v))
					//if(preg_match('/[^a-zA-Z0-9_\.\@-]/i', $v))
					{
						$l['alphaNumCharsNew'] = str_replace('&munt1;', ucwords($k), $l['alphaNumChars']);
						$errors[] = $l['alphaNumCharsNew'];
					}
					
				}
				
			}
		}
		
		if($error || $errors)
		{
			return false;
		}
		
		// cleanup of $_POST not happening.
		// now cleanup of POST happening
		foreach( $_POST as $k => &$v )
		{
			// if difference between $k and 'sub_register' is zero, means they are equal, then dont go in
			if( strcmp($k, $subButton) )
			{
				$v = check_input($v);
			}
		}
		
		/*
			// This is wrong, Post variable were getting cleared but, instead, previous $username, $email etc were passed
			$username = $username;
			$password = $password;
			$email = $email;
			$url = $url;
		*/
		
		// This is right, clear POST variables and pass those clean variables
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$url = $_POST['url'];
		
		$salt = 'abc';
		// by default the level of user & privileges are minimum, level=1
		$group = 1;
		
		// Password & Salt getting md5()'d 
		$password = md5($password.$salt);
		
		$q1 = "SELECT `email` FROM `users` WHERE `email` = '$email'";
		$qq1 = mysql_query($q1);
		
		if(is_resource($qq1))
		{
			if(mysql_num_rows($qq1) > 0)
			{
				$error['email_exists'] = $l['email_exists'];
				return false;
			}
		}
		
		
		$now = round( $time->scriptTime() ) ;
		
		// $q = "INSERT INTO `users`(`username`, `password`, `email`, `url`, `salt`) VALUES('$username', '$password', '$email', '$url', '$salt') ";
		$q[1] = "INSERT INTO `users`(`username`, `password`, `email`, `url`, `salt`, `group`, `regTime`) VALUES('$username', '$password', '$email', '$url', '$salt', '$group', $now)";
		$qu[1] = mysql_query($q[1]);
		// Logging mysql errors after first insert
		if(!$qu[1])
		{
			
			$id = log_mysql_error($q[1]);
			$errors[] = "Some errors encountered, check table for errors. Error id #$id (Please save this Error id)";
			
			//echo mysql_error();
			
			// for the moment(ftm) returning false as errors encountered, though this is not the ideal thing to do, 
			// as we want to complete the script and log other errors as well
			return false;
		}
		else
		{
			$done = true;
		}
		
		//$ins_id = mysql_insert_id($qu[1]);
		$ins_id = mysql_insert_id();
		//echo "ins_id = " . $ins_id;
		
		// an insert id goes in here, which becomes the user[uid]
		$q[2] = "INSERT INTO `profile` (`users_uid`) VALUES('$ins_id')";
		$qu[2] = mysql_query($q[2]);
		// Log mysql error for query 2
		if(!$qu[2])
		{
			$id = log_mysql_error($q[2]);
			$errors[] = "Some errors encountered, check table for errors. Error id #$id (Please save this Error id)";
		}
		else
		{
			$done = true;
		}
		
		// By default a user with same id getting created in ai_actions_taken table but i(AV) 
		// dont think this is necessary, as no actions have been taken against the user yet, just check this
		$q[3] = "INSERT INTO `ai_actions_taken` (`users_uid`) VALUES('$ins_id')";
		$qu[3] = mysql_query($q[3]);
		// Log mysql error for query 3
		if(!$qu[3])
		{
			$id = log_mysql_error($q[3]);
			$errors[] = "Some errors encountered, check table for errors. Error id #$id (Please save this Error id)";
		}
		else
		{
			$done = true;
		}
		
		
	}
	
	
}

?>
