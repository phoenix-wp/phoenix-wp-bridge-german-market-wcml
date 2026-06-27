<?php
/**
 * Main plugin bootstrap.
 *
 * @package PhoenixWP\GmDhlMcFix
 */

declare(strict_types=1);

namespace PhoenixWP\GmDhlMcFix;

use PhoenixWP\GmDhlMcFix\Admin\Settings_Page;
use PhoenixWP\GmDhlMcFix\Integration\German_Market_Dhl;

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
		add_action( 'before_woocommerce_init', array( $this, 'declare_woocommerce_compatibility' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ), 20 );
		add_action( 'admin_notices', array( $this, 'dependency_notices' ) );
	}

	/**
	 * Declares HPOS compatibility.
	 */
	public function declare_woocommerce_compatibility(): void {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', PHOENIX_GM_DHL_MC_FIX_FILE, true );
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

		if ( phoenix_gm_dhl_mc_fix_is_german_market_active() ) {
			add_action( 'woocommerce_init', array( German_Market_Dhl::instance(), 'init' ) );
		}

		/**
		 * Fires when the bridge plugin is fully loaded.
		 */
		do_action( 'phoenix_gm_dhl_mc_fix_loaded' );
	}

	/**
	 * Shows dependency notices in admin.
	 */
	public function dependency_notices(): void {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		if ( ! phoenix_gm_dhl_mc_fix_is_woocommerce_active() ) {
			echo '<div class="notice notice-error"><p>';
			esc_html_e( 'PhoenixWP Fix — German Market DHL & WCML requires WooCommerce.', 'phoenix-german-market-dhl-multi-currency-fix-for-woocommerce' );
			echo '</p></div>';
		}

		if ( phoenix_gm_dhl_mc_fix_is_woocommerce_active() && ! Install::integrations_available() ) {
			echo '<div class="notice notice-warning is-dismissible"><p>';
			esc_html_e( 'PhoenixWP Fix — German Market DHL & WCML: activate German Market and WCML multi-currency for full functionality.', 'phoenix-german-market-dhl-multi-currency-fix-for-woocommerce' );
			echo '</p></div>';
		}
	}
}
