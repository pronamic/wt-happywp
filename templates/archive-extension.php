<?php get_header(); ?>

<div class="row">
	<div class="col-sm-3">
		<h3>
			<?php _e( 'Categories', 'robbery' ); ?>
		</h3>
		
		<?php

		$taxonomy = 'category';
		switch ( get_query_var( 'post_type' ) ) {
			case 'pronamic_plugin':
				$taxonomy = 'pronamic_plugin_category';
				break;
			case 'pronamic_theme':
				$taxonomy = 'pronamic_theme_category';
				break;
		}

		?>
		<ul class="category-navigation">
			<?php

			wp_list_categories( array( 
				'taxonomy' => $taxonomy, 
				'title_li' => false,
			) );

			?>
		</ul>
	</div>

	<div class="col-sm-9" role="main">

		<?php if ( false ) : ?>

			<div class="filter clearfix">
				<ul>
					<li class="active"><a href="#">All</a></li>
					<li><a href="#">Premium</a></li>
					<li><a href="#">Free</a></li>
					<li><a href="#">Popular</a></li>
				</ul>
			</div>

		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
		
			<div class="section no-padding">
				<?php while ( have_posts() ) : the_post(); ?>

					<article class="plugin">
						<div class="row">								
							<div class="col-sm-10">
								<a class="image" href="#">
									<img src="<?php echo get_template_directory_uri(); ?>/placeholders/thumbnail.png" />
								</a>
			
								<div class="content">
									<h3>
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
						
									<p class="entry-meta">
										<?php

										printf(
											__( 'Stable version: %s', 'robbery' ),
											get_post_meta( $post->ID, '_pronamic_extension_stable_version', true )
										);
						
										?>
									</p>

									<?php the_excerpt(); ?>
								</div>
							</div>
				
							<div class="col-sm-2">
								<div class="info">
									<?php

									$price      = get_post_meta( $post->ID, '_pronamic_extension_price', true );
									$is_private = get_post_meta( $post->ID, '_pronamic_extension_is_private', true );
									
									$label = __( 'Free', 'robbery' );
									
									if ( $is_private ) {
										$label = __( 'Private', 'robbery' );
									} elseif ( ! empty( $price ) ) {
										$label = pronamic_wp_extension_format_price( $price );
									}

									?>
									<p class="h2"><?php echo $label; ?></p>

									<?php

									$total_sales = get_post_meta( $post->ID, '_pronamic_extension_total_sales', true );

									if ( ! empty( $total_sales ) ) : ?>

										<p class="votes">
											<?php

											printf( 
												__( '%s sales', 'robbery' ),
												$total_sales
											);
							
											?>
										</p>

									<?php endif; ?>
								</div>
							</div>
						</div>
					</article>
		
				<?php endwhile; ?>

			</div>

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>