<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div class="row">
		<div class="col-sm-8">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
		
					<?php get_template_part( 'templates/content' ); ?>
		
				<?php endwhile; ?>
		
				<?php robbery_content_nav(); ?>
			</div>
		</div>

		<?php get_sidebar(); ?>
	</div>

<?php else : ?>

	<?php get_template_part( 'templates/no-results' ); ?>

<?php endif; ?>

<?php get_footer(); ?>