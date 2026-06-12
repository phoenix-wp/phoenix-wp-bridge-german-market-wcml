# PhoenixWP Fix — German Market DHL & WCML (English)

**WCML Multi-Currency Compatibility Fix** · **German Market DHL International Address Fix**

Free compatibility fix — **not** a standalone DHL or multi-currency plugin. Requires **German Market** (DHL add-on) and **WCML multi-currency** (both sold separately).

---

## WCML Multi-Currency Compatibility Fix

German Market stores DHL free-shipping thresholds and flat shipping rates in your **shop base currency** (e.g. EUR). WCML converts product prices automatically, but **not** custom shipping methods like German Market DHL.

Without this fix, a cart of **75 PLN** can incorrectly unlock free shipping when your threshold is **75 EUR**. Shipping costs such as **5.00 EUR** may display as **5.00 PLN** without conversion.

**Fixes:**

- Free-shipping and minimum order thresholds (`free_min_amount`, `minimum_amount`)
- Flat DHL shipping costs per zone (e.g. 5.00 EUR / 15.00 EUR)
- Any currency configured in WCML; any WooCommerce shipping zone

## German Market DHL International Address Fix

German Market parses address line 1 using a Germany-style pattern (street before number). For EU cross-border **DHL labels**, number-first addresses (e.g. France `56 Bd Example`) can produce an empty street in the DHL API.

**Fixes:**

- Bidirectional street / house-number parsing
- Checkout normalization and DHL label API (`wgm_shipping_dhl_build_address_from_order`)

## Supported DHL methods

- DHL Home Delivery (`dhl_home_delivery`)
- DHL Packstation (`dhl_packstation`)
- DHL Parcelshops (`dhl_parcelshops`)

## Settings

**WooCommerce → GM DHL WCML Fix**

## Requirements

- WordPress 6.7+, PHP 8.2+, WooCommerce 8.0+
- German Market with DHL shipping
- WCML multi-currency enabled

Support: https://phoenixwp.com/support/
