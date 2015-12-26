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
                        <h1 class="error-title">403</h1>
                        <h6 class="text-semibold content-group">Forbidden!</h6>
                        <blockquote class="no-margin">
                            “And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”
                            <footer>Tabitha Suzuma, <cite title="Source Title">Forbidden</cite></footer>
                        </blockquote>

                        <blockquote><br/>

                        </blockquote>


                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <a href="/" class="btn btn-primary btn-block content-group"><i
                                            class="icon-circle-left2 position-left"></i> Go to dashboard</a>
                            </div>

                        </div>


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