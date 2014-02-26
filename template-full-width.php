<?php
/**
 * Template Name: Full width
 */

get_header(); ?>

<div class="container main">
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
</div>

<?php get_footer(); ?>