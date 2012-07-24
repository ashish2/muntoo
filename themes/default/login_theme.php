<?php

// if not defined

//register_theme();

function login_theme()
{
	
	
	
	global $globals, $mysql, $done, $error, $errors;
	global $l;
	
	error_handler($error);
	
	if( $done )
	{
//		echo $l['thanks'] . '<a href="index.php?action=login">Login</a> here';
		echo 'You will now be redirected to Index page';
	}
	else
	{
	
		echo '<center>';
		echo '<b>Admin login.<br />Username: admin<br />Pass: pass <br /><br />';
		echo 'Test User login.<br />Username: a3u<br />Pass: a3p</b><br /><br /><br />';
		echo '
			<form action="" method="post">
				<table align="center">
					<tr>
						<td width="70%"> Username/Email </td>
						<td><input type="text" name="email"> </td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password"></td>
					</tr>
				</table>
				<br />
				<center><input type="submit" name="sub_register" value="Login"></center>
			</form>
			</center>
		';
	}
	
	
}



?>
