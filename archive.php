<?php get_header(); ?>

<div class="content section-inner">

	<div class="page-title">
			
		<?php if ( is_day() ) : ?>
			<p><?php _e( 'Date', 'hitchcock' ) ?></p>
			<h4><?php echo get_the_date( get_option( 'date_format' ) ); ?></h4>

		<?php elseif ( is_month() ) : ?>
			<p><?php _e( 'Month', 'hitchcock' ) ?></p>
			<h4><?php echo get_the_date( 'F Y' ); ?></h4>

		<?php elseif ( is_year() ) : ?>
			<p><?php _e( 'Year', 'hitchcock' ) ?></p>
			<h4><?php echo get_the_date( 'Y' ); ?></h4>

		<?php elseif ( is_category() ) : ?>
			<p><?php _e( 'Category', 'hitchcock' ) ?></p>
			<h4><?php echo single_cat_title( '', false ); ?></h4>

		<?php elseif ( is_tag() ) : ?>
			<p><?php _e( 'Tag', 'hitchcock' ) ?></p>
			<h4><?php echo single_tag_title( '', false ); ?></h4>

		<?php elseif ( is_author() ) : ?>
			<p><?php _e( 'Author', 'hitchcock' ) ?></p>
			<?php $curauth = ( isset($_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name) : get_userdata( intval( $author ) ); ?>
			<h4><?php echo $curauth->display_name; ?></h4>

		<?php else : ?>
			<h4><?php _e( 'Archive', 'hitchcock' ); ?></h4>

		<?php endif; ?></h4>
								
	</div><!-- .page-title -->
	
	<?php if ( have_posts() ) : ?>
			
		<div class="posts" id="posts">
			
			<?php 
			while ( have_posts() ) : the_post();
			
				get_template_part( 'content', get_post_format() );
				
			endwhile; 
			?>
            
            <div class="clear"></div>
							
		</div><!-- .posts -->
		
		<div class="clear"></div>
		
		<?php hitchcock_archive_navigation(); ?>
				
	<?php endif; ?>

</div><!-- .content -->

<?php get_footer(); ?>