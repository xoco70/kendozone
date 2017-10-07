$(function () {
    var disabled = false;
    var tr = null;
    // Initialize responsive functionality
    $('.table-togglable').footable();
    $(document).on('click', '.undo', function (e) {
        e.preventDefault();
        var dataRestore = $(this).data('restore');
        axios.post(url_api_root + '/associations/' + dataRestore + '/restore', dataRestore).then(function (response) {
            console.log(response);
            if (response.data != null && response.data.status == 'success') {
                tr.show();
                $.noty.closeAll()
            } else {
                flash(response.msg, 'error');
                var btnDelete = $('.btnDelete');
                btnDelete.prop("disabled", false);
                btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');

            }
        }).catch(function (response) {
            console.log(response);
            flash(response.statusText, 'error');
        });
    });
    $('.btnDelete').on('click', function (e) {
        e.preventDefault();
        var inputData = $('#formDelete').serialize();
        var dataId = $(this).data('id');
        tr = $(this).closest('tr');
        $(this).find('i').removeClass();
        $(this).find('i').addClass('icon-spinner spinner');

        axios.post(url + '/' + dataId, inputData).then(function (response) {
            if (response.data != null && response.data.status == 'success') {
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
                    "<div class='row'><div class='col-xs-8'>" + response.data.msg + "</div>" +
                    "<div class='col-xs-3' align='right'><a class='undo' href='" + url + "/" + dataId + "/restore' data-restore='" + dataId + "'><span class='undo_link'>UNDO</span> </a></div>" +
                    "</div>"
                });
                $('.icon-spinner').removeClass().addClass('glyphicon glyphicon-trash');
                tr.hide();
            } else {
                flash(response.responseText, 'error');
                btnDelete = $('.btnDelete');
                btnDelete.prop("disabled", false);
                btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');
            }
        }).catch(function (response) {
            flash(response.statusText, 'error');
            var btnDelete = $('.btnDelete');
            btnDelete.prop("disabled", false);
            btnDelete.find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-trash');
        });
    });
});
