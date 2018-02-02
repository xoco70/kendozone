$(function () {
    $.ajaxSetup({cache: true});
    $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: facebook_id,
            version: 'v2.7' // or v2.1, v2.2, v2.3, ...
        });
        $('#loginbutton,#feedbutton').removeAttr('disabled');
        FB.getLoginStatus(function () {
            // Your logic here
        });
    });
    document.getElementById('shareBtn').onclick = function () {
        FB.ui({
            method: 'share',
            display: 'popup',
            href: url_register,
        }, function (response) {
        });
    };

    document.getElementById('shareBtnShow').onclick = function () {
        FB.ui({
            method: 'share',
            display: 'popup',
            href: url_show_tournament,
        }, function (response) {
        });
    };
});

