<?php

// if not defined

//register_theme();

function logout_theme()
{
	
	global $globals, $mysql, $done, $error, $errors;
	global $l;
	global $user;
	
	error_handler($error);
	error_handler($errors);
	
	
	if( !userLoggedIn() )
		return false;
	
	
}



?>
