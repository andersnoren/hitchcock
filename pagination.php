<?php 

global $wp_query;
		
if ( $wp_query->max_num_pages > 1 ) : 

	?>
			
	<div class="archive-nav group">
		
		<?php 
		if ( get_previous_posts_link() ) {
			previous_posts_link( '<span class="fa fw fa-angle-left"></span>' );
		} else {
			echo '<span class="fa fw fa-angle-left"></span>';
		} 

		echo '<span class="sep">/</span>';

		if ( get_next_posts_link() ) {
			next_posts_link( '<span class="fa fw fa-angle-right"></span>' );
		} else {
			echo '<span class="fa fw fa-angle-right"></span>';
		} 
		?>
			
	</div><!-- .archive-nav-->
					
	<?php 
endif;