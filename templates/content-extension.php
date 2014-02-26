<?php 

global $post;

$extension = new Pronamic_WP_ExtensionsPlugin_ExtensionInfo( $post );

?>

<div class="row">
	<div class="col-sm-9">
		<article class="section" itemscope="" itemtype="http://schema.org/SoftwareApplication">
			<div class="plugin-intro">
				<div class="plugin-header">
					<p class="h1" itemprop="name">
						<?php the_title(); ?>
					</p>

					<?php if ( has_post_thumbnail() ) : ?>
		
						<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
		
					<?php else : ?>
					
						<img src="<?php echo get_template_directory_uri(); ?>/placeholders/plugin-header.png" class="img-responsive" />
					
					<?php endif; ?>
				</div>
				
				<div class="content">
					<p itemprop="description">
						<?php echo $post->post_excerpt; ?>
					</p>
				</div>

				<ul class="plugin-nav nav nav-tabs">
					<li class="active" >
						<a href="#description" data-toggle="tab"><?php _e( 'Description', 'robbery' ); ?></a>
					</li>
					<li>
						<a href="#developers" data-toggle="tab"><?php _e( 'Developers', 'robbery' ); ?></a>
					</li>
				</ul>
			</div>

			<div class="tab-content">
				<div class="tab-pane active" id="description">
					<?php the_content(); ?>
				</div>

				<div class="tab-pane" id="developers">
					<?php get_template_part( 'templates/extension-developers' ); ?>
				</div>
			</div>
		</article>
	</div>

	<div class="col-sm-3">
		<aside>
			<?php 
		
			$version = $extension->get_version();
			$url     = $extension->get_download_link();

			$price         = get_post_meta( $post->ID, '_pronamic_extension_price', true );
			$downloads     = get_post_meta( $post->ID, '_pronamic_extension_total_downloads', true );
			$date_modified = get_post_meta( $post->ID, '_pronamic_extension_date_modified', true );

			?>

			<div class="panel">
				<?php if ( empty( $price ) ) : ?>

					<h3>
						<?php _e( 'Download', 'robbery' ); ?>
					</h3>

					<a href="<?php echo esc_attr( $url ); ?>" class="btn btn-primary"><?php _e( 'Download', 'robbery' ); ?> <span itemprop="softwareVersion"><?php echo $version; ?></span></a>

				<?php else : ?>

					<?php

					$url = get_post_meta( $post->ID, '_pronamic_extension_buy_url', true );

					?>

					<h3>
						<?php _e( 'Buy Now', 'robbery' ); ?>
					</h3>

					<a href="<?php echo esc_attr( $url ); ?>" class="btn btn-success btn-lg"><?php _e( 'Buy', 'robbery' ); ?></a>

				<?php endif; ?>
			</div>

			<div class="panel">
				<h3>
					<?php _e( 'Information', 'robbery' ); ?>
				</h3>

				<dl>

					<?php if ( ! empty( $price ) ) : ?>

						<dt><?php _e( 'Price', 'robbery' ); ?></dt>
						<dd><?php echo pronamic_wp_extension_format_price( $price ); ?></dd>

					<?php endif; ?>

					<dt><?php _e( 'Stable version', 'robbery' ); ?></dt>
					<dd><span itemprop="softwareVersion"><?php echo $version; ?></span></dd>

					<?php if ( ! empty( $downloads ) ) : ?>

						<dt><?php _e( 'Downloads', 'robbery' ); ?></dt>
						<dd><?php echo number_format( $downloads, 0, ',', '.' ); ?></dd>

					<?php endif; ?>

					<dt><?php _e( 'Last Updated', 'robbery' ); ?></dt>
					<dd><?php the_modified_date(); ?></dd>
				</dl> 

				<hr />

				<div class="info">
					<h4><?php _e( 'Author', 'robbery' ); ?></h4>

					<p>
						<a href="http://www.pronamic.nl/"><?php _e( 'Pronamic', 'robbery' ); ?></a>
					</p>
				</div>

				<hr />

				<div class="info">
					<h4><?php _e( 'Rating', 'robbery' ); ?></h4>

					<p class="alt">
						<?php _e( 'No rating available.', 'robbery' ); ?>
					</p>
				</div>
			</div>

			<div class="panel">
				<h3>
					<?php _e( 'Contribute', 'robbery' ); ?>
				</h3>

				<?php get_template_part( 'templates/sidebar-extension' ); ?>
			</div>
		</aside>
	</div>
</div>