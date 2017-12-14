/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update site accent color in real time...
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( newval ) {
			$('.blog-title a:hover').css('color', newval );
			$('.social-menu a:hover').css('background-color', newval );
			$('.archive-nav a:hover').css('color', newval );
		} );
	} );

	// Show preview titles
	wp.customize( 'hitchcock_show_titles', function( value ) {
		value.bind( function( newval ) {
			if ( newval == true ) {
				$( 'body' ).addClass( 'show-preview-titles' );
			} else {
				$( 'body' ).removeClass( 'show-preview-titles' );
			}
		} );
	} );
	
} )( jQuery );