<?php

/**
 * Formatting
 *
 * @package     UpTechLabs\HelloMinimal\Support
 * @since       1.1.0
 * @author      hellofromTonya
 * @link        http://hellofromtonya.com/blog
 * @license     GPL-2+
 */
namespace UpTechLabs\HelloMinimal\Support;

//add_filter( 'get_the_content_more_link', __NAMESPACE__ . '\modify_the_content_more_link', 10, 2 );
/**
 * Modify the content more_link.
 *
 * @since 1.0.0
 *
 * @param string $html
 * @param string $more_link_text
 *
 * @return string
 */
function modify_the_content_more_link( $html, $more_link_text ) {
	$html = str_replace( '&#x02026; ', '<p>', $html );
	$html = str_replace( '</a>', '</a></p>', $html );
	$html = str_replace( $more_link_text, 'Learn more', $html );

	return $html;
}

/**
 * Render the category's top background title onto the page.
 *
 * @since 1.0.2
 *
 * @return void
 */
function render_category_top_background_title() {
	$category = get_the_category();
	if ( ! $category || is_wp_error($category) ) {
		return;
	}

	$category_name = $category[0]->name;
	include( CHILD_THEME_DIR . '/lib/views/background-text-top.php' );
}
