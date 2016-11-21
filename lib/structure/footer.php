<?php
/**
 * Footer structure customization.
 *
 * @package     UpTechLabs\HelloMinimal\Structure
 * @since       1.0.2
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
function unregister_footer_events() {
	remove_all_actions( 'genesis_footer' );
	add_action( 'genesis_footer', __NAMESPACE__ . '\render_site_footer' );
}

/**
 * Change the footer text.
 *
 * @since  1.1.0
 *
 * @return void
 */
function render_site_footer() {
	include( __DIR__ .'/views/site-footer.php' );
}
