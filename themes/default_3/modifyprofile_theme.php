<?php

// if not defined

//modifyprofile_theme();

function modifyprofile_theme()
{
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user, $privs, $row;
	global $q, $qe, $l;
	
	error_handler($errors);
	
	if( !empty($errors) )
	{
		return false;
	}
	
	if( !userLoggedIn() )
		return false;
	
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
	
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	
	echo '
		<form method="post" action="">
			<table class="disp_table" id="disp_table" align="center" width="100%">
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['usrnm'].'</td>
					<td '.$cssTdClassNm.'>'.$row['username'].'</td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['abt'].'</td>
					<td '.$cssTdClassNm.'><textarea name="about" rows="7" cols="40">'.$row['about'].'</textarea></td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['dob'].'</td>
					<td '.$cssTdClassNm.'><input type="text" name="dob" value='.$row['dob'].'></td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['dp_url'].'</td>
					<td '.$cssTdClassNm.'><input type="text" name="display_pic_url" value='.$row['display_pic_url'].'></td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['fav_perf'].'</td>
					<td '.$cssTdClassNm.'><input type="text" name="perfume" value='.$row['perfume'].'></td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'width="50%">'.$l['dp_nm'].'</td>
					<td '.$cssTdClassNm.'><input type="text" name="display_name" value='.$row['display_name'].'></td>
				</tr>'.
				/*
				<tr '.$cssTrClassNm.'>
					<td>'.$l['age'].'</td>
					<td><input type="text" name="age"></td>
				</tr>'.
				<tr '.$cssTrClassNm.'>
					<td>DOB (dd-mm-yyyy)</td>
					<td>
						<input type="text" size="4" name="date"> - 
						<input type="text" size="4" name="month"> - 
						<input type="text" size="4" name="year">
					</td>
				</tr>
				*/
				'<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['email'].'</td>
					<td '.$cssTdClassNm.'>'.$row['email'].'</td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'width="50%">'.$l['web_url'].'</td>
					<td '.$cssTdClassNm.'><input type="text" name="url" value='.$row['url'].'></td>
				</tr>
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>'.$l['sex'].'</td>
					<td '.$cssTdClassNm.'>
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
				<input class="mun-button-default" type="submit" id="modprof" name="modprof" value="Modify Profile">
			</center>
		</form>
	';
	
}


?>
