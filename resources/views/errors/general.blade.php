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
                        <h1 class="error-title">
                            @if ($code ==404)
                                <img src="/images/errors/404.png" alt="404 Not Found"/>
                            @else
                                {{$code}}
                            @endif
                        </h1>
                        <h1 class="text-semibold content-group text-uppercase">{{$message}}</h1>
                        <blockquote class="no-margin">
                            {{$quote}}
                            <footer>{{$author}} ,<cite title="Source Title">{{$source}}</cite></footer>
                        </blockquote>

                        <blockquote><br/>

                        </blockquote>

                        @if (Auth::check())
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <a href="{{URL::action('DashboardController@index')}}"
                                       class="btn btn-primary btn-block content-group"><i
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