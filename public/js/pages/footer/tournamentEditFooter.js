$(function () {

    $('input[name="isTeam"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="teamSize"]').prop('disabled', !isChecked);
    });
    $('input[name="hasEncho"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="enchoQty"]').prop('disabled', !isChecked);
        $(this).closest('form').find('[name="enchoDuration"]').prop('disabled', !isChecked);
    });
    $('input[name="hasRoundRobin"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="roundRobinWinner"]').prop('disabled', !isChecked);
    });

    // EDIT TOURNAMENT
    $('.btn-update-tour').on('click', function (e) {
        e.preventDefault();
        var inputData = $('#form').serialize();
        var dataId = $(this).data('id');

        $(this).find('i').addClass('icon-spinner spinner position-left');
        $(this).prop("disabled", true);
        console.log(url_edit);
        $.ajax(
            {
                type: 'PUT',
                url: url_edit,
                data: inputData,
                success: function (data) {
                    console.log(data);
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'topRight',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg
                        });
//                                console.log()
                        $('.btn-update-tour').prop("disabled", false);
                        $('.btn-update-tour').find('i').removeClass('icon-spinner spinner position-left');

                        // Show / Hide Share Tournament Link
                        var tournamentType = $('[name="type"]').is(':checked');
                        if (tournamentType) $('#share_tournament').show();
                        else $('#share_tournament').hide();

                        // Set Venue Badge
                        var venueSize = $('[name="venue"]').val().length;
                        var latSize = $('[name="latitude"]').val().length;
                        var longSize = $('[name="longitude"]').val().length;
                        console.log(venueSize);
                        console.log(latSize);
                        console.log(longSize);
                        if (venueSize > 0 && latSize > 0 && longSize > 0) {
                            $('#venue-status').show();
                        } else {
                            $('#venue-status').hide();
                        }


                    } else {
                        noty({
                            layout: 'topRight',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: url_edit
                        });
                        $('.btn-update-tour').prop("disabled", false);
                        $('.btn-update-tour').find('i').removeClass('icon-spinner spinner position-left');
                        //form.attr('data-setting', data.settingId);


                        //$(this).find('i').removeClass('');

                    }

                },
                error: function (data) {
                    noty({
                        layout: 'topRight',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 3000,
                        text: data.msg,

                    });
                    $(this).prop("disabled", false);
                    $(this).find('i').removeClass('icon-spinner spinner position-left')

                }
            }
        )

    });

    //EDIT CATEGORIES
    var categoriesSize = null;
    var allCategoriesSize = '{!! $categorySize !!}';

    $('.save_category').on('click', function (e) {
        e.preventDefault();
        var inputData = $('.save_category').serialize();
        var form = $(this).parents('form:first');
        var tournamentId = form.data('tournament');
        var categoryId = form.data('category');
        var settingId = form.data('setting');

        $(this).find('i').removeClass();
        $(this).find('i').addClass('icon-spinner spinner position-left');
        $(this).prop("disabled", true);
        var panel = $(this).closest('.panel');

        var method = null;
        var url = null;

        if ((typeof settingId === "undefined")) {
            method = 'POST';
            url = url_base + '/' + tournamentId + '/categories/' + categoryId + '/settings';
        } else {
            method = 'PUT';
            url = url_base + '/' + tournamentId + '/categories/' + categoryId + '/settings/' + settingId;
        }
        $.ajax(
            {
                type: method,
                url: url,
                data: inputData,
                success: function (data) {
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'topRight',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg
                        });
                        // Change warning icon to success
                        panel.find('.status-icon').removeClass().addClass('glyphicon glyphicon-ok text-success status-icon');
                        form.attr('data-setting', data.settingId);
                        if (method == 'POST') {
                            categoriesSize = parseInt($(".category-size").text(), 10) + 1;
                            $('.category-size').html(categoriesSize)
                        }
                        if (categoriesSize == allCategoriesSize) {
                            $('#categories-status').removeClass().addClass('badge badge-success');
                        }


                    } else {
                        noty({
                            layout: 'topRight',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg
                        });
                    }
                    $('.save_category').prop("disabled", false);
                    $('.save_category').find('i').removeClass('icon-spinner spinner position-left');


                },
                error: function (data) {
                    noty({
                        layout: 'topRight',
                        type: 'error',
                        width: 200,
                        dismissQueue: true,
                        timeout: 3000,
                        text: data.msg
                    });
                    $('.save_category').prop("disabled", false);
                    $('.save_category').find('i').removeClass('icon-spinner spinner position-left');
                }

            }
        )

    });

    $('.listbox-filter-disabled').bootstrapDualListbox({
        showFilterInputs: false
    });

    $(".switch").bootstrapSwitch();

    $('.datetournament').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
    format: 'yyyy-mm-dd'
});
    $('.datelimit').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
    format: 'yyyy-mm-dd'
});

    $('#generate_tree').on('click', function () {
        swal({
            title: "{!! trans('core.information') !!}",
            text: "{!!   trans('crud.all_categories_not_configured') !!}",
            confirmButtonColor: "#2196F3",
            type: "info"
        });
    });
    $(".accordion-sortable").sortable({
        connectWith: '.accordion-sortable',
        items: '.panel',
        helper: 'original',
        cursor: 'move',
        handle: '[data-action=move]',
        revert: 100,
        containment: '.content',
        forceHelperSize: true,
        placeholder: 'sortable-placeholder',
        forcePlaceholderSize: true,
        tolerance: 'pointer',
        start: function (e, ui) {
            ui.placeholder.height(ui.item.outerHeight());
        }
    });


});
