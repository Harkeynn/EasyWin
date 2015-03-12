<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */

get_header(); ?>

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Error 404 - Page Not Found.', 'catchflames' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'catchflames' ); ?></p>
                    <h2><?php _e( 'This might be because:', 'catchflames' ); ?></h2>
               	 	<p><?php _e( 'You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'catchflames' ); ?></p>
                	<h2><?php _e( 'Please try the following options instead:', 'catchflames' ); ?></h2>
                	<p><?php _e( 'Check for a mis-typed URL error, then press the refresh button on your browser or Use the search box below.', 'catchflames' ); ?></p>
					<?php get_search_form(); ?>                  
				</div><!-- .entry-content -->
                
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>