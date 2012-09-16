<?php

// if not defined

//viewProfile_theme();

function listUsers_theme()
{
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $q, $l;
	
	error_handler($errors);
	
	echo '<center>
	<h3>'.$l['list_users'].'</h3>
	<table border="1">
		<tr id="disp_table">
			<td><b>'.$l['listing'].'</td>
			<td><b>'.$l['uid'].'</b></td>
			<td><b>'.$l['username'].'</b></td>
			<td><b>'.$l['email'].'</b></td>
			<td><b>'.$l['url'].'</b></td>
			<td><b>'.$l['friend_uid'].'</b></td>
		</tr>';
		
	$i=1;
	while( $row=mysql_fetch_assoc( $q) )
	{
		echo "
		<tr>
			<td>
				$i
			</td>
			<td>
				$row[uid]
			</td>
			<td>
				<a href=$globals[boardurl]$globals[only_ind]action=viewProfile&uid=$row[uid]>$row[username]</a>
			</td>
			<td>
				$row[email]
			</td>
			<td>
				$row[url]
			</td>
			<td>
				$row[friends_list]
			</td>
		</tr>
		";
		$i++;
	}
	
	// setting $row as null, clearing/cleaning/emptying php memory
	$row=null;
	
	echo '</table>';
	
	/*
	echo '</table><br /><br />
	<a href="index.php?action=wall&uid='.$user['uid']. '">Wall</a> | 
	<a href="index.php?action=modifyprofile&uid='.$user['uid']. '">Modify Profile</a> | 
	<a href="index.php?action=ban&uid='.$user['uid']. '">Ban him!!!</a>
	</center>';
	*/
	
}


?>
