<?php

// Including js files whatever we find in the 
// /js/include_js_files text file in the theme js directory
function include_js_files()
{
	global $globals, $user, $theme;
	
	$js_files_arr = array();
	
	$g_theme_dir = null;
	$g_theme_dir = $globals['themedir'];
	if( !isset( $globals['themedir'] ) || empty( $globals['themedir'] ) )
		$g_theme_dir = 'themes';
	
	$js_file_list = $g_theme_dir."/".$user['theme_type']."/js/include_js_files";
	$js_files_arr = file($js_file_list);
	
	$theme['js_files'] = array_filter(array_map("trim", $js_files_arr));
	//$theme['js_files'] = array_filter($js_files_arr, "trim");
	$js_files_arr = null;
	$g_theme_dir = null;
	
}

?>
