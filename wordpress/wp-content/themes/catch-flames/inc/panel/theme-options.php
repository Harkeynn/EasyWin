<?php
/**
 * Catch Flames Theme Options
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
add_action( 'admin_init', 'catchflames_register_settings' );
add_action( 'admin_menu', 'catchflames_options_menu' );


/**
 * Enqueue admin script and styles
 *
 * @uses wp_register_script, wp_enqueue_script and wp_enqueue_style
 * @Calling jquery, jquery-ui-tabs,jquery-cookie, jquery-ui-sortable, jquery-ui-draggable, media-upload, thickbox, farbtastic, colorpicker
 */
function catchflames_admin_scripts() {
	//jquery-cookie registered in functions.php
	wp_enqueue_script( 'catchflames_admin', get_template_directory_uri().'/inc/panel/admin.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-cookie', 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
	
    wp_enqueue_media();
        
    wp_enqueue_script( 'catchflames_upload', get_template_directory_uri().'/inc/panel/add_image_scripts.min.js', array( 'jquery' ) );

	wp_enqueue_style( 'catchflames_admin',get_template_directory_uri().'/inc/panel/admin.css', '', '1.0', 'screen' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'catchflames_admin_scripts' );


/**
 * Enqueue admin script and styles
 *
 * @uses wp_register_script, wp_enqueue_script and wp_enqueue_style
 * @Calling jquery, jquery-ui-tabs,jquery-cookie, jquery-ui-sortable, jquery-ui-draggable, media-upload, thickbox, farbtastic, colorpicker
 */
function catchflames_admin_style() {
	wp_enqueue_style( 'catchflames_admin_page_post',get_template_directory_uri().'/inc/panel/admin-page-post.css', '1.0', 'screen' );
}
add_action( 'admin_print_styles', 'catchflames_admin_style' );


/*
 * Create a function for Theme Options Page
 *
 * @uses add_theme_page
 * @add action admin_menu 
 */
function catchflames_options_menu() {
	
	add_theme_page( 
        __( 'Theme Options', 'catchflames' ),           // Name of page
        __( 'Theme Options', 'catchflames' ),           // Label in menu
        'edit_theme_options',                           // Capability required
        'theme_options',                                // Menu slug, used to uniquely identify the page
        'catchflames_theme_options_do_page'             // Function that renders the options page
    );		

}


/*
 * Register options and validation callbacks
 *
 * @uses register_setting
 * @action admin_init
 */
function catchflames_register_settings(){
	register_setting( 'catchflames_options', 'catchflames_options', 'catchflames_theme_options_validate' );
}


/*
 * Render Catch Flames Theme Options page
 *
 * @uses settings_fields, get_option, bloginfo
 * @Settings Updated
 */
function catchflames_theme_options_do_page() {
	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
	<div id="catchthemes" class="wrap">
    	
    	<form method="post" action="options.php">
			<?php
                settings_fields( 'catchflames_options' );
                global $catchflames_options_settings;
                $options = $catchflames_options_settings;
				
				//Getting Units
				$units = array( 'px', 'pt', 'em', '%' ); 
            ?>   
            
            <?php if (false !== $_REQUEST['settings-updated']) : ?>
            	<div class="updated fade"><p><strong><?php _e('Options Saved', 'catchflames'); ?></strong></p></div>
            <?php endif; ?>
            
			<div id="theme-option-header">            
                <div id="theme-option-title">
                    <h2 class="title"><?php _e( 'Theme Options By', 'catchflames' ); ?></h2>
                    <h2 class="logo">
                        <a href="<?php echo esc_url( __( 'http://catchthemes.com/', 'catchflames' ) ); ?>" title="<?php esc_attr_e( 'Catch Themes', 'catchflames' ); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri().'/inc/panel/images/catch-themes.png'; ?>" alt="<?php _e( 'Catch Themes', 'catchflames' ); ?>" />
                        </a>
                    </h2>
                </div><!-- #theme-option-title -->
            
                <div id="theme-support">
                    <ul>
                        <li><a class="button" href="<?php echo esc_url( __( 'http://catchthemes.com/support-forum/forum/catch-flames-pro-premium/','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Support Forum', 'catchflames' ); ?>" target="_blank"><?php printf( __( 'Support Forum','catchflames' ) ); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url( __( 'http://catchthemes.com/theme-instructions/catch-flames-pro/','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Theme Instruction', 'catchflames' ); ?>" target="_blank"><?php printf( __( 'Theme Instruction','catchflames' ) ); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url( __( 'https://www.facebook.com/catchthemes/','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Like Catch Themes on Facebook', 'catchflames' ); ?>" target="_blank"><?php printf( __( 'Facebook','catchflames' ) ); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url( __( 'https://twitter.com/catchthemes/','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Follow Catch Themes on Twitter', 'catchflames' ); ?>" target="_blank"><?php printf( __( 'Twitter','catchflames' ) ); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url( __( 'https://plus.google.com/+Catchthemes','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Follow Catch Themes on Google+', 'catchflames' ); ?>" target="_blank"><?php printf( __( 'Google+','catchflames' ) ); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url( __( 'http://wordpress.org/support/view/theme-reviews/catch-flames/','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Rate us 5 Star on WordPress', 'catchflames' ); ?>" target="_blank"><?php printf( __( '5 Star Rating','catchflames' ) ); ?></a></li>
                   	</ul>
                </div><!-- #theme-support --> 
                 
          	</div><!-- #theme-option-header -->                  
                            
            
            <div id="catchflames_ad_tabs">
                <ul class="tabNavigation" id="mainNav">
                    <li><a href="#themeoptions"><?php _e( 'Theme Options', 'catchflames' );?></a></li>
                    <li><a href="#color-options"><?php _e( 'Color Options', 'catchflames' );?></a></li>
                    <li><a href="#slidersettings"><?php _e( 'Featured Slider', 'catchflames' );?></a></li>
                    <li><a href="#sociallinks"><?php _e( 'Social Links', 'catchflames' );?></a></li>
                </ul><!-- .tabsNavigation #mainNav -->
                   
                <!-- Option for Theme Options -->
                <div id="themeoptions">                    
                    <div id="fav-icons" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Favicon', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                       		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Disable Favicon?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<input type='hidden' value='0' name='catchflames_options[remove_favicon]'>
                                  	<input type="checkbox" id="favicon" name="catchflames_options[remove_favicon]" value="1" <?php checked( '1', $options['remove_favicon'] ); ?> /> <?php _e('Check to disable', 'catchflames'); ?>
                               	</div>
                          	</div><!-- .row -->  
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Fav Icon URL:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                    <?php if ( !empty ( $options[ 'fav_icon' ] ) ) { ?>
                                        <input class="upload-url" size="65" type="text" name="catchflames_options[fav_icon]" value="<?php echo esc_url( $options [ 'fav_icon' ] ); ?>" />
                                        <?php } else { ?>
                                        <input class="upload-url" size="65" type="text" name="catchflames_options[fav_icon]" value="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" alt="fav" />
                                        <?php }  ?> 
                                        <input ref="<?php esc_attr_e( 'Insert as Favicon','catchflames' );?>" class="catchflames_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Favicon','catchflames' );?>" />
                                </div>
                         	</div><!-- .row -->                            
                       		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Preview', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">                                    
									<?php 
                                        if ( !empty( $options[ 'fav_icon' ] ) ) { 
                                            echo '<img src="'.esc_url( $options[ 'fav_icon' ] ).'" alt="fav" />';
                                        } else {
                                            echo '<img src="'. get_template_directory_uri().'/images/favicon.ico" alt="fav" />';
                                        }
                                    ?>
                               </div>
                            </div><!-- .row -->
                            <div class="row">
                      			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->      
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->      
                                        
                    <div id="webclip-icon" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Web Clip Icon Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                       		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Disable Web Clip Icon?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">                    
                                    <input type='hidden' value='0' name='catchflames_options[remove_web_clip]'>
                                    <input type="checkbox" id="favicon" name="catchflames_options[remove_web_clip]" value="1" <?php checked( '1', $options['remove_web_clip'] ); ?> /> <?php _e('Check to disable', 'catchflames'); ?>
                               	</div>
                           	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Web Clip Icon URL:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">                                                     
									<?php if ( !empty ( $options[ 'web_clip' ] ) ) { ?>
                                        <input class="upload-url" size="65" type="text" name="catchflames_options[web_clip]" value="<?php echo esc_url( $options [ 'web_clip' ] ); ?>" class="upload" />
                                    <?php } else { ?>
                                        <input size="65" type="text" name="catchflames_options[web_clip]" value="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" alt="fav" />
                                    <?php }  ?> 
                                    <input ref="<?php esc_attr_e( 'Insert as Web Clip Icon','catchflames' );?>" class="catchflames_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Web Clip Icon','catchflames' );?>" />
                             	</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Preview', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">                                
									<?php 
                                        if ( !empty( $options[ 'web_clip' ] ) ) { 
                                            echo '<img src="'.esc_url( $options[ 'web_clip' ] ).'" alt="Web Clip Icon" />';
                                        } else {
                                            echo '<img src="'. get_template_directory_uri().'/images/apple-touch-icon.png" alt="Web Clip Icon" />';
                                        }
                                    ?>
                            	</div>
                         	</div><!-- .row -->
                            <div class="row">
                             	<?php esc_attr_e( 'Note: Web Clip Icon for Apple devices. Recommended Size - Width 144px and Height 144px height, which will support High Resolution Devices like iPad Retina.', 'catchflames' ); ?>
                           	</div><!-- .row -->
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->        
                                    
               		<div id="fixed-header-top-options" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Fixed Header Top Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">  
                      		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Enable Fixed Header Top?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<input type='hidden' value='0' name='catchflames_options[enable_header_top]'>
                                  	<input type="checkbox" id="enable-header-top" name="catchflames_options[enable_header_top]" value="1" <?php checked( '1', $options['enable_header_top'] ); ?> /> <?php _e('Check to enable', 'catchflames'); ?>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Disable Logo in Fixed Header Top?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<input type='hidden' value='0' name='catchflames_options[disable_top_menu_logo]'>
                                   	<input type="checkbox" id="disable-fixed-logo" name="catchflames_options[disable_top_menu_logo]" value="1" <?php checked( '1', $options['disable_top_menu_logo'] ); ?> /> <?php _e('Check to disable', 'catchflames'); ?>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Logo in Fixed Header Top:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
									<?php  if ( !empty ( $options[ 'top_menu_logo' ] ) ) { ?>
                                    	<input  class="upload-url" size="65" type="text" name="catchflames_options[top_menu_logo]" value="<?php echo esc_url ( $options [ 'top_menu_logo' ]); ?>" class="upload" />
                                    <?php } else { ?>
                                     	<input class="upload-url" size="65" type="text" name="catchflames_options[top_menu_logo]" value="<?php echo get_template_directory_uri(); ?>/images/fixed-logo.png" alt="logo" />
                                    <?php }  ?>
                                  	<input ref="<?php esc_attr_e( 'Insert as Header Logo','catchflames' );?>" class="catchflames_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Header Logo','catchflames' );?>" />
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Fixed Header Top Menu', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	 <?php _e( 'You need to create custom menu and then assign menu location as Featured Header Top Menu. For more go to Menu Option Below', 'catchflames' ); ?>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->             
       
       				<div id="header-options" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Custom Header Image', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<?php _e( 'Custom Header Image can be managed from Header Featured Image Options', 'catchflames' ); ?>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Disable Header Logo?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<input type='hidden' value='0' name='catchflames_options[remove_header_logo]'>
                                   	<input type="checkbox" id="headerlogo" name="catchflames_options[remove_header_logo]" value="1" <?php checked( '1', $options['remove_header_logo'] ); ?> /> <?php _e('Check to disable', 'catchflames'); ?>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Logo url:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
									<?php  if ( !empty ( $options[ 'featured_logo_header' ] ) ) { ?>
                                    	<input  class="upload-url" size="65" type="text" name="catchflames_options[featured_logo_header]" value="<?php echo esc_url ( $options [ 'featured_logo_header' ]); ?>" class="upload" />
                                     <?php } else { ?>
                                     	<input class="upload-url" size="65" type="text" name="catchflames_options[featured_logo_header]" value="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo" />
                                     <?php }  ?>
                                    <input ref="<?php esc_attr_e( 'Insert as Logo','catchflames' );?>" class="catchflames_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Logo','catchflames' );?>" />
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Preview:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
									<?php 
                                    if ( !empty( $options[ 'featured_logo_header' ] ) ) { 
                                    	echo '<img src="'.esc_url( $options[ 'featured_logo_header' ] ).'" alt=""/>';
                                    } else {
                                    	echo '<img src="'. get_template_directory_uri().'/images/logo.png" alt="" />';
                                    } ?>
                           		</div>
                         	</div><!-- .row -->                                                         
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                         
                  	<div id="header-featured-image" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Featured Image Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                      		<div class="row">
                            	<div class="col col-header">
                                	<?php _e( 'Enable Featured Header Image', 'catchflames' ); ?>
                                </div>
                                <div class="col col-options">
                                	<label title="enable-header-homepage">
                                        <input type="radio" name="catchflames_options[enable_featured_header_image]" id="enable-header-homepage" <?php checked($options['enable_featured_header_image'], 'excludehome'); ?> value="excludehome"  />
                                       <?php _e( 'Excluding Homepage', 'catchflames' ); ?>
                                    </label>
                                                                            
                                    <label title="enable-header-homepage">
                                        <input type="radio" name="catchflames_options[enable_featured_header_image]" id="enable-header-homepage" <?php checked($options['enable_featured_header_image'], 'homepage'); ?> value="homepage"  />
                                        <?php _e( 'Homepage', 'catchflames' ); ?>
                                    </label>
                                                                                                                        
                                    <label title="enable-header-allpage">
                                        <input type="radio" name="catchflames_options[enable_featured_header_image]" id="enable-header-allpage" <?php checked($options['enable_featured_header_image'], 'allpage'); ?> value="allpage"  />
                                         <?php _e( 'Entire Site', 'catchflames' ); ?>
                                    </label>
                                    
                                    <label title="enable-header-postpage">
                                        <input type="radio" name="catchflames_options[enable_featured_header_image]" id="enable-header-postpage" <?php checked($options['enable_featured_header_image'], 'postpage'); ?> value="postpage"  />
                                         <?php _e( 'Entire Site, Page/Post Featured Image', 'catchflames' ); ?>
                                    </label> 
                                    
                                    <label title="enable-header-pagespostes">
                                        <input type="radio" name="catchflames_options[enable_featured_header_image]" id="enable-header-pagespostes" <?php checked($options['enable_featured_header_image'], 'pagespostes'); ?> value="pagespostes"  />
                                         <?php _e( 'Pages & Posts', 'catchflames' ); ?>
                                    </label> 
                                    
                                    <label title="disable-header">
                                        <input type="radio" name="catchflames_options[enable_featured_header_image]" id="disable-header" <?php checked($options['enable_featured_header_image'], 'disable'); ?> value="disable" />
                                         <?php _e( 'Disable', 'catchflames' ); ?>
                                    </label>  
                           		</div>
                          	</div><!-- .row --> 
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Header Image:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">                                   
									<?php 
                                    $header_image = get_header_image();
                                    if ( !empty ( $header_image ) ) { 
                                    	echo '<a class="button" href="' . admin_url('themes.php?page=custom-header') . '" title="' .esc_attr__( 'Click here to change header image', 'catchflames' ). '">' . __( 'Click here to change Header Image', 'catchflames' ) . '</a>';
                                    } else { 
                                   		echo '<a class="button" href="' . admin_url('themes.php?page=custom-header') . '" title="' .esc_attr__( 'Click here to change header image', 'catchflames' ). '">' . __( 'Click here to add Header Image', 'catchflames' ) . '</a>';
									} ?> 
                             	</div>
                          	</div><!-- .row --> 
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Preview', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">                                         
									<?php 
                                    if ( !empty( $header_image ) ) { 
                                   		echo '<img src="'.esc_url( $header_image ).'" alt=""  style="width: 90%; height:auto" />';
                                    } else {
                                    	_e( 'There is no Header Image', 'catchflames' );
                                    } ?>
                             	</div>
                          	</div><!-- .row -->                                                                     
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Featured Header Image Alt/Title Tag', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">       
                              		<input type="text" size="65" name="catchflames_options[featured_header_image_alt]" value="<?php echo esc_attr( $options [ 'featured_header_image_alt' ] ); ?>" />
                               	</div>
                          	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Featured Header Image Link URL', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">         
                                  	<input type="text" size="65" name="catchflames_options[featured_header_image_url]" value="<?php echo esc_url( $options [ 'featured_header_image_url' ] ); ?>" />
                             	</div>
                          	</div><!-- .row -->                            
                            <div class="row">
                            	<div class="col col-1">
                                	<?php if( $options[ 'reset_header_image' ] == "1" ) { $options[ 'reset_header_image' ] = "0"; } ?>
                                	<?php _e( 'Reset Header Featured Image Options?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">        
                                	<input type='hidden' value='0' name='catchflames_options[reset_header_image]'>
                                    <input type="checkbox" id="reset_header_image" name="catchflames_options[reset_header_image]" value="1" <?php checked( '1', $options['reset_header_image'] ); ?> /> <?php _e('Check to reset', 'catchflames'); ?>
                              </div>
                          	</div><!-- .row -->                                                         
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row --> 
						</div><!-- .option-content --> 
                 	</div><!-- .option-container -->  
                    
                    <div id="header-options" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Menu Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">  
                      		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Menu Tutorial', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<a class="button" href="<?php echo esc_url( __( 'http://catchthemes.com/blog/custom-menus-wordpress-themes/','catchflames' ) ); ?>" title="<?php esc_attr_e( 'Menu Tutorial', 'catchflames' ); ?>" target="_blank"><?php _e( 'Click Here to Read Menu Tutorial', 'catchflames' );?></a>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Custom Menus', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<a class="button" href="<?php echo admin_url('nav-menus.php'); ?>" title="<?php esc_attr_e( 'Click to Create Custom Menus', 'catchflames' ); ?>"><?php _e( 'Click Here to Create Menu', 'catchflames' );?></a>
                           		</div>
                         	</div><!-- .row -->
                           	<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Assign Locations', 'catchflames' ); ?>
                                     <small><?php _e( 'Note: You can assign your custom menu to Fixed Header Top Menu, Header Right Sidebar Menu, Primary Menu, Secondary Menu and Footer Menu Locations. This will replace the WordPress default page menu', 'catchflames' ); ?></small>
                                </div>
                                <div class="col col-2">
                                	<a class="button" href="<?php echo admin_url('nav-menus.php?action=locations'); ?>" title="<?php esc_attr_e( 'Click to Manage Menu Locations', 'catchflames' ); ?>"><?php _e( 'Click to Manage Menu Locations', 'catchflames' );?></a>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Disable Default Page Menu?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<input type='hidden' value='0' name='catchflames_options[disable_header_menu]'>
                                   	<input type="checkbox" id="disable_header_menu" name="catchflames_options[disable_header_menu]" value="1" <?php checked( '1', $options['disable_header_menu'] ); ?> /> <?php _e('Check to disable', 'catchflames'); ?>
                           		</div>
                         	</div><!-- .row -->
                            <div class="row">
                                    <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                           	</div><!-- .row -->
                       	</div><!-- .option-content -->
                  	</div><!-- .option-container --> 
                    
                    <div id="search-settings" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Search Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                        	<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Default Display Text in Search', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">  
                                	<input type="text" size="45" name="catchflames_options[search_display_text]" value="<?php echo ( isset( $options[ 'search_display_text' ] ) ) ? esc_attr( $options[ 'search_display_text' ] ) : 'Search'; ?>" />
                             	</div>
                          	</div><!-- .row -->                                                         
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->    
                    
                    <div id="layout-options" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Layout Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                       		<div class="row">
                            	<div class="col col-header">
                        			<?php _e( 'Default Layout Options', 'catchflames' ); ?>
                               	</div>
                                <div class="col col-options">               
                              		<label title="three-columns" class="box first"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/three-columns.png" alt="Three Columns" /><br />
                                		<input type="radio" name="catchflames_options[sidebar_layout]" id="three-columns" <?php checked($options['sidebar_layout'], 'three-columns') ?> value="three-columns"  />
                                		<?php _e( 'Three Columns', 'catchflames' ); ?>
                                	</label>                                                               
                                    
                                    <label title="right-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/right-sidebar.png" alt="Content-Sidebar" /><br />
                                    	<input type="radio" name="catchflames_options[sidebar_layout]" id="right-sidebar" <?php checked($options['sidebar_layout'], 'right-sidebar') ?> value="right-sidebar"  />
                                    	<?php _e( 'Right Sidebar', 'catchflames' ); ?>
                                    </label>  
                                    
                                    <label title="left-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/left-sidebar.png" alt="Content-Sidebar" /><br />
                                    	<input type="radio" name="catchflames_options[sidebar_layout]" id="left-sidebar" <?php checked($options['sidebar_layout'], 'left-sidebar') ?> value="left-sidebar"  />
                                    	<?php _e( 'Left Sidebar', 'catchflames' ); ?>
                                    </label>
                                     
                                    <label title="no-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/no-sidebar.png" alt="Content-Sidebar" /><br />
                                   		<input type="radio" name="catchflames_options[sidebar_layout]" id="no-sidebar" <?php checked($options['sidebar_layout'], 'no-sidebar') ?> value="no-sidebar"  />
                                    	<?php _e( 'No Sidebar', 'catchflames' ); ?>
                                    </label>                                    
                        		</div>
                            </div><!-- .row -->                                             
                         	<div class="row">
                            	<div class="col col-header">
                        			<?php _e( 'Archive Content Layout', 'catchflames' ); ?>
                               	</div>
                                <div class="col col-options">     
									<label title="content-excerpt" class="box first"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/excerpt-blog.jpg" alt="Excerpt/Blog Display" /><br />
                                		<input type="radio" name="catchflames_options[content_layout]" id="content-excerpt" <?php checked($options['content_layout'], 'excerpt-border') ?> value="excerpt-border"  />
                                		<?php _e( 'Excerpt/Blog Display', 'catchflames' ); ?>
                                	</label>                           
                                
                                    <label title="content-full" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/full-content.jpg" alt="Full Content Display" /><br />
                                    	<input type="radio" name="catchflames_options[content_layout]" id="content-full" <?php checked($options['content_layout'], 'full') ?> value="full"  />
                                    <?php _e( 'Full Content Display', 'catchflames' ); ?>
                                    </label>
                              	</div>
                            </div><!-- .row --> 
                            <div class="row">
                            	<div class="col col-header">
                                	<?php if( $options[ 'reset_sidebar_layout' ] == "1" ) { $options[ 'reset_sidebar_layout' ] = "0"; } ?>
                                	<?php _e( 'Reset Layout?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-options">         
                                	<input type='hidden' value='0' name='catchflames_options[reset_sidebar_layout]'>
                                    <input type="checkbox" id="reset_family" name="catchflames_options[reset_sidebar_layout]" value="1" <?php checked( '1', $options['reset_sidebar_layout'] ); ?> /> <?php _e('Check to reset', 'catchflames'); ?>
                              	</div>
                          	</div><!-- .row -->                                                         
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->                             
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                            
                    <div id="homepage-category-setting" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Homepage / Frontpage Category Setting', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside"> 
                       		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Front page posts categories:', 'catchflames' ); ?>
                                    <p><small><?php _e( 'Only posts that belong to the categories selected here will be displayed on the front page.', 'catchflames' ); ?></small></p>
                                </div>
                                <div class="col col-2">  
                                    <select name="catchflames_options[front_page_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple">
                                        <option value="0" <?php if ( empty( $options['front_page_category'] ) ) { echo 'selected="selected"'; } ?>><?php _e( '--Disabled--', 'catchflames' ); ?></option>
                                        <?php /* Get the list of categories */  
                                            $categories = get_categories();
                                            if( empty( $options[ 'front_page_category' ] ) ) {
                                                $options[ 'front_page_category' ] = array();
                                            }
                                            foreach ( $categories as $category) :
                                        ?>
                                        <option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['front_page_category'] ) ) {echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
                                        <?php endforeach; ?>
                                    </select><br />
                                    <span class="description"><?php _e( 'You may select multiple categories by holding down the CTRL key.', 'catchflames' ); ?></span>
                               	</div>
                          	</div><!-- .row -->                            
                         	<div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                            </div><!-- .row --> 
                        </div><!-- .option-content -->
                  	</div><!-- .option-container --> 
                         
                 	<div id="excerpt-more-tag" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Excerpt / More Tag Settings', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                       		<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'More Tag Text', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">  
                                	<input type="text" size="45" name="catchflames_options[more_tag_text]" value="<?php echo ( isset( $options[ 'more_tag_text' ] ) ) ? esc_attr( $options[ 'more_tag_text' ] ) : 'Continue Reading &rarr;'; ?>" />
                             	</div>
                          	</div><!-- .row -->
                        	<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Excerpt length(words)', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">  
                                	<input type="text" size="3" name="catchflames_options[excerpt_length]" value="<?php echo intval( $options[ 'excerpt_length' ] ); ?>" />
                             	</div>
                          	</div><!-- .row -->                           
                            <div class="row">
                            	<div class="col col-1">
                                	<?php if( $options[ 'reset_more_tag' ] == "1" ) { $options[ 'reset_more_tag' ] = "0"; } ?>
                                	<?php _e( 'Reset Excerpt?', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">         
                                	<input type='hidden' value='0' name='catchflames_options[reset_more_tag]'>
                                  	<input type="checkbox" id="reset_more_tag" name="catchflames_options[reset_more_tag]" value="1" <?php checked( '1', $options['reset_more_tag'] ); ?> /> <?php _e('Check to reset', 'catchflames'); ?>
                              	</div>
                          	</div><!-- .row -->                                                         
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                                        
					<div id="custom-css" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Custom CSS', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside"> 
                        	<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Enter your custom CSS styles.', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2"> 
                                	<textarea name="catchflames_options[custom_css]" id="custom-css" cols="90" rows="12"><?php echo esc_attr( $options[ 'custom_css' ] ); ?></textarea>
                            	</div>
                          	</div><!-- .row --> 
                        	<div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'CSS Tutorial from W3Schools.', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2"> 
                                	<a class="button" href="<?php echo esc_url( __( 'http://www.w3schools.com/css/default.asp','catchflames' ) ); ?>" title="<?php esc_attr_e( 'CSS Tutorial', 'catchflames' ); ?>" target="_blank"><?php _e( 'Click Here to Read', 'catchflames' );?></a>
                            	</div>
                          	</div><!-- .row -->                            
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                    
                    <div id="scrollup" class="option-container">
                    	<h3 class="option-toggle"><a href="#"><?php _e( 'Scroll Up', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                        	<div class="row">
                            	<div class="col col-1">
									<?php _e( 'Disable Scroll Up?', 'catchflames' ); ?></th>
                                </div>
                                <div class="col col-2">
                                        <input type='hidden' value='0' name='catchflames_options[disable_scrollup]'>
                                        <input type="checkbox" id="headerlogo" name="catchflames_options[disable_scrollup]" value="1" <?php checked( '1', $options['disable_scrollup'] ); ?> /> <?php _e('Check to disable', 'catchflames'); ?>
                                 </div>
                          	</div><!-- .row -->
                      		<div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row --> 
                        </div><!-- .option-content -->   
                    </div><!-- .option-container -->                     
                </div><!-- #themeoptions --> 
                 
				<!-- Option for Color Options -->
                <div id="color-options">                 
                	<div id="color-scheme" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Color Scheme', 'catchflames' ); ?></a></h3>
                        <div class="option-content show inside">
                        	<div class="row">
                            	<div class="col col-header">
                        			<?php _e( 'Default Color Scheme', 'catchflames' ); ?>
                               	</div>
                                <div class="col col-options">
                                    <label title="color-light" class="box first"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/light.jpg" alt="color-light" /><br />
                                    	<input type="radio" name="catchflames_options[color_scheme]" id="color-light" <?php checked($options['color_scheme'], 'light') ?> value="light"  />
                                    	<?php _e( 'Light', 'catchflames' ); ?>
                                    </label>
                                    <label title="color-dark" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/dark.jpg" alt="color-dark" /><br />
                                    	<input type="radio" name="catchflames_options[color_scheme]" id="color-dark" <?php checked($options['color_scheme'], 'dark') ?> value="dark"  />
                                    	<?php _e( 'Dark', 'catchflames' ); ?>
                                    </label>    
                              	</div>
                          	</div><!-- .row --> 
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row -->                              
                  		</div><!-- .option-content -->
                  	</div><!-- #color-scheme -->
                </div><!-- #color-options -->
                
                <!-- Option for Slider Options -->
                <div id="slidersettings">
                	<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Slider Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside"> 
                        	<div class="row">
                            	<div class="col col-header">
                                	<?php _e( 'Select Slider Type', 'catchflames' ); ?>
                                </div>
                                <div class="col col-options"> 
                                	<label title="demo-slider">
                                    	<input type="radio" name="catchflames_options[select_slider_type]" id="demo-slider" <?php checked($options['select_slider_type'], 'demo-slider'); ?> value="demo-slider"  />
                                    	<?php _e( 'Demo Slider', 'catchflames' ); ?>
                                    </label>                                       
                                    
                                    <label title="page-slider">
                                   		<input type="radio" name="catchflames_options[select_slider_type]" id="page-slider" <?php checked($options['select_slider_type'], 'page-slider') ?> value="page-slider"  />
                                    	<?php _e( 'Featured Page Slider', 'catchflames' ); ?>
                                    </label>
                                </div>
                          	</div><!-- .row --> 
                        
                			<div class="row">                            
                            	<div class="col col-header">
                        			<?php _e( 'Enable Sidebar', 'catchflames' ); ?>
                               	</div>
                                <div class="col col-options"> 
                                    <label title="enable-slider-homepager">
                                    	<input type="radio" name="catchflames_options[enable_slider]" id="enable-slider-homepage" <?php checked($options['enable_slider'], 'enable-slider-homepage') ?> value="enable-slider-homepage"  />
                                    	<?php _e( 'Homepage / Frontpage', 'catchflames' ); ?>
                                    </label>
                                    
                                    <label title="enable-slider-allpage">
                                    	<input type="radio" name="catchflames_options[enable_slider]" id="enable-slider-allpage" <?php checked($options['enable_slider'], 'enable-slider-allpage') ?> value="enable-slider-allpage"  />
                                  		<?php _e( 'Entire Site', 'catchflames' ); ?>
                                    </label>
                                    
                                    <label title="disable-slider">
                                    	<input type="radio" name="catchflames_options[enable_slider]" id="disable-slider" <?php checked($options['enable_slider'], 'disable-slider') ?> value="disable-slider"  />
                                     	<?php _e( 'Disable', 'catchflames' ); ?>
                                   	</label> 
                           		</div>
                         	</div><!-- .row -->
                            
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Number of Slides', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2">
                                	<input type="text" name="catchflames_options[slider_qty]" value="<?php echo intval( $options[ 'slider_qty' ] ); ?>" size="2" />
                             	</div>
                          	</div><!-- .row -->                               
                            
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Transition Effect:', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2"> 
                                    <select id="catchflames_cycle_style" name="catchflames_options[transition_effect]">
                                        <option value="fade" <?php selected('fade', $options['transition_effect']); ?>><?php _e( 'fade', 'catchflames' ); ?></option>
                                        <option value="wipe" <?php selected('wipe', $options['transition_effect']); ?>><?php _e( 'wipe', 'catchflames' ); ?></option>
                                        <option value="scrollUp" <?php selected('scrollUp', $options['transition_effect']); ?>><?php _e( 'scrollUp', 'catchflames' ); ?></option>
                                        <option value="scrollDown" <?php selected('scrollDown', $options['transition_effect']); ?>><?php _e( 'scrollDown', 'catchflames' ); ?></option>
                                        <option value="scrollLeft" <?php selected('scrollLeft', $options['transition_effect']); ?>><?php _e( 'scrollLeft', 'catchflames' ); ?></option>
                                        <option value="scrollRight" <?php selected('scrollRight', $options['transition_effect']); ?>><?php _e( 'scrollRight', 'catchflames' ); ?></option>
                                        <option value="blindX" <?php selected('blindX', $options['transition_effect']); ?>><?php _e( 'blindX', 'catchflames' ); ?></option>
                                        <option value="blindY" <?php selected('blindY', $options['transition_effect']); ?>><?php _e( 'blindY', 'catchflames' ); ?></option>
                                        <option value="blindZ" <?php selected('blindZ', $options['transition_effect']); ?>><?php _e( 'blindZ', 'catchflames' ); ?></option>
                                        <option value="cover" <?php selected('cover', $options['transition_effect']); ?>><?php _e( 'cover', 'catchflames' ); ?></option>
                                        <option value="shuffle" <?php selected('shuffle', $options['transition_effect']); ?>><?php _e( 'shuffle', 'catchflames' ); ?></option>
                                    </select>
                             	</div>
                          	</div><!-- .row --> 
                            
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Transition Delay', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2"> 
                            		<input type="text" name="catchflames_options[transition_delay]" value="<?php echo $options[ 'transition_delay' ]; ?>" size="2" />
                                   	<span class="description"><?php _e( 'second(s)', 'catchflames' ); ?></span>
                            	</div>
                          	</div><!-- .row -->
                            
                            <div class="row">
                            	<div class="col col-1">
                                	<?php _e( 'Transition Length', 'catchflames' ); ?>
                                </div>
                                <div class="col col-2"> 
                            		<input type="text" name="catchflames_options[transition_duration]" value="<?php echo $options[ 'transition_duration' ]; ?>" size="2" />
                                        <span class="description"><?php _e( 'second(s)', 'catchflames' ); ?></span>
                            	</div>
                          	</div><!-- .row --> 
							<div class="row">
        						<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                          	</div><!-- .row --> 
                        </div><!-- .option-content -->
            		</div><!-- .option-container -->                  
        
        			<div id="featured-page-slider" class="option-container page-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Page Slider Options', 'catchflames' ); ?></a></h3>
                        <div class="option-content inside">
                            <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                <div class="repeat-content-wrap">
                                    <div class="row">
                                        <div class="col col-1">
                                            <?php printf( esc_attr__( 'Featured Page Slider #%s', 'catchflames' ), $i ); ?>
                                        </div>
                                        <div class="col col-2">
                                            <?php
                                                $catchflames_name = 'catchflames_options[featured_slider_page][' . absint( $i ) . ']'; 
                                                $catchflames_args = array(
                                                                'depth'             => 0,
                                                                'child_of'          => 0,
                                                                'selected'          => ( isset( $options[ 'featured_slider_page' ][ $i ] ) && $options[ 'featured_slider_page' ][ $i ] > 0 ) ? $options[ 'featured_slider_page' ][ $i ] : '',
                                                                'echo'              => 1,
                                                                'name'              => $catchflames_name,
                                                                'id'                => $catchflames_name,
                                                                'show_option_none' => '--Select One--',
                                                            );
                                               wp_dropdown_pages( $catchflames_args ); 
                                            ?>
                                        <?php if( isset( $options[ 'featured_slider_page' ][ $i ] ) && $options[ 'featured_slider_page' ][ $i ] > 0 ) : ?>
                                            <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider_page', $options ) && array_key_exists ( $i, $options[ 'featured_slider_page' ] ) ) echo absint( $options[ 'featured_slider_page' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'catchflames' ); ?></a>
                                        <?php endif; ?>
                                        </div>
                                    </div><!-- .row -->
                                </div><!-- .repeat-content-wrap -->  
                         	<?php endfor; ?>
                            <div class="row">
                            	<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                           	</div><!-- .row -->       
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                </div><!-- #slidersettings -->
     
                <!-- Options for Social Links -->
                <div id="sociallinks" class="option-container">	
                    <h3 class="option-toggle"><a href="#"><?php _e( 'Social Icons', 'catchflames' ); ?></a></h3>
                    <div class="option-content show inside">
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Enable Social Icons in Sidebar?', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <a class="button" href="<?php echo admin_url('widgets.php'); ?>" title="<?php esc_attr_e( 'Just add Catch Flames Social Widget in Sidebar', 'catchflames' ); ?>"><?php _e( 'Just add Catch Flames Social Widget in Sidebar', 'catchflames' );?></a>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Enable Social Icons in Footer?', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type='hidden' value='0' name='catchflames_options[disable_footer_social]'>
                                <input type="checkbox" id="headerlogo" name="catchflames_options[disable_footer_social]" value="1" <?php checked( '1', $options['disable_footer_social'] ); ?> /> <?php _e('Check to enable', 'catchflames'); ?>
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Facebook', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_facebook]" value="<?php echo esc_url( $options[ 'social_facebook' ] ); ?>" />
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Twitter', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_twitter]" value="<?php echo esc_url( $options[ 'social_twitter' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Google+', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_googleplus]" value="<?php echo esc_url( $options[ 'social_googleplus' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Pinterest', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_pinterest]" value="<?php echo esc_url( $options[ 'social_pinterest' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Youtube', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_youtube]" value="<?php echo esc_url( $options[ 'social_youtube' ] ); ?>" />
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Vimeo', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_vimeo]" value="<?php echo esc_url( $options[ 'social_vimeo' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Linkedin', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_linkedin]" value="<?php echo esc_url( $options[ 'social_linkedin' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'AIM', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_aim]" value="<?php echo esc_url( $options[ 'social_aim' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'MySpace', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_myspace]" value="<?php echo esc_url( $options[ 'social_myspace' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                    
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Flickr', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_flickr]" value="<?php echo esc_url( $options[ 'social_flickr' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Tumblr', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_tumblr]" value="<?php echo esc_url( $options[ 'social_tumblr' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'deviantART', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_deviantart]" value="<?php echo esc_url( $options[ 'social_deviantart' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Dribbble', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_dribbble]" value="<?php echo esc_url( $options[ 'social_dribbble' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                          
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'WordPress', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_wordpress]" value="<?php echo esc_url( $options[ 'social_wordpress' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'RSS', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_rss]" value="<?php echo esc_url( $options[ 'social_rss' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Slideshare', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_slideshare]" value="<?php echo esc_url( $options[ 'social_slideshare' ] ); ?>" />
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Instagram', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_instagram]" value="<?php echo esc_url( $options[ 'social_instagram' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Skype', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_skype]" value="<?php echo esc_attr( $options[ 'social_skype' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Soundcloud', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_soundcloud]" value="<?php echo esc_url( $options[ 'social_soundcloud' ] ); ?>" />
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Email', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_email]" value="<?php echo sanitize_email( $options[ 'social_email' ] ); ?>" />
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Contact', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_contact]" value="<?php echo esc_url( $options[ 'social_contact' ] ); ?>" />
                            </div>
                        </div><!-- .row -->    
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Xing', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type="text" size="45" name="catchflames_options[social_xing]" value="<?php echo esc_url( $options[ 'social_xing' ] ); ?>" />
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col col-1">
                                <?php _e( 'Enable SpecificFeeds?', 'catchflames' ); ?>
                            </div>
                            <div class="col col-2">
                                <input type='hidden' value='0' name='catchflames_options[enable_specificfeeds]'>
                                <input type="checkbox" id="headerlogo" name="catchflames_options[enable_specificfeeds]" value="1" <?php checked( '1', $options['enable_specificfeeds'] ); ?> /> <?php _e('Check to enable', 'catchflames'); ?>
                            </div>
                        </div><!-- .row --> 
                        <div class="row">
                            <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchflames' ); ?>" />
                        </div><!-- .row -->    
                  	</div><!-- .option-content -->
                           
                </div><!-- #sociallinks -->  
                       
            </div><!-- #catchflames_ad_tabs -->
		</form>
	</div><!-- .wrap -->
<?php
}


/**
 * Validate content options
 * @param array $options
 * @uses esc_url_raw, absint, esc_textarea, sanitize_text_field, catchflames_invalidate_caches
 * @return array 
 */
function catchflames_theme_options_validate( $options ) {
	global $catchflames_options_settings;
    $input_validated = $catchflames_options_settings;
	
	global $catchflames_options_defaults;
	$defaults = $catchflames_options_defaults;
	
	$fonts = catchflames_available_fonts();
	$units = array( 'px', 'pt', 'em', '%' );
	
    $input = array();
    $input = $options;
	
	// data validation for scroll up
	if ( isset( $input['disable_scrollup'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_scrollup' ] = $input[ 'disable_scrollup' ];
	} 

	// data validation for favicon
	if ( isset( $input[ 'fav_icon' ] ) ) {
		$input_validated[ 'fav_icon' ] = esc_url_raw( $input[ 'fav_icon' ] );
	}
	if ( isset( $input['remove_favicon'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_favicon' ] = $input[ 'remove_favicon' ];
	}
	
	// data validation for web clip icon
	if ( isset( $input[ 'web_clip' ] ) ) {
		$input_validated[ 'web_clip' ] = esc_url_raw( $input[ 'web_clip' ] );
	}
	if ( isset( $input['remove_web_clip'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_web_clip' ] = $input[ 'remove_web_clip' ];
	}
	
	// data validation for logo
	if ( isset( $input[ 'featured_logo_header' ] ) ) {
		$input_validated[ 'featured_logo_header' ] = esc_url_raw( $input[ 'featured_logo_header' ] );
	}
	if ( isset( $input['remove_header_logo'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_header_logo' ] = $input[ 'remove_header_logo' ];
	}	

	// data validation for Search Settings
	if ( isset( $input[ 'search_display_text' ] ) ) {
        $input_validated[ 'search_display_text' ] = sanitize_text_field( $input[ 'search_display_text' ] );
    }
	
	// Data validation for Fixed Header Top Options
	if ( isset( $input['enable_header_top'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'enable_header_top' ] = $input[ 'enable_header_top' ];
	} 
	if ( isset( $input['disable_top_menu_logo'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_top_menu_logo' ] = $input[ 'disable_top_menu_logo' ];
	} 	
	if ( isset( $input[ 'top_menu_logo' ] ) ) {
		$input_validated[ 'top_menu_logo' ] = esc_url_raw( $input[ 'top_menu_logo' ] );
	}

	// data validation for Header Featured Image Options
	if ( isset( $input[ 'enable_featured_header_image' ] ) ) {
		$input_validated[ 'enable_featured_header_image' ] = $input[ 'enable_featured_header_image' ];
	}
	if ( isset( $input[ 'featured_header_image_alt' ] ) ) {
		$input_validated[ 'featured_header_image_alt' ] = sanitize_text_field( $input[ 'featured_header_image_alt' ] );
	}
	if ( isset( $input[ 'featured_header_image_url' ] ) ) {
		$input_validated[ 'featured_header_image_url' ] = esc_url_raw( $input[ 'featured_header_image_url' ] );
	}
	
	if ( isset( $input['reset_header_image'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_header_image' ] = $input[ 'reset_header_image' ];
		
		if ( $input['reset_header_image'] == '1' ) {
			$input_validated[ 'enable_featured_header_image' ] = $defaults[ 'enable_featured_header_image' ];
			$input_validated[ 'featured_header_image_alt' ] = $defaults[ 'featured_header_image_alt' ];
			$input_validated[ 'featured_header_image_url' ] = $defaults[ 'featured_header_image_url' ];
		}
	}	

	// data validation for Disable Primary Menu 
	if ( isset( $input['disable_header_menu'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_header_menu' ] = $input[ 'disable_header_menu' ];
	}	

	// data validation for Color Scheme
	if ( isset( $input['color_scheme'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'color_scheme' ] = $input[ 'color_scheme' ];
	}
	
    // data validation for Default Layout verification	
	if ( isset( $input[ 'sidebar_layout' ] ) ) {
		$input_validated[ 'sidebar_layout' ] = $input[ 'sidebar_layout' ];
	}
   // data validation for Homepage Content Layout verification
	if ( isset( $input[ 'content_layout' ] ) ) {
		$input_validated[ 'content_layout' ] = $input[ 'content_layout' ];
	}
	if ( isset( $input['reset_sidebar_layout'] ) ) { 
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_sidebar_layout' ] = $input[ 'reset_sidebar_layout' ];
		
		if ( $input['reset_sidebar_layout'] == 1 ) {
			$input_validated[ 'sidebar_layout' ] = $defaults[ 'sidebar_layout' ];
			$input_validated[ 'content_layout' ] = $defaults[ 'content_layout' ];
		}
	}	
	
	
	// data validation for Custom CSS Style
	if ( isset( $input['custom_css'] ) ) {
		$input_validated['custom_css'] = wp_kses_stripslashes($input['custom_css']);
	}	

	// data validation for Homepage/Frontpage posts categories
    if ( isset( $input['front_page_category' ] ) ) {
		$input_validated['front_page_category'] = $input['front_page_category'];
    }
	
	// data validation for More Tags and Excerpt Length
    if ( isset( $input[ 'more_tag_text' ] ) ) {
        $input_validated[ 'more_tag_text' ] = htmlentities( sanitize_text_field ( $input[ 'more_tag_text' ] ), ENT_QUOTES, 'UTF-8' );
    }   
    //data validation for excerpt length
    if ( isset( $input[ 'excerpt_length' ] ) ) {
        $input_validated[ 'excerpt_length' ] = absint( $input[ 'excerpt_length' ] ) ? $input [ 'excerpt_length' ] : 30;
    }
   //data validation for reset more
	if ( isset( $input['reset_more_tag'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_more_tag' ] = $input[ 'reset_more_tag' ];
		
		if( $input['reset_more_tag'] == 1 ) {
			global $catchflames_options_defaults;
			$defaults = $catchflames_options_defaults;
			$input_validated[ 'more_tag_text' ] = $defaults[ 'more_tag_text' ];
			$input_validated[ 'excerpt_length' ] = $defaults[ 'excerpt_length' ];
		}	
	}	
		
    if ( isset( $input['exclude_slider_post'] ) ) {
        // Our checkbox value is either 0 or 1 
   		$input_validated[ 'exclude_slider_post' ] = $input[ 'exclude_slider_post' ];	
	
    }
	
	// data validation Slider Options
	
	// data validation for Slider Type
	if( isset( $input[ 'select_slider_type' ] ) ) {
		$input_validated[ 'select_slider_type' ] = $input[ 'select_slider_type' ];
	}
	if( isset( $input[ 'select_slider_layout' ] ) ) {
		$input_validated[ 'select_slider_layout' ] = $input[ 'select_slider_layout' ];
	}	
	// data validation for Enable Slider
	if( isset( $input[ 'enable_slider' ] ) ) {
		$input_validated[ 'enable_slider' ] = $input[ 'enable_slider' ];
	}	
    // data validation for number of slides
	if ( isset( $input[ 'slider_qty' ] ) ) {
		$input_validated[ 'slider_qty' ] = absint( $input[ 'slider_qty' ] ) ? $input [ 'slider_qty' ] : 4;
	}
    // data validation for transition effect
    if( isset( $input[ 'transition_effect' ] ) ) {
        $input_validated['transition_effect'] = wp_filter_nohtml_kses( $input['transition_effect'] );
    }
    // data validation for transition delay
    if ( isset( $input[ 'transition_delay' ] ) && is_numeric( $input[ 'transition_delay' ] ) ) {
        $input_validated[ 'transition_delay' ] = $input[ 'transition_delay' ];
    }
    // data validation for transition length
    if ( isset( $input[ 'transition_duration' ] ) && is_numeric( $input[ 'transition_duration' ] ) ) {
        $input_validated[ 'transition_duration' ] = $input[ 'transition_duration' ];
    }	
	
	// data validation for Featured Page and Page Slider
	if ( isset( $input[ 'featured_slider_page' ] ) ) {
		$input_validated[ 'featured_slider_page' ] = array();
	}
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_slider_page' ][ $i ] ) && intval( $input[ 'featured_slider_page' ][ $i ] ) ) {
				$input_validated[ 'featured_slider_page' ][ $i ] = absint($input[ 'featured_slider_page' ][ $i ] );
			}
		}
	}	
	
	// data validation for Featured Image Slider
	if ( isset( $input[ 'featured_image_slider_image' ] ) ) {
		$input_validated[ 'featured_image_slider_image' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_link' ] ) ) {
		$input_validated[ 'featured_image_slider_link' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_base' ] ) ) {
		$input_validated[ 'featured_image_slider_base' ] = array();
	}		
	if ( isset( $input[ 'featured_image_slider_title' ] ) ) {
		$input_validated[ 'featured_image_slider_title' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_content' ] ) ) {
		$input_validated[ 'featured_image_slider_content' ] = array();
	}	
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_image_slider_image' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_image' ][ $i ] = esc_url_raw($input[ 'featured_image_slider_image' ][ $i ] );
			}
			if ( !empty( $input[ 'featured_image_slider_link' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_link'][ $i ] = esc_url_raw($input[ 'featured_image_slider_link'][ $i ]);
			}
			if ( !empty( $input[ 'featured_image_slider_base' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_base'][ $i ] = $input[ 'featured_image_slider_base'][ $i ];
			}
			if ( !empty( $input[ 'featured_image_slider_title' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_title'][ $i ] = sanitize_text_field($input[ 'featured_image_slider_title'][ $i ]);
			}
			if ( !empty( $input[ 'featured_image_slider_content' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_content'][ $i ] = wp_kses_stripslashes($input[ 'featured_image_slider_content'][ $i ]);
			}			
		}
	}	
	//Featured Catgory Slider
	if ( isset( $input['slider_category'] ) ) {
		$input_validated[ 'slider_category' ] = $input[ 'slider_category' ];
	}		
	
	// data validation for Social Icons
	if ( isset( $input['disable_footer_social'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_footer_social' ] = $input[ 'disable_footer_social' ];
	}	
	if( isset( $input[ 'social_facebook' ] ) ) {
		$input_validated[ 'social_facebook' ] = esc_url_raw( $input[ 'social_facebook' ] );
	}
	if( isset( $input[ 'social_twitter' ] ) ) {
		$input_validated[ 'social_twitter' ] = esc_url_raw( $input[ 'social_twitter' ] );
	}
	if( isset( $input[ 'social_googleplus' ] ) ) {
		$input_validated[ 'social_googleplus' ] = esc_url_raw( $input[ 'social_googleplus' ] );
	}
	if( isset( $input[ 'social_pinterest' ] ) ) {
		$input_validated[ 'social_pinterest' ] = esc_url_raw( $input[ 'social_pinterest' ] );
	}	
	if( isset( $input[ 'social_youtube' ] ) ) {
		$input_validated[ 'social_youtube' ] = esc_url_raw( $input[ 'social_youtube' ] );
	}
	if( isset( $input[ 'social_vimeo' ] ) ) {
		$input_validated[ 'social_vimeo' ] = esc_url_raw( $input[ 'social_vimeo' ] );
	}	
	if( isset( $input[ 'social_linkedin' ] ) ) {
		$input_validated[ 'social_linkedin' ] = esc_url_raw( $input[ 'social_linkedin' ] );
	}
	if( isset( $input[ 'social_aim' ] ) ) {
		$input_validated[ 'social_aim' ] = esc_url_raw( $input[ 'social_aim' ] );
	}	
	if( isset( $input[ 'social_myspace' ] ) ) {
		$input_validated[ 'social_myspace' ] = esc_url_raw( $input[ 'social_myspace' ] );
	}
	if( isset( $input[ 'social_flickr' ] ) ) {
		$input_validated[ 'social_flickr' ] = esc_url_raw( $input[ 'social_flickr' ] );
	}
	if( isset( $input[ 'social_tumblr' ] ) ) {
		$input_validated[ 'social_tumblr' ] = esc_url_raw( $input[ 'social_tumblr' ] );
	}	
	if( isset( $input[ 'social_deviantart' ] ) ) {
		$input_validated[ 'social_deviantart' ] = esc_url_raw( $input[ 'social_deviantart' ] );
	}
	if( isset( $input[ 'social_dribbble' ] ) ) {
		$input_validated[ 'social_dribbble' ] = esc_url_raw( $input[ 'social_dribbble' ] );
	}	
	if( isset( $input[ 'social_wordpress' ] ) ) {
		$input_validated[ 'social_wordpress' ] = esc_url_raw( $input[ 'social_wordpress' ] );
	}	
	if( isset( $input[ 'social_rss' ] ) ) {
		$input_validated[ 'social_rss' ] = esc_url_raw( $input[ 'social_rss' ] );
	}
	if( isset( $input[ 'social_slideshare' ] ) ) {
		$input_validated[ 'social_slideshare' ] = esc_url_raw( $input[ 'social_slideshare' ] );
	}	
	if( isset( $input[ 'social_instagram' ] ) ) {
		$input_validated[ 'social_instagram' ] = esc_url_raw( $input[ 'social_instagram' ] );
	}	
	if( isset( $input[ 'social_skype' ] ) ) {
		$input_validated[ 'social_skype' ] = sanitize_text_field( $input[ 'social_skype' ] );
	}	
	if( isset( $input[ 'social_soundcloud' ] ) ) {
		$input_validated[ 'social_soundcloud' ] = esc_url_raw( $input[ 'social_soundcloud' ] );
	}		
	if( isset( $input[ 'social_email' ] ) &&  isset( $input[ 'social_email' ] )  ) {
		$input_validated[ 'social_email' ] = sanitize_email( $input[ 'social_email' ] );
	}
	if( isset( $input[ 'social_contact' ] ) ) {
		$input_validated[ 'social_contact' ] = esc_url_raw( $input[ 'social_contact' ] );
	}
	if( isset( $input[ 'social_xing' ] ) ) {
		$input_validated[ 'social_xing' ] = esc_url_raw( $input[ 'social_xing' ] );
	}
	if ( isset( $input['enable_specificfeeds'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'enable_specificfeeds' ] = $input[ 'enable_specificfeeds' ];
	} 			
	
	//Clearing the theme option cache
	if( function_exists( 'catchflames_themeoption_invalidate_caches' ) ) catchflames_themeoption_invalidate_caches();
	
	return $input_validated;
}


/*
 * Clearing the cache if any changes in Admin Theme Option
 */
function catchflames_themeoption_invalidate_caches(){
	delete_transient( 'catchflames_responsive' ); // Disable responsive layout
	delete_transient( 'catchflames_favicon' );	  // favicon on cpanel/ backend and frontend
	delete_transient( 'catchflames_web_clip' ); // web clip icons
	delete_transient( 'catchflames_inline_css' ); // Custom Inline CSS and color options
	delete_transient( 'catchflames_default_sliders' ); // featured demo slider
	delete_transient( 'catchflames_post_sliders' ); // featured post slider
	delete_transient( 'catchflames_page_sliders' ); // featured page slider
	delete_transient( 'catchflames_category_sliders' ); // featured category slider
	delete_transient( 'catchflames_image_sliders' ); // featured image slider
	delete_transient( 'catchflames_social_networks' );  // Social links on header
	delete_transient( 'catchflames_social_search' );  // Social links with search  on header	
	delete_transient( 'catchflames_footer_content' ); // Footer content 
	delete_transient( 'catchflames_logo'); // Header logo
}

/*
 * Clearing the cache if any changes in post or page
 */
function catchflames_post_invalidate_caches(){
	delete_transient( 'catchflames_post_sliders' ); // featured post slider
	delete_transient( 'catchflames_page_sliders' ); // featured page slider
	delete_transient( 'catchflames_category_sliders' ); // featured category slider
}
//Add action hook here save post
add_action( 'save_post', 'catchflames_post_invalidate_caches' );


/*
 * Clearing the cache if any changes in Custom Header
 */
function catchflames_customheader_invalidate_caches(){
	delete_transient( 'catchflames_logo'); // Header logo
}
//Add action hook here save post
add_action( 'custom_header_options', 'catchflames_customheader_invalidate_caches' );


/**
 * Function to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function catchflames_the_year() {
	return date( __( 'Y', 'catchflames' ) );
}


/**
 * Function to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function catchflames_site_link() {
	return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}


/**
 * Function to display a link to WordPress.org.
 *
 * @return string
 */
function catchflames_theme_name() {
    return '<span class="theme-name">' . __( 'Theme: Catch Flames by ', 'catchflames' ) . '</span>';	
}


/**
 * Function to display a link to Theme Link.
 *
 * @return string
 */
function catchflames_theme_author() {
	
    return '<span class="theme-author"><a href="' . esc_url( 'http://catchthemes.com/' ) . '" target="_blank" title="' . esc_attr__( 'Catch Themes', 'catchflames' ) . '">' . __( 'Catch Themes', 'catchflames' ) . '</a></span>';

}


/**
 * Function to display Catch Flames Assets
 *
 * @return string
 */
function catchflames_assets(){
    $catchflames_content = '<div class="copyright">'. esc_attr__( 'Copyright', 'catchflames' ) . ' &copy; '. catchflames_the_year() . ' ' . catchflames_site_link() . ' ' . esc_attr__( 'All Rights Reserved', 'catchflames' ) . '.</div><div class="powered">'. catchflames_theme_name() . catchflames_theme_author() . '</div>';
    return $catchflames_content;
}


/**
 * Custom scripts and styles on Customizer for Catch Everest
 *
 * @since Catch Flames 2.1.1
 */
function catchflames_customize_scripts() {
    wp_register_script( 'catchflames_customizer_custom', get_template_directory_uri() . '/inc/panel/customizer-custom-scripts.js', array( 'jquery' ), '20140108', true );

    $catchflames_misc_links = array(
                            'upgrade_link'              => esc_url( admin_url( 'themes.php?page=theme_options' ) ),
                            'upgrade_text'              => __( 'More Theme Options &raquo;', 'catchflames' ),
                            );

    //Add More Theme Options Button
    wp_localize_script( 'catchflames_customizer_custom', 'catchflames_misc_links', $catchflames_misc_links );

    wp_enqueue_script( 'catchflames_customizer_custom' );

    wp_enqueue_style( 'catchflames_customizer_custom', get_template_directory_uri() . '/inc/panel/catchflames-customizer.css');
}
add_action( 'customize_controls_print_footer_scripts', 'catchflames_customize_scripts');