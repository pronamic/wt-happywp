<?php

/**
 * Secondary navigation walker
 */
class Robbery_Secondary_Nav_Walker extends Walker_Nav_Menu {
	private $active = false;

	public function __construct() {
		add_filter( 'wp_nav_menu', array( $this, 'navMenu' ), 10, 2 );
	}

	public function navMenu( $nav_menu, $args ) {
		if ( $args->walker == $this ) {
			$content = strip_tags( $nav_menu );

			if ( empty( $content ) ) {
				return '';
			} else {
				return $nav_menu;
			}
		}

		return $nav_menu;
	}

	private function isActive( $depth ) {
		return $depth > 0 && $this->active;
	}
	
	function start_lvl( &$output, $depth ) {
		if ( $this->isActive( $depth ) ) {
			parent::start_lvl( $output, $depth );
		}
	}
	
	function end_lvl( &$output, $depth ) {
		if ( $this->isActive( $depth ) ) {
			parent::end_lvl( $output, $depth );
		}
	}

	function start_el( &$output, $item, $depth, $args ) {
		if ( $depth == 0 ) {
			$classes = array( 
				'current-menu-item' , 
				'current-menu-parent',
				'current-menu-parent' ,
				'current-menu-ancestor' ,
			);

			do {
				$class = array_shift( $classes );
				$this->active = in_array( $class, $item->classes );
			} while ( ! $this->active && ! empty( $classes ) );
		}

		if ( $this->isActive( $depth ) ) {
			parent::start_el( $output, $item, $depth, $args );
		}
	}

	function end_el( &$output, $item, $depth ) {
		if ( $this->isActive( $depth ) ) {
			parent::end_el( $output, $item, $depth, $args );
		}
	}
}


/**
 * Secondary navigation
 */
class Robbery_Secondary_Nav_Widget extends WP_Widget {
	function Robbery_Secondary_Nav_Widget() {
		parent::__construct( 'robbery-secondary-nav-widget', __( 'Secondary navigation', 'robbery' ), array( 'description' => __( 'Displays secondary navigation', 'robbery' ) ) );
	}

	function widget( $args, $instance ) {
		global $post;

		extract( $args );

		// Get parent ID
		if ( $post->post_parent ) {
			$ancestors = get_post_ancestors( $post->ID );
			$root = count( $ancestors ) -1;

			$parent_id = $ancestors[$root];
		} else {
			$parent_id = $post->ID;
		}

		$title = empty( $instance['title'] ) ? get_the_title( $parent_id ) : esc_attr( $instance['title'] );
		$menu_type = empty( $instance['menu_type'] ) ? '' : esc_attr( $instance['menu_type'] );

		if ( $menu_type == 'menu' ) : ?>

			<?php echo $before_widget; ?>

			<h3>
				<?php echo $title; ?>
			</h3>

			<nav id="secondary-nav">
				<?php
		
				wp_nav_menu( array(
					'theme_location' => 'primary' , 
					'walker'         => new Robbery_Secondary_Nav_Walker()
				) );
				
				?>
			</nav>
			
			<?php echo $after_widget; ?>
			
		<?php else :

			$children = wp_list_pages( array (
				'title_li' => '',
				'child_of' => $parent_id,
				'echo'     => 0,
				'depth'    => 1
			) );
			
			if ( $children ) : ?>

				<?php echo $before_widget; ?>
	
				<h3>
					<?php echo $title; ?>
				</h3>

				<nav id="secondary-nav">
					<ul>
						<?php echo $children; ?>
					</ul>
				</nav>

				<?php echo $after_widget; ?>

			<?php endif; ?>

		<?php

		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] =  $new_instance['title'];
		$instance['menu_type'] =  $new_instance['menu_type'];

		return $instance;
	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$menu_type = isset( $instance['menu_type'] ) ? esc_attr( $instance['menu_type'] ) : '';

		?>

		<div>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'robbery' ); ?>
			</label>

			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

			<p class="description">
				<?php _e( 'Leave blank to use top level page title.', 'robbery' ); ?>
			</p>
		</div>

		<div>
			<label for="<?php echo $this->get_field_id( 'menu_type' ); ?>">
				<?php _e( 'Menu type:', 'robbery' ); ?>
			</label>
			
			<select id="<?php echo $this->get_field_id( 'menu_type' ); ?>" name="<?php echo $this->get_field_name( 'menu_type' ); ?>">
				<option value="pages" <?php selected( $menu_type, 'pages' ); ?>><?php _e( 'Pages (wp_list_pages)', 'robbery' ); ?></option>
				<option value="menu" <?php selected( $menu_type, 'menu' ); ?>><?php _e( 'Menu (wp_nav_menu)', 'robbery' ); ?></option>
			</select>
		</div>
		
		<?php
	}
}