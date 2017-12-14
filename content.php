<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>

<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?> style="background-image: url(<?php echo $thumb['0']; ?>);">

	<div class="post-overlay">
		
		<?php if ( is_sticky() && !is_single() ) : ?>
		
			<p><span class="fa fw fa-star"></span><?php _e( 'Sticky', 'hitchcock' ); ?></p>
		
		<?php endif; ?>
		
		<div class="archive-post-header">
		
		    <p class="archive-post-date"><?php the_time( get_option( 'date_format' ) ); ?></p>
							
		    <?php if ( get_the_title() ) : ?>
		    	<h2 class="archive-post-title"><?php the_title(); ?></h2>
		    <?php endif; ?>
	    
		</div>

	</div>
	
</a><!-- .post -->