<?php get_header(); ?>

<div class="content section-inner">

	<?php
	
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$archive_subtitle = '';
	$archive_title = '';
	
	// Determine the archive titles
	if ( ( 1 < $paged ) || is_archive() || is_search() ) {

		if ( is_archive() ) {

			if ( is_day() ) {
				$archive_subtitle = __( 'Date', 'hitchcock' );
				$archive_title = get_the_date( get_option( 'date_format' ) );
			} elseif ( is_month() ) {
				$archive_subtitle = __( 'Month', 'hitchcock' );
				$archive_title = get_the_date( 'F Y' );
			} elseif ( is_year() ) {
				$archive_subtitle = __( 'Year', 'hitchcock' );
				$archive_title = get_the_date( 'Y' );
			} elseif ( is_category() ) {
				$archive_subtitle = __( 'Category', 'hitchcock' );
				$archive_title = single_cat_title( '', false );
			} elseif ( is_tag() ) {
				$archive_subtitle = __( 'Tag', 'hitchcock' );
				$archive_title = single_tag_title( '', false );
			} elseif ( is_author() ) {
				$archive_subtitle = __( 'Author', 'hitchcock' );
				$curauth = ( isset($_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name) : get_userdata( intval( $author ) );
				$archive_title = $curauth->display_name;
			} else {
				$archive_title = __( 'Archive', 'hitchcock' );
			}

		} elseif ( is_search() ) {

			$archive_subtitle = __( 'Search Results', 'hitchcock' );
			$archive_title = ' "' . get_search_query() . '"';

		} else {

			$archive_title = sprintf( __( 'Page %1$s of %2$s', 'hitchcock' ), $paged, $wp_query->max_num_pages );

		}

	}
	
	if ( $archive_subtitle || $archive_title ) : ?>
	
		<div class="page-title">

			<?php if ( $archive_subtitle ) : ?>
				<p><?php echo $archive_subtitle; ?></p>
			<?php endif; ?>

			<?php if ( $archive_title ) : ?>
				<h4><?php echo $archive_title; ?></h4>
			<?php endif; ?>
			
		</div><!-- .page-title -->
	
	<?php endif; ?>
		
	<?php if ( have_posts() ) : ?>

		<div class="posts" id="posts">

			<?php
			while ( have_posts() ) : the_post();
			
				get_template_part( 'content', get_post_format() );
				
			endwhile;
			?>

			<div class="clear"></div>
			
		</div><!-- .posts -->

	<?php elseif ( is_search() ) : ?>

		<div class="post single">
		
			<div class="post-container">
		
				<div class="post-inner">
			
					<div class="post-content">
					
						<p><?php _e( 'No results. Try again, would you kindly?', 'hitchcock' ); ?></p>
						
						<?php get_search_form(); ?>
					
					</div><!-- .post-content -->
				
				</div><!-- .post-inner -->
			
			</div><!-- .post-container -->
		
		</div><!-- .post -->

	<?php endif; ?>
	
	<?php hitchcock_archive_navigation(); ?>
		
</div><!-- .content -->
	              	        
<?php get_footer(); ?>