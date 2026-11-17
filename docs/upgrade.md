# Upgrade Hero Banner Slider for Magento 2

## Update

```bash
composer update coullworks/module-banner-slider
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f
bin/magento cache:flush
```

The last three lines are for production mode. Your banners and sliders are kept.

## From 2.1.0 to 2.1.1

- Page Builder works end to end: the settings of Hero Banner and Banner Slider open and save, and the stage shows a preview.
- The module's permissions now sit under Content in the roles tree. Existing roles keep what they had. For a new role, tick the module's View resource and Content is selected with it.
- Both admin grids show each record on its own row, the Slides list offers only enabled banners, and the slider arrows use the bundled Slick font. Run `setup:static-content:deploy -f` in production mode.

## From 2.0.x to 2.1.0

- **Roles need the new permissions.** Controllers now check View, Save, Update and Delete for banners and sliders separately, and image upload needs Banner > Save. Give non administrator roles what they need. See [Permissions and roles](permissions.md).
- `setup:upgrade` drops the unused `full_width` column from both tables.
- The **Enable** setting now works.
- Widgets and Page Builder content types now render. A disabled or deleted banner no longer shows in a slider.
- Cached WebP files from earlier versions are made again.

## From the BoxLeaf module

See [Migration](migration.md).
