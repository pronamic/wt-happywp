<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text">
		<?php _e( 'Search', 'robbery' ); ?>
	</label>

	<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search&hellip;', 'robbery' ); ?>" />
	<input type="submit" class="btn btn-default" name="submit" value="<?php esc_attr_e( 'Search', 'robbery' ); ?>" />
</form>