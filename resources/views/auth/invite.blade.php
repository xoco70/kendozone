@extends('layouts.guest')

@section('content')
        <!-- Registration form -->
{!! Form::open(['url'=>URL::to('/auth/invite') , 'class'=> "form-signin"]) !!}
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">

        <div class="panel">
            <div class="panel-body">
                <div class="text-center">

                    <div class="icon-object border-success text-success"><i class="icon-plus3"></i>
                    </div>
                    <h5 class="content-group-lg">{{  Lang::get('auth.title_register') }}
                        <small class="display-block">{{  Lang::get('core.all_fields_required') }}</small>
                    </h5>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="form-group has-feedback">
                            <input type="text" name="name" class="form-control" id=""
                                   value="{{ old('name') }}"
                                   placeholder="{{  Lang::get('auth.choose_username') }}">

                            <div class="form-control-feedback">
                                <i class="icon-user-plus text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
                {!!   Form::hidden('token', $token) !!}


                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="form-group has-feedback">
                            <input type="password" id="password" name="password"
                                   placeholder="{{  Lang::get('auth.create_password') }}"
                                   class="form-control">

                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="form-group has-feedback">
                            <input type="password" id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="{{  Lang::get('auth.repeat_password') }}"
                                   class="form-control">

                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{--{!!   Form::hidden('roleId', $roleId) !!}--}}

                <div class="text-right">
                    <button type="submit"
                            class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                        <b><i class="icon-plus3"></i></b>{{  Lang::get('auth.create_account') }}
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

{!! Form::close()!!}
        <!-- /registration form -->
@stop