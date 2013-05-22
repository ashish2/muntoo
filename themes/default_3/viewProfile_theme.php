<?php

// if not defined

//viewProfile_theme();

function viewProfile_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $notice;
	global $user, $reqPrivs;
	global $q, $qu, $l;
	
	error_handler($errors);
	notice_handler($notice);
	
	$row=mysql_fetch_assoc($qu[1]);
	
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	
	$str = '';
	$str .= '<center>
	<h3>'.$l['usr_prof'].'</h3>
	<table class="disp_table" id="disp_table">';
	
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
		<tr $cssTrClassNm>
			<td $cssTdClassNm>
				$k
			</td>
			<td $cssTdClassNm>
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
			// taking directly the, DB column name 
			// as the column name for the html table
			// so replacing, underscore, in the DB column names, 
			// and showing it here as it is.
			$ke = str_replace("_", " ", $ke) ;
			$ke = ucfirst($ke);
			
			$str .=  "<tr $cssTrClassNm>
				<td $cssTdClassNm>
				afsf
					$ke
				</td>
				<td $cssTdClassNm>
					$va
				</td>
			</tr>";
		}
	}
	
	$str .=  '</table><br /><br />';
	
	$str .= '<a href="index.php?action=wall&uid='.$uid. '">'.$l['wall'].'</a>
	| <a href="index.php?action=modifyprofile&uid='.$uid. '">'.$l['mod_prof'].'</a>';
	
	// if he is the admin, and it is admins profile, dont show ban link
	// but, if he is admin, and the profile is of someone else, u show Ban link.
	// g_priv & reqPrivs is delete, then show it.
	if( ( (int) $user['g_priv'] & (int) $reqPrivs['delete']['a_priv'] ) && $uid != 1 ) 
	{
		if( isset( $row2['banned'] ) &&  $row2['banned'] )
			$str .= ' | <a href="index.php?action=unban&uid='.$uid. '">'.$l['unban'].'</a>';
		else
			$str .= ' | <a href="index.php?action=ban&uid='.$uid. '">'.$l['ban'].'</a>';
	}
	
	$friends = array();
	$friends = explode(',', $user['friends_list'] );
	
	// if the $uid (i.e. $_GET['uid']) != user[uid] which is logged in user, logged in user cant add himself
	if($uid != $user['uid'])
	{
		if( !(in_array( $_GET['uid'], $friends ) ) )
			$str .= ' | <a href="index.php?action=addFriend&uid='.$_GET['uid'].'">'.$l['add_frnd'].'</a>';
		else
			$str .= ' | <a href="index.php?action=unFriend&uid='.$_GET['uid'].'">'.$l['unfrnd'].'</a>';
	}
	
	$str .= '</center>';
	
	echo $str;
	// emptying the string contained in $str, in order to free PHP memory.
	$str ='';
	
}


?>
