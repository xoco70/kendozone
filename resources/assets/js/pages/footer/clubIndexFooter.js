$(function () {
    var disabled = false;
    var tr = null;

    // Initialize responsive functionality
    $('.table-togglable').footable();
    $(document).on('click', '.undo', function (e) {
        e.preventDefault();
        //e.stopPropagation();
        var dataRestore = $(this).data('restore');

        $.ajax(
            {
                type: 'GET',
                url: url + '/' + dataRestore + '/restore',
                data: dataRestore,
                success: function (data) {
                    // console.log(data);
                    if (data != null && data.status == 'success') {
                        tr.show();
                        $.noty.closeAll()

                    } else {
                        flash(data.msg, 'error')
                        var btnDelete = $('.btnDeleteClub');
                        btnDelete.prop("disabled", false);
                        btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

                    }


                },
                error: function (data) {
                    data = JSON.parse(data.responseText);
                    flash(data.responseText, 'error');
                }
            }
        )

    });
    $('.btnDeleteClub').on('click', function (e) {
        e.preventDefault();
        var inputData = $('#formDeleteClub').serialize();
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
                            text: "<a href='#' class='undo_link'></a>" +
                            "<div class='row'><div class='col-xs-8'>" + data.msg + "</div>" +
                            "<div class='col-xs-3' align='right'><a class='undo' href='" + url + "/" + dataId + "/restore' data-restore='" + dataId + "'><span class='undo_link'>UNDO</span> </a></div>" +
                            "</div>"


                        });
                        $('.icon-spinner').removeClass().addClass('glyphicon glyphicon-trash');
                        tr.hide();
                    } else {
                        flash(data.msg, 'error')
                        let btnDelete = $('.btnDeleteClub');
                        btnDelete.prop("disabled", false);
                        btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');
                    }
                },
                error: function (data) {
                    data = JSON.parse(data.responseText);
                    flash(data.responseText, 'error');
                    let btnDelete = $('.btnDeleteClub');
                    btnDelete.prop("disabled", false);
                    btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

                }
            }
        )

    });
});
