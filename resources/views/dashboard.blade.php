@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}

@stop
@section('content')
    @include("errors.list")

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-body border-top-primary">
                <div class="text-center">
                    <h6 class="no-margin text-semibold">Bienvenido</h6>
                    <p class="content-group-sm text-muted">Aún te falta unos pasos para disfrutar del sistema</p>
                </div>

                <div class="well well-lg mb-15">
                    <a href="/tournaments/create">Crear un nuevo torneo</a>
                </div>
                <div class="well well-lg mb-15">
                    <a href="#">Configurar las diferentes categorias</a>
                </div>

                <div class="well well-lg">
                    <a href="#">Invitar competidores</a>
                </div>
            </div>
        </div>


    </div>
@stop