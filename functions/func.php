<?php

// print_r Reformatted
function printrr($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	
}

// func printrr() as Anonymous(Lambda) function
$prr = function ($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
};

// Closure Eg.1, func adder() as a Closure, (not used yet)
function adder($x)
{
	//echo 'in: ' . $x;
	return function($y) use ($x)
	{
		return $x+$y;
	};
};
//$a = adder(2, 3);
//printrr($a);
//echo ($a(3));

// Closure Eg.2, func adder() as a Closure, (not used yet)
function adder2($x, $z)
{
	//echo 'in: ' . $x;
	return function($y) use ($x, $z)
	{
		return $x+$y+$z;
	};
};
//$a = adder2(2, 5);
//printrr($a);
//echo ($a(4));


function ech($str, $file=null)
{
	if($file) echo "<br />File: " . $file . "<br />"; 
	echo "<br />String: " . $str . "<br />";
}

//************************************************************//
// Random String Generators     //
//************************************************************//

// Generate a random string of a particular length
function genRandString($maxlen)
{
	$str = '';
	$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$maxnum = strlen($chars) - 1;
	
	for($i = 0; $i < $maxlen; $i++)
	{
		$str .= $chars[mt_rand(0, $maxnum)];
	}
	
	return $str;
}


function randLetter($maxlen, $str='')
{
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	
	for($i = 0; $i<$maxlen; $i++)
	{
		$rand_letter = rand(0, 61);
		$str .= $chars[$rand_letter];
		
	}
	
	return (string) $str;
	
}


//************************************************************//
// Random String Generators end //
//************************************************************//


//************************************************************//
// String Functions starts //
//************************************************************//

// No real usage of this, as there are already a str_replace() & preg_replace() funcs in PHP
/*
function findRepInStr($findStr, $repStr, $inpStr)
{
	
}
*/


//************************************************************//
// String Functions end //
//************************************************************//



//************************************************************//
//  Form Functions starts //
//************************************************************//

// SQL attacks prevention
function un_sql_inj($string)
{
	if(preg_match("/[\'\"]+/", $string))
	{
		$string = str_replace(array("'", '"'), "", $string);
	}
	
	return (string) $string;
	
}

// Checking input for sql attacks etc, to put into the DB or show on page etc
function check_input($data)
{
	
	//echo !get_magic_quotes_gpc();
	
	$data = trim($data);
	//$data = stripslashes($data);
	if( !get_magic_quotes_gpc() )
	{
		$data = addslashes( $data );
	}
	$data = htmlspecialchars($data);
	
	return $data;
}

// this will most of the times be read from DB (will come from DB), so that we can show on our page without tension. lol :P
function uncheck_input( $data )
{
	
	$data = htmlspecialchars_decode($data);
	$data = stripslashes($data);
	
	return $data;
}

// Mandatory Form Fields
function mandff($field, $err='')
{
	global $error;
	
	if(empty($field))
	{
		$error[] = $err;
//		return $error;
	}
	
	return $field;
}

// Optional Form Fields
function optff($field)
{
	if(empty($field))
	{
		return '';
	}
	
	return $field;
}

// Strip tags with allowed tags. 
// @param (string) $data is a string
// @param (string or array) $allowed is a string with allowable tags, which will not to be stripped, eg. $allowed = "<b><a><i><br>"
function strip_tags_alwd( $data, $allowed )
{
	if( is_array( $allowed ) )
	{
		$allowed = implode( "" , $allowed );
	}
	$data = strip_tags( $data, $allowed );
	
	return $data;
}


//************************************************************//
//   Form Functions end //
//************************************************************//


//************************************************************//
//   DB Functions starts //
//************************************************************//


function db_query($query)
{
	global $error, $errors, $db;
	
	if($db['type'] == 'mysql')
	{
		// or $error die("Cud not")
		$q = mysql_query($query) ; //or die("dead"); //or $error[] = "Could not execute the query: <br />" . $query . "<br /> " . "Error: " . mysql_error() . " " . mysql_errno();
		
		if( !is_resource($q) && !is_bool($q) )
		{
			$error[] = "Could not execute the query: <br />" . $query . "<br /> " . 
			"Error: " . mysql_error() . " " . mysql_errno();
		}
		
		return $q;
	}
	
}

function insert_one($table, $val)
{
//	return $db->db_query("INSERT INTO $table VALUES ($val)");
	return mysql_query("INSERT INTO $table VALUES ($val)");
}


/*
$arr = array(
				"keys" => array( "rbody", "topic_id", "poster_users_id", "date", "user_ip") , 
				"values" => array( 
										array( "$reply", "$_GET[topic]", "$user[uid]", round( $time->scriptTime() ), "$_SERVER[REMOTE_ADDR]" ),
										array( "$reply", "$_GET[topic]", "$user[uid]", round( $time->scriptTime() ), "$_SERVER[REMOTE_ADDR]" ),
										array( "$reply", "$_GET[topic]", "$user[uid]", round( $time->scriptTime() ), "$_SERVER[REMOTE_ADDR]" )
									)
					);
*/

function db_insert_id()
{
	return mysql_insert_id();
}

function db_insert_arr($table, $valarr)
{
	
	if( !is_array($arr['values']['0']) )
	{
		$new['values']['0'] = $arr['values'];
		$arr['values'] = $new['values'];
	}
	
	$vals = array();
	$keys = '(`' . join( '`,`', $arr['keys'] ) .'`)';
	
	foreach( $arr['values'] as $k => $v )
	{
		
//		$vals[] = '(\'' . join('\', \'', $v ) . '\')';
		$vals[] = "(\"" . join("\", \"", $v ) . "\")";
		
	}
	
	$vals = implode(', ', $vals );
	
	$sql = 'INSERT INTO ' . $table . ' ' . $keys . ' VALUES ' . $vals;
	//echo $sql;
	
	return $sql;
}

/*
function update_arr( $params = array() )
{
	#make it uniform (for insert, if only an pure array given)
	if(!is_array($params['values']['0']))
	{
		$new['values']['0']=$params['values'];
		$params['values']= $new['values'];
	}

	$sets=array();
      $i=0;
      foreach($params['values']['0'] as $k=>$v){
          $sets[]='`'.$params['keys'][$i].'`=\''.$v.'\'';
           $i++;
      }
       return $sql='SET '.implode(', ',$sets);

     }
     return false;
}

*/



//************************************************************//
//   DB Functions ends //
//************************************************************//


//************************************************************//
//   Error Handling Functions //
//************************************************************//
//Ori
//function error_handler($error)
//Add
function error_handler($error)
{
	
	//global $globals, $error;
	global $globals, $user, $theme;
	
	if(!empty($error))
	{
		
		if(!is_array($error) )
		{
			$error = array($error);
		}
		
		$str = '';
		
		$str .= 
		// Just CANNOT put any HTML here no matter what, this is a FUNCTIONS file, not a template showing HTML file
		// U need to just check for errors and return(return/pass back) an array, and then 
		// write all this below html in the respective HTML file of that particular page
		//'<div style="background-color: lightgrey; padding: 2px 2px; border: 1px solid gray">
		// snow color #EEE9E9
		'<div class="errors">'.
		// lightred #ffe4e9
		//'<div style="background-color: #ffe4e9; padding: 3px 1px; border: 1px solid #cc3344">
				'<center>';
				//$img = ( ($imgName) ? '<img src="themes/'.$user['theme_type'].'/images/'.$imgName.'">&nbsp' : '');
			//$err_img = '<span class="error_span">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
			
			//$str .= "The following Errors occurred:";
			//$str .= 'Hey Budd!';
			$str .= 'Eh! O! James Bond!';
			
			$str .= '<br />';
			
			$str .= 'There were a few errors, let\'s check \'em out:';
			
			$str .= '<ul>';
		
		foreach($error as $err)
		{
			$str .= '<li style="color: purple"><small>'.$err.'</small></li>';
		}
		$str .= '</ul>
				</center>
				</div>
				<br />
				<br />
				';
				
		echo $str;
		$str = '';
	}
	
}

function notice_handler($error)
{
	
	//global $globals, $error;
	global $globals, $notice;
	
	$show = 0;
	$str = '';
	$str .= '<div style="background-color: #FBEC5D; padding: 2px 2px; border: 1px solid gray">
			<center>
			Notice:
			<ul>';
			
	//if(!empty($error))
	if(!empty($error) )
	{
		if(!is_array($error) )
		{
			$error = array($error);
		}
		// #FBEC5D
		/*
		$str .= '<div style="background-color: #FBEC5D; padding: 2px 2px; border: 1px solid gray">
				<center>
				Notice:
				<ul>';
		*/
		
		foreach($error as $err)
		{
			$str .= '<li style="color: purple"><small>'.$err.'</small></li>';
		}
		$show = 1;
	}
	
	//$_SESSION['notice'] = ( is_array( $_SESSION['notice']) ? $_SESSION['notice'] : array() )
	if( isset($_SESSION['notice'] ) && !empty($_SESSION['notice']) )
	{
		foreach( $_SESSION['notice'] as $k => $v)
		{
			$str .= '<li style="color: purple"><small>'.$v.'</small></li>';
		}
		
		$_SESSION['notice'] = null;
		$show = 1;
	}
	
	$str .= '</ul>
			</center>
			</div>
			<br />
			<br />
			';
	
	if( $show )
		echo $str ;
	
	$str = '';
	$show = null;
	
}


//************************************************************//
//   Error Handling Functions end //
//************************************************************//

//************************************************************//
//   Error Logging //
//************************************************************//

// Write errors in a file
// will check for the size of the error log file first, for 5MB of size
// if it is above 5mb, it will create another file & write errors, else will write in the same file
function errorLogging($array = array(), $format="s_s")
{
	global $rootdir;
	
	//#// echo "rotdir: ".$rootdir . "/logs/error.logs";
	
	// First check for size of error.logs file, >= 5MB 
	//#// if( filesize( ) >= 5000000 )
	{
		//#// changeFNWtTdyTs(  );
	}
	
	
	
}


//************************************************************//
//   Error Logging end //
//************************************************************//


//************************************************************//
//   Setting Some Defaults //
//************************************************************//

function setSomeDefaults_User()
{
	global $user;
	
	// This line will overwrite any $user assignement before this function, 
	$user = ( isset($_SESSION['user'] ) ? $_SESSION['user'] : array() );
	
	/*
	// This will not overwrite any previous $user assignment
	if(isset($_SESSION['user']))
		foreach($_SESSION['user'] as $k => $v)
			$user[$k] = $_SESSION['user'][$k];
	*/
	
	// a few things that can be used in the setSomeDefaults function, or else,
	// supposed to be used from the select query for user from DB
	// REMOVE IT LATER, bcoz u have to take this values from DB
	$user['ip'] = $_SERVER['REMOTE_ADDR'];
	
	// Temporary setting theme as 'smashing_magazine', will be removed later
	$user['theme_type'] = 'default';
	// Ori
	$user['theme_type'] = 'default_2';
	// FTM
	$user['theme_type'] = 'default_3';
	
	//$user['theme_type'] = 'smashing_magazine';
	//$user['theme_type'] = 'theme_4';
	
	$user['theme_type'] = ( isset($user['theme_type'] )  ) ? $user['theme_type'] : 'default';
	$user['lang'] = ( isset($user['lang'] )  ) ? $user['lang'] : 'en_US';
	
	//printrr($user);
	
}

//************************************************************//
//   Setting Some Defaults ends //
//************************************************************//


//************************************************************//
//   Everything to do with Files //
//************************************************************//

function openAndWriteInFile( $filename, $string, $mode )
{
	$fp = fopen( $filename, $mode );
	fwrite( $fp, $string );
	fclose( $fp );
}

// change File Name With Todays Timestamp
function changeFNWtTdysTs( $filename )
{
	
	$fileNArr = array();
	$fileNArr = explode(".", $filename );
	
	$newFN = "";
	$newFN = $fileNArr[0] . date("D-M-j-Y--G:i:s") . $fileNArr[1];
	
	$fileNArr = null;
	
	shell_exec( "mv $filename $newFN" );
	
	$filename = null;
	$newFN = null;
	
}


//************************************************************//
//   Everything to do with Files ends //
//************************************************************//

//************************************************************//
//   Things to do with Numbers //
//************************************************************//

// if greater than this number, if $num1 > $num2
function ifGreaterThan( $num1, $num2 )
{
	return ($num1 > $num2); 
}

function ifGreaterThanEq( $num1, $num2 )
{
	return ($num1 >= $num2); 
}

function ifLessThan( $num1, $num2)
{
	return ($num1 < $num2); 
}

function ifLessThanEq( $num1, $num2)
{
	return ($num1 <= $num2); 
}

function assignANumber( $num )
{
	return $num;
}


//************************************************************//
//   Things to do with Numbers ends //
//************************************************************//


//************************************************************//
//   HTML Formatting functions //
//************************************************************//

function echbr( $number=1)
{
	//$number = ( ifLessThanEq($number, 10 ) ? $number : 10 ) ;
	$number = ( $number <= 10 ) ? $number : 10;
	
	$i = 0;
	while( $i < $number )
	{
		echo "<br />";
		$i++;
	}
}

//************************************************************//
//   HTML Formatting functions ends //
//************************************************************//


//************************************************************//
//   Everything to do with Languages //
//************************************************************//

// loadlang_new() func
function loadlang_new($langfile = '', $langfunc='')
{
	global $globals, $theme;
	global $user;
	global $l;
	
	// $lang = (!empty($langfile) ? $langfile : $theme['name']);
	$langFile = (($langfile) ? $langfile : $theme['name']);
	//$langFunc = (($langfunc) ? $langfunc : $theme['func']);
	$langFunc = (($langfunc) ? $langfunc : $theme['name']);
	
	// Including the lang file, so that we can call the lang func later in the next step.
	//include_once($globals['rootdir'] . '/languages/' . $user['lang'] .'/'. $theme['name'] .'_lang.php');
	include_once($globals['rootdir'] . '/languages/' . $user['lang'] .'/'. $langFile .'_lang.php');
	// Calling the lang func
	
	$globals['rootdir'] . '/languages/' . $user['lang'] .'/'. $langFile .'_lang.php';
	
	$langFunc = $langFunc.'_lang';
	$langFunc();
	
}

// Original loadlang() func
function loadlang_ori($langdir = "", $langfile = '')
{
	global $globals, $theme;
	global $user;
	global $l;
	
	$langdir = (!empty($langdir) ? $langdir : "");
	$lang = (!empty($langfile) ? $langfile : $theme['name']);
	
//	include_once($globals['rootdir'] . '/languages/' . $user['lang'] .'/'. $theme['name'] .'_lang.php');
	$globals['rootdir'] . '/languages/' . $user['lang'] .'/'. $lang .'_lang.php';
	
	// include_once($globals['rootdir'] . '/languages/' . $user['lang'] .'/'. $lang .'_lang.php');
	include_once($globals['rootdir'] . '/languages/' . $user['lang'] .'/'. "$langdir" . $lang .'_lang.php');
	
}

// New loadlang() func
// Which loadlang() function to run, taking it from the $admin[settings][lang][func_run]
// $admin[settings][lang][func_run] = sing or mult , for single lang File or multiple lang File
function loadlang($langfile = '', $langfunc='')
{
	global $globals, $theme;
	global $user;
	global $l;
	global $admin;
	
	// sing and mult can be compared as 0 or 1, instead of doing string comparison
	// 'sing' =1, 'mult' =2, OR 'sing'=0, 'mult'=1
	if($admin['settings']['lang']['func_run'] == 'sing' )
		loadlang_new($langfile, $langfunc);
	else if( $admin['settings']['lang']['func_run'] == 'mult')
		loadlang_ori();
	
}


//************************************************************//
//   Everything to do with Languages ends //
//************************************************************//


//************************************************************//
//   Array Traversal starts //
//************************************************************//

// Finds key in a MultiDimensional array, 
// & returns the key with its array

$shop = array( array( 'Title' => array("rose", 
										"rose2",
										"rose3"
										),
                      'Price' => 1.25,
                      'Number' => 15 
                    ),
               array( 'Title' => array("daisy", "daisy2", "daisy3"),
                      'Price' => 0.75,
                      'Number' => 25,
                    ),
               array( 'Title' => array("orchid", "orchid2", "orchid3"), 
                      'Price' => 1.15,
                      'Number' => 7 
                    )
             );
             

//printrr($shop);

function key_finder($arr, $key)
{
	$pos = array();
	$new_v = array();
	
	foreach($arr as $k => $v)
	{
		if($k !== $key)
		{
			echo $k .': ' . $v;
			printrr($v);
			
			$new_v[$v];
			//key_finder($v, $key);
		}
		else
		{
			continue;
		}
		
	}
	
	return $new_v;

	
//	$shop[] = $pos;
	
//	printrr($shop);
	
	
}

/*
 * foreach (array_keys($shop) as $k => $v)
{
	echo $k . ' ' . $v . '<br />';
	
}
*/

// echo 'printing';
// printrr(key_finder2($shop, 'Title'));

// echo '<br />';

function key_finder2($a, $subkey) {
   
//   printrr($a);
 //   echo '<br />';
 //  echo 'arr keys';
//   printrr(array_keys($a));
 //  echo '<br />';
   
   	foreach (array_keys($a) as $i=>$k) {
	
	//   echo 'i: ' . $i . ', k: ' . $k . '<br />'; 
      
			if ($k === $subkey) {
	//			echo 'returning';
	//			echo $i;
				return array($i);
			}
		  
			elseif ($pos = key_finder2($a[$k], $subkey)) 
			{
	//			echo '<br />this pos: '; 
	//			print_r($pos);
	//			echo '<br />';
	//			echo 'returning2';
				return array_merge(array($i), $pos);
			}
		}
	
}

function array_tree_search_key($a, $subkey) {
   foreach (array_keys($a) as $i=>$k) {
      if ($k == $subkey) {
         return array($i);
      }
      elseif ($pos = array_tree_search_key($a[$k], $subkey)) {
         return array_merge(array($i), $pos);
      }
   }
}

// printrr(array_tree_search_key($shop, 'Title'));
// array_merge($shop, array('Title'));
// printrr(key_finder($shop, 'Title'));



//************************************************************//
//   Array Traversal ends //
//************************************************************//


//************************************************************//
//   Directory Traversal  //
//************************************************************//

/*
function dir_trav($dir, $recurse = false)
{
	// array to hold return value
	$retval = array();
	// add trailing slash if missing
	if(substr($dir, -1) != "/") $dir .= "/";
	
	// open pointer to directory and read list of files
	$d = @dir($dir) or die("dir_trav: Failed opening directory $dir for reading.");
	while(false !== ($entry = $d->read() ))
	{
		// skip hidden files
		if($entry[0] == ".") continue;
		if(is_dir("$dir$entry"))
		{
			$retval[] = array(
								"name" => "$dir$entry/",
								"type" => filetype("$dir$entry"),
								"size" => 0,
								"lastmod" => filemtime("$dir$entry")
								);
								
			if($recurse && is_readable("$dir$entry/") )
			{
				echo $dir . '<br />';
				$retval = array_merge($retval, dir_trav("$dir$entry/", true) );
			}
		}
		else if( is_readable("$dir$entry") )
		{
			$retval[] = array(
								"name" => "$dir$entry",
								"type" => mime_content_type("$dir$entry"),
								"size" => filesize("$dir$entry"),
								"lastmod" => filemtime("$dir$entry")
								);
		}
		
	}
	$d->close();
	
	return $retval;
	
}
printrr( dir_trav('./') );
*/

// func from 
// http://www.the-art-of-web.com/php/dirlist/
function getFileList($dir, $recurse=false, $depth=false) 
{
	// array to hold return value 
	$retval = array(); 
	// add trailing slash if missing 
	if(substr($dir, -1) != "/") $dir .= "/"; 
	// open pointer to directory and read list of files 
	$d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading"); 
	while(false !== ($entry = $d->read())) 
	{ 
		// skip hidden files 
		if($entry[0] == ".") continue; 
		if(is_dir("$dir$entry")) 
		{ 
			$retval[] = array( "name" => "$dir$entry/", "type" => filetype("$dir$entry"), "size" => 0, "lastmod" => filemtime("$dir$entry") ); 
			if($recurse && is_readable("$dir$entry/")) 
			{ 
				if($depth === false) 
				{ 
					$retval = array_merge($retval, getFileList("$dir$entry/", true)); 
				} 
				elseif($depth > 0) 
				{ 
					$retval = array_merge($retval, getFileList("$dir$entry/", true, $depth-1)); 
				} 
			} 
		} 
		elseif(is_readable("$dir$entry")) 
		{ 
			$retval[] = array( "name" => "$dir$entry", "type" => mime_content_type("$dir$entry"), "size" => filesize("$dir$entry"), "lastmod" => filemtime("$dir$entry") ); 
		} 
	} 
	$d->close(); 
	return $retval; 
}
//printrr ( getFileList('./') );

/*
function fn_filelist($startdir="./", $searchSubdirs=1, $directoriesonly=0, $maxlevel="all", $level=1) {
   //list the directory/file names that you want to ignore
   $ignoredDirectory[] = ".";
   $ignoredDirectory[] = "..";
   $ignoredDirectory[] = "_vti_cnf";
   global $directorylist;    //initialize global array
   if (is_dir($startdir)) {
       if ($dh = opendir($startdir)) {
           while (($file = readdir($dh)) !== false) {
               if (!(array_search($file,$ignoredDirectory) > -1)) {
                 if (filetype($startdir . $file) == "dir") {
                     
					   //build your directory array however you choose;
                       //add other file details that you want.
					   
                       $directorylist[$startdir . $file]['level'] = $level;
                       $directorylist[$startdir . $file]['dir'] = 1;
                       $directorylist[$startdir . $file]['name'] = $file;
                       $directorylist[$startdir . $file]['path'] = $startdir;
                       if ($searchSubdirs) {
                           if ((($maxlevel) == "all") or ($maxlevel > $level)) {
//							   echo 'file: ' . $file . '<br />';
                               fn_filelist($startdir . $file . "/", $searchSubdirs, $directoriesonly, $maxlevel, $level + 1);
                           }
                       }
					  
					   
                   } else {
                       if (!$directoriesonly) {
					     
					  //  echo substr(strrchr($file, "."), 1);
                           //if you want to include files; build your file array 
                           //however you choose; add other file details that you want.
                         $directorylist[$startdir . $file]['level'] = $level;
                         $directorylist[$startdir . $file]['dir'] = 0;
                         $directorylist[$startdir . $file]['name'] = $file;
                         $directorylist[$startdir . $file]['path'] = $startdir;
						  
					   
     }}}}
           closedir($dh);
}}
return($directorylist);
}
printrr(fn_filelist('./') );
*/


// AV func
// Directory traversal recursive
function dir_trav_r($dir, $recurse = true)
{
	// define directory array
	$dirArr = array();
		
	if(substr($dir, -1, 1) != "/") 	$dir = $dir."/";
	
	$op = opendir($dir);
	while ($mrdir = @readdir($op) )
	{
		if( $mrdir != "." && $mrdir != ".." )
		{
			// if( $recurse != false && is_dir( $dir.$mrdir) || filetype($dir.$mrdir) == "dir")
			if( $recurse && ( is_dir( $dir.$mrdir) || filetype($dir.$mrdir) == "dir" ) )
			{
				$odir = '';
				$odir .= $dir  . $mrdir . "/";
				
				$dirArr[$odir] = dir_trav_r($odir);
				//$dirArr[filetype($odir) .': ' . $odir] = dir_trav_r($odir);
				//$dirArr[filetype($odir).': '.$mrdir] = dir_trav_r($odir, false);
			}
			else
			{
				//$dirArr[filetype($dir.$mrdir) . ': ' .$mrdir] = $mrdir;
				$dirArr[$mrdir] = $mrdir;
			}
		}
	}
	
	return $dirArr;
	
}
//printrr( dir_trav_r('./', false) );
//printrr( dir_trav_r('/media', false) );

// Search if a file exists in a directory, & whether u want to recurse in 
// sub directory or not
// @param (string) $fileName, the filename to search for
// @param (string) $dir (directory Path), the directory in which to search for
// @param (bool) $recurse, whether to recurse or not
// return: void (for the moment)
function searchForFile($fileName, $dir, $recurse=0)
{
	// define directory array
	$dirArr = array();
		
	if(substr($dir, -1, 1) != "/") 	$dir = $dir."/";
	
	$op = opendir($dir);
	while ($mrdir = @readdir($op) )
	{
		if( $mrdir == $fileName )
			// return $mrdir;
			return $dir.$mrdir;
			
		if( $mrdir != "." && $mrdir != ".." )
		{
			// if( $recurse != false && is_dir( $dir.$mrdir) || filetype($dir.$mrdir) == "dir")
			if( $recurse && ( is_dir( $dir.$mrdir) || filetype($dir.$mrdir) == "dir" ) )
			{
				$odir = '';
				$odir .= $dir  . $mrdir . "/";
				
				$dirArr[$odir] = searchForFile($fileName, $odir, 1);
				//$dirArr[filetype($odir) .': ' . $odir] = dir_trav_r($odir);
				//$dirArr[filetype($odir).': '.$mrdir] = dir_trav_r($odir, false);
			}
			
			/*
			else
			{
				//$dirArr[filetype($dir.$mrdir) . ': ' .$mrdir] = $mrdir;
				$dirArr[$mrdir] = $mrdir;
			}
			* */
		}
	}
	
	// return $dirArr;
	
}



//************************************************************//
//   Directory Traversal ends //
//************************************************************//


//************************************************************//
//   Timer Functions //
//************************************************************//

// class c_Timer starts
class c_Timer
{
	
	var $t_start = 0;
	var $t_stop = 0;
	var $t_elapsed = 0 ;
	
	function start()
	{
		$this->t_start = microtime(); 
	}
	
	function stop()
	{
		$this->t_stop = microtime();
	}
	
	function elapsed()
	{
		if($this->t_elapsed)
		{
			return $this->t_elapsed;
		}
		else
		{
			$start_u = substr($this->t_start, 0, 10);
			$start_s = substr($this->t_start, 11, 10);
			$stop_u = substr($this->t_stop, 0, 10);
			$stop_s = substr($this->t_stop, 11, 10);
			$start_total = doubleval($start_u) + $start_s;
			$stop_total = doubleval($stop_u) + $stop_s;
			$this->t_elapsed = $stop_total - $start_total;
			
			return $this->t_elapsed;
		}
		
	}
	
}
// class c_Timer ends
/*
$timer = new c_Timer;

$timer->start();
echo "<hr>";
//sleep(1);
$timer->stop();
echo $timer->elapsed();
*/

//echo microtime();


// AV class
class Script_Timer
{
	
	public $start;
	public $stop;
	public $elapsed;
	
	function scriptTime($e=6)
	{
		list($usec, $sec) = explode(" ", microtime() );
		return ( (float)($usec) + (float)($sec) );
		//return bcadd($usec, $sec, $e);
	}
	
	function timer_start()
	{
		$this->start = self::scriptTime();
	}
	
	function timer_stop()
	{
		$this->stop = self::scriptTime();
	}
	
	function time_elapsed($precision)
	{
		$e = ($this->stop ) - ($this->start);
		$this->elapsed = round( $e, $precision);
		return $this->elapsed;
	}
	
}
/*
$time = new Script_Timer;
$time->timer_start();
$time->timer_stop();
echo 'script was executed in  ' . $time->time_elapsed() . ' seconds';
*/


//************************************************************//
//   Timer Functions ends //
//************************************************************//

//************************************************************//
//   Some Random Functions starts //
//************************************************************//


function noData()
{
	echo '
	<center>
		<table>
			<tr>
				<td>
				Empty dataset, no data to show.
				</td>
			</tr>
		</table>
	</center>
	';
}


// ---Start---
// Function From this page, for Sanitizing Input
// http://css-tricks.com/snippets/php/sanitize-database-inputs/

// Part 1: Stripping out Malicious bit here
function cleanInput($input) {
	$search = array(
	'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
	'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
	'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
	'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	);

	$output = preg_replace($search, '', $input);
	return $output;
	}

// Part 2: Sanitizing function
function sanitize($input) {
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize($val);
		}
	}
	else {
		if (get_magic_quotes_gpc()) {
			$input = stripslashes($input);
		}
		$input  = cleanInput($input);
		$output = mysql_real_escape_string($input);
	}
	return $output;
}

// Part 3: Usage
/*
$bad_string = "Hi! <script src='http://www.evilsite.com/bad_script.js'></script> It's a good day!";
$good_string = sanitize($bad_string);
// 	$good_string returns "Hi! It\'s a good day!"

// Also use for getting POST/GET variables
$_POST = sanitize($_POST);
$_GET  = sanitize($_GET);
*/

// ---End---

//************************************************************//
//   Some Random Functions ends //
//************************************************************//

//************************************************************//
//   Whether LoggedIn or not, Functions //
//************************************************************//

function userLoggedIn()
{
	global $user;
	
	// if not logged in, then redirect to "index.php?action=login"
	if( !isset( $user['uid'] ) )
	{
		echo("<center>Please login <a href='index.php?action=login'>here</a>, you will need to login before proceeding.</center>" );
		return false;
	}
	return true;
}


//************************************************************//
//   Whether LoggedIn or not, Functions ends //
//************************************************************//


//************************************************************//
//   Permissions & Privileges Functions //
//************************************************************//

function loadPrivsFromActionsTable()
{
	$q = "SELECT * FROM `actions`";
	$q1 = db_query($q);
	
	$r = $row =  array();
	while( $r = mysql_fetch_assoc( $q1 ) ) $row[$r['a_name']] = $r;
	
	//printrr( $row );
	//exit();
	
	return $row;
}

function userUidSet()
{
	global $user;
	if( !isset($user['uid'] ) )
	{
		return false;
	}
	return true;
}

function fillUserArr()
{
	
	global $user;
	
	/*
	$q1 = "SELECT * 
	FROM `users` `u` 
	LEFT JOIN 
	`groups` `g` ON `u`.`group` = `g`.`g_id` 
	WHERE 
	( `u`.`email` = '$email' 
	OR 
	`u`.`username` = '$email' ) AND `u`.`password` = '$password' 
	";
	*/
	$uid = $_SESSION['user']['uid'];
	
	/*
	$q1 = "SELECT * 
	FROM `users` `u` 
	LEFT JOIN 
	`groups` `g` ON `u`.`group` = `g`.`g_id` 
	WHERE `u`.`uid`='$uid'
	";
	*/
	
	$q1 = "SELECT * 
	FROM `users` `u` 
	LEFT JOIN 
	`groups` `g` ON `u`.`group` = `g`.`g_id` 
	LEFT JOIN `ai_actions_taken` `ai_a_t` ON `u`.`uid` = `ai_a_t`.`users_uid` 
	WHERE `u`.`uid`='$uid' 
	";
	
	$qq1 = db_query($q1);
	
	// if successful login, set sessions, redirect to index.php
	$data = array();
	while( $data = mysql_fetch_assoc($qq1) )
	{
		// set $_SESSION; else set the object $user & its properties
		// $user->setAttributes();
		foreach( $data as $k => $v )
		{
			$_SESSION["user"]["$k"] = $user["$k"] =  $v;
			
			if( $k == "password" || $k == "salt" )
			{
				unset( $_SESSION["user"]["$k"] );
				unset( $user["$k"] );
				unset( $data["$k"] );
			}
			// if $key of $data has been copied into $user,
			// then, we will not require $data, so unloading php baggage 
			// by unsetting and emptying the memory with $data
			if(isset($user["$k"] ) )
				unset( $data["$k"] );
		}
		
	}
	
	
	
}

//************************************************************//
//   Permissions & Privileges Functions ends //
//************************************************************//


//************************************************************//
//   Redirection Functions //
//************************************************************//

function redirect( $redirectUrl )
{
	
		// header("Location: $globals[only_ind]action=login");
		// header("Location: $boardurl$globals[only_ind]action=login");
		header("Location: $redirectUrl");
	
}

//************************************************************//
//   Redirection Functions ends //
//************************************************************//



//************************************************************//
//   Regex Matching Functions starts //
//************************************************************//

function alphaCapNumericUnd($strToEval)
{
	// if the $strToEval contains anything other than the small Alphabets, Capital Alpha, Numeric or Underscores
	// then return false, it fails the alphaCapNumericUnd() test
	// else it passes alphaCapNumericUnd() test
	// U dont need to do preg_match_all(), preg_match() will be enuf 
	// bcoz even if there is just 1 occurence of illegal character, it will jump out and return false
	// so u dont have to match the whole string with preg_match_all()
	//if(preg_match_all('/[^a-zA-Z0-9_]/i', $strToEval) )
	if(preg_match('/[^a-zA-Z0-9_]/i', $strToEval) )
	{
		return false;
	}
	return true;
	
}


//************************************************************//
//   Regex Matching Functions ends //
//************************************************************//



//************************************************************//
//   String Functions  //
//************************************************************//

// Trim all unwanted data from a string
// at key 0 , will be taking birth
function trimmer($str, $arrOfUnwantedStuff = null)
{
	// At the moment just trimming slashes
	$str = trim($str);
	
	//echo $str[strlen($str)-1];
	
	// At the moment just replacing slashes, obviously, this will be $arrOfUnwantedStuff later
	$arr = explode(" ", trim(str_replace( '/', " ", $str)));
	
	return $arr;
}


// Gets everything from the url, after, the $everythingAfterMe part in the URL
function get_str_after($everythingAfterMe)
{
	
	global $globals;
	
	$url = $globals['host'] . $_SERVER['PHP_SELF'];
	
	//echo $str = substr($url, strpos( $url, $everythingAfterMe, 1), strlen($everythingAfterMe));
	///echo strpos( $url, $everythingAfterMe, 1 );
	//echo strstr( strstr($url, $everythingAfterMe), $everythingAfterMe, 0);
	$url = substr($url, strpos($url, $everythingAfterMe) + strlen($everythingAfterMe) );
	
	return $url;
}


//************************************************************//
//   String Functions ends //
//************************************************************//




?>
