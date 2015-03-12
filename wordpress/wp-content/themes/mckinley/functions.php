<?php
/**
 * McKinley functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage McKinley
 * @since McKinley 1.0
 */

/**
 * Sets up the content width value based on the theme's design.
 * @see mckinley_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;



/**
 * McKinley only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Sets up theme defaults and registers the various WordPress features that
 * McKinley supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_setup() {
	/*
	 * Makes McKinley available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on McKinley, use a find and
	 * replace to change 'mckinley' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'mckinley', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', mckinley_fonts_url() ) );
	
	// Adds theme support for title tag.
	add_theme_support( 'title-tag' );
	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		function theme_slug_render_title() {
	?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
		}
		add_action( 'wp_head', 'theme_slug_render_title' );
	}	

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	
	// Adds theme support for custom background.
	add_theme_support( "custom-background");

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'mckinley' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1000, 500, true );
	add_image_size('mckinley-post-thumb-big', 1000, 500, true);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'mckinley_setup' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Raleway by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since McKinley 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function mckinley_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$raleway = _x( 'on', 'Raleway font: on or off', 'mckinley' );	

	if ( 'off' !== $raleway) {
		$font_families = array();

		if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:400,700,800,900';			

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueues scripts and styles for front end.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to McKinley.
	wp_enqueue_script( 'mckinley-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );
	
	// Loads FitVids for better responsive videos.
	wp_enqueue_script('fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), '1.0', true);
	
	// Loads Flexslider for gallery slideshow.
	wp_enqueue_style('flexslider', get_template_directory_uri().'/css/flexslider.css', false, '2.0', 'all' );
	wp_enqueue_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '2.0', true);

	// Add Raleway font, used in the main stylesheet.
	wp_enqueue_style( 'mckinley-fonts', mckinley_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'mckinley-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'mckinley-ie', get_template_directory_uri() . '/css/ie.css', array( 'mckinley-style' ), '2013-07-18' );
	wp_style_add_data( 'mckinley-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'mckinley_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since McKinley 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function mckinley_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mckinley' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mckinley_wp_title', 10, 2 );

/**
 * Registers two widget areas.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'mckinley' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'mckinley' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'mckinley_widgets_init' );

if ( ! function_exists( 'mckinley_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'mckinley' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mckinley' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mckinley' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'mckinley_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since McKinley 1.0
*
* @return void
*/
function mckinley_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mckinley' ); ?></h1>
		<div class="nav-links">

			<div class="previous"><?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'mckinley' ) ); ?></div>
			<div class="next"><?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'mckinley' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'mckinley_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own mckinley_entry_meta() to override in a child theme.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'mckinley' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		mckinley_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'mckinley' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'mckinley' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'mckinley' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'mckinley_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own mckinley_entry_date() to override in a child theme.
 *
 * @since McKinley 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function mckinley_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'mckinley' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'mckinley' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'mckinley_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'mckinley_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since McKinley 1.0
 *
 * @return string The Link format URL.
 */
function mckinley_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since McKinley 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function mckinley_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'mckinley_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since McKinley 1.0
 *
 * @return void
 */
function mckinley_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'mckinley_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since McKinley 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function mckinley_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'mckinley_customize_register' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since McKinley 1.0
 */
function mckinley_customize_preview_js() {
	wp_enqueue_script( 'mckinley-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'mckinley_customize_preview_js' );

/**
 * Extract video from content for video post format.
 *
 * @since McKinley 1.0
 */
function the_featured_video( $content ) {
	$url = trim( array_shift( explode( "\n", $content ) ) );	
	if ( 0 === strpos( $url, 'http://' ) || preg_match ( '#^<(script|iframe|embed|object)#i', $url )) { 	
 		echo apply_filters( 'the_content', $url ); 	
 	}	 		
}

function content_sans_video( $content ) {
	$url = trim( array_shift( explode( "\n", $content ) ) );	
	if ( 0 === strpos( $url, 'http://' ) || preg_match ( '#^<(script|iframe|embed|object)#i', $url )) { 		
 		$content = trim( str_replace( $url, '', $content ) );  	
 	}
	return $content;
}


/**
 * Gets gallery attachments from post content
 *
 * @param int $post Post ID or object.
 * @return mixed False on failure, array with attachment objects on success
 * @since McKinley 1.0
 */
function mckinley_get_gallery_attachments( $post = null ) {

	$post = get_post( $post );
	if ( !$post )
		return false;

	$gallery_attachments = array();
	$pattern = get_shortcode_regex();
	preg_match_all( "/$pattern/s", $post->post_content , $matches, PREG_SET_ORDER );

	if ( !empty( $matches ) ) {
		foreach ( $matches as $match ) {
			if ( $match[2] == 'gallery' ) {
				// allow [[gallery]] syntax for escaping a tag
				if ( !( $match[1] == '[' && $match[6] == ']' ) ) {

					$attr = shortcode_parse_atts( $match[3] );

					if ( ! empty( $attr['ids'] ) ) {
						// 'ids' is explicitly ordered, unless you specify otherwise.
						if ( empty( $attr['orderby'] ) )
							$attr['orderby'] = 'post__in';
						$attr['include'] = $attr['ids'];
					}

					if ( isset( $attr['orderby'] ) ) {
						$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
						if ( !$attr['orderby'] )
							unset( $attr['orderby'] );
					}

					$defaults = array(
						'order'      => 'ASC',
						'orderby'    => 'menu_order ID',
						'id'         => $post->ID,
						'include'    => '',
						'exclude'    => ''
					);
					$args = wp_parse_args( $attr, $defaults );
					extract( $args );
					$id = intval( $id );
					if ( 'RAND' == $order )
						$orderby = 'none';

					if ( !empty( $include ) ) {
						$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
						$attachments = array();
						foreach ( $_attachments as $key => $val ) {
							$attachments[$val->ID] = $_attachments[$key];
						}
					} elseif ( !empty( $exclude ) ) {
						$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
					} else {
						$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
					}

					if ( !empty( $attachments ) )
						$gallery_attachments[] = $attachments;
				}
			}
		}
	}

	if ( !empty( $gallery_attachments ) )
		return $gallery_attachments;
	else
		return false;
}

/**
 * Removes standard gallery from gallery post format content.
 * 
 * @since McKinley 1.0
 */
function mckinley_strip_gallery($content) {
    $format = get_post_format();

	if ( ! $format ) :
		return $content;
	elseif ( $format == 'gallery' ) :	
		$pattern = get_shortcode_regex();
		preg_match('/'.$pattern.'/s', $content, $matches);
		if ( isset($matches[2]) && is_array($matches) && $matches[2] == 'gallery') {
		    //shortcode is being used
		    $content = str_replace( $matches['0'], '', $content );
		}
		return $content;
	else :
		 return $content;
	endif;	
}
add_filter('the_content','mckinley_strip_gallery');