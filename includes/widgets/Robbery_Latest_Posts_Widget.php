<?php 

/**
 * Latest posts
 */
class Robbery_Latest_Posts_Widget extends WP_Widget {
	function Robbery_Latest_Posts_Widget() {
		parent::__construct( 'robbery-latest-posts-widget', __( 'Latest Posts', 'robbery' ), array( 'description' => __( 'Displays recent posts', 'robbery' ) ) );
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
			'post_type'      => 'post',
			'posts_per_page' => $number
		) );
		
		if ( $query->have_posts() ) :  ?>
			
			<ul class="recent-posts">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<li>
						<h4>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
					
						<span class="date">
							<?php echo get_the_date( 'd F Y' ); ?>
						</span>
					</li>

				<?php endwhile; ?>
			</ul>

			<footer>
				<a class="btn btn-primary" href="<?php echo robbery_get_blog_url() . '/'; ?>">
					<?php _e( 'Read our blog', 'robbery' ); ?>
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
