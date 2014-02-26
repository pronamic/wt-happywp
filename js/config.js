( function( $ ) {
	$( document ).ready( function() {

		/**
		 * Flexslider
		 */
		$( '.flexslider' ).flexslider( {
			animation: 'fade',
			slideshow: false,
			smoothHeight: true
		} );

		/**
		 * Buttons
		 */
		$( '.submit' ).addClass('button');
		$( '.content-navigation a' ).addClass( 'button secondary small' );
		$( '#submit' ).addClass( 'button' );

	} );
} )( jQuery );


  

 