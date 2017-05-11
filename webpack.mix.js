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

// mix.options({ purifyCss: true });

mix.js('resources/assets/js/vue/pages/categoryCreate.js', 'public/js/');
mix.js('resources/assets/js/vue/pages/userForm.js', 'public/js/');
mix.js('resources/assets/js/oauth.js', 'public/js/');
mix.js('resources/assets/js/bootstrap.js', 'public/js/');
mix.js('resources/assets/js/vue/pages/addFighterToTeam.js', 'public/js/');

mix.copy('resources/assets/js/analytics.js', 'public/js/analytics.js');

mix.copy('vendor/xoco70/kendo-tournaments/resources/assets/css/brackets.css', 'public/vendor/kendo-tournaments/css/brackets.css');
mix.copy('resources/assets/css/sheet.css', 'public/css/pages/sheet.css');
mix.copy('resources/assets/css/icons/icomoon/fonts/icomoon.woff', 'public/css/icons/icomoon/fonts/icomoon.woff');
mix.copy('resources/assets/css/icons/icomoon/fonts/icomoon.ttf', 'public/css/icons/icomoon/fonts/icomoon.ttf');


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
    'resources/assets/less/_main_full/bootstrap.less',
    'resources/assets/less/_main_full/core.less',
    'resources/assets/less/_main_full/components.less',
    'resources/assets/less/_main_full/colors.less'
], 'resources/assets/less/_main_full/main.less');


mix.less('resources/assets/less/_main_full/main.less', 'css/main.css');

mix.combine([
    'public/css/main.css',
    'resources/assets/css/custom.css',
    'resources/assets/css/protip.css',
    'resources/assets/css/nunito.css',
    'resources/assets/css/icons/icomoon/styles.css',
    // 'resources/assets/css/google-fonts.css'
], 'public/css/app.css');




// mix.combine([
//     'resources/assets/js/plugins/tables/footable/footable.min.js'
// ], 'public/js/pages/header/footable.js');

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
    'resources/assets/js/jquery.timepicker.css',

    ], 'public/css/pages/tournamentEdit.css');



mix.combine([
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    // 'resources/assets/js/sidebar_detached_sticky_custom.js',
    'resources/assets/js/plugins/forms/inputs/duallistbox.min.js',
    'resources/assets/js/components/jquery-locationpicker-plugin/dist/locationpicker.jquery.min.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.date.js',
    'resources/assets/js/plugins/notifications/sweet_alert.min.js',
    'resources/assets/js/jquery.timepicker.js',
    'resources/assets/js/plugins/jquery-dateFormat.min.js',
    'resources/assets/js/pages/footer/tournamentEditFooter.js',
    'public/js/categoryCreate.js'
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
    'resources/assets/js/pages/footer/invites.js',
    'resources/assets/js/components/sweetalert/dist/sweetalert.min.js',

], 'public/js/pages/header/tournamentInvite.js');

mix.combine([
    'resources/assets/css/multiple-emails.css'
], 'public/css/pages/tournamentInvite.css');

mix.combine([
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/components/sweetalert/dist/sweetalert.min.js',
], 'public/js/pages/footer/trees.js');


mix.combine([
    'vendor/xoco70/kendo-tournaments/resources/assets/css/brackets.css',
], 'public/css/pages/trees.css');

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

mix.combine([
    'resources/assets/css/dragula.css',
], 'public/css/dragula.css');


