<?php
/**
 * Theme initialization
 *
 * @package     UpTechLabs\HelloMinimal
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GPL-2+
 */
namespace UpTechLabs\HelloMinimal;

/**
 * Initialize the theme's constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_constants() {

	$child_theme = wp_get_theme();

	define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
	define( 'CHILD_THEME_URL', get_stylesheet_directory_uri() );
	define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
	define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );

	define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
	define( 'CHILD_CONFIG_DIR', CHILD_THEME_DIR . '/config/' );

	define( 'CHILD_DIST_URL', CHILD_THEME_URL . '/assets/dist/' );
}

init_constants();

