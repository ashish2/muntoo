<?php

// if not defined
function sample_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l, $qe;
	
	global $board, $replies;
	
	error_handler($error);
	notice_handler($notice);
	
	// Include backbone here & try testing it hree if u can
	
	
?>
	<center>
		<div class="nothing">
			Nothing to show here.
		</div>
	</center>
	
<?php
	
}

function createpoll_theme()
{
	
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user, $l;
	
	global $board, $replies, $qe, $row, $done;
	
	// boards will be listed here, get data from DB
	// Board table, having, board_id, board_name, board_desc, 
	// user_id who started board(admin or moderator), 
	// number of replies in Reply table
	// who replied etc, replies to a board_id in reply table
	// name of board, which username started board, 
	// how many posts in board
	
	error_handler($error);
	notice_handler($notice);
	
	echo '
		<form method="post" action="">
			<table align="center">
				<tr>
					<td valign="top">'.$l['question'].'</td>
					<td><textarea name="question" rows="6" cols="35"></textarea></td>
				</tr>
				
				<tr>
					<td valign="center">'.$l['option'].'</td>
					<td><input type="text" name="options[]" value=""></td>
				</tr>
				<tr>
					<td valign="center">'.$l['option'].'</td>
					<td><input type="text" name="options[]" value=""></td>
				</tr>
				<tr>
					<td valign="center">'.$l['option'].'</td>
					<td><input type="text" name="options[]" value=""></td>
				</tr>
			</table>
			
			<br />
			<small>+Add More options (or Delete existing options, he needs to have atleast 2 options for the poll. Later with Javascript)</small>
			<center><input class="mun-button-default" type="submit" name="submit" value="Submit"></center>
		</form>
	';
	
	
}

function viewpoll_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	global $user, $l;
	global $board, $replies, $qe;
	
	error_handler($error);
	notice_handler($notice);
	
	if($error)
		return false;
	
	?>
	
	<div class="create-poll">
		<!--
		<a href="<?//= "$globals[ind]action=createpoll&mod=imagegallery&id=$imageid"; ?>">Create a Poll for this Image</a>
		-->
	</div>
	
	
	<?php
	
	if( mysql_num_rows($qe) > 0 )
	{
		$i = 0;
		while ( $row = mysql_fetch_assoc($qe) )
		{
	?>
		<div class="image">
			
			<div>
				<?php 
					if( $i < 1 )
						echo $row['question']; 
				?>
			</div>
				
			<div>
				<b>
					<?= $row['option_text']; ?>
				</b>
			</div>
			
			<div>
				<?= $row['SUM']; ?>
			</div>
			
		</div>
	<?php
		
		$i++;
		}
		
	}
	else
	{
	?>
		<div class="no-image">
			<b>
				No Image to show here :(
			</b>
		</div>
		
	<?php
	}
}

function angular_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	global $user, $l;
	global $board, $replies, $qe;
	
	error_handler($error);
	notice_handler($notice);
	
	if($error)
		return false;
	
	?>
	<br />
	<br />
	
	<div class="angular-main" data-ng-app="MyTutorialApp">
		
		<div class="ang-lee" data-ng-controller="Customers">
			<div>
				<input type="text" data-ng-model="filter.myName">Hi, {{myName}}!
			</div>
			<h4>
				Init the list here: This list will get filtered according to what u type in the input above:
			</h4>
			<ul>
				<li data-ng-repeat="n in customers|filter:filter.myName|orderBy:'name'">
					{{n.name|uppercase}} - {{n.city}}
				</li>
			</ul>
			<br />
			Customer name:
			<input type="text" data-ng-model="newCustomer.name">
			<br />
			Customer City:
			<input type="text" data-ng-model="newCustomer.city">
			<br />
			<button data-ng-click="addCustomer()">Add customer</button>
			<br />
			<a href="#/view2">View 2</a>
		</div>

		<div data-ng-view="">
			I m view 2
		</div>

		<div class="" data-ng-controller="Something">
			<ul>
				<li data-ng-repeat="n in something.some">
					{{n.a}}
				</li>
			</ul>
			<input type="test" data-ng-model="something.mn">
			<span data-ng-bind="something.mn"></span>!
			<br />
			<input type="test" placeholder="Type something here" data-ng-model="name">
			<span data-ng-bind="name"></span>
			
			<div>
				<input type="checkbox" checked="checked" data-ng-model="showHideButton">
				<button data-ng-show="showHideButton">Show Hide</button>
			</div>
			
		</div>
		
		<div data-ng-controller="Studentform">
			<form name="student" novalidate>
				<input name="firstname" type="text" data-ng-model="firstName" required>
				<span style="color: red;" data-ng-show="student.firstname.$dirty && student.firstname.$invalid">
					<span data-ng-show="student.firstname.$error.required">First name is required</span>
				</span>
			</form>
		</div>
		
		<!--
		<div data-ng-view></div>
		-->
		
		<script type="text/ng-template" id="student.htm">
			<h2>Add Student</h2>
			{{message}}
			Total students: {{total}}
		</script>
		<script type="text/ng-template" id="viewstudents.htm">
			<h2>View Student</h2>
			{{message}}
			Total students: {{total}}
		</script>
		
		
		
	</div>
	
	<!-- Before i close my browser,
	Thank you to everyone for this amazing journey.
	It has truly been a fruitful and an amazing journey with all of you.
	And i hope to meet you all, soon
	-->
	<?php
}

function _main_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $error, $notice;
	global $user, $l;
	
	global $board, $replies, $qe, $imageid;
	
	error_handler($error);
	notice_handler($notice);
	
	if($error)
		return false;
	
	
	
}


?>
