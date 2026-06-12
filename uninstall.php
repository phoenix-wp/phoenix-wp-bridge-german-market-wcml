<?php
/**
 * Uninstall cleanup.
 *
 * @package PhoenixWP\BridgeGermanMarketWcml
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

delete_option( 'phoenix_wp_bridge_gm_wcml_settings' );
