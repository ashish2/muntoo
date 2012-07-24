<?php

//register();


function register()
{
	global $globals, $mysql, $theme, $done, $error;
	global $user;
	global $l;
	
	$theme['name'] = 'register';
	$theme['call_theme_func'] = 'register';
	
	loadlang();
	
	fheader($title = 'Registration');
	
	if(isset($_POST['sub_register']))
	{
		// special characters, etc not allowed
		// only AlphaNumeric and _ (underscore) charachters allowed
		$username = mandff( $_POST['username'], $l['user_req'] );
		$password = mandff( $_POST['password'], $l['pass_req'] );
		$email = mandff( $_POST['email'], $l['email_req'] );
		$url = $_POST['url'];
		
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
		
		$username = $username;
		$password = $password;
		$email = $email;
		$url = $url;
		
		$salt = 'abc';
		// by default the level of user & privileges are minimum, level=1
		$group = 1;
		
		// Password & Salt getting md5()'d 
		$password = md5($password.$salt);
		
		$q1 = "SELECT `email` FROM `users` WHERE `email` = '$email'";
		$qq1 = mysql_query($q1);
		
		if(mysql_num_rows($qq1) > 0)
		{
			$error['email_exists'] = $l['email_exists'];
			return false;
		}
		
		// $q = "INSERT INTO `users`(`username`, `password`, `email`, `url`, `salt`) VALUES('$username', '$password', '$email', '$url', '$salt') ";
		$q[1] = "INSERT INTO `users`(`username`, `password`, `email`, `url`, `salt`, `group`) VALUES('$username', '$password', '$email', '$url', '$salt', '$group')";
		$qu[1] = mysql_query($q[1]);
		
		//$ins_id = mysql_insert_id($qu[1]);
		$ins_id = mysql_insert_id();
		//echo "ins_id = " . $ins_id;
		
		// an insert id goes in here, which becomes the user[uid]
		$q[2] = "INSERT INTO `profile` (`users_uid`) VALUES('$ins_id')";
		$qu[2] = mysql_query($q[2]);
		
		$q[3] = "INSERT INTO `ai_actions_taken` (`users_uid`) VALUES('$ins_id')";
		$qu[3] = mysql_query($q[3]);
		
		
		if($qu[1])
		{
			$done = true;
		}
		else
		{
			$errors = 'faltugiri';
		}
		
	}
	
	

	
	
}

?>
