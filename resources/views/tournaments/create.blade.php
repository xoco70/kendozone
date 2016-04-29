@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.create',$currentModelName) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">

        {!! Form::open(['url'=> URL::action('TournamentController@store') ]) !!}

        @include("tournaments.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


        {!! Form::close()!!}
        @include("modals.create_category")

    </div>
@stop
<?php
$now = Carbon\Carbon::now();
$year = $now->year;
$month = $now->month;
$day = $now->day;

?>

@section('scripts_footer')
    {!! Html::script('js/pages/header/tournamentCreate.js') !!}
    {{--{!! Html::script('js/icheck.min.js') !!}--}}
    {{--    {!! Html::script('js/pages/footer/categoryCreateFooter.js') !!}--}}
    {!! Html::script('js/categoryCreate.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\TournamentRequest') !!}

    <script>
        var dualList = $('.listbox-filter-disabled').bootstrapDualListbox({
            showFilterInputs: false,
            infoTextEmpty: '',
            infoText: ''
        });
        var dualListIds = [];

        $(function () {
            var $input = $('.dateFin').pickadate({
                min: [{{$year}}, {{$month}}, {{$day}}],
                format: 'yyyy-mm-dd',
                today: '',
                clear: '',
                close: ''
            });
            var pickerFin = $input.pickadate('picker')

            $('.dateIni').pickadate({
                min: [{{$year}}, {{$month}}, {{$day}}],
                format: 'yyyy-mm-dd',
                today: '',
                clear: '',
                close: '',

                onSet: function () {
                    pickerFin.set('min', this.get('select'));
                }
            });

            $(".listbox-filter-disabled > option").each(function () {
                dualListIds.push(this.value);
            });
        });
    </script>
@stop