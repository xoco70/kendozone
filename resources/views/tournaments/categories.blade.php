@extends('layouts.dashboard')

@section('content')



    <div class="tabbable">

        <ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified">
            <?php $first = true ?>
            @foreach($categories  as $category)
            <li {{$first ? 'class=active':'' }}>
                <?php $first = false ?>
                <a href="#{{$category->id}}" data-toggle="tab">{{Lang::get($category->name) }}</a></li>
            @endforeach
        </ul>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                <div class="tab-content">
                    <?php  $first = true ?>
                    @foreach($categories as $category)
                    <div class="tab-pane {{$first ? 'active':'' }}" id="{{$category->id}}">
                        <?php $first = false;
                        $categorySettings = DB::table('category_settings')
                                ->where("tournament_id",$tournamentId)
                                ->where("category_id",$category->id)
                                ->first();

                        ?>
                        <!-- TAB CATEGORIES DEFAULT SETTING -->
                        @if (is_null($categorySettings))
                            {!! Form::open(["url" => "tournaments/categorySettings"]) !!}
                        @else
                        {!! Form::model($categorySettings, array('route' => array('tournaments.{tournamentId}.categorySettings.update', $categorySettings->id), 'method' => 'PATCH')) !!}
                        @endif

                        {!! Form::hidden('tournament_id', $tournamentId) !!}
                        {!! Form::hidden('category_id', $category->id) !!}
                        @include('layouts.categorySettings')
                        {!! Form::close() !!}
                        <!-- END TAB CATEGORIES DEFAULT SETTING -->
                    </div>
                    @endforeach



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

