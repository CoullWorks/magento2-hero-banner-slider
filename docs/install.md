# Install Hero Banner Slider for Magento 2

## Requirements

| Item | Supported |
|---|---|
| Magento | Open Source and Adobe Commerce 2.4.7, 2.4.8 and 2.4.9 |
| PHP | 8.2, 8.3, 8.4 and 8.5 |
| Page Builder | Content types for Magento_PageBuilder, bundled with 2.4.x |
| Theme | Luma, or a custom jQuery and RequireJS theme. **Hyvä is not supported.** |
| WebP | PHP GD with WebP support, or Imagick. Without either, the original image format is served |

The package is `coullworks/module-banner-slider` and the module is `CoullWorks_BannerSlider`. It loads after `Magento_Backend`, `Magento_Cms`, `Magento_Widget` and `Magento_Ui`.

## Steps

```bash
composer require coullworks/module-banner-slider
bin/magento module:enable CoullWorks_BannerSlider
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f
bin/magento cache:flush
```

`setup:di:compile` and `setup:static-content:deploy` are for production mode only.

## Check it worked

Log in to the admin. **Content** now has a **CoullWorks Banner Slider** entry with **Banners** and **Banner Sliders** under it, and the Page Builder panel lists **Hero Banner** and **Banner Slider**. Go on to [Get started](get-started.md).

## Coming from the old BoxLeaf module

See [Migration](migration.md). Your banners and sliders are copied on `setup:upgrade`.
