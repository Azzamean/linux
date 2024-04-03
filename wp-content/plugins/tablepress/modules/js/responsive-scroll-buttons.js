/**
 * JavaScript code for the scroll buttons of the "Scroll" mode of the Responsive Tables module.
 *
 * @package TablePress
 * @subpackage Responsive Tables
 * @author Tobias Bäthge
 * @since 2.2.0
 */

document.querySelectorAll( '.tablepress-scroll-button-left' ).forEach( ( $button ) => {
	$button.addEventListener( 'click', function() {
		this.nextElementSibling.scrollBy( 200, 0 );
	} );
} );
document.querySelectorAll( '.tablepress-scroll-button-right' ).forEach( ( $button ) => {
	$button.addEventListener( 'click', function() {
		this.previousElementSibling.scrollBy( -200, 0 );
	} );
} );
