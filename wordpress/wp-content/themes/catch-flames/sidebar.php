<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
?>

<?php 
/** 
 * catchflames_before_secondary hook
 */
do_action( 'catchflames_before_secondary' );

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
		$sidebaroptions = get_post_meta( $page_for_posts, 'catchflames-sidebar-options', true );
	}
	// Settings for page/post/attachment
	elseif ( $post ) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'catchflames-sidebarlayout', true );
			$sidebaroptions = get_post_meta( $parent, 'catchflames-sidebar-options', true );
		} else {
			$layout = get_post_meta( $post->ID,'catchflames-sidebarlayout', true ); 
			$sidebaroptions = get_post_meta( $post->ID, 'catchflames-sidebar-options', true );
		}
	}
	else {
		$sidebaroptions = '';
	}
	// Default Settings
	if ( empty( $layout ) || ( !is_page() && !is_single() ) ) {
		$layout = 'default';
	}
	// WooCommerce Settings
	if ( !is_active_sidebar( 'catchflames_woocommerce_sidebar' ) && ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) {
		$layout = 'no-sidebar';
	}

	if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' || $layout == 'three-columns' || ( $layout=='default' && $themeoption_layout == 'left-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'right-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'three-columns' ) ) : 
	?>
        <div id="secondary" class="widget-area" role="complementary">
			<?php 
			/** 
			 * catchflames_before_widget hook
			 */
			do_action( 'catchflames_before_widget' );        
            
			if ( is_active_sidebar( 'catchflames_woocommerce_sidebar' ) && ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) {	
				dynamic_sidebar( 'catchflames_woocommerce_sidebar' ); 
			}			
			elseif ( is_active_sidebar( 'sidebar-1' ) ) {
				dynamic_sidebar( 'sidebar-1' ); 
			}
            else { ?>
    			<aside class="widget widget_text">
                	<h3 class="widget-title"><?php _e( 'Primary Sidebar Widget Area', 'catchflames' ); ?></h3>
                    <div class="textwidget">
                    	<p><?php _e( 'This is the Primary Sidebar Widget Area if you are using a two or three column site layout option.', 'catchflames' ); ?></p>
                    	<p><?php printf( __( 'You can add content to this area by visiting your <a href="%s">Widgets Panel</a> and adding new widgets to this area.', 'catchflames' ), admin_url( 'widgets.php' ) ); ?></p>
                  	</div>
				</aside>
            <?php    
            }
           
			/** 
			 * catchflames_after_widget hook
			 */
			do_action( 'catchflames_after_widget' ); ?>                          
        </div><!-- #secondary .widget-area -->
        
    <?php endif;
	
/** 
 * catchflames_after_secondary hook
 */
do_action( 'catchflames_after_secondary' ); ?>