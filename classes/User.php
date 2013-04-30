<?php

class User
{
	
	//private array $att;
	private $att = array();
	
	private $_priv;
	private $_group;
	
	public function __construct()
	{}
	
	public function getGroup()
	{
		return $this->_group;
	}
	
	public function setGroup( $group )
	{
		$this->_group = $group;
	}
	
	public function getPriv()
	{
		return $this->_priv;
	}
	
	public function setPriv( $priv )
	{
		$this->_priv  = (int) $priv;
	}
	
	public function can($action)
	{
		return (int) $action & $this->getPriv();
	}
	
}


?>
