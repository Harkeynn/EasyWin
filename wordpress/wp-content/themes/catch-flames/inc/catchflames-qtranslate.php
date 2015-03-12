<?php
/**
 * This functions makes the theme compatible with qTranslate Plugin
 *
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
 

if ( ! function_exists( 'catchflames_menuitem' ) ) :
/**
 * Template for Converting Home link in Custom Menu
 *
 * To override this in a child theme
 * simply create your own catchflames_menuitem(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_menuitem( $menu_item ) {
	// convert local URLs in custom menu items	
	if ( $menu_item->type == 'custom' && stripos($menu_item->url, get_site_url()) !== false) {
		$menu_item->url = qtrans_convertURL($menu_item->url);
	}     
		return $menu_item;
} // catchflames_menuitem
endif;

add_filter( 'wp_setup_nav_menu_item', 'catchflames_menuitem', 0 );


if ( ! function_exists( 'catchflames_qtranslate_invalidcache' ) ) :
/**
 * Template for Clearing qtranslate Invalid Cache
 *
 * To override this in a child theme
 * simply create your own catchflames_qtranslate_invalidcache(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_qtranslate_invalidcache() {
	delete_transient( 'catchflames_sliders' );
	delete_transient( 'catchflames_page_sliders' );
	delete_transient( 'catchflames_category_sliders' );
	delete_transient( 'catchflames_imagesliders' );
	delete_transient( 'catchflames_footercode' );
	delete_transient( 'catchflames_footer_content' );
} // catchflames_qtranslate_invalidcache
endif;

add_action( 'after_setup_theme', 'catchflames_qtranslate_invalidcache' );
