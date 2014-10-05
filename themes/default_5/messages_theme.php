<?php

// if not defined

function sendMessage_theme()
{
	
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user;
	global $par;
	global $db;
	global $l, $notice;
	
	error_handler($error);
	notice_handler($notice);

	if( !userLoggedIn() )
		return false;
	
	echo '
		<form method="post" action="" name="form1">
			<table align="center" width="90%" border="0">
				<tr>
					<td width="30%">'.$l['to'].'</td>
					<td><input type="text" name="to"> <small>(to: username here)</small></td>
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
				<input type="submit" id="sendMess" name="submit" value="Send Message" class="mun-button-default">
			</center>
		</form>
	';
	
}

function viewMessage_theme()
{
	
	global $globals, $mysql, $theme, $done, $error, $errors;
	global $user;
	global $par;
	global $db;
	global $l, $qe, $notice;
	
	error_handler($error);
	notice_handler($notice);
	
	if( !userLoggedIn() )
		return false;
	
	// Loop for InBox
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-wp_post-tr"';
	$cssTdClassNm = 'class="dth-wp_post"';
	
	if($qe[1])
	{
		echo '
			<center>
			INBOX:
			
			<table class="disp_table" id="disp_table">
				<thead>
					<tr id="disp_table">
						<th '.$cssThClassNm.'>
							'.$l['pm_id'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['sent_by'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['subject'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['body'].'
						</th>
					</tr>
				</thead>
			';
		for(; $i = mysql_fetch_assoc($qe[1]); )
		{
			
			echo '
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>
						'.$i['pm_id'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['pm_from_name'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['pm_subject'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['pm_body'].'
					</td>
				</tr>';
		
		}
		
		echo '
			</table>
			</center>
		';
	
	}
	else
	{
		noData();
	}
	
	
	// Loop for OUTBOX
	// ADD another column in table,
	// PM sent to
	// all the reciepinets of this PM
	if($qe[2])
	{
		echo '
			<center>
			OUTBOX:
			
			<table class="disp_table" id="disp_table">
				<thead>
					<tr id="disp_table">
						<th '.$cssThClassNm.'>
							'.$l['pm_id'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['sent_by'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['subject'].'
						</th>
						<th '.$cssThClassNm.'>
							'.$l['body'].'
						</th>
					</tr>
				</thead>
			';
		for(; $i = mysql_fetch_assoc($qe[2]); )
		{
			echo '
				<tr '.$cssTrClassNm.'>
					<td '.$cssTdClassNm.'>
						'.$i['pm_id'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['pm_from_uid'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['pm_subject'].'
					</td>
					<td '.$cssTdClassNm.'>
						'.$i['pm_body'].'
					</td>
				</tr>';
		
		}
		
		echo '
			</table>
			</center>
		';
	
	}
	else
	{
		noData();
	}
	
	
}



?>
