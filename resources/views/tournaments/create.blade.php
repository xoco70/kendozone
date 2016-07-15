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
{!! Html::script('js/categoryCreate.js') !!}
{!! JsValidator::formRequest('App\Http\Requests\TournamentRequest') !!}

<script>
        var ikf_categories = "{!!   trans_choice('categories.category',2) .": ". implode(', ',$rulesCategories[0]) !!}";
        var ekf_categories = "{!!   trans_choice('categories.category',2) .": ".implode(', ',$rulesCategories[1]) !!}";
        var lakc_categories = "{!!  trans_choice('categories.category',2) .": ".implode(', ',$rulesCategories[2]) !!}";

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


            $('select[name="category[]_helper1"]').prop('disabled', true);
            $('select[name="category[]_helper2"]').prop('disabled', true);

            $('#c1').on('click', function () {
                $('select[name="category[]_helper1"]').prop('disabled', true);
                $('select[name="category[]_helper2"]').prop('disabled', true);
                $('select[name="rule_id"]').prop('disabled', false);

            });

            $('#c2').on('click', function () {
                $('select[name="category[]_helper1"]').prop('disabled', false);
                $('select[name="category[]_helper2"]').prop('disabled', false);
                $('select[name="rule_id"]').prop('disabled', true);
            });

            $('#rules').on('change', function () {
                if (this.value == 0) {
                    $('#categories_desc').text("");
                }
                else if (this.value == 1) {
                    console.log(ikf_categories);
                    $('#categories_desc').text(ikf_categories);
                } else if (this.value == 2) {
                    console.log(ekf_categories);
                    $('#categories_desc').text(ekf_categories);
                } else if (this.value == 3) {
                    console.log(lakc_categories);
                    $('#categories_desc').text(lakc_categories);
                }
            });


        });


    </script>
@stop