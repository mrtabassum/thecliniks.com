/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************************!*\
  !*** ./resources/assets/js/custom/input_price_format.js ***!
  \**********************************************************/


window.setPrice = function (selector, price) {
  if (price != '' || price > 0) {
    if (typeof price !== 'number') {
      price = price.replace(/,/g, '');
    }

    var formattedPrice = addCommas(price);
    $(selector).val(formattedPrice);
  }
};

window.addCommas = function (nStr) {
  nStr += '';
  var x = nStr.split('.');
  var x1 = x[0];
  var x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;

  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }

  return x1 + x2;
};

window.getFormattedPrice = function (price) {
  if (price != '' || price > 0) {
    if (typeof price !== 'number') {
      price = price.replace(/,/g, '');
    }

    return addCommas(price);
  }
};

window.priceFormatSelector = function (selector) {
  $(document).on('input keyup keydown keypress', selector, function (event) {
    var price = $(this).val();

    if (price === '') {
      $(this).val('');
    } else {
      if (/[0-9]+(,[0-9]+)*$/.test(price)) {
        $(this).val(getFormattedPrice(price));
        return true;
      } else {
        $(this).val(price.replace(/[^0-9 \,]/, ''));
      }
    }
  });
};

window.removeCommas = function (str) {
  return str.replace(/,/g, '');
};

priceFormatSelector('.price-input');
/******/ })()
;