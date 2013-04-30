<?php

function dbconn( $conArr = array() )
{
	global $globals, $error, $l;
	global $par;
	global $db;
	
	$l['cud_nt_sel_db'] = 'Cud not select DB';
	
	//$db['host'] = ( isset($conArr['host'] ) ? $conArr['host'] :  $globals['host'] );
	$db['dbhost'] = ( isset($conArr['dbhost'] ) ? $conArr['dbhost'] :  $globals['dbhost'] );
	$db['dbuser'] = ( isset( $conArr['dbuser'] ) ? $conArr['dbuser'] : $globals['dbuser'] );
	$db['dbpass'] = ( isset( $conArr['dbpass'] ) ? $conArr['dbpass'] :  $globals['dbpass'] );
	$db['dbname'] = ( isset( $conArr['dbname'] ) ? $conArr['dbname'] :  $globals['dbname'] );
	
	//$dbconn = mysql_connect($db['host'] , $db['dbuser'] , $db['dbpass'] ) or die('DB Connection could not be established.<br />ErrorNo: '.mysql_errno() . '<br />Error: ' .mysql_error());
	$dbconn = mysql_connect($db['dbhost'] , $db['dbuser'] , $db['dbpass'] ) or die('DB Connection could not be established.<br />ErrorNo: '.mysql_errno() . '<br />Error: ' .mysql_error());
	$seldb = mysql_select_db($db['dbname'], $dbconn) or $error['cud_nt_sel_db'] = $l['cud_nt_sel_db'];
	
	//return $seldb;
	
}

function pdo_func($conArr = array())
{
	global $globals, $error, $l;
	global $par;
	global $db;
	
	global $pdo_dbh;
	
	// PDO DB Handler
	$db['dbhost'] = ( isset($conArr['dbhost'] ) ? $conArr['dbhost'] :  $globals['dbhost'] );
	$db['dbuser'] = ( isset( $conArr['dbuser'] ) ? $conArr['dbuser'] : $globals['dbuser'] );
	$db['dbpass'] = ( isset( $conArr['dbpass'] ) ? $conArr['dbpass'] :  $globals['dbpass'] );
	$db['dbname'] = ( isset( $conArr['dbname'] ) ? $conArr['dbname'] :  $globals['dbname'] );
	
	// Instantiating PDO DB object
	$pdo_dbh = new PDO('mysql:dbname='.$db['dbname'].';host='.$db['dbhost'], $user, $password);
	
	// Long Way
	/*
	$stmt = $pdo_dbh->prepare('INSERT INTO REGISTRY (name, value) VALUES (:name, :value)');
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':value', $value);
	// insert one row
	$name = 'one';
	$value = 1;
	$stmt->execute();
	*/
	
	// Short Way
	/*
	$stmt = $dbh->prepare('UPDATE people SET name = :new_name WHERE id = :id');
	$stmt->execute( array('new_name' => $name, 'id' => $id) );
	*/
	
}

?>
