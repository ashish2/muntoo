<?php

// if not defined
function poll_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l, $qe;
	
	global $board, $replies;
	
	error_handler($error);
	notice_handler($notice);
	
	
?>
<center>
	<?php
	if( mysql_num_rows($qe) > 0 )
	{
	?>
		<div class="imagegallery">
			
			<ul>
		<?php
		
		$div = '';
		
		$str = '';
		while( $row = mysql_fetch_assoc($qe) )
		{
		?>
			
			<li>
				<a href="<?=$globals['ind']."action=poll&subaction=viewpoll&pollid=$row[id]"; ?>"> <?= $row['question']; ?></a>
			</li>
			
		<?php
		}
		
		?>
		
			</ul>
		</div>
<?php
	}
	else
	{
		
?>
		<div class="nothing">
			Nothing to show here.
		</div>
<?php
	}
?>
	
</center>

<?php
	
}

function createpoll_theme()
{
	
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	
	global $board, $replies, $qe, $row, $done;
	
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
					<td valign="top">'.$l['question'].'</td>
					<td><textarea name="question" rows="6" cols="35"></textarea></td>
				</tr>
				
				<tr>
					<td valign="center">'.$l['option'].'</td>
					<td><input type="text" name="options[]" value=""></td>
				</tr>
				<tr>
					<td valign="center">'.$l['option'].'</td>
					<td><input type="text" name="options[]" value=""></td>
				</tr>
				<tr>
					<td valign="center">'.$l['option'].'</td>
					<td><input type="text" name="options[]" value=""></td>
				</tr>
			</table>
			
			<br />
			<small>+Add More options (or Delete existing options, he needs to have atleast 2 options for the poll. Later with Javascript)</small>
			<center><input class="mun-button-default" type="submit" name="submit" value="Submit"></center>
		</form>
	';
	
	
}

function viewpoll_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	global $user, $l;
	global $board, $replies, $qe;
	
	error_handler($error);
	notice_handler($notice);
	
	if($error)
		return false;
	
	?>
	
	<div class="create-poll">
		<!--
		<a href="<?//= "$globals[ind]action=createpoll&mod=imagegallery&id=$imageid"; ?>">Create a Poll for this Image</a>
		-->
	</div>
	
	
	<?php
	
	if( mysql_num_rows($qe) > 0 )
	{
		$i = 0;
		while ( $row = mysql_fetch_assoc($qe) )
		{
	?>
		<div class="image">
			
			<div>
				<?php 
					if( $i < 1 )
						echo $row['question']; 
				?>
			</div>
				
			<div>
				<b>
					<?= $row['option_text']; ?>
				</b>
			</div>
			
			<div>
				<?= $row['SUM']; ?>
			</div>
			
		</div>
	<?php
		
		$i++;
		}
		
	}
	else
	{
	?>
		<div class="no-image">
			<b>
				No Image to show here :(
			</b>
		</div>
		
	<?php
	}
}

function _main_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	global $user, $l;
	
	global $board, $replies, $qe, $imageid;
	
	error_handler($error);
	notice_handler($notice);
	
	if($error)
		return false;
	
	
	
}


?>
