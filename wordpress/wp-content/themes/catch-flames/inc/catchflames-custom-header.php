<?php
/**
 * Implements an optional custom header for Catch Flames.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses add_custom_image_header() to register support for below 3.4
 * @uses catchflames_header_style() to style front-end.
 * @uses catchflames_admin_header_style() to style wp-admin form.
 * @uses catchflames_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since Catch Flames 1.0
 */
function catchflames_custom_header_setup() {
	
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '000',
		
		// Header image default
		'default-image'			=> get_template_directory_uri() . '/images/headers/nature.jpg',
		
		// Set height and width, with a maximum value for the width.
		'height'                 => 400,
		'width'                  => 1600,
		
		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,
			
		// Random image rotation off by default.
		'random-default'         => false,	
			
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'catchflames_header_style',
		'admin-head-callback'    => 'catchflames_admin_header_style',
		'admin-preview-callback' => 'catchflames_admin_header_image',
	);

	$args = apply_filters( 'custom-header', $args );

	// Add support for custom header	
	add_theme_support( 'custom-header', $args );

}
add_action( 'after_setup_theme', 'catchflames_custom_header_setup' );

if ( ! function_exists( 'catchflames_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Catch Flames 1.0
 */
function catchflames_header_style() {
	global $catchflames_options_settings, $catchflames_options_defaults;
    $options = $catchflames_options_settings;	
	$defaults = $catchflames_options_defaults;

	$text_color = get_header_textcolor();
	
	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-details {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php 
	
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	<?php 
	// Site Title Hover Color
	if( ( $defaults[ 'title_hover_color' ] != $options[ 'title_hover_color' ] ) || ( $defaults[ 'title_hover_color' ] != $options[ 'title_hover_color' ] ) ) {
		echo "#site-title a:hover, #site-title a:focus, #site-title a:active { color: " .  $options[ 'title_hover_color' ] ."; }". "\n";
	}
	// Site Tagline Color	
	if( ( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) || ( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) ) {
		echo "#site-description { color: " .  $options[ 'tagline_color' ] ."; }". "\n";
	}
	?>
	</style>
	<?php
}
endif; // catchflames_header_style

if ( ! function_exists( 'catchflames_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Catch Flames 1.0
 */
function catchflames_admin_header_style() {
	global $catchflames_options_settings, $catchflames_options_defaults;
    $options = $catchflames_options_settings;	
	$defaults = $catchflames_options_defaults;
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#site-logo {
		float: left;
		line-height: 0;
	}
	#site-details {
		float: left;
	}
	#site-logo.title-right {
		padding-right: 20px;
	}
	#site-title {
		font-size: 46px;
		font-weight: bold;
		line-height: 50px;
		padding: 0;
		margin: 0;
	}
	#site-title a {
		color: #111111;
		text-decoration: none;
	}
	#site-description {
		color: #7a7a7a;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
		line-height: 1.62em;
		padding-left: 5px;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a {
			color: #<?php echo get_header_textcolor(); ?>;
		}
		
	<?php endif; ?>
	<?php 
	// Site Title Hover Color
	if( ( $defaults[ 'title_hover_color' ] != $options[ 'title_hover_color' ] ) || ( $defaults[ 'title_hover_color' ] != $options[ 'title_hover_color' ] ) ) {
		echo "#site-title a:hover, #site-title a:focus, #site-title a:active { color: " .  $options[ 'title_hover_color' ] ."; }". "\n";
	}
	// Site Tagline Color	
	if( ( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) || ( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) ) {
		echo "#site-description { color: " .  $options[ 'tagline_color' ] ."; }". "\n";
	}
	?>

	#headimg img {
		height: auto;
		max-width: 100%;
	}
	</style>
<?php
}
endif; // catchflames_admin_header_style


if ( ! function_exists( 'catchflames_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @since Catch Flames 1.0
 */
function catchflames_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
        
        <?php catchflames_headerdetails(); ?>

		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // catchflames_admin_header_image


if ( ! function_exists( 'catchflames_logo' ) ) :
/**
 * Template for Logo
 *
 * To override this in a child theme
 * simply create your own catchflames_logo(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_logo() {
		
	//delete_transient( 'catchflames_logo' );	
	
	// Getting data from Theme Options
	global $catchflames_options_settings, $catchflames_options_defaults;
    $options = $catchflames_options_settings;	
	$defaults = $catchflames_options_defaults;
	$text_color = get_header_textcolor();
	
	if ( ( !$catchflames_logo = get_transient( 'catchflames_logo' ) ) && empty( $options[ 'remove_header_logo' ] ) ) {
		echo '<!-- refreshing cache -->';	
		
		$catchflames_logo = '';
		
		if ( 'blank' == $text_color ) {
			$classses = 'title-disable';
		}
		elseif ( 'blank' != $text_color ) {
			$classses = 'title-right';
		}
		elseif ( 'blank' != $text_color ) {
			$classses = 'title-left';
		}
		else {
			$classses = 'clear';
		}
		
		$catchflames_logo .= '<div id="site-logo" class="' . $classses . '">';
			
		$catchflames_logo .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
		
		if ( !empty( $options[ 'featured_logo_header' ] ) ) {
		
			$catchflames_logo .= '<img src="' . esc_url( $options['featured_logo_header'] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
		
		} else {
			
			// if empty featured_logo_header on theme options, display default logo
			$catchflames_logo .='<img src="' . esc_url( $defaults['featured_logo_header'] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
		}
		
		$catchflames_logo .= '</a></div><!-- #site-logo -->';

		set_transient( 'catchflames_logo', $catchflames_logo, 86940 );
	}
	echo $catchflames_logo;	
} // catchflames_logo
endif;


if ( ! function_exists( 'catchflames_site_details' ) ) :
/**
 * Template for Site Details
 *
 * To override this in a child theme
 * simply create your own catchflames_header_details(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_site_details() { 
	?> 
		<div id="site-details">
				<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>   
	<?php
}
endif;


if ( ! function_exists( 'catchflames_headerdetails' ) ) :
/**
 * Header Details including Site Logo, Title and Description
 *
 * @Hooked in catchflames_headercontent
 * @since Catch Flames 1.0
 */
function catchflames_headerdetails() {
	
	echo '<div id="logo-wrap" class="clearfix">';
		
		echo catchflames_logo();
		echo catchflames_site_details();
		
	echo '</div><!-- #logo-wrap -->';

} 
endif; //catchflames_headerdetails

add_action( 'catchflames_headercontent', 'catchflames_headerdetails', 30 ); 


/**
 * Header Right Sidebar
 *
 * @Hooked in catchflames_headercontent
 * @since Catch Flames 1.0
 */
function catchflames_header_rightsidebar() {
	get_sidebar( 'headerright' ); 
}  
add_action( 'catchflames_headercontent', 'catchflames_header_rightsidebar', 40 ); 


if ( ! function_exists( 'catchflames_header_search' ) ) :
/**
 * Header Search Box
 *
 * @since Catch Flames 1.0
 */
function catchflames_header_search() { ?>
	<aside class="widget widget_search" id="header-search">
		<?php get_search_form(); ?>
	</aside>
    <?php
}        
endif; //catchflames_header_search


if ( ! function_exists( 'catchflames_featured_image' ) ) :
/**
 * Template for Custom Header Image
 *
 * To override this in a child theme
 * simply create your own catchflames_featured_image(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_featured_image() {

	// Getting Data from Theme Options Panel
	global $catchflames_options_settings, $_wp_default_headers;
   	$options = $catchflames_options_settings;
	$header_image = get_header_image();

	$enableheaderimage = $options[ 'enable_featured_header_image' ];
		
	if ( !empty( $header_image ) ) {	

		// Header Image Title/Alt
		if ( !empty( $options[ 'featured_header_image_alt' ] ) ) :
			$title = esc_attr($options[ 'featured_header_image_alt' ]); 	
		else:
			$title = ''; 	
		endif;
		
		// Header Image Link 
		if ( !empty( $options[ 'featured_header_image_url' ] ) ) :
			//support for qtranslate custom link
			if ( function_exists( 'qtrans_convertURL' ) ) {
				$link = qtrans_convertURL($options[ 'featured_header_image_url' ]);
			}
			else {
				$link = esc_url($options[ 'featured_header_image_url' ]);
			}
			$linkopen = '<a title="'.$title.'" href="'.$link.'">';
			$linkclose = '</a>';
		else:
			$link = ''; 
			$base = ''; 
			$linkopen = '';
			$linkclose = '';
		endif;
		
		echo '<div id="header-image">' . $linkopen . '<img id="main-feat-img" alt="' . $title . '" src="' . esc_url( $header_image ) . '" />' . $linkclose . '</div><!-- #header-image -->';	
	}
	
} // catchflames_featured_image
endif;


if ( ! function_exists( 'catchflames_featured_page_post_image' ) ) :
/**
 * Template for Header Featured Image from Post and Page
 *
 * To override this in a child theme
 * simply create your own catchflames_featured_page_post_image(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_featured_page_post_image() {

	global $post, $wp_query, $catchflames_options_settings, $catchflames_options_defaults;
	
   	$options = $catchflames_options_settings;
	$defaults = $catchflames_options_defaults; 
	$enableheaderimage =  $options[ 'enable_featured_header_image' ];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	
	if ( $enableheaderimage == 'disable' ) {
		echo '<!-- Page/Post Disable Header Image -->';
	}
	elseif ( is_home() || is_archive() ) {
		if ( $enableheaderimage == 'postpage' ) {
			catchflames_featured_image();
		}
		else {
			echo '<!-- Page/Post will not display in Home/Archive -->';
		}
	}
	elseif ( has_post_thumbnail() ) {
		echo '<div id="header-image">';
		echo get_the_post_thumbnail($post->ID, 'full', array('id' => 'main-feat-img'));
		echo '</div><!-- #header-image -->';
	}
	else {
		catchflames_featured_image();
	}
	
} // catchflames_featured_page_post_image
endif;


if ( ! function_exists( 'catchflames_featured_overall_image' ) ) :
/**
 * Template for Header Featured Options
 *
 * To override this in a child theme
 * simply create your own catchflames_featured_overall_image(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_featured_overall_image() {

	global $post, $wp_query, $catchflames_options_settings, $catchflames_options_defaults;
   	$options = $catchflames_options_settings;
	$enableheaderimage =  $options[ 'enable_featured_header_image' ];
	
	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Check Homepage 
	if ( $enableheaderimage == 'homepage' ) {
		if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
			catchflames_featured_image();
		}
	}
	// Check Excluding Homepage 
	if ( $enableheaderimage == 'excludehome' ) {
		if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
			return false;
		}
		else {
			catchflames_featured_image();	
		}
	}
	// Check Entire Site
	elseif ( $enableheaderimage == 'allpage' ) {
		catchflames_featured_image();
	}
	// Check Entire Site (Post/Page)
	elseif ( $enableheaderimage == 'postpage' ) {
		if ( is_page() || is_single() ) {
			catchflames_featured_page_post_image();
		}
		else {
			catchflames_featured_image();
		}
	}	
	// Check Page/Post
	elseif ( $enableheaderimage == 'pagespostes' ) {
		if ( is_page() || is_single() ) {
			catchflames_featured_page_post_image();
		}
	}
	else {
		echo '<!-- Disable Header Image -->';
	}
	
} // catchflames_featured_overall_image
endif;


if ( ! function_exists( 'catchflames_featured_header' ) ) :
/**
 * Template for Displaying Featured Header Image with position selected in Theme Options Panel
 *
 * To override this in a child theme
 * simply create your own catchflames_featured_header(), and that function will be used instead.
 *
 * @since Catch Flames 1.0
 */
function catchflames_featured_header() {
	add_action( 'catchflames_after_header', 'catchflames_featured_overall_image', 10 );		
} // catchflames_featured_image_display
endif;

add_action( 'catchflames_before', 'catchflames_featured_header', 10 ); 