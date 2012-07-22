<?php

// Including the major required files
include_once('config.php'); 
include_once($rootdir . '/functions/func.php');

// DBCONN
include_once($rootdir . '/functions/dbconn.php');

// connecting db
dbconn();


// testing for return value of mysql_insert_id()
// fire an INSERT query here.



?>
