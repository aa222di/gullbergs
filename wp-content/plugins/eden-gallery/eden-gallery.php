<?php
/*
Plugin Name: Eden Gallery
Plugin URI: http://
Description: Custom Post Types for Eden Gallery
Author: Amanda Aberg
Version:1
Author URI:http://	
*/ 

// Creating gallery //

add_action( 'init', 'eden_gallery_init' );

function eden_gallery_init() {
if ( function_exists( 'add_theme_support')){
    add_theme_support( 'post-thumbnails' );
}
add_image_size( 'admin-list-thumb', 80, 80, true); //admin thumbnail

	$labels = array(
		'name'               => _x( 'Gallerys', 'eden_gallery' ),
		'singular_name'      => _x( 'Gallery', 'eden_gallery' ),
		'menu_name'          => _x( 'Gallery', 'admin menu' ),
		'name_admin_bar'     => _x( 'Gallery', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'eden_gallery' ),
		'add_new_item'       => __( 'Add New Gallery' ),
		'new_item'           => __( 'New Gallery' ),
		'edit_item'          => __( 'Edit Gallery' ),
		'view_item'          => __( 'View Gallery' ),
		'all_items'          => __( 'All Gallery' ),
		'search_items'       => __( 'Search Gallery' ),
		'parent_item_colon'  => __( 'Parent Gallery:' ),
		'not_found'          => __( 'No galleries found.' ),
		'not_found_in_trash' => __( 'No Gallery found in Trash.' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'gallery' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'excerpt', 'thumbnail', 'genesis-cpt-archives-settings')
	);
register_post_type('eden_gallery', $args);
}

add_action( 'init', 'eden_create_gallery_taxonomies', 0);
 
function eden_create_gallery_taxonomies(){
    register_taxonomy(
        'phototype', 'eden_gallery',
        array(
            'hierarchical'	 => true,
            'label'			 => 'Photo Types',
            'singular_label' => 'Photo Type',
            //'rewrite'		 => true
        )
    );    
}

//admin_init
add_action('manage_posts_custom_column', 'eden_custom_columns');
add_filter('manage_eden_gallery_posts_columns', 'eden_add_new_gallery_columns');
 
function eden_add_new_gallery_columns( $columns ){
    $new_columns = array(
        'cb'				=> '<input type="checkbox">',
        'eden_post_thumb'	=> 'Thumbnail',
        'title'				=> 'Photo Title',
        'phototype'			=> 'Photo Type',
        'author'			=> 'Author',
        'date'				=> 'Date'
        
    );
    return array_merge($columns, $new_columns);
}
 
function eden_custom_columns( $column ){
    global $post;
    
    switch ($column) {
        case 'eden_post_thumb'	: echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description'		: the_excerpt(); break;
        case 'phototype'		: echo get_the_term_list( $post->ID, 'phototype', '', ', ',''); break;
    }
}

//** API
function eden_gallery_loop()
{
	$args = array(
		'post_type' => 'eden_gallery',
		'post_per_page' => -1,
		);

	global $wp_query, $more;

	$defaults = array(); //* For forward compatibility
	$args     = apply_filters( 'genesis_custom_loop_args', wp_parse_args( $args, $defaults ), $args, $defaults );

	$wp_query = new WP_Query( $args );

	eden_gallery_content_loop();


	//* Restore original query
	wp_reset_query();

}
 
 /**
 * Standard loop, meant to be executed without modification in most circumstances where content needs to be displayed.
 *
 * It outputs basic wrapping HTML, but uses hooks to do most of its content output like title, content, post information
 * and comments.
 *
 * The action hooks called are:
 *
 *  - `genesis_before_while`
 * 	- `genesis_after_endwhile`
 *  - `genesis_loop_else` (only if no posts were found)
 *
 * @since 1.0
 *
 * @return null Return early after legacy loop if not supporting HTML5.
 */
function eden_gallery_content_loop() {

	if ( have_posts() ) :
do_action('eden_before_gallery', 'gallery');
		echo "<div class='eden-gallery'>";
		do_action( 'genesis_before_while' );

		  //begin loop
        while ( have_posts() ) : the_post();
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
        
        echo "<a href='" . $large_image_url[0] . "' title='" . get_the_title() . "' class='lightbox'>";

           the_post_thumbnail('medium'); //display custom thumbnail size 

        echo "</a>";
		endwhile; // end of the loop.


		do_action( 'genesis_after_endwhile' );
		echo "</div>";
		

	else : //* if no posts exist
		do_action( 'genesis_loop_else' );
	endif; //* end loop
	do_action('eden_after_gallery');
}