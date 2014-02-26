<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div id="content" role="main">
		<article class="post error404 not-found">
			<div class="entry-content">
				<h1>
					<?php _e( 'Page not found', 'robbery' ); ?>
				</h1>

				<p>
					<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'robbery' ); ?>
				</p>

				<?php get_search_form(); ?>
			</div>
		</article>
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>