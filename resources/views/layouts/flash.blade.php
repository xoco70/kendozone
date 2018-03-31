@if(Session::has('flash_message'))
        <div class="alert bg-info-400 alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            {!!  session('flash_message.message')!!}
        </div>
@endif