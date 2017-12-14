<?php get_header(); ?>

<div class="content section-inner">

	<div class="post single">
		
		<div class="post-container">
			
			<div class="post-header">
			
				<h2 class="post-title"><?php _e( 'Error 404', 'hitchcock' ); ?></h2>
														
			</div><!-- .post-header -->
	
			<div class="post-inner">
			                                                	            
		        <div class="post-content">
		        	            
		            <p><?php _e( "It seems like you have tried to open a page that doesn't exist. It could have been deleted, moved, or it never existed at all. You are welcome to search for what you are looking for with the form below.", 'hitchcock' ); ?></p>
		            
		            <?php get_search_form(); ?>
		            
		        </div><!-- .post-content -->
		        
			</div><!-- .post-inner -->
        
		</div><!-- .post-container -->
        	            	                        	
	</div><!-- .post -->
	
</div><!-- .content -->

<?php get_footer(); ?>
