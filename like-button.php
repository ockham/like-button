<?php
/**
 * Plugin Name:       Like Button
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.6.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       like-button
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_like_button_block_init() {
	register_block_type( __DIR__ . '/build' );

	register_block_pattern(
		'ockham/like-button-wrapper',
		array(
			'title'       => __( 'Like Button', 'like-button' ),
			'description' => _x( 'A button to like content.', 'Block pattern description', 'like-button' ),
			'content'     => '<!-- wp:group {"layout":{"type":"constrained"}} --><div class="wp-block-group"><!-- wp:ockham/like-button /--></div><!-- /wp:group -->',
			'inserter'    => false
		),
	);
}
add_action( 'init', 'create_block_like_button_block_init' );

function insert_like_button_pattern_after_post_content( $hooked_block, $position, $anchor_block ) {
	if ( 'before' !== $position && 'after' !== $position ) {
		return $hooked_block;
	}

	if ( 'core/post-content' !== $anchor_block['blockName'] ) {
		return $hooked_block;
	}

	// We replace the "simple" block with a pattern that contains a Group block wrapper.
	return array(
		'blockName' => 'core/pattern',
		'attrs'     => array(
			'slug' => 'ockham/like-button-wrapper',
		),
	);
}
add_filter( 'hooked_block_ockham/like-button', 'insert_like_button_pattern_after_post_content', 10, 3 );
