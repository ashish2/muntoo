<?php
// error_reporting(E_ALL & ~E_NOTICE);
error_reporting(-1);

$mc = new Memcached();
$mc->addServer("localhost", 11211);

$mc->set("foo", "Hello!");
$mc->set("bar", "Memcached...");

$arr = array(
	$mc->get("foo"),
	$mc->get("bar")
);

// var_dump($arr);

print_r( $arr);


?>
