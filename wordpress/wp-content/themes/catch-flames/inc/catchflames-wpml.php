<?php
/**
 * This functions makes the theme compatible with WPML Plugin
 *
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */

if ( ! function_exists( 'catchflames_wpml_invalidcache' ) ) :
/**
 * Template for Clearing WPML Invalid Cache
 *
 * To override this in a child theme
 * simply create your own catchflames_wpml_invalidcache(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_wpml_invalidcache() {
	delete_transient( 'catchflames_sliders' );
	delete_transient( 'catchflames_page_sliders' );
	delete_transient( 'catchflames_category_sliders' );
	delete_transient( 'catchflames_imagesliders' );
	delete_transient( 'catchflames_footercode' );
	delete_transient( 'catchflames_footer_content' );
} // catchflames_wpml_invalidcache
endif;

add_action( 'after_setup_theme', 'catchflames_wpml_invalidcache' );
