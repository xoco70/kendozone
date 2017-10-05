@if(Session::has('flash_message'))
    <script>
        flash("{!!  session('flash_message.message')!!}")
    </script>
@endif