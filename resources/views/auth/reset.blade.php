<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->

	{!! Html::style('css/icons/icomoon/styles.css')!!}
	{!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900')!!}
	{!! Html::style('css/bootstrap.css')!!}
	{!! Html::style('css/core.css')!!}
	{!! Html::style('css/components.css')!!}
	{!! Html::style('css/colors.css')!!}
			<!-- /global stylesheets -->

	<!-- Core JS files -->
	{!! Html::script('js/plugins/loaders/pace.min.js') !!}
	{!! Html::script('js/core/libraries/jquery.min.js') !!}
	{!! Html::script('js/core/libraries/bootstrap.min.js') !!}
	{!! Html::script('js/plugins/loaders/blockui.min.js') !!}
	{{--<!-- /core JS files -->--}}
	{{--<!-- Theme JS files -->--}}
	{!! Html::script('js/plugins/forms/styling/uniform.min.js') !!}
	{!! Html::script('js/core/app.js') !!}
	{!! Html::script('js/pages/login.js') !!}
			<!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

		<ul class="nav navbar-nav pull-right visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="login_password_recover.html#">
					<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
				</a>
			</li>

			<li>
				<a href="login_password_recover.html#">
					<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
				</a>
			</li>

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-cog3"></i>
					<span class="visible-xs-inline-block position-right"> Options</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container login-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">

				<!-- Password recovery -->
				<form action="index.html">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
							<h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
						</div>

						<div class="form-group has-feedback">
							<input type="email" class="form-control" placeholder="Your email">
							<div class="form-control-feedback">
								<i class="icon-mail5 text-muted"></i>
							</div>
						</div>

						<button type="submit" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
				<!-- /password recovery -->


				<!-- Footer -->
				<div class="footer text-muted">
					Copyright &copy; 2014. <a href="login_password_recover.html#">Limitless admin template</a> by <a href="http://interface.club">Eugene Kopyov</a>
				</div>
				<!-- /footer -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>



@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/password/reset">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
