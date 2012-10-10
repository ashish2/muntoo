<?php

// if not defined

//register_theme();

function register_theme()
{
	global $globals, $mysql, $done, $error;
	global $l;
	
	error_handler($error);
	
	// if exists, then 'email exists' error, etc. (still to put)
	if( $done )
	{
		echo $l['thanks'] . '<a href="index.php?action=login">'.$l['login'].'</a> here';
	}
	else
	{
	
		echo '
			<form action="" method="post">
				<table align="center">
					<tr>
						<td width="70%">'.$l['usrnm'].'</td>
						<td><input type="text" name="username"> </td>
					</tr>
					<tr>
						<td>'.$l['pass'].'</td>
						<td><input type="text" name="password"></td>
					</tr>
					<tr>
						<td>'.$l['email'].'</td>
						<td><input type="text" name="email"> </td>
					</tr>
					<tr>
						<td>'.$l['web_url'].'</td>
						<td><input type="text" name="url"> </td>
					</tr>
				</table>
				<center><input class="mun-button-default" type="submit" name="sub_register" value="Register"></center>
			</form>
		';
	}
	
}



?>
