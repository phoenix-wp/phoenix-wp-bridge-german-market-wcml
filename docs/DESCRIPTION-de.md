# PhoenixWP Fix — German Market DHL & WCML (Deutsch)

**WCML Multi-Currency Compatibility Fix** · **German Market DHL International Address Fix**

Kostenloser **Kompatibilitäts-Fix** — **kein** eigenständiges DHL- oder Multi-Currency-Plugin. Voraussetzung: **German Market** (DHL-Versand-Add-on) und **WCML Multi-Currency** (beides separat erhältlich).

---

## WCML Multi-Currency Compatibility Fix

German Market speichert DHL-Versandkosten und Gratis-Schwellen in der **Shop-Basiswährung** (z. B. EUR). WCML rechnet Produktpreise automatisch um, **jedoch nicht** Custom-Versandmethoden wie German Market DHL.

Ohne diesen Fix kann ein Warenkorb von **75 PLN** fälschlich versandkostenfrei werden, obwohl die Schwelle **75 EUR** ist. Versandkosten wie **5,00 EUR** erscheinen ggf. als **5,00 PLN** ohne Umrechnung.

**Behoben wird:**

- Gratis-Versand- und Mindestbestell-Schwellen (`free_min_amount`, `minimum_amount`)
- Feste DHL-Versandkosten pro Zone (z. B. 5,00 EUR / 15,00 EUR)
- Alle in WCML konfigurierten Währungen; alle WooCommerce-Versandzonen

## German Market DHL International Address Fix

German Market trennt Adresszeile 1 nach deutschem Muster (Straße vor Hausnummer). Bei **EU-Auslands-Lieferungen** und **DHL-Labels** führen Adressen mit Nummer zuerst (z. B. Frankreich `56 Bd Example`) zu einer leeren Straße in der DHL-API.

**Behoben wird:**

- Bidirektionales Parsing von Straße und Hausnummer
- Checkout-Normalisierung und DHL-Label-API (`wgm_shipping_dhl_build_address_from_order`)

## Unterstützte DHL-Methoden

- DHL Standard / Home Delivery (`dhl_home_delivery`)
- DHL Packstation (`dhl_packstation`)
- DHL Parcelshops (`dhl_parcelshops`)

## Einstellungen

**WooCommerce → GM DHL WCML Fix**

Drei Schalter: Schwellen, Versandkosten, International Address Fix.

## Voraussetzungen

- WordPress 6.7+, PHP 8.2+, WooCommerce 8.0+
- German Market mit DHL-Versand
- WCML Multi-Currency aktiv

**Hinweis:** Die Plugin-Oberfläche im WordPress-Admin ist **Englisch**. Übersetzungen können bei Bedarf mit Loco Translate ergänzt werden.

Support: https://phoenixwp.com/support/
