<?php get_header(); ?>	
<div id="content-holder" class="container">
	<div class="row">
		<div id="content-left" class="col-md-8 clearfix">
			<?php
			if (have_posts()) :	while (have_posts()) : the_post();								
				get_template_part('content', get_post_format());				
			endwhile;
			else :
				get_template_part('content', 'none');
			endif;	
			?>
			<?php gibson_pagination(); ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>