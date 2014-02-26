<?php

/**
 * Initialize the custom post types and taxonomies
 */
function robbery_init() {
	add_post_type_support( 'page', 'excerpt' );

	// Register post type
	register_post_type( 'slide', array( 
		'labels' => array( 
			'name'               => _x( 'Slide', 'post type general name', 'robbery' ),
			'singular_name'      => _x( 'Slide', 'post type singular name', 'robbery' ),
			'add_new'            => _x( 'Add New', 'slide', 'robbery' ),
			'add_new_item'       => __( 'Add New Slide', 'robbery' ),
			'edit_item'          => __( 'Edit Slide', 'robbery' ),
			'new_item'           => __( 'New Slide', 'robbery' ),
			'view_item'          => __( 'View Slide', 'robbery' ),
			'search_items'       => __( 'Search Slides', 'robbery' ),
			'not_found'          => __( 'No slides found', 'robbery' ),
			'not_found_in_trash' => __( 'No slides found in Trash', 'robbery' ),
			'parent_item_colon'  => __( 'Parent Slide:', 'robbery' ),
			'menu_name'          => __( 'Slides',  'robbery' )
		) , 
		'public'                 => true,
		'publicly_queryable'     => true,
		'show_ui'                => true,
		'show_in_menu'           => true,
		'capability_type'        => 'post',
		'has_archive'            => false,
		'menu_icon'              => get_bloginfo( 'template_url' ) . '/admin/icons/slide.png',
		'supports'               => array( 'title', 'editor', 'thumbnail' )
	) );

	/*

	// Register taxonomy
	register_taxonomy( 'region', 'client', array(
		'hierarchical' => true,
		'labels' => array(
			'name'              => _x( 'Specialisms', 'class general name', 'robbery' ),
			'singular_name'     => _x( 'Specialism', 'class singular name', 'robbery' ),
			'search_items'      => __( 'Search Specialisms', 'robbery' ),
			'all_items'         => __( 'All Specialisms', 'robbery' ),
			'parent_item'       => __( 'Parent Specialisms', 'robbery' ),
			'parent_item_colon' => __( 'Parent Specialism:', 'robbery' ),
			'edit_item'         => __( 'Edit Specialism', 'robbery' ),
			'update_item'       => __( 'Update Specialism', 'robbery' ),
			'add_new_item'      => __( 'Add New Specialism', 'robbery' ),
			'new_item_name'     => __( 'New Specialism Name', 'robbery' ),
			'menu_name'         => __( 'Specialisms', 'robbery' ) 
		) , 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'regio' )
	) );

	register_taxonomy_for_object_type( 'post_tag', 'page' );

	*/
}
add_action( 'init', 'robbery_init' );
