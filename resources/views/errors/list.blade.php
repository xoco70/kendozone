@if ( $errors->any())
    <div class="alert bg-warning-400 alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{!! Lang::get('core.warning') !!}</span>
        <ul>
        @foreach($errors->all() as $error)
             <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
@if (Session::has('message'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        {{ Session::get('message') }}</div>
@endif