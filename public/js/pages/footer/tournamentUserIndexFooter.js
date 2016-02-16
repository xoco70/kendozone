$(function () {

    $('.btnDeleteTCU').on('click', function (e) {
        e.preventDefault();
        var inputData = $('#formDeleteTCU').serialize();
        //var tournamentSlug      =   $(this).data('tournament');
        var categoryId          =   $(this).data('category');
        var userSlug            =   $(this).data('user');

//                console.log(inputData);
//        console.log(tournamentSlug);
//        console.log(categoryId);
        console.log(url + '/categories/' + categoryId + '/users/' + userSlug + '/delete');


        var $tr = $(this).closest('tr');
        $(this).find('i').removeClass();
        $(this).find('i').addClass('icon-spinner spinner');

        $.ajax(
            {
                type: 'DELETE',
                url: url + '/categories/' + categoryId + '/users/' + userSlug + '/delete',
                data: inputData,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'bottomLeft',
                            width: 200,
                            dismissQueue: true,
                            timeout: 10000,
                            text: data.msg,
                            closeWith: ['click']

                        });
                        $tr.remove();
                    } else {
                        console.log(data);
                        noty({
                            layout: 'topRight',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg
                        });
                        $('.btnDeleteTCU').prop("disabled", false);
                        $('.btnDeleteTCU').find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-remove');

                    }


                },
                error: function (data) {
                    console.log("error");
                    noty({
                        layout: 'topRight',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 3000,
                        text: data.statusText
                    });
                }
            }
        )

    });


    $('.btnConfirmTCU').on('click', function (e) {
        e.preventDefault();
        $(this).prop("disabled", true);

        var inputData = $('#formConfirmTCU').serialize();
        //var tournamentSlug      =   $(this).data('tournament');
        var categoryId          =   $(this).data('category');
        var userSlug            =   $(this).data('user');

//                console.log(inputData);
//        console.log(tournamentSlug);
        console.log(inputData);
        console.log(url + '/categories/' + categoryId + '/users/' + userSlug + '/confirm');


        var icon = $(this).find('i');
        //console.log(icon);
        var myclass = icon.attr('class')
        console.log(myclass);
        icon.removeClass();
        icon.addClass('icon-spinner spinner');
        var confirmId = 'confirm_'+tournamentSlug+'_'+categoryId+'_'+userSlug;

        $.ajax(
            {
                type: 'POST',
                url: url + '/categories/' + categoryId + '/users/' + userSlug + '/confirm',
                data: inputData,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'bottomLeft',
                            type: 'information',
                            width: 200,
                            dismissQueue: true,
                            timeout: 10000,
                            text: data.msg
                        });
                        $('#'+confirmId).prop("disabled", false);
                        $('#'+confirmId).find('i').removeClass('icon-spinner spinner position-left').addClass(myclass);
                        $('#'+confirmId).find('i').toggleClass("text-danger text-success");
                        $('#'+confirmId).find('i').toggleClass("glyphicon-ok-sign glyphicon-remove-sign");
                    } else {
                        console.log(data);
                        noty({
                            layout: 'topRight',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg
                        });
                        $('.btnConfirmTCU').prop("disabled", false);
                        $('.btnConfirmTCU').find('i').removeClass('icon-spinner spinner position-left').addClass(myclass);
                        $('.btnConfirmTCU').find('i').toggleClass("text-warning-600 text-success");
                    }


                },
                error: function (data) {
                    //console.log(data);
                    noty({
                        layout: 'topRight',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 3000,
                        text: data.statusText
                    });
                    $('.btnConfirmTCU').prop("disabled", false);
                    $('.btnConfirmTCU').find('i').removeClass('icon-spinner spinner position-left').addClass(myclass);
                }
            }
        )

    });


});



// Setting datatable defaults
$.extend($.fn.dataTable.defaults, {
    autoWidth: false,
    responsive: true,
    paging: false,
    columnDefs: [{
        orderable: false,
        width: '100px',
        targets: [5]
    }],
    dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    language: {
        search: '<span>Filter:</span> _INPUT_',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
    },
    drawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
    },
    preDrawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
    },


});


// Basic responsive configuration
$('.datatable-responsive').DataTable();


// Column controlled child rows
$('.datatable-responsive-column-controlled').DataTable({
    responsive: {
        details: {
            type: 'column'
        }
    },
    columnDefs: [
        {
            className: 'control',
            orderable: false,
            targets: 0
        },
        {
            width: "100px",
            targets: [6]
        },
        {
            orderable: false,
            targets: [6]
        }
    ],
});


// External table additions
// ------------------------------

// Add placeholder to the datatable filter option
$('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');

// Info alert
$('#generate_tree').on('click', function () {
    swal({
        title: "{!! trans('core.information') !!}",
        text: "{!!   trans('crud.all_categories_not_configured') !!}",
        confirmButtonColor: "#2196F3",
        type: "info"
    });
});