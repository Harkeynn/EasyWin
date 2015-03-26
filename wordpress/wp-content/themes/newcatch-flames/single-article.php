


<?php
/**
 * Sample template for displaying single article posts.
 * Save this file as as single-article.php in your current theme.
 *
 * This sample code was based off of the Starkers Baseline theme: http://starkerstheme.com/
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	

	<h1><?php the_title(); ?></h1>
		Publié par <?php the_author(); ?> le <?php the_date("l d F Y à H:i"); ?><br />
		<p id="text"><?php the_content(); ?></p>




<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
