<?php

/*
 * Polymorphism
 * */

class A {
	
	var $str;
	
	function poly(int $i) 
	{
		echo $i;
		
		return $this;
	}
	
	function poly2(string $str)
	{
		//$r = __FUNCTION__;
		echo $str;
		
		return $this;
	}
	
	// Adds something to the string.
	function poly3($str)
	{
		$this->str .= $str;
		return $this;
	}
	
	function set_str($str)
	{
		$this->str = $str;
		
		return $this;
	}
	
	function hi()
	{
		echo 'Hi';
	}
	
}

$poly = function (int $i) 
{
	echo $i;
	
	return $this;
};


$a = new A();

$s = 'Hello, World!';
$a->set_str($s);
// echo $a->str;

// Method chaining not allowed for the moment in php
// This type of method chaining is not allowed, 
// where dynmically, the object has changed, 
// and passing $a expecting that it might have changed state  
// and passing it in poly2($a->str) 
// is not allowed (so, poly2() echo'es 'Hello, World!' , is not happening )
/// $a->set_str($s)->poly2($a->str);

// This type of method chaining is allowed
$ss = " - In poly3, Adding to the current string.";
/// echo $a->set_str($s)->poly3($ss)->str;




/*
 * Inheritance
 * */

class Foo
{
	function f()
	{
		print 'f1';
	}
	
	function ff()
	{
		print 'f2';
	}
	
}

class bar extends foo
{
	
	function b()
	{
		print 'b1';
	}
	
}

$b = new bar;

// print_r($b);

$k= 0;

for( ; $i<10; ){
	print $k . '\n';
	$k++;
}
else
{
	print 'end';
}



?>
