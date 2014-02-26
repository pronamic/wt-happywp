<article id="post-<?php the_ID(); ?>" <?php post_class( 'section' ); ?>>
	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'robbery' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<p>
					<?php robbery_posted_on(); ?>
				</p>
			</div>

		<?php endif; ?>
	</header>

	<?php if ( is_search() ) : ?>

		<div class="entry-summary clearfix">
			<?php if ( has_post_thumbnail() ) : ?>

				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'featured' ) ); ?>

			<?php endif; ?>

			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<div class="entry-content clearfix">
			<?php if ( has_post_thumbnail() ) : ?>

				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'featured' ) ); ?>

			<?php endif; ?>

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'robbery' ) ); ?>
		</div>

	<?php endif; ?>

	<footer class="entry-meta">
		<p>
			<?php $show_sep = false; ?>
		
			<?php if ( 'post' == get_post_type() ) : ?>
	
				<?php
		
				$categories_list = get_the_category_list( ', ' );
			
				if ( $categories_list ) : ?>
		
					<span class="cat-links">
						<?php 
						
						printf( __( '<span class="%1$s">Posted in</span> %2$s', 'robbery' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
			
						$show_sep = true; 
						
						?>
					</span>
		
				<?php endif; ?>
		
				<?php
		
				$tags_list = get_the_tag_list( '', ', ' );
		
				if ( $tags_list ) : ?>
				
					<?php if ( $show_sep ) : ?>
			
						<span class="sep"> | </span>
			
					<?php endif; ?>
		
					<span class="tag-links">
						<?php 
						
						printf( __( '<span class="%1$s">Tagged</span> %2$s', 'robbery' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
			
						$show_sep = true; 
						
						?>
					</span>
		
				<?php endif; ?>
			
			<?php endif; ?>
	
			<?php if ( comments_open() ) : ?>
			
				<?php if ( $show_sep ) : ?>
	
					<span class="sep"> | </span>
		
				<?php endif; ?>
	
				<span class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'robbery' ) . '</span>', __( '1 Reply', 'robbery' ), __( '% Replies', 'robbery' ) ); ?>
				</span>
			
			<?php endif; ?>
		</p>
	</footer>
</article>