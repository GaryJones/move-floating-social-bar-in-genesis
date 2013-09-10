<?php
/**
 * Move Floating Social Bar in Genesis
 *
 * @package   Move_Floating_Social_Bar_In_Genesis
 * @author    Gary Jones <gary@garyjones.co.uk>
 * @license   GPL-2.0+
 * @link      https://github.com/GaryJones/move-floating-social-bar-in-genesis
 * @copyright 2013 Gary Jones, Gamajo Tech
 *
 * @wordpress-plugin
 * Plugin Name:       Move Floating Social Bar in Genesis
 * Plugin URI:        https://github.com/GaryJones/move-floating-social-bar-in-genesis
 * Description:       Moves the Floating Social Bar plugin output from just inside the entry content to just before it.
 * Version:           1.0.0
 * Author:            Gary Jones
 * Author URI:        http://gamajo.com/
 * Text Domain:       move-floating-social-bar-in-genesis
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/GaryJones/move-floating-social-bar-in-genesis
 * GitHub Branch:     master
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'pre_get_posts', 'mfsbig_remove_floating_social_bar', 15 );
/**
 * Remove Floating Social Bar from outputting at the top of the content.
 *
 * FSB adds these filters at pre_get_posts, priorty 10, so we'll remove them
 * just after that.
 *
 * @since 1.0.0
 */
function mfsbig_remove_floating_social_bar() {
	if ( class_exists( 'floating_social_bar' ) ) {
		remove_filter( 'the_excerpt', array( floating_social_bar::get_instance(), 'fsb' ), apply_filters( 'fsb_social_bar_priority', 10 ) );
		remove_filter( 'the_content', array( floating_social_bar::get_instance(), 'fsb' ), apply_filters( 'fsb_social_bar_priority', 10 ) );
	}
}

add_action( 'genesis_before_post_content', 'mfsbig_add_floating_social_bar' );  // XHTML themes
add_action( 'genesis_before_entry_content', 'mfsbig_add_floating_social_bar' ); // HTML5 themes
/**
 * Echo the Floating Social Bar in the right place, just before the entry
 * content (after the header and entry meta) in Genesis child themes.
 *
 * As fsb() is really a function for filtering, it requires a single argument
 * (the content or excerpt), so we fool it by passing in an empty string instead.
 *
 * @since 1.0.0
 */
function mfsbig_add_floating_social_bar() {
	if ( class_exists( 'floating_social_bar' ) ) {
		echo floating_social_bar::get_instance()->fsb('');
	}
}
