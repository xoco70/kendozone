$(function () {
    $('#locationpicker-default').locationpicker({
        location: {latitude: latitude, longitude: longitude},
        radius: 300,
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            radiusInput: $('#us2-radius'),
            locationNameInput: $('#city')
        }
    });

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
                    // console.log(data);
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
                        // console.log(venueSize);
                        // console.log(latSize);
                        // console.log(longSize);
                        if (venueSize > 0 && latSize > 0 && longSize > 0) {
                            $('#venue-status').show();
                        } else {
                            $('#venue-status').hide();
                        }


                    } else {
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: url_edit,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                        $('.btn-update-tour').prop("disabled", false);
                        $('.btn-update-tour').find('i').removeClass('icon-spinner spinner position-left');
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
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 3000,
                            text: data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                        // Change warning icon to success
                        //$('#one span').text('Hi I am replace');
                        panel.find('.status-icon').removeClass().addClass('glyphicon glyphicon-ok  status-icon');
                        panel.find('.text-orange-600').removeClass().addClass('text-success');
                        panel.find('.cat-state').text(configured);

                        form.attr('data-setting', data.settingId);

                        if (method == 'POST') {
                            categoriesSize = parseInt($(".category-size").text(), 10) + 1;
                            $('.category-size').html(categoriesSize)
                        }
                        // console.log(categoriesSize);
                        console.log(allCategoriesSize);
                        if (categoriesSize == allCategoriesSize) {
                            $('#categories-status').removeClass().addClass('badge badge-success');
                        }


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
                    }
                    $('.save_category').prop("disabled", false);
                    $('.save_category').find('i').removeClass('icon-spinner spinner position-left');


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
                    $('.save_category').prop("disabled", false);
                    $('.save_category').find('i').removeClass('icon-spinner spinner position-left');
                }

            }
        )

    });

    $('.listbox-filter-disabled').bootstrapDualListbox({
        showFilterInputs: false,
        setMoveSelectedLabel: 'go'
    });

    $(".switch").bootstrapSwitch();



    $('#dateIni').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        onSet: function(context) {

             var dateIni = new Date(context.select);
             var year = $.format.date(dateIni, "yy");
             var year4digits = $.format.date(dateIni, "yyyy");
             var month = $.format.date(dateIni, "MM");
             var day = $.format.date(dateIni, "dd");
             var $dateFin = $('#dateFin');

            $dateFin.val(year4digits + '-' + month + '-' + day); // This works well
            $dateFin.pickadate({
                    min: [year, month,day]
            });
        }

    });
    $('#dateFin').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd'
    });
    // $('#dateIni').on('change', function (e) {
        // alert($.format.date(this.value, "yy"));
    // $('#registerDateLimit').val(this.value);


        // $dateFin.val(this.value);
        // $dateFin.pickadate({
        //         min: [, , ,]
        //
        // });



    // });

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
