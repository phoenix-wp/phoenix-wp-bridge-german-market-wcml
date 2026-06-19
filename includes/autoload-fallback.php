<?php
/**
 * PSR-4 fallback autoloader when Composer vendor/ is not present.
 *
 * @package PhoenixWP\BridgeGermanMarketWcml
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the extension PSR-4 autoloader.
 */
function phoenix_wp_bridge_gm_wcml_register_autoload_fallback(): void {
	spl_autoload_register(
		static function ( string $class ): void {
			$prefix = 'PhoenixWP\\BridgeGermanMarketWcml\\';

			if ( ! str_starts_with( $class, $prefix ) ) {
				return;
			}

			$relative = substr( $class, strlen( $prefix ) );
			$file     = PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_PATH . 'src/' . str_replace( '\\', '/', $relative ) . '.php';

			if ( is_readable( $file ) ) {
				require_once $file;
			}
		}
	);

	require_once PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_PATH . 'src/functions.php';
}
