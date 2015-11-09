@extends('layouts.dashboard')

@section('content')

    <h1>{!! $currentModelName !!}es</h1>
    <hr/>
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif
    <div class="container">
        <div class="row col-md-12 custyle">
            <table class="table table-striped custab">
                <thead>
                <a href="{!!   URL::action('ShiaiCategoryController@create') !!}" class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])</a>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('crud.tournament') }}</th>
                    <th>{{ trans('crud.category') }}</th>

                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($shiaiCategories as $shiaiCategory)
                    <tr>
                        <td>{{ $shiaiCategory->id }}</td>
                        <td>{{ $shiaiCategory->name }}</td>

                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="{!!   URL::action('PlaceController@edit',  $shiaiCategory->id) !!}">
                                <span class="glyphicon glyphicon-edit"></span> {{ trans('crud.edit') }}</a>
                            <a class="btn btn-danger btn-xs"
                               href="{!! URL::action('PlaceController@destroy',  $shiaiCategory->id) !!}" data-method="delete" data-token="{{csrf_token()}}">
                                <span class="glyphicon glyphicon-remove"></span> {{ trans('crud.delete') }}</a>
                        </td>
                    </tr>
                            <a href="{{url('shiaiCategory', $shiaiCategory->id)}}"> </a></h2>

                @endforeach

            </table>
        </div>
    </div>
@stop
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
