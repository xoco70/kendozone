$(function () {

    var currentTabId= '"#' + activeTab+'"';
    $('.nav-tabs a[href='+currentTabId+']').tab('show');


    var disabled = false;
    var tr = null;

    // Initialize responsive functionality
    $('.table-togglable').footable();

    $('.btnDeleteTeam').on('click', function (e) {
        e.preventDefault();
        var inputData = $('#formDeleteTeam').serialize();
        var dataId = $(this).data('id');
//                console.log(inputData);
//         console.log(dataId);
        tr = $(this).closest('tr');
        $(this).find('i').removeClass();
        $(this).find('i').addClass('icon-spinner spinner');

        $.ajax(
            {
                type: 'POST',
                url: url + '/' + dataId,
                data: inputData,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        console.log(data);
                        noty({
                            layout: 'bottomLeft',
                            width: 200,
                            theme: 'kz',
                            type: 'success',
                            dismissQueue: true,
                            timeout: 10000,
                            force: true,
                            killer: true,
                            closeWith: ['button'],
                            text: "<a href='#' class='undo_link'></a>" +data.msg

                        });
                        $('.icon-spinner').removeClass().addClass('glyphicon glyphicon-trash');
                        tr.hide();
                    } else {
                        console.log(data);
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                        var btnDelete = $('.btnDeleteTeam');
                        btnDelete.prop("disabled", false);
                        btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

                    }
                },
                error: function (data) {
                    console.log(data);
                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 3000,
                        text: data.msg,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                    });
                    var btnDelete = $('.btnDeleteTeam');
                    btnDelete.prop("disabled", false);
                    btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

                }
            }
        )

    });
});
