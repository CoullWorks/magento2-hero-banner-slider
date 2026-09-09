# Changelog

All notable changes to this project are documented here, based on
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-09-08

The first CoullWorks release — a full rebrand and modernization of the original
`boxleafdigital/module-bannerslider`. **Breaking**: the package, module, namespace and
DB tables are renamed, so it installs as a new module. Existing banner data is migrated
automatically (see below).

### Added
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
- **Mobile banner image now saves.** The "keep existing image" path for the mobile image
  omitted the `/` from `ltrim`, storing a leading-slash path that then resolved to the site
  root (404) on the frontend. Desktop + mobile now share one `resolveImagePath()` helper and
  always store a correct relative path. (Resolves the long-standing report.)
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

[2.0.0]: https://github.com/CoullWorks/magento2-hero-banner-slider/releases/tag/v2.0.0
