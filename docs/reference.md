# Hero Banner Slider reference: tables, routes, API and layouts

## Tables: banners

`coullworks_banner_slider_banners`: `banners_id` (primary key), `enabled`, `banner_name`, `banner_link`, `show_banner_overlay`, `banner_overlay_content`, `banner_image`, `banner_image_mobile`. The unused `full_width` column was removed in 2.1.0.

## Tables: sliders

`coullworks_banner_slider_bannerslider`: `bannerslider_id` (primary key), `enabled`, `slider_name`, `slides` (a JSON list of banner ids, 255 characters, so about 40 to 50 banners).

## Admin route

The admin front name is `coullworks_banner_slider`, with controllers `banners` and `bannerslider` (index, new, edit, save, delete, inline edit) and `upload/image`.

## Layout handles

The admin handles are `coullworks_banner_slider_banners_index`, `_new` and `_edit`, and `coullworks_banner_slider_bannerslider_index`, `_new` and `_edit`. The `adminhtml` default handle loads `coullworks-admin.css` for the CoullWorks tab logo.

## PHP service contract

`BannersRepositoryInterface` and `BannerSliderRepositoryInterface`, with data and search result interfaces, are available for PHP code. There is no REST or GraphQL API.

## CLI, cron and events

The module has no CLI commands, no cron jobs and no events or observers. WebP files are made on first request.

## Licence

Proprietary, source available for a single store you own or operate. Free to use. Not open source. Commercial redistribution, resale or paid service use needs a licence. See [LICENSE.txt](https://github.com/CoullWorks/magento2-hero-banner-slider/blob/main/LICENSE.txt).
