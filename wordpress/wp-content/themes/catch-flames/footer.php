<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
?>
                </div><!-- #content-sidebar-wrap -->
            
                <?php 
                /** 
                 * catchflames_after_contentsidebarwrap hook
                 *
                 * @hooked catchflames_third_sidebar - 10
                 */
                do_action( 'catchflames_after_contentsidebarwrap' );  ?>   
            
            </div><!-- .wrapper -->
     
            <?php 
            /** 
             * catchflames_after_main_wrapper hook
             */
            do_action( 'catchflames_after_main_wrapper' ); ?>
                
        </div><!-- #main -->    
    
        <?php 
        /** 
         * catchflames_after_main hook
         */
        do_action( 'catchflames_after_main' ); ?>   
        
    </div><!-- #main-wrapper -->     
    
	<?php 
    /** 
     * catchflames_before_footer hook
	 *
	 * @hooked catchflames_footer_menu - 10
     */
    do_action( 'catchflames_before_footer' ); ?> 
         
    <footer id="colophon" role="contentinfo">
    
    	<?php
        /** 
         * catchflames_footer hook
         *
         * @hooked catchflames_footer_sidebar - 10
         */	
        do_action( 'catchflames_footer' ); ?>
        
  		<?php
        /** 
         * catchflames_site_generator hook
         *
         * @hooked catchflames_site_generator_open - 10
		 * @hooked catchflames_footer_social - 20
		 * @hooked catchflames_footer_content - 30
		 * @hooked catchflames_site_generator_close - 100
         */		 
        do_action( 'catchflames_site_generator' ); ?>        
        
	</footer><!-- #colophon -->
    
	<?php 
    /** 
     * catchflames_after_footer hook
     */
    do_action( 'catchflames_after_footer' ); ?>    

</div><!-- #page -->

<?php 
/** 
 * catchflames_after hook
 *
 * @hooked catchflames_mobile_menus - 10
 */
do_action( 'catchflames_after' ); ?>

<?php wp_footer(); ?>

</body>
</html>