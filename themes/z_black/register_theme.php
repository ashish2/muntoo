<?php

// if not defined

//register_theme();

function register_theme()
{
	global $globals, $mysql, $done, $error;
	global $l;
	
	echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
	
	
	error_handler($error);
	
	if( $done )
	{
		echo $l['thanks'] . '<a href="index.php?action=login">Login</a> here';
	}
	else
	{
		echo '
<div id="carbonForm">
	<h1>Signup</h1>

    <form action="" method="post" id="signupForm">

    <div class="fieldContainer">

        <div class="formRow">
            <div class="label">
                <label for="name">Name:</label>
            </div>
            
            <div class="field">
                <input type="text" name="name" id="name" />
            </div>
        </div>
        
        <div class="formRow">
            <div class="label">
                <label for="email">Email:</label>
            </div>
            
            <div class="field">
                <input type="text" name="email" id="email" />
            </div>
        </div>
        
        <div class="formRow">
            <div class="label">
                <label for="pass">Password:</label>
            </div>
            
            <div class="field">
                <input type="password" name="pass" id="pass" />
            </div>
        </div>
        
        <div class="formRow">
            <div class="label">
                <label for="url">Url:</label>
            </div>
            
            <div class="field">
                <input type="text" name="url" id="url" />
            </div>
        </div>
        
    </div> <!-- Closing fieldContainer -->
    
    <div class="signupButton">
        <input type="submit" name="submit" id="submit" value="Signup" />
    </div>
    
    </form>
        
</div>
		';

		
		/*
		echo '
			<form action="" method="post">
				<table align="center">
					<tr>
						<td width="70%"> Username </td>
						<td><input type="text" name="username"> </td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="password"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email"> </td>
					</tr>
					<tr>
						<td>Website Url</td>
						<td><input type="text" name="url"> </td>
					</tr>
				</table>
				<center><input type="submit" name="sub_register" value="Register"></center>
			</form>
		';
	*/
	
	}
	
	
}



?>
