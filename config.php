<?php 
$globals["host"] = $host = 'localhost'; 
$globals["dbuser"] = $dbuser = 'root'; 
$globals["dbpass"] = $dbpass = ''; 
//$globals["dbname"] = $dbname = 'myforum_3'; 
$globals["dbname"] = $dbname = 'myforum_3_1'; 
$globals["rootdir"] = $rootdir = '/opt/lampp/htdocs/www/forums/myForum/3'; 
$globals["boarddir"] = $boarddir = '/opt/lampp/htdocs/www/forums/myForum/3'; 
$globals["cachedir"] = $cachedir = '/opt/lampp/htdocs/www/forums/myForum/3/cache'; 
$globals["sourcedir"] = $sourcedir = '/opt/lampp/htdocs/www/forums/myForum/3/sources'; 
$globals["themedir"] = $themedir = '/opt/lampp/htdocs/www/forums/myForum/3/themes'; 
$globals["boardurl"] = $boardurl = 'http://localhost/www/forums/myForum/3'; 
//$ip = file_get_contents("http://automation.whatismyip.com/n09230945.asp");
//$globals["boardurl"] = $boardurl = 'http://'.$ip.'/www/forums/myForum/3'; 
$globals["cookiename"] = $cookiename = 'MFCOOKIE3'; 

// Will have to write the below things in this file at installation
// extra added
$globals["ind"] = $globals["boardurl"]."/index.php?";
$globals["only_ind"] = "/index.php?";
$globals["funcdir"] = $funcdir = '/opt/lampp/htdocs/www/forums/myForum/3/functions'; 

// Only for the moment, will be removed later.
// Extra added Admin specifications
// Admin settings will come from settings table of admin
$admin['settings']['ai'] = 1;
// Single file for Languages as in all languages function kept in single file, 
// or multiple file for multiple functions
//$admin['settings']['lang']['func_run'] = 'sing';
$admin['settings']['lang']['func_run'] = 'mult';

// Now we are using $_SESSION["user"] for user details
// for the moment
/*
 * $user['uid'] = 1;
$user['admin'] = 1;
$user['lang'] = 'en_US';
$user['email'] = 'a@a.com';
// lets keep for the moment, user selected lang as 'en' as default
$user['theme_lang'] = 'en';
*/
//$user['theme_type'] = 'default';
///$user['theme_type'] = 'black';
//$user['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
//$user['ip'] = $_SERVER['REMOTE_ADDR'];
//echo "user: ". $user['REMOTE_ADDR'];

/*
$user['ipv6'] = 0;
*/

// extra added
// DB Specifications
$db = array();
$db['type'] = 'mysql';



?>
