<?php

// if not defined


function bannedList_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $notice;
	global $board, $replies;
	global $qu;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	if( !empty($notice) )
	{
		notice_handler($notice);
		return false;
	}
	
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	
	if($qu)
	{
		echo '
			<center>
			<table class="disp_table" id="disp_table">
				<thead>
					<tr id="disp_table">
						<th '.$cssThClassNm.'>
							'.$l['ban_uid'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['ban_uname'].'
						</th>
					</tr>
				</thead>
			';
		for(; $i = mysql_fetch_assoc($qu); )
		{
			echo '
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>
						'.$i['ban_uid'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['username'].'
					</td>
				</tr>';
		
		}
		
		echo '
			</table>
			</center>
		';
	
	}
	else
	{
		noData();
	}
	
}

function ban_theme()
{
	global $globals, $mysql, $theme, $done, $error, $errors, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $notice;
	global $board, $replies;
	global $qu;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	error_handler($error);
	
	if( !empty($notice) )
	{
		notice_handler($notice);
		return;
	}
	
	
	
	if($qu)
	{
		echo '
			<center>
			<table border="1" >
				<tr id="disp_table">
					<td>
						'.$l['ban_uid'].'
					</td>
					<td>
						'.$l['ban_uname'].'
					</td>
				</tr>
			';
		for(; $i = mysql_fetch_assoc($qu); )
		{
			
			echo '
				<tr>
					<td>
						'.$i['ban_uid'].'
					</td>
					<td>
						'.$i['username'].'
					</td>
				</tr>';
				
		
		}
		
		echo '
			</table>
			</center>
		';
	
	}
	else
	{
		noData();
	}
	
}

// Below this nothing is used at this point
// topics_theme() etc., functions all used in thier specific files
/*
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
					'.$i['tcreatedby'].'
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
				<td>'.$i['rbody'].'</td>
				<td>'.date("g:i a d-F-Y", $i['date'] ).'</td>
				<td>'.$i['user_ip'].'</td>
			</tr>
			';
	}
	
	
	echo '
		</table>
		';
	
	
}
*/

?>
