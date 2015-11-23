@if(Session::has('success'))
    <div class="alert bg-success alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{!! Lang::get('core.success') !!}</span> {{ Session::get('success') }}
    </div>

@elseif (Session::has('error'))
    <div class="alert bg-warning-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{!! Lang::get('core.warning') !!}</span> {{ Session::get('error') }}
    </div>
@elseif (Session::has('flash_message') )
    <div class="alert bg-info-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{!! Lang::get('core.info') !!}</span> {{ Session::get('flash_message') }}
    </div>
@elseif (Session::has('status') )
    <div class="alert bg-success-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         {{ Session::get('status') }}
    </div>

@endif