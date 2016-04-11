@extends('layouts.dashboard')

@section('content')

    <div class="page-container login-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- Error wrapper -->
                    <div class="container-fluid text-center">
                        <h1 class="error-title">{{$code}}</h1>
                        <h6 class="text-semibold content-group">{{$message}}</h6>
                        <blockquote class="no-margin">
                            {{$quote}}
                            <footer>{{$author}} ,<cite title="Source Title">{{$source}}</cite></footer>
                        </blockquote>

                        <blockquote><br/>

                        </blockquote>

                        @if (Auth::check())
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <a href="{{URL::action('Auth\DashboardController@index')}}" class="btn btn-primary btn-block content-group"><i
                                                class="icon-circle-left2 position-left"></i> Go to dashboard</a>
                                </div>

                            </div>
                        @endif

                    </div>
                    <!-- /error wrapper -->


                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
@stop