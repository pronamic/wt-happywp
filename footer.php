			<?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) : ?></div><?php endif; ?>
		</div>
	
		<?php if ( get_option( 'robbery_feedback_page_id' ) ) : ?>

			<div class="spotlight">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<p class="h1">
								<?php _e( 'We like to hear from you', 'robbery' ); ?>
							</p>
						</div>

						<div class="col-sm-6">
							<a class="btn btn-default btn-lg pull-right" href="<?php echo get_permalink( get_option( 'robbery_feedback_page_id' ) ); ?>">
								<?php _e( 'Give feedback', 'robbery' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		
		<?php endif; ?>
		
		<footer id="footer">
			<div class="container">
				<nav id="footer-nav">
					<?php 
					
					wp_nav_menu( array( 
						'theme_location' => 'footer',
						'fallback_cb'    => ''
					) ); 
					
					?>
				</nav>

				<p>
					<?php

					if ( get_option( 'robbery_footer_text' ) ) {
						echo get_option( 'robbery_footer_text' );
					} else {
						printf( __( '&copy; %1$s %2$s. All rights reserved.', 'robbery' ),
							date( 'Y' ),
							get_bloginfo( 'site-title' )
						);
					}
			
					?>
				</p>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>