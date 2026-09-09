/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */
define(['uiComponent', 'jquery'], function (Component, $) {
    'use strict';

    return Component.extend({
        initialize: function (config, node) {
            var self = this,
                img = $(node),
                imgParent = img.parent();

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
            var speed = img.data('speed') || -1,
                imgY = imgParent.offset().top,
                winY = $(document).scrollTop(),
                winH = $(document).height(),
                parentH = imgParent.innerHeight(),
                winBottom = winY + winH,
                imgPercent = 0;

            // Only transform while the block is within the viewport.
            if (winBottom > imgY && winY < imgY + parentH) {
                var imgBottom = (winBottom - imgY) * speed,
                    imgTop = winH + parentH;

                imgPercent = ((imgBottom / imgTop) * 100) + (50 - (speed * 50));
            }

            img.css({
                top: imgPercent + '%',
                transform: 'translate(-50%, -' + imgPercent + '%)'
            });
        }
    });
});
