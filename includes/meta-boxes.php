<?php

/**
 * Add meta boxes
 */
function robbery_add_meta_boxes() {
    add_meta_box(  
        'robbery_video',
        __( 'Video', 'robbery' ),
        'robbery_video_box',
        'video',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'robbery_add_meta_boxes' );

/**
 * Print video metabox
 */
function robbery_video_box( $post ) {
	wp_nonce_field( 'robbery_save_video_box_nonce', 'robbery_video_box_nonce' );

	?>

	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="video_title">
						<?php _e( 'Title', 'robbery' ); ?>
					</label>
				</th>
				<td>
					<input id="video_title" name="_video_title" value="<?php echo esc_attr( get_post_meta( $post->ID, '_video_title', true ) ); ?>" type="text" size="20" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="video_url">
						<?php _e( 'URL', 'robbery' ); ?>
					</label>
				</th>
				<td>
					<input id="video_url" name="_video_url" value="<?php echo esc_attr( get_post_meta( $post->ID, '_video_url', true ) ); ?>" type="text" size="20" class="regular-text" />
				</td>
			</tr>
		</tbody>
	</table>

	<?php
}

/**
 * Save video metabox
 */
function robbery_save_video( $post_id ) {
	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) 
    	return;

	if ( ! isset( $_POST['robbery_video_box_nonce'] ) || ! wp_verify_nonce( $_POST['robbery_video_box_nonce'], 'robbery_save_video_box_nonce' ) ) 
		return;

	if ( ! current_user_can( 'edit_post' ) ) 
		return;

	// Save data
	$data = filter_input_array( INPUT_POST, array( 
		'_video_url'   => FILTER_SANITIZE_STRING,
		'_video_title' => FILTER_SANITIZE_STRING
	) );

	foreach ( $data as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}
}
add_action( 'save_post', 'robbery_save_video' );

/**
 * Add columns
 */
function robbery_add_columns( $columns ) {
	$columns['video_url'] = __( 'Video URL', 'kwieq' );
	$columns['video_title'] = __( 'Video Title', 'kwieq' );

	return $columns;
}
add_filter( 'manage_video_posts_columns' , 'robbery_add_columns' );

function robbery_custom_columns( $column, $post_id ) {
    switch ( $column ) {
		case 'video_url' :
			echo get_post_meta( $post_id, '_video_url', true ); 
			break;

		case 'video_title' :
			echo get_post_meta( $post_id, '_video_title', true ); 
			break;
    }
}
add_action( 'manage_video_posts_custom_column' , 'robbery_custom_columns', 10, 2 );
