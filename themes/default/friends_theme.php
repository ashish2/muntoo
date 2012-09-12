<?php

// if not defined

//register_theme();

function addOrDelFriend_theme()
{
	
	global $globals, $mysql, $done, $error, $errors;
	global $l, $notice;
	
	error_handler($error);
	notice_handler ($notice);
	
	
}

function friendsList_theme()
{
	
	global $globals, $mysql, $done, $error, $errors, $notice;
	global $l, $notice, $qu;
	global $show;
	
	error_handler($error);
	notice_handler ($notice);
	
	$str = '';
	if( $show )
	{
		if( mysql_num_rows($qu) > 0 )
		{
			$str .= '<center><div><b>'.$l['frnds'].'</b> <br />';
			
			while( $row = mysql_fetch_assoc ($qu) )
			{
				$str .= "<p>". null .
					//<span>
						//$row[uid] | 
					//</span>
					"<span>
						$row[username] | 
					</span>
					<span>
						$row[email] | 
					</span>
					<span>
						$row[url] 
					</span>
				</p>";
			}
			
			$str .= '</div></center>';
		}
	}
	
	echo $str;
	
}


?>
