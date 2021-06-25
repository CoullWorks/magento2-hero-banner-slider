/*
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  29/01/2020, 18:20 Daniel Coull
 *   @version   1.0.0
 *
 */

var config = {
    paths: {
        parallax: 'BoxLeafDigital_BannerSlider/js/parallax',
        slider: 'BoxLeafDigital_BannerSlider/js/slider',
        slick : '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min'
    },
    shim: {
        parallax: {
            deps: ['jquery']
        },
        slick: {
            deps: ['jquery']
        }
    }
};
