<?php

// we can load and hnf_theme.php and hnf_lang.php file here,
// and do stuff in that manner.

function fheader($title='', $css='', $js='')
{
	
	global $globals, $user;
	
	$themedir = 'themes';
	
	//$user['theme_type'] = ( isset($_SESSION['user']['theme_type'] ) ?  $_SESSION['user']['theme_type'] : 'default' );
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
			<!-- #main starts -->
			<div id="main">
				<!-- #container starts -->
				<div id="container">
					<header>
						<figure>
							<img src="images/site/s8.jpeg" >
						</figure>
					</header>
					<!-- #innerContainer starts -->
					<div id="innerContainer">
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
	<div id="navigation">
		<ul>
			<li>
				<a href="?">Home</a>
			</li>
			<li>
			<a href="?action=mainBoard">Forums</a>
			</li>
			<li>
				<a href="?action=modifyprofile">Modify Profile</a>
			</li>
			<li>
				<a href="?action=wall">The Wall (stands Tall)</a>
			</li>
			<li>
				<a href="?action=listUsers">List Users</a>
			</li>
			<li>
				<a href="?action=viewProfile">View Profile</a>
			</li>
			' .
			( ( isset( $_SESSION['user']['uid'] ) && $_SESSION['user']['uid'] == 1 ) ? 
			'<li>
				<a href="?action=admin">Admin Board</a>
			</li>' : 
			'' 
			) .
				'
			<li>
				<a href="?action=bannedList">Banned </a>
			</li> 
			' .
			( ( !isset( $_SESSION['user']['uid'] )  ) ? 
			'<li>
				<a href="?action=register">Register</a>
			</li>
			<li>
				<a href="?action=login">Login</a>
			</li>' : 
			'<li>
				<a href="?action=logout">Logout</a>
			</li>' 
			) . 
			'
		</ul>
	</div>
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
	// 				<br class="clear" />
	$foot = '
				</div>
				<!-- #innerContainer ends -->
				
				<!-- #footer starts -->
				<div class="footer" id="footer">
					<i>Muntoo</i>&nbsp;
					<span align="right">
					'.
					( ( $time_elapsed ) ? 
						'<font size="1"><i>Page loaded in ' . $time_elapsed . ' seconds &nbsp; </i>' : '' )
						.'
						</font>
					</span>
				</div>
				<!-- #footer ends -->
			
			</div>
			<!-- #container ends -->
			
		</div>
		<!-- #main ends -->
	</body>
	</html>
	';
	
	echo $foot;
	// emptying the $foot
	$foot = '';
	
}

?>
