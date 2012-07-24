<?php

function addReply_lang()
{
	global $globals, $l;
	
	$l['success_topic'] = "Muaah :x, Reply posted successfully. You can go <a href='$globals[ind]action=topic&topic=$_GET[topic]'>HERE</a> to check your reply.";
	$l['success_wall'] = "Muaah :x, Reply posted successfully. You can go <a href='$globals[ind]action=wall&uid=$_GET[uid]&post=$_GET[post]'>HERE</a> to check your post.";
	$l['no_success'] = "Could not post the reply.";
	
}

?>
