<?php

global $post;

$extension = new Pronamic_WP_ExtensionsPlugin_ExtensionInfo( $post );

$downloads_url = trailingslashit( $extension->get_downloads_url() );

$downloads = $extension->get_downloads();

if ( empty( $downloads ) ) : ?>

	<p>
		<?php _e( 'Found nothing', 'pwe' ); ?>
	</p>

<?php else : ?>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">
					<?php _e( 'File', 'pwe' ); ?>
				</th>
			</tr>
		</thead>
		
		<tbody>

			<?php foreach ( $downloads as $download ) : ?>
			
				<tr>
					<?php 
					
					$url = $downloads_url . $download;
					
					?>
					<td>
						<a href="<?php echo esc_attr( $url ); ?>">
							<?php echo $download; ?>
						</a>
					</td>
				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>

<?php endif; ?>