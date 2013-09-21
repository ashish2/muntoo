<?php

// if not defined


function wall_theme()
{
	global $globals, $mysql, $theme, $done, $error, $errors, $notice, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user;
	global $board, $replies;
	global $imgFolder;
	global $friend_reco;
	
	// The array carrying the data of posts, likes
	global $posts, $post_reps, $likes;
	
	
	
	$imgType = '.jpg';
	
	if($error)
	{
		//$err_img = '<span class="error_span">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
		//echo $err_img;
		error_handler($error);
	}
	
	notice_handler($notice);
	
	if( !userLoggedIn() )
		return false;
	
	// you dont have to pass an imgname everytime this way,
	// just have an error_span class, and in css u have the error_span class background-image
	//error_handler($error, 'error-icon.png');
	
	
	$str = '';
	$str = '
		<div class="main">
	';
	
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
	
	$str .= '<center>';
	
	$action = $globals["only_ind_no_slash"].'action='.$_GET['action'];
	$str .= '
			<!-- #form starts -->
			<div id="form" class="form_div">
				<form method="post" action="'.$action.'">
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
	';
	
	// Friends Recommendation
	$str .= '<div><b>Friend Recommendation</b>:<br />';
	foreach( $friend_reco as $k => $v)
	{
		$reasons = $friend_reco[$k]['reasons'];
		$str .= "<a href=$globals[ind]action=viewProfile&uid=$k><img title=\"$reasons\" src={$imgFolder['uploaded']['vsmall']}/$k$imgType></a> &nbsp;";
	}
	$str .= '</div>
		<br />
		';
	
		
	$str .= '</center>';
	
	if( !empty($posts) && is_array($posts) )
	{
		//~$str .= '
		//~<center>
			//~<table class="disp_table" id="disp_table" width="90%">
				//~<thead>
					//~<tr>
						//~<th class="dt-header">By</th>
						//~<th class="dt-header" width="60%" valign="middle" align="center">'.$l['post'].'</th>
						//~<th class="dt-header" width="20%">'.$l['date'].'</th>
						//~<th class="dt-header" width="5%">
						//~<input type="checkbox" id="select_all" onclick="sel_all_chk_box(\'#select_all\', \'wp_posts[]\')">
							//~Select All
						//~</th>
					//~</tr>
				//~</thead>
				//~';
		
		$str .= "
			<div class='comments'>
				<ol class='commentlist'>
			";
		
		// getting $uid
		$uid = ( isset($_GET['uid'] ) ? (int) check_input( $_GET['uid'] ) : $user['uid'] );
		
		// For Likes
		// There will be $user['likes']['wp'] array, $user['likes']['wpr'] array,
		// $user['likes']['photo'] array
		// assign those arrays temporarily to other arrays for the purpose of
		// in_array() checking & then unsetting the themporary array,
		// in order to loop the next in_arry() faster
		#$u_wp = $user['likes']['wp'];
		#$u_wpr = $user['likes']['wpr'];
		
		// Not needed as there no photos here
		//$u_photos = $user['likes']['photos'];
		
		$like_unlike = '';
		$like_unlike = $l['like'];
		
		$key = null;
		
		// Page for emotion,
		// action=emotion&e=love&post=$postId
		// <a href=$globals[ind]action=emotion&e=love&post=$postId>(Love)</a>
		$emotion_arr = array(
			'love'=>'Love',
			'f*ck'=>'F*ck',
			'no_emo'=>'No Emotion',
			'some_rand_emo'=>'Some Random Emotion',
			'huh'=>'Huh!?',
		);
		
		// The loop for Wall_Posts
		foreach( $posts as $k => $v )
		{
			
			$st = '';
			$st .= '<ul class="reps">';
			
			// $v[0]['post2'] != null , then this post has replies in it
			if($v[0]['post2'] != null )
			{
				// The Loop for Wall_Posts_Reply
				foreach($v as $kk => $vv)
				{
					
					// For getting whether this wpr_id is liked by the user,
					// and then unsetting it from the temporary array
					// If key exists, then show unlike & unset key
					if( isset($likes[$vv['id2']]) )
					{
						
						$count = count($likes[$k]);
						
						//if( $key = array_search($i['wp_id'], $u_wpr ) )
						if( in_array( $user['uid'], $likes[$vv['id2']] ) )
						{
							$like_unlike = $l['unlike'];
							unset($likes[$k]);
						}
						else
						{
							// Else if key does not exists, show like, 
							// which means this hasn't been liked by the user yet, so show like.
							$like_unlike = $l['like'];
						}
					}
					else
					{
						// Else if key does not exists, show like, 
						// which means this hasn't been liked by the user yet, so show like.
						$like_unlike = $l['like'];
					}
					
					$date = date("g:i a d-F-Y", $vv['date2'] );
					
					//$st .= "<li style='decoration: none;'>(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]</li>";
					$st .= "<li style='decoration: none;'><a href=$globals[ind]action=viewProfile&uid=$vv[by_uid2]><img title=$vv[username] src={$imgFolder['uploaded']['vsmall']}/$vv[by_uid2]$imgType></a> $vv[post2]
					<span>
						<small>
							$date
							<a href=$globals[ind]action=emotion&e=like&uid=$user[uid]&post=$vv[id2]>".ucfirst($like_unlike)."</a>
						</small>
						</span>
					</li>";
	//					$st .= "<br /><br />(<a href=$globals[ind]action=viewProfile&uid=$row[uid]>$row[username]</a>) $row[wpr_content]";
				}
				$st .= '</ul>';
			}
			
			// Doing this here, bcos if we do it up,
			// this gets overridden by another such $like_unlike block.
			/* Commenting out FTM(for the moment)  */
			// For getting whether this wpr_id is liked by the user,
			// and then unsetting it from the temporary array
			// If key exists, then show unlike & unset key
			if( isset($likes[$k]) )
			{
				
				$count = count($likes[$k]);
				
				//if( $key = array_search($i['wp_id'], $u_wpr ) )
				if( in_array( $user['uid'], $likes[$k] ) )
				{
					$like_unlike = $l['unlike'];
					unset($likes[$k]);
				}
				else
				{
					// Else if key does not exists, show like, 
					// which means this hasn't been liked by the user yet, so show like.
					$like_unlike = $l['like'];
				}
			}
			else
			{
				// Else if key does not exists, show like, 
				// which means this hasn't been liked by the user yet, so show like.
				$like_unlike = $l['like'];
			}
			
			// $cssTrClassNm & $cssTdClassNm defined here
			$cssTrClassNm = 'class="dth-wp_post-comment"';
			$cssTdClassNm = 'class="dth-wp_post"';
			
			$postId = $v[0]['id1'];
			// Like - Unlike
			// If this post id in present in the $user['likes'] array, then show unlike, else show like 
			////$like_unlike = ( !in_array($i['wp_id'], $user['likes'] ) $l['like'] :  $l['unlike'] );
			
			// The kind of $posts array() thats coming with the query,
			// We know that, Wall Post & First Wall_Post_Reply both shud be taken from Index 0
			// So, We'll take the Wall Post from the First Index, Index 0 of $posts array(),
			// & the Replies (Wall Post Replies) the first one also, from Index 0
			// & then the Rest of the Replies from the consecutive Indexes of $posts array()
			// $cssTrClassNm & $cssTdClassNm defined just above
			$str .= '
				<li '.$cssTrClassNm.'>
					<article>
						<footer class="comment-meta">
							<div class="comment-atuhor vcard">
								<span class="fn">
									<a href='.$globals['ind'].'action=viewProfile&uid='.$v[0]['by_uid1'].'>'.$v[0]['username'].'</a>
								</span>
								
								<a class="date" href="#">'.
									date("g:i a d-F-Y", $v[0]['date1'] ).'
								</a>
								
							</div>
						</footer>
					
					<div class ="comment-content">
						<p '.$cssTdClassNm.' id="wp_post">
							' . $v[0]['post1'] . '
						</p>
					</div>
					
					<div class="reply">
							<small>
								<a href="'.$globals['ind'].'action=addReply&post='.$postId.'">' .
									$l['add_rep'] .
								'</a> 
								
								
					
					';
								
								$sss = '';
								$sss .= "<select>
								<option value='0'>Select Emotion</option>
								<option value='$postId-$like_unlike'>".ucfirst($like_unlike) ."</option>
								";
								
								foreach($emotion_arr as $kkk => $vvv)
									$sss .= "<option value='$postId-$kkk'>$vvv</option>";
								
								$sss .= '</select>';
						
						$sss .= "</small>
								</span>
								
					<span '.$cssTdClassNm.'>
						<input type='checkbox' id='wp_posts[$v[0][id1]]' name='wp_posts[]' onclick='sel_all_chk_box(\'#select_all\', this.name, this)'>
						</span>
						
							</div>
						";
						
						$str .= $sss .
						// The replies get added here
						$st . 
						'
					
					</article>
				</li>
				';
				
		}
		
		/*
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
					</td>';
					
			*/
			
					
			
				$str .= '</ol>
			</div>
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
	
	$str .= '</div>';
	// div "main" ends
	
	//echo $str . $sss;
	echo $str;
	$str = null;
	
}


?>
