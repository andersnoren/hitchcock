<?php get_header(); ?>

<div class="content section-inner">		

	<?php 
	
	if ( have_posts() ) :
		
		while ( have_posts() ) : the_post(); ?>
	
			<div <?php post_class( 'post single' ); ?>>
				
				<div class="post-container">
			
					<?php if ( has_post_thumbnail() ) : ?>
				
						<div class="featured-media">
				
							<?php the_post_thumbnail( 'post-image' ); ?>
							
						</div><!-- .featured-media -->
							
					<?php endif; ?>
					
					<div class="post-header">
														
						<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
					
					</div>
					
					<div class="post-inner">
							
						<div class="post-content">
						
							<?php 
							
							the_content();
							
							wp_link_pages( 'before=<div class="clear"></div><p class="page-links">' . __( 'Pages:', 'hitchcock' ) . ' &after=</p>&seperator= <span class="sep">/</span> ' ); 
							
							?>
						
						</div><!-- .post-content -->
						
						<div class="clear"></div>
						
						<?php edit_post_link(__( 'Edit Page', 'hitchcock' ), '<div class="post-meta"><p class="post-edit">', '</p></div>' ); ?>
			
					</div><!-- .post-inner -->
					
					<?php comments_template( '', true ); ?>
				
				</div><!-- .post-container -->
			
			</div><!-- .post -->
			
			<?php

		endwhile;

	endif;
	
	?>

	<div class="clear"></div>
	
</div><!-- .content -->
								
<?php get_footer(); ?>