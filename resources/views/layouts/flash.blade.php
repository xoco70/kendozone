@if(Session::has('success'))
    <div class="alert bg-success alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ Session::get('success') }}</span>
    </div>

@elseif (Session::has('error'))
    <div class="alert bg-warning-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ Session::get('error') }}</span>
    </div>
@elseif (Session::has('flash_message') )
    <div class="alert bg-info-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ Session::get('flash_message') }}</span>
    </div>
@elseif (Session::has('status') )
    <div class="alert bg-success-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         {{ Session::get('status') }}
    </div>

@endif