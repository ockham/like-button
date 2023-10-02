/**
 * WordPress dependencies
 */
const likeButtons = document.querySelectorAll('.like-button-parent');

likeButtons.forEach( likeButton => {
	likeButton.onclick = function() {
		likeButton.classList.toggle( 'liked' );
	}
} );
