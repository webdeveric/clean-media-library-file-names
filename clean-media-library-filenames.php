<?php
/*
Plugin Name: Clean Media Library Filenames
Plugin Group: Media Library
Plugin URI: http://phplug.in/
Version: 0.2
Description: This plugin cleans uploaded file names to remove special characters and spaces.
Author: Eric King
Author URI: http://webdeveric.com/
*/

/********** Sample Function Args *************
array(4) {
	[0]=> array(3) {
		["ext"]=> string(3) "jpg"
		["type"]=> string(10) "image/jpeg"
		["proper_filename"]=> bool(false)
	}
	[1]=> string(22) "/var/www/tmp/phpYNFIPW"
	[2]=> string(21) "Ginger as a puppy.jpg"
	[3]=> bool(false)
}
*********************************************/

defined('ABSPATH') || die('What are you doing? You\'re not allowed back here!');

function wde_clean_media_library_filenames(array $data, $file, $filename, $mimes)
{
	if (isset($data['ext'])) {
		$data['proper_filename'] = sanitize_title_with_dashes(
			substr($filename, 0, strlen($filename) - strlen($data['ext']) - 1),
			'',
			'save'
		) . '.' . $data['ext'];
	}
	return $data;
}
add_filter('wp_check_filetype_and_ext', 'wde_clean_media_library_filenames', 10, 4);
