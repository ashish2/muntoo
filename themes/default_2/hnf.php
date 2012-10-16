<?php

// we can load and hnf_theme.php and hnf_lang.php file here,
// and do stuff in that manner.

function fheader($title='', $css='', $js='')
{
	
	global $globals, $user;
	
	$themedir = 'themes';
	
	///$user['theme_type'] = ( isset($_SESSION['user']['theme_type'] ) ?  $_SESSION['user']['theme_type'] : 'default' );
	$user['theme_type'] = ( isset($user['theme_type'] ) ) ? $user['theme_type'] : ( ( isset($_SESSION['user']) && isset($_SESSION['user']['theme_type']) ) ? $_SESSION['user']['theme_type'] : 'default' ) ;
	
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
		<table class="header">
			<tr class="header">
				<td width="15%">
					<img src="images/site/s8.jpeg" >
				</td>
				<td valign="center" align="right">
					<header class="mainheader">
						<small>
						<i>
							<span class="header_text"><span class="span1">Mun</span><span class="span2">too</span></span><span class="red">.</span><span class="green">.</span><span class="blue">.</span><span class="yellow">.</span>
						</i>
						</small>
					</header>
				</td>
			</tr>
		</table>
		<br />
	';
}

function fnav()
{
	
	global $user, $actionarr;
	
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
	<center>
		<table cellspacing="0" cellpadding="5" class="nav" id="nav">
			<tr>
				<td><a href="index.php?"><span class="funny">@</span>Home</a></td> ' .
/*				<td>
				<ul>
				<a href="index.php?action=usercp">User Panel</a>
				<li><a href="index.php?action=modifyprofile"></a></li>
				</ul>
				</td>
*/	'			<td><a href="index.php?action=mainBoard"><span class="funny">/</span>Forums</a></td> 
				<td><a href="index.php?action=modifyprofile"><span class="funny">#</span>Modify Profile</a></td>
				<td><a href="index.php?action=wall"><span class="funny">$</span>The Wall (stands Tall)</a></td>
				<td><a href="index.php?action=listUsers"><span class="funny">^</span>List Users</a></td>
				<td><a href="index.php?action=viewProfile"><span class="funny">%</span>View Profile</a></td> ' .
				( ( isset( $_SESSION['user']['uid'] ) && $_SESSION['user']['uid'] == 1 ) ? 
				'<td><a href="index.php?action=admin"><span class="funny">&</span>Admin Board</a></td>' : '' ) .
	'			<td><a href="index.php?action=bannedList"><span class="funny">!</span>Banned</a></td> ' .
				( ( !isset( $_SESSION['user']['uid'] )  ) ? 
				'<td><a href="index.php?action=register"><span class="funny">+</span>Register</a></td>
				<td><a href="index.php?action=login"><span class="funny">-></span>Login</a></td>'  : 
				'<td><a href="index.php?action=logout"><span class="funny"><-</span>Logout</a></td>' 
				) . 
	'		</tr>
		</table>
		<br />
		<br />
	</center>
	
	';
	
	// Keep the Permissions in Mind, 
	// Permissions hasnt been taken care of here
	// We can loop and print the whole actionarrr as links here, 
	// instead of doing it like above, where we are using hard coded links
	/*
	foreach($actionarr as $k => $v )
	{
		printrr($v[3]);
	}
	*/
	
}

function ffooter($time_elapsed=0)
{
	// <i>Muntoo</i>! <small>!&copy;</small>&nbsp;
	$foot = '
		<table class="footer" width="100%">
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
		<br />
		</body>
		</html>
	';
	
	echo $foot;
	// emptying the $foot
	$foot = '';
}

?>
