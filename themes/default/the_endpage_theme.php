<?php

// if not defined

//modifyprofile_theme();

function the_endpage_theme()
{
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user, $privs, $row;
	global $q, $q1;
	
	global $endpage_msg;
	
	error_handler($errors);
	//error_handler($endpage_msg);
	error_handler($endpage_msg);
	
	if( !userLoggedIn() )
		return false;
	
	if( !empty($errors) || !empty( $endpage_msg) )
	{
		return false;
	}
	
	//printrr( $user['g_priv'] );
	
	// CHecking Permissions
	//if( !allowedTo() )
		//return false;
	
	//printrr( $user );
	//printrr( $privs );
	//printrr( $row );
	
	
	//echo 1 & 5;
	
	//if( ( 1 & 5 ) == 5 )  echo "oh";
	
	//echo $user['g_priv'] . " " ;
	//echo $privs['editor']['g_priv'];
	/*
	if( $user['g_priv'] != $privs['editor']['g_priv'] )
//	if( $user['g_priv'] & $privs['guest']['g_priv'] )
	{
		$error['access_denied'] = "Not allowed to access this area.";
		return false;
	}
	* */
	
	//if( $_GET['id']  != $user['uid'] || $user['uid'] != 1 )
	{
//		isAllowedTo();
	}
	
	echo '
		<form method="post" action="">
			<table align="center" width="100%" border="1">
				<tr>
					<td>Username</td>
					<td>'.$row['username'].'</td>
				</tr>
				<tr>
					<td>About</td>
					<td><textarea name="about" rows="7" cols="40">'.$row['about'].'</textarea></td>
				</tr>
				<tr>
					<td>DOB</td>
					<td><input type="text" name="dob" value='.$row['dob'].'></td>
				</tr>
				<tr>
					<td>Display Pic Url</td>
					<td><input type="text" name="display_pic_url" value='.$row['display_pic_url'].'></td>
				</tr>
				<tr>
					<td>Fave Perfume</td>
					<td><input type="text" name="perfume" value='.$row['perfume'].'></td>
				</tr>
				<tr>
					<td width="50%"> DisplayName </td>
					<td><input type="text" name="display_name" value='.$row['display_name'].'></td>
				</tr>'.
				/*
				<tr>
					<td>Age </td>
					<td><input type="text" name="age"></td>
				</tr>'.
				<tr>
					<td>DOB (dd-mm-yyyy)</td>
					<td>
						<input type="text" size="4" name="date"> - 
						<input type="text" size="4" name="month"> - 
						<input type="text" size="4" name="year">
					</td>
				</tr>
				*/
				'<tr>
					<td>Email </td>
					<td>'.$row['email'].'</td>
				</tr>
				<tr>
					<td width="50%">Web URL</td>
					<td><input type="text" name="url" value='.$row['url'].'></td>
				</tr>
				<tr>
					<td>Sex</td>
					<td>
						<select name="sex">';
						
						$options = array( ""=>"Select", "m"=>"Male", "f"=>"Female", "o"=>"Special");
						$ht = "";
							foreach($options as $k => $v)
							{
								$sel = ($k == $row['sex'] ) ? "selected" : "";
								$ht .= "<option value='$k' $sel>$v</option>";
							}
							
							echo $ht .'
						</select>
					</td>
				</tr>
			</table>
			<br />
			<br />
			<center>
				<input type="submit" id="modprof" name="modprof" value="Modify Profile">
			</center>
		</form>
	';
	
}


?>
