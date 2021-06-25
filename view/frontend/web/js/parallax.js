/*
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  29/01/2020, 18:15 Daniel Coull
 *   @version   1.0.0
 *
 */

define(['uiComponent', 'jquery'],
    function (Component, $) {
        'use strict';
        return Component.extend({
            initialize: function (config, node) {
                let self = this;
                var img = $(node);
                var imgParent = $(node).parent();
                $(document).on({
                    scroll: function () {
                        self.parallaxImage(img, imgParent);
                    },
                    ready: function () {
                        self.parallaxImage(img, imgParent);
                    }
                });
            },
            parallaxImage: function (img, imgParent) {
                var speed = img.data('speed') || -1;
                var imgY = imgParent.offset().top;
                var winY = $(document).scrollTop();
                var winH = $(document).height();
                var parentH = imgParent.innerHeight();


                // The next pixel to show on screen
                var winBottom = winY + winH;

                // If block is shown on screen
                if (winBottom > imgY && winY < imgY + parentH) {
                    // Number of pixels shown after block appear
                    var imgBottom = ((winBottom - imgY) * speed);
                    // Max number of pixels until block disappear
                    var imgTop = winH + parentH;
                    // percentage between start showing until disappearing
                    var imgPercent = ((imgBottom / imgTop) * 100) + (50 - (speed * 50));
                }
                img.css({
                    top: imgPercent + '%',
                    transform: 'translate(-50%, -' + imgPercent + '%)'
                });
            }
        });
    });