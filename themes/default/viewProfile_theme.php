<?php

// if not defined

//viewProfile_theme();

function viewProfile_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $notice;
	global $user, $reqPrivs;
	global $q, $qu;
	
	error_handler($errors);
	notice_handler($notice);
	
	$row=mysql_fetch_assoc($qu[1]);
	
	$str = '';
	$str .= '<center>
	<h3>User Profile</h3>
	<table border="1">';
	
	foreach( $row as $k => $v )
	{
		if ( $k == 'salt' || $k == 'password' )
		{
			unset( $row[$k] );
			continue;
		}
		
		$k = str_replace("_", " ", $k) ;
		$k = ucfirst($k);
		
		$str .=  "
		<tr>
			<td>
				$k
			</td>
			<td>
				$v
			</td>
		</tr>
		";
	}
	
	$uid = ( isset($_GET['uid'] ) ? (int) check_input( $_GET['uid'] ) : $user['uid'] );
	
	if( mysql_num_rows( $qu[2] ) == 1 )
	{
		$row2 = mysql_fetch_assoc( $qu[2]);
		foreach( $row2 as $ke => $va )
		{
			$ke = str_replace("_", " ", $ke) ;
			$ke = ucfirst($ke);
			
			$str .=  "<tr>
				<td>
					$ke
				</td>
				<td>
					$va
				</td>
			</tr>";
		}
	}
	
	$str .=  '</table><br /><br />';
	
	$str .= '<a href="index.php?action=wall&uid='.$uid. '">Wall</a>
	| <a href="index.php?action=modifyprofile&uid='.$uid. '">Modify Profile</a>';
	
	// if he is the admin, and it is admins profile, dont show ban link
	// but, if he is admin, and the profile is of someone else, u show Ban link.
	// g_priv & reqPrivs is delete, then show it.
	if( ( (int) $user['g_priv'] & (int) $reqPrivs['delete']['a_priv'] ) && $uid != 1 ) 
	{
		if( isset( $row2['banned'] ) &&  $row2['banned'] )
			$str .= ' | <a href="index.php?action=unban&uid='.$uid. '">Unban him</a>';
		else
			$str .= ' | <a href="index.php?action=ban&uid='.$uid. '">Ban him!!!</a>';
	}
	
	$friends = array();
	$friends = explode(',', $user['friends_list'] );
	
	// if the $uid (i.e. $_GET['uid']) != user[uid] which is logged in user, logged in user cant add himself
	if($uid != $user['uid'])
	{
		if( !(in_array( $_GET['uid'], $friends ) ) )
			$str .= ' | <a href="index.php?action=addFriend&uid='.$_GET['uid'].'">Add Friend</a>';
		else
			$str .= ' | <a href="index.php?action=unFriend&uid='.$_GET['uid'].'">UnFriend</a>';
	}
	
	$str .= '</center>';
	
	echo $str;
	// emptying the string contained in $str, in order to free PHP memory.
	$str ='';
	
}


?>
