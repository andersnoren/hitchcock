<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
		 
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>

		<a class="skip-link button" href="#site-content"><?php _e( 'Skip to the content', 'hitchcock' ); ?></a>
		
		<div class="navigation">
			
			<div class="section-inner">
				
				<ul class="main-menu">
																		
					<?php 
					if ( has_nav_menu( 'primary' ) ) {

						$nav_args = array( 
							'container' 		=> '',
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary',
						);
																		
						wp_nav_menu( $nav_args );

					} else {

						$list_pages_args = array(
							'container' => '',
							'title_li' 	=> ''
						);

						wp_list_pages( $list_pages_args );

					} 
					?>
					
					<li class="header-search">
						<?php get_search_form(); ?>
					</li>
					
				</ul>
				
				<div class="clear"></div>
				
			</div><!-- .section-inner -->
			
			<button type="button" class="nav-toggle">
					
				<div class="bars">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
				
			</button><!-- .nav-toggle -->
			
			<div class="mobile-navigation">
			
				<ul class="mobile-menu">
																			
					<?php 
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( $nav_args );
					} else {
						wp_list_pages( $list_pages_args );
					}
					?>
					
				</ul>
				
				<?php get_search_form(); ?>
			
			</div><!-- .mobile-navigation -->
			
		</div><!-- .navigation -->

		<?php $image_image_url = get_header_image() ? get_header_image() : get_template_directory_uri() . '/images/bg.jpg'; ?>
		
		<div class="header-image" style="background-image: url( <?php echo $image_image_url; ?> );"></div>
	
		<div class="header section-inner">
		
			<?php 
			
			if ( get_theme_mod( 'custom_logo' ) ) :

				hitchcock_custom_logo();
				
			else : 
				
				$title_type = is_singular() ? '2' : '1'; ?>
		
				<h<?php echo $title_type; ?> class="blog-title">
					<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
				</h<?php echo $title_type; ?>>
				
			<?php endif;
			
			if ( get_bloginfo( 'description' ) ) : ?>
			
				<p class="blog-description"><?php echo bloginfo( 'description' ); ?></p>
			
			<?php endif;
			
			if ( has_nav_menu( 'social' ) ) : ?>
			
				<ul class="social-menu">
							
					<?php 
					wp_nav_menu( array(
						'theme_location'	=>	'social',
						'container'			=>	'',
						'container_class'	=>	'menu-social',
						'items_wrap'		=>	'%3$s',
						'menu_id'			=>	'menu-social-items',
						'menu_class'		=>	'menu-items',
						'depth'				=>	1,
						'link_before'		=>	'<span class="screen-reader-text">',
						'link_after'		=>	'</span>',
						'fallback_cb'		=>	'',
					) );
					?>
					
				</ul><!-- .social-menu -->
			
			<?php endif; ?>
			
		</div><!-- .header -->

		<main id="site-content">