<?php

//register();


function forgot_password()
{
	global $globals, $mysql, $theme, $done, $error, $errors, $notice;
	global $user;
	global $l, $time;
	global $pdo_dbh;
	global $q, $qu;
	global $show, $done;
	
	$theme['name'] = 'forgot_password';
	$theme['call_theme_func'] = 'forgot_password';
	$theme['page_title'] = 'Forgot Password';
	
	//~loadlang();
	//~fheader($title = 'Forgot Password');
	
	$show = false;
	$done = false;
	
	// is isset $_GET vars, like, em = email, ui=uid, co=code
	// then fire select query on forgot_password table and see, 
	// if all values in the url are equal to the one in the DB,
	// else give invalid request, the link may have been tampered with, 
	// or, if, there are zero rows selected, where user never made a password request
	// pls go here to request new password
	if(isset($_GET['i']) && isset($_GET['u']) && isset($_GET['e']) && isset($_GET['c']) )
	{
		// select from forgot_password table `id` DESC, and if, rows=1, then, set it as new password
		// show password field
		$q1 = "SELECT * FROM `forgot_password` WHERE `id` = '$_GET[i]' AND `uid`=$_GET[u] AND `email`='$_GET[e]' AND `code`='$_GET[c]' LIMIT 1";
		$qq1 = mysql_query($q1);
		
		if( !is_resource($qq1) || mysql_num_rows($qq1) < 1)
		{
			$error['invalid_req'] = $l['invalid_req'];
			return false;
		}
		//printrr($_GET);
		
		if(isset($_POST['sub_register']) && isset($_POST['password']) )
		{
			$show = true;
			$password = mandff( $_POST['password'], $l['pass_req'] );
			// your new password has been set, please go here to login
			
			// if it contains any illegal characters then go in and fill up errors
			if(preg_match('/[^a-zA-Z0-9_]/i', $_POST['password']))
			{
				$l['alphaNumCharsNew'] = str_replace('&munt1;', 'Password', $l['alphaNumChars']);
				$errors[] = $l['alphaNumCharsNew'];
			}
			
			if($error || $errors)
			{
				return false;
			}
			
			// just to use it below
			$row = mysql_fetch_assoc($qq1);
			
			// Password & Salt getting md5()'d 
			$salt = 'abc';
			$password = md5($password.$salt);
			// if everything is fine, take the password, do md5($password), add salt, 
			// and fire the update query on the user table
			$q[2] = "UPDATE `users` SET `password`='$password' WHERE `uid`= '$row[uid]'";
			$qu[2] = mysql_query($q[2]);
			
			if($qu[2])
			{
				// Now 
				// INSERT into logs table, update_time, update_by, page_name, ip, table_name, row_id_of_table, etc etc
				
				$done = true;
				$notice[] = $l['pass_set'] . '<a href="index.php?action=login">'.$l['login'].'</a> here';
				return true;
			}
			// else show error, there was an error while making request (inserting into DB) please try again.
			//else 
			//{
				
			//}
		}
		
		$show = true;
		return true;
		
	}
	
	if(isset($_POST['sub_register']) )
	{
		
		$email = mandff( $_POST['email'], $l['email_req'] );
		if($error || $errors)
		{
			return false;
		}
		
		// special characters, etc not allowed
		// only AlphaNumeric and _ (underscore) charachters allowed
		// if it contains any illegal characters then go in and fill up errors
		if(preg_match('/[^a-zA-Z0-9_\.\@]/i', $_POST['email']))
		{
			$l['alphaNumCharsNew'] = str_replace('&munt1;', 'Email', $l['alphaNumChars']);
			$errors[] = $l['alphaNumCharsNew'];
		}
		
		if($error || $errors)
		{
			return false;
		}
		
		// cleanup of $_POST not happening.
		// now cleanup of POST happening
		$_POST['email'] = check_input($_POST['email']);
		$email = $_POST['email'];
		
		// select if user exists
		// if not then, user does nt exis, u my need to  rgistr, link
		// if exis , mail link, wit em , uid , code
		// wen user cms bck check all 3, if not evn 1, then the link u typed in browser seems to b malformed,
		// pls go here agn and try for password. link to forgot-pass with email id alredy prefeed into link
		$q1 = "SELECT `uid`, `email` FROM `users` WHERE `email` = '$email' LIMIT 1";
		$qq1 = mysql_query($q1);
		
		if(mysql_num_rows($qq1) < 1)
		{
			$error['email_not_exists'] = $l['email_not_exists'];
			return false;
		}
		
		// if num_rows is 1
		if(mysql_num_rows($qq1))
		{
			// that means user is registered and has forgotten pass, so do the whole procedure now
			// add into the forgot_password table
			// add into the to_mail table, for ppl u wanna mail
			$row = mysql_fetch_assoc($qq1);
			$rand= genRandString(6);
			$datetime = round( $time->scriptTime() ) ;
			
			$q[1] = "INSERT INTO `forgot_password`(`uid`, `email`, `code`, `datetime`) VALUES('$row[uid]', '$row[email]', '$rand', $datetime)";
			$qu[1] = mysql_query($q[1]);
			$ins_id = mysql_insert_id();
			
			
			// The link ot insert into the mail_to_sent table as blody of confirmation email
			// Still to write Mailing function sending this link as mail body content
			$link = "<a href=\"$globals[boardurl]$globals[only_ind]action=forgot_password&i=$ins_id&u=$row[uid]&e=$row[email]&c=$rand\">Set New Password</a>";
			echo '<br />' . $link . '<br />';
			
			if($qu[1])
			{
				// send mail and, show confirmation notice that email has been sent, please click the link 
				// in the email, and doer the confirmation, 
				// also you can say that, this link will expire within 6hrs etc
				$notice[] = $l['email_conf'];
				return;
			}
			
		}
		
	}
	
	
}

?>
