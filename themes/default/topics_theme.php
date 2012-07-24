<?php

// if not defined

function board_theme()
{
	global $globals, $mysql, $theme, $done, $errors;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user;
	
	global $board, $replies;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	echo '
		<form method="post" action="">
			<table align="center">
				<tr>
					<td width="70%"> Board Name </td>
					<td><input type="text" name="bname"> </td>
				</tr>
				<tr>
					<td>Board Description</td>
					<td><textarea name="bdesc" rows="6" cols="35"></textarea></td>
				</tr>
				<tr>
					<td>Fave Perfume</td>
					<td><input type="text" name="perfume"> </td>
				</tr>
			</table>
			<center><input type="submit" name="board_set" value="Start Board"></center>
		</form>
	';
	
}



?>
