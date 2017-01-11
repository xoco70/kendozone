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
$month = $now->month-1; // Javascript dates are zero-indexed https://github.com/amsul/pickadate.js/issues/768
$day = $now->day;

?>

@section('scripts_footer')
{!! Html::script('js/pages/header/tournamentCreate.js') !!}
{!! Html::script('js/categoryCreate.js') !!}
{!! JsValidator::formRequest('App\Http\Requests\TournamentRequest') !!}

<script>
        let ikf_categories = "{!!   trans_choice('categories.category',2) .": ". implode(', ',$rulesCategories[0]) !!}";
        let ekf_categories = "{!!   trans_choice('categories.category',2) .": ".implode(', ',$rulesCategories[1]) !!}";
        let lakc_categories = "{!!  trans_choice('categories.category',2) .": ".implode(', ',$rulesCategories[2]) !!}";

        let dualList = $('.listbox-filter-disabled').bootstrapDualListbox({
            showFilterInputs: false,
            infoTextEmpty: '',
            infoText: ''
        });
        $('.listbox-filter-disabled').on('change', function(){
            disableSubmit();
        });
        let dualListIds = [];


        let minDay = new Date("{{$year}}", "{{$month}}", "{{$day}}", 0, 0, 0, 0) ;
        $(function () {

            let $input = $('.dateFin').pickadate({
                min: minDay,
                format: 'yyyy-mm-dd',
                today: '',
                clear: '',
                close: ''
            });
            let pickerFin = $input.pickadate('picker');

            let $inputIni =$('.dateIni').pickadate({
                min: [{{$year}}, {{$month}}, {{$day}}],
                format: 'yyyy-mm-dd',
                today: '',
                clear: '',
                close: '',

                onSet: function () {
                    if (this.get('select') != null)
                        pickerFin.set('min', this.get('select'));
                }
            });
            let pickerIni = $inputIni.pickadate('picker');

            $(".listbox-filter-disabled > option").each(function () {
                dualListIds.push(this.value);
            });


            $('select[name="category[]_helper1"]').prop('disabled', true);
            $('select[name="category[]_helper2"]').prop('disabled', true);
            $('#create_category_link').bind('click', false);

            $('#c1').on('click', function () {
                $('.btn-success').prop('disabled', false);

                $('select[name="category[]_helper1"]').prop('disabled', true);
                $('select[name="category[]_helper2"]').prop('disabled', true);
                $('#create_category_link').bind('click', false);

                $('select[name="rule_id"]').prop('disabled', false);
                $('select[name="rule_id"]').prop('disabled', false);


            });

            $('#c2').on('click', function () {
                disableSubmit();
                $('.btn-success').prop('disabled', true);
                $('select[name="category[]_helper1"]').prop('disabled', false);
                $('select[name="category[]_helper2"]').prop('disabled', false);
                $('#create_category_link').unbind('click', false);
                $('select[name="rule_id"]').prop('disabled', true);

            });

            $('#rules').on('change', function () {
                if (this.value == 0) {
                    $('#categories_desc').text("");
                }
                else if (this.value == 1) {
//                    console.log(ikf_categories);
                    $('#categories_desc').text(ikf_categories);
                } else if (this.value == 2) {
//                    console.log(ekf_categories);
                    $('#categories_desc').text(ekf_categories);
                } else if (this.value == 3) {
//                    console.log(lakc_categories);
                    $('#categories_desc').text(lakc_categories);
                }
            });



        });

        function disableSubmit(){
            if ($('select[name="category[]_helper2"]').text() == ""){
                $('.btn-success').prop('disabled', true);
            }else{
                $('.btn-success').prop('disabled', false);
            }
        }
    </script>
@stop