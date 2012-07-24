<?php

// include "func.php";

// Base AI class.
class Ai
{
	
}

// Ai DB class, having DB table names etc
// corresponding to all the Ai tables
class Ai_DB
{
	public $ai_tables = array();
	public $ai_columns = array();
	
	public $q = array();
	
	function __construct()
	{
		$this->ai_tables['keydef'] = 'ai_keyword_definitions';
		$this->ai_columns['keydef']['keyword'] = 'keyword';
		
		// ai_logs
		$this->ai_tables['ailogs'] = 'ai_logs';
		$this->ai_columns['ailogs']['uuid'] = 'users_uid';
		$this->ai_columns['ailogs']['type'] = 'type';
		
		// $this->ai_columns['keydef']['def'] = 'definition';
		
		
	}
	
	function ai_q($q)
	{
		return mysql_query($q);
	}
	
	function spam_words_q()
	{
		
		$this->q['spam_words'] = "SELECT * FROM `".$this->ai_tables['keydef'] . "` WHERE `" . $this->ai_columns['keydef']['keyword'] . "`='spam_words'";
		// return $q = "SELECT * FROM `".$this->ai_tables['keydef'] . "` WHERE `" . $this->ai_columns['keydef']['keyword'] . "`='" .__FUNCTION__ ."'";
		
		$qq = $this->ai_q( $this->q['spam_words'] );
		
		$assoc = mysql_fetch_assoc($qq);
		$r = explode(',', $assoc['definition']);
		
		return $r;
	}
	
	function ai_logs_q($funcNm, $userUid)
	{
		
		$this->q['ai_logs_q'] = "SELECT * FROM `ai_logs` WHERE ".$this->ai_columns['ailogs']['type']. "='".$funcNm ."' AND " .$this->ai_columns['ailogs']['uuid']."=".$userUid;
		$qq = $this->ai_q( $this->q['ai_logs_q'] );
		
		return mysql_num_rows($qq);
	}
	
	function ai_causes_q($cause_name, $severity_level)
	{
		$this->q['ai_causes_q'] = "SELECT * FROM `ai_causes` WHERE `cause_name`='$cause_name' AND `c_severity_level`='$severity_level'";
		
		$qq = $this->ai_q( $this->q['ai_causes_q'] );
		$assoc = mysql_fetch_assoc($qq);
		
		//Returning the associative array as it is, which will state the effect name in the key, $assoc[ai_e_effect_name],
		//which is supposed to be searched for in the ai_effects table, to find the name of the function to finally run, on the user.
		return $assoc;
	}
	
	function ai_effects_q($effect_name)
	{
		$this->q['ai_effects_q'] = "SELECT * FROM `ai_effects` WHERE `effect_name`='$effect_name'";
		
		$qq = $this->ai_q( $this->q['ai_effects_q'] );
		$assoc = mysql_fetch_assoc($qq);
		
		//Returning the associative array as it is, which will state the action name in the key,
		//which needs to be taken for the user.
		return $assoc;
	}
	
	function ai_actions_q($action_name, $severity_level)
	{
		$this->q['ai_actions_q'] = "SELECT * FROM `ai_actions` WHERE `action_name`='$action_name' AND `a_severity_level`='$severity_level'";
		
		$qq = $this->ai_q( $this->q['ai_actions_q'] );
		if( mysql_num_rows($qq) > 0)
		{
			$assoc = mysql_fetch_assoc($qq);
			//Returning the associative array as it is, which will state the action name in the key, with the severity level
			//to know the 'unit of time' the action has to be kept alive for the user.
			return $assoc;
		}
		// else return false or something more logical
		// for the moment returning false
		return false;
	}
	
	
}
// class Ai_DB ends

// If a "Cause" occurs... (cont. at Action class)
// AI_Causes class, which will make some DB queries to find if any "Cause" has happened,
// Querying the "Cause" table
class Ai_Causes 
{
	
	function test()
	{
		$arr = array(1, 2, 3 );
		printrr( $arr);
	}
	
	// The 'Cause' of 'spam_words' has happened
	// Will return true or false, whether the reply(content) has spam words in it and the name of the function as it corresponds to the 'cause' name in the DB
	function spam_words($r, $reply)
	{
		
		//printrr($r);
		// $reply = trim($reply);
		//printrr($reply);
		
		$ret['val'] = 0;
		$ret['func'] = __FUNCTION__;
		
		foreach($r as $k => $v)
		{
			// $v = trim($v);
			
			if( stripos($reply, $v ) > 0 )
			{
				
				$ret['val'] = 1;
				$ret['func'] = __FUNCTION__;
				break;
			}
		}
		
		return $ret;
	}
	
	function multiple_posts()
	{
		
	}
	
	function ai_decrease_level()
	{
		
	}
	
	function ai_increase_level()
	{
		
	}
	
	
}

// (cont. from up)..."Action" is taken...(cont. down)
// Ai action class, if a cause has happened, it will take the appropriate action, 
// listed against the cause to be taken, and in turn making the software, smarter.
// For eg. Actions like, 
// Modifying the .htaccess to 
class Ai_Actions 
{
	
	// Eg. modify .htaccess (maybe)
	function modifySomething()
	{
		
	}
	
	// fire an AI db query
	// for eg. 
	// If user has posted more than 10(or whatever) times in the past 1 minute, 
	// fire a db query: to ban him, or ban his IP, or warn him, etc.
	// the query has to be passed by someone.
	// or just include file and run the function, like, 
	// if you want to ban a user, just include the ban.php & run the ban function by passing the $users[uid]
	function fire_a_db_query()
	{
		
	}
	
}

// (cont. from up)... For "Effect" to Happen.
class Ai_Effects
{
	
}

class Ai_Objects
{
	
	var $causes = null;
	var $actions = null;
	var $effects = null;
	var $ai_db = null;
	
	function __construct()
	{
		$this->causes = new Ai_Causes;
		$this->actions = new Ai_Actions;
		$this->effects = new Ai_Effects;
		$this->ai_db = new Ai_DB;
	}
	
}

// Will extend all the above classes and execute thier methods.
class Ai_Execute extends Ai_Objects
{
	
	
	function spam_words_e($reply)
	{
		
		global $globals;
		global $user, $time, $cause_tab;
		
		// $reply = 'this is a fuck and sex';
		// $user['uid'] = 3;
		
		$arr = $this->ai_db->spam_words_q();
		/*
		$this->q['spam_words'] = "SELECT * FROM `".$this->ai_db->ai_tables['keydef'] . "` WHERE `" . $this->ai_db->ai_columns['keydef']['keyword'] . "`='spam_words'";
		$qq = mysql_query( $this->q['spam_words'] );
		$assoc = mysql_fetch_assoc($qq);
		$arr = explode(',', $assoc['definition']);
		*/
		$cause_tab = $this->causes->spam_words($arr, $reply);
		//printrr($cause_tab);
		//exit;
		
		// if the reply contain a spam word, $cause_tab['val'] will return 1
		if( $cause_tab['val'] )
		{
			
			$definition = '';
			$t = round($time->scriptTime() );
			$reason = 'cause';
			$aiul_ai_u_l_id = null;
			
			// now that cause_tab[val] is 1, fire an INsert query into the ai_logs table
			$q = "INSERT INTO `ai_logs` (`users_uid`, `reason`, `type`, `any_definition`, `datetime`, `aiul_ai_u_l_id`) VALUES('$user[uid]', '$reason', '$cause_tab[func]', '$definition', $t, '$aiul_ai_u_l_id')";
			mysql_query($q);
			
			
			// so now see how many times the name of the 'cause'($r[func]) appears in the logs table
			$severity_level = $this->ai_db->ai_logs_q( $cause_tab['func'], $user['uid'] );
			/*
			$this->q['ai_logs_q'] = "SELECT * FROM `ai_logs` WHERE ".$this->ai_db->ai_columns['ailogs']['type']. "='".$r['func'] ."' AND " .$this->ai_db->ai_columns['ailogs']['uuid']."=".$user['uid'];
			$qq = mysql_query( $this->q['ai_logs_q'] );
			$severity_level = mysql_num_rows($qq);
			*/
			
			//echo $severity_level;
			//exit;
			
			// now fire a query in the causes table to know what is the effect is to be reached
			$cause_effect = $this->ai_db->ai_causes_q($cause_tab['func'], $severity_level);
			/*
			$this->q['ai_causes_q'] = "SELECT * FROM `ai_causes` WHERE `cause_name`='$cause_tab[func]' AND `c_severity_level`='$severity_level'";
			$qq = mysql_query( $this->q['ai_causes_q'] );
			//Returning the associative array as it is, which will state the effect name in the key, $assoc[ai_e_effect_name],
			//which is supposed to be searched for in the ai_effects table, to find the name of the function to finally run, on the user.
			$cause_effect = mysql_fetch_assoc($qq);
			*/
			
			
			// now fire the query into the effects table to know which "action" from the `ai_actions` table needs to be taken for the current user
			$effect_action = $this->ai_db->ai_effects_q($cause_effect['ai_e_effect_name']);
			/*
			$this->q['ai_effects_q'] = "SELECT * FROM `ai_effects` WHERE `effect_name`='$cause_effect[ai_e_effect_name]'";
			$qq = mysql_query( $this->q['ai_effects_q'] );
			//Returning the associative array as it is, which will state the action name in the key,
			//which needs to be taken for the user.
			$effect_action = mysql_fetch_assoc($qq);
			*/
			
			
			// ok, so now, here comes the result from the final actions table, u can now run the function, 
			// on the user, given by the, $action_for_days array, and for the amount of time mentioned in the table.
			// execute the action here, like $action_for_days[action_name]
			$action_for_days = $this->ai_db->ai_actions_q($effect_action['ai_action_actname'], $severity_level);
			
			// if $action_for_days is false return false, else move ahead
			if( !$action_for_days )
				return false;
			/*
			$this->q['ai_actions_q'] = "SELECT * FROM `ai_actions` WHERE `action_name`='$effect_action[ai_action_actname]' AND `a_severity_level`='$severity_level'";
			$qq = mysql_query( $this->q['ai_actions_q'] );
			*/
			
			//if( mysql_num_rows($qq) > 0)
			//{
				/*
				//Returning the associative array as it is, which will state the action name in the key, with the severity level
				//to know the 'unit of time' the action has to be kept alive for the user.
				$action_for_days = mysql_fetch_assoc($qq);
				*/
				
				
				//Now just include the corresponding file, & run the name function returned
				//for eg. if, $action_for_days['action_name'] = 'ban'
				// then, include the ban file, & run the ban() function
				// include $globals['sourcedir'] .'/'. $action_for_days['action_name'].'.php';
				include $globals['funcdir'] .'/'. 'allFeatures.php';
			
				// Now get the final function that is supposed to be run on the user, from the actions table, 
				// for the number of days the action has to be kept alive.
				// echo "actionName: ". $action_for_days['action_name'];
				// the below function has to return true or false
				// running the function here.
				//$ret = $action_for_days['action_name']($user['uid']);
				$ret = $action_for_days['action_name']();
				
				// is this particular ($ret) action already been taken on the user before
				// if no, only then go and fire all the below queries, else do nothing
				//if( !$user['action']["$ret"] )
				//if( isset($user['actions']["$ret"]) && !$user['actions']["$ret"] )
				if( isset($user["$ret"]) && !$user["$ret"] )
				{
					if( $ret )
					{
						// run the ai_logs query for the user uid with the func_name returned in the previous step, $r[func]
						// Insert everything that happened, 
						// to the user, by the system, into the ai logs table, 
						// like, for this user, this action taken, with this severity, at this date etc.
						$action = 'action';
						// time rite now
						$t = round($time->scriptTime() );
						// aiul_ai_u_l_id is going empty for the moment
						$aiul_ai_u_l_id = '';
						$q = "INSERT INTO `ai_logs` (`users_uid`, `reason`, `type`, `any_definition`, `datetime`, `aiul_ai_u_l_id`) VALUES('$user[uid]', '$action', '$action_for_days[action_name]', '$definition', $t, '$aiul_ai_u_l_id')";
						mysql_query($q);
					}
					else
					{
						// run the ai_logs query for the user uid with the func_name returned in the previous step, $r[func]
						// Insert everything that happened, 
						// to the user, by the system, into the ai logs table, 
						// like, for this user, this action taken, with this severity, at this date etc.
						$action = 'action';
						$definition = 'Could not ban user';
						// time rite now
						$t = round($time->scriptTime() );
						// aiul_ai_u_l_id is going empty for the moment
						$aiul_ai_u_l_id = '';
						$q = "INSERT INTO `ai_error_logs` (`users_uid`, `reason`, `type`, `any_definition`, `datetime`, `aiul_ai_u_l_id`) VALUES('$user[uid]', '$action', '$action_for_days[action_name]', '$definition', $t, '$aiul_ai_u_l_id')";
						mysql_query($q);
						
						$q = "UPDATE `ai_actions_taken` SET '$action_for_days[action_name]'= 1 WHERE `users_uid`='$user[uid]'";
						mysql_query($q);
					}
				}
			//}
		}
	}
	// func ends here
	
	
}
// class ends here

// $ai = new Ai_Execute;
// print_r($ai->causes->spam_words() );



?>
