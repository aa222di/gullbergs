<?php
/*
Plugin Name: Eden Service
Plugin URI: http://
Description: Custom Post Types for Eden Service
Author: Amanda Aberg
Version:1
Author URI:http://	
*/ 

add_action( 'init', 'eden_service_init' );

/**
 * Register a service post type.
 *
 */
function eden_service_init() {
	$labels = array(
		'name'               => _x( 'Tjänster', 'eden_service' ),
		'singular_name'      => _x( 'Tjänst', 'eden_service' ),
		'menu_name'          => _x( 'Tjänster', 'admin menu' ),
		'name_admin_bar'     => _x( 'Tjänst', 'add new on admin bar' ),
		'add_new'            => _x( 'Lägg till ny', 'eden_service' ),
		'add_new_item'       => __( 'Lägg till ny tjänst' ),
		'new_item'           => __( 'Ny tjänst' ),
		'edit_item'          => __( 'Redigera tjänst' ),
		'view_item'          => __( 'Se tjänst' ),
		'all_items'          => __( 'Alla tjänster' ),
		'search_items'       => __( 'Sök bland tjänster' ),
		'parent_item_colon'  => __( 'Parent Services:' ),
		'not_found'          => __( 'Inga tjänster hittades' ),
		'not_found_in_trash' => __( 'Inga tjänster hittades i papperskorgen' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'thumbnail', 'excerpt', 'genesis-cpt-archives-settings', 'editor')
	);

	register_post_type( 'eden_service', $args );
}

//admin_init
add_action('manage_posts_custom_column', 'eden_custom_service_columns');
add_filter('manage_eden_service_posts_columns', 'eden_add_new_service_columns');
 
function eden_add_new_service_columns( $columns ){
    $new_columns = array(
        'eden_post_excerpt'	=> 'Kort beskrivning',
    );
    return array_merge($columns, $new_columns);
}
 
function eden_custom_service_columns( $column ){
    global $post;
    
    switch ($column) {
        case 'eden_post_excerpt': echo the_excerpt(); break;
    }
}
 