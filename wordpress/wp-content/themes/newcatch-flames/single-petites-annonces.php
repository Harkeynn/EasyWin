<?php
/**
 * Sample template for displaying single petites-annonces posts.
 * Save this file as as single-petites-annonces.php in your current theme.
 *
 * This sample code was based off of the Starkers Baseline theme: http://starkerstheme.com/
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	

	<h1><?php the_title(); ?></h1>
		Posté le <?php the_date?> par <?php ?>
		<?php the_content(); ?>
		<?php the_author(); ?>
		
<!-- You have not associated any custom fields with this post-type. Be sure to add any desired custom fields to this post-type by clicking on the "Manage Custom Fields" link under the Custom Content Type menu and checking the fields that you want. -->



<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>