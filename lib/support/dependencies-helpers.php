<?php
/**
 * Missing plugin function helpers.
 *
 * This child theme uses multiple plugins to create the unique experience
 * for our website.  If these plugins are not installed, for example, you
 * are using this on a different website, then this helper file recreates
 * the dependent functions.
 *
 * @package     UpTechLabs\HelloMinimal\Support
 * @since       1.1.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GPL-2+
 */

if ( ! function_exists( 'fulcrum_is_dev_environment' ) ) {
	/**
	 * If Fulcrum is not loaded, then return the value of WP_DEBUG.
	 * When it's `true`, then we assume you are in the development
	 * environment.
	 *
	 * @since 1.4.9
	 *
	 * @return bool
	 */
	function fulcrum_is_dev_environment() {
		return WP_DEBUG === true;
	}
}

if ( ! function_exists( 'fulcrum_load_login_form_styling' ) ) {
	/**
	 * If Fulcrum is missing, then this dummy function does nothing,
	 * except prevent the theme from tossing a fatal error.
	 *
	 * @since 1.4.9
	 *
	 * @param string $stylesheet
	 *
	 * @return void
	 */
	function fulcrum_load_login_form_styling( $stylesheet ) {
		// do nothing.
	}
}
