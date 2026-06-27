<?php
/**
 * Global helper functions.
 *
 * @package PhoenixWP\GmDhlMcFix
 */

declare(strict_types=1);

defined( 'ABSPATH' ) || exit;

/**
 * Whether WooCommerce is active.
 */
function phoenix_gm_dhl_mc_fix_is_woocommerce_active(): bool {
	return class_exists( \WooCommerce::class );
}

/**
 * Whether German Market is active.
 */
function phoenix_gm_dhl_mc_fix_is_german_market_active(): bool {
	return class_exists( \Woocommerce_German_Market::class );
}

/**
 * Whether WCML multi-currency is available.
 */
function phoenix_gm_dhl_mc_fix_is_wcml_active(): bool {
	return function_exists( 'wcml_convert_price' ) || function_exists( 'wcml_loader' );
}

/**
 * Shop base currency from WooCommerce settings.
 */
function phoenix_gm_dhl_mc_fix_base_currency(): string {
	return (string) get_option( 'woocommerce_currency', 'EUR' );
}

/**
 * Active storefront currency (WCML-aware).
 */
function phoenix_gm_dhl_mc_fix_active_currency(): string {
	return \PhoenixWP\GmDhlMcFix\Currency\Multicurrency_Price_Converter::client_currency();
}

/**
 * Logs debug messages when WP_DEBUG is enabled.
 *
 * @param string               $message Message.
 * @param string               $level   Log level.
 * @param array<string, mixed> $context Context.
 */
function phoenix_gm_dhl_mc_fix_log( string $message, string $level = 'info', array $context = array() ): void {
	unset( $level, $context );

	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		error_log( '[PhoenixWP GM DHL MC Fix] ' . $message );
	}
}
