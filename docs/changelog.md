# Hero Banner Slider for Magento 2 changelog

Newest first. The format follows Keep a Changelog and Semantic Versioning.

## 2.1.2, 16 November 2026

A small fix release, checked in a browser on a live Magento 2.4.9 install.

**Fixed**

- Slider arrows were effectively invisible on Luma. They were white at 75 percent opacity and sat 25 pixels outside the slider, on the page margin. They now sit inside the slider on a dark semi-opaque disc with a white arrow (40 pixels, 36 on a phone), with a hover state and a focus ring. The markup and CSS class names are unchanged, and with tabs on there are still no arrows.
- The delete dialog on the Banner and Slider forms used stock text. It now names the record, as the grid dialog does.

## 2.1.1, 16 November 2026

A defect fix release. Every fix was checked in a browser on a live Magento 2.4.9 install.

**Upgrade notes**

- Page Builder works from this release. In 2.1.0 the Hero Banner and Banner Slider content types could be dropped on the stage, but their settings could not be opened and the stage preview stayed empty. Both now work end to end.
- The module's permissions now sit under Content in the roles tree. Existing roles keep what they had. A new role only needs the module's View resource ticked, because the tree selects Content with it.
- Hyvä is not supported.

**Fixed**

- Page Builder settings could not be opened. Both forms now carry the appearance field and the layout handle Page Builder loads them from, so the full settings panel opens and saves.
- The Page Builder stage preview was empty. The chosen banner or slider now shows on the stage.
- Both admin grids showed every row as the last record on Magento 2.4.9. Each row is now its own record.
- The Slides list offered disabled banners while saying only enabled banners are shown. It now lists only enabled banners, and so does the banner picker in Page Builder.
- Slider arrows were blank. The real Slick font files are now bundled and referenced from the module, with no CDN.
- A link inside a banner overlay broke the layout when the banner also had its own link. The banner link is now a stretched link behind the overlay, so both work.
- The menu item needed an extra permission. The module now sits under Content in the permission tree.
- Admin page titles read Banner Sliders, Edit Banner Slider, Banners and Edit Banner.

## 2.1.0, 16 November 2026

A defect fix release from an audit on Magento 2.4.9.

**Upgrade notes**

- Roles now need the per action permissions. Controllers check View, Save, Update and Delete for banners and sliders, and image upload needs Banner > Save. See [Permissions and roles](permissions.md).
- `setup:upgrade` drops the unused `full_width` column from both tables.
- Hyvä is not supported.

**Fixed**

- Widgets and Page Builder content types rendered nothing.
- The Enable setting did nothing. It now switches every placement off.
- A disabled or deleted banner no longer shows in a slider or its tabs.
- Two sliders on one page now work, each with its own id.
- Parallax now runs on sliders.
- WebP files are now real WebP.
- Editing a banner or slider refreshes the cached pages that show it.
- Delete confirmations name the record, the sliders grid Enabled column has the right label, and the image fields show the real file rules.
- Slider banners keep the order you select them in.
- The widgets are labelled Hero Banner (CoullWorks) and Banner Slider (CoullWorks).

**Changed**

- Migrated banners keep their images.

## 2.0.1, 28 September 2026

PHP 8.5 support, so the module installs on Magento 2.4.9. The Composer constraint now includes `~8.5.0`. No code changes were needed.

## 2.0.0, 8 September 2026

The first CoullWorks release, a rebrand and modernisation of `boxleafdigital/module-bannerslider`. Breaking: the package, module, namespace and tables are renamed, so it installs as a new module. Existing banner data is migrated automatically.

- Responsive WebP banner images for fast LCP, with the hero image loaded eagerly.
- Page Builder content types for Hero Banner and Banner Slider.
- Automatic data migration on `setup:upgrade`.
- The Slick carousel is self-hosted, with no third-party CDN request at runtime.
- Package `coullworks/module-banner-slider`, module `CoullWorks_BannerSlider`.
