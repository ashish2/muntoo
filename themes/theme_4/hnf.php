<?php

function fheader($title='', $css='', $js='')
{
	
	global $globals, $user;
	
	$themedir = 'themes';
	
	$user['theme_type'] = ( isset($_SESSION['user']['theme_type'] ) ?  $_SESSION['user']['theme_type'] : 'default' );
	
	$css = (!$css) ? $globals['boardurl']."/$themedir/".$user['theme_type'] . '/css/style.css' : $css;
	$js = (!$js) ? $globals['boardurl']."/$themedir/". $user['theme_type'] . '/js/javascript.js' : $js;
	
	echo '
		<html>
		<head>
		<title>
		'.( !empty($title) ? $title : 'Muntoo' ).
		'
		</title>
		<link rel="stylesheet" type="text/css" href="'.$css.'">
		<script language="javascript" type="text/javascript" src="'.$js.'">
		</script>
		</head>
		<body>
		<table width="100%" border="1">
			<tr>
				<td> 
					<img src="images/site/s8.jpeg" >
				</td>
			</tr>
		</table>
		
	';
}

function fnav()
{
	
	global $user;
	
	// if $user['uid'] not set
	// $uid = ( isset($user['uid'] ) ? $user['uid'] :  '' );
	/*
	echo '
		<table border="1" cellspacing="0" cellpadding="5" id="nav">
			<tr>
				<td><a href="index.php?">Home</a></td> ' .
/*				<td>
				<ul>
				<a href="index.php?action=usercp">User Panel</a>
				<li><a href="index.php?action=modifyprofile"></a></li>
				</ul>
				</td>
*/	/*	'			<td><a href="index.php?action=modifyprofile&uid='.$user['uid'].'">Modify Profile</a></td>
				<td><a href="index.php?action=viewProfile&uid='.$user['uid'].'">View Profile</a></td> ' .
				( ( $_SESSION["user"]["uid"] == 1 ) ? '<td><a href="index.php?action=admin">Admin Board</a></td>' : '' ) .
	'			<td><a href="index.php?action=bannedList">Banned </a> </td> ' .
				( ( !isset( $_SESSION["user"]["uid"] )  ) ? '<td><a href="index.php?action=register">Register</a></td><td><a href="index.php?action=login">Login</a></td>' : '<td><a href="index.php?action=logout">Logout</a></td>' ) . 
	'		</tr>
		</table>
	';
	*/
	
	echo '
		<table border="1" cellspacing="0" cellpadding="5" id="nav">
			<tr>
				<td><a href="index.php?">Home</a></td> ' .
/*				<td>
				<ul>
				<a href="index.php?action=usercp">User Panel</a>
				<li><a href="index.php?action=modifyprofile"></a></li>
				</ul>
				</td>
*/	'			<td><a href="index.php?action=mainBoard">Forums</a></td> 
				<td><a href="index.php?action=modifyprofile">Modify Profile</a></td>
				<td><a href="index.php?action=listUsers">List Users</a></td>
				<td><a href="index.php?action=viewProfile">View Profile</a></td> ' .
				( ( isset( $_SESSION["user"]["uid"] ) && $_SESSION["user"]["uid"] == 1 ) ? '<td><a href="index.php?action=admin">Admin Board</a></td>' : '' ) .
	'			<td><a href="index.php?action=bannedList">Banned </a> </td> ' .
				( ( !isset( $_SESSION["user"]["uid"] )  ) ? '<td><a href="index.php?action=register">Register</a></td><td><a href="index.php?action=login">Login</a></td>' : '<td><a href="index.php?action=logout">Logout</a></td>' ) . 
	'		</tr>
		</table>
	';
	
}

function ffooter($time_elapsed=0)
{
	// <i>Muntoo</i>! <small>!&copy;</small>&nbsp;
	$foot = '
		<table width="100%" style="background-color:lightgrey; border: 1px solid blue">
			<tr>
			<td>
			<i>Muntoo</i>&nbsp;
			</td>
			<td align="right">
			'.
			( ( $time_elapsed ) ? '<font size="1"><i>Page loaded in ' . $time_elapsed . ' seconds &nbsp; </i>' : '' )
			.'
			</font>
			</td>
			</tr>
		</table>
		</body>
		</html>
	';
	
	echo $foot;
	// emptying the $foot
	$foot = '';
}

?>
