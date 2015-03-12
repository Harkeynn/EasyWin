<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>	
    <meta charset="<?php bloginfo('charset'); ?>" />           
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="profile" href="http://gmpg.org/xfn/11" />        
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />     
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>
		<div id="header-img" style="background: url('<?php header_image(); ?>') no-repeat; height:<?php echo get_custom_header()->height; ?>px;"></div>
		<div class="container">	
			<div class="row">
				<div class="col-sm-5">
					<a id="hamburger" href="#"><span></span><span></span><span></span></a>
					<a class="site-name" href="<?php echo esc_url(home_url('/')); ?>">
						<?php if (get_theme_mod('gibson_logo_setting')) : ?>
							<img src="<?php echo get_theme_mod('gibson_logo_setting'); ?>" alt="<?php bloginfo('name'); ?>" />
						<?php else : ?>
							<?php bloginfo('name'); ?>
						<?php endif; ?>
					</a>									
				</div>
				<div class="col-sm-7">						
					<?php if (has_nav_menu('primary')) : ?>						
						<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => 'nav', 'fallback_cb' => false, 'depth' => 2)); ?>						
					<?php endif; ?>
				</div>				
			</div>
			<?php if (get_theme_mod('gibson_welcome_heading_setting') || get_theme_mod('gibson_welcome_text_setting')) : ?>
				<?php if ('yes' === get_theme_mod('gibson_welcome_setting') || (is_front_page())) : ?>				
					<div id="welcome-message" class="row">
						<div class="col-md-8 col-md-offset-2">
							<?php if (get_theme_mod('gibson_welcome_heading_setting')) : ?><h3><?php echo get_theme_mod('gibson_welcome_heading_setting'); ?></h3><?php endif; ?>
							<?php if (get_theme_mod('gibson_welcome_text_setting')) : ?><p><?php echo get_theme_mod('gibson_welcome_text_setting'); ?></p><?php endif; ?>
						</div>
					</div>
				<?php endif; ?>	
			<?php endif; ?>		
		</div>
	</header>