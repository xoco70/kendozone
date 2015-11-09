<!DOCTYPE html>
<html>
<head>
    <title>{!! $currentModelName !!}es</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
          integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    {!! Html::style('css/crud.css') !!}
    {!! Html::script('js/delete.js') !!}


</head>
<body>
<div class="container">

    <h1>{!! $currentModelName !!}es</h1>
    <hr/>
    <div class="container">
        <div class="row col-md-12 custyle">
            <table class="table table-striped custab">
                <thead>
                <a href="{!!   URL::action('AssociationController@create') !!}" class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])</a>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('crud.name') }}</th>

                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($associations as $association)
                    <tr>
                        <td>{{ $association->id }}</td>
                        <td>{{ $association->name }}</td>

                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="{!!   URL::action('AssociationController@edit',  $association->id) !!}">
                                <span class="glyphicon glyphicon-edit"></span> {{ trans('crud.edit') }}</a>
                            <a class="btn btn-danger btn-xs"
                               href="{!! URL::action('AssociationController@destroy',  $association->id) !!}" data-method="delete" data-token="{{csrf_token()}}">
                                <span class="glyphicon glyphicon-remove"></span> {{ trans('crud.delete') }}</a>
                        </td>
                    </tr>
                            <a href="{{url('associations', $association->id)}}"> </a></h2>

                @endforeach

            </table>
        </div>
    </div>

</div>
</body>
</html>
<script>
    jQuery(function () {

        var larail = {

            // Define the name of the hidden input field for method submission
            methodInputName: '_method',
            // Define the name of the hidden input field for token submission
            tokenInputName: '_token',
            // Define the name of the meta tag from where we can get the csrf-token
            metaNameToken: 'csrf-token',

            initialize: function()
            {
                $('a[data-method]').on('click', this.handleMethod);
            },

            handleMethod: function(e)
            {
                var link = $(this),
                        httpMethod = link.data('method').toUpperCase(),
                        confirmMessage = link.data('confirm'),
                        form;

                // Exit out if there is no data-methods of PUT or DELETE.
                if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1)
                {
                    return;
                }

                // Allow user to optionally provide data-confirm="Are you sure?"
                if (confirmMessage)
                {
                    if ( ! confirm(confirmMessage))
                    {
                        link.blur();
                        return false;
                    }
                }

                e.preventDefault();

                form = larail.createForm(link);
                form.submit();
            },

            createForm: function(link)
            {
                var form = $('<form>',
                        {
                            'method': 'POST',
                            'action': link.prop('href')
                        });

                var token =	$('<input>',
                        {
                            'type': 'hidden',
                            'name': larail.tokenInputName,
                            'value': $('meta[name=' + larail.metaNameToken + ']').prop('content')
                        });

                var method = $('<input>',
                        {
                            'type': 'hidden',
                            'name': larail.methodInputName,
                            'value': link.data('method')
                        });

                return form.append(token, method).appendTo('body');
            }
        };

        larail.initialize();

    });
</script>
