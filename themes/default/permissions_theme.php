<?php

// if not defined

//register_theme();

function permissions_theme()
{
	global $globals, $mysql, $done, $error;
	global $l;
	
	error_handler($error);
	
	echo '
	<table>
	<thead>
	<tr>
	'. 
	foreach( $actions as $tmpAction ) 
	{
		?>
		<th> <?php echo $tmpAction; ?> </th>
		<?php 
	}
	. '
	</tr>
	</thead>
	<tbody>
	';
	
	foreach( $users as $tmpUser ) 
	{
		?>
		
		<tr>
		<?php
		foreach( $actions as $tmpAction )
		{ 
			?>
			<td><a href="index.php?user=<?php echo $tmpUser;  ?>&action=<?php echo $tmpAction; ?>"> <?php echo $tmpUser; ?>  </a></td>
			</tr>
			<?php
		}
	echo '</tr>';
	}
	
	echo '</tbody>
	</table>
	';
	
	printf( 
		'User %s in group %s %s %s.', 
		$user, 
		$userClass->getGroup(), 
		$userClass->can($temp->priv ) ? 'can' : "can't", 
		$action
	);
	
	
}



?>
