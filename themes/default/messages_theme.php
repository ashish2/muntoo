<?php

// if not defined

function sendMessage_theme()
{
	
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user;
	global $par;
	global $db;
	
	error_handler($error);
	
	echo '
		<form method="post" action="" name="form1">
			<table align="center" width="90%" border="0">
				<tr>
					<td width="30%"> To: </td>
					<td><input type="text" name="to"> </td>
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
					<td>Subject: </td>
					<td><input type="text" name="subject"> </td>
				</tr>
				<tr>
					<td>Body:</td>
					<td><textarea rows="15" cols="60" name="body"></textarea> </td>
				</tr>
			</table>
			<br />
			<br />
			<center>
				<input type="submit" id="sendMess" name="sendMess" value="Send Message">
			</center>
		</form>
	';
	
}


?>
