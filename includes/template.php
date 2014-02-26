<?php

/**
 * Page title
 */
function robbery_wp_title( $title, $separator ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $separator $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $separator " . sprintf( __( 'Page %s', 'robbery' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'robbery_wp_title', 10, 2 );

/**
 * Page menu
 */
function robbery_page_menu_args( $args ) {
	$args['show_home'] = true;

	return $args;
}
add_filter( 'wp_page_menu_args', 'robbery_page_menu_args' );


///////////////////////////////////////////////


/**
 * Enqueue comment reply script
 */
function robbery_enqueue_comments_reply() {
	if ( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'robbery_enqueue_comments_reply' );

/**
 * Template for comments and pingbacks.
 */
function robbery_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>

	<li class="post pingback">
		<p>
			<?php _e( 'Pingback:', 'robbery' ); ?> <?php comment_author_link(); ?>
		</p>

	<?php break; default: ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author">
					<?php

					echo get_avatar( $comment, 60 );

					printf( __( '%1$s on %2$s said:', 'robbery' ),
						sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
						sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( __( '%1$s at %2$s', 'robbery' ), get_comment_date(), get_comment_time() )
						)
					);

					?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
	
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'robbery' ); ?></p>

				<?php endif; ?>
			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

			<div class="reply">
				<?php 

				comment_reply_link( array_merge( $args, array( 
					'reply_text' => __( 'Reply <span>&darr;</span>', 'robbery' ), 
					'depth'      => $depth, 
					'max_depth'  => $args['max_depth'] 
				) ) ); 

				?>
			</div>
		</article>
	<?php

	break; endswitch;
}

///////////////////////////////////////////////


/**
 * Archive title
 */
function robbery_archive_title() {
	if ( is_category() ) {
		printf( __( 'Category Archives: %s', 'robbery' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	
	} elseif ( is_tag() ) {
		printf( __( 'Tag Archives: %s', 'robbery' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	
	} elseif ( is_author() ) {
		the_post();
	
		printf( __( 'Author Archives: %s', 'robbery' ), '<a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' );
	
		rewind_posts();
	
	} elseif ( is_day() ) {
		printf( __( 'Daily Archives: %s', 'robbery' ), '<span>' . get_the_date() . '</span>' );
	
	} elseif ( is_month() ) {
		printf( __( 'Monthly Archives: %s', 'robbery' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'robbery' ) ) . '</span>' );
	
	} elseif ( is_year() ) {
		printf( __( 'Yearly Archives: %s', 'robbery' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'robbery' ) ) . '</span>' );
	} elseif ( is_post_type_archive() ) {
		echo post_type_archive_title();
	} else {
		_e( 'Archive', 'robbery' );
	}
}

/**
 * Archive description
 */
function robbery_archive_description() {
	if ( is_category() ) {
		$category_description = category_description();
	
		if ( ! empty( $category_description ) ) {
			echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
		}
	
	} elseif ( is_tag() ) {
		$tag_description = tag_description();
	
		if ( ! empty( $tag_description ) ) {
			echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
		}
	}
}

/**
 * Navigation
 */
function robbery_content_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav class="content-navigation clearfix">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'robbery' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'robbery' ) ); ?></div>
		</nav>

	<?php endif;
}


///////////////////////////////////////////////


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function robbery_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'robbery' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url(get_the_author_meta('ID') ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'robbery' ), get_the_author() ) ),
		get_the_author()
	);
}

/**
 * Prints HTML with meta information about the tags and categories
 */
function robbery_posted_in() {
	$categories_list = get_the_category_list( ', ' );
	$tag_list = get_the_tag_list( '', ', ' );

	if ( '' != $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>.', 'robbery' );
	} elseif( '' != $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>.', 'robbery' );
	} else {
		$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>.', 'robbery' );
	}

	printf( 
		$utility_text ,
		$categories_list ,
		$tag_list ,
		esc_url( get_permalink() ) ,
		the_title_attribute( 'echo=0' ) ,
		get_the_author() ,
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
	);
}


///////////////////////////////////////////////


/**
 * Active archive links
 */
function robbery_nav_menu_css_class( $classes, $item ) {
	if ( $item->type == 'custom' ) {
		$is_ancestor = strncmp( get_permalink(), $item->url, strlen( $item->url ) ) == 0;
		$is_home = untrailingslashit( $item->url ) == home_url();

		if ( $is_ancestor && ! $is_home ) {
			$classes[] = 'current-url-ancestor';
		}
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'robbery_nav_menu_css_class', 10, 2 );


///////////////////////////////////////////////


/**
 * Add extra styles to the TinyMCE editor
 */
function robbery_add_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'robbery_add_mce_buttons' );

function robbery_set_mce_formats( $settings ) {
    $style_formats = array(
    	array(
    		'title'    => __( 'Button', 'robbery' ),
    		'selector' => 'a',
    		'classes'  => 'button'
    	),
    	array(
    		'title'    => __( 'Button small', 'robbery' ),
    		'selector' => 'a',
    		'classes'  => 'button small'
    	),
    	array(
    		'title'    => __( 'Button secondary', 'robbery' ),
    		'selector' => 'a',
    		'classes'  => 'button secondary'
    	),
    	array(
    		'title'    => __( 'Button secondary small', 'robbery' ),
    		'selector' => 'a',
    		'classes'  => 'button secondary small'
    	),
    	array(
    		'title'    => __( 'Lead', 'robbery' ),
    		'selector' => 'p',
    		'classes'  => 'lead'
    	)
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}
add_filter( 'tiny_mce_before_init', 'robbery_set_mce_formats' );

/**
 * Format price
 */
function pronamic_wp_extension_format_price( $price ) {
	$value = '&euro;' . number_format( $price, 2, ',', '.' );

	$value = rtrim( rtrim( $value, '0' ), ',' );

	return $value;
}

/**
 * Get blog URL
 */
function robbery_get_blog_url(){
	if ( $posts_page_id = get_option( 'page_for_posts' ) ) {
		return home_url( get_page_uri( $posts_page_id ) );
	} else {
		return home_url();
	}
}