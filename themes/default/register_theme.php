<?php

// if not defined

//register_theme();

function register_theme()
{
	global $globals, $mysql, $done, $error;
	global $l;
	
	error_handler($error);
	
	if( $done )
	{
		echo $l['thanks'] . '<a href="index.php?action=login">Login</a> here';
	}
	else
	{
	
		echo '
			<form action="" method="post">
				<table align="center">
					<tr>
						<td width="70%"> Username </td>
						<td><input type="text" name="username"> </td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="password"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email"> </td>
					</tr>
					<tr>
						<td>Website Url</td>
						<td><input type="text" name="url"> </td>
					</tr>
				</table>
				<center><input type="submit" name="sub_register" value="Register"></center>
			</form>
		';
	}
	
}



?>
