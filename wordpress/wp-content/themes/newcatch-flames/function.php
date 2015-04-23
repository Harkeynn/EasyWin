<?php 
add_action( 'init', 'create_roles' );
function create_roles(){
$result = add_role(
    'basic_journalist',
    __( 'Basic Journalist' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false,
        'delete_published_posts' => false,
        'edit_published_posts' => true,
        'upload_files' => true,
    )
);
if ( null !== $result ) {
    echo 'Yay! New role created!';
}
else {
    echo 'Oh... the basic_journalist role already exists.';
}

$result = add_role(
    'basic_dirredac',
    __( 'Basic Directeur de Rédaction' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_others_posts'  => true,
        'delete_posts'  => true,
        'delete_private_posts'  => true,
        'delete_published_posts'  => true,
        'edit_others_posts'  => true,
        'edit_posts'  => true,
        'edit_private_posts'  => true,
        'edit_published_posts'  => true,
        'manage_categories'  => true,
        'manage_links'  => true,
        'moderate_comments'  => true,
        'publish_pages'  => true,
        'publish_posts'  => true,
        'read'  => true,
        'read_private_pages'  => true,
        'read_private_posts'  => true,
        'delete_posts'  => true, // Use false to explicitly deny
    )
);
if ( null !== $result ) {
    echo 'Yay! New role created!';
}
else {
    echo 'Oh... the basic_dirredac role already exists.';
}

$result = add_role(
    'basic_webmaster',
    __( 'Basic Webmaster' ),
    array(
        'manage_network' => true,
        'manage_sites' => true,
        'manage_network_users' => true,
        'manage_network_themes' => true,
        'manage_network_options' => true,
        'activate_plugins' => true,
        'edit_dashboard' => true,
        'edit_files' => true,
        'edit_others_pages' => true,
        'edit_pages' => true,
        'edit_private_pages' => true,
        'edit_published_pages' => true,
        'edit_theme_options' => true,
        'export' => true,
        'import' => true,
        'list_users' => true,
        'manage_categories' => true,
        'manage_links' => true,
        'manage_options' => true,
        'moderate_comments'=> true,
        'promote_users' => true,
        'publish_pages' => true,
        'switch_themes' => true,
        'upload_files' => true,
        'update_core' => true,
        'update_plugins' => true,
        'update_themes' => true,
        'install_plugins' => true,
        'install_themes' => true,
        'delete_themes' => true,
        'edit_plugins' => true,
        'edit_themes' => true,
        'edit_users' => true,
        'create_users' => true,
        'delete_users' => true,
        'unfiltered_html' => true,
        'read'         => false, 
        'edit_posts'   => false,
        'delete_posts' => false, // Use false to explicitly deny
    )
);
if ( null !== $result ) {
    echo 'Yay! New role created!';
}
else {
    echo 'Oh... the basic_dirredac role already exists.';
}
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'produit',
    array(
      'labels' => array(
        'name' => __( 'Produits' ),
        'singular_name' => __( 'Produit' )
      ),
      'public' => true
    )
  );
}

register_taxonomy( 'couleur', 'produit', array( 'hierarchical' => true, 'label' => 'Couleur', 'query_var' => true, 'rewrite' => true ) )
?>

<?php add_filter( 'pre_get_posts', 'my_get_posts' );

function my_get_posts( $query ) {
 if ( is_home() )
 $query->set( 'post_type', array( 'produit' ) );

 return $query;
}
?>