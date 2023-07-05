<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$heart_icon         = file_get_contents( plugin_dir_path( __DIR__ ) . '/empty-heart.svg' );
$wrapper_attributes = get_block_wrapper_attributes();

$likedComments = array();
$likedPosts    = array();

wp_store(
	array(
		'state'     => array(
			'likes' => array(
				'likedComments' => $likedComments,
				'likedPosts'    => $likedPosts,
			),
		),
		'selectors' => array(
			'likes' => array(
				'isLiked' => false,
			),
		),
	),
);

if ( ! empty( $block->context['commentId'] ) ) {
	$commentId = $block->context['commentId'];
	$context = '{ "comment": { "id": ' . $commentId . ' } }';
} else if ( ! empty( $block->context['postId'] ) ) {
	$postId = $block->context['postId'];
	$context = '{ "post": { "id": ' . $postId . ' } }';
} else {
	$context = '';
}

?>

<div
	<?php echo $wrapper_attributes; ?>
	data-wp-interactive
	data-wp-context='<?php echo $context; ?>'
>
	<div
			class="like-button-parent"
			data-wp-on--click="actions.likes.toggle"
		>
			<div
				class="like-button-child"
				data-wp-class--liked="selectors.likes.isLiked"
			>
				<?php echo $heart_icon; ?>
				<span>
					<?php _e( 'Like', 'like-button' ); ?>
				</span>
			</div>
	</div>
</div>
