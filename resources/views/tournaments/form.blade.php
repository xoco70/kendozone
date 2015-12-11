{{--TODO PREFENCIAS CURRENCY--}}

<h2 align="center">{{Lang::get('crud.newTournament')}}</h2>

<div class="row">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <div class="col-md-6">
            <div class=" form-group">
                {!!  Form::label('name', trans('crud.name')) !!}
                {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            {!!  Form::label('date', trans('crud.eventDate')) !!}
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                {!!  Form::input('text', 'date', old('date'), ['class' => 'form-control datetournament']) !!}
            </div>
        </div>
    </div>



</div>


<div class="row">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <div class="panel-body">
            <p class="coutent-group">Seleccione las categorias abiertas para su torneo</p>


            {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
        </div>

        <div class="form-group">
            {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>


</div>


<?php
$now = Carbon\Carbon::now();
$year = $now->year;
$month = $now->month;
$day = $now->day;
?>


        <!-- Theme JS files -->
<script>

    $(function () {
        $('.datetournament').pickadate({
            min: [{{$year}}, {{$month}}, {{$day}}],
            format: 'yyyy-mm-dd'
        });
        {{--$('.datelimit').pickadate({--}}
        {{--min: [{{$year}}, {{$month}}, {{$day}}],--}}
        {{--format: 'yyyy-mm-dd'--}}
        {{--});--}}


        // Basic Dual select example
        // Disable filtering
        $('.listbox-filter-disabled').bootstrapDualListbox({
            showFilterInputs: false
        });

        // Stepy settings
        // Override defaults
//        $.fn.stepy.defaults.legend = false;
//        $.fn.stepy.defaults.transition = 'fade';
//        $.fn.stepy.defaults.duration = 150;
//        $.fn.stepy.defaults.backLabel = '<i class="icon-arrow-left13 position-left"></i> Back';
//        $.fn.stepy.defaults.nextLabel = 'Next <i class="icon-arrow-right14 position-right"></i>';
//        $(".stepy-validation").stepy({});


        // Apply "Back" and "Next" button styling
//        $('.stepy-step').find('.button-next').addClass('btn btn-primary');
//        $('.stepy-step').find('.button-back').addClass('btn btn-default');
//        $(".switch").bootstrapSwitch();

        // Manipulating from callback
        // Basic functionality
//        $('.locationpicker-default').locationpicker({
//            radius: 150,
//            scrollwheel: false,
//            zoom: 10
//        });


        $('#block-panel').on('click', function () {
            var block = $(this).parent().parent();
            $(block).block({
                message: '<i class="icon-spinner4 spinner"></i>',
                timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        });


    });
</script>