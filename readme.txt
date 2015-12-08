=== Clean Media Library File Names ===
Contributors: webdeveric
Tags: media library, filename, sanitize, special characters
Requires at least: 3.0.0
Tested up to: 4.4.0
Stable tag: 0.3.1

This plugin cleans uploaded file names to remove special characters and spaces.

== Description ==

This plugin cleans uploaded file names to remove special characters and spaces.

== Installation ==

1. Upload `clean-media-library-filenames` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You're done

== Changelog ==

= 0.3.1 =
* Works with WordPress 4.4

= 0.3 =
* Added default file name when the sanitized file name is blank. This could happen when the file name contains only special characters.

= 0.2 =
* I updated the code to use the `sanitize_title_with_dashes` function instead of using my own regular expression.

= 0.1 =
* Initial build