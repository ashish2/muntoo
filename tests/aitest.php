<?php

include_once "PHPUnit/Autoload.php";
include_once "../functions/ai.php";

/*
class AITest extends PHPUnit_Framework_TestCase
{
	
	
}
*/

class Ai_DBTest extends PHPUnit_Framework_TestCase
{
	
	protected $ai_db;
	
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
	
	protected function setUp()
	{
		// Make an instance of AI
		$this->ai_db = new Ai_DB;
	}
	
	protected function tearDown()
	{
		unset($this->ai_db);
	}
	
	function testAi_q()
	{
		$this->q['spam_words'] = "SELECT * FROM `".$this->ai_tables['keydef'] . "` WHERE `" . $this->ai_columns['keydef']['keyword'] . "`='spam_words'";
		// return $q = "SELECT * FROM `".$this->ai_tables['keydef'] . "` WHERE `" . $this->ai_columns['keydef']['keyword'] . "`='" .__FUNCTION__ ."'";
		
		$expected = mysql_query($this->q['spam_words']);
		$actual = $this->ai_db->ai_q($this->q['spam_words']);
		
		$this->assertEquals($expected, $actual);
	}
	
	function testSpam_words_q()
	{
		$this->q['spam_words'] = "SELECT * FROM `".$this->ai_tables['keydef'] . "` WHERE `" . $this->ai_columns['keydef']['keyword'] . "`='spam_words'";
		// return $q = "SELECT * FROM `".$this->ai_tables['keydef'] . "` WHERE `" . $this->ai_columns['keydef']['keyword'] . "`='" .__FUNCTION__ ."'";
		$qq = $this->ai_q( $this->q['spam_words'] );
		$assoc = mysql_fetch_assoc($qq);
		$r = explode(',', $assoc['definition']);
		
		return $r;
	}
	
	
	
}

?>
