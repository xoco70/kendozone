@extends('layouts.dashboard')
@section('content')

        <!-- Page header -->
<div class="page-header">
    <div class="page-title">
        <h3> Account  <small>View Detail My Info</small></h3>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
        <li class="active">Account</li>
    </ul>
</div>






<div class="page-content row">


    <div class="page-content-wrapper">
        @if(Session::has('message'))
            {{ Session::get('message') }}
        @endif
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <ul class="nav nav-tabs" >
            <li class="active"><a href="#info" data-toggle="tab"> {{ Lang::get('core.personalinfo') }} </a></li>
            <li ><a href="#pass" data-toggle="tab">{{ Lang::get('core.changepassword') }} </a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active m-t" id="info">
                {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id),'class'=>'form-horizontal ', 'enctype' => 'multipart/form-data')) !!}
{{--                {!!   Form::open(array('url'=>'user/saveprofile/', 'class'=>'form-horizontal ' ,'files' => true)) !!}--}}

                <div class="form-group">
                    {!!  Form::label('name', trans('crud.user'), ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-8">
                        {!!  Form::text('name', old('name'), ['class' => 'form-control input-sm']) !!} <!-- ,'disabled' => 'disabled' -->
                    </div>
                </div>

                <div class="form-group">
                    {!!  Form::label('name', trans('crud.email'), ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-8">
                        {!!  Form::email('email', old('email'), ['class' => 'form-control input-sm']) !!} <!-- ,'disabled' => 'disabled' -->
                    </div>
                </div>


                <div class="form-group">
                    {!!  Form::label('name', trans('crud.firstname'), ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-8">
                        {!!  Form::text('firstname', old('firstname'), ['class' => 'form-control input-sm']) !!} <!-- ,'disabled' => 'disabled' -->
                    </div>
                </div>


                <div class="form-group">
                    {!!  Form::label('name', trans('crud.lastname'), ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-8">
                        {!!  Form::text('lastname', old('lastname'), ['class' => 'form-control input-sm']) !!} <!-- ,'disabled' => 'disabled' -->
                    </div>
                </div>



                <div class="form-group  " >
                    <label for="ipt" class=" control-label col-md-4 text-right"> Avatar </label>
                    <div class="col-md-8">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
			  <span class="btn btn-primary btn-file">
			  	<span class="fileinput-new">Upload Avatar Image</span><span class="fileinput-exists">Change</span>
					<input type="file" name="picture">
				</span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                        </div>
                        <br />
{{--                        {{ SiteHelpers::showUploadedFile($user->avatar,'/uploads/users/') }}--}}

                    </div>
                </div>

                <div class="form-group">
                    <label for="ipt" class=" control-label col-md-4">&nbsp;</label>
                        <button class="btn btn-success" type="submit"> {{ Lang::get('core.savechanges') }}</button>

                </div>

                {!!   Form::close() !!}
            </div>

            <div class="tab-pane  m-t" id="pass">
                {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id),'class'=>'form-horizontal ')) !!}

                <div class="form-group">
                    {!!  Form::label('password', trans('crud.password'), ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-8">
                        {!!  Form::password('password', ['class' => 'form-control input-sm']) !!} <!-- ,'disabled' => 'disabled' -->
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('crud.newpassword') }} </label>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<input name="password" type="password" id="password" class="form-control input-sm" value="" />--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('crud.conewpassword') }}  </label>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value="" />--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    {!!  Form::label('password_confirmation', trans('crud.password_confirmation'), ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-8">
                        {!!  Form::password('password_confirmation', ['class' => 'form-control input-sm']) !!} <!-- ,'disabled' => 'disabled' -->
                    </div>
                </div>

                <div class="form-group">
                    <label for="ipt" class=" control-label col-md-4">&nbsp;</label>
                    <div class="col-md-8">
                        <button class="btn btn-danger" type="submit"> {{ Lang::get('core.savechanges') }} </button>
                    </div>
                </div>
                {!!   Form::close() !!}
            </div>



        </div>
    </div>

</div>
    @include("errors.list")
@stop