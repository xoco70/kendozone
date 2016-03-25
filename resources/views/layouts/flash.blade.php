@if(Session::has('flash_message'))
    <script>
        noty({
            layout: 'bottomLeft',
            theme: 'kz',
            type: '{!!  session('flash_message.level')!!}',
            width: 200,
            dismissQueue: true,
            timeout: 3000,
            text: "{!!  session('flash_message.message')!!}",
            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

        });
    </script>
@endif