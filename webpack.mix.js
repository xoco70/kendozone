const {mix} = require('laravel-mix');
const path = require('path');
const glob = require('glob');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const PurifyCSSPlugin = require('purifycss-webpack');

module.exports = {
module: {
    rules: [
        {
            test: /\.css$/,
            loader: ExtractTextPlugin.extract({
                fallbackLoader: 'style-loader',
                loader: 'css-loader'
            })
        }
    ]
},
plugins: [
    new ExtractTextPlugin('[name].[contenthash].css'),
    // Make sure this is after ExtractTextPlugin!
    new PurifyCSSPlugin({
        // Give paths to parse for rules. These should be absolute!
        paths: glob.sync(path.join(__dirname, 'app/*.html')),
    })
]
};
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

mix.js('resources/assets/js/vue/pages/categoryCreate.js','public/js/');
mix.js('resources/assets/js/vue/pages/AddAliasToCategory.js','public/js/');
mix.js('resources/assets/js/vue/pages/userForm.js','public/js/');
mix.js('resources/assets/js/oauth.js','public/js/');
mix.js('resources/assets/js/bootstrap.js','public/js/');



mix.combine([
    'resources/assets/js/plugins/loaders/pace.min.js',
    'resources/assets/js/core/libraries/jquery.min.js', // 2.1.4
    'resources/assets/js/core/libraries/bootstrap.min.js', // v3.3.6
    'resources/assets/js/core/app.js',
    'resources/assets/js/components/noty/js/noty/packaged/jquery.noty.packaged.js',
    'resources/assets/js/plugins/forms/styling/switch.min.js',
    'resources/assets/js/vendor/jsvalidation/js/jsvalidation.js',
    'resources/assets/js/components/protip/protip.min.js'
], 'public/js/app.js');

mix.combine([
    'resources/assets/js/plugins/loaders/pace.min.js',
    'resources/assets/js/core/libraries/jquery.min.js', // 2.1.4
    'resources/assets/js/core/libraries/bootstrap.min.js', // v3.3.6
    'resources/assets/js/core/app.js'
], 'public/js/guest_app.js');

mix.combine([
    'resources/assets/less/bootstrap.less',
    'resources/assets/less/core.less',
    'resources/assets/less/components.less',
    'resources/assets/less/colors.less'

], 'resources/assets/less/main.less');


mix.less('resources/assets/less/main.less','css/main.css' );

mix.combine([
     'public/css/main.css',
    'resources/assets/css/custom.css',
    'resources/assets/css/protip.css',
    'resources/assets/css/nunito.css'
], 'public/css/app.css');





mix.combine([
    'resources/assets/js/plugins/tables/footable/footable.min.js'
], 'public/js/pages/header/footable.js');

mix.combine([
    'resources/assets/js/components/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.date.js',
    'resources/assets/js/plugins/notifications/bootbox.min.js'
], 'public/js/pages/header/tournamentCreate.js');

mix.combine([
    'resources/assets/js/plugins/dropzone.js'
], 'public/js/pages/header/userCreate.js');

mix.combine([
    'resources/assets/css/dropzone.css'
], 'public/css/pages/userCreate.css');
mix.combine([
    'resources/assets/js/plugins/uploaders/dropzone.js'
], 'public/js/userEdit.js');

mix.combine([
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/sidebar_detached_sticky_custom.js',
    'resources/assets/js/plugins/forms/inputs/duallistbox.min.js',
    'resources/assets/js/components/jquery-locationpicker-plugin/dist/locationpicker.jquery.min.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.date.js',
    'resources/assets/js/plugins/notifications/sweet_alert.min.js',
    'resources/assets/js/jquery.timepicker.js',
    'resources/assets/js/plugins/jquery-dateFormat.min.js',
    'resources/assets/js/pages/footer/tournamentEditFooter.js',
], 'public/js/pages/header/tournamentEdit.js');


mix.combine([
    'resources/assets/js/components/jquery-locationpicker-plugin/dist/locationpicker.jquery.min.js',
    'resources/assets/js/pages/footer/clubFooter.js',
], 'public/js/pages/footer/club.js');

mix.combine([
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/plugins/forms/inputs/duallistbox.min.js',
    'resources/assets/js/plugins/pickers/location/location.js',
    'resources/assets/js/plugins/notifications/sweet_alert.min.js',
    'resources/assets/js/pages/footer/tournamentShowFooter.js'
], 'public/js/pages/header/tournamentShow.js');

mix.combine([
    'resources/assets/js/plugins/tables/footable/footable.min.js',
], 'public/js/pages/header/tournamentIndex.js');

mix.combine([
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/sidebar_detached_sticky_custom.js',
    'resources/assets/js/plugins/notifications/sweet_alert.min.js'
], 'public/js/pages/header/competitorCreate.js');

mix.combine([
    'resources/assets/js/plugins/tables/datatables/datatables.min.js',
    'resources/assets/js/plugins/tables/datatables/extensions/responsive.min.js',
    'resources/assets/js/pages/footer/competitorIndexFooter.js',
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/sidebar_detached_sticky_custom.js',
], 'public/js/pages/header/competitorIndex.js');

mix.combine([
    'resources/assets/js/plugins/multiple-emails.js',
    'resources/assets/js/plugins/uploaders/fileinput.min.js',
    'resources/assets/js/pages/uploader_bootstrap.js',
], 'public/js/pages/header/tournamentInvite.js');

mix.combine([
    'resources/assets/css/multiple-emails.css'
], 'public/css/pages/tournamentInvite.css');

mix.combine([
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/sidebar_detached_sticky_custom.js',
    'resources/assets/js/components/sweetalert/dist/sweetalert.min.js',
], 'public/js/pages/footer/trees.js');


mix.combine([
    'resources/assets/css/preliminary_trees.css',
], 'public/css/pages/preliminary_trees.css');



mix.combine([
    'resources/assets/js/pages/footer/tournamentEditFooter.js'
], 'public/js/pages/footer/tournamentEditFooter.js');


mix.combine([
    'resources/assets/js/pages/footer/tournamentDeletedFooter.js'
], 'public/js/pages/footer/tournamentDeletedFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/tournamentIndexFooter.js'
], 'public/js/pages/footer/tournamentIndexFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/tournamentShowFooter.js'
], 'public/js/pages/footer/tournamentShowFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/userIndexFooter.js'
], 'public/js/pages/footer/userIndexFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/userShowFooter.js'
], 'public/js/pages/footer/userShowFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/associationIndexFooter.js'
], 'public/js/pages/footer/associationIndexFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/clubIndexFooter.js'
], 'public/js/pages/footer/clubIndexFooter.js');

mix.combine([
    'resources/assets/js/pages/footer/teamIndexFooter.js',
], 'public/js/pages/footer/teamIndexFooter.js');