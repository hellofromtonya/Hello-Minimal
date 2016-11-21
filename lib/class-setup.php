<?php
/**
 * Theme Setup
 *
 * @package     UpTechLabs\HelloMinimal
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://UpTechLabs.io
 * @license     GPL-2+
 */

namespace UpTechLabs\HelloMinimal;

use Fulcrum\Support\Helpers\Str;

class ThemeSetup {

	/**
	 * Runtime Configuration parameters
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * Instance of the theme.
	 *
	 * @var \WP_Theme
	 */
	protected $child_theme;

	/**
	 * Path to the child theme root folder
	 *
	 * @var string
	 */
	protected $child_theme_dir;

	/**
	 * Child theme root URL
	 *
	 * @var string
	 */
	protected $child_theme_url;

	/*************************
	 * Instantiate & Init
	 ************************/

	/**
	 * Instantiate the plugin
	 *
	 *
	 * So all we want to do here is get the theme up and running by
	 * setting up the base properties and constants.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config Theme configuration parameters
	 */
	public function __construct( array $config ) {
		$this->config = $config;

		$this->init_pre();
		$this->init_events();
	}

	/**
	 * Pre-initialization, meaning these tasks go first.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_pre() {
		$this->task_loader( 'init_pre' );
	}

	/**
	 * Pre-initialization, meaning these tasks go first.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	protected function init_events() {
		add_action( 'genesis_setup', array( $this, 'setup' ), 15 );
		add_action( 'after_switch_theme', array( $this, 'update_theme_settings_defaults' ) );
	}

	/**
	 * Setup the theme.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function setup() {
		$this->task_loader( 'setup' );

		$this->unregister_genesis_callbacks();
	}

	/**********************
	 * Pre Tasks
	 *********************/

	/**
	 * Login form styling handler.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 *
	 * @return void
	 */
	protected function login_form( array $config ) {
		fulcrum_load_login_form_styling( $config );
	}

	/**
	 * Let's load up the favicon from the theme.
	 *
	 * @since 1.0.0
	 *
	 * @param string Favicon URL
	 *
	 * @return string
	 */
	protected function favicon( $favicon_url ) {
		add_filter( 'genesis_pre_load_favicon', function () use ( $favicon_url ) {
			return $favicon_url;
		} );
	}

	/**********************
	 * Theme Setup Tasks
	 *********************/

	/**
	 * Sets the theme setting defaults.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function update_theme_settings_defaults() {
		if ( function_exists( 'genesis_update_settings' ) ) {
			genesis_update_settings( $this->config['theme_defaults'] );
		}

		update_option( 'posts_per_page', $this->config['theme_defaults']['blog_cat_num'] );
	}

	/**
	 * Add image sizes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 *
	 * @return void
	 */
	protected function add_image_size( array $config ) {
		foreach ( $config as $name => $parameters ) {
			if ( ! is_array( $parameters ) ) {
				continue;
			}

			if ( ! isset( $parameters['width'] ) || ! isset( $parameters['height'] ) ) {
				continue;
			}

			$width  = (int) $parameters['width'];
			$height = (int) $parameters['height'];
			$crop   = isset( $parameters['crop'] ) ? $parameters['crop'] : false;

			add_image_size( $name, $width, $height, $crop );
		}
	}

	/**
	 * Add theme supports.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 *
	 * @return void
	 */
	protected function add_theme_support( array $config ) {
		foreach ( $config as $feature => $parameters ) {
			if ( is_null( $parameters ) ) {
				add_theme_support( $feature );
			} else {
				add_theme_support( $feature, $parameters );
			}
		}
	}

	/**
	 * Unregister default Genesis layouts.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 *
	 * @return void
	 */
	protected function genesis_unregister_layout( array $config ) {
		foreach ( $config as $layout ) {
			genesis_unregister_layout( $layout );
		}
	}

	/**
	 * Disable the edit link on the front-end (as it drives me crazy).
	 *
	 * @since 1.0.0
	 *
	 * @param bool $ok_to_disable_it When set to true, the `edit_post_link` is disabled.
	 *
	 * @return void
	 */
	protected function disable_edit_link( $ok_to_disable_it = false ) {
		if ( ! $ok_to_disable_it ) {
			return;
		}
		add_filter( 'edit_post_link', '__return_empty_string' );
	}

	/**
	 * Remove Genesis Blog page template.
	 *
	 * @since 1.0.0
	 *
	 * @param array $page_templates Existing recognised page templates.
	 *
	 * @return array Amended recognised page templates.
	 */
	protected function remove_page_templates( array $page_templates ) {
		add_filter( 'theme_page_templates', function () use ( $page_templates ) {
			unset( $page_templates['page_blog.php'] );

			return $page_templates;
		} );
	}

	/**
	 * Register sidebars.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 *
	 * @return void
	 */
	protected function register_sidebars( array $config ) {
		foreach ( $config as $sidebar ) {
			genesis_register_sidebar( $sidebar );
		}
	}

	/**
	 * Unregister sidebars.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config Array of sidebars to unregister
	 *
	 * @return void
	 */
	protected function unregister_sidebars( array $config ) {
		foreach ( $config as $sidebar ) {
			unregister_sidebar( $sidebar );
		}
	}

	/**
	 * Enable shortcodes in the WordPress default text widget when configured.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $is_enabled When true, shortcodes are enabled for the text widget.
	 *
	 * @return void
	 */
	protected function do_shortcodes_in_text_widget( $is_enabled = false ) {
		if ( ! $is_enabled ) {
			return;
		}
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**********************
	 * Helpers
	 *********************/

	/**
	 * Load up the tasks by calling each task method.
	 *
	 * @since 1.0.0
	 *
	 * @param string $config_key
	 * @param string $method_prefix
	 *
	 * @return bool
	 */
	protected function task_loader( $config_key, $method_prefix = '' ) {
		if ( ! array_key_exists( $config_key, $this->config ) ) {
			return false;
		}

		foreach ( $this->config[ $config_key ] as $task => $task_config ) {
			$method_name = $method_prefix . $task;

			$this->{$method_name}( $task_config );
		}
	}

	/**
	 * Unregister Genesis callbacks.  We do this here because the child theme loads before Genesis.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function unregister_genesis_callbacks() {
		Structure\unregister_archive_events();
		Structure\unregister_header_events();
		Structure\unregister_nav_events();
		Structure\unregister_post_events();
		Structure\unregister_footer_events();
		Structure\unregister_comments_events();
	}
}
