<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_setup' ) ) {

	function hitchcock_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 600;
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'post-image', 1240, 9999 );
		add_image_size( 'post-thumb', 508, 9999 );
		
		// Title tag
		add_theme_support( 'title-tag' );

		// Custom logo
		add_theme_support( 'custom-logo' );
		
		// Custom header
		$args = array(
			'width'         => 1440,
			'height'        => 900,
			'default-image' => get_template_directory_uri() . '/images/bg.jpg',
			'uploads'       => true,
			'header-text'  	=> false
			
		);
		add_theme_support( 'custom-header', $args );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'gallery' ) );
			
		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'type' 		=> 'click',
			'container'	=> 'posts',
			'wrapper'	=> false,
			'footer' 	=> false,
		) );
		
		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'hitchcock' ) );
		register_nav_menu( 'social', __( 'Social Menu', 'hitchcock' ) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'hitchcock', get_template_directory() . '/languages' );
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable($locale_file) ) {
			require_once($locale_file);
		}
		
	}
	add_action( 'after_setup_theme', 'hitchcock_setup' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_load_javascript_files' ) ) {

	function hitchcock_load_javascript_files() {

		if ( ! is_admin() ) {		
			wp_register_script( 'hitchcock_flexslider', get_template_directory_uri() . '/js/flexslider.js', '', true );
			wp_register_script( 'hitchcock_doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.js', '', true );

			wp_enqueue_script( 'hitchcock_global', get_template_directory_uri() . '/js/global.js', array( 'jquery', 'hitchcock_flexslider', 'hitchcock_doubletaptogo' ), '', true );
			
			if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
			
		}
	}
	add_action( 'wp_enqueue_scripts', 'hitchcock_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_load_style' ) ) {

	function hitchcock_load_style() {
		if ( ! is_admin() ) {
			wp_register_style( 'hitchcock_google_fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Droid+Serif:400,400italic,700,700italic' );
			wp_register_style( 'hitchcock_fontawesome', get_stylesheet_directory_uri() . '/fa/css/font-awesome.css' );
			
			wp_enqueue_style( 'hitchcock_style', get_stylesheet_uri(), array( 'hitchcock_google_fonts', 'hitchcock_fontawesome' ) );
		}
	}
	add_action( 'wp_print_styles', 'hitchcock_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_add_editor_styles' ) ) {

	function hitchcock_add_editor_styles() {
		add_editor_style( 'hitchcock-editor-styles.css' );
		$font_url = '//fonts.googleapis.com/css?family=Montserrat:400,700|Droid+Serif:400,400italic,700,700italic';
		add_editor_style( str_replace( ', ', '%2C', $font_url ) );
	}
	add_action( 'init', 'hitchcock_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   CHECK JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_html_js_class' ) ) {

	function hitchcock_html_js_class() {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'hitchcock_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ARCHIVE NAVIGATION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_archive_navigation' ) ) {

	function hitchcock_archive_navigation() {
		
		global $wp_query;
		
		if ( $wp_query->max_num_pages > 1 ) : ?>
					
			<div class="archive-nav">
				
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
				
				<div class="clear"></div>
					
			</div><!-- .archive-nav-->
							
		<?php endif;
	}

}


/* ---------------------------------------------------------------------------------------------
   CUSTOM LOGO OUTPUT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_custom_logo' ) ) {

	function hitchcock_custom_logo() {

		// Get the logo
		$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		
		if ( $logo ) {

			// For clarity
			$logo_url = esc_url( $logo[0] );
			$logo_width = esc_attr( $logo[1] );
			$logo_height = esc_attr( $logo[2] );

			// If the retina logo setting is active, reduce the width/height by half
			if ( get_theme_mod( 'hitchcock_retina_logo' ) ) {
				$logo_width = floor( $logo_width / 2 );
				$logo_height = floor( $logo_height / 2 );
			}

			?>
			
			<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom-logo-link">
				<img src="<?php echo esc_url( $logo_url ); ?>" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" />
			</a>

			<?php
		}

	}

}


/* ---------------------------------------------------------------------------------------------
   ADMIN CSS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_admin_css' ) ) {

	function hitchcock_admin_css() { ?>
		<style type="text/css">
			#postimagediv #set-post-thumbnail img {
				max-width: 100%;
				height: auto;
			}
		</style>
		<?php
	}
	add_action( 'admin_head', 'hitchcock_admin_css' );

}


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

 
if ( ! function_exists( 'hitchcock_body_classes' ) ) {

	function hitchcock_body_classes( $classes ) {
	
		// Check if we're on singular
		if ( is_singular() || is_404() || ( is_search() && ! have_posts() ) ) {
			$classes[] = 'post single';
		}

		// Check if we're in the WP customizer preview
		if ( is_customize_preview() ) {
			$classes[] = 'customizer-preview';
		}

		// Check whether we're always showing preview titles
		if ( get_theme_mod( 'hitchcock_show_titles' ) ) {
			$classes[] = 'show-preview-titles';
		}

		// Check if we're on mobile
		if ( wp_is_mobile() ) {
			$classes[] = 'wp-is-mobile';
		}
		
		return $classes;
	}
	add_filter( 'body_class', 'hitchcock_body_classes' );

}


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_flexslider' ) ) {

	function hitchcock_flexslider( $size ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$images = get_posts( array(
			'numberposts'    => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $attachment_parent,
			'post_type'      => 'attachment',
			'post_status'    => null,
			'post_mime_type' => 'image',
		) );

		if ( $images ) { ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach( $images as $image ) { 
					
						$attimg = wp_get_attachment_image( $image->ID, $size ); ?>
						
						<li>
							<?php echo $attimg; ?>
						</li>
						
					<?php } ?>
			
				</ul>
				
			</div><?php
			
		}
	}

}


/* ---------------------------------------------------------------------------------------------
   RELATED POSTS FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_related_posts' ) ) {

	function hitchcock_related_posts( $number_of_posts = 3 ) { ?>
		
		<div class="related-posts posts section-inner">
					
			<?php

			global $post;

			// Base args, used for both the term query and random query
			$base_args = array(
				'ignore_sticky_posts'	=>	true,
				'meta_key'				=>	'_thumbnail_id',
				'posts_per_page'		=>	$number_of_posts,
				'post_status'			=>	'publish',
				'post__not_in'			=>	array( $post->ID ),	
			);

			// Create a query for posts in the same category as the ones for the current post
			$cat_ids = array();

			$categories = get_the_category();

			foreach( $categories as $category ) {
				$cat_ids[] = $category->cat_ID;
			}

			$term_posts_args = array_merge( $base_args, array( 'category__in' => $cat_ids ) );
			
			$related_posts = get_posts( $term_posts_args );

			// No results for the categories? Get random posts instead
			if ( ! $related_posts ) :

				$random_posts_args = array_merge( $base_args, array( 'orderby' => 'rand' ) );

				$related_posts = get_posts( $random_posts_args );

			endif;

			// If either the category query or random query hit pay dirt, output the posts
			if ( $related_posts ) :
				
				foreach( $related_posts as $post ) :
			
					setup_postdata( $post );

					get_template_part( 'content', get_post_format() );

				endforeach;

				wp_reset_postdata();
			
			endif;
			
			?>
					
			<div class="clear"></div>

		</div><!-- .related-posts --> 

		<?php
		
	}

}


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'hitchcock_comment' ) ) {

	function hitchcock_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'hitchcock' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'hitchcock' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
				
				<h4 class="comment-title">
					<?php echo get_comment_author_link(); ?>
					<span><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
					<?php
					if ( $post = get_post($post->ID) ) {
						if ( $comment->user_id === $post->post_author )
						echo ' &mdash; ' . __( 'Post Author', 'hitchcock' );
					}
					?>
					</span>
				</h4>
										
				<div class="comment-content post-content">
				
					<?php comment_text(); ?>
					
				</div><!-- .comment-content -->
				
				<div class="comment-actions">
								
					<?php 

					comment_reply_link( array( 
						'reply_text' 	=> __( 'Reply', 'hitchcock' ),
						'depth'			=> $depth, 
						'max_depth' 	=> $args['max_depth'],
						'before'		=> '',
						'after'			=> ''
					) ); 

					edit_comment_link( __( 'Edit', 'hitchcock' ), '', '' );
					
					if ( 0 == $comment->comment_approved ) : ?>
					
						<p class="comment-awaiting-moderation fright"><?php _e( 'Your comment is awaiting moderation.', 'hitchcock' ); ?></p>
						
					<?php endif; ?>
									
				</div><!-- .comment-actions -->
											
			</div><!-- .comment-## -->
					
		<?php
			break;
		endswitch;
	}

}


/* ---------------------------------------------------------------------------------------------
   THEME OPTIONS
   --------------------------------------------------------------------------------------------- */


class hitchcock_customize {

	public static function hitchcock_register( $wp_customize ) {

		// Hitchcock theme options section
		$wp_customize->add_section( 'hitchcock_options', array(
			'title' 		=> __( 'Theme Options', 'hitchcock' ),
			'priority' 		=> 35,
			'capability' 	=> 'edit_theme_options',
			'description' 	=> __( 'Customize the theme settings for Hitchcock.', 'hitchcock' ),
		) );


		/* 2X Header Logo ----------------------------- */


		$wp_customize->add_setting( 'hitchcock_retina_logo', array(
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'hitchcock_sanitize_checkbox',
			'transport'			=> 'postMessage'
		) );

		$wp_customize->add_control( 'hitchcock_retina_logo', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'title_tagline',
			'priority'		=> 9,
			'label' 		=> __( 'Retina logo', 'hitchcock' ),
			'description' 	=> __( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'hitchcock' ),
		) );

		// Update logo retina setting with selective refresh
		$wp_customize->selective_refresh->add_partial( 'hitchcock_retina_logo', array(
			'selector' 			=> '.header .custom-logo-link',
			'settings' 			=> array( 'hitchcock_retina_logo' ),
			'render_callback' 	=> function(){
				hitchcock_custom_logo();
			},
		) );


		/* Always show titles setting ----------------------------- */


		$wp_customize->add_setting( 'hitchcock_show_titles', array(
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'hitchcock_sanitize_checkbox',
			'transport'			=> 'postMessage'
		) );

		$wp_customize->add_control( 'hitchcock_show_titles', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'hitchcock_options', 
			'label' 		=> __( 'Show Preview Titles', 'hitchcock' ),
			'description' 	=> __( 'Check to always show the titles in the post previews.', 'hitchcock' ),
		) );


		/* Custom accent color ----------------------------- */


		$wp_customize->add_setting( 'hitchcock_accent_color', array(
			'default' 			=> '#3bc492', 
			'type' 				=> 'theme_mod', 
			'transport' 		=> 'postMessage', 
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hitchcock_accent_color', array(
			'label' 	=> __( 'Accent Color', 'hitchcock' ), 
			'section' 	=> 'hitchcock_options',
			'settings' 	=> 'hitchcock_accent_color', 
		) ) );

		// Make built-in controls use live-JS preview
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';


		// SANITATION

		// Sanitize boolean for checkbox
		function hitchcock_sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

	}

	public static function hitchcock_header_output() {
		?>

		<!-- Customizer CSS --> 

		<style type="text/css">
		
			<?php self::hitchcock_generate_css( 'body a', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( 'body a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.blog-title a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.social-menu a:hover', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post:hover .archive-post-title', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content a', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content a:hover', 'border-bottom-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content p.pull', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content input[type="submit"]', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content input[type="button"]', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content input[type="reset"]', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content input:focus', 'border-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.post-content textarea:focus', 'border-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.button', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.page-links a:hover', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comments .pingbacks li a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comment-header h4 a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comment-form input:focus', 'border-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comment-form textarea:focus', 'border-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.form-submit #submit', 'background-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comment-title .url:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comment-actions a', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.comment-actions a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.archive-nav a:hover', 'color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '#infinite-handle:hover', 'background', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.credits p:first-child a:hover', 'color', 'hitchcock_accent_color' ); ?>

			<?php self::hitchcock_generate_css( '.nav-toggle.active .bar', 'background-color', 'hitchcock_accent_color' ); ?>
			<?php self::hitchcock_generate_css( '.mobile-menu a:hover', 'color', 'hitchcock_accent_color' ); ?>

		</style> 

		<!-- /Customizer CSS -->

		<?php
	}

	public static function hitchcock_live_preview() {
		wp_enqueue_script( 'hitchcock-themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array(  'jquery', 'customize-preview' ), '', true );
	}

	public static function hitchcock_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo = true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) { 

			$return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix );

			if ( $echo ) echo $return;

		}

		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'hitchcock_customize', 'hitchcock_register' ) );

// Output custom CSS to live site
add_action( 'wp_head', array( 'hitchcock_customize', 'hitchcock_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', array( 'hitchcock_customize', 'hitchcock_live_preview' ) );

?>