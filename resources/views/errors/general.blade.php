@extends('layouts.dashboard')
@section('scripts')
    @unless(empty($sentryID))
        <!-- Sentry JS SDK 2.1.+ required -->
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
            Raven.showReportDialog({
                eventId: '{{ $sentryID }}',

                // use the public DSN (dont include your secret!)
                dsn: 'http://12b22a4d7f744c36988a88b521796f2a@bugs.kendozone.com/2'
            });
        </script>
    @endunless
@stop
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
                            <img src="/images/errors/{{$code}}.png" alt="404 Not Found"/>
                        </h1>
                        <h1 class="text-semibold content-group text-uppercase">{{$message}}</h1>
                        <blockquote class="no-margin">
                            {{$quote}}
                            <footer>{{$author}} ,<cite title="Source Title">{{$source}}</cite></footer>
                        </blockquote>

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