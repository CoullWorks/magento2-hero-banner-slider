# Troubleshooting Hero Banner Slider for Magento 2

## Nothing shows

1. Check **Enable** is Yes in [Configure](configure.md).
2. Check the banner (and the slider) is enabled, and the slider has enabled banners.
3. Flush the cache: `bin/magento cache:flush`.
4. Check the widget or content type has a banner or slider chosen.

## The arrows show empty squares

The icon font did not load. Deploy static content again (`bin/magento setup:static-content:deploy -f`), clear `pub/static` and the browser cache, and look in the network panel for a failed request to `slick.woff`. Versions before 2.1.1 pointed the font at the wrong folder, so update.

## A button in the overlay does not work

When a banner has a **Banner Link** and its overlay also contains a link or button, the banner link sits behind the overlay and the overlay button keeps its own address. Both should work. If the button is dead, check that the overlay HTML contains a real `<a href="...">` and that no other element covers it.

## Page Builder content types do not appear or will not open

The Hero Banner and Banner Slider need Adobe Commerce or Magento Open Source with Page Builder enabled (2.4.x). On 2.1.0 the settings could not be opened and the stage preview stayed empty, so update to 2.1.1 or later, then run `bin/magento setup:upgrade` and clear the cache.

## Images are not WebP, or are the wrong size

WebP needs PHP GD with WebP or Imagick. Delete `media/banner/image/cache/` to make the files again. See [Images](images.md).

## Access denied in the admin

Your role lacks a resource. See [Permissions and roles](permissions.md). After 2.1.0, uploading images needs **Save Banner**.

## The slider autoplays and I want it to stop

Not possible, the behaviour is fixed. See [How it behaves](behaviour.md).

## It does not work on Hyvä

Not supported. The module uses jQuery and RequireJS.
