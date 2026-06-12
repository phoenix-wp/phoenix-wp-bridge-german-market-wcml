<?php
/**
 * Plugin settings option.
 *
 * @package PhoenixWP\BridgeGermanMarketWcml
 */

declare(strict_types=1);

namespace PhoenixWP\BridgeGermanMarketWcml;

defined( 'ABSPATH' ) || exit;

/**
 * Settings keys and defaults.
 */
final class Settings {

	public const OPTION_KEY = 'phoenix_wp_bridge_gm_wcml_settings';

	/**
	 * Default settings.
	 *
	 * @return array<string, bool>
	 */
	public static function defaults(): array {
		return array(
			'convert_dhl_thresholds'   => true,
			'convert_dhl_shipping_costs' => true,
			'fix_address_parsing'      => true,
		);
	}

	/**
	 * Merged settings.
	 *
	 * @return array<string, bool>
	 */
	public static function get(): array {
		$stored = get_option( self::OPTION_KEY, array() );

		if ( ! is_array( $stored ) ) {
			$stored = array();
		}

		return array_merge( self::defaults(), $stored );
	}

	/**
	 * Whether a feature flag is enabled.
	 *
	 * @param string $key Setting key.
	 */
	public static function is_enabled( string $key ): bool {
		$settings = self::get();

		return ! empty( $settings[ $key ] );
	}
}
