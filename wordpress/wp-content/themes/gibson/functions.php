<?php

// theme setup
if (!function_exists('gibson_setup')):
	function gibson_setup() {
		global $content_width;  
		if (!isset($content_width)) {$content_width = 650;}
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'gibson'),
			'footer' => __('Footer Menu', 'gibson')
		));		
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('title-tag');		
		add_image_size('featured', 795);
		add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
		// custom header
		$gibson_header_img = array(
			'default-image' => '%1$s/assets/img/header.jpg',
			'width' => 0,
			'height' => 500,
			'flex-height' => true,
			'flex-width' => true,
			'uploads' => true,
			'random-default' => false,
			'header-text' => false
		);
		add_theme_support('custom-header', $gibson_header_img);		
	}
endif; 
add_action('after_setup_theme', 'gibson_setup');

// load css 
function gibson_css() {	
	wp_enqueue_style('gibson_archivo', '//fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic,700,700italic');	
	wp_enqueue_style('gibson_bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');	   
	wp_enqueue_style('gibson_style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'gibson_css');

// load javascript
function gibson_javascript() {		
	wp_enqueue_script('gibson_script', get_template_directory_uri() . '/assets/js/gibson.js', array('jquery'), '1.0', true);
	if (is_singular() && comments_open()) {wp_enqueue_script('comment-reply');}
}
add_action('wp_enqueue_scripts', 'gibson_javascript');

// html5 shiv
function gibson_html5_shiv() {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'. get_template_directory_uri() .'/assets/js/html5shiv.min.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'gibson_html5_shiv');

// custom excerpts
function gibson_excerpt_length($length) {
	return 60;
}
add_filter('excerpt_length', 'gibson_excerpt_length', 999);
function gibson_excerpt_more($more) {
	return '&period;&period;&period;';
}
add_filter('excerpt_more', 'gibson_excerpt_more');

// widgets
function gibson_widgets_init() {
	register_sidebar(array(
		'name' => __('Primary Sidebar', 'gibson'),
		'id' => 'primary-sidebar',
		'description' => __('Widgets will appear in the right sidebar on posts and pages', 'gibson'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
}
add_action('widgets_init', 'gibson_widgets_init');

// theme customizer
function gibson_customize_register($wp_customize) {
	// upload logo
	$wp_customize->add_section('gibson_logo_section', array(
		'title' => __('Upload Logo', 'gibson'),
		'priority' => 1,
		'type' => 'option'		
	));
	$wp_customize->add_setting('gibson_logo_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label' => __('Logo', 'gibson'),
		'section' => 'gibson_logo_section',
		'settings' => 'gibson_logo_setting'
	)));	
	// accent color
	$wp_customize->add_setting('gibson_accent_color', array(        
        'default' => '#8bc34a',
	    'sanitize_callback' => 'sanitize_hex_color'
    )); 	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
		'label' => __('Accent Color', 'gibson'),        
        'section' => 'colors',
        'settings' => 'gibson_accent_color'
    )));
    // background color
    $wp_customize->add_setting('gibson_bg_color', array(        
        'default' => '#111111',
	    'sanitize_callback' => 'sanitize_hex_color'
    )); 	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bg_color', array(
		'label' => __('Background Color', 'gibson'),        
        'section' => 'colors',
        'settings' => 'gibson_bg_color'
    )));
    // display options
    $wp_customize->add_section('gibson_display_section', array(
		'title' => __('Display Options', 'gibson'),
		'priority' => 2,
		'type' => 'option'		
	));	
	// display options - teasers	
	$wp_customize->add_setting('gibson_teaser_setting', array(        
        'default' => 'no',
	    'sanitize_callback' => 'gibson_sanitize_yn'
    )); 	
	$wp_customize->add_control('gibson_teaser_control', array(
    'label'      => __('Teasers - display full post', 'gibson'),
    'section'    => 'gibson_display_section',
    'settings'   => 'gibson_teaser_setting',
    'type'       => 'select',
    'choices'    => array(
        'yes' => 'Yes',
        'no' => 'No'        
        )
	));
	// display options - welcome	
	$wp_customize->add_setting('gibson_welcome_setting', array(        
        'default' => 'no',
	    'sanitize_callback' => 'gibson_sanitize_yn'
    )); 	
	$wp_customize->add_control('gibson_welcome_control', array(
    'label'      => __('Welcome Message - show on all pages', 'gibson'),
    'section'    => 'gibson_display_section',
    'settings'   => 'gibson_welcome_setting',
    'type'       => 'select',
    'choices'    => array(
        'yes' => 'Yes',
        'no' => 'No'        
        )
	));
	// welcome message
	class Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea'; 
	    public function render_content() {
	        ?>	      
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>	        
	        <?php
	    }
	}	
	$wp_customize->add_section('gibson_welcome_heading_section', array(
		'title' => __('Welcome Message', 'gibson'),
		'priority' => 3,
		'type' => 'option'		
	));
	$wp_customize->add_setting('gibson_welcome_heading_setting', array(
		'sanitize_callback' => 'gibson_sanitize_text'
	)); 	
	$wp_customize->add_control('gibson_welcome_heading_control', array(
	        'label' => __('Heading', 'gibson'),
	        'section' => 'gibson_welcome_heading_section',
	        'settings' => 'gibson_welcome_heading_setting',
	        'type' => 'text',
	    )
	);
	$wp_customize->add_setting('gibson_welcome_text_setting',  array(        
        'sanitize_callback' => 'gibson_sanitize_text'
    )); 
	$wp_customize->add_control(new Customize_Textarea_Control($wp_customize, 'gibson_welcome_text_control', array(
	    'label'   => __('Text', 'gibson'),
	    'section' => 'gibson_welcome_heading_section',
	    'settings'   => 'gibson_welcome_text_setting',
	)));
	
	function gibson_sanitize_text($input) {
    	return wp_kses_post(force_balance_tags($input));
	}	
	function gibson_sanitize_yn($value) {
	    if (!in_array($value, array('yes', 'no'))) :
	        $value = 'no';	 
	    endif;
	    return $value;
	}
}
add_action('customize_register', 'gibson_customize_register');

// custom css
function gibson_customize_css() {
    ?>
     <style type="text/css">
     	body {background-color:<?php echo get_theme_mod('gibson_bg_color'); ?>;}
        a:hover, .sub-active a, header nav li.current-menu-item a, #welcome-message h3 {color:<?php echo get_theme_mod('gibson_accent_color'); ?>;}   
        header nav .sub-menu li a:hover {background-color:<?php echo get_theme_mod('gibson_accent_color'); ?>;}     
     </style>
    <?php
}
add_action('wp_head', 'gibson_customize_css');

// pagination
if (!function_exists('gibson_pagination')):
	function gibson_pagination() {
		global $wp_query;
		$big = 999999999;	
		echo '<div class="pager">';	
		echo paginate_links( array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'prev_next' => True,
			'prev_text' => __('<span>&lsaquo;</span> Previous', 'gibson'),
			'next_text' => __('Next <span>&rsaquo;</span>', 'gibson'),
		));
		echo '</div>';
	}
endif;

// comments
if (!function_exists('gibson_comment')) :
	function gibson_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
		?>	
		<li class="pingback">
        <?php comment_author_link(); ?>
	    <?php
	    break;
	    default :
	    ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">						
			<span class="comment-author"><?php comment_author(); ?> - </span>					
			<span class="comment-date"><?php echo get_comment_date() . ' @ ' . get_comment_time() ?> <?php edit_comment_link(__('Edit', 'gibson'), '', ''); ?></span>																			
			<?php comment_text(); ?>
			<?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'gibson'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			<?php if ('0' == $comment->comment_approved) : ?>				
				<p class="comment-awaiting-moderation"><?php _e('Comment is awaiting moderation!', 'gibson'); ?></p>					
			<?php endif; ?>						
		<?php 	
        break;
    	endswitch;
	}
endif;
?>