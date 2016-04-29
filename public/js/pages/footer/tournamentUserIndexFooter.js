$(function () {

    $('.btnDeleteTCU').on('click', function (e) {
        e.preventDefault();
        var inputData = $('#formDeleteTCU').serialize();
        //var tournamentSlug      =   $(this).data('tournament');
        var categoryId = $(this).data('category');
        var userSlug = $(this).data('user');

//                console.log(inputData);
//        console.log(tournamentSlug);
//        console.log(categoryId);
//         console.log(url + '/categories/' + categoryId + '/users/' + userSlug + '/delete');


        var $tr = $(this).closest('tr');
        $(this).find('i').removeClass();
        $(this).find('i').addClass('icon-spinner spinner');

        var menuId = $('.menu[data-id=' + categoryId + ']');
        console.log(menuId);
        var categoriesSize = parseInt(menuId.text(), 10) - 1;
        menuId.html(categoriesSize);

        $.ajax(
            {
                type: 'DELETE',
                url: url + '/categories/' + categoryId + '/users/' + userSlug + '/delete',
                data: inputData,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

                        });
                        $tr.remove();
                        // catsize.html(categoriesSize)

                    } else {
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                        $('.btnDeleteTCU').prop("disabled", false);
                        $('.btnDeleteTCU').find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-remove');

                    }


                },
                error: function (data) {
                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 5000,
                        text: data.statusText,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
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
        var categoryId = $(this).data('category');
        var userSlug = $(this).data('user');

//                console.log(inputData);
//        console.log(tournamentSlug);
//         console.log(inputData);
        console.log(url + '/categories/' + categoryId + '/users/' + userSlug + '/confirm');


        var icon = $(this).find('i');
        //console.log(icon);
        var myclass = icon.attr('class')
        // console.log(myclass);
        icon.removeClass();
        icon.addClass('icon-spinner spinner');
        var confirmId = 'confirm_' + tournamentSlug + '_' + categoryId + '_' + userSlug;

        $.ajax(
            {
                type: 'POST',
                url: url + '/categories/' + categoryId + '/users/' + userSlug + '/confirm',
                data: inputData,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

                        });
                        $('#' + confirmId).prop("disabled", false);
                        $('#' + confirmId).find('i').removeClass('icon-spinner spinner position-left').addClass(myclass);
                        $('#' + confirmId).find('i').toggleClass("text-danger text-success");
                        $('#' + confirmId).find('i').toggleClass("glyphicon-ok-sign glyphicon-remove-sign");
                    } else {
                        // console.log(data);
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                        $('.btnConfirmTCU').prop("disabled", false);
                        $('.btnConfirmTCU').find('i').removeClass('icon-spinner spinner position-left').addClass(myclass);
                        $('.btnConfirmTCU').find('i').toggleClass("text-warning-600 text-success");
                    }


                },
                error: function (data) {
                    //console.log(data);
                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 5000,
                        text: data.statusText,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
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
    autoWidth: true,
    responsive: true,
    paging: false,
    columnDefs: [{
        orderable: true,
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
            orderable: true,
            targets: [6]
        }
    ]
});


// External table additions
// ------------------------------

// Add placeholder to the datatable filter option
$('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');

// Info alert
$('#generate_tree').on('click', function () {
    swal({
        title: "{!! trans('core.information') !!}",
        text: "{!!   trans('core.all_categories_not_configured') !!}",
        confirmButtonColor: "#2196F3",
        type: "info"
    });
});