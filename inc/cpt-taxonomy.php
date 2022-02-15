<?php 
function sp_register_custom_post_types(){

     //Register Testimonial Post Type
     $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name'  ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name'  ),
        'menu_name'          => _x( 'Testimonials', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'view_item'          => __( 'View Testimonial'  ),
        'all_items'          => __( 'All Testimonials' ),
        'search_items'       => __( 'Search Testimonials' ),
        'parent_item_colon'  => __( 'Parent Testimonials:' ),
        'not_found'          => __( 'No testimonials found.' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/quote' ) ),
        'template_lock'      => 'all'

    );
    
    register_post_type( 'sp-testimonial', $args );

}
add_action( 'init', 'sp_register_custom_post_types' );


//flush permalinks after activiating the theme
function sp_rewrite_flush() {
    sp_register_custom_post_types();
    // sp_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'sp_rewrite_flush' );




