<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function sendMessage()
{
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $l;
	global $time;
	global $user;
	global $par;
	global $db;
	
	$theme['name'] = "messages";
	$theme['call_theme_func'] = "sendMessage";
	
	loadlang();
	
	fheader($title = "Send Message");
	
	//$con = array();
	//$con["dbname"] = "myforum_3_testing";
	//dbconn( $con );
	
	if( isset($_POST["sendMess"] ) )
	{
		$mess = array();
		$mess["to"] = check_input( mandff($_POST["to"], "to empty" ) ); 
		$mess["subject"] =  check_input( optff( $_POST["subject"] ) );
		$mess["body"] = check_input( mandff( $_POST["body"], "body empty" ) );
		
		if($errors || $error)
			return false;
		
		$q = "INSERT INTO `pm`(`pm_from_uid`, `pm_deleted_by_sender`, `pm_from_name`, `pm_sent_time`, `pm_subject`, `pm_body`) 
									VALUES('$user[uid]', 0, '$user[username]', '$timeNow', '$mess[subject]', '$mess[body]') ";
		$q1 = db_query($q);
		$id = db_insert_id();
		
		//$q2 = "SELECT `uid`, `username` FROM `users`";
		//$q2 = db_query($q2);
		
		$toArr = array();
		$toArr = explode( ",", $mess["to"] );
		
		$str = "";
		foreach( $toArr as $k => $v )
		{
			$toArr[$k] = $v = trim( $v );
			$str .= "'" . $v . "',";
		}
		
		$str = rtrim($str, ",");
		
		$q2 = "SELECT `uid`, `username` FROM `users` WHERE `username` IN ( $str )";
		$q22 = db_query($q2);
		
		$userGot = array();
		$userNotGot = array();
		
		while( $row = mysql_fetch_assoc($q22) )
		{
			$userGot[$row["uid"]] = $row["username"];
		}
		
		$userNotGot = array();
		$userNotGot  = array_diff( $toArr, $userGot );
		
		if( !empty($userNotGot) )
		{
			$error[] = "Users not done: " . implode(", ", $userNotGot ) . "";
		}
		
		foreach( $userGot as $k => $v )
		{
			$q3 = "INSERT INTO `pm_recepients`(`pm_id`, `pm_sent_to_uid`, `pm_is_read`, `pm_is_new`, `pm_is_deleted`) 
										VALUES('$id', '$k', '0', '1', '0') ";
			$q33 = db_query($q3);
		}
		
	}
	
	
	/*
	 * Profile table 
	 * CREATE TABLE `profile` (
`users_uid` foreign key references users(`uid`) INDEX KEY, 
* `about` ,
* `displaypic_url` ,
`dob` INT default 0, 
`sex` varchar(10) default 'na', 
`perfume` varchar(255) default 'none',
* `website_url`,
`profile_id` INT NOT NULL AUTO INCREMENT,
);

alter table `users` 
add column (
`about` longtext, 
`dob` timestamp,
`sex` char(1), 
`displaypic_url` varchar(255),
`website_url` varchar(255), 
`perfume` varchar(255)
)

*/
	
	
	
	
}


function viewMessage()
{
	
	
	
}


?>
