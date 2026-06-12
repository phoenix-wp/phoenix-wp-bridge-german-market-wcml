# WordPress.org Plugin Directory assets

Upload these PNGs to the **SVN `assets/` folder**, not to `trunk/`.

| File | Size |
|------|------|
| `icon-256x256.png` | 256×256 |
| `icon-128x128.png` | 128×128 |
| `banner-772x250.png` | 772×250 |
| `banner-1544x500.png` | 1544×500 |

**Source of truth (design):** `phoenix-wp-core/local-images/` — regenerate via:

```powershell
cd phoenix-wp-core
.\scripts\generate-brand-assets.ps1 -Plugin gm-dhl-wcml
```

**Banner copy (v3 brand):**

| Line | Text |
|------|------|
| Title | PhoenixWP Fix |
| Subtitle 1 | German Market DHL + WCML |
| Subtitle 2 | Multi-Currency - DHL Address Fix |

**Icon symbol:** linked modules + wrench (`Draw-FixBridgeSymbol`) — same PhoenixWP canvas + turquoise arc as Gift.

Do **not** include this folder in the plugin ZIP / SVN `trunk/`.

See `phoenix-wp-core/docs/BRAND-ASSETS.md` and `docs/WP-ORG-SUBMISSION.md`.
