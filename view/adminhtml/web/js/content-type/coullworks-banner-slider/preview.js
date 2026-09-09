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
    "jquery",
    "knockout",
    "mage/translate",
    "Magento_PageBuilder/js/widget-initializer",
    "underscore",
    "Magento_PageBuilder/js/config",
    "Magento_PageBuilder/js/content-type-menu/hide-show-option",
    "Magento_PageBuilder/js/utils/object",
    "Magento_PageBuilder/js/content-type/preview"
], function (_jquery, _knockout, _translate, _widgetInitializer, _underscore, _config, _hideShowOption, _object, _preview) {
    /**
     * Preview component for the CoullWorks Banner Slider content type.
     *
     * Renders the module's BannerSlider widget server-side (via the Page Builder
     * preview controller) so the stage preview reuses the tested frontend block.
     *
     * @api
     */
    var Preview = /*#__PURE__*/function (_preview2) {
        "use strict";

        _inheritsLoose(Preview, _preview2);

        /**
         * @inheritdoc
         */
        function Preview(contentType, config, observableUpdater) {
            var _this;

            _this = _preview2.call(this, contentType, config, observableUpdater) || this;
            _this.displayingWidgetPreview = _knockout.observable(false);
            _this.loading = _knockout.observable(false);
            _this.messages = {
                NOT_SELECTED: (0, _translate)("Please select a Banner Slider."),
                UNKNOWN_ERROR: (0, _translate)("An unknown error occurred. Please try again.")
            };
            _this.placeholderText = _knockout.observable(_this.messages.NOT_SELECTED);
            // Data keys that only affect the outer wrapper styling and should not force a re-render
            _this.ignoredKeysForBuild = ["margins_and_padding", "border", "border_color", "border_radius", "border_width", "css_classes", "text_align", "display"];

            return _this;
        }

        var _proto = Preview.prototype;

        /**
         * Return an array of options
         *
         * @returns {OptionsInterface}
         */
        _proto.retrieveOptions = function retrieveOptions() {
            var options = _preview2.prototype.retrieveOptions.call(this);

            options.hideShow = new _hideShowOption({
                preview: this,
                icon: _hideShowOption.showIcon,
                title: _hideShowOption.showText,
                action: this.onOptionVisibilityToggle,
                classes: ["hide-show-content-type"],
                sort: 40
            });

            return options;
        }
        /**
         * Runs the widget initializer for each configured widget in the rendered preview.
         *
         * @param {Element} element
         */
        ;

        _proto.initializeWidgets = function initializeWidgets(element) {
            if (element) {
                this.element = element;
                (0, _widgetInitializer)({
                    config: _config.getConfig("widgets"),
                    breakpoints: _config.getConfig("breakpoints"),
                    currentViewport: _config.getConfig("viewport")
                }, element);
            }
        }
        /**
         * @inheritdoc
         */
        ;

        _proto.afterObservablesUpdated = function afterObservablesUpdated() {
            _preview2.prototype.afterObservablesUpdated.call(this);

            var data = this.contentType.dataStore.getState();

            this.processData(data);
        }
        /**
         * Decide whether to request a fresh preview or reuse the placeholder.
         *
         * @param {DataObject} data
         */
        ;

        _proto.processData = function processData(data) {
            var sliderId = (0, _object.get)(data, "slider_id");

            if (!sliderId || sliderId.toString().length === 0) {
                this.showWidgetPreview(false);
                this.placeholderText(this.messages.NOT_SELECTED);
                return;
            }

            // Nothing meaningful changed since the last render, reuse the cached HTML.
            if (!this.hasDataChanged(this.previousData, data)) {
                if (this.lastRenderedHtml) {
                    this.data.main.html(this.lastRenderedHtml);
                    this.showWidgetPreview(true);
                    this.initializeWidgets(this.element);
                }

                this.previousData = Object.assign({}, data);
                return;
            }

            this.processRequest(data);
            this.previousData = Object.assign({}, data);
        }
        /**
         * Request the rendered widget HTML from the Page Builder preview controller.
         *
         * @param {DataObject} data
         */
        ;

        _proto.processRequest = function processRequest(data) {
            var _this2 = this;

            var url = _config.getConfig("preview_url");

            var requestConfig = {
                method: "POST",
                data: {
                    role: this.config.name,
                    directive: this.data.main.html()
                }
            };

            this.loading(true);

            _jquery.ajax(url, requestConfig).done(function (response) {
                if (typeof response.data !== "object") {
                    _this2.showWidgetPreview(false);
                    _this2.placeholderText(_this2.messages.UNKNOWN_ERROR);
                    return;
                }

                if (response.data.content) {
                    var content = _this2.processContent(response.data.content);
                    _this2.data.main.html(content);
                    _this2.showWidgetPreview(true);
                    _this2.initializeWidgets(_this2.element);
                    _this2.lastRenderedHtml = content;
                } else if (response.data.error) {
                    _this2.showWidgetPreview(false);
                    _this2.placeholderText(response.data.error);
                } else {
                    _this2.showWidgetPreview(false);
                    _this2.placeholderText(_this2.messages.NOT_SELECTED);
                }
            }).fail(function () {
                _this2.showWidgetPreview(false);
                _this2.placeholderText(_this2.messages.UNKNOWN_ERROR);
            }).always(function () {
                _this2.loading(false);
            });
        }
        /**
         * Toggle display of the rendered widget preview.
         *
         * @param {boolean} isShow
         */
        ;

        _proto.showWidgetPreview = function showWidgetPreview(isShow) {
            this.displayingWidgetPreview(isShow);
        }
        /**
         * Adapt rendered content so background images and breakpoint styles work on stage.
         *
         * @param {string} content
         * @returns {string}
         */
        ;

        _proto.processContent = function processContent(content) {
            var document = new DOMParser().parseFromString(content, "text/html");

            return document.head.innerHTML + document.body.innerHTML;
        }
        /**
         * Determine if the data has changed, ignoring wrapper-only styling keys.
         *
         * @param {DataObject} previousData
         * @param {DataObject} newData
         * @returns {boolean}
         */
        ;

        _proto.hasDataChanged = function hasDataChanged(previousData, newData) {
            if (!previousData) {
                return true;
            }

            previousData = _underscore.omit(previousData, this.ignoredKeysForBuild);
            newData = _underscore.omit(newData, this.ignoredKeysForBuild);

            return !_underscore.isEqual(previousData, newData);
        };

        return Preview;
    }(_preview);

    return Preview;
});
