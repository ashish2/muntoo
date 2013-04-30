<?php

// if not defined

//register_theme();

function forgot_password_theme()
{
	global $globals, $mysql, $done, $error, $errors, $notice;
	global $l;
	global $show, $done;
	
	// dont do echbr(), very bad practice, instead just call, php language construct, echo '<br />'
	// calling a function instead of a language construct will slow down your php
	//echbr();
	echo '<br />';
	
	error_handler($error);
	error_handler($errors);
	
	notice_handler($notice);
	
	$str = '';
	// if exists, then 'email exists' error, etc. (still to put)
	if( !$done )
	{
		$str .= '
			<form action="" method="post">
				<table align="center">
				';
				/*
					<tr>
						<td width="70%">'.$l['usrnm'].'</td>
						<td><input type="text" name="username"> </td>
					</tr>
					* */
					
					$em = (isset($_GET['e']) ? $_GET['e'] : '');
					$str .= '
					<tr>
						<td>'.$l['email'].'</td>
						<td><input type="text" name="email" value="'.$em.'"> </td>
					</tr>
					';
					if($show)
					{
						$str .= '
						<tr>
							<td>'.$l['pass'].'</td>
							<td><input type="text" name="password"></td>
						</tr>
						';
					}
					/*
					<tr>
						<td>'.$l['web_url'].'</td>
						<td><input type="text" name="url"> </td>
					</tr>
					* */
					$str .= '
				</table>
				<center><input type="submit" name="sub_register" value="Confirm"></center>
			</form>
		';
	}
	
	echo $str;
	
}



?>
