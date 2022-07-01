<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_setup' ) ) :
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
			'default-image' => get_template_directory_uri() . '/assets/images/bg.jpg',
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
		
	}
	add_action( 'after_setup_theme', 'hitchcock_setup' );
endif;


/*	-----------------------------------------------------------------------------------------------
	REQUIRED FILES
	Include required files
--------------------------------------------------------------------------------------------------- */

// Handle Customizer settings
require get_template_directory() . '/inc/classes/class-hitchcock-customize.php';


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_load_javascript_files' ) ) :
	function hitchcock_load_javascript_files() {

		$theme_version = wp_get_theme( 'hitchcock' )->get( 'Version' );

		wp_register_script( 'hitchcock_flexslider', get_template_directory_uri() . '/assets/js/flexslider.js', array(), $theme_version );
		wp_register_script( 'hitchcock_doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js', array(), $theme_version );

		wp_enqueue_script( 'hitchcock_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'hitchcock_flexslider', 'hitchcock_doubletaptogo' ), $theme_version );
		
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'hitchcock_load_javascript_files' );
endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_load_style' ) ) :
	function hitchcock_load_style() {

		if ( is_admin() ) return;

		$dependencies = array();
		$theme_version = wp_get_theme( 'hitchcock' )->get( 'Version' );

		wp_register_style( 'hitchcock_google_fonts', get_theme_file_uri( '/assets/css/fonts.css' ) );
		$dependencies[] = 'hitchcock_google_fonts';

		wp_register_style( 'hitchcock_fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css', array(), $theme_version );
		$dependencies[] = 'hitchcock_fontawesome';
		
		wp_enqueue_style( 'hitchcock_style', get_stylesheet_uri(), $dependencies, $theme_version );

		// Add custom colors as inline style
		$inline_style = Hitchcock_Customize::get_inline_style();
		if ( $inline_style ) {
			wp_add_inline_style( 'hitchcock_style', $inline_style );
		}

	}
	add_action( 'wp_print_styles', 'hitchcock_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_add_editor_styles' ) ) :
	function hitchcock_add_editor_styles() {

		add_editor_style( array( 'assets/css/hitchcock-classic-editor-styles.css', 'assets/css/fonts.css' ) );
		
	}
	add_action( 'init', 'hitchcock_add_editor_styles' );
endif;


/* ---------------------------------------------------------------------------------------------
   CHECK JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_html_js_class' ) ) :
	function hitchcock_html_js_class() {

		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";

	}
	add_action( 'wp_head', 'hitchcock_html_js_class', 1 );
endif;


/* ---------------------------------------------------------------------------------------------
   CUSTOM LOGO OUTPUT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_custom_logo' ) ) :
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
			
			<a href="<?php echo esc_url( home_url() ); ?>" class="custom-logo-link">
				<img src="<?php echo esc_url( $logo_url ); ?>" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" />
				<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
			</a>

			<?php
		}

	}
endif;


/* ---------------------------------------------------------------------------------------------
   REMOVE ARCHIVE PREFIXES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_remove_archive_title_prefix' ) ) :
	function hitchcock_remove_archive_title_prefix( $title ) {

		global $paged;
		global $wp_query;

		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = get_the_date( 'Y' );
		} elseif ( is_month() ) {
			$title = get_the_date( 'F Y' );
		} elseif ( is_day() ) {
			$title = get_the_date( get_option( 'date_format' ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'hitchcock' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'hitchcock' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_search() ) {
			$title = '&ldquo;' . get_search_query() . '&rdquo;';
		} else if ( is_home() && $paged == 1 ) {
			return '';
		} else {
			$title = sprintf( __( 'Page %1$s of %2$s', 'hitchcock' ), $paged, $wp_query->max_num_pages );
		} // End if().
		return $title;
		
	}
	add_filter( 'get_the_archive_title', 'hitchcock_remove_archive_title_prefix' );
endif;


/* ---------------------------------------------------------------------------------------------
   GET ARCHIVE PREFIX
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_get_archive_title_prefix' ) ) :
	function hitchcock_get_archive_title_prefix() {

		global $paged;

		if ( is_category() ) {
			$title_prefix = __( 'Category', 'hitchcock' );
		} elseif ( is_tag() ) {
			$title_prefix = __( 'Tag', 'hitchcock' );
		} elseif ( is_author() ) {
			$title_prefix = __( 'Author', 'hitchcock' );
		} elseif ( is_year() ) {
			$title_prefix = __( 'Year', 'hitchcock' );
		} elseif ( is_month() ) {
			$title_prefix = __( 'Month', 'hitchcock' );
		} elseif ( is_day() ) {
			$title_prefix = __( 'Day', 'hitchcock' );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			$title_prefix = $tax->labels->singular_name;
		} elseif ( is_search() ) {
			$title_prefix = __( 'Search Results', 'hitchcock' );
		} else if ( is_home() && $paged == 1 ) {
			return '';
		} else {
			$title_prefix = __( 'Archives', 'hitchcock' );
		}
		return $title_prefix;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_body_classes' ) ) :
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
endif;


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_flexslider' ) ) :
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

		if ( $images ) : ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach ( $images as $image ) :
						$attimg = wp_get_attachment_image( $image->ID, $size ); ?>
						<li><?php echo $attimg; ?></li>
					<?php endforeach; ?>
			
				</ul><!-- .slides -->
				
			</div><!-- .flexslider -->
			
			<?php
			
		endif;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   REGISTER SIDEBAR
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_sidebar_registration' ) ) :
	function hitchcock_sidebar_registration() {

		// Arguments used in all register_sidebar() calls
		$shared_args = array(
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
		);

		// Footer #1
		register_sidebar( array_merge( $shared_args, array(
			'name' 			=> __( 'Footer #1', 'hitchcock' ),
			'id' 			=> 'footer-one',
			'description' 	=> __( 'Widgets in this area will be displayed in the first column in the footer.', 'hitchcock' ),
		) ) );

		// Footer #2
		register_sidebar( array_merge( $shared_args, array(
			'name' 			=> __( 'Footer #2', 'hitchcock' ),
			'id' 			=> 'footer-two',
			'description' 	=> __( 'Widgets in this area will be displayed in the second column in the footer.', 'hitchcock' ),
		) ) );

	}
	add_action( 'widgets_init', 'hitchcock_sidebar_registration' );
endif;


/* ---------------------------------------------------------------------------------------------
   RELATED POSTS FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_related_posts' ) ) :
	function hitchcock_related_posts( $number_of_posts = 3 ) { 
		
		?>
		
		<div class="related-posts posts section-inner group">
					
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

			foreach ( $categories as $category ) {
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
				
				foreach ( $related_posts as $post ) :
			
					setup_postdata( $post );

					get_template_part( 'content', get_post_format() );

				endforeach;

				wp_reset_postdata();
			
			endif;
			
			?>

		</div><!-- .related-posts --> 

		<?php
		
	}
endif;


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_comment' ) ) :
	function hitchcock_comment( $comment, $args, $depth ) {

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
					<span><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
					<?php
					if ( $post == get_post( $post->ID ) ) {
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
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'hitchcock_add_block_editor_features' ) ) :
	function hitchcock_add_block_editor_features() {

		/* Gutenberg Features --------------------------------------- */

		add_theme_support( 'align-wide' );

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color' ) ? get_theme_mod( 'accent_color' ) : '#3bc492';

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'hitchcock' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'hitchcock' ),
				'slug' 	=> 'black',
				'color' => '#1d1d1d',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'hitchcock' ),
				'slug' 	=> 'dark-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Gutenberg palette', 'hitchcock' ),
				'slug' 	=> 'light-gray',
				'color' => '#757575',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'hitchcock' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Gutenberg Font Sizes --------------------------------------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'hitchcock' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'hitchcock' ),
				'size' 		=> 14,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the regular font size in Gutenberg', 'hitchcock' ),
				'shortName' => _x( 'N', 'Short name of the regular font size in the Gutenberg editor.', 'hitchcock' ),
				'size' 		=> 16,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'hitchcock' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'hitchcock' ),
				'size' 		=> 21,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'hitchcock' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'hitchcock' ),
				'size' 		=> 26,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'hitchcock_add_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'hitchcock_block_editor_styles' ) ) :
	function hitchcock_block_editor_styles() {

		$theme_version = wp_get_theme( 'hitchcock' )->get( 'Version' );

		wp_register_style( 'hitchcock-block-editor-styles-font', get_theme_file_uri( '/assets/css/fonts.css' ) );
		wp_enqueue_style( 'hitchcock-block-editor-styles', get_theme_file_uri( '/assets/css/hitchcock-block-editor-styles.css' ), array( 'hitchcock-block-editor-styles-font' ), $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'hitchcock_block_editor_styles', 1 );
endif;
