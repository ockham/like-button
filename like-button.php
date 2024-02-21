<?php
/**
 * Plugin Name:       Like Button
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.4
 * Requires PHP:      7.0
 * Version:           0.7.1
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
}
add_action( 'init', 'create_block_like_button_block_init' );

function add_like_button_block_after_post_content_block( $hooked_block_types, $relative_position, $anchor_block_type, $context ) {
	if ( ! $context instanceof WP_Block_Template || ! property_exists( $context, 'slug' ) || 'single' !== $context->slug ) {
		return $hooked_block_types;
	}

	if ( 'after' === $relative_position && 'core/post-content' === $anchor_block_type ) {
		$hooked_block_types[] = 'ockham/like-button';
	}
	return $hooked_block_types;
}
add_filter( 'hooked_block_types', 'add_like_button_block_after_post_content_block', 10, 4 );

function set_like_button_block_layout_attribute_based_on_adjacent_block( $hooked_block, $hooked_block_type, $relative_position, $anchor_block ) {
	// Is the hooked block adjacent to the anchor block?
	if ( 'before' !== $relative_position && 'after' !== $relative_position ) {
		return $hooked_block;
	}

	// Does the anchor block have a layout attribute?
	if ( isset( $anchor_block['attrs']['layout'] ) ) {
		// Copy the anchor block's layout attribute to the hooked block.
		$hooked_block['attrs']['layout'] = $anchor_block['attrs']['layout'];
	}

	return $hooked_block;
}
add_filter( 'hooked_block_ockham/like-button', 'set_like_button_block_layout_attribute_based_on_adjacent_block', 10, 4 );
