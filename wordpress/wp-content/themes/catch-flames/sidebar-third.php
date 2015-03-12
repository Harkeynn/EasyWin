<?php
/**
 * The Footer widget areas.
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
?>

<?php 
	//Getting Ready to load data from Theme Options Panel
	global $post, $wp_query, $catchflames_options_settings;
   	$options = $catchflames_options_settings;
	$themeoption_layout = $options['sidebar_layout'];

	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();	
	
	// Blog Page setting in Reading Settings
	if ( $page_id == $page_for_posts ) {
		$layout = get_post_meta( $page_for_posts,'catchflames-sidebarlayout', true );
	}
	// Settings for page/post/attachment
	elseif ( $post ) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'catchflames-sidebarlayout', true );
		} else {
			$layout = get_post_meta( $post->ID,'catchflames-sidebarlayout', true ); 
		}
	}
	
	// Default Settings
	if ( empty( $layout ) || ( !is_page() && !is_single() ) ) {
		$layout = 'default';
	}

	if ( $layout == 'three-columns' || ( $layout=='default' && $themeoption_layout == 'three-columns' ) || is_page_template( 'template-three-columns.php' ) ) : ?>
    
        <div id="third-sidebar" class="widget-area sidebar-three-columns" role="complementary">
			<?php 
			/** 
			 * catchflames_before_third hook
			 */
			do_action( 'catchflames_before_third' );         
        
			if ( is_active_sidebar( 'catchflames_third' ) ) {
				dynamic_sidebar( 'catchflames_third' ); 
			}
			else { ?>
            	<aside class="widget widget_text">
                	<h3 class="widget-title"><?php _e( 'Secondary Sidebar Widget Area', 'catchflames' ); ?></h3>
                    <div class="textwidget">
                    	<p><?php _e( 'This is the Secondary Sidebar Widget Area if you are using a three column site layout option.', 'catchflames' ); ?></p>
                    	<p><?php printf( __( 'You can add content to this area by visiting your <a href="%s">Widgets Panel</a> and adding new widgets to this area.', 'catchflames' ), admin_url( 'widgets.php' ) ); ?></p>
                  	</div>
				</aside>
			<?php 		
			}
			
			/** 
			 * catchflames_after_third hook
			 */
			do_action( 'catchflames_after_third' ); ?>  
                        
        </div><!-- #sidebar-third-column .widget-area -->
    	
	<?php endif; ?>			