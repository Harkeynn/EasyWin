<?php the_post_thumbnail('featured'); ?>
<div class="col-md-10 col-md-offset-1">	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
		<h1 id="post-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>	
		<?php wp_link_pages(); ?>		
	</article>	
</div>