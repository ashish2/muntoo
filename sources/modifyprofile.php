<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function modifyprofile()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $l, $row;
	global $time;
	global $user, $reqPrivs;
	
	$theme['name'] = 'modifyprofile';
	$theme['call_theme_func'] = 'modifyprofile';
	$theme['page_title'] = 'Modify Profile';
	
	//  loadlang() is in index.php now
	loadlang();
	//  fheader() is in index.php now
	fheader($title = 'Modify Profile');
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			redirect("$globals[boardurl]$globals[only_ind]action=login");
	
	//printrr( $user);
	//printrr( $reqPrivs );
	
	$uid = (int) ( ( isset($_GET['uid'] ) && !empty($_GET['uid']) ) ? check_input($_GET['uid']) : $user['uid'] );
	// if( $user['g_priv'] & $privs['guest']['g_priv'] )
	// if( $_GET['id'] != $user['uid'] && !($user['uid']) )
	if( ( $uid != $user['uid'] ) && !( (int) $user['g_priv'] & (int) $reqPrivs['edit']['a_priv'] ) )
	{
		$errors['access_denied'] = "Not allowed to access this area.";
		return false;
	}
	
	//echo round ($time->scriptTime() );
	
	if(isset($_POST['modprof'] ) )
	{
		
		/*
		// Creating Variable Names dynamically with the array keys;
		foreach( $_POST as $k => $v )
		{
			"$" .$k = check_input($_POST[$v]);
			"$" . $k  = $v;
			echo "k: " . "$k" . ", ";
		}
		echo "<br />s: " . $sex;
		*/
		
		$url = check_input($_POST['url']);
		$display_name = check_input($_POST['display_name']);
		$about = check_input($_POST['about']);
		$dob = check_input($_POST['dob']);
		$sex = check_input($_POST['sex'] );
		$display_pic_url = check_input($_POST['display_pic_url']);
		$perfume = check_input ( $_POST['perfume'] );
		
		// Base64encode for everything coming from URL
		// Checking input, checking everything coming from $_GET url, 
		// sanitizing it, and casting it into an (int) datatype
		$uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
		
		if($errors)
			return false;
		
		// update users & profile table with new data
		$q[1]  = "UPDATE `users` `u` JOIN `profile` `p` 
			SET 
			`u`.`url`='$url', 
			`p`.`display_name`='$display_name', 
			`p`.`about`='$about', 
			`p`.`dob`='$dob', 
			`p`.`sex`='$sex',
			`p`.`display_pic_url`='$display_pic_url',
			`p`.`perfume`='$perfume' 
			WHERE `u`.`uid`=$uid AND `p`.`users_uid`=$uid";
			
		$qe[1] = db_query($q[1]);
		
		//insert_and_id();
	}
	
	// was taking the $_GET[uid] directly
	// $q = "SELECT * FROM `users` `u` JOIN `profile` `p` ON `u`.`uid`=`p`.`users_uid` WHERE `u`.`uid`= $_GET[uid]";
	// now taking $uid which is either a $_GET['uid'] if it is set, or else it is the set $user[uid]
	$q[2] = "SELECT * FROM `users` `u` JOIN `profile` `p` ON `u`.`uid`=`p`.`users_uid` WHERE `u`.`uid`= $uid";
	$qe[2] = db_query( $q[2] );
	$row = mysql_fetch_assoc($qe[2]) ;
	
	
}


?>
