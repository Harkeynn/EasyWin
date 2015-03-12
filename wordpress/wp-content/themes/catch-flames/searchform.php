<?php
/**
 * The template for displaying search forms in Catch Flames
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
 
global $catchflames_options_settings;
$options = $catchflames_options_settings;

$catchflames_search_display_text = $options[ 'search_display_text' ];

?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'catchflames' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php echo esc_attr( $catchflames_search_display_text ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'catchflames' ); ?>" />
	</form>
