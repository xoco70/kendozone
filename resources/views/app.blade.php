<!DOCTYPE html>
<html>
    <head>
        <title>Kendo Online</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        {!! Html::style('css/login.css') !!}

    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    @yield('footer')
    </body>
</html>
