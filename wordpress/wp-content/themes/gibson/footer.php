<footer>
	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a class="site-name" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
					<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1)); ?>	
					<span>&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> - <a href="<?php echo esc_url(__('http://www.wpmultiverse.com/themes/gibson/', 'gibson')); ?>" target="_blank"><?php _e('Gibson Theme', 'gibson'); ?></a></span>
					<p id="description"><?php bloginfo('description'); ?></p>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>   
</body>
</html>