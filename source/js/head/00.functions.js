/**
 * Script Functions
 * - required self-contained functions, classes and global helpers
 */


/**
 * Formatters
 */

// Create our number formatter for AUD
var formatter_money = new Intl.NumberFormat('en-AU', {
  style: 'currency',
  currency: 'AUD',
  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});
// Create our number formatter for AUD
var formatter_money_nocents = new Intl.NumberFormat('en-AU', {
  style: 'currency',
  currency: 'AUD',
  // These options are needed to round to whole numbers if that's what you want.
  minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});
var formatter_decimal_commas = new Intl.NumberFormat('en-AU', {
  style: 'decimal',
  // These options are needed to round to whole numbers if that's what you want.
  minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

function formatLoanAmount(fieldID) {
  const num = loanToNumber(jQuery(fieldID).val());
  const x = numberWithCommas(num);
  jQuery(fieldID).val(x);
}
function numberWithCommas(number) {
  if ( typeof number == "undefined" ) { return false; }
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Add thousands separators
}
function loanToNumber(text) {
  if ( typeof text == "undefined" ) { return false; }
  return Number(text.toString().replace(/,/g, ''));
}
function formatRate(fieldID) {
  const inputRate = jQuery(fieldID).val();
  let nr = Number(inputRate).toFixed(2);
  if ("NaN" === nr) { nr = null; } // handle NaN
  jQuery(fieldID).val(nr);
}
function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
    const negativeSign = amount < 0 ? "-" : "";
    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;
    return '$' + negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

// Perfectly round a number to two decimal points
function roundToTwo(num) {
  num = +(Math.round(num + "e+2") + "e-2");
  return num.toFixed(2);
}


/**
 * Form Handlers
 */
function serializeFormData(data) {
  let obj = {};
  for (let [key, value] of data) {
    if (obj[key] !== undefined) {
      if (!Array.isArray(obj[key])) {
        obj[key] = [obj[key]];
      }
      obj[key].push(value);
    } else {
      obj[key] = value;
    }
  }
  return obj;
}


/**
 * Scroll to an internal anchor, either passed or from the URL
 * Note: $anchor should not include the # character
 */
function ScrollToInternalAnchor($anchor = false) {
  var $offset = 190;
  if ( $anchor ) {
    var $target = jQuery("#"+$anchor);
    if ( $target.length ) {
      jQuery('html,body').animate({
        scrollTop: $target.offset().top - $offset
      }, 1000);
    }
  } else {
    var urlHash = window.location.href.split("#")[1];
    if (urlHash != null && urlHash.length) {
      jQuery('html,body').animate({
        scrollTop: jQuery('#' + urlHash).offset().top - $offset
      }, 1000);
    }
  }
}


/**
 * Cookie Helper
 * https://gist.github.com/litodam/3048775
 */
function CookiesHelper() {}
// usage
// CookiesHelper.createCookie("myCookieUniqueName", value, 30);
// CookiesHelper.createCookie("myJsonCookieUniqueName", json, 30);
CookiesHelper.createCookie = function(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
  } else {
    var expires = "";
  }
  document.cookie = name + "=" + value + expires + "; path=/; SameSite=Lax";
}
// usage
// var value = CookiesHelper.readCookie("myCookieUniqueName");
// var json = JSON.parse(CookiesHelper.readCookie("myJsonCookieUniqueName");
CookiesHelper.readCookie = function(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
CookiesHelper.eraseCookie = function(name) {
  createCookie(name, "", -1);
}


/**
 * JSON
 */
function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}


/**
 * Debouncer
 * https://www.educative.io/edpresso/how-to-use-the-debounce-function-in-javascript
 */
function debounce(func, wait, immediate) {
  var timeout;
  return function executedFunction() {
    var context = this;
    var args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};