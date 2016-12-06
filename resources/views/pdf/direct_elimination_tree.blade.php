@extends('layouts.pdf')
@section('content')
    @include("layouts.tree.directElimination")
@stop
@section('footer')
    @include('pdf.footer')
@stop
@section('scripts_footer')
    {!! Html::style('pdf/brackets.css')!!}
    {!! Html::script('pdf/brackets.js')!!}

    <script>
        $(function () {
            $('#brackets_{{ $championship->id }}').bracket({
                init: minimalData_{{ $championship->id }},
                teamWidth: 100,
            })
        });
    </script>
@stop


