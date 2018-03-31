@if(Session::has('flash_message'))
    <script>
        flash("{!!  session('flash_message.message')!!}", "{!!  session('flash_message.level')!!}")
    </script>
@endif