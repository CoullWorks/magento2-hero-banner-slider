<p align="center">
  <img src="assets/banner.png" alt="CoullWorks Banner Slider for Magento 2" width="820">
</p>

<h1 align="center">Banner Slider</h1>

<p align="center">
  <b>Hero banners &amp; sliders for Magento 2 — managed in the admin, placed anywhere.</b><br>
  Build responsive hero banners and multi-slide carousels, then drop them onto any page
  with native <b>Page Builder content types</b> or classic widgets — with parallax,
  full-width / full-height layouts, an overlay WYSIWYG, and a self-hosted Slick carousel.
</p>

<p align="center">
  <a href="https://github.com/CoullWorks/magento2-hero-banner-slider/releases/latest"><img src="https://img.shields.io/github/v/release/CoullWorks/magento2-hero-banner-slider?label=version&color=ff6a2c" alt="latest release"></a>
  <img src="https://img.shields.io/badge/Magento-2.4.7%20–%202.4.9-f46f25" alt="Magento 2.4.7–2.4.9">
  <img src="https://img.shields.io/badge/PHP-8.2%20|%208.3%20|%208.4%20|%208.5-777bb4" alt="PHP 8.2–8.5">
  <img src="https://img.shields.io/badge/license-proprietary-lightgrey" alt="proprietary">
</p>

> **Proprietary — © CoullWorks.** Source-available for a single store you own; not
> royalty-free. Commercial redistribution or resale needs a licence. See [LICENSE.txt](LICENSE.txt).

---

Manage a library of banners and sliders in the Magento admin, then place them wherever you
need them — the homepage, a category, a CMS page, a static block — using **Page Builder**
or widgets. Every banner supports a desktop and a mobile image, an optional link, and an
optional WYSIWYG overlay; sliders group banners into an autoplaying carousel with optional
thumbnail navigation.

## Features

- **Two Page Builder content types** — drag a **Hero Banner** or **Banner Slider** straight
  onto the stage and pick which one to show, no code.
- **Two widgets** — the same banners/sliders as classic widgets for layout XML, CMS pages
  and static blocks.
- **Fast LCP** — banner images are auto-resized (desktop + mobile) and served as **WebP**
  with an original-format fallback via `<picture>`; the hero loads eagerly with
  `fetchpriority="high"`, and overlay typography is responsive on phones.
- **Responsive images** — separate desktop and mobile images via `<picture>`.
- **Layouts** — full width, full page height, and a **parallax** effect, per placement.
- **Overlay content** — a WYSIWYG overlay per banner (headings, copy, buttons).
- **Slider carousel** — autoplay, fade, and optional thumbnail tabs (Slick), **self-hosted
  — no third-party CDN**.
- Built for **Magento 2.4.7–2.4.9 / PHP 8.2–8.5** with typed, DI-clean code.

## Install

```sh
composer require coullworks/module-banner-slider
bin/magento module:enable CoullWorks_BannerSlider
bin/magento setup:upgrade
bin/magento setup:di:compile            # production mode only
bin/magento setup:static-content:deploy -f   # production mode only
bin/magento cache:flush
```

Upgrading from the old `boxleafdigital/module-bannerslider`? See
[CHANGELOG.md](CHANGELOG.md) — your existing banners are migrated automatically on
`setup:upgrade`.

## Managing banners &amp; sliders

**Content → CoullWorks Banner Slider → Banners** — create a banner: name, enable, desktop
image, mobile image, link, and (optionally) an overlay with WYSIWYG content.

**Content → CoullWorks Banner Slider → Banner Sliders** — create a slider: name, enable,
and pick the banners it contains (in order).

## Placing them

**Page Builder** — in the editor's left panel, drag **Hero Banner** or **Banner Slider**
onto the stage, then choose the banner/slider and options (full width/height, parallax,
tabs) in the panel.

**Widget** — Content → Widgets → Add Widget → *Hero Banner (CoullWorks)* or
*Banner Slider (CoullWorks)*; or via layout XML / a `{{widget}}` directive in a CMS block.

| Option | Applies to | What it does |
|---|---|---|
| **Full Width** | banner, slider | Break the banner out to the full viewport width. |
| **Full Page Height** | banner, slider | Make the banner fill the viewport height. |
| **Parallax** | banner, slider | Apply a scroll parallax to the image. |
| **Show Tabs** | slider | Show a thumbnail-name strip under the slider as navigation. |

## Configuration

**Stores → Configuration → CoullWorks → Banner Slider** — a global enable toggle. Everything
else is per banner/slider in the admin grids.

## Compatibility

| | |
|---|---|
| **Magento** | Open Source / Adobe Commerce 2.4.7, 2.4.8, 2.4.9 |
| **PHP** | 8.2, 8.3, 8.4, 8.5 |
| **Page Builder** | Content types for Magento_PageBuilder (bundled with 2.4.x) |

## Third-party

Bundles the **Slick** carousel (v1.9.0, MIT, © Ken Wheeler), self-hosted under
`view/frontend/web/js/vendor/`. See [THIRD-PARTY-LICENSES.md](THIRD-PARTY-LICENSES.md).

## License

**Proprietary © CoullWorks.** Source-available for a single store you own or operate; not
royalty-free. Commercial use, resale or redistribution requires a licence — enquiries:
**ttechitsolutions@gmail.com**. Full terms in [LICENSE.txt](LICENSE.txt).

---

<p align="center">
  <a href="https://coullworks.com"><b>⚓ Powered by CoullWorks</b></a><br>
  <sub>Built by <a href="https://coullworks.com">CoullWorks</a> — web &amp; software engineering. <a href="https://coullworks.com">coullworks.com</a></sub>
</p>
