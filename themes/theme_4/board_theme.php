<?php

// if not defined


function board_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user;
	global $board, $replies;
	global $qu;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	
	echo '
		<table border="1" >
			<tr id="disp_table">
				<td>
					'.$l['bname'].'
				</td>
				<td>
					'.$l['bcreatedby'].'
				</td>
				<td>
					'.$l['bdate'].'
				</td>
			</tr>
		';
	
	for(; $i = mysql_fetch_assoc($qu); )
	{
		
		echo '
			<tr>
				<td> 
					<a href="'.$globals['ind'].'action=board&board='.$i['bid'].'">'.$i['bname'].'</a><br /> <small>'.$i['bdesc']. '</small>
				</td>
				<td>
					'.$i['bcreatedby'].'
				</td>
				<td>
					'.$i['bdate'].'
				</td>
			</tr>';
			
	
	}
	
	echo '
		</table>
	';
	
	
	
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
		<a href="'.$globals['ind'].'action=createTopic&board='.$_GET['board'].'">'.$l['cr_top'].'</a>
		';
	
	echbr(2);
	
	echo '
		<table border="1" width="90%">
			<tr id="disp_table">
				<td>'.$l['t_id'].'</td>
				<td>'.$l['t_name'].'</td>
				<td>'.$l['s_by'].'</td>
				<td>'.$l['created_on'].'</td>
				<td>'.$l['last_post'].'</td>
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
	global $l;
	
	echo '<a href="index.php?action=addReply&topic='.$_GET['topic'].'">add reply</a>';
	
	echbr(2);
	$row = mysql_fetch_assoc($qu[1] ) ;
	
	echo '<center>';
	echo "<b>$l[t_name]: " . $row['tname'] . '</b><br /><br />';
	
	echo '
		<table border="1" width="90%">
			<tr id="disp_table">
				<td width="20%">'.$l['bcreatedby'].'</td>
				<td width="60%">'.$l['desc'].'</td>
				<td width="10%">'.$l['date'].'</td>
			</tr>
			';
			
	echo '
			<tr>
				<td>'.$row['tcreatedby'].'</td>
				<td>'.$row['tdesc'].'</td>
				<td>'.$row['tdate'].'</td>
			</tr>
	';
	
	echo '
		</table>
		';
	
	echo '
		<table border="1" width="90%">
			<tr id="disp_table">
				<td width="20%">'.$l['rep_by'].'</td>
				<td width="60%">'.$l['body'].'</td>
				<td width="60%">'.$l['date'].'</td>
			</tr>
			';
	
	// echo date("g:i a d-F-Y", time() );
	
	while( $i = mysql_fetch_assoc($qu[2]) )
	{
		// (if we hav permision only then show, no-eidting button)<p align="right">edit</p>
		echo '
			<tr>
				<td>'.$i['poster_users_uid'].'</td>
				<td>'.'Subj: '.$i['rsubject'].'<br />Body: '.$i['rbody'].'<br />IP: '.$i['user_ip'].'</td>
				<td>'.date("g:i a d-F-Y", $i['date'] ).'</td>
			</tr>
			';
	}
	
	
	echo '
		</table>
		';
	
	echo '</center>';
	
}

?>
