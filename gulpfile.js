var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.browserify('vue/pages/categoryCreate.js');
    mix.browserify('vue/pages/AddAliasToCategory.js');
    mix.browserify('vue/pages/userForm.js');


    // General Styles for app
    mix.styles([
        //'icons/icomoon/styles.css',
        'bootstrap.css',
        'components.css',
        'colors.css',
        'core.css',
        'custom.css',
        'protip.css',
        'nunito.css'
    ], 'public/css/app.css');
    mix.scripts([
        'plugins/loaders/pace.min.js',
        'core/libraries/jquery.min.js', // 2.1.4
        'core/libraries/bootstrap.min.js', // v3.3.6
        'core/app.js',
        'components/noty/js/noty/packaged/jquery.noty.packaged.js',
        'plugins/forms/styling/switch.min.js',
        'vendor/jsvalidation/js/jsvalidation.js',
        'components/protip/protip.min.js'
    ], 'public/js/app.js');


    mix.scripts([
        'plugins/tables/footable/footable.min.js'
    ], 'public/js/pages/header/footable.js');

    mix.scripts([
        'components/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js',
        'plugins/pickers/pickadate/picker.js',
        'plugins/pickers/pickadate/picker.date.js',
        'plugins/notifications/bootbox.min.js',
    ], 'public/js/pages/header/tournamentCreate.js');

    mix.scripts([
        'plugins/dropzone.js'
    ], 'public/js/pages/header/userCreate.js');

    mix.styles([
        'dropzone.css',
    ], 'public/css/pages/userCreate.css');
    mix.scripts([
        'plugins/uploaders/dropzone.js',
    ], 'public/js/userEdit.js');

    mix.scripts([
        'plugins/ui/nicescroll.min.js',
        'sidebar_detached_sticky_custom.js',
        'plugins/forms/inputs/duallistbox.min.js',
        'components/jquery-locationpicker-plugin/dist/locationpicker.jquery.min.js',
        'plugins/pickers/pickadate/picker.js',
        'plugins/pickers/pickadate/picker.date.js',
        'plugins/notifications/sweet_alert.min.js',
        'jquery.timepicker.js',
        'plugins/jquery-dateFormat.min.js',
        'pages/footer/tournamentEditFooter.js',
    ], 'public/js/pages/header/tournamentEdit.js');

    mix.scripts([
        'plugins/ui/nicescroll.min.js',
        'sidebar_detached_sticky_custom.js',
        'plugins/forms/inputs/duallistbox.min.js',
        'plugins/pickers/location/location.js',
        'plugins/notifications/sweet_alert.min.js',
        'pages/footer/tournamentShowFooter.js'
    ], 'public/js/pages/header/tournamentShow.js');


    mix.scripts([
        'plugins/ui/nicescroll.min.js',
        'sidebar_detached_sticky_custom.js',
        'plugins/notifications/sweet_alert.min.js'
    ], 'public/js/pages/header/competitorCreate.js');

    mix.scripts([
        'plugins/tables/datatables/datatables.min.js',
        'plugins/tables/datatables/extensions/responsive.min.js',
        'plugins/forms/selects/select2.min.js',
        'pages/footer/competitorIndexFooter.js'
    ], 'public/js/pages/header/competitorIndex.js');

    mix.scripts([
        'plugins/multiple-emails.js'
    ], 'public/js/pages/header/tournamentInvite.js');

    mix.styles([
        'multiple-emails.css'
    ], 'public/css/pages/tournamentInvite.css');




    // FOOTER

    mix.scripts([
        'pages/footer/categoryCreateFooter.js'
    ], 'public/js/pages/footer/categoryCreateFooter.js');


    mix.scripts([
        'pages/footer/tournamentEditFooter.js'
    ], 'public/js/pages/footer/tournamentEditFooter.js');


    mix.scripts([
        'pages/footer/tournamentDeletedFooter.js'
    ], 'public/js/pages/footer/tournamentDeletedFooter.js');

    mix.scripts([
        'pages/footer/tournamentIndexFooter.js'
    ], 'public/js/pages/footer/tournamentIndexFooter.js');

    mix.scripts([
        'pages/footer/tournamentShowFooter.js'
    ], 'public/js/pages/footer/tournamentShowFooter.js');

    mix.scripts([
        'pages/footer/userIndexFooter.js'
    ], 'public/js/pages/footer/userIndexFooter.js');

    mix.scripts([
        'pages/footer/userShowFooter.js'
    ], 'public/js/pages/footer/userShowFooter.js');

    mix.scripts([
        'pages/footer/associationIndexFooter.js'
    ], 'public/js/pages/footer/associationIndexFooter.js');

    mix.scripts([
        'pages/footer/clubIndexFooter.js'
    ], 'public/js/pages/footer/clubIndexFooter.js');

    mix.scripts([
        'pages/footer/teamIndexFooter.js'
    ], 'public/js/pages/footer/teamIndexFooter.js');


});