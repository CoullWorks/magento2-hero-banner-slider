/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */
define(['Magento_Ui/js/form/element/multiselect'], function (Multiselect) {
    'use strict';

    /**
     * A multiselect whose value keeps the order the options were chosen in.
     *
     * A plain multiselect reports its selection in list order, so the order a
     * slider's banners were picked in was lost on save. Here the value keeps the
     * existing order, appends each newly chosen option to the end and drops the
     * ones that were unchosen.
     */
    return Multiselect.extend({
        /**
         * @inheritdoc
         */
        initialize: function () {
            this._super();
            this.selectionOrder = [];
            this.value.subscribe(this.keepSelectionOrder, this);

            return this;
        },

        /**
         * @param {Array} value
         */
        keepSelectionOrder: function (value) {
            var chosen = (value || []).map(String),
                kept = this.selectionOrder.filter(function (item) {
                    return chosen.indexOf(String(item)) !== -1;
                }),
                keptKeys = kept.map(String),
                added = (value || []).filter(function (item) {
                    return keptKeys.indexOf(String(item)) === -1;
                }),
                next = kept.concat(added);

            this.selectionOrder = next;

            if (next.map(String).join(',') !== chosen.join(',')) {
                this.value(next);
            }
        }
    });
});
