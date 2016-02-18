@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}

@stop
@section('content')


    @if (sizeof(Auth::user()->tournaments) == 0)
    @include('layouts.dashboard.createFirstTournament')

    @else

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-body border-top-primary">
                    <div class="text-center">
                        <h6 class="no-margin text-semibold">{{ trans('core.welcome') }}</h6>
                        <p class="content-group-sm text-muted">{{ trans('core.welcome_text') }}</p>
                    </div>

                    <div class="well well-lg mb-15">
                        <a href="/tournaments/create">{{ trans('core.create_new_tournament') }}</a>
                    </div>
                    <div class="well well-lg mb-15">
                        <a href="#">{{ trans('core.congigure_categories') }}</a>
                    </div>

                    <div class="well well-lg">
                        <a href="#">{{ trans('crud.invite_competitors') }}</a>
                    </div>
                </div>
            </div>


        </div>
    @endif
@stop