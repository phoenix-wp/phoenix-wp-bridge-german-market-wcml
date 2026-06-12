# FAQ — PhoenixWP Fix (German Market DHL & WCML)

## Is this a DHL or multi-currency plugin?

No. It fixes compatibility between **German Market DHL** and **WCML multi-currency** when both are already installed.

## What exactly gets fixed?

1. **Free-shipping thresholds** — EUR amounts are converted before comparison (fixes false free shipping in PLN/HUF/etc.).
2. **Shipping costs** — flat DHL zone costs (5 EUR, 15 EUR, …) are converted at checkout.
3. **DHL labels** — number-first addresses (e.g. France) no longer produce an empty street in the DHL API.

## Which DHL methods are supported?

- DHL Home Delivery (`dhl_home_delivery`)
- DHL Packstation (`dhl_packstation`)
- DHL Parcelshops (`dhl_parcelshops`)

## Do I configure thresholds per currency?

No. Keep thresholds and costs in German Market in your **shop base currency**. The fix converts them using WCML exchange rates.

## Does language matter?

No. Only **currency** (WCML) and **address format** affect this plugin.

## Is there a Pro version?

No. This plugin is 100% free (GPL).

Support: https://phoenixwp.com/support/
