<?php

function log_mysql_error($query)
{
	
	$my_errno = mysql_errno();
	$my_err = mysql_error();
	$q = "INSERT INTO `mysql_error_logs` (`mysql_errno`, `mysql_error`, `query`) VALUES($my_errno, \"$my_err\", \"$query\" )";
	$qu = mysql_query($q);
	
	return mysql_insert_id();
}


?>
