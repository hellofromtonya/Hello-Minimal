<?php
/**
 * Menu structure customization.
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
function unregister_nav_events() {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
}

add_action( 'genesis_header', __NAMESPACE__ . '\render_mobile_nav' );
/**
 * Render the mobile nav.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_mobile_nav() {
	include( __DIR__ . '/views/mobile-nav.php' );
}