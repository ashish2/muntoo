<?php

// if not defined


function wall_theme()
{
	global $globals, $mysql, $theme, $done, $error, $errors, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user;
	global $board, $replies;
	global $qu;
	
	//error_handler($error);
	error_handler($errors);
	$str = '';
	$str .= '<!-- #content starts -->
		<div id="content">
			<!-- #form starts -->
			<div id="form" class="form_div">
				<form method="post" action="">
					<p>
						<span valign="center">
							'.$l['thoughts'] .'
						</span>
						<span>
							<textarea name="post" rows="3" cols="70" placeholder="I thought a thought..."></textarea>
						</span>
					<input type="submit" name="wall_sub" value="Post">
					</p>
				</form>
			</div>
			<!-- #form ends -->
	';
	
	// getting $uid
	$uid = ( isset($_GET['uid'] ) ? (int) check_input( $_GET['uid'] ) : $user['uid'] );
	
	if( mysql_num_rows($qu) > 0)
	{
		$str .= '
		<!-- #post starts -->
		<div id="post" border=".5" width="90%">
			';
			
			/*
			<span id="disp_table">By </span>
			<span id="disp_table" width="60%" valign="middle" align="center">'.$l['post'].'</span>
			<span id="disp_table" width="20%">'.$l['date'].'</span>
			*/
			
		// http://localhost/www/forums/myForum/3/index.php?action=addReply&topic=1
		// echo date("g:i a d-F-Y", time() );
		
		while( $i = mysql_fetch_assoc($qu) )
		{
			$st = '';
			
			if( !empty($i['wpr_id'] ) )
			{
				//$q11 = "SELECT * from `wall_post_reply` WHERE `wpr_id` IN ($i[wpr_id])";
				$q11 = "SELECT * from `wall_post_reply` `wpr` JOIN `users` `u` ON `wpr`.`wpr_by_uid`=`u`.`uid` WHERE `wpr_id` IN ($i[wpr_id])";
				$res = db_query($q11);
				
				/*
				$st .= '<span id="replies"><ul>';
				while( $row = mysql_fetch_assoc($res) )
				{
					$st .= "<li style='decoration: none;'>(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]</li>";
					//$st .= "<br /><br />(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]";
				}
				$st .= '</ul></span>';
				*/
				
				/*
				// Working
				$st .= '<span id="replies">';
				while( $row = mysql_fetch_assoc($res) )
				{
					$st .= "<span id='wpr_reps' style='decoration: none;'>(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]</span><br />";
					//$st .= "<br /><br />(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]";
				}
				$st .= '</span>';
				
				*/
				
				$st .= '<article id="replies">';
				while( $row = mysql_fetch_assoc($res) )
				{
					$st .= "<span id='wpr_reps' style='decoration: none;'>(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]</span><br />";
					//$st .= "<br /><br />(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]";
				}
				$st .= '</article>';
				
			}
			
			/*
			$str .= '
				<span>
					<span valign="top"><a href='.$globals['ind'].'action=viewProfile&uid='.$i['uid'].'>'.$i['username'].'</a></span>
					<span>'.$i['wp_post'].'
					<a href="'.$globals['ind'].'action=addReply&uid='.$uid.'&post='.$i['wp_id'].'">'.$l['add_rep'].'</a>
					'.$st.'
					</span>
					
					<span>'.date("g:i a d-F-Y", $i['wp_date'] ).'
					</span>
				</span>
				';
				*/
				
			$str .= '
				<section>
					<span  id="by" style="float: left" valign="top">
					<a href='.$globals['ind'].'action=viewProfile&uid='.$i['uid'].'>'.$i['username'].'</a>
					&nbsp;
					</span>
					<span id="post" style="float: left">'.$i['wp_post'].'
					<a href="'.$globals['ind'].'action=addReply&uid='.$uid.'&post='.$i['wp_id'].'">'.$l['add_rep'].'</a>
					<br />
					'.$st.'
					</span>
					<span id="date" style="float: right">
					&nbsp;
						'.date("g:i a d-F-Y", $i['wp_date'] ).'
					</span>
				<br class="clear">
				</section>
				';
		}
		$str .= '
			</div>
			<!-- #post ends -->
			
		</div>
		<!-- #content ends -->
			';
			
	}
	else
	{
		$str .= '
		<div id="content">
			<center><b>'.
				$l['wall_emp_msg']
				.'</b>
		</div>
		<!-- #content ends -->
		';
	}
	
	echo $str;
	$str = null;
	
	
}



function topics_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user;
	global $board, $replies;
	global $qu;
	global $board;
	
	echo '
		<a href="'.$globals['ind'].'action=createTopic&board='.$_GET['board'].'">Create Topic</a>
		
		';
	
	echbr(2);
	
	echo '
		<table border="1" width="90%">
			<tr>
				<td>Topic id</td>
				<td>Topic Name </td>
				<td>Started By </td>
				<td>Created On </td>
				<td>Last Post </td>
			</tr>
			';
			
	for( ; $i = mysql_fetch_assoc($qu); )
	{
		//printrr($i);
		
		echo '
			<tr>
				<td>
					'.$i['tid'].'
				</td>
				<td> 
					<a href="'.$globals['ind'].'action=topic&topic='.$i['tid'].'">'.$i['tname'].'</a><br /> <small>'.$i['tdesc']. '</small>
				</td>
				<td>
					<a href="'.$globals['ind'].'action=viewProfile&id='.$i['tcreatedbyuid'].'">'.$i['tcreatedby'].'</a>
				</td>
				<td>
					'.$i['tdate'].'
				</td>
			</tr>
			';
			
	}
			
			
			
	echo '
		</table>
	';
	
	
}

function topicReplies_theme()
{
	
	global $user;
	global $board, $replies;
	global $qu;
	global $board;
	
	
	echo '<a href="index.php?action=addReply&topic='.$_GET['topic'].'">add reply</a>';
	
	echbr(2);
	
	echo '
		<table border="1" width="90%">
			<tr>
				<td>Reply No.</td>
				<td>Subject </td>
				<td> Body </td>
				<td>Date </td>
				<td>User Ip </td>
			</tr>
			';
	
	// echo date("g:i a d-F-Y", time() );
	
	while( $i = mysql_fetch_assoc($qu) )
	{
		echo '
			<tr>
				<td>'.$i['rid'].'</td>
				<td>'.$i['rsubject'].'</td>
				<td>(if we hav permision only then show, no-eidting button)<p align="right">edit</p>' . $i['rbody'].'</td>
				<td>'.date("g:i a d-F-Y", $i['date'] ).'</td>
				<td>'.$i['user_ip'].'</td>
			</tr>
			';
	}
	
	
	echo '
		</table>
		';
	
	
}

?>
