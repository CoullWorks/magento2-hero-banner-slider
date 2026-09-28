# Changelog

All notable changes to this project are documented here, based on
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.1] - 2026-09-28

### Changed
- **PHP 8.5 support, so the module installs on Magento 2.4.9.** Adobe Commerce and
  Magento Open Source 2.4.9 run production on PHP 8.5, which the Composer constraint did
  not allow, so the package would not install there. The constraint now includes
  `~8.5.0`, and CI lints every PHP file on 8.5 as well as 8.2, 8.3 and 8.4. No code
  changes were needed: every file lints clean on PHP 8.5.11, and none uses the casts,
  backtick operator or `__sleep`/`__wakeup` that 8.5 deprecates.

## [2.0.0] - 2026-09-08

The first CoullWorks release — a full rebrand and modernization of the original
`boxleafdigital/module-bannerslider`. **Breaking**: the package, module, namespace and
DB tables are renamed, so it installs as a new module. Existing banner data is migrated
automatically (see below).

### Added
- **Responsive, WebP banner images for fast LCP.** Hero/slider images are resized to
  desktop (1920px) and mobile (828px) widths and re-encoded as **WebP** (with an
  original-format fallback), generated on demand and cached under
  `media/banner/image/cache/`. The `<picture>` serves the right size per breakpoint, the
  hero image loads eagerly with `fetchpriority="high"` (it was `loading="lazy"`, which
  delayed LCP), and the overlay typography is now responsive on phones.
- **Page Builder content types** — drag-and-drop **Hero Banner** and **Banner Slider**
  content types, reusing the widget rendering, so banners/sliders can be placed directly
  on a Page Builder stage.
- **Automatic data migration** — on `setup:upgrade`, rows from the old
  `boxleafdigital_bannerslider_*` tables are copied into the new
  `coullworks_banner_slider_*` tables (idempotent; safe on a fresh install).
- **CoullWorks admin branding** on the configuration tab.
- Unit tests, a Magento 2 `phpcs` ruleset, and GitHub Actions CI.

### Changed
- **Rebranded to CoullWorks.** `boxleafdigital/module-bannerslider` →
  `coullworks/module-banner-slider`; module `BoxLeafDigital_BannerSlider` →
  `CoullWorks_BannerSlider`; namespace `BoxLeafDigital\BannerSlider` →
  `CoullWorks\BannerSlider`; admin route/ACL/menu → `coullworks_banner_slider`; tables →
  `coullworks_banner_slider_*`.
- **Modernized for Magento 2.4.7–2.4.9 / PHP 8.2–8.4** — `declare(strict_types=1)`,
  typed signatures, constructor property promotion, and **all `ObjectManager` usage
  removed** from the admin controllers in favour of constructor injection.
- **Self-hosted the Slick carousel** — no more third-party CDN request at runtime.
- Dropped the dead `Magento_StoreGraphQl` + `BoxLeafDigital_Core` module sequences and the
  invalid `minimum-stability: dev` / hardcoded `version` from `composer.json`.
- Relicensed under the CoullWorks Proprietary License (rebranded from the BoxLeafDigital
  terms). Still source-available, not royalty-free.

### Fixed
- **Banner images now save on Magento 2.4.6+.** The admin controllers use Magento's shared
  Catalog `ImageUploader`, whose media-gallery synchronization plugin stat-ed the moved file
  at the media root and aborted the whole save with a `stat failed` error. Moving the file
  with `moveFileFromTmp($name, true)` returns the full `banner/image/...` path so the plugin
  finds it — saves complete and both images persist. (Found in live 2.4.7 testing.)
- **Mobile banner image now saves.** The "keep existing image" path for the mobile image
  omitted the `/` from `ltrim`, storing a leading-slash path that then resolved to the site
  root (404) on the frontend. Desktop + mobile now share one `resolveImagePath()` helper and
  always store a correct relative path. (Resolves the long-standing report.)
- **Admin grids now open.** The controllers referenced an `ADMIN_RESOURCE` of
  `CoullWorks_BannerSlider::top_level` that was never declared in `acl.xml`, so Magento denied
  access and redirected to the dashboard. Declared it (as the parent ACL resource) and aligned
  the menu, so the grids open and permissions apply. (Found in live 2.4.7 testing.)
- **Admin ACL now resolves.** The config/menu ACL ids were inconsistent
  (`BoxLeaf_BannerSlider` vs `BoxLeafDigital_BannerSlider`, `config_boxleaf_*` vs
  `config_boxleafdigital_*`); unified so permissions apply correctly, and the grids are
  gated by their own ACL resources.
- **Output escaping (XSS).** Banner links, names/alt/title and image URLs are now escaped in
  the frontend templates; the WYSIWYG overlay stays intentionally raw.
- Parallax no longer applies an `undefined` transform when a banner is off-screen.

### Migration from `boxleafdigital/module-bannerslider`
1. `composer remove boxleafdigital/module-bannerslider` and
   `bin/magento module:disable BoxLeafDigital_BannerSlider`.
2. `composer require coullworks/module-banner-slider`.
3. `bin/magento module:enable CoullWorks_BannerSlider && bin/magento setup:upgrade` — your
   banners and sliders are copied into the new tables automatically.
4. Re-insert the widgets / add the Page Builder content types where you had them (the old
   widget instances reference the old class name).

## 1.0.3 - 2021-06-25
- Final release under the original `boxleafdigital/module-bannerslider` name.

[2.0.1]: https://github.com/CoullWorks/magento2-hero-banner-slider/releases/tag/v2.0.1
[2.0.0]: https://github.com/CoullWorks/magento2-hero-banner-slider/releases/tag/v2.0.0
