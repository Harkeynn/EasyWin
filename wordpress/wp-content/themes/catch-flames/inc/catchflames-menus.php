<?php 
if ( ! function_exists( 'catchflames_header_top_menu' ) ) :
/**
 * Header Menu
 *
 * @Hooked in catchflames_after_headercontent
 * @since Catch Flames 1.0
 */
function catchflames_header_top_menu() { 
	// Getting data from Theme Options
	global $catchflames_options_settings;
    $options = $catchflames_options_settings;
	
	// Check Fixed Header Top Status
	if ( empty( $options['enable_header_top'] ) )
		return;
	
	// Check Fixed Header Top Logo 
	if ( empty( $options['disable_top_menu_logo'] ) ) :
		
		$catchflames_fixed_logo = '';
		if ( !empty( $options[ 'top_menu_logo' ] ) ) :
			$catchflames_fixed_logo .= '<img src="' . esc_url( $options['top_menu_logo'] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
		else :
			// if empty featured_logo_header on theme options, display default logo
			$catchflames_fixed_logo .='<img src="' . esc_url( $defaults['top_menu_logo'] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
		endif;
	
		$classes = 'menu-with-logo'; 
		$headerimage = '<div id="top-logo">';
 		$headerimage .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">' . $catchflames_fixed_logo . '</a>';
        $headerimage .= '</div><!-- #top-logo -->';	
		
	else : 
	
		$classes = 'full-menu';
		$headerimage = '';
		
	endif; ?>
	
    <div id="header-top" class="<?php echo $classes; ?>">
        <div class="wrapper">
            <?php if ( has_nav_menu( 'top' ) ) : ?>
                <div id="mobile-fixed-header" class="mobile-menu">
                    <a href="#mobile-top-nav" id="fixed-header-menu" class="genericon genericon-menu">
                        <span class="mobile-menu-text"><?php _e( 'Menu', 'catchflames' );?></span>
                    </a>
                </div><!-- #mobile-fixed-header -->
            <?php endif; ?>
            
            <?php echo $headerimage; ?>
            <div id="header-extra">
            	
                <div id="header-social-toggle" class="genericon genericon-link">
                    <a class="assistive-text" href="#header-social-toggle"><?php _e( 'Connect', 'catchflames' );?></a>
             	</div>
                <div id="header-social" class="displaynone">
                   <?php catchflames_social_networks(); ?>
                </div><!-- #header-social -->
           
                <div id="header-search-toggle" class="genericon genericon-search">
                	<a class="assistive-text" href="#header-search-toggle"><?php _e( 'Search', 'catchflames' );?></a>
              	</div>
                <div id="header-search" class="displaynone">
                    <?php get_search_form(); ?>
                </div><!-- #header-search -->
              	   
            </div>           
            
            <?php if ( has_nav_menu( 'top' ) ) :
                echo '<nav id="access-top" role="navigation">';
                    $args = array(
                        'theme_location'    => 'top',
                        'container' 		=> false,
                        'items_wrap'        => '<ul id="top-nav" class="menu">%3$s</ul>' 
                    );
                    wp_nav_menu( $args );
                echo '</nav><!-- #access -->';
            endif; ?>
            
        </div><!-- .wrapper -->
        
    </div><!-- #header-top -->
    
<?php	
} // catchflames_header_top_menu 
endif;

add_action( 'catchflames_before_header', 'catchflames_header_top_menu', 10 ); 


if ( ! function_exists( 'catchflames_header_menu' ) ) :
/**
 * Header Menu
 *
 * @Hooked in catchflames_after_headercontent
 * @since Catch Flames 1.0
 */
function catchflames_header_menu() { 
	// Getting data from Theme Options
	global $catchflames_options_settings;
    $options = $catchflames_options_settings;	
	$header_menu = $options['disable_header_menu']; ?>
	
    <?php if ( empty ( $header_menu ) ) : ?>
        
        <div id="header-menu">
        
            <?php if ( empty ( $header_menu ) ) : ?>
                <nav id="access" role="navigation">
                    <h3 class="assistive-text"><?php _e( 'Primary menu', 'catchflames' ); ?></h3>
                    <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
                    <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'catchflames' ); ?>"><?php _e( 'Skip to primary content', 'catchflames' ); ?></a></div>
                    <div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'catchflames' ); ?>"><?php _e( 'Skip to secondary content', 'catchflames' ); ?></a></div>
                    <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
                
                    <?php
                        if ( has_nav_menu( 'primary' ) ) { 
                            $args = array(
                                'theme_location'    => 'primary',
                                'container_class' 	=> 'menu-header-container wrapper', 
                                'items_wrap'        => '<ul class="menu">%3$s</ul>' 
                            );
                            wp_nav_menu( $args );
                        }
                        else {
                            echo '<div class="menu-header-container wrapper">';
                                wp_page_menu( array( 'menu_class'  => 'menu' ) );
                            echo '</div>';
                        } ?> 		
                           
                </nav><!-- #access -->
            <?php endif; ?>
		
        </div><!-- #header-menu -->	
	
	<?php endif;
	
} // catchflames_header_menu
endif;

add_action( 'catchflames_after_header', 'catchflames_header_menu', 15 );


if ( ! function_exists( 'catchflames_main_mobile_menu' ) ) :
/**
 * Main Mobile Menu
 *
 * @Hooked in catchflames_headercontent
 * @since Catch Flames 1.0
 */
function catchflames_main_mobile_menu() {
	// Getting data from Theme Options
	global $catchflames_options_settings;
	$options = $catchflames_options_settings;	 
	
	if ( empty ( $options['disable_header_menu'] ) ) : ?>
   
		<?php if ( has_nav_menu( 'primary' ) ) : ?> 
            <div id="mobile-header-menu" class="mobile-menu primary-menu">
                <a href="#mobile-header-left-nav" id="header-left-menu" class="genericon genericon-menu">
                    <span class="mobile-menu-text"><?php _e( 'Menu', 'catchflames' );?></span>
                </a>
            </div><!-- #mobile-header-menu --> 
       <?php else : ?> 
            <div id="mobile-header-menu" class="mobile-menu page-menu">
                <a href="#mobile-header-left-nav" id="header-left-menu" class="genericon genericon-menu">
                    <span class="mobile-menu-text"><?php _e( 'Menu', 'catchflames' );?></span>
                </a>
            </div><!-- #mobile-header-menu -->           
       <?php endif; ?>
       
   	<?php endif; ?>     
    
<?php
}  
endif;

add_action( 'catchflames_headercontent', 'catchflames_main_mobile_menu', 10 );

if ( ! function_exists( 'catchflames_mobile_menus' ) ) :
/**
 * This function loads Footer Menus
 *
 * @get the data value from theme options
 * @uses catchflames_after action to add the code in the footer
 */
function catchflames_mobile_menus() {
	// get the data value from theme options
	global $catchflames_options_settings;
	$options = $catchflames_options_settings;

	// Check Header Top Mobile Menu
	if ( has_nav_menu( 'top' ) ) : 
		echo '<nav id="mobile-top-nav" role="navigation">';
			$args = array(
				'theme_location'    => 'top',
				'container' 		=> false,
				'items_wrap'        => '<ul id="top-nav" class="menu">%3$s</ul>' 
			);
			wp_nav_menu( $args );
		echo '</nav><!-- #mobile-top-nav -->';    
	endif; 


	// Check Header Left Mobile Menu	
	$header_menu = $options['disable_header_menu'];
	if ( empty ( $header_menu ) ) :
		if ( has_nav_menu( 'primary' ) ) :
			$count = '1';
			$location = 'primary';
		else :
			$count = '0';
			$location = 'none';
		endif; 
		echo '<nav id="mobile-header-left-nav" role="navigation">';
			if ( $count == '1' ) :
				$args = array(
					'theme_location'    => $location,
					'container' 		=> false,
					'items_wrap'        => '<ul id="header-left-nav" class="menu">%3$s</ul>' 
				);
				wp_nav_menu( $args );
			else :
				wp_page_menu( array( 'menu_class'  => 'menu' ) );
			endif;	
		echo '</nav><!-- #mobile-header-left-nav -->';    
	endif;
	
} //catchflames_mobile_menus
endif;

add_action( 'catchflames_after', 'catchflames_mobile_menus', 10 );