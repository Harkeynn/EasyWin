<?php
/**
 * Omega functions and definitions
 *
 * @package Omega
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */

require_once('inc/bootwalker.php');

add_action( 'after_setup_theme', 'mobile_theme_setup', 11  );

function mobile_theme_setup() {

	/* Load the primary menu. */
	remove_action( 'omega_before_header', 'omega_get_primary_menu' );	
	add_action( 'omega_header', 'omega_get_primary_menu' );
	add_filter( 'omega_site_description', 'mobile_site_description' );

	remove_theme_support( 'omega-custom-logo' );
	remove_action( "omega_header", 'omega_branding' );

	add_action('init', 'mobile_init', 1);
}


function mobile_site_description() {
	return "";
}

add_filter('omega_sidebar_class', 'mobile_sidebar_class');

function mobile_sidebar_class() {
	return 'sidebar col-xs-12 col-sm-4';
}

add_filter('omega_main_class', 'mobile_main_class');

function mobile_main_class() {
	$layout = get_theme_mod( 'theme_layout' );

	if ("1c" == $layout) 
		return 'content col-xs-12 col-sm-12';
	else
		return 'content col-xs-12 col-sm-8';
}

add_filter('omega_wrap_open', 'mobile_container_open');
add_filter('omega_wrap_close', 'mobile_container_close');

function mobile_wrap_class() {
	return 'container';
}

function mobile_container_open() {
  echo '<div class="container"><div class="row">';
}

function mobile_container_close() {
  echo '</div><!-- .row --></div><!-- .container -->';
}

function mobile_init(){
	if(!is_admin()){
		wp_enqueue_style("mobile-bootstrap", get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_script("mobile-bootstrap", get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
	} 
}