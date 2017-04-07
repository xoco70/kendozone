$(function () {
    // Check if register date limit
    var CurrentDate = new Date();
    var split = registerDateLimit.split("-");
    var dateLimit = new Date(split[0], split[1], split[2]);
    if (dateLimit < CurrentDate) {
        swal({
                title: tournament_date_is_in_the_past_title,
                text: tournament_date_is_in_the_past_text,
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: "OK",
                closeOnConfirm: true,
            },
            function (isConfirm) {
                if (isConfirm) {
//                        form.submit();
                    window.location.replace(url_edit);
                }
            });

    }


});