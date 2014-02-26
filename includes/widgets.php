<?php

/**
 * Widget includes
 */
require_once get_template_directory() . '/includes/widgets/Robbery_Latest_Posts_Widget.php';
require_once get_template_directory() . '/includes/widgets/Robbery_Secondary_Nav_Widget.php';
require_once get_template_directory() . '/includes/widgets/Robbery_Plugins_Widget.php';
require_once get_template_directory() . '/includes/widgets/Robbery_Themes_Widget.php';

/**
 * Widgets
 */
function robbery_wp_widgets() {

	/* Unregister default WordPress Widgets */

	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );

	/* Register custom WordPress Widgets */

	register_widget( 'Robbery_Latest_Posts_Widget' );
	register_widget( 'Robbery_Secondary_Nav_Widget' );
	register_widget( 'Robbery_Plugins_Widget' );
	register_widget( 'Robbery_Themes_Widget' );

	/* Register Widget Areas */

	register_sidebar( array(  
		'name'          => __( 'Main Widget Area', 'robbery' ),
		'id'            => 'main-sidebar',
		'description'   => __( 'The widget area for the main content.', 'robbery' ),
		'before_widget' => '<div id="%1$s" class="widget panel %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(  
		'name'          => __( 'Featured Widget Area', 'robbery' ),
		'id'            => 'featured-sidebar',
		'description'   => __( 'The widget area for the featured content.', 'robbery' ),
		'before_widget' => '<div id="%1$s" class="panel note %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(  
		'name'          => __( 'Shop Widget Area', 'robbery' ),
		'id'            => 'shop-sidebar',
		'description'   => __( 'The widget area for the shop.', 'robbery' ),
		'before_widget' => '<div id="%1$s" class="widget panel %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(  
		'name'          => __( 'Frontpage Widget Area', 'robbery' ),
		'id'            => 'frontpage-sidebar',
		'description'   => __( 'The widget area for the frontpage.', 'robbery' ),
		'before_widget' => '<div class="col-sm-4"><div id="%1$s" class="section no-padding widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<header><h3 class="widget-title">',
		'after_title'   => '</h3></header>',
	) );
}
add_action( 'widgets_init', 'robbery_wp_widgets', 1 );
