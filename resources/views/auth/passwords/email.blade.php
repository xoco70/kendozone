@extends('layouts.guest')

<!-- Main Content -->
@section('content')
    <div class="panel panel-body login-form">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
            <h5 class="content-group">{{  Lang::get('auth.password_recovery') }}
                <small class="display-block">{{  Lang::get('auth.we_will_send_instructions') }}</small>
            </h5>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                {!! Form::text('email', null, ['placeholder' => Lang::get('auth.your_email'), 'class' => 'form-control', 'required' => 'required'])!!}
                <div class="form-control-feedback">
                    <i class="icon-mail5 text-muted"></i>
                </div>
            </div>

            <button type="submit" class="btn bg-success btn-block">{{  Lang::get('auth.send_password') }} <i
                        class="icon-arrow-right14 position-right"></i></button>
        </form>
    </div>
@endsection
