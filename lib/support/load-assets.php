<?php

/**
 * Enqueue assets
 *
 * @package     UpTechLabs\HelloMinimal\Support
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GPL-2+
 */
namespace UpTechLabs\HelloMinimal\Support;

add_filter( 'stylesheet_uri', __NAMESPACE__ . '\change_stylesheet_uri_to_min' );
/**
 * Change the stylesheet to the minified version.
 *
 * @since 1.0.0
 *
 * @param string $stylesheet_uri
 *
 * @return string
 */
function change_stylesheet_uri_to_min( $stylesheet_uri ) {
	if ( fulcrum_is_dev_environment() ) {
		return $stylesheet_uri;
	}

	return CHILD_URL . '/style.min.css';
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_fonts' );
/**
 * Load fonts.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_fonts() {
	$config = require_once( CHILD_CONFIG_DIR . 'fonts.php' );

	wp_enqueue_style( $config['handle'], get_fonts_url( $config ), array(), null );
}

/**
 * Build Google fonts URL.
 *
 * @since  1.0.0
 *
 * @param array $config
 *
 * @return string
 */
function get_fonts_url( array $config ) {

	$query_args = array(
		'family' => urlencode( implode( '|', $config['font_families'] ) ),
		'subset' => urlencode( $config['encode_subset'] ),
	);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return $fonts_url;
}
