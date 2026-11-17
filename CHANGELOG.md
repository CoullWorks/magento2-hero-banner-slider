# Changelog

All notable changes to this project are documented here, based on
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.3] - 2026-11-17

### Added
- A `docs/` folder with the full documentation as plain markdown, with screenshots, so it can be read on GitHub as well as on coullworks.com.
- A `.gitattributes` so the Composer package leaves out the docs and development files.

## [2.1.2] - 2026-11-16

A small fix release, checked in a browser on a live Magento 2.4.9 install.

### Fixed
- **Slider arrows were effectively invisible on Luma.** They were white at 75 percent
  opacity and sat 25px outside the slider, so they landed on the white page margin. They now
  sit inside the slider on a solid, semi-opaque dark disc with a white glyph (40px, 36px on a
  phone), with a hover state and a focus ring, and read on a light page and over dark
  photographs. The markup and the CSS class names are unchanged; with tabs on there are still
  no arrows.
- **The delete dialog on the Banner and Slider forms used stock text** ("Are you sure you
  want to do this?"). It now names the record, as the grid dialog does: `Delete "<name>"?`.

## [2.1.1] - 2026-11-16

A defect-fix release. Every fix below was checked in a browser on a live Magento 2.4.9
install.

### Upgrade notes
- **Page Builder works from this release.** In 2.1.0 the Hero Banner and Banner Slider
  content types could be dropped on the stage, but their settings could not be opened and
  the stage preview stayed empty, so the 2.1.0 notes and README overstated Page Builder
  support. Both now work end to end (see Fixed).
- The module's resources now sit under *Content* in the roles tree. Existing roles keep
  what they had; a role that sees the menu today still sees it. A new role only needs the
  module's *View* resource ticked, because the tree selects *Content* with it.
- Hyvä is not supported: the module is jQuery and RequireJS only.

### Fixed
- **Page Builder settings could not be opened.** Opening the settings of a dropped Hero
  Banner or Banner Slider threw "Cannot read properties of undefined (reading
  'breakpoints')". Both forms now carry the `appearance` field Page Builder expects, and
  each has the `pagebuilder_coullworks_<type>_form` layout handle Page Builder loads the
  form from, so the full settings panel (the module's options plus the standard
  alignment, border, margin, padding and CSS class settings) opens and saves.
- **Page Builder stage preview was empty.** A stage renderer is now registered for both
  content types, so the chosen banner or slider shows on the stage, with admin styles for
  the preview.
- **Both admin grids showed every row as the last record** on Magento 2.4.9. The listings
  now set the data storage `indexField`, so each row is its own record.
- **The Slides list offered disabled banners** while saying "Only enabled banners are
  shown". It now lists only enabled banners, as does the banner picker in Page Builder.
  A banner that is disabled after being added to a slider drops out of the list the next
  time the slider is saved.
- **Slider arrows were blank.** The Slick font files shipped as empty files and the
  stylesheet pointed at the theme's `fonts/` and `images/` folders, which 404. The real
  Slick font files (MIT) are now bundled and referenced from the module, with no CDN, and
  the arrow and dot glyphs are written as CSS escapes.
- **A link inside a banner overlay broke the layout** when the banner also had its own
  link, because anchors cannot nest. The banner link is now a stretched link behind the
  overlay in that case, so both the banner and the overlay button work.
- **The menu item needed an extra permission.** The module's menu sits under *Content*,
  but its permission node did not, so a role also needed *Content* ticked by hand. The
  permission tree now nests the module under *Content*.
- **Admin page titles**: the Banner Sliders grid was titled "BannerSlider" and the edit
  pages "Bannersliders" and "Bannerss"; they now read "Banner Sliders", "Edit Banner
  Slider", "Banners" and "Edit Banner".

## [2.1.0] - 2026-11-16

A defect-fix release found by auditing the module against a live Magento 2.4.9 install.
Every change below was checked in a browser on that install, including the upgrade from
2.0.1.

### Upgrade notes
- **Roles now need the per-action permissions.** The admin controllers used to check only
  the top-level resource. They now check View, Save, Update and Delete (for banners and
  sliders separately), and image upload needs Banner > Save. Non-administrator roles that
  worked before must be given the resources they need under *System > Permissions > User
  Roles*.
- `setup:upgrade` drops the unused `full_width` column from both tables. Nothing read it.
  Banners and sliders are otherwise untouched.
- Hyvä is not supported: the module is jQuery and RequireJS only.

### Fixed
- **Widgets and Page Builder content types rendered nothing.** The blocks did not
  implement the widget `BlockInterface`, so Magento's widget filter dropped them. They
  now render.
- **The Enable setting did nothing.** With *Stores > Configuration > CoullWorks > Banner
  Slider > Enable* set to No, the hero, slider widget and both Page Builder content
  types now render nothing on the storefront. The admin still opens, and the Page Builder
  stage preview still shows the banner.
- **A disabled banner no longer shows inside an enabled slider**, nor does a banner that
  has been deleted (which used to be a fatal error). The tabs strip matches.
- **Two sliders on one page now work.** Slick was bound to the global `.slider` and
  `.tabs` selectors; each hero and slider now has its own id and is initialised alone.
- **Parallax now runs on sliders** as well as on the hero, and applies once on load
  (it used a jQuery `ready` event that never fires).
- **WebP files were not WebP.** The image adapter wrote JPEG data under a `.webp` name.
  Files are now encoded as real WebP with GD or Imagick, and cached files from earlier
  versions are regenerated.
- **Editing a banner now refreshes cached pages** that show it, including every slider
  that contains it. Saving a slider refreshes pages that show the slider.
- **Admin grids showed duplicated rows.** The grid data sources named the collection as
  their resource model, so rows came back without an id.
- **Admin permissions are enforced per action** (see the upgrade notes), and the image
  upload endpoint no longer allows any administrator.
- **Banner Sliders grid**: the Enabled column was labelled "Slider Name" and is now a
  Yes/No column. The delete confirmation dialogs on both grids named a field that does
  not exist; they now name the record.
- **Banner form**: both image fields showed the placeholder "Some notice."; they now
  give the real file rules and the 768px breakpoint.
- **Slider form**: banners keep the order you select them in. Before, they were saved in
  list order whatever you clicked, although the README promised an order.
- **Widget list**: the widgets are labelled "Hero Banner (CoullWorks)" and "Banner Slider
  (CoullWorks)" so they can be told apart from other modules.

### Changed
- Removed the unused `full_width` database column from both tables, through the module's
  declarative schema (the whitelist is now shipped).
- Migrated banners from `boxleafdigital/module-bannerslider` keep their images: the old
  module used the same `banner/image/` media folder, and a leading slash in an old mobile
  image path is handled.

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
