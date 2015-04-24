<?php

// we can load and hnf_theme.php and hnf_lang.php file here,
// and do stuff in that manner.

function fheader($title='', $css='', $js='')
{
	
	global $globals, $user, $theme;
	
	$themedir = 'themes';
	
	///$user['theme_type'] = ( isset($_SESSION['user']['theme_type'] ) ?  $_SESSION['user']['theme_type'] : 'default' );
	$user['theme_type'] = ( isset($user['theme_type'] ) ) ? $user['theme_type'] : ( ( isset($_SESSION['user']) && isset($_SESSION['user']['theme_type']) ) ? $_SESSION['user']['theme_type'] : 'default' ) ;
	
	$css = (!$css) ? $globals['boardurl']."/$themedir/".$user['theme_type'] . '/css/style.css' : $css;
	// This will now not be required as well as the $js variable getting passed into this function,
	// because we have included js files in a $theme[js_files] array, which will be included 
	// after include_js_files() function runs below
	//$js = (!$js) ? $globals['boardurl']."/$themedir/". $user['theme_type'] . '/js/javascript.js' : $js;
	
	
	echo '
	<!DOCTYPE html>
		<html>
		<head>
			<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
			<meta content="utf-8" http-equiv="encoding">
		
		<title>
		'.( !empty($title) ? $title : 'Muntoo' ).
		'
		</title>
		<link rel="stylesheet" type="text/css" href="'.$css.'">
		';
		//<script language="javascript" type="text/javascript" src="'.$js.'"></script>';
		
		//~include_js_files();
		//~$jses = '';
		//~foreach($theme['js_files'] as $k => $v)
		//~{
			//~if ( $v[0] != '#' )
			//~{
				//~$js_file = $globals['boardurl']."/$themedir/". $user['theme_type'] . '/js/'.$v;
				//~$jses .= '<script language="javascript" type="text/javascript" src="'.$js_file.'"></script>';
			//~}
		//~}
		//~echo "$jses";
		
		echo '
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
	/*
	// URLs with Shebangs yo#!
	echo '
	<center>
		<table cellspacing="0" cellpadding="5" class="nav" id="nav">
			<tr>
				<td><a href="index.php?/#!/" onclick="alert(this.hash);"><span class="funny">@</span>Home</a></td> ' .
				//<td>
				//<ul>
				//<a href="index.php?action/usercp">User Panel</a>
				//<li><a href="index.php?action/modifyprofile"></a></li>
				//</ul>
				//</td>
	'			<td><a href="index.php?/#!/action/mainBoard" onclick="alert(this.hash);"><span class="funny">/</span>Forums</a></td> 
				<td><a href="index.php?/#!/action/modifyprofile" onclick="alert(this.hash);"><span class="funny">#</span>Modify Profile</a></td>
				<td><a href="index.php?/#!/action/wall" onclick="alert(this.hash);"><span class="funny">$</span>The Wall (stands Tall)</a></td>
				<td><a href="index.php?/#!/action/listUsers" onclick="alert(this.hash);"><span class="funny">^</span>List Users</a></td>
				<td><a href="index.php?/#!/action/viewProfile" onclick="alert(this.hash);"><span class="funny">%</span>View Profile</a></td> ' .
				( ( isset( $_SESSION['user']['uid'] ) && $_SESSION['user']['uid'] == 1 ) ? 
				'<td><a href="index.php?/#!/action/admin" onclick="alert(this.hash);"><span class="funny">&</span>Admin Board</a></td>' : '' ) .
	'			<td><a href="index.php?/#!/action/bannedList" onclick="alert(this.hash);"><span class="funny">!</span>Banned</a></td> ' .
				( ( !isset( $_SESSION['user']['uid'] )  ) ? 
				'<td><a href="index.php?/#!/action/register" onclick="alert(this.hash);"><span class="funny">+</span>Register</a></td>
				<td><a href="index.php?/#!/action/login" onclick="alert(this.hash);""><span class="funny">-></span>Login</a></td>'  : 
				'<td><a href="index.php?/#!/action/logout" onclick="alert(this.hash);"><span class="funny"><-</span>Logout</a></td>' 
				) . 
	'		</tr>
		</table>
		<br />
		<br />
	</center>
	
	';
	*/
	
	
	$adminLink = '';
	if( isset( $_SESSION['user']['uid'] ) && $_SESSION['user']['uid'] == 1 ) 
	{
		$adminLink = '<td id="7"><a id="admin" class="nav_links" href="index.php?action=admin"><span class="funny">&</span>Admin Board</a></td>';
	}
	
	
	$login_logout_link = '<td id="11"><a id="logout" class="" href="index.php?action=logout"><span class="funny"><-</span>Logout</a></td>' ;
	if ( !isset( $_SESSION['user']['uid'] )  ) 
	{
		$login_logout_link = '<td id="9"><a id="register" class="nav_links" href="index.php?action=register"><span class="funny">+</span>Register</a></td>
				<td id="10"><a id="login" class="nav_links" href="index.php?action=login"><span class="funny">-></span>Login</a></td>';
	}
	
	// add class  "ajaxGetCall" 
	// to links 
	// if u wanna load them through ajax
	echo '
	<center>
		<table cellspacing="0" cellpadding="5" class="nav" id="nav">
			<tr>
				<td id="1"><a class="nav_links" href="index.php?"><span class="funny">@</span>Home</a></td>' .
/*				<td>
				<ul>
				<a href="index.php?action=usercp">User Panel</a>
				<li><a href="index.php?action=modifyprofile"></a></li>
				</ul>
				</td>
				<td id="6"><a class="nav_links" href="index.php/viewProfile"><span class="funny">%</span>View Profile</a></td> ' .
				
*/	'			<td id="2" ><a id="mainBoard" class="nav_links" href="index.php?action=mainBoard"><span class="funny">/</span>Forums</a></td>
				<td id="4"><a id="wall" class="nav_links" href="index.php?action=wall"><span class="funny">$</span>The Wall (stands Tall)</a></td>
				<td id="6"><a id="viewProfile" class="nav_links" href="index.php?action=viewProfile"><span class="funny">%</span>View Profile</a></td> 
				<td id="3"><a id="modifyprofile" class="nav_links" href="index.php?action=modifyprofile"><span class="funny">#</span>Modify Profile</a></td>
				
				<td id="8"><a id="viewMessage" class="nav_links" href="index.php?action=viewMessage"><span class="funny"><></span>View Message</a></td>
				<td id="7"><a id="sendMessage" class="nav_links" href="index.php?action=sendMessage"><span class="funny">></span>Send Message</a></td>
				
				<td id="9"><a id="friendsList" class="nav_links" href="index.php?action=friendsList"><span class="funny">w</span>Friends List</a></td> 
				<td id="10"><a id="imagegallery" class="nav_links" href="index.php?action=imagegallery"><span class="funny">I</span>ImageGallery</a></td>
				 
				' .
				
				$adminLink .
				
	'			
				<td id="5"><a id="listUsers" class="nav_links" href="index.php?action=listUsers"><span class="funny">^</span>List Users</a></td>
				<td id="11"><a id="bannedList" class="nav_links" href="index.php?action=bannedList"><span class="funny">!</span>Banned</a></td> 
	' .
	
				$login_logout_link .
	'		</tr>
		</table>
	</center>
	
	<!-- div class sabse-main Starts -->
	<div class="sabse-main">
		
	';
/*
		<!-- Angular Testing -->
		<div class="angular-testing" ng-app="MyTutorialApp">
		
			<div class="ang-cont" ng-controller="MainCtrl">
				{{understand}}
			</div>
			
		</div>
		<!-- Angular Testing/ -->
*/

	
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
	global $globals, $user, $theme;
	
	$themedir = 'themes';
	
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
			
		';
		
		// Just loading all JS files, just before div "sabse-main" ends
		include_js_files();
		$jses = '';
		$media_url = '';
		$media_url = get_media_url();
		
		foreach($theme['js_files'] as $k => $v)
		{
			if ( $v[0] != '#' )
			{
				$js_file = $media_url."/$themedir/". $user['theme_type'] . '/js/'.$v;
				$jses .= '<script language="javascript" type="text/javascript" src="'.$js_file.'"></script>';
			}
		}
		$foot .= '<div class="load-js-div">' .$jses.' </div>';
			
		$foot .= '
		</div>
		<!-- div class sabse-main Ends -->
		<div class="diablo">
		</div>
	</body>
	</html>
	';
	
	echo $foot;
	// emptying the $foot
	$foot = '';
}

?>
