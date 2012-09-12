<?php

// if not defined

function sendMessage_theme()
{
	
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user;
	global $par;
	global $db;
	global $l;
	
	error_handler($error);
	
	echo '
		<form method="post" action="" name="form1">
			<table align="center" width="90%" border="0">
				<tr>
					<td width="30%">'.$l['to'].'</td>
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
					<td>'.$l['subj'].'</td>
					<td><input type="text" name="subject"> </td>
				</tr>
				<tr>
					<td>'.$l['body'].'</td>
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
