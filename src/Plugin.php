<?php
/**
 * Main plugin bootstrap.
 *
 * @package PhoenixWP\BridgeGermanMarketWcml
 */

declare(strict_types=1);

namespace PhoenixWP\BridgeGermanMarketWcml;

use PhoenixWP\BridgeGermanMarketWcml\Admin\Settings_Page;
use PhoenixWP\BridgeGermanMarketWcml\Integration\German_Market_Dhl;
use PhoenixWP\Core\Module_Registry;

defined( 'ABSPATH' ) || exit;

/**
 * Extension singleton bootstrap.
 */
final class Plugin {

	private static ?self $instance = null;

	private static bool $initialized = false;

	public static function instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'before_woocommerce_init', array( $this, 'declare_woocommerce_compatibility' ) );
		add_action( 'phoenix_wp_core_register_modules', array( $this, 'register_module' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ), 20 );
		add_action( 'admin_notices', array( $this, 'dependency_notices' ) );
	}

	/**
	 * Declares HPOS compatibility.
	 */
	public function declare_woocommerce_compatibility(): void {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_FILE, true );
		}
	}

	private function __clone() {}

	public function __wakeup(): void {
		throw new \Exception( 'Cannot unserialize singleton.' );
	}

	/**
	 * Initializes the extension after dependencies load.
	 */
	public function init(): void {
		if ( self::$initialized || ! Install::requirements_met() ) {
			return;
		}

		self::$initialized = true;

		if ( is_admin() ) {
			Settings_Page::instance()->init();
		}

		if ( phoenix_wp_bridge_gm_wcml_is_german_market_active() ) {
			add_action( 'woocommerce_init', array( German_Market_Dhl::instance(), 'init' ) );
		}

		/**
		 * Fires when the bridge plugin is fully loaded.
		 */
		do_action( 'phoenix_wp_bridge_gm_wcml_loaded' );
	}

	/**
	 * Loads plugin translations (WordPress 6.7+: on init, not earlier).
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain(
			'phoenix-german-market-dhl-wcml-fix-for-woocommerce',
			false,
			dirname( PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_BASENAME ) . '/languages'
		);
	}

	/**
	 * Registers module metadata with PhoenixWP Core.
	 *
	 * @param Module_Registry $registry Core registry.
	 */
	public function register_module( Module_Registry $registry ): void {
		$registry->register(
			array(
				'slug'    => 'phoenix-german-market-dhl-wcml-fix-for-woocommerce',
				// Plain name: Core fires this hook on plugins_loaded (before init); no __() here (WP 6.7 JIT notice).
				'name'    => 'Phoenix German Market DHL WCML Fix for WooCommerce',
				'version' => PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_VERSION,
				'type'    => Module_Registry::TYPE_EXTENSION,
				'tier'    => 'free',
				'file'    => PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_FILE,
			)
		);
	}

	/**
	 * Shows dependency notices in admin.
	 */
	public function dependency_notices(): void {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		if ( ! phoenix_wp_bridge_gm_wcml_is_woocommerce_active() ) {
			echo '<div class="notice notice-error"><p>';
			esc_html_e( 'PhoenixWP Fix — German Market DHL & WCML requires WooCommerce.', 'phoenix-german-market-dhl-wcml-fix-for-woocommerce' );
			echo '</p></div>';
		}

		if ( phoenix_wp_bridge_gm_wcml_is_woocommerce_active() && ! Install::integrations_available() ) {
			echo '<div class="notice notice-warning is-dismissible"><p>';
			esc_html_e( 'PhoenixWP Fix — German Market DHL & WCML: activate German Market and WCML multi-currency for full functionality.', 'phoenix-german-market-dhl-wcml-fix-for-woocommerce' );
			echo '</p></div>';
		}
	}
}
