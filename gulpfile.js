var elixir = require('laravel-elixir');

//require('laravel-elixir-vueify');
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

    // General Styles for app
    mix.styles([
        //'icons/icomoon/styles.css',
        'bootstrap.css',
        'components.css',
        'colors.css',
        'core.css',
        'custom.css'
    ], 'public/css/app.css');
   // mix.browserify('vue/pages/tournaments.js');
    mix.scripts([
       //'icons/icomoon/styles.css',
       'plugins/loaders/pace.min.js',
       'core/libraries/jquery.min.js',
       'core/libraries/bootstrap.min.js',
       'plugins/loaders/blockui.min.js',
       'core/app.js',
       'components/noty/js/noty/packaged/jquery.noty.packaged.js',
       'core/libraries/jquery_ui/sliders.min.js',
       'core/libraries/jquery_ui/touch.min.js',
       'plugins/sliders/slider_pips.min.js',
       'plugins/forms/styling/switch.min.js'
    ], 'public/js/app.js');

    mix.scripts([
       'plugins/tables/footable/footable.min.js',
    ], 'public/js/pages/header/tournamentIndex.js');

    mix.scripts([
       'plugins/tables/footable/footable.min.js',
    ], 'public/js/pages/header/userIndex.js');


    mix.scripts([
       'plugins/tables/footable/footable.min.js'
    ], 'public/js/pages/header/invitationIndex.js');

    mix.scripts([
       'plugins/forms/inputs/duallistbox.min.js',
       'plugins/pickers/pickadate/picker.js',
       'plugins/pickers/pickadate/picker.date.js'
    ], 'public/js/pages/header/tournamentCreate.js');

    mix.scripts([
       //'http://maps.google.com/maps/api/js',
       // 'plugins/uploaders/fileinput.min.js',
       // 'pages/uploader_bootstrap.js',
       'plugins/dropzone.js'
    ], 'public/js/pages/header/userCreate.js');

    mix.styles([
        'dropzone.css',
        // 'dz-basic.css'
    ], 'public/css/pages/userCreate.css');
    mix.scripts([
       'http://maps.google.com/maps/api/js',
       // 'plugins/uploaders/fileinput.min.js',
       'plugins/uploaders/dropzone.js',
       // 'plugins/pages/uploader_bootstrap.js'
    ], 'public/js/userEdit.js');

    mix.scripts([
       'plugins/ui/nicescroll.min.js',
       'sidebar_detached_sticky_custom.js',
       'plugins/forms/inputs/duallistbox.min.js',
       'plugins/pickers/location/location.js',
       //'http://maps.google.com/maps/api/js',
       'plugins/pickers/pickadate/picker.js',
       'plugins/pickers/pickadate/picker.date.js',
       'plugins/notifications/sweet_alert.min.js',
       'core/libraries/jquery_ui/interactions.min.js',
       'core/libraries/jquery_ui/touch.min.js',
       'jquery.timepicker.js',
        'plugins/jquery-dateFormat.min.js',
    ], 'public/js/pages/header/tournamentEdit.js');


    mix.scripts([
       'plugins/ui/nicescroll.min.js',
       'sidebar_detached_sticky_custom.js',
       'plugins/notifications/sweet_alert.min.js'
    ], 'public/js/pages/header/tournamentUserCreate.js');

    mix.scripts([
       'plugins/tables/datatables/datatables.min.js',
       'plugins/tables/datatables/extensions/responsive.min.js',
       'plugins/forms/selects/select2.min.js'
    ], 'public/js/pages/header/tournamentUserIndex.js');

    mix.scripts([
       'plugins/multiple-emails.js'
    ], 'public/js/pages/header/tournamentInvite.js');

    mix.styles([
       'multiple-emails.css'
    ], 'public/css/pages/tournamentInvite.css');

});