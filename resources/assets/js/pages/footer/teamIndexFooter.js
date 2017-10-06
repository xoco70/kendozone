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
                        flash(data.msg, 'error');
                        var btnDelete = $('.btnDeleteTeam');
                        btnDelete.prop("disabled", false);
                        btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

                    }
                },
                error: function (data) {
                    data = JSON.parse(data.responseText);
                    flash(data.responseText, 'error');

                    var btnDelete = $('.btnDeleteTeam');
                    btnDelete.prop("disabled", false);
                    btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

                }
            }
        )

    });
});
