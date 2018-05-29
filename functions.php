<?php

//HIDE ADMIN BAR
add_filter('show_admin_bar', '__return_false');

//REMOVE UNNEEDED STUFF
function disable_emojis_tinymce( $plugins ) {
if ( is_array( $plugins ) ) {
return array_diff( $plugins, array( 'wpemoji' ) );
} else {
return array();
}}

function disable_emojis() {
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// LOAD UP PP DEFAULT STYLES AND ADD CUSTOM CSS and JS
function webmix_css() {
	wp_enqueue_style( 'webmix_style', get_stylesheet_directory_uri() .'/css/custom.css' );
	wp_enqueue_script( 'webmix_js', get_stylesheet_directory_uri() .'/js/custom.js' );
}
add_action( 'wp_enqueue_scripts', 'webmix_css', 15 );

// PREMIUMPRESS FRAMEWORK FUNCTIONS
//require_once TEMPLATEPATH ."/functions.php";
//require_once TEMPLATEPATH ."/_coupon/functions.php";

?>