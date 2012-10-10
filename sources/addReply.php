<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

function createTopic()
{
	global $themedir, $l;
	global $globals, $mysql, $theme, $done, $errors, $error;
	global $user, $notice;
	global $qu; 
	global $board;
	global $time, $reqPrivs;
	
	$theme['name'] = 'addReply';
	$theme['call_theme_func'] = 'createTopic';
	
	//loadlang("createTopic");
	//loadlang(__FUNCTION__);
	loadlang('allFuncLang', __FUNCTION__);
	
	fheader($title = 'Create Topic' );
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			redirect("$globals[boardurl]$globals[only_ind]action=login");
	
	// Will have to see 
	// how reply table works in SMF
	// replies table takes
	// topic id replied to
	// id of user
	// log IP of user
	// time/date (microtime() , less than 5(or other, variable factor) seconds, 
	// post cant be made by same IP) that made the post 
	// 
	
		/*
		echo 111;
		printrr( $user);
		exit();
		*/
		
	if(isset($_POST["reply_sub"]) )
	{
		
		$tname = mandff(check_input($_POST["subject"] ), "Subject Empty");
		$tdesc = optff(check_input($_POST["desc"] ) );
		//$reply = mandff(check_input($_POST["reply"] ) , "Reply field empty");
		
		
		// into binary
		$pton =  inet_pton($user['ip']);
		//$pton = inet_pton( $user['REMOTE_ADDR'] );
		
		$t = round($time->scriptTime() );
		
		$ipField = ( isset($user['ipv6'] ) ) ? 'tcreatedbyuid_IPv6' : 'tcreatedbyuid_IPv4';
		
		$q1 = "INSERT INTO `topics` (`tname`, `tdesc`, `tdate`, `tcreatedby`, `tcreatedbyuid`, `$ipField`, `board_bid`) 
		VALUES( '$tname', '$tdesc', $t, '$user[username]', '$user[uid]', '$pton', '$_GET[board]' )";
		
		$q1_1 = db_query($q1);
		$tid = mysql_insert_id();
		
		{
			// Lets do the AI
			// if()
			{
				
			}
			//
		}
		
		if( $q1_1 && $tid )
			$notice['topic_created'] = "Topic created, please go <a href='index.php?action=topic&topic=$tid'>here</a>, and check out your topic.";
		else
			$error['topic_not_created'] = 'Unable to create topic, please try again.';
		
		//header("Location: index.php?action=board&board={$_GET['board']}");
		
	}
	
	
}


function addReply()
{
	
	global $globals, $mysql, $theme, $done, $errors, $error, $notice, $db;
	global $themedir, $l, $user;
	global $qu, $board;
	global $time, $reqPrivs;
	global $row;
	global $ai;
	
	$theme['name'] = 'addReply';
	$theme['call_theme_func'] = 'addReply';
	
	//loadlang();
	loadlang('allFunc', __FUNCTION__);
	
	fheader($title = 'Add Reply');
	
	// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
	// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
	// so redirect him to login page
	if( $reqPrivs['board']['loginReq'] )
		if( !userUidSet() )
			redirect("$globals[boardurl]$globals[only_ind]action=login");
	
	// Will have to see 
	// how reply table works in SMF
	// replies table takes
	// topic id replied to
	// id of user
	// log IP of user
	// time/date (microtime() , less than 5(or other, variable factor) seconds, post cant be made by same IP) that post made
	// 
	
	// if not isset $_GET[post], that means it is not a createTopic, it only an addReply
	// if isset $_GET[post], that means it is a createTopic event
	if( !isset($_GET['post'] ) )
	{
		// adding limit 1, as the topic will always be only 1
		$q = "SELECT * FROM `topics` WHERE `tid` = $_GET[topic] LIMIT 1";
		$qu[0] = db_query($q);
		$row = mysql_fetch_assoc($qu[0]);
		$q = null;
	}
	
	if(isset($_POST['reply_sub']) && !empty($_POST['reply']) )
	{
		
		$subject = '';
		if( !isset($_GET['post'] ) )
		{
			$subject = trim(mandff(check_input($_POST["subject"] ), "Subject Empty") );
		}
		$reply = trim(mandff(check_input($_POST["reply"] ) , "Reply field empty") );
		
		//echo "reply: ";
		//printrr($reply);
		
		
		//ai
		/*
		// the AI(ai) object from the AI_Execute class
		if( $ai &&  is_object($ai ) )
		{
			// CHECKING FOR SPAM WORDS (Some AI Foo)
			// $ai execute class for spam words in reply
			if ($ai->spam_words($reply) ) // if true, then log the activity into the AI_Logs table, for reason "is_spam" & userid & username, date(unix epoch) etc 
			{
				// corresponds to the ai_logs table, logggin the ai activity
				// sending user uid, reason like cause, effect or action etc, type: spam_words, any_definition and time
				ai_logs($users['uid'], $reason, $type, $definition, $time );
				
				// now select the, number of times, logs present in the ai_logs table,
				// check the severity, that becomes the severity,
				// now goto, the effects table & see what corresponds to is_spam with given severity.
				// now goto the Action table for that reason with given severity, 
				// and see which action is listed, 
				// include the file, take the action
				
				// passing $_POST[reply]
				print_r($ai->spam_words_e($reply) );
				
			}
			
		}
		*/
		// the AI(ai) object from the AI_Execute class
		if( $ai &&  is_object($ai ) )
		{
			// CHECKING FOR SPAM WORDS (Some AI Foo)
			// $ai execute class for spam words in reply
			$ai->spam_words_e($reply);
			
		}
		
		//ai-
		
		/*
		$arr = array(
						"keys" => array( "rbody", "topic_id", "poster_users_id", "date", "user_ip") , 
						"values" => array( 
												array( "$reply", "$_GET[topic]", "$user[uid]", round( $time->scriptTime() ), "$_SERVER[REMOTE_ADDR]"
														)
													)
							);
		*/
		
		$t = round( $time->scriptTime() );
		
		// -> insert_arr($arr);
		
		
		// if, its a reply to a topic
		// if( !isset( $_GET['post'] ) )
		if( isset( $_GET['topic'] ) )
		{
			
			// for the moment just putting $_SERVER[REMOTE_ADDR] in the query, 
			// instead of $user[REMOTE_ADDR]
			$q1I = "INSERT INTO `replies`(
			`rsubject`, `rbody`, `topic_tid`, `poster_users_uid`, `date`, `user_ip`
			) 
			VALUES( 
			'$subject', '$reply', $_GET[topic], $user[uid], $t, '$_SERVER[REMOTE_ADDR]' 
			)";
			
			$q1E = db_query($q1I);
			$id = mysql_insert_id();
		}
		// else, that means its, a reply to a wall post, if( isset($_GET['post']) ), its a wall post reply
		else
		{
			
			// temporary this line of $user[uid], remove it later
			// $user['uid'] = 1;
			
			// 
			$q1I = "INSERT INTO `wall_post_reply`(
			`wpr_content`, `wpr_by_uid`, `wpr_date`, `wp_id`
			) 
			VALUES(
			'$reply', $user[uid], $t, $_GET[post]
			)";
			
			// These 2 lines  of code is also written above in the 
			// if condition, so this is code repetition, 
			// though i cud have just written the 2 lines of code only once, 
			// and written the below 2 procedures $qS2 & $qU1, 
			// in another if condition corresponding to this else condition
			// as in, if( isset( $_GET[post]) ), but then, that wud have meant, 
			// an if() condition check for every time the script gets executed, 
			// for not repeting 2 lines of code(for saving 2 lines of space)
			// it seemed a bad trade-of
			// whereas in this case, though 2 lines will be extra, 
			// but, 2 times if condition checking will be saved, 
			// only once it will check, in this if() condition block, 
			// and decide what to do
			$q1E = db_query($q1I);
			$id = mysql_insert_id();
			
			// First select all ids from wall_post table
			// then execute this select query, then 
			// Run Update query on the the wall post id, with 
			// the new wall_post_reply id that you received by inserting 
			// new reply
			$qS2 = "SELECT * from `wall_post` WHERE `wp_id`=$_GET[post]";
			$res = db_query( $qS2);
			$row = mysql_fetch_assoc( $res);
			
			// Dont need  this line, the 2 lines below it lines will suffice
			// $string = ( empty( $row['wpr_id'] ) ? $id :  ( $row['wpr_id'] . "," . $id ) );
			$string = $row['wpr_id'] . "," . $id;
			$string = trim($string, ',');
			
			$qU1 = "UPDATE `wall_post` set `wpr_id`='$string' WHERE `wp_id`=$_GET[post]";
			$res2 = db_query($qU1);
			
		}
		
		
//		header("Location: ");
//		header("Location:{$globals['boardurl']}{$globals['ind']}action=topic&topic={$_GET['topic']}");
//		header("Location: index.php?action=topic&topic={$_GET['topic']}");
		
		if( is_bool( $q1E) )
		{
			if( isset($_GET['topic']) )
				$notice['success'] = "Muaah :x, Reply posted successfully. You can go <a href='$globals[ind]action=topic&topic=$_GET[topic]'>HERE</a> to check your reply.";
				//$notice['success'] = $l['success_topic'];
			else // $_GET['post'] is set
				$notice['success'] = "Muaah :x, Reply posted successfully. You can go <a href='$globals[ind]action=wall&uid=$_GET[uid]&post=$_GET[post]'>HERE</a> to check your post.";
				//$notice['success'] = $l['success_wall'];
		}
		else
			$error['no_success'] = "Could not post the reply.";
			//$error['no_success'] = $l['no_success'];
			
	}
	
	
	
}

function editReply()
{
	
	
}

?>
