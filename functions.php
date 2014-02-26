<?php

/**
 * Theme includes
 */
require_once get_template_directory() . '/includes/post.php';
require_once get_template_directory() . '/includes/template.php';
require_once get_template_directory() . '/includes/widgets.php';
require_once get_template_directory() . '/includes/admin.php';
require_once get_template_directory() . '/includes/options.php';
require_once get_template_directory() . '/includes/shortcodes.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 620;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function robbery_setup() {
	/* Make theme available for translation */
	load_theme_textdomain( 'robbery', get_template_directory() . '/languages' );

	/* Editor style */
	add_editor_style();

	/* Add theme support */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'image', 'video' ) );
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'woocommerce' );

	/* Register navigation menu's */
	register_nav_menus( array(
		'header-navbar'       => __( 'Header Navigation Bar', 'robbery' ),
		'header-navbar-right' => __( 'Header Navigation Bar Right', 'robbery' ),
		'footer'              => __( 'Footer Navigation', 'robbery' )
	) );

	/* Add image sizes */
	add_image_size( 'slide', 940, 420, true );
	add_image_size( 'featured', 300, 200, true );
}
add_action( 'after_setup_theme', 'robbery_setup' );

/**
 * Enqueue scripts & styles
 */
function robbery_load_scripts() {
	if ( ! is_admin() ) {
		wp_enqueue_script( 
			'bootstrap', 
			get_bloginfo( 'template_directory' ) . '/js/bootstrap.min.js', 
			array( 'jquery' ),
			'3.0.2',
			true
		);

		wp_enqueue_script( 
			'flexslider', 
			get_bloginfo( 'template_directory' ) . '/js/jquery.flexslider-min.js', 
			array( 'jquery' )
		);

		wp_enqueue_script( 
			'config', 
			get_bloginfo( 'template_directory' ) . '/js/config.js', 
			array( 'jquery', 'flexslider' )
		);

		wp_enqueue_style( 
			'bootstrap',
			get_template_directory_uri() . '/css/bootstrap.min.css',
			'3.0.2'
		);
		
		wp_enqueue_style( 
			'robbery', 
			get_stylesheet_uri(),
			'1.0.0'
		);
	
		wp_enqueue_style( 
			'flexslider',
			get_bloginfo( 'template_directory' ) . '/css/flexslider.css',
			'1.0.0'
		);
	}
}

add_action( 'wp_enqueue_scripts', 'robbery_load_scripts' );

/**
 * Title
 */
function robbery_title() {
	if ( is_page() ) {
		the_title();
	} elseif ( is_post_type_archive() ) {
		post_type_archive_title();
	} elseif ( is_singular() ) {
		$post_type_obj = get_post_type_object( get_post_type() );
		
		echo $post_type_obj->labels->name;
	} elseif ( is_home() ) {
		_e( 'Blog', 'robbery' );
	} elseif ( is_search() ) {
		printf( __( 'Search Results for: %s', 'robbery' ), '<span>' . get_search_query() . '</span>' );
	} else {
		bloginfo( 'name' );
	}
}

/**
 * Posts per page
 */
function robbery_query_posts_per_page( $query ) {
	if ( $query->is_main_query() && $query->is_post_type_archive( array( 'pronamic_plugin', 'pronamic_theme' ) ) ) {
		$query->set( 'posts_per_page', 100 );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'robbery_query_posts_per_page' );


/**
 * WooCommerce
 */
 
/* Yoast breadcrumbs */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/* Wrapper */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'robbery_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'robbery_woocommerce_wrapper_end', 10 );

function robbery_woocommerce_wrapper_start() {
  	echo '<div class="col-sm-8"><div id="content" class="section" role="main">';
}

function robbery_woocommerce_wrapper_end() {
	echo '</div></div>';
}

/* Cart text */
function robbery_add_to_cart_text( $text ) {
    $text = __( 'Order', 'robbery' );
 
    return $text;
}
add_filter( 'single_add_to_cart_text', 'robbery_add_to_cart_text' );
add_filter( 'add_to_cart_text', 'robbery_add_to_cart_text' );

/* Button classes */
function robbery_add_to_cart_class( $output ) {
	$output = 'btn btn-primary';
	
	return $output;
}

add_filter( 'add_to_cart_class', 'robbery_add_to_cart_class' );
add_filter( 'single_add_to_cart_class', 'robbery_add_to_cart_class' );

/* Remove related products */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/* Remove images */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

/* Cross-Sells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'robbery_after_content', 'woocommerce_cross_sell_display' );

/**
 * Add website URL field
 */

/*

function robbery_website_url_checkout_field( $checkout ) {
    echo '<div class="additional_information">';

    woocommerce_form_field( 'website_url', array(
    	'type'          => 'text',
        'class'         => array( 'form-row-wide' ),
        'label'         => __( 'Website', 'robbery' ),
        'placeholder'   => __( 'http://', 'robbery' ),
        ), $checkout->get_value( 'website_url' )
    );

    echo '</div>';
}

add_action( 'woocommerce_after_order_notes', 'robbery_website_url_checkout_field' );

function robbery_checkout_field_process() {
    global $woocommerce;

    if ( ! $_POST['website_url'] ) {
		$woocommerce->add_error( __( '<strong>Website</strong> is a required field.' ) );
	}
}

add_action( 'woocommerce_checkout_process', 'robbery_checkout_field_process' );


function robbery_checkout_field_update_order_meta( $order_id ) {
    if ( $_POST['website_url'] ) {
    	update_post_meta( $order_id, 'Website', esc_attr( $_POST['website_url'] ) );
    }
}

add_action( 'woocommerce_checkout_update_order_meta', 'robbery_checkout_field_update_order_meta' );

*/