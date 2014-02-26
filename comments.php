<?php

if ( post_password_required() ) {
	return;
}

?>

<div id="comments">
	<?php if ( have_comments() ) : ?>

		<h2 id="comments-title">
			<span><?php printf( _n( 'One thought', '%1$s thoughts', get_comments_number(), 'robbery' ), number_format_i18n( get_comments_number() ) ); ?></span>
		</h2>
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	
			<nav id="comment-nav-above">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'robbery' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'robbery' ) ); ?></div>
			</nav>
	
		<?php endif; ?>
	
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'robbery_comment' ) ); ?>
		</ol>
	
		<?php if ( get_comment_pages_count() > 1 && get_option('page_comments' ) ) : ?>

			<nav id="comment-nav-below">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'robbery' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'robbery' ) ); ?></div>
			</nav>
	
		<?php endif; ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="nocomments">
			<?php _e( 'Comments are closed.', 'robbery' ); ?>
		</p>

	<?php endif; ?>

	<?php

	$args = array(
		'title_reply' => __( '<span>Post a comment</span>', 'robbery' )
	);

	comment_form( $args );

	?>
</div>