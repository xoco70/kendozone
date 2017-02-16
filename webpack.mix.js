const {mix} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */





mix.combine([
    'resources/assets/js/plugins/loaders/pace.min.js',
    'resources/assets/js/core/libraries/jquery.min.js', // 2.1.4
    'resources/assets/js/core/libraries/bootstrap.min.js', // v3.3.6
    'resources/assets/js/core/app.js',
], 'public/js/guest_app.js');

mix.less('resources/assets/less/_main_full/core.less','resources/assets/css/less.css');
    // 'resources/assets/less/_main_full/components.less',
    // 'resources/assets/less/_main_full/colors.less',
    // 'resources/assets/less/_main_full/core.less'], 'resources/assets/less/less.less');

// mix.less('resources/assets/less/less.less','resources/assets/css/less.css' )

