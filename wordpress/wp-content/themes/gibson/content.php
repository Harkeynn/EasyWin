<?php if (is_single()) : ?>
	<?php the_post_thumbnail('featured'); ?>
	<div class="col-md-10 col-md-offset-1">	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
			<h1 id="post-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>	
			<?php wp_link_pages(); ?>		
		</article>
		<div id="single-meta">
			<p><?php the_author(); ?> / <?php the_time(get_option('date_format')); ?> / <?php the_category(', '); ?><br /><?php the_tags(); ?></p>
		</div>	
	</div>
<?php else : ?>
<div <?php post_class(); ?>>
	<div class="teaser">		
		<?php the_post_thumbnail('featured'); ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
					<h3 class="teaser-post-title"><a href="<?php echo esc_url( get_permalink()); ?>"><?php the_title(); ?></a></h3>					
					<?php if ('no' === get_theme_mod('gibson_teaser_setting')) : ?>
						<?php the_excerpt(); ?>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>	
				</article>
				<p class="teaser-meta">
					<?php the_author(); ?> / 
					<?php the_time(get_option('date_format')); ?> / 
					<?php the_category(', '); ?> 
					<?php if (get_comments_number() > 0 || ('open' == $post->comment_status)) : ?> 
						/ <?php comments_number(__('0 Comments', 'gibson'), __('1 Comment', 'gibson'), __('% Comments', 'gibson')); ?>
					<?php endif; ?>
				</p>					
			</div>
		</div>
	</div>
</div>
<?php endif; ?>