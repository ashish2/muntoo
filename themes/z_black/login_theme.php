<?php

// if not defined

//register_theme();

function login_theme()
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
				<div class="fieldContainer">
					
					<div class="formRow">
						<div class="label">
							<label for="name">Name: </label>
						</div>
						<div class="field">
							<input type="text" name="name">
						</div>
						
					</div>
					
				</div>
				
				<div class="signupButton">
					<center>
						<input type="submit" name="sub_register" value="Login">
					</center>
				</div>
				
			</form>
		';
		
		
		
		
		
		
		
		/*
		echo '
			<form action="" method="post">
				<table align="center">
					<tr>
						<td width="70%"> Username/Email </td>
						<td><input type="text" name="email"> </td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="password"></td>
					</tr>
				</table>
				<br />
				<center><input type="submit" name="sub_register" value="Login"></center>
			</form>
		';
		*/
		
	}
	
}



?>
