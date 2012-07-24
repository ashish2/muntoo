<?php

// if not defined

//viewProfile_theme();

function listUsers_theme()
{
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $q;
	
	error_handler($errors);
	
	echo '<center>
	<h3>List Users</h3>
	<table border="1">
		<tr>
			<td><b>Listing</td>
			<td><b>Uid</b></td>
			<td><b>Username</b></td>
			<td><b>Email</b></td>
			<td><b>Url</b></td>
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
	
	$row= null;
	
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
