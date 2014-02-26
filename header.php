<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
     	<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11" />

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<link href="<?php echo get_template_directory_uri(); ?>/icons/icon.png" rel="shortcut icon" type="image/x-icon" />
		<link href="<?php echo get_template_directory_uri(); ?>/icons/apple-touch-icon.png" rel="apple-touch-icon" />

		<!--[if lt IE 9]>
			<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo get_template_directory_uri(); ?>/icons/favicon.ico" />
			<link rel="SHORTCUT ICON" href="<?php echo get_template_directory_uri(); ?>/icons/favicon.ico" />

			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<?php do_action( 'after_body' ); ?>

		<header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<?php 
				
				wp_nav_menu( array( 
					'theme_location' => 'primary',
					'depth'          => 3,
					'fallback_cb'    => ''
				) ); 
				
				?>
						
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only"><?php _e( 'Toggle navigation', 'robbery' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</div>

				<nav class="collapse navbar-collapse pwe-navbar-collapse" role="navigation">
					<?php

					wp_nav_menu( array(
						'theme_location' => 'header-navbar',
						'menu_class'     => 'nav navbar-nav primary-nav',
						'fallback_cb'    => ''
					) );

					?>

					<?php

					wp_nav_menu( array(
						'theme_location' => 'header-navbar-right',
						'menu_class'     => 'nav navbar-nav navbar-right',
						'fallback_cb'    => ''
					) );

					?>
				</nav>
			</div>
      	</header>

		<?php if ( is_front_page() ) : ?>

			<section class="page-slider">
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<?php while ( have_posts() ) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="entry-content">
										<?php the_content(); ?>
									</div>
								</article>

							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</section>

		<?php else : ?>

			<div class="page-header">
				<div class="container">
					<?php 
				
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<p class="breadcrumbs">', '</p>' );
					} 
				
					?>

					<h1>
						<?php robbery_title(); ?>
					</h1>
				</div>
			</div>
		
		<?php endif; ?>
		
		<div class="container main">
			<?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) : ?><div class="row"><?php endif; ?>