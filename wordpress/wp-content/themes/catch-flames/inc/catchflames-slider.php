<?php
/**
 * Function to pass the slider effect parameters from php file to js file.
 */
function catchflames_pass_slider_value() {
	global $catchflames_options_settings;
	$options = $catchflames_options_settings;	
	
	$transition_effect = $options[ 'transition_effect' ];
	$transition_delay = $options[ 'transition_delay' ] * 1000;
	$transition_duration = $options[ 'transition_duration' ] * 1000;
	
	wp_localize_script( 
		'catchflames-slider',
		'js_value',
		array(
			'transition_effect' => $transition_effect,
			'transition_delay' => $transition_delay,
			'transition_duration' => $transition_duration
		)
		
	);
	
}// catchflames_pass_slider_value


/**
 * Shows Default Slider Demo if there is not iteam in Featured Post Slider
 */
function catchflames_default_sliders() { 
	delete_transient( 'catchflames_default_sliders' );
	
	if ( !$catchflames_default_sliders = get_transient( 'catchflames_default_sliders' ) ) {
		echo '<!-- refreshing cache -->';	
		
		$catchflames_default_sliders = '
		<div id="main-slider" class="featured-demo-slider full-width">
			<section class="featured-slider">
			
				<article class="post hentry slides demo-image displayblock">
					<figure class="slider-image">
						<a title="CatchFlames Slider Image 1" href="#">
							<img src="'. get_template_directory_uri() . '/images/demo/slider-1-1600x650.jpg" class="wp-post-image" alt="CatchFlames Slider Image 1" title="Seto Ghumba">
						</a>
					</figure>          
				</article><!-- .slides --> 	
			
				
				<article class="post hentry slides demo-image displaynone">
					<figure class="slider-image">
						<a title="CatchFlames Slider Image 2" href="#">
							<img src="'. get_template_directory_uri() . '/images/demo/slider-2-1600x650.jpg" class="wp-post-image" alt="CatchFlames Slider Image 1" title="Kathmandu Durbar Square">
						</a>
					</figure>
				</article><!-- .slides --> 					
			</section>
        	<div id="slider-nav">
        		<a class="slide-previous"><span>Previous</span></a>
        		<a class="slide-next"><span>Next</span></a>
        	</div>			
			<div id="controllers"></div>
		</div><!-- #main-slider -->';
			
	set_transient( 'catchflames_default_sliders', $catchflames_default_sliders, 86940 );
	}
	echo $catchflames_default_sliders;	
} // catchflames_default_sliders	


if ( ! function_exists( 'catchflames_page_sliders' ) ) :
/**
 * Template for Featued Page Slider
 *
 * To override this in a child theme
 * simply create your own catchflames_page_sliders(), and that function will be used instead.
 *
 * @uses catchflames_header action to add it in the header
 * @since Catch Flames 1.0
 */
function catchflames_page_sliders() { 
	//delete_transient( 'catchflames_page_sliders' );
	
	global $post, $catchflames_options_settings;
   	$options = $catchflames_options_settings;

	
	if( ( !$catchflames_page_sliders = get_transient( 'catchflames_page_sliders' ) ) && !empty( $options[ 'featured_slider_page' ] ) ) {
		echo '<!-- refreshing cache -->';
		
		$catchflames_page_sliders = '
		<div id="main-slider" class="featured-page-slider full-width">
        	<section class="featured-slider">';
				$get_featured_posts = new WP_Query( array(
					'posts_per_page'	=> $options[ 'slider_qty' ],
					'post_type'			=> 'page',
					'post__in'			=> $options[ 'featured_slider_page' ],
					'orderby' 			=> 'post__in'
				));
				$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
					$title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
					$excerpt = get_the_excerpt();
					if ( $i == 1 ) { $classes = 'page pageid-'.$post->ID.' hentry slides displayblock'; } else { $classes = 'page pageid-'.$post->ID.' hentry slides displaynone'; }
					$catchflames_page_sliders .= '
					<article class="'.$classes.'">
						<figure class="slider-image">
							<a title="Permalink to '.the_title('','',false).'" href="' . get_permalink() . '">
								'. get_the_post_thumbnail( $post->ID, 'featured-slider-full', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) ).'
							</a>	
						</figure>';
						if ( empty ( $options[ 'disable_slider_text' ] ) ) {
							$catchflames_page_sliders .= '
							<div class="entry-container">
								<header class="entry-header">
									<h1 class="entry-title">
										<a title="Permalink to '.the_title('','',false).'" href="' . get_permalink() . '">'.the_title( '<span>','</span>', false ).'</a>
									</h1>
								</header>';
								if( $excerpt !='') {
									$catchflames_page_sliders .= '<div class="entry-content">'. $excerpt.'</div>';
								}
								$catchflames_page_sliders .= '
							</div>';
						}
					$catchflames_page_sliders .= '</article><!-- .slides -->';	
					
				endwhile; wp_reset_query();
				$catchflames_page_sliders .= '
			</section>
        	<div id="slider-nav">
        		<a class="slide-previous"><span>Previous</span></a>
        		<a class="slide-next"><span>Next</span></a>
        	</div>			
        	<div id="controllers"></div>
  		</div><!-- #main-slider -->';
			
	set_transient( 'catchflames_page_sliders', $catchflames_page_sliders, 86940 );
	}
	echo $catchflames_page_sliders;	
} // catchflames_page_sliders	
endif;

if ( ! function_exists( 'catchflames_slider_display' ) ) :
/**
 * Shows Slider
 */
function catchflames_slider_display() {
	global $post, $wp_query, $catchflames_options_settings;
   	$options = $catchflames_options_settings;

   	$slidertype = $options[ 'select_slider_type' ];

	// get data value from theme options
	$enableslider = $options[ 'enable_slider' ];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	
	if ( ( $enableslider == 'enable-slider-allpage' ) || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enableslider == 'enable-slider-homepage' ) ) :
		// This function passes the value of slider effect to js file 
		if ( function_exists( 'catchflames_pass_slider_value' ) ) : catchflames_pass_slider_value(); endif;

		if (  $slidertype == 'page-slider' ) {
			if ( !empty( $options[ 'featured_slider_page' ] ) && function_exists( 'catchflames_page_sliders' ) ) {
				catchflames_page_sliders();
			}
			else {
				echo '<p style="text-align: center">' . esc_attr__( 'You have selected Page Slider but you haven\'t added the Page ID in "Appearance => Theme Options => Featured Slider => Featured Page Slider Options"', 'catchflames' ) . '</p>';
			}			
		}
		else {
			catchflames_default_sliders();
		}
	endif;	
}
endif; // catchflames_slider_display

add_action( 'catchflames_before_main', 'catchflames_slider_display', 40 );