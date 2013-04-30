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
	
	
	if($error)
	{
		//$err_img = '<span class="error_span">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
		//echo $err_img;
		error_handler($error);
	}
	// you dont have to pass an imgname everytime this way,
	// just have an error_span class, and in css u have the error_span class background-image
	//error_handler($error, 'error-icon.png');
	
	
	$str = '';
	
	/*
	$str .= '
		<center>
			<form method="post" action="">
				<table>
					<tr>
						<td valign="center">
							'.$l['thoughts'].'
						</td>
						<td>
							<textarea name="post" rows="3" cols="70"></textarea>
						</td>
					</tr>
				</table>
				<br />
				<input type="submit" name="wall_sub" class="mun-button-default" value="Post">
			</form>
			<br />
		</center>
			';
	*/
	
	$str .= '
		<center>
			<!-- #form starts -->
			<div id="form" class="form_div">
				<form method="post" action="">
					<p>
						<span valign="top" align="top">
							'.$l['thoughts'] .'
						</span>
						<span>
							<textarea id="post1" name="post" rows="3" cols="70" dir="ltr" placeholder="I thought a thought..."></textarea>
						</span>
						<br />
						<br />
					<input type="submit" name="wall_sub" class="mun-button-default" value="Post">
					</p>
				</form>
			</div>
			<br />
			<!-- #form ends -->
		</center>
	';
	
	if( mysql_num_rows($qu) > 0)
	{
		$str .= '
		<center>
			<table class="disp_table" id="disp_table" width="90%">
				<thead>
					<tr>
						<th class="dt-header">By</th>
						<th class="dt-header" width="60%" valign="middle" align="center">'.$l['post'].'</th>
						<th class="dt-header" width="20%">'.$l['date'].'</th>
						<th class="dt-header" width="5%">
						<input type="checkbox" id="select_all" onclick="sel_all_chk_box(\'#select_all\', \'wp_posts[]\')">
							Select All
						</th>
					</tr>
				</thead>
				';
		
		// http://localhost/www/forums/myForum/3/index.php?action=addReply&topic=1
		// echo date("g:i a d-F-Y", time() );
		
		// getting $uid
		$uid = ( isset($_GET['uid'] ) ? (int) check_input( $_GET['uid'] ) : $user['uid'] );
		
		while( $i = mysql_fetch_assoc($qu) )
		{
			$st = '';
			
			
			if( !empty($i['wpr_id'] ) )
			{
//				$q11 = "SELECT * from `wall_post_reply` WHERE `wpr_id` IN ($i[wpr_id])";
				$q11 = "SELECT * from `wall_post_reply` `wpr` JOIN `users` `u` ON `wpr`.`wpr_by_uid`=`u`.`uid` WHERE `wpr_id` IN ($i[wpr_id])";
				$res = db_query($q11);
				
				$st .= '<ul class="reps">';
				while( $row = mysql_fetch_assoc($res) )
				{
					$st .= "<li style='decoration: none;'>(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]</li>";
//					$st .= "<br /><br />(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]";
				}
				$st .= '</ul>';
				
			}
			
			// $cssTrClassNm & $cssTdClassNm defined here
			$cssTrClassNm = 'class="dth-wp_post-tr"';
			$cssTdClassNm = 'class="dth-wp_post"';
			
			// $cssTrClassNm & $cssTdClassNm defined just above
			$str .= '
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.' valign="top"><a href='.$globals['ind'].'action=viewProfile&uid='.$i['uid'].'>'.$i['username'].'</a></td>
					<td '.$cssTdClassNm.' id="wp_post">'.$i['wp_post'].'
					<a href="'.$globals['ind'].'action=addReply&uid='.$uid.'&post='.$i['wp_id'].'">'.$l['add_rep'].'</a>
					'.$st.'
					</td>
					<td '.$cssTdClassNm.'>'.date("g:i a d-F-Y", $i['wp_date'] ).'
					</td>
					<td '.$cssTdClassNm.'>
						<input type="checkbox" id="wp_posts['.$i['wp_id'].']" name="wp_posts[]" onclick="sel_all_chk_box(\'#select_all\', this.name, this)">
					</td>
				</tr>
				';
				
		}
		
		$str .= '
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.' valign="top">
					</td>
					<td '.$cssTdClassNm.' id="wp_post">
					</td>
					<td '.$cssTdClassNm.'>
					</td>
					<td '.$cssTdClassNm.'>
						<select>
							<option>
								With Selected:
							</option>
							<option>
								Delete
							</option>
						</select>
					</td>
				</tr>
			</table>
			</center>
			';
			
	}
	else
	{
		$str .= '
			<center><b>'.
				$l['wall_emp_msg']
			.'</b></center>';
	}
	
	/*
	//Nice css
	$sss = '
	<div id="divTestArea2" style="height: 100px; width: 300px; padding: 20px; border: 1px solid silver; background-color: #eee;">
	<b>Bold text</b><br />
	<b class="more">More bold text</b><br />
	<b class="more">Even more bold text</b><br />
	</div>
	<div class="test">This is a box</div>
	';
	*/
	
	//echo $str . $sss;
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
