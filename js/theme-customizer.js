/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	accentColor = '';

	// Update site accent color in real time...
	wp.customize( 'hitchcock_accent_color', function( value ) {
		value.bind( function( newval ) {
			accentColor = newval;
		} );
	} );


	// Update hover effects
	$( '.blog-title a' ).mouseenter( function() {
		initialColor = $( this ).css( 'color' );
		$( this ).css('color', accentColor );
	} ).mouseleave( function() {
		$( this ).css('color', initialColor );
	} );

	$( '.social-menu a' ).mouseenter( function() {
		initialColor = $( this ).css( 'background-color' );
		$( this ).css('background-color', accentColor );
	} ).mouseleave( function() {
		$( this ).css('background-color', initialColor );
	} );

	$( '.archive-nav a' ).mouseenter( function() {
		initialColor = $( this ).css( 'color' );
		$( this ).css('color', accentColor );
	} ).mouseleave( function() {
		$( this ).css('color', initialColor );
	} );

	$( '#infinite-handle' ).live( 'mouseenter', function() {
		initialColor = $( this ).css( 'background-color' );
		$( this ).css( 'background-color', accentColor );
	} ).live( 'mouseleave', function() {
		$( this ).css( 'background-color', initialColor );
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