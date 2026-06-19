<?php
/**
 * Plugin Name:       Phoenix German Market DHL WCML Fix for WooCommerce
 * Plugin URI:        https://phoenixwp.com/phoenix-wp-gm-dhl-wcml-fix/
 * Description:       WCML multi-currency compatibility fix and German Market DHL international address fix. Requires German Market DHL + WCML (not included).
 * Version:           1.0.0
 * Requires at least: 6.7
 * Tested up to:      7.0
 * Requires PHP:      8.2
 * Requires Plugins:  woocommerce
 * WC requires at least: 8.0
 * WC tested up to:   10.8.1
 * Author:            PhoenixWP
 * Author URI:        https://phoenixwp.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       phoenix-german-market-dhl-wcml-fix-for-woocommerce
 * Domain Path:       /languages
 *
 * @package PhoenixWP\BridgeGermanMarketWcml
 */

defined( 'ABSPATH' ) || exit;

define( 'PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_VERSION', '1.0.0' );
define( 'PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_FILE', __FILE__ );
define( 'PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_PATH', plugin_dir_path( __FILE__ ) );
define( 'PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_URL', plugin_dir_url( __FILE__ ) );
define( 'PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_BASENAME', plugin_basename( __FILE__ ) );

$autoload = PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_PATH . 'vendor/autoload.php';

if ( is_readable( $autoload ) ) {
	require_once $autoload;
} else {
	require_once PHOENIX_GERMAN_MARKET_DHL_WCML_FIX_FOR_WOOCOMMERCE_PATH . 'includes/autoload-fallback.php';
	phoenix_wp_bridge_gm_wcml_register_autoload_fallback();
}

\PhoenixWP\BridgeGermanMarketWcml\Install::register_hooks();

\PhoenixWP\BridgeGermanMarketWcml\Plugin::instance();
