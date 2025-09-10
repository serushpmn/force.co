# Force Theme — Work Log & Developer Notes

This README documents the changes made while customizing the `Force` WordPress theme (local copy). It is meant to help you and any developer understand what was added, why, and how to test/maintain these changes.

---

## Summary of work completed

High level: converted the theme to include a site-wide dark-mode toggle, improved header/cart/account UX, added custom account/login/logout/orders pages, and applied modern, responsive styles for account and cart pages.

Detailed list (files added/modified)

- New CSS files

  - `css/account.css` — Modern RTL, responsive styles for the account page (profile card, links, orders table).
  - `css/orders.css` — Card-grid styles for a dedicated orders page.
  - `css/cart-custom.css` — Modern two-column cart layout (items + summary) and responsive rules.

- New Page templates

  - `page-login.php` — Combined login + registration page (registration includes nonce checks, basic validation, user creation, automatic login and redirect to `/account`).
  - `page-logout.php` — Logout page that runs `wp_logout()` and redirects to home.
  - `page-account.php` — Account dashboard template showing profile, quick links, and a WooCommerce orders list (fallback `the_content()` and admin debug info added).
  - `page-orders.php` — Dedicated orders page listing a user's orders in a card grid.

- WooCommerce template overrides

  - `woocommerce/cart/cart.php` — Theme-level copy modified to wrap cells (thumbnail, details, price, qty, subtotal) in classed divs so custom CSS can style rows as cards.

- JavaScript

  - `js/theme-toggle.js` — Unified theme toggle logic: reads/writes `localStorage.theme` (falls back to legacy `force_theme_mode`), sets `data-theme` on `<html>`, binds to `#themeToggle` button on DOMContentLoaded, and writes both keys for compatibility.
  - `js/script.js` — Cleansed of duplicate theme init logic; previously conflicting code removed so theme-toggle is authoritative.

- Theme functions & wiring

  - `functions.php` —
    - Enqueues the new CSS files and the `theme-toggle.js` script.
    - Adds `force_ensure_account_pages()` which programmatically creates `/login`, `/account`, `/logout`, `/orders` pages (and assigns templates) when missing. This runs once and sets an option to avoid repeating.
    - Includes a temporary front-end trigger `?force_create_pages=1` for admins to force page creation (can be removed later).

- Misc
  - `header.php` — Updated header and mobile menu links to point to the newly-created pages (`/login`, `/account`, `/logout`) and ensured the theme toggle button remains present.

---

## Why these changes

- Dark mode: previously there were two scripts using different storage keys and initialization logic — `js/theme-toggle.js` and an existing `js/script.js`. This caused inconsistent theme state on some pages (notably product pages). The fix centralized behavior in `js/theme-toggle.js` and removed duplication.

- Account pages: `/account` and `/orders` were missing and producing 404s; `force_ensure_account_pages()` now creates those pages automatically if they don't exist and assigns appropriate templates, preventing missing-route errors.

- Cart & account UI: created modern, minimal, and responsive CSS to match the provided screenshots and improve the UX across devices.

---

## How to test (local)

1. Open WP admin and log in as an administrator.
2. If pages were not created automatically, force creation by visiting:

   http://localhost/force/?force_create_pages=1

   (This endpoint is admin-only. It will print a small confirmation and create pages if missing.)

3. Verify pages exist in WP admin → Pages: `/login`, `/account`, `/logout`, `/orders`.

4. Permalinks: if you still see 404s, go to WP admin → Settings → Permalinks and click Save Changes to flush rewrite rules.

5. Test flows:

   - Visit `/login`: you should see login + registration forms. Try registering a test user — registration will auto-login and redirect to `/account`.
   - Visit `/account` while logged in: you should see the profile card, quick links, and orders list (if any). If you are an admin and the page shows nothing, there will be an admin debug box with Page ID, slug and assigned template.
   - Visit `/orders`: lists the user's orders in a card grid.
   - Visit `/cart`: the cart page should use the new modern, two-column layout and behave normally (qty update, remove, apply coupon, proceed to checkout).
   - Toggle dark mode via the header button — the theme should switch and persist across pages.

6. Check Network tab to ensure these files are loaded:
   - `/css/account.css`
   - `/css/orders.css`
   - `/css/cart-custom.css`
   - `/js/theme-toggle.js`

---

## Notes & follow-ups

- Security: the registration form includes basic validation and nonce checks but is intentionally minimal. Consider adding reCAPTCHA or email verification for production.
- Cleanup: remove the temporary `?force_create_pages=1` endpoint after initial site setup (it’s in `functions.php`).
- Accessibility: buttons include `aria-pressed` for the theme toggle; further ARIA improvements are recommended for the account/orders UI.
- Styling polish: I added placeholder images and simple icons; if you want pixel-perfect matching to the screenshots I can:
  - Replace emojis with SVG icons from your `img/` folder, and
  - Tweak spacing/colors to match exact design tokens.

---

If you want I can now:

- Add sticky behavior to the cart summary on desktop.
- Add profile edit fields on the `/account` page.
- Improve registration to collect first/last name and save them to user meta.
- Remove the temporary page-creation trigger and keep everything tidy.

Tell me which of the follow-ups you prefer and I'll implement it.
