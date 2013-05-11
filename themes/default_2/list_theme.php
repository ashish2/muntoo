<?php

// if not defined

//viewProfile_theme();

function listUsers_theme()
{
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $q, $l;
	
	error_handler($errors);
	
	/* Ori
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	
	$table = '';
	$table .= '<center>
	<h3>'.$l['list_users'].'</h3>
	<table class="disp_table" id="disp_table">
		<thead>
			<tr>
				<th '.$cssThClassNm.'><b>'.$l['listing'].'</th>
				<th '.$cssThClassNm.'><b>'.$l['uid'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['username'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['email'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['url'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['friend_uid'].'</b></th>
			</tr>
		<thead>';
		
	$i=1;
	while( $row=mysql_fetch_assoc( $q) )
	{
		$table .= "
		<tr $cssTrClassNm>
			<td $cssTdClassNm>
				$i
			</td>
			<td $cssTdClassNm>
				$row[uid]
			</td>
			<td $cssTdClassNm>
				<a href=$globals[boardurl]$globals[only_ind]action=viewProfile&uid=$row[uid]>$row[username]</a>
			</td>
			<td $cssTdClassNm>
				$row[email]
			</td>
			<td $cssTdClassNm>
				$row[url]
			</td>
			<td $cssTdClassNm>
				$row[friends_list]
			</td>
		</tr>
		";
		$i++;
	}
	
	// setting $row as null, clearing/cleaning/emptying php memory
	$row=null;
	
	$table .= '</table>';
	
	echo $table;
	// emptying table
	$table = '';
	*/
	
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	
	$table = '';
	$table .= '<center>
	<h3>'.$l['list_users'].'</h3>
	<table class="disp_table" id="disp_table">
		<thead>
			<tr>
				<th '.$cssThClassNm.'><b>'.$l['listing'].'</th>
				<th '.$cssThClassNm.'><b>'.$l['uid'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['username'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['email'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['url'].'</b></th>
				<th '.$cssThClassNm.'><b>'.$l['friend_uid'].'</b></th>
			</tr>
		<thead>';
		
	$i=1;
	while( $row=mysql_fetch_assoc( $q) )
	{
		$table .= "
		<tr $cssTrClassNm>
			<td $cssTdClassNm>
				$i
			</td>
			<td $cssTdClassNm>
				$row[uid]
			</td>
			<td $cssTdClassNm>
				<a href=$globals[boardurl]$globals[only_ind]action=viewProfile&uid=$row[uid]>$row[username]</a>
			</td>
			<td $cssTdClassNm>
				$row[email]
			</td>
			<td $cssTdClassNm>
				$row[url]
			</td>
			<td $cssTdClassNm>
				$row[friends_list]
			</td>
		</tr>
		";
		$i++;
	}
	
	// setting $row as null, clearing/cleaning/emptying php memory
	$row=null;
	
	$table .= '</table>';
	
	echo $table;
	// emptying table, clearing/cleaning/emptying php memory
	$table = '';
	
	
	
	
	/*
	echo '</table><br /><br />
	<a href="index.php?action=wall&uid='.$user['uid']. '">Wall</a> | 
	<a href="index.php?action=modifyprofile&uid='.$user['uid']. '">Modify Profile</a> | 
	<a href="index.php?action=ban&uid='.$user['uid']. '">Ban him!!!</a>
	</center>';
	*/
	
}




?>

<!--
<img src="images/uploaded/1.jpg">
-->
