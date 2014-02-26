<?php

/**
 * Admin menu
 */
function robbery_admin_menu() {
	add_theme_page( 
		__( 'Theme Options', 'robbery' ),
		__( 'Theme Options', 'robbery' ),
		'edit_theme_options',
		'robbery_settings',
		'robbery_settings_page_render'
	);
}
add_action( 'admin_menu', 'robbery_admin_menu' );

/**
 * Admin initialize
 */
function robbery_admin_init() {
	register_setting( 'robbery_general_options', 'robbery_footer_text' );

	register_setting( 'robbery_footer_options', 'robbery_feedback_page_id' );
}
add_action( 'admin_init', 'robbery_admin_init' );

/**
 * Render
 */
function robbery_settings_page_render() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>

		<h2>
			<?php _e( 'Theme Options', 'robbery' ); ?>
		</h2>

		<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_options'; ?>  
		  
		<h2 class="nav-tab-wrapper">  
		    <a href="?page=robbery_settings&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'General', 'robbery' ); ?></a>  
		    <a href="?page=robbery_settings&tab=footer_options" class="nav-tab <?php echo $active_tab == 'footer_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Pages', 'robbery' ); ?></a>  
		</h2> 

		<form method="post" action="options.php">
			<?php if ( $active_tab == 'general_options' ) : ?>
			
				<?php settings_fields( 'robbery_general_options' ); ?>
			
				<h3>
					<?php _e( 'General', 'robbery' ); ?>
				</h3>
	
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="robbery_footer_text"><?php _e( 'Footer text', 'robbery' ); ?></label>
						</th>
						<td>
							<input id="robbery_footer_text" name="robbery_footer_text" type="text" value="<?php echo get_option( 'robbery_footer_text' ); ?>" class="regular-text" />
							<p class="description"><?php _e( 'Choose your own footer text.', 'robbery' ); ?></p>  
						</td>
					</tr>
				</table>
			
			<?php else : ?>
				
				<?php settings_fields( 'robbery_footer_options' ); ?>
				
				<h3>
					<?php _e( 'General', 'robbery' ); ?>
				</h3>
	
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="robbery_feedback_page_id"><?php _e( 'Feedback Page', 'robbery' ); ?></label>
						</th>
						<td>
							<?php

							wp_dropdown_pages( array( 
								'name'             => 'robbery_feedback_page_id', 
								'selected'         => get_option( 'robbery_feedback_page_id' ),  
								'show_option_none' => __( '&mdash; Select a page &mdash;', 'robbery' ) 
							) ); 

							?>
						</td>
					</tr>
				</table>

			<?php endif; ?>

			<?php submit_button(); ?>
		</form>
	</div>

	<?php
}
