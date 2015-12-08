<?php
/*
Plugin Name: Clean Media Library File Names
Plugin Group: Media Library
Plugin URI: http://phplug.in/
Version: 0.3.1
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

defined('ABSPATH') || exit;

function wde_get_file_info( $file )
{
    if ( ! function_exists('finfo_file') ) {
        return false;
    }

    $finfo = finfo_open( FILEINFO_MIME_TYPE );
    $mime  = finfo_file( $finfo, $file );
    finfo_close( $finfo );

    $extensions = array_search( $mime, wp_get_mime_types() );

    if ( $extensions === false ) {
        return false;
    }

    $ext = explode('|', $extensions);

    return array(
        'ext'  => reset( $ext ),
        'type' => $mime
    );
}

function wde_clean_media_library_file_names( array $data, $file, $filename, $mimes )
{
    $clean_name = sanitize_file_name( $filename );

    if ( $filename === $clean_name ) {
        return $data;
    }

    if ( $data['ext'] === false || $data['type'] === false ) {
        $info = wde_get_file_info( $file );

        if ( $info !== false ) {
            $data = array_merge( $data, $info );
        }
    }

    if ( $clean_name == '' || $clean_name == $data['ext'] ) {

        if ( $data['ext'] !== false ) {

            $clean_name = sprintf('%s-%s.%s', str_replace('/', '-', $data['type'] ), uniqid(), $data['ext'] );

        } else {

            $clean_name = sprintf('%s-%s', str_replace('/', '-', $data['type'] ), uniqid() );

        }

    }

    $data['proper_filename'] = $clean_name;

    return $data;
}

add_filter( 'wp_check_filetype_and_ext', 'wde_clean_media_library_file_names', 10, 4 );
