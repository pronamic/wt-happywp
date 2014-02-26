<?php 

/**
 * Plugins
 */
class Robbery_Plugins_Widget extends WP_Widget {
	function Robbery_Plugins_Widget() {
		parent::__construct( 'robbery-plugins-widget', __( 'Latest plugins', 'robbery' ), array( 'description' => __( 'Displays recent plugins', 'robbery' ) ) );
	}

	function widget( $args, $instance ) {
		global $post;

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		if ( ! $number = absint( $instance['number'] ) ) {
 			$number = 5;
		}

		echo $before_widget;
		
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$query = new WP_Query( array( 
			'post_type'      => 'pronamic_plugin',
			'posts_per_page' => $number,
			'order'          => 'ASC'
		) );

		if ( $query->have_posts() ) :  ?>

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<article class="plugin">
					<div class="row">								
						<div class="col-sm-12">
							<a class="image" href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
							
									<?php the_post_thumbnail( array( 80, 80 ) ); ?>
							
								<?php else : ?>

									<img src="<?php echo get_template_directory_uri(); ?>/placeholders/thumbnail.png" alt="" />
							
								<?php endif; ?>
							</a>
		
							<div class="content">
								<h3>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
					
								<p class="entry-meta">
									<?php

									printf( __( 'Stable version: %1$s', 'robbery' ),
										get_post_meta( $post->ID, '_pronamic_extension_stable_version', true )
									);
				
									?>
								</p>
							</div>
						</div>
					</div>
				</article>

			<?php endwhile; ?>
		
			<footer>
				<a class="btn btn-primary" href="<?php echo get_post_type_archive_link( 'pronamic_plugin' ); ?>">
					<?php _e( 'All plugins', 'robbery' ); ?>
				</a>
			</footer>

		<?php wp_reset_postdata(); endif;

		echo $after_widget; 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] =  $new_instance['title'];
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : '';

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'robbery' ); ?>
			</label>

			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">
				<?php _e( 'Number posts:', 'robbery' ); ?>
			</label>

			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		
		<?php
	}
}
