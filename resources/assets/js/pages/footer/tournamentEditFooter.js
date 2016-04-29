$(function () {

    $('.fightDuration').timepicker(('option',

    {
        'minTime': '2:00',
        'maxTime': '5:00',
        'timeFormat': 'H:i',
        'step': '15'
    }));

    $('.enchoDuration').timepicker(('option',

    {
        'minTime': '1:00',
        'maxTime': '5:00',
        'timeFormat': 'H:i',
        'step': '15'
    }));

    $('#name').blur(function () {
        if (!$(this).val() || $(this).length <6) {
            $(this).closest('div').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });

    $('#dateIni').blur(function () {
        if (!$(this).val()) {
            $(this).closest('div').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });

    $('#dateFin').blur(function () {
        if (!$(this).val()) {
            $(this).closest('div').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });


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
        var name = $('#name');


        if (name.val() =='' || name.val().length <6) {
            name.closest('div').addClass('has-error');
        } else {
            name.closest('div').removeClass('has-error').addClass('has-success');
        }
        $(this).find('i').addClass('icon-spinner spinner position-left');
        $(this).prop("disabled", true);
        var btnUpdateTour = $('.btn-update-tour');

        $.ajax(
            {
                type: 'PUT',
                url: url_edit,
                data: inputData,
                success: function (data) {
                    // console.log(data.msg);
                    if (data != null && data.status == 'success') {
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 13000,
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
                        btnUpdateTour.prop("disabled", false);
                        btnUpdateTour.find('i').removeClass('icon-spinner spinner position-left');
                    }

                },
                error: function (data) {
                    var json = data.responseText;
                    var obj = jQuery.parseJSON(json);
                    // console.log(obj);
                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'error',
                        width: 200,
                        dataType: 'json',
                        dismissQueue: true,
                        timeout: 5000,
                        text:  data.responseText ,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

                    });
                    btnUpdateTour.prop("disabled", false);
                    btnUpdateTour.find('i').removeClass('icon-spinner spinner position-left');

                }
            }
        );


        // console.log(url_edit);

    });

    //EDIT CATEGORIES
    var categoriesSize = null;

    // 'form_'.$tournament->slug.'_'.$categoryId.'_'.$setting->id
    $('.save_category').on('click', function (e) {
        e.preventDefault();
        var inputData = $('.save_category').serialize();
        var form = $(this).parents('form:first');
        inputData = form.serialize();
        // console.log(inputData);
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
        // console.log(url);
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
                        var catsize = $(".category-size");
                        if (method == 'POST') {
                            categoriesSize = parseInt(catsize.text(), 10) + 1;
                            catsize.html(categoriesSize)
                        }
                        // console.log(categoriesSize);
                        // console.log(allCategoriesSize);
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

    dualList = $('.listbox-filter-disabled').bootstrapDualListbox({
        showFilterInputs: false,
        infoTextEmpty: '',
        infoText: ''

    });

    $(".switch").bootstrapSwitch();


    var $input = $('.dateFin').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: ''
    });
    var $input2 = $('.dateLimit').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: ''
    });

    var pickerFin = $input.pickadate('picker');
    var pickerLimit = $input2.pickadate('picker');

    $('.dateIni').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: '',

        onSet: function () {
            pickerFin.set('min', this.get('select'));
            pickerLimit.set('min', this.get('select'));

            if (pickerFin.get() < this.get()){
                pickerFin.clear();
            }
            if (pickerLimit.get() < this.get()){
                pickerLimit.clear();
            }

        }

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
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: ''
    });

    $('#generate_tree').on('click', function () {
        swal({
            title: "{!! trans('core.information') !!}",
            text: "{!!   trans('core.all_categories_not_configured') !!}",
            confirmButtonColor: "#2196F3",
            type: "info"
        });
    });
    // $(".accordion-sortable").sortable({
    //     connectWith: '.accordion-sortable',
    //     items: '.panel',
    //     helper: 'original',
    //     cursor: 'move',
    //     handle: '[data-action=move]',
    //     revert: 100,
    //     containment: '.content',
    //     forceHelperSize: true,
    //     placeholder: 'sortable-placeholder',
    //     forcePlaceholderSize: true,
    //     tolerance: 'pointer',
    //     start: function (e, ui) {
    //         ui.placeholder.height(ui.item.outerHeight());
    //     }
    // });


});
