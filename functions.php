<?php

/**
 * Stop and say "Hello"
 *
 * @package     UpTechLabs\HelloMinimal
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://hellofromtonya.com/blog
 * @license     GPL-2+
 */
namespace UpTechLabs\HelloMinimal;

require_once( __DIR__ . '/lib/init.php' );

// Let's load in all the files
require_once( __DIR__ . '/lib/support/autoload.php' );

$theme_setup_config = require_once( CHILD_CONFIG_DIR . 'theme.php' );

new ThemeSetup( $theme_setup_config );
