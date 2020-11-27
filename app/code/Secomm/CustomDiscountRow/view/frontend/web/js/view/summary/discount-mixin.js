define([
], function () {
    'use strict';

    let checkoutConfig = window.checkoutConfig;
    var mixin = {
        defaults: {
            template: 'Secomm_CustomDiscountRow/summary/discount'
        },

        canDisplayCustomDiscountRow: function (){
            return checkoutConfig.CustomDiscountRow.canDisplay;
        },

        getCustomDiscountValue: function (){
            return this.getFormattedPrice(checkoutConfig.CustomDiscountRow.amount);
        }
    }
    return function (target) {
        return target.extend(mixin)
    }
});
