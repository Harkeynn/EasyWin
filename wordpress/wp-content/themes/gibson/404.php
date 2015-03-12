<?php get_header(); ?>	
<div id="content-holder" class="container">
	<div class="row">
		<div id="content-left" class="col-md-8 clearfix">
			<div class="col-md-10 col-md-offset-1">	
				<article>
					<h1 id="post-title"><?php _e('404 - Page not found', 'gibson'); ?></h1>			
					<p><?php _e('It seems we cannot find what you are looking for? Perhaps try searching.', 'gibson'); ?></p>
					<?php get_search_form(); ?>	
				</article>
			</div>	
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>