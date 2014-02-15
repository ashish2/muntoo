<?php

function log_mysql_error($query)
{
	
	$my_errno = mysql_errno();
	$my_err = mysql_error();
	$q = "INSERT INTO `mysql_error_logs` (`mysql_errno`, `mysql_error`, `query`) VALUES($my_errno, \"$my_err\", \"$query\" )";
	$qu = mysql_query($q);
	
	return mysql_insert_id();
}


// Last Activity happened just rite now, for this User
// Will fire only if the User is logged in
function lastActivityRightNow()
{
	global $globals, $time, $user;
	
	$now = round($time->start);
	
	$q = "UPDATE `users` SET `last_activity`= $now WHERE `uid` = $user[uid]";
	$updateLastActivity = db_query($q);
}


// NOT NICE SOLUTION AS
// ON EVERY PAGELOAD,
// ALL USER ROWS GET UPDATED,
// ONLY FTM
// SHOULD BE CHANGED LATER!!! TO A BETTER SOLUTION
// Get Who is active & who isn't,,
// and set all those ppl inactive & log them out,
// if they showing inactive for a long time.
function whoIsActive()
{
	global $globals, $time;
	
	$admin = array();
	$admin['allowed_last_activity_timespan'] = 15; // 15 mins
	
	$now = round($time->start);
	$allowed = $admin['allowed_last_activity_timespan'] * 60;
	
	$timeGap = $now - $allowed;
	
	$q = "UPDATE `users` SET `is_online`= 0 WHERE `last_activity` < $timeGap  OR `last_activity` IS NULL";
	$users_online = db_query($q);
}

?>
