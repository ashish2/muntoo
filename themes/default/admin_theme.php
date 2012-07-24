<?php

// if not defined

//viewProfile_theme();

function adminMain_theme()
{
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $q;
	
	if( $errors )
	{
		error_handler($errors);
		return false;
	}
	
	
	echo "Welcome to the Admin Section...! Still Work in Progress...";
	
	echbr(2);
	echo '<a href="index.php?action=listUsers">List Users</a>';
	
	
	
}


?>
