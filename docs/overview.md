# Hero Banner Slider for Magento 2 documentation

Hero Banner Slider lets you manage a library of banners and sliders in the Magento admin, then place them wherever you need them: the homepage, a category, a CMS page or a static block.

It is free to use. The source is available under a **proprietary licence** for a single store you own or operate. It is not open source. Commercial redistribution, resale, or use in a paid service for someone else needs a licence from CoullWorks. The full text is in [LICENSE.txt](https://github.com/CoullWorks/magento2-hero-banner-slider/blob/main/LICENSE.txt).

![A Luma page with a hero banner and a slider placed by Page Builder](screenshots/hero-banner-slider-pagebuilder-storefront-1280.webp)

*A page built in Page Builder: a Hero Banner above a Banner Slider, as a shopper sees them.*

## Requirements

| Item | Supported |
|---|---|
| Magento | Open Source and Adobe Commerce 2.4.7, 2.4.8 and 2.4.9 |
| PHP | 8.2, 8.3, 8.4 and 8.5 |
| Page Builder | Content types for Magento_PageBuilder, bundled with 2.4.x |
| Theme | Luma, and custom themes with a jQuery and RequireJS storefront |
| Not supported | **Hyvä.** The module needs jQuery and RequireJS, which Hyvä does not use |

## What you get

- **Two Page Builder content types.** Drag a Hero Banner or a Banner Slider onto the stage and pick which one to show.
- **Two widgets.** The same banners and sliders for layout XML, CMS pages, category descriptions and static blocks.
- **Fast images.** Each banner takes a desktop image and a phone image. The module resizes them (1920 and 828 pixels) and serves WebP with an original-format fallback. The hero loads eagerly with `fetchpriority="high"`.
- **Layouts per placement.** Full width, full page height and parallax.
- **Overlay content.** A WYSIWYG overlay per banner for headings, copy and buttons.
- **A slider with fixed behaviour.** One slide at a time, autoplay every 4.5 seconds, a fade between slides, arrows, or a tabs strip under the slider. These are not settings. The module bundles the Slick carousel, self-hosted with no CDN.

## What it does not have

There are no admin settings for autoplay on or off, speed, arrows, dots, transition, loop, captions, link target, overlay position or colour, per placement images, or WebP and LCP toggles. Image handling is automatic. See [How it behaves](behaviour.md) for exactly what is fixed.

## Where to go next

| You want to | Read |
|---|---|
| Add the module | [Install](install.md) |
| See a banner on a page in five minutes | [Get started](get-started.md) |
| Find the Enable setting | [Configure](configure.md) |
| Create banners, images and overlays | [Banners](banners.md) |
| Group banners into a slider | [Sliders](sliders.md) |
| Place them with widgets | [Widgets](widgets.md) |
| Place them with Page Builder | [Page Builder](page-builder.md) |
| Let an editor manage banners without full admin access | [Permissions and roles](permissions.md) |
| Move from the old BoxLeaf module | [Migration](migration.md) |
| Sizes, WebP, desktop and phone images | [Images](images.md) |
| Autoplay, tabs, parallax, two sliders on a page | [How it behaves](behaviour.md) |
| Style it | [CSS hooks](css-hooks.md) |
| Tables, routes, layout handles, API | [Reference](reference.md) |
| Fix something | [Troubleshooting](troubleshooting.md) |
| Update | [Upgrade](upgrade.md) and the [changelog](changelog.md) |
