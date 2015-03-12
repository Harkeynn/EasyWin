<?php get_header(); ?>	
<div id="content-holder" class="container">
	<div class="row">
		<div id="content-left" class="col-md-8 clearfix">
			<?php				
			while (have_posts()) : the_post();					
				get_template_part('content', 'page');					
				if (comments_open() || get_comments_number()) {comments_template();}
			endwhile;
			?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>