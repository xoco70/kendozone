<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

    {{--{!! Html::style('js/all.css')!!}--}}
    {{--{!! Html::style('js/plugins/all.css')!!}--}}
    {{--{!! Html::script('js/plugins/all.js') !!}--}}
    {{--{!! Html::style('css/all.css')!!}--}}
    {{--{!! Html::script('js/all.js') !!}--}}

    {!! Html::style('js/plugins/bootstrap/css/bootstrap.css')!!}
    {!! Html::style('js/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css')!!}
    {!! Html::style('fonts/awesome/css/font-awesome.min.css')!!}
    {!! Html::style('js/plugins/bootstrap.summernote/summernote.css')!!}
    {!! Html::style('js/plugins/datepicker/css/bootstrap-datetimepicker.min.css')!!}
    {!! Html::style('js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')!!}
    {!! Html::style('js/plugins/select2/select2.css')!!}
    {!! Html::style('js/plugins/iCheck/skins/square/green.css')!!}
    {!! Html::style('js/plugins/fancybox/jquery.fancybox.css') !!}
    {!! Html::style('css/sximo.css')!!}
    {!! Html::style('css/animate.css')!!}
    {!! Html::style('css/icons.min.css')!!}
    {!! Html::style('js/plugins/toastr/toastr.css')!!}
    {!! Html::style('css/crud.css') !!}


    {!! Html::script('js/plugins/jquery.min.js') !!}
    {!! Html::script('js/plugins/jquery.cookie.js') !!}
    {!! Html::script('js/plugins/jquery-ui.min.js') !!}
    {!! Html::script('js/plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('js/plugins/select2/select2.min.js') !!}
    {!! Html::script('js/plugins/fancybox/jquery.fancybox.js') !!}
    {!! Html::script('js/plugins/prettify.js') !!}
    {!! Html::script('js/plugins/parsley.js') !!}
    {!! Html::script('js/plugins/datepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('js/plugins/switch.min.js') !!}
    {!! Html::script('js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('js/plugins/bootstrap/js/bootstrap.js') !!}
    {!! Html::script('js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    {!! Html::script('js/sximo.js') !!}
    {!! Html::script('js/plugins/jquery.jCombo.min.js') !!}
    {!! Html::script('js/plugins/toastr/toastr.js') !!}
    {!! Html::script('js/plugins/bootstrap.summernote/summernote.min.js') !!}
    {!! Html::script('js/delete.js') !!}



    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body class="sxim-init" >
<div id="wrapper">
    @include('layouts.sidemenu')
    <div class="gray-bg " id="page-wrapper">
        @include('layouts.headmenu')
        @include('layouts.flash')
        @yield('content')
    </div>

</div>

<div class="modal fade" id="sximo-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">

                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $('#sidemenu').sximMenu();



    });

//    jQuery(function () {
//
//        var larail = {
//
//            // Define the name of the hidden input field for method submission
//            methodInputName: '_method',
//            // Define the name of the hidden input field for token submission
//            tokenInputName: '_token',
//            // Define the name of the meta tag from where we can get the csrf-token
//            metaNameToken: 'csrf-token',
//
//            initialize: function()
//            {
//                $('a[data-method]').on('click', this.handleMethod);
//            },
//
//            handleMethod: function(e)
//            {
//                var link = $(this),
//                        httpMethod = link.data('method').toUpperCase(),
//                        confirmMessage = link.data('confirm'),
//                        form;
//
//                // Exit out if there is no data-methods of PUT or DELETE.
//                if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1)
//                {
//                    return;
//                }
//
//                // Allow user to optionally provide data-confirm="Are you sure?"
//                if (confirmMessage)
//                {
//                    if ( ! confirm(confirmMessage))
//                    {
//                        link.blur();
//                        return false;
//                    }
//                }
//
//                e.preventDefault();
//
//                form = larail.createForm(link);
//                form.submit();
//            },
//
//            createForm: function(link)
//            {
//                var form = $('<form>',
//                        {
//                            'method': 'POST',
//                            'action': link.prop('href')
//                        });
//
//                var token =    $('<input>',
//                        {
//                            'type': 'hidden',
//                            'name': larail.tokenInputName,
//                            'value': $('meta[name=' + larail.metaNameToken + ']').prop('content')
//                        });
//
//                var method = $('<input>',
//                        {
//                            'type': 'hidden',
//                            'name': larail.methodInputName,
//                            'value': link.data('method')
//                        });
//
//                return form.append(token, method).appendTo('body');
//            }
//        };
//
//        larail.initialize();
//
//    });

</script>

</body>
</html>