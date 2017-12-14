<?php get_header(); ?>

<div class="content section-inner">
																	                    
	<?php if ( have_posts() ) : ?>
	
		<?php
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$total_post_count = wp_count_posts();
		$published_post_count = $total_post_count->publish;
		$total_pages = ceil( $published_post_count / $posts_per_page );
		
		if ( 1 < $paged ) : ?>
		
			<div class="page-title">
			
				<h4><?php printf( __( 'Page %s of %s', 'hitchcock' ), $paged, $wp_query->max_num_pages ); ?></h4>
				
			</div><!-- .page-title -->
			
			<div class="clear"></div>
		
		<?php endif; ?>
	
		<div class="posts" id="posts">
				
			<?php 
			while ( have_posts() ) : the_post();
	    	
	    		get_template_part( 'content', get_post_format() );
	    		
			endwhile; 
			?>
	        
	        <div class="clear"></div>
				
		</div><!-- .posts -->
		
	<?php endif; ?>
	
	<div class="clear"></div>
	
	<?php hitchcock_archive_navigation(); ?>
		
</div><!-- .content -->
	              	        
<?php get_footer(); ?>