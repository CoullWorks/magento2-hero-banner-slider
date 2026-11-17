# Migrate from the BoxLeaf banner slider to Hero Banner Slider

Version 2.0.0 is a rebrand of `boxleafdigital/module-bannerslider`. The package, module, namespace, admin route and table names all changed, so it installs as a **new module** next to the old one. A data patch copies your banners and sliders across.

## What is copied

The patch `MigrateFromBoxLeafDigital` copies the rows of two tables:

| Old table | New table |
|---|---|
| `boxleafdigital_bannerslider_banners` | `coullworks_banner_slider_banners` |
| `boxleafdigital_bannerslider_bannerslider` | `coullworks_banner_slider_bannerslider` |

Only the columns both tables share are copied, and the **ids are kept**. A widget or Page Builder item that points at banner 3 still points at banner 3.

## When it runs and when it skips

It runs once, during `setup:upgrade`. For each table pair it skips if the old table is missing or the new table already has any rows, so it never overwrites and is safe on a fresh install. It is the module's only data patch.

## Images

The patch copies database rows only. The old module stored images in the same `media/banner/image/` folder, so migrated banners keep their images from 2.1.0 onward, including old mobile image paths that began with a slash. Check one banner after migrating.

## Manual steps

1. Back up the database.
2. Note where your content places the old widgets. Old widget instances and `{{widget}}` directives name the old module's class and are not rewritten.
3. Install the new module: `composer require coullworks/module-banner-slider`.
4. `bin/magento module:enable CoullWorks_BannerSlider` and `bin/magento setup:upgrade`. The data is copied here.
5. Check **Content, CoullWorks Banner Slider** lists your banners and sliders.
6. Replace each old widget with a **Hero Banner (CoullWorks)** or **Banner Slider (CoullWorks)** widget, or a Page Builder content type.
7. Remove the old module: `bin/magento module:disable BoxLeafDigital_BannerSlider`, then `composer remove boxleafdigital/module-bannerslider`, then `bin/magento setup:upgrade` and `bin/magento cache:flush`.

Leave the old tables in place until you are happy, they are not removed for you.
