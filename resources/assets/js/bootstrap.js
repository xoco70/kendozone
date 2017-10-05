window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

// window.$ = window.jQuery = require('jquery');
//  require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */
if (!window.Vue) {
    window.Vue = require('vue');
}

window.axios = require('axios');


window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
window.flash = function (text, type = 'success') {
    let icon = "<i class='icon-trophy2'>";
    if (type == 'error') {
        icon = "<i class='icon-warning'>";
    }
    noty({
        layout: 'bottomLeft',
        theme: 'kz',
        type: type,
        width: 200,
        dismissQueue: true,
        timeout: 5000,
        text: text,
        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon">' + icon + '</i> </div>' +
        '<div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
    });
};