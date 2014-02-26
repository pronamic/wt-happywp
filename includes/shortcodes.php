<?php

/**
 * Panel
 */
function robbery_panel_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => ''
	), $atts ) );

	if ( $type == 'slogan' ) {
		return '<div class="panel slogan">' . do_shortcode( $content ) . '</div>';
	} else {
		return '<div class="panel">' . do_shortcode( $content ) . '</div>';
	}
}
add_shortcode( 'panel', 'robbery_panel_shortcode' );

/**
 * Tabs
 */
function robbery_tabs_group( $atts, $content = null ) {
    extract( shortcode_atts( array( 
        'type'    => 'tabs'
    ), $atts ) );  

    $output = '<div class="section-container ' . $type . '" data-section="' . $type . '">' . do_shortcode( $content ) . '</div>';

    return $output;  
}  

function robbery_tab( $atts, $content = null ) {  
    extract( shortcode_atts( array( 
        'id'    => '',
        'title' => ''
    ), $atts ) );  

    $output = '
        <section>
        	<p class="title" data-section-title><a href="#' . $id . '">' . $title . '</a></p>
			<div class="content" data-section-content>
				<p>' . $content . '</p>
			</div>
       	</section>
    ';

    return $output;
}
add_shortcode( 'tabs', 'robbery_tabs_group' );
add_shortcode( 'tab', 'robbery_tab' );

/**
 * Latests posts
 */
function robbery_latests_posts( $atts ) {
     extract( shortcode_atts( array(
	      'number'   => 5,
	      'category' => 'algemeen'
     ), $atts ) );

	$query = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => $number,
		'category_name'  => $category
	) );

	if ( $query->have_posts() ) {
		$output .= '<ul>';

			while ( $query->have_posts() ) { $query->the_post();
				$output .= '<li>';
				$output .= '<a href="' . get_permalink() . '">';
				$output .= get_the_title();
				$output .= '</a>';
				$output .= '</li>';
			}

		$output .= '</ul>';
	}

	wp_reset_postdata();

	return $output;
}
add_shortcode( 'posts', 'robbery_latests_posts' );

/**
 * Grid
 */
function robbery_columns_grid( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'number' => '',
		'type'   => ''
	), $atts ) );

	switch ( $type ) {
		case 'first' :
			return '<div class="row"><div class="large-' . $number . ' columns">' . do_shortcode( $content ) . '</div>';
			break;
		case 'last' :
			return '<div class="large-' . $number . ' columns">' . do_shortcode( $content ) . '</div></div>';
			break;
		default :
			return '<div class="large-' . $number . ' columns">' . do_shortcode( $content ) . '</div>';
	}
}
add_shortcode( 'col', 'robbery_columns_grid' );

/**
 * Fix shortcode output
 */
function robbery_shortcode_empty_paragraph_fix( $content ) {   
	$array = array (
		'<p>['    => '[', 
		']</p>'   => ']', 
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	return $content;
}
add_filter( 'the_content', 'robbery_shortcode_empty_paragraph_fix' );
