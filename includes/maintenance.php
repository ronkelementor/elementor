<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Maintenance.
 *
 * Elementor maintenance handler class.
 *
 * @since 1.0.0
 */
class Maintenance {

	/**
	 * Activate Elementor.
	 *
	 * Set Elementor activation hook.
	 *
	 * Fired by `register_activation_hook` when the plugin is activated.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function activation() {
		wp_clear_scheduled_hook( 'elementor/tracker/send_event' );

		wp_schedule_event( time(), 'daily', 'elementor/tracker/send_event' );
		flush_rewrite_rules();
	}

	/**
	 * Uninstall Elementor.
	 *
	 * Set Elementor uninstallation hook.
	 *
	 * Fired by `register_uninstall_hook` when the plugin is uninstalled.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function uninstall() {
		wp_clear_scheduled_hook( 'elementor/tracker/send_event' );
	}

	/**
	 * Init.
	 *
	 * Initialize Elementor Maintenance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function init() {
		register_activation_hook( ELEMENTOR_PLUGIN_BASE, [ __CLASS__, 'activation' ] );
		register_uninstall_hook( ELEMENTOR_PLUGIN_BASE, [ __CLASS__, 'uninstall' ] );
	}
}

Maintenance::init();
