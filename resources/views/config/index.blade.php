@extends('layouts.dashboard')

@section('content')

    <div class="tabbable">
        <ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified">
            <li class="active"><a href="#bottom-justified-divided-tab1" data-toggle="tab">General</a></li>
            <li><a href="#bottom-justified-divided-tab2" data-toggle="tab">Categorias</a></li>
            <li><a href="#bottom-justified-divided-tab3" data-toggle="tab">Usuario</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="bottom-justified-divided-tab1">
                To use in tabs with equal widths add <code>.nav-justified .nav-tabs-bottom .bottom-divided</code> classes.
            </div>

            <div class="tab-pane" id="bottom-justified-divided-tab2">
                Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
            </div>

            <div class="tab-pane" id="bottom-justified-divided-tab3">
                DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
            </div>

        </div>
    </div>



    @include("errors.list")
@stop

