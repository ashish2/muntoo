<?php

// if not defined

function createTopic_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	
	global $board, $replies;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	error_handler($error);
	notice_handler($notice);
	
	
	echo '
		<form method="post" action="">
			<table align="center">
				<tr>
					<td valign="center">'.$l['top_name'].'</td>
					<td><input type="text" name="subject" value=""></td>
				</tr>
				<tr>
					<td valign="top">'.$l['top_desc'].'</td>
					<td><textarea name="desc" rows="6" cols="35"></textarea></td>
				</tr>
			</table>
			<center><input class="mun-button-default" type="submit" name="reply_sub" value="Reply"></center>
		</form>
	';
	
	
}


function addReply_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	
	global $board, $replies, $row;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	error_handler($error);
	notice_handler($notice);
	
	$subject = '';
	// if not isset $_GET[post], that means it is not a createTopic, it only an addReply
	// if isset $_GET[post], that means it is a createTopic event
	if( !isset($_GET['post'] ) )
	{
		$subject = '<tr>
					<td valign="center">'.$l['subj'].'</td>
					<td><input type="text" name="subject" value="Re: '.$row['tname'].'"></td>
			</tr>';
	}
	
	echo '
		<form method="post" action="">
			<table align="center">
			'.$subject.'
					<tr>
						<td valign="top">'.$l['reply'].'</td>
						<td><textarea name="reply" rows="6" cols="35"></textarea></td>
					</tr>
				</table>
			<center><input class="mun-button-default" type="submit" name="reply_sub" value="Reply"></center>
		</form>
	';
	
	
	
}

?>
