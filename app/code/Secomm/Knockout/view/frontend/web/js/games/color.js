define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko){
    'use strict';
    let config = window.techtalk.knockoutConfig;
    return Component.extend({
        defaults : {
            template: 'Secomm_Knockout/games/color'
        },

        canDisplay: ko.observable(config.isActive),
        row: ko.observable(config.initalRow),
        column: ko.observable(config.initalColumn),
        colorHex: ko.observable(''),
        mapCoordinators: ko.observable([]),

        widthBoxCaculation: function (){
            return (this.column())*100 + (this.column())*7;
        },
        buildColorMap: function (){
            let mapCoordinators = [];
            for(let rowIndex = 0; rowIndex < this.row(); rowIndex++) {
                for(let columnIndex = 0; columnIndex < this.column(); columnIndex++) {
                    let color = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);
                    mapCoordinators.push({x: rowIndex, y: columnIndex, color: color});
                }
            }
            this.mapCoordinators(mapCoordinators);
        },

        changeRow: function (){
            this.row($('input[name="mapRow"]').val());
            this.buildColorMap()
        },

        changeColumn: function (){
            this.column($('input[name="mapColumn"]').val());
            this.buildColorMap()
        },

        updateColorHex: function (color){
            this.colorHex(color)
        }
    });
});
