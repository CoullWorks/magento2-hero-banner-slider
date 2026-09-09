/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */

/*eslint-disable */
/* jscs:disable */

function _inheritsLoose(subClass, superClass) { subClass.prototype = Object.create(superClass.prototype); subClass.prototype.constructor = subClass; _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

define([
    "Magento_PageBuilder/js/mass-converter/widget-directive-abstract",
    "Magento_PageBuilder/js/utils/object"
], function (_widgetDirectiveAbstract, _object) {
    /**
     * Store the CoullWorks Hero Banner content type settings as a {{widget}} directive
     * targeting the module's existing HeroBanner widget block.
     *
     * @api
     */
    var WidgetDirective = /*#__PURE__*/function (_widgetDirectiveAbstr) {
        "use strict";

        _inheritsLoose(WidgetDirective, _widgetDirectiveAbstr);

        function WidgetDirective() {
            return _widgetDirectiveAbstr.apply(this, arguments) || this;
        }

        var _proto = WidgetDirective.prototype;

        /**
         * Convert the stored directive back into form data.
         *
         * @param {object} data
         * @param {object} config
         * @returns {object}
         */
        _proto.fromDom = function fromDom(data, config) {
            var attributes = _widgetDirectiveAbstr.prototype.fromDom.call(this, data, config);

            data.banner_id = attributes.banner_id;
            data.full_width = attributes.full_width;
            data.is_parallax = attributes.is_parallax;
            data.full_height = attributes.full_height;

            return data;
        }
        /**
         * Convert the form data into the {{widget}} directive.
         *
         * @param {object} data
         * @param {object} config
         * @returns {object}
         */
        ;

        _proto.toDom = function toDom(data, config) {
            var attributes = {
                type: "CoullWorks\\BannerSlider\\Block\\Widget\\HeroBanner",
                template: "banner/hero.phtml",
                type_name: "CoullWorks Hero Banner",
                banner_id: data.banner_id,
                full_width: data.full_width,
                is_parallax: data.is_parallax,
                full_height: data.full_height
            };

            if (!attributes.banner_id) {
                return data;
            }

            (0, _object.set)(data, config.html_variable, this.buildDirective(attributes));

            return data;
        };

        return WidgetDirective;
    }(_widgetDirectiveAbstract);

    return WidgetDirective;
});
