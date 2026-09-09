/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */
var config = {
    paths: {
        parallax: 'CoullWorks_BannerSlider/js/parallax',
        slider: 'CoullWorks_BannerSlider/js/slider',
        slick: 'CoullWorks_BannerSlider/js/vendor/slick.min'
    },
    shim: {
        parallax: { deps: ['jquery'] },
        slick: { deps: ['jquery'] }
    }
};
