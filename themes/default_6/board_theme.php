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
	global $qu, $qq, $newest_member_q, $users_online;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	/*
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
	*/
	
	echo '
	<center>
		<table class="disp_table" id="disp_table" width=90%>
			<tr>
				<th class="dt-header">
					'.$l['bname'].'
				</th>
				<th class="dt-header">
					'.$l['bcreatedby'].'
				</th>
				<th class="dt-header" >
					'.$l['bdate'].'
				</th>
			</tr>
		';
	
	for(; $i = mysql_fetch_assoc($qu); )
	{
		
		echo '
			<tr class="dth-wp_post-tr">
				<td class="dth-wp_post">
					<a href="'.$globals['ind'].'action=board&board='.$i['bid'].'">'.$i['bname'].'</a><br /> <small>'.$i['bdesc']. '</small>
				</td>
				
				<td class="dth-wp_post">
					<a href="'.$globals['ind'].'action=viewProfile&uid='.$i['uid'].'" data-url="'.$i['url'].'" data-email="'.$i['email'].'">'.$i['username'].'</a><br />
				</td>
				
				<td class="dth-wp_post">
					'.$i['bdate'].'
				</td>
			</tr>';
			
	
	}
	
			
				
	echo '
		</table>
		
		<div>
			Last 5 Recent Posts:
			<ul>
			';
			while( $row = mysql_fetch_assoc($qq) )
			{
				echo "<li>
					<a href='$globals[ind]action=topic&topic=$row[tid]'>$row[tname]</a>
				</li>";
			}
			
			$row = null;
			
			echo '
			</ul>
		</div>
		
		<div class="newest-member">
			';
		$row = mysql_fetch_assoc($newest_member_q);
		
		echo "
		<div>
			<div>
				Welcome our Latest Member: <a href='$globals[ind]action=viewProfile&uid=$row[uid]'>$row[username]</a>
				<br />
				You can post a greeting on his wall: 
				<a href='$globals[ind]action=wall&uid=$row[uid]'>here</a>
			</div>
		</div>
		";
		
		$user_online_str = "";
		$user_online_str = "
		<div>
			<div>
				Users online: 
			</div>
			<ul class='user-online-list'>
			";
		
		$row = null;
		while($row = mysql_fetch_assoc($users_online))
		{
			$user_online_str .= "
				<li>
					<a href='$globals[ind]action=viewProfile&uid=$row[uid]'>$row[username]</a>
				</li>
			";
		}
			
		$user_online_str .= "
			</ul>
		</div>";
		
		echo $user_online_str;
		
		echo '
		</div>
		
	</center>
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
	
	// for css, only for the moment, maybe i'll find a better way  later(afterwards)
	$cssClassName = 'class="dt-header"';
	
	echo '
		<center>
		<table class="disp_table" id="disp_table" width="90%">
			<thead>
				<th '.$cssClassName.'>'.$l['t_id'].'</th>
				<th '.$cssClassName.'>'.$l['t_name'].'</th>
				<th '.$cssClassName.'>'.$l['s_by'].'</th>
				<th '.$cssClassName.'>'.$l['created_on'].'</th>
				<th '.$cssClassName.'>'.$l['last_post'].'</th>
			</tr>
			';
			
	for( ; $i = mysql_fetch_assoc($qu); )
	{
		//printrr($i);
		
		echo '
			<tr class="dth-wp_post-tr">
				<td class="dth-wp_post" >
					'.$i['tid'].'
				</td>
				<td class="dth-wp_post" >
					<a href="'.$globals['ind'].'action=topic&topic='.$i['tid'].'">'.$i['tname'].'</a><br /> <small>'.$i['tdesc']. '</small>
				</td>
				<td class="dth-wp_post" >
					<a href="'.$globals['ind'].'action=viewProfile&id='.$i['tcreatedbyuid'].'">'.$i['tcreatedby'].'</a>
				</td>
				<td class="dth-wp_post" >
					'.$i['tdate'].'
				</td>
			</tr>
			';
			
	}
			
			
			
	echo '
		</table>
		</center>
	';
	
	
}

function topicReplies_theme()
{
	
	global $user;
	global $board, $replies;
	global $qu;
	global $board;
	global $l;
	
	$topicId = $_GET['topic'];
	
	echo '<a href="index.php?action=addReply&topic='.$topicId.'">add reply</a>';
	
	echbr(2);
	$row = mysql_fetch_assoc($qu[1] ) ;
	
	/*
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
	*/
	
	$table = '';
	
	$table .= '<center>';
	$table .= "<b>$l[t_name]: " . $row['tname'] . '</b><br /><br />';
	
	//<th class="dt-header" width="20%">'.$l['bcreatedby'].'</th>
	$table .= '
		<table class="disp_table" id="disp_table" width="90%">
			<thead>
				<tr>
					<th class="dt-header" width="20%">'.$l['by'].'</th>
					<th class="dt-header" width="60%">'.$l['desc'].'</th>
					<th class="dt-header" width="10%">'.$l['date'].'</th>
				</tr>
			</thead>
			';
	
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	 
	$table .= '
			<tr '.$cssTrClassNm.'>
				<td '.$cssTdClassNm.'>'.$row['tcreatedby'].'</td>
				<td '.$cssTdClassNm.'>'.$row['tdesc'].'</td>
				<td '.$cssTdClassNm.'>'.$row['tdate'].'</td>
			</tr>
	';
	
	/*
	$table .= '
		</table>
		';
	
	$table .= '
		<table border="1" width="90%">
			<tr id="disp_table">
				<td width="20%">'.$l['rep_by'].'</td>
				<td width="60%">'.$l['body'].'</td>
				<td width="20%">'.$l['date'].'</td>
			</tr>
			';
	*/
	
	// echo date("g:i a d-F-Y", time() );
	
	while( $i = mysql_fetch_assoc($qu[2]) )
	{
		
		
		// (if we hav permision only then show, no-eidting button)<p align="right">edit</p>
		$table .= '
			<tr '.$cssTrClassNm.'>
				<td '.$cssTdClassNm.'>'.$i['poster_users_uid'].'</td>
				<td '.$cssTdClassNm.'>' .
					'Subj: '.$i['rsubject'] .
					'<br />'.
					'Perm: <a id="'.$i["rid"].'" href=index.php?action=topic&topic='.$topicId.'#'.$i["rid"].'>#'.$i["rid"].'</a>'.
					'<br />'.
					'Body: ' .
					$i['rbody'] .
					'<br />IP: ' .
					$i['user_ip'] .
					'<br />' .
					'<span>' .
					'Signature: ' .
						$i['signature'] .
					'</span>'.
				'</td>
				<td '.$cssTdClassNm.'>'.
					date("g:i a d-F-Y", $i['date'] ).
				'</td>
			</tr>
			';
	}
	
	
	$table .= '
		</table>
		';
	
	$table .= '</center>';
	
	echo $table;
	
}

?>
