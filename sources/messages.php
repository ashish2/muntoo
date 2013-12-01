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
	
	
	$theme['name'] = 'messages';
	$theme['call_theme_func'] = 'sendMessage';
	$theme['page_title'] = 'Send Message';
	
	loadlang();
	//~fheader($title = 'Send Message');
	
	//$con = array();
	//$con['dbname'] = 'myforum_3_testing';
	//dbconn( $con );
	
	//~if( isset($_POST['sendMess'] ) )
	if( isset($_POST['submit'] ) )
	{
		$mess = array();
		$mess['to'] = check_input( mandff($_POST['to'], "$l[to_emp]" ) ); 
		$mess['body'] = check_input( mandff( $_POST['body'], "$l[body_emp]" ) );
		$mess['subject'] =  check_input( optff( $_POST['subject'] ) );
		
		if($errors || $error)
			return false;
		
		$q = "INSERT INTO `pm`(`pm_from_uid`, `pm_deleted_by_sender`, `pm_from_name`, `pm_sent_time`, `pm_subject`, `pm_body`) 
									VALUES('$user[uid]', 0, '$user[username]', NOW(), '$mess[subject]', '$mess[body]') ";
		$q1 = db_query($q);
		$id = db_insert_id();
		
		//$q2 = "SELECT `uid`, `username` FROM `users`";
		//$q2 = db_query($q2);
		
		$toArr = array();
		$toArr = explode( ",", $mess['to'] );
		
		$str = '';
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
			$userGot[$row['uid']] = $row['username'];
		}
		
		$userNotGot = array();
		$userNotGot  = array_diff( $toArr, $userGot );
		
		if( !empty($userNotGot) )
		{
			$error[] = 'Users not done: ' . implode(", ", $userNotGot ) . "";
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
	global $themedir;
	global $globals, $mysql, $theme, $done, $error, $errors, $reqPrivs;
	global $l;
	global $time;
	global $user;
	global $par;
	global $db, $qe;
	
	$theme['name'] = 'messages';
	$theme['call_theme_func'] = 'viewMessage';
	$theme['page_title'] = 'View Message';
	
	loadlang();
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			//~redirect("$globals[boardurl]$globals[only_ind]action=login");
			return false;
		
	// Base64encode for everything coming from URL
	// Checking input, checking everything coming from $_GET url, 
	// sanitizing it, and casting it into an (int) datatype
	$uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
	
	// INBOX
	$q1 = "SELECT * FROM  `pm_recepients`  `pr` RIGHT JOIN  `pm`  `p` ON  `pr`.`pm_id` =  `p`.`pm_id` WHERE  `pr`.`pm_sent_to_uid`= $uid;";
	
	$qe[1] = db_query($q1);
	
	// OUTBOX
	$q2 = "SELECT * FROM `pm` WHERE `pm_from_uid` = $uid";
	
	// This query to include, "PM sent to" as well: This PM was sent to all these recepients
	//~$q2 = "SELECT * FROM  `pm` `p` LEFT JOIN `pm_recepients` `pr`  ON `p`.`pm_id` = `pr`.`pm_id`  WHERE  `p`.`pm_from_uid` = $uid";
	$qe[2] = db_query($q2);
	
	
	
}


?>
