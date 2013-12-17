<?php

// if not defined
function imagegallery_theme()
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
<a href='<?=$globals['ind']; ?>action=imagegallery&subaction=createalbum'>Create Album</a>
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
				<a href="<?=$globals['ind']."action=imagegallery&subaction=viewalbum&albid=$row[id]"; ?>"> <?= $row['name']; ?></a>
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

function viewalbum_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	global $board, $replies, $qe;
	
	error_handler($error);
	notice_handler($notice);
	
	$albid = ( isset($_GET["albid"] ) ? (int) check_input( $_GET["albid"] ) : null );
	
	echo "
			<a href='$globals[ind]action=imagegallery&subaction=uploadimage&albid=$albid'>Upload Image</a>
	";
	
	if( mysql_num_rows($qe) > 0 )
	{
		
		?>
		<div class="album-images">
			<ul>
				
				<?php
				while( $row = mysql_fetch_assoc($qe) )
				{
					?>
					<li class="album-images-li">
						<a href="<?= "$globals[ind]action=imagegallery&subaction=viewimage&imageid=$row[id]"; ?>">
							<img src="<?= $row['photo_save_path']; ?>">
						</a>
					</li>
					<?
				}
				?>
			</ul>
		</div>
		<?php
	}
	
}

function createalbum_theme()
{
	
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	
	global $board, $replies, $q, $row;
	
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
					<td valign="center">'.$l['alb_name_tit'].'</td>
					<td><input type="text" name="subject" value=""></td>
				</tr>
				<tr>
					<td valign="top">'.$l['alb_desc'].'</td>
					<td><textarea name="desc" rows="6" cols="35"></textarea></td>
				</tr>
			</table>
			<center><input class="mun-button-default" type="submit" name="submit" value="Submit"></center>
		</form>
	';
	
	
}

function uploadimage_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	
	global $board, $replies, $q, $row;
	
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
		<form method="post" action="" enctype="multipart/form-data">
			<table align="center">
				<tr>
					<td valign="center">'.$l['img_name'].'</td>
					<td><input type="text" name="title" value=""></td>
				</tr>
				<tr>
					<td valign="top">'.$l['img_desc'].'</td>
					<td><textarea name="description" rows="6" cols="35"></textarea></td>
				</tr>
				<tr>
					<td valign="top">'.$l['file'].'</td>
					<td>
						<input type="file" name="file" rows="6" cols="35"> (<small>Only gif, png, jpg, jpeg allowed, And filesize < 20Mb)</small>
					</td>
				</tr>
				
			</table>
			<center><input class="mun-button-default" type="submit" name="submit" value="Submit"></center>
		</form>
	';
	
}

function viewimage_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	global $user, $l;
	
	global $board, $replies, $qe, $imageid;
	
	error_handler($error);
	notice_handler($notice);
	
	if($error)
		return false;
	
	?>
	
	<div class="create-poll">
		<!--
		<a href="<?//= "$globals[ind]action=poll&subaction=create&mod=imagegallery&id=$imageid"; ?>">Create a Poll for this Image</a>
		-->
		<a href="<?= "$globals[ind]action=poll&subaction=create&mod=imagegallery_photos&id=$imageid"; ?>">Create a Poll for this Image</a>
	</div>
	
	<?php
	
	if( mysql_num_rows($qe["pic"]) > 0 )
	{
		$row = mysql_fetch_assoc($qe["pic"]);
	?>
		<div class="image">
			<div class="image-caption">
				<b>
					<?= $row['title']; ?>
				</b>
			</div>
			<div class="image-image">
				<img src="<?=$row['photo_save_path']; ?>" alt="<?= $row['title']; ?>">
			</div>
			<div class="image-description">
				<?php echo $row['description']; ?>
			</div>
		</div>
		
		<div class="rating">
			
			<?php
				if(mysql_num_rows($qe["rating"]) > 0 )
				{
					$row_r = mysql_fetch_assoc($qe["rating"]);
			?>
					<div class="total-rating">
						Rating: <?=$row_r["rating"]; ?>
					</div>
			<?php
				}
			?>
			
			Rate this pic:
			<div class="rate">
				Hot 
				<?php
					for( $i=10; $i >0; $i--)
						echo "<a href='?action=imagegallery&subaction=hotnot&imageid=$imageid&rating=$i'>$i</a> ";
				?>
				Not
			</div>
		</div>
		
		<br />
		
		<center>
			<!-- #form starts -->
			<div class="form_div" id="form">
				<form action="" method="post">
					<p>
						<span align="top" valign="top">
							Post a comment
						</span>
						<span>
							<textarea placeholder="Comment..." dir="ltr" cols="70" rows="3" name="comment" id="comment"></textarea>
						</span>
						<br>
						<br>
					<input type="submit" value="Post" class="mun-button-default" name="submit">
					</p>
				</form>
			</div>
			<br>
			<!-- #form ends -->
		</center>
		
		
		<?php
			// if there is a comment, start showing pic comments
			if(mysql_num_rows($qe["comm"]) > 0)
			{
				$cssTrClassNm = "dth-wp_post-comment";
		?>
				<!-- Image comments start here -->
				<div class="comments">
					<ul class="comment-list">
					<?php
						// while loop on comments
						while( $row_c = mysql_fetch_assoc($qe["comm"]) )
						{
					?>
							<li <?=$cssTrClassNm;?>>
								<article>
									<footer class="comment-meta">
										<div class="comment-atuhor vcard">
											<span class="fn">
												<a href='<?=$globals['ind'].'action=viewProfile&uid='.$row_c['user_id']?>'>Userid: <?=$row_c['user_id'];?></a> :::
											</span>
											<a class="date" href="#">
												<?php
												echo $row_c['date'];
												?>
											</a>
										</div>
									</footer>
									<div class ="comment-content">
										<p '.$cssTdClassNm.' id="wp_post">
											<?=$row_c['comment'];?>
										</p>
									</div>
								</article>
							</li>
					<?php
						}
					?>
					</ul>
				</div>
		
		<?php
			}
		?>
		
	<?php
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


//=========

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
