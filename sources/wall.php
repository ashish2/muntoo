<?php

if(!defined('F'))
	die('You are doing the wrong thing son.');

//hanmannlahel();

function wall()
{
	
	global $themedir, $theme, $l;
	global $globals, $mysql, $theme, $done, $error, $errors, $notice;
	global $user, $time;
	global $reqPrivs;
	global $imgFolder;
	// The array carrying the data
	global $posts, $post_reps, $likes;
	global $admin;
	
	$theme['name'] = 'wall';
	$theme['call_theme_func'] = 'wall';
	$theme['page_title'] = 'Wall';
	
	//~loadlang(); 
	//~fheader('Wall');
	
	// Base64encode for everything coming from URL
	// Checking input, checking everything coming from $_GET url, 
	// sanitizing it, and casting it into an (int) datatype
	//~$uid = ( isset($_GET["uid"] ) ? (int) check_input( $_GET["uid"] ) : $user["uid"] );
	
	// if get uid set, see if user has permission to view this profile, if yes then allow, else error, no permission
	if( isset($_GET['uid']) )
	{
		// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
		// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
		// so redirect him to login page
		// if( $reqPrivs['board']['loginReq'] )
			if( !userUidSet() )
			{
				// Removing Redirects as they were causing header to be seen twice when loaded with ajax.
				//~redirect("$globals[boardurl]$globals[only_ind]action=login");
				// Putting return false, instead, as we are now working with ajax
				return false;
				exit('Redirected');
			}
			// if( $user['perms'] & $reqPrivs['view']['a_priv'] )
			if( $user['g_priv'] & $reqPrivs['view']['a_priv'] )
				$uid = $_GET['uid'];
			else
			{
				$error['perms_denied'] = 'No permission to view this page.';
				return false;
			}
		
	}
	// if !$_GET['uid'] set, but $user[uid] set that means user logged in, show his own profile
	else if( isset($user['uid']) )
	{
		$uid = $user['uid'];
	}
	// else ask him to login
	else
	{
		// if NOT logged in, then redirect to "index.php?action=login" , ONLY for the moment
		// if from Admin Board Settings table, loginReq column is 1, then, login is required to view
		// so redirect him to login page
		// if( $reqPrivs['board']['loginReq'] )
			if( !userUidSet() )
			{
				// Removing Redirects as they were causing header to be seen twice when loaded with ajax.
				//~redirect("$globals[boardurl]$globals[only_ind]action=login");
				// Putting return false, instead, as we are now working with ajax
				return false;
				//exit('Redirected');
			}
	}
	
	//if( isset($_POST['wall_sub']) && !empty($_POST['post'] ) )
	if( isset($_POST['wall_sub']) )
	{
		
		$reply = mandff(check_input( $_POST['post'] ), 'Wall Post Empty' );
		// type =1 as it is a Wall Post so, type=1
		$type = 1;
		// FTM, status = Active.
		$status = 1;
		
		if(empty($error) && empty($errors))
		{
			$now = round( $time->scriptTime() ) ;
			
			// Ori
			// $qI = "INSERT INTO wall_post(`wp_on_uid`, `wp_by_uid`, `wp_post`, `wp_date`) VALUES ( $uid, $user[uid], '$reply', $now )";
			// New Table wpwpr
			$qI = "INSERT INTO wall_posts_wall_post_replies(`on_uid`, `by_uid`, `post`, `date`, `type`, `status`) VALUES ( $uid, $user[uid], '$reply', $now, $type, $status )";
			$qI_e = db_query($qI);
		}
		
	}
	
	// Ori
	//$q = "SELECT * FROM `wall_post` `wp` JOIN `users` `u` ON `wp`.`wp_by_uid` = `u`.`uid` WHERE `wp`.`wp_on_uid`='$uid' AND `wp`.`deleted` != 1  ORDER BY `wp`.`wp_date` DESC";
	
	//$q = "SELECT `wp`.`wp_id`,  `wp`.`wp_on_uid`, `wp`.`wp_by_uid`, `wp`.`wp_post`, `wp`.`wp_date` , `u`.`uid`, `u`.`username` FROM `wall_post` `wp` JOIN `users` `u` ON `wp`.`wp_by_uid` = `u`.`uid` WHERE `wp`.`wp_on_uid`='$uid' AND `wp`.`deleted` != 1  ORDER BY `wp`.`wp_date` DESC";
	
	/* This Wrong 
	$q = "
		SELECT  `wpwpr1`.`id` ,  `wpwpr1`.`on_uid` ,  `wpwpr1`.`by_uid` ,  `wpwpr1`.`post` ,  `wpwpr1`.`date` ,  `u`.`uid` ,  `u`.`username` 
		FROM  `wall_posts_wall_post_replies`  `wpwpr1` 
		INNER JOIN  `wall_posts_wall_post_replies`  `wpwpr2` ON  `wpwpr1`.`id` =  `wpwpr2`.`post_id` 
		LEFT JOIN  `users`  `u` ON  `wpwpr1`.`by_uid` =  `u`.`uid` 
		WHERE  `wpwpr1`.`on_uid` = $uid
		AND  `wpwpr1`.`status` = 1
		ORDER BY  `wpwpr1`.`date` DESC";
	*/
	
	// FTM, status = active. Posts & Replies which are Active.
	$status = 1;
	
	/* Slight change, This Right */
	$q = "
	SELECT  `wpwpr1`.`id` `id1` ,  `wpwpr1`.`on_uid` ,  `wpwpr1`.`by_uid` `by_uid1` , IFNULL(  `wpwpr1`.`post` , null ) `post1` ,  `wpwpr1`.`type` ,  `wpwpr2`.`id` `id2` , `wpwpr1`.`by_uid` `by_uid2`, IFNULL(  `wpwpr2`.`post` , null ) `post2` ,  `wpwpr2`.`type` ,  `wpwpr1`.`date` `date1` ,  `wpwpr2`.`date` `date2`,  `u`.`uid` , `u`.`username`, `u`.`is_online`
	FROM  `wall_posts_wall_post_replies`  `wpwpr1` 
	LEFT JOIN  `wall_posts_wall_post_replies`  `wpwpr2` ON  `wpwpr2`.`post_id` =  `wpwpr1`.`id` 
	LEFT JOIN  `users` `u` ON  `u`.`uid` =  `wpwpr1`.`by_uid` 
	WHERE  `wpwpr1`.`on_uid` = $uid
	AND  `wpwpr1`.`status` = $status
	ORDER BY  `wpwpr1`.`date` DESC 
	";
	
	$posts = array();
	if( isset($admin['settings']['cache']['switch']) && $admin['settings']['cache']['switch'] == 1)
	{
		$c1m = md5($q);
		// Initiating cache
		$c1 = new Cache($c1m);
		
		if ( $c1->exProcGet() )
		{
			$posts = (array) $c1->contents;
		}
	}
	else
	{
		$qu = db_query($q);
		while($row = mysql_fetch_assoc($qu))
		{
			$posts[$row['id1']][] = $row;
		}
	}
	
	// Write the results as json string in cache file
	if( isset($admin['settings']['cache']['switch']) && $admin['settings']['cache']['switch'] == 1)
		$c1->exProcWrite($posts);
	
	// To get Likes, May have to add Status field, where status = 1 (active)
	/*
	$q = "SELECT  `wpwpr`.`id` ,  `l`.`users_id` 
	FROM  `wall_posts_wall_post_replies`  `wpwpr` 
	JOIN  `like`  `l`  
	WHERE  `l`.`wpwpr_id` =  `wpwpr`.`id` 
	AND  `wpwpr`.`on_uid` = $uid";
	*/
	
	$q = "SELECT  `wpwpr`.`id` ,  `l`.`users_id` 
	FROM  `wall_posts_wall_post_replies`  `wpwpr` 
	JOIN  `like`  `l`  
	WHERE  `l`.`wpwpr_id` =  `wpwpr`.`id`";
	
	$likes = array();
	
	$c2m = md5($q);
	$c2 = new Cache( $c2m);
	if ( $c2->exProcGet() )
	{
		$likes = (array) $c2->contents;
	}
	else
	{
		$qu = db_query($q);
		while ($lik = mysql_fetch_assoc($qu) )
			$likes[$lik['id']][] = $lik['users_id'];
	}
	
	// Write the results as json string in cache file
	if( isset($admin['settings']['cache']['switch']) && $admin['settings']['cache']['switch'] == 1)
		$c2->exProcWrite($likes);
	
	// This Query, To get wall_post_replies
	// After the first above query, to get wall_post
	// Just fire this one query to get all related wall post replies, 
	// then take it in array,
	// then try to match arrays
	/*
	SELECT * FROM `wall_post` `wp` , `wp_wpr` `ww` , `wall_post_reply` `wpr`
	WHERE
	`ww`.`wp_id` = `wp`.`wp_id` 
	AND
	`ww`.`wpr_id` = `wpr`.`wpr_id`
	AND 
	 `wp`.`wp_on_uid` = 3;
	* 
	* 
	* This with INNER JOINS can also be used
	* select s.name as Student, c.name as Course 
		from student s
		inner join bridge b on s.id = b.sid
		inner join course c on b.cid  = c.id 
		order by s.name 
		* 
	* */
	// `users`.`uid`,
	// AND `users`.`uid` = `wpr`.`wpr_by_uid`
	//~$q = "
	//~SELECT  `wp`.`wp_id` ,  `wpr`.`wpr_id` ,  `wpr`.`wpr_content` ,  `wpr`.`wpr_by_uid` ,  `wpr`.`wpr_date` ,`u`.`username`
	//~FROM  `wall_post`  `wp` ,  `wp_wpr`  `ww` ,  `wall_post_reply`  `wpr` ,  `users`  `u` 
	//~WHERE  `ww`.`wp_id` =  `wp`.`wp_id` 
	//~AND  `ww`.`wpr_id` =  `wpr`.`wpr_id` 
	//~AND  `u`.`uid` =  `wpr`.`wpr_by_uid` 
	//~AND  `wp`.`wp_on_uid` = $uid
	//~";
	//~$qu = db_query($q);
	//~$post_reps = array();
	//~while($row = mysql_fetch_assoc($qu))
	//~{
		//~$post_reps[$row['wp_id']][] = $row;
	//~}
	
	
}

?>
