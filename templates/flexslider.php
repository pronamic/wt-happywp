<?php

$query = new WP_Query( array(
	'post_type'        => 'slide',
	'posts_per_page'   => -1
) );

if ( $query->have_posts() ) : ?>
		
	<section class="page-slider">
		<div class="container">
			<div class="flexslider">
				<ul class="slides">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					
						<li>
							<?php the_content(); ?>
						</li>

					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</section>

<?php wp_reset_postdata(); endif; ?>