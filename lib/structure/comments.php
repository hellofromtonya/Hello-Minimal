<?php
/**
 * Comments structure customization.
 *
 * @package     UpTechLabs\HelloMinimal\Structure
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        http://hellofromtonya.com/blog
 * @license     GNU General Public License 2.0+
 */
namespace UpTechLabs\HelloMinimal\Structure;

/**
 * Unregister default Genesis events.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_comments_events() {

}

add_action( 'genesis_after_entry', __NAMESPACE__ . '\render_comments_background_text_top', 9 );
function render_comments_background_text_top() {
	if ( ! is_single() ) {
		return;
	}

	include( __DIR__ . '/views/comments-background-text-top.php' );
}

add_filter( 'comment_form_defaults', __NAMESPACE__ . '\customize_comments_form_defaults' );
/**
 * Modify the comment form default arguments.
 *
 * @since 1.0.0
 *
 * @param array $parameters
 *
 * @return mixed
 */
function customize_comments_form_defaults( array $parameters ) {
	$parameters['title_reply'] = __( 'What do you think?', 'UpTechLabs\HelloMinimal' );

	return $parameters;
}
