<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage McKinley
 * @since McKinley 1.0
 */
?>
		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info ">
				<?php do_action( 'mckinley_credits' ); ?>
				<p class="left"><?php _e( 'Theme by', 'mckinley' ); ?> <a href="<?php echo esc_url( __( 'http://themetrust.com/', 'mckinley' ) ); ?>" title="<?php esc_attr_e( 'ThemeTrust', 'mckinley' ); ?>"><?php _e( 'ThemeTrust', 'mckinley' ); ?></a></p>
				<p class="right"><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'mckinley' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'mckinley' ); ?>"><?php printf( __( 'Proudly powered by %s', 'mckinley' ), 'WordPress' ); ?></a></p>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>