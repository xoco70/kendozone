    @extends('layouts.dashboard')

@section('content')



    <div class="tabbable">

        <ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified">
            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            <li><a href="#category" data-toggle="tab">{{trans_choice('crud.category',2)}}</a></li>
            <li><a href="#bottom-justified-divided-tab3" data-toggle="tab">{{Lang::get('core.social_networks')}}</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        To use in tabs with equal widths add <code>.nav-justified .nav-tabs-bottom
                            .bottom-divided</code>
                        classes.
                    </div>
                    <!-- TAB CATEGORIES DEFAULT SETTING -->
                    @if (is_null($settings))
                        {!! Form::open(['url'=>"settings"]) !!}
                        <?php $settings = new App\Settings; ?>
                    @else
                        {!! Form::model($settings, ['method'=>"PATCH", 'class'=>'stepy-validation', "action" => ["SettingsController@update", $settings->id]]) !!}
                    @endif
                    @include('categories.categorySettings')
                    {!! Form::close() !!}
    <!-- END TAB CATEGORIES DEFAULT SETTING -->
<div class="tab-pane" id="bottom-justified-divided-tab3">
DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
</div>

</div>
</div>
<script>
$(".switch").bootstrapSwitch();
</script>

@include("errors.list")
</div>
</div>
{{--<script>--}}
{{--// Label with pips--}}
{{--$(".ui-slider-labels").slider({--}}
{{--max: 8,--}}
{{--value: 4--}}
{{--});--}}
{{--$(".ui-slider-labels").slider("pips", {--}}
{{--rest: "label"--}}
{{--});--}}

{{--</script>--}}
@stop

