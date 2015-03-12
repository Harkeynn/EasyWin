<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<?php 
/** 
 * catchflames_before hook
 */
do_action( 'catchflames_before' ); ?>

<div id="page" class="hfeed site">

	<?php 
    /** 
     * catchflames_before_header hook
     */
    do_action( 'catchflames_before_header' ); ?>
        
	<header id="branding" role="banner">
    
    	<?php 
		/** 
		 * catchflames_before_headercontent hook
		 *
		 * @hooked catchflames_header_topsidebar - 15
		 */
		do_action( 'catchflames_before_headercontent' ); ?>
        
    	<div id="header-content" class="clearfix">
        
        	<div class="wrapper">
            
				<?php 
                /** 
                 * catchflames_headercontent hook
                 *
                 * @hooked catchflames_headerdetails - 20
                 * @hooked catchflames_header_rightsidebar - 30
                 */
                do_action( 'catchflames_headercontent' ); ?>
                
            </div><!-- .wrapper -->
            
      	</div><!-- #header-content -->
        
    	<?php 
		/** 
		 * catchflames_after_headercontent hook
		 *
         * @hooked catchflames_header_menu - 10
		 */
		do_action( 'catchflames_after_headercontent' ); ?>           
        
	</header><!-- #branding -->
    
	<?php 
    /** 
     * catchflames_after_header hook
     *
     * @hooked catchflames_featured_header - 10
     * @hooked catchflames_header_menu - 15
     */
     do_action( 'catchflames_after_header' ); ?>
    
    <div id="main-wrapper">
    
		<?php 
        /** 
         * catchflames_before_main hook
		 *
		 * @hooked catchflames_slider_display - 10 if full width image slide is selected		 
         */
        do_action( 'catchflames_before_main' ); ?>
    
		<div id="main">
    
			<?php 
            /** 
             * catchflames_before_main_wrapper hook
             */
            do_action( 'catchflames_before_main_wrapper' ); ?>
        
            <div class="wrapper">
                
                <?php 
                /** 
                 * catchflames_before_contentsidebarwrap hook
                 */
                do_action( 'catchflames_before_contentsidebarwrap' ); ?> 
                
                <div class="content-sidebar-wrap">

					<?php 
                    /** 
                     * catchflames_before_primary hook
                     */
                    do_action( 'catchflames_before_primary' ); ?>
                
                    <div id="primary">
            
						<?php 
                        /** 
                         * catchflames_before_content hook
                         */
                        do_action( 'catchflames_before_content' ); ?>
                    
						<div id="content" role="main">
                    
							<?php 
                            /** 
                             * catchflames_content hook
                             *
                             * @hooked catchflames_slider_display - 10 if full width image slide is not selected
                             */
                            do_action( 'catchflames_content' ); ?>