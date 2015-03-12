<?php
/**
 * The default template for displaying content
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
?>
<?php
	// Get data value from theme options
	global $catchflames_options_settings;
    $options = $catchflames_options_settings;
	$current_content_layout = $options['content_layout'];
	$more_tag_text = $options[ 'more_tag_text' ];
	
	// Get the Excerpt
	$catchflames_excerpt = get_the_excerpt();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	
		<?php if ( function_exists( 'catchflames_post_featured_image' ) ) : catchflames_post_featured_image(); endif; ?>
        
        
        <div class="entry-container">
        
            <header class="entry-header">
                <?php if ( is_sticky() ) : ?>
                    <hgroup>
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'catchflames' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <h3 class="entry-format"><?php _e( 'Featured', 'catchflames' ); ?></h3>
                    </hgroup>
                <?php else : ?>
                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'catchflames' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                <?php endif; ?>
    
                <?php if ( 'post' == get_post_type() ) : ?>
                    <div class="entry-meta">
                        <?php catchflames_posted_on(); ?>
                        <?php if ( comments_open() && ! post_password_required() ) : ?>
                            <span class="sep"> &mdash; </span>
                            <span class="comments-link">
                                <?php comments_popup_link(__('Leave a reply', 'catchflames'), __('1 Comment &darr;', 'catchflames'), __('% Comments &darr;', 'catchflames')); ?>
                            </span>
                        <?php endif; ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->
                
            <?php 
            if ( is_search() ) : // Only display Excerpts for Search ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php elseif ( post_password_required() ) : // Password Protected Post ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-summary -->    
            <?php elseif ( $current_content_layout!='full' && !empty( $catchflames_excerpt ) ) : // Only display Featured Image and Excerpts if checked in Theme Option ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php else : ?>
            <div class="entry-content">
                <?php 
                the_content( sprintf( __( '%s', 'catchflames' ), esc_attr( $more_tag_text ) ) ); ?>
                <?php wp_link_pages( array( 
                    'before'		=> '<div class="page-link"><span class="pages">' . __( 'Pages:', 'catchflames' ) . '</span>',
                    'after'			=> '</div>',
                    'link_before' 	=> '<span>',
                    'link_after'   	=> '</span>',
                ) ); 
                ?>
            </div><!-- .entry-content -->
            <?php endif; ?>
    		
            <?php if ( $current_content_layout != 'excerpt-thumbnail' ) : ?>
                <footer class="entry-meta">
                    <?php $show_sep = false; ?>
                    <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
                    <?php
                        /* translators: used between list items, there is a space after the comma */
                        $categories_list = get_the_category_list( __( ', ', 'catchflames' ) );
                        if ( $categories_list ):
                    ?>
                    <span class="cat-links">
                        <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'catchflames' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
                        $show_sep = true; ?>
                    </span>
                    <?php endif; // End if categories ?>
                    <?php
                        /* translators: used between list items, there is a space after the comma */
                        $tags_list = get_the_tag_list( '', __( ', ', 'catchflames' ) );
                        if ( $tags_list ):
                        if ( $show_sep ) : ?>
                    <span class="sep"> | </span>
                        <?php endif; // End if $show_sep ?>
                    <span class="tag-links">
                        <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'catchflames' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                        $show_sep = true; ?>
                    </span>
                    <?php endif; // End if $tags_list ?>
                    <?php endif; // End if 'post' == get_post_type() ?>
        
                    <?php if ( comments_open() && ! post_password_required() ) : ?>
                        <?php if ( $show_sep ) : ?>
                            <span class="sep"> | </span>
                        <?php endif; // End if $show_sep ?>
                        <span class="comments-link"><?php comments_popup_link(__('Leave a reply', 'catchflames'), __('1 Comment &darr;', 'catchflames'), __('% Comments &darr;', 'catchflames')); ?></span>
                    <?php endif; // End if comments_open() ?>
        
                    <?php edit_post_link( __( 'Edit', 'catchflames' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- #entry-meta -->
            <?php endif; ?>
            
      	</div><!-- .entry-container -->    
        
	</article><!-- #post-<?php the_ID(); ?> -->
