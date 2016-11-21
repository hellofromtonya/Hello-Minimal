<?php
/**
 * Archive structure customization.
 *
 * @package     UpTechLabs\HelloMinimal\Structure
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        http://hellofromtonya.com/blog
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\HelloMinimal\Structure;

use UpTechLabs\HelloMinimal\Support as support;

/**
 * Unregister default Genesis events.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_archive_events() {
	remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
}

add_action( 'genesis_before_loop', __NAMESPACE__ . '\render_archive_top_background_text', 1 );
/**
 * Add the first category as the background top text (accent feature).
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_archive_top_background_text() {
	if ( ! is_category() && ! is_tag() && ! is_tax() ) {
		return;
	}

	global $wp_query;

	$term = is_tax()
		? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )
		: $wp_query->get_queried_object();

	if ( ! $term ) {
		return;
	}

	$category_name = $term->name;

	include( __DIR__ . '/views/background-text-top.php' );
}
