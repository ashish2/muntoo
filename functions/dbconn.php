<?php

function dbconn( $conArr = array() )
{
	global $globals, $error, $l;
	global $par;
	global $db;
	
	$l['cud_nt_sel_db'] = 'Cud not select DB';
	
	$db['host'] = ( isset($conArr['host'] ) ? $conArr['host'] :  $globals['host'] );
	$db['dbuser'] = ( isset( $conArr['dbuser'] ) ? $conArr['dbuser'] : $globals['dbuser'] );
	$db['dbpass'] = ( isset( $conArr['dbpass'] ) ? $conArr['dbpass'] :  $globals['dbpass'] );
	$db['dbname'] = ( isset( $conArr['dbname'] ) ? $conArr['dbname'] :  $globals['dbname'] );
	
	$dbconn = mysql_connect($db['host'] , $db['dbuser'] , $db['dbpass'] ) or die('DB Connection could not be established.<br />ErrorNo: '.mysql_errno() . '<br />Error: ' .mysql_error());
	$seldb = mysql_select_db($db['dbname'], $dbconn) or $error['cud_nt_sel_db'] = $l['cud_nt_sel_db'];
	
	//return $seldb;
	
}


?>
