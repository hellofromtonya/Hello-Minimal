<?php

/**
 * File autoloader
 *
 * @package     UpTechLabs\HelloMinimal\Support
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        http://hellofromtonya.com/blog
 * @license     GPL-2+
 */
namespace UpTechLabs\HelloMinimal\Support;

/**
 * Initialize the filenames to be loaded.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_files() {
	$filenames = array(
//		'/support/dependencies-helpers.php',
		'class-setup.php',
		'support/formatting.php',
		'support/load-assets.php',
		'support/markup.php',
		'structure/archive.php',
		'structure/comments.php',
		'structure/footer.php',
		'structure/header.php',
		'structure/nav.php',
		'structure/post.php',
//		'structure/search.php',
	);

	load_specified_files( $filenames );
}

/**
 * Load each of the specified files.
 *
 * @since 1.0.0
 *
 * @param array $filenames
 * @param string $folder_root
 *
 * @return void
 */
function load_specified_files( array $filenames, $folder_root = '' ) {
	$folder_root = $folder_root ?: CHILD_THEME_DIR . '/lib/';

	foreach ( $filenames as $filename ) {
		require_once( $folder_root . $filename );
	}
}

init_files();
