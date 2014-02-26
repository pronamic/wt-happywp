<?php get_header(); ?>

<?php if ( is_active_sidebar( 'frontpage-sidebar' ) ) : ?> 
	
	<div class="row">
		<?php dynamic_sidebar( 'frontpage-sidebar' ); ?>
	</div>

<?php endif; ?>

<?php dynamic_sidebar( 'featured-sidebar' ); ?>

<?php get_footer(); ?>