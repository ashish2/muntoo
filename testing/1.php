<?php

// Including the major required files
include_once('../config.php'); 
include_once($rootdir . '/functions/func.php');

// DBCONN
include_once($rootdir . '/functions/dbconn.php');

// connecting db
dbconn();


// testing for return value of mysql_insert_id()
// fire an INSERT query here.


// testing some functions 
// !in_array('mod_security', apache_get_modules()) ? 'not' : 'yes';

if(!function_exists('make_mysql'))
	echo 'Y';
else
	echo 'N';

//printrr($_SERVER);
//$host = 'http://'.(empty($_SERVER['HTTP_HOST']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST']);
//$host = $host . dirname($_SERVER['SCRIPT_NAME']);
//echo $host;


?>
