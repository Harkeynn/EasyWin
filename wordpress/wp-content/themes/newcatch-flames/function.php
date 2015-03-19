<?php add_action( 'init', 'create_post_type' );
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