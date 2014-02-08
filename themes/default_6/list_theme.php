<?php

// if not defined

//viewProfile_theme();

function listUsers_theme()
{
	global $globals, $mysql, $theme, $done, $errors;
	global $user;
	global $q, $l;
	global $imgFolder;
	
	// The error_handler is only a theme/page where you can show errors.
	// We could have as well called an error page instead of calling a valid theme
	// like so, in the main listUsers function, 
	// if (errors) then pass errors to the errors page & call errors page,
	// if no (errors) then call this particular theme (listUsers_theme) (a valid) function
	error_handler($errors);
	
	if( !userLoggedIn() )
		return false;
	
	$cssThClassNm =  'class="dt-header"';
	$cssTrClassNm = 'class="dth-list-img-tr"';
	$cssTdClassNm = 'class="dth-list-img-td"';
	
	// ATM
	$multCssClass = 'class="dth-list-img-td img"';
	
	// ATM
	$l['image'] = 'Image';
	
	$nm = 4;
	$table = '';
	$table .= '<center>
	<h3>'.$l['list_users'].'</h3>
	<table class="disp_table list-img" id="disp_table">
		<thead>
			<tr>
				<th '.$cssThClassNm.' colspan="'.$nm.'"><b>'.$l['image'].'</b></th>
			</tr>
		<thead>';
		
	$i=0;
//						<img width="200" height="150" src="http://lorempixel.com/200/150/food/1" alt="Food">

// 						<img width='200' height='200' src=\"$imgFolder/${i}_small.jpg\">
	
	$td = '';
	
	while( $row=mysql_fetch_assoc( $q) )
	{
		
		if(!($i%$nm))
		{
			$table .= "
				<tr $cssTrClassNm>$td</tr>";
			$td = '';
		}
			
			$td .= "<td $multCssClass>
				<div class=\"image-box\">
					<div class=\"image-container\">
						<img src=\"{$imgFolder['uploaded']['small']}/$row[uid].jpg\">
					</div>
					<div class=\"image-details\">
						<h4>Details: </h4>
						<p>
							<span>
								<b>$l[uid]</b>: $row[uid]
								<br />
								<b>$l[username]</b>: <a href=$globals[boardurl]$globals[only_ind]action=viewProfile&uid=$row[uid]>$row[username]</a>
								<br />
								<b>$l[email]</b>: $row[email]
								<br />
								<b>$l[url]</b>: $row[url]
								<br />
								<b>$l[friend_uid]</b>: $row[friends_list]
								<br />
							</span>
						</p>
					</div>
				</div>
				
			</td>";
		
		/*
		if(!($i%$nm) || $i == 1)
			$table .= "
				</tr>
			";
		*/
		
		++$i;
	}
	
	// setting $row as null, clearing/cleaning/emptying php memory
	$row=null;
	
	$table .= '</table>';
	
	echo $table;
	// emptying table, clearing/cleaning/emptying php memory
	$table = '';
	
	
	/*
	echo '</table><br /><br />
	<a href="index.php?action=wall&uid='.$user['uid']. '">Wall</a> | 
	<a href="index.php?action=modifyprofile&uid='.$user['uid']. '">Modify Profile</a> | 
	<a href="index.php?action=ban&uid='.$user['uid']. '">Ban him!!!</a>
	</center>';
	*/
	
}




?>

<!--
<img src="images/uploaded/1.jpg">
-->
