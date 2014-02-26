<?php get_header(); ?>

<div class="row">
	<div class="col-sm-8">
		<div id="content" class="section" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
			
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'robbery' ), 'after' => '</div>' ) ); ?>
					</div>
				</article>

			<?php endwhile; ?>
		</div>

		<?php

		if ( is_cart() ) {
			do_action( 'robbery_after_content' );
		}

		?>
	</div>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>