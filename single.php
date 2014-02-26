<?php get_header(); ?>

<div class="row">
	<div class="col-sm-8">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
	
						<?php if ( 'post' == get_post_type() ) : ?>
	
							<div class="entry-meta">
								<p>
									<?php robbery_posted_on(); ?>
								</p>
							</div>
	
						<?php endif; ?>
					</header>
	
					<div class="entry-content clearfix">
						<?php the_content(); ?>
			
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'robbery' ), 'after' => '</div>' ) ); ?>
					</div>
	
					<footer class="entry-meta">
						<p>
							<?php robbery_posted_in(); ?>
						</p>
					</footer>

					<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || ! is_multi_author() ) ) : ?>

						<div id="author-info">
							<div id="author-avatar">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'robbery_author_bio_avatar_size', 60 ) ); ?>
							</div>
	
							<div id="author-description">
								<h2>
									<?php printf( __( 'About %s', 'robbery' ), get_the_author() ); ?>
								</h2>
					
								<p>
									<?php the_author_meta( 'description' ); ?>
								</p>
	
								<p id="author-link">
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
										<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'robbery' ), get_the_author() ); ?>
									</a>
								</p>
							</div>
						</div>

					<?php endif; ?>
				</article>
		
				<?php comments_template( '', true ); ?>
			
			<?php endwhile; ?>
		</div>
	</div>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

