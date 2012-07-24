<?php

// Will take the user id to be banned from the, Ai class(module) or the Api module
// Got to ban the user[uid] here
function ban()
{
	global $globals;
	global $user;
	
	$uid = $user['uid'];
	
	// Run the DB query to ban the user here
	echo "Hi $uid, now it is going to be the banned";
	
	// including bannedList file in order to run the ban function on the user[uid]
	include $globals['sourcedir'].'bannedList.php';
	// running the ban function on the user[uid]
	ban($uid);
	
	// Logging into the Ai_actions table, that user is banned
	$qI1 = "INSERT INTO `ai_actions_taken`(`users_uid`, `ban`) VALUES($uid, 1)";
	$qI1_e = db_query($qI1);
	
}

// Warning for ip
function warn_ip()
{
	global $error, $errors;
	global $cause_tab;
	
	// fill the $error which will be shown
	//$error['warn_ip'] = 'The system detected some unfavourable activity, your IP may get banned.';
	$cause_tab['func'] = str_replace("_"," ", $cause_tab['func']);
	$error['warn_ip'] = 'Unfavourable activity like '.$cause_tab['func'] .' detected, your IP may get banned.';
	//echo $error['warn_ip'];
	
}

?>
