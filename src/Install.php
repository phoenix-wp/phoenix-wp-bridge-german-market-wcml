<?php
/**
 * Plugin activation lifecycle.
 *
 * @package PhoenixWP\BridgeGermanMarketWcml
 */

declare(strict_types=1);

namespace PhoenixWP\BridgeGermanMarketWcml;

defined( 'ABSPATH' ) || exit;

/**
 * Handles activation and deactivation.
 */
final class Install {

	public const MIN_WP  = '6.7';
	public const MIN_PHP = '8.2';

	/**
	 * Registers lifecycle hooks.
	 */
	public static function register_hooks(): void {
		register_activation_hook( PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_FILE, array( self::class, 'activate' ) );
		register_deactivation_hook( PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_FILE, array( self::class, 'deactivate' ) );
	}

	/**
	 * Runs on activation.
	 */
	public static function activate(): void {
		if ( ! self::requirements_met() ) {
			deactivate_plugins( PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_BASENAME );
			wp_die(
				esc_html__( 'PhoenixWP Fix — German Market DHL & WCML requires WordPress 6.7+, PHP 8.2+, and WooCommerce.', 'phoenix-german-market-dhl-wcml-fix-for-woocommerce' ),
				esc_html__( 'Plugin Activation Error', 'phoenix-german-market-dhl-wcml-fix-for-woocommerce' ),
				array( 'back_link' => true )
			);
		}

		if ( ! get_option( Settings::OPTION_KEY ) ) {
			add_option( Settings::OPTION_KEY, Settings::defaults() );
		}

		flush_rewrite_rules();
	}

	/**
	 * Runs on deactivation.
	 */
	public static function deactivate(): void {
		flush_rewrite_rules();
	}

	/**
	 * Whether PHP, WordPress, and WooCommerce are available.
	 */
	public static function requirements_met(): bool {
		global $wp_version;

		if ( version_compare( PHP_VERSION, self::MIN_PHP, '<' ) ) {
			return false;
		}

		if ( isset( $wp_version ) && version_compare( $wp_version, self::MIN_WP, '<' ) ) {
			return false;
		}

		if ( ! phoenix_wp_bridge_gm_wcml_is_woocommerce_active() ) {
			return false;
		}

		return true;
	}

	/**
	 * Whether runtime integrations can load (soft deps for admin notice only).
	 */
	public static function integrations_available(): bool {
		return phoenix_wp_bridge_gm_wcml_is_german_market_active() && phoenix_wp_bridge_gm_wcml_is_wcml_active();
	}
}
