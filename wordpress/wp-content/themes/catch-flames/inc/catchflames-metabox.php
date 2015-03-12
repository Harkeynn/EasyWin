<?php
/**
 * Catch Flames Custom meta box
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 1.0
 */
 
 // Add the Meta Box  
function catchflames_add_custom_box() {
	add_meta_box(
		'siderbar-layout',							//Unique ID
       __( 'Catch Flames Options', 'catchflames' ),	//Title
        'catchflames_sidebar_layout',				//Callback function
        'page'										//show metabox in pages
    ); 
	add_meta_box(
		'siderbar-layout',							//Unique ID
       __( 'Catch Flames Options', 'catchflames' ),	//Title
        'catchflames_sidebar_layout',				//Callback function
        'post'										//show metabox in posts
    ); 
}

add_action( 'add_meta_boxes', 'catchflames_add_custom_box' );


global $sidebar_layout;
$sidebar_layout = array(
	'default-sidebar'		=> array(
		'id'				=> 'catchflames-sidebarlayout',
		'value'				=> 'default',
		'label' 			=> sprintf( __( 'Default Layout Set in <a href="%s">Theme Settings</a>', 'catchflames' ), esc_url( admin_url('admin.php?page=theme_options' ) ) ),
		'thumbnail'			=> ' '
	),
	'three-columns'			=> array(
		'id'				=> 'catchflames-sidebarlayout',
		'value'				=> 'three-columns',
		'label'				=> __( 'Three Columns (Style 1)', 'catchflames' ),
		'thumbnail'			=> get_template_directory_uri() . '/inc/panel/images/three-columns.png'
	),
	'right-sidebar'			=> array(
		'id'				=> 'catchflames-sidebarlayout',
		'value'				=> 'right-sidebar',
		'label'				=> __( 'Right sidebar', 'catchflames' ),
		'thumbnail'			=> get_template_directory_uri() . '/inc/panel/images/right-sidebar.png'
	),
	'left-sidebar'			=> array(
		'id'				=> 'catchflames-sidebarlayout',
		'value'				=> 'left-sidebar',
		'label'				=> __( 'Left sidebar', 'catchflames' ),
		'thumbnail'			=> get_template_directory_uri() . '/inc/panel/images/left-sidebar.png'
	),	
	'no-sidebar'			=> array(
		'id'				=> 'catchflames-sidebarlayout',
		'value'				=> 'no-sidebar',
		'label'				=> __( 'No sidebar', 'catchflames' ),
		'thumbnail'			=> get_template_directory_uri() . '/inc/panel/images/no-sidebar.png'
	)
	
);
	
/**
 * @renders metabox to for sidebar layout
 */
function catchflames_sidebar_layout() {  
    global $sidebar_layout, $post;   
    // Use nonce for verification  
    wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

    // Begin the field table and loop  ?>
    <div class="catchflames-meta sidebar-layout">
    	<div class="layout-css">
    		<h4 class="title"><?php _e('Sidebar Layout Options', 'catchflames'); ?></h4>    
			<?php  
            foreach ($sidebar_layout as $field) {  
                $meta = get_post_meta( $post->ID, $field['id'], true );
                if(empty( $meta ) ){
                    $meta='default';
                }
                if( $field['thumbnail']==' ' ): ?>
                    <label class="description box-default">
                        <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $meta ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                    </label>
                <?php else: ?>
                    <label class="description box">
                        <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" width="100" height="90" alt="" /></span></br>
                        <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $meta ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                    </label>
                <?php endif;
            } // end foreach 
            ?>
     	</div><!-- .layout-css -->
  	</div><!-- .catchflames-meta -->            
<?php 
}


/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function catchflames_save_custom_meta( $post_id ) {  
	global $sidebar_layout, $post;
	
	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
        return;
		
	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
		
	if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
	
	foreach ($sidebar_layout as $field) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach	 
}
add_action('save_post', 'catchflames_save_custom_meta'); 