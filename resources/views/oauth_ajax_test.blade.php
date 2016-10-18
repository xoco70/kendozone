@extends('layouts.dashboard')
@section('content')
    Seccion de prueba de Oauth<br/>

@stop
@section('scripts_footer')
    <script>
        var app=new Vue({
            el:'body',
            methods:{

            },
            ready:function () {
                this.$http.get('/api/user')
                        .then(response => {
                            console.log(response.data);
                        });
            }
        });


    </script>
@stop