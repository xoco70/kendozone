@if(Session::has('flash_message'))
    <script>
        var n = noty({
            layout: 'topRight',
            type: 'success',
            width: 200,
            dismissQueue: true,
            timeout: 3000,
            text: "{{session('flash_message.message')}}",
        });

    </script>
@endif