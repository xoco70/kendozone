$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    jqXHR.setRequestHeader('X-CSRF-Token', csrfToken);
});
$(function () {
    var disabled = false;
    var tr = null;

    // Initialize responsive functionality
    $('.table-togglable').footable();
    $(document).on('click', '.undo', function (e) {
        e.preventDefault();
        //e.stopPropagation();

        tr = $(this).closest('tr');
        var dataRestore = tr.attr('id');
        console.log(dataRestore);


        $.ajax(
            {
                type: 'POST',
                url: url_restore + '/' + dataRestore + '/restore',
                data: dataRestore,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        tr.hide();
                        data = JSON.parse(data.responseText);
                        flash(data.msg);
                    } else {
                        flash(data.statusText, 'error');
                    }
                },
                error: function (data) {
                    data = JSON.parse(data.responseText);
                    flash(data.responseText, 'error');
                }
            }
        )

    });

});