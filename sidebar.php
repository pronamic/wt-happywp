<div class="col-sm-4">
	<aside>
		<?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) : ?>
		
			<?php dynamic_sidebar( 'shop-sidebar' ); ?>
		
		<?php else : ?>
	
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		
		<?php endif; ?>
	</aside>
</div>