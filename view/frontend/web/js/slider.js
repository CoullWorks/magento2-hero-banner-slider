/*
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  31/01/2020, 21:31 danrcoull
 *   @version   1.0.0
 *
 */

define(['uiComponent', 'jquery','slick'],
    function (Component, $) {
        'use strict';
        return Component.extend({
            initialize: function (config, node) {
                $(node).slick(config);
            }
        });
    });