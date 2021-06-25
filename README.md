# Mage2 Module BoxLeafDigital BannerSlider

From  [boxleaf Digital](https://www.boxleafdigital.com)
Read our article [boxleaf Digital hero banner module](https://www.boxleafdigital.com/magento-2-hero-banner-and-slider/)

    ``boxleafdigital/module-bannerslider``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities

Magento 2 banner slider gives you the abillity to add bother banners and sliders to page content using widgets.

Both Sliders and Hero banners, can be parallax, full width or full height or NOT. Configure the widgets to suit your needs.

The sliders also give you the ability to show the banner names below the slider as a linked slider.. 

## Installation


### Type 1: Zip file

  - Go to releases download the lates.
 - Unzip the zip file in `app/code/BoxLeafDigital`
 - Enable the module by running `php bin/magento module:enable BoxLeafDigital_BannerSlider`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 -  Run the following commands
```bash
composer config repositories.productpricelist vcs https://github.com/danrcoull/magento2-hero-banner-slider.git
composer require boxleafdigital/module-bannerslider:^1.0.1
```
 -  Followed by the below to enable the module in magento 2
```bash
php bin/magento module:enable BoxLeafDigital_BannerSlider
php bin/magento setup:upgrade
php bin/magento setup:di:compile #yes do this we use extension attributes so you can see the original price and the custom price.
php bin/magento setup:static-content:deploy en_GB en_US -f 
php bin/magento cache:flush
```
 


## Configuration

 - Enable (banner_slider/general/enable)


## Specifications

 - Widget
	- heroBanner

 - Widget
	- bannerSlider

 - Block
	- Banner\Slider > banner/slider.phtml

 - Block
	- Banner\Hero > banner/hero.phtml



Yes i work hard, plenty more modules to come feel free to by me a coffee below. 

[![Buy Me A Coffee](https://cdn.buymeacoffee.com/buttons/lato-black.png)](https://www.buymeacoffee.com/BHaNOMl)


Other Modules:

[Magento 2 - Custom Customer Quote Lists](https://github.com/danrcoull/Magento2-Product-Price-List)
[Magento 2 - Infinate Scroll](https://github.com/danrcoull/magento2-catalog-infinite-scroll)

