<?php
if ( ! function_exists( 'catchflames_available_fonts' ) ) :
/**
 * Returns an array of fonts available to the theme.
 *
 * @since Catch Flames 1.0
 */
function catchflames_available_fonts() {	

	return array(
		'arial-black'			=> '"Arial Black", Gadget, sans-serif',
		'allan'					=> 'Allan, sans-serif',
		'allerta'				=> 'Allerta, sans-serif',
		'amaranth'				=> 'Amaranth, sans-serif',
		'arial'					=> 'Arial, Helvetica, sans-serif',
		'bitter'				=> 'Bitter, sans-serif',
		'cabin'					=> 'Cabin, sans-serif',
		'cantarell'				=> 'Cantarell, sans-serif',
		'century-gothic'		=> '"Century Gothic", sans-serif',
		'courier-new'			=> '"Courier New", Courier, monospace',
		'crimson-text'			=> '"Crimson Text", sans-serif',
		'dancing-script'		=> '"Dancing Script", sans-serif',
		'droid-sans'			=> '"Droid Sans", sans-serif',
		'droid-serif'			=> '"Droid Serif", sans-serif',
		'georgia'				=> 'Georgia, "Times New Roman", Times, serif',
		'helvetica'				=> 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		'helvetica-neue'		=> '"Helvetica Neue",Helvetica,Arial,sans-serif',
		'istok-web'				=> '"Istok Web", sans-serif',
		'impact'				=> 'Impact, Charcoal, sans-serif',
		'lato'					=> '"Lato", sans-serif',
		'lucida-sans-unicode'	=> '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		'lucida-grande'			=> '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
		'lobster'				=> 'Lobster, sans-serif',
		'lora'					=> '"Lora", serif',
		'monaco'				=> 'Monaco, Consolas, "Lucida Console", monospace, sans-serif',
		'nobile'				=> 'Nobile, sans-serif',
		'open-sans'				=> '"Open Sans", sans-serif',
		'oswald'				=> '"Oswald", sans-serif',
		'palatino'				=> 'Palatino, "Palatino Linotype", "Book Antiqua", serif',	
		'patua-one'				=> '"Patua One", sans-serif',
		'playfair-display'		=> '"Playfair Display", sans-serif',
		'pt-sans'				=> '"PT Sans", sans-serif',
		'pt-serif'				=> '"PT Serif", serif',
		'quattrocento-sans' 	=> '"Quattrocento Sans", sans-serif',
		'tahoma'				=> 'Tahoma, Geneva, sans-serif',
		'trebuchet-ms'			=> '"Trebuchet MS", "Helvetica", sans-serif',
		'times-new-roman'		=> '"Times New Roman", Times, serif',
		'ubuntu'				=> 'Ubuntu, sans-serif',
		'verdana'				=> 'Verdana, Geneva, sans-serif',
		'yanone-kaffeesatz' 	=> '"Yanone Kaffeesatz", sans-serif'
	);
	
}
endif;


/**
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */

/**
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 */
global $catchflames_options_defaults;
$catchflames_options_defaults = array(
	'favicon'							=> get_template_directory_uri().'/images/favicon.ico',
 	'remove_favicon'					=> '1',	
	'web_clip'							=> get_template_directory_uri().'/images/apple-touch-icon.png',
 	'remove_web_clip'					=> '1',
	'featured_logo_header'				=> get_template_directory_uri().'/images/logo.png',
 	'remove_header_logo'				=> '1',
 	'disable_header_menu'				=> '0',
	'search_display_text'				=> esc_attr__( 'Search', 'catchflames' ),
	'enable_header_top'					=> '0',
	'disable_top_menu_logo'				=> '1',
	'top_menu_logo'						=> get_template_directory_uri().'/images/fixed-logo.png',
	'enable_featured_header_image'		=> 'excludehome',
	'featured_header_image_alt'			=> esc_attr( get_bloginfo( 'name', 'display' ) ),
	'featured_header_image_url'			=> esc_url( home_url( '/' ) ),
	'reset_header_image'				=> '2',
	'color_scheme'						=> 'light',
	'sidebar_layout'					=> 'three-columns',
	'content_layout'					=> 'excerpt-border',
	'reset_sidebar_layout'				=> '2',
 	'front_page_category'				=> array(),
	'exclude_slider_post'				=> '0',
 	'slider_qty'						=> 4,
	'select_slider_type'				=> 'demo-slider',
	'enable_slider'						=> 'enable-slider-homepage',
	'slider_category'					=> array(),
	'featured_slider_page'				=> array(),
 	'transition_effect'					=> 'fade',
 	'transition_delay'					=> 4,
 	'transition_duration'				=> 1,
	'disable_footer_social'				=> 0,
 	'social_facebook'					=> '',
 	'social_twitter'					=> '',
 	'social_googleplus'					=> '',
 	'social_pinterest'					=> '',
 	'social_youtube'					=> '',
 	'social_vimeo'						=> '',
 	'social_linkedin'					=> '',
 	'social_aim'						=> '',
 	'social_myspace'					=> '',
 	'social_flickr'						=> '',
 	'social_tumblr'						=> '',
 	'social_deviantart'					=> '',
 	'social_dribbble'					=> '',
 	'social_wordpress'					=> '',
 	'social_rss'						=> '',
	'social_slideshare'					=> '',
 	'social_instagram'					=> '',
 	'social_skype'						=> '',
	'social_soundcloud'					=> '',
	'social_email'						=> '',
	'social_contact'					=> '',
	'social_xing'						=> '',
	'enable_specificfeeds'				=> '0',
 	'custom_css'						=> '',
	'disable_scrollup'					=> '0',
 	'more_tag_text'						=> esc_attr__( 'Continue Reading', 'catchflames' ) . ' &rarr;',
 	'excerpt_length'					=> 30,
	'reset_more_tag'					=> '2'
);
global $catchflames_options_settings;
$catchflames_options_settings = catchflames_options_set_defaults( $catchflames_options_defaults );

function catchflames_options_set_defaults( $catchflames_options_defaults ) {
	$catchflames_options_settings = array_merge( $catchflames_options_defaults, (array) get_option( 'catchflames_options', array() ) );
	return $catchflames_options_settings;
}