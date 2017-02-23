
$(function () {
    let dateFin = $('#dateFin').val();
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        jqXHR.setRequestHeader('X-CSRF-Token', csrfToken);
    });

    let currentTabId= '"#' + activeTab+'"';
    console.log(currentTabId);
    $('.nav-tabs a[href='+currentTabId+']').tab('show');


// Send active tabId in request
    $('#tab1').click(function () {
        $("#activeTab").val("general");
    });

    $('#tab3').click(function () {
        $("#activeTab").val("categories");
    });


    $('.fightDuration').timepicker(('option', {
        'minTime': '2:00',
        'maxTime': '10:00',
        'timeFormat': 'H:i',
        'step': '15'
    }));

    $('.enchoDuration').timepicker(('option', {
        'minTime': '1:00',
        'maxTime': '10:00',
        'timeFormat': 'H:i',
        'step': '15'
    }));

    $('#name').blur(function () {
        let name = $(this).val();
        if (!name || name < 6) {
            $(this).closest('div').removeClass('has-success').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });

    $('#dateIni').blur(function () {
        let dateIni = $(this).val();
        if (!dateIni) {
            $(this).closest('div').removeClass('has-success').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });

    $('#dateFin').blur(function () {
        if (!dateFin) {
            $(this).closest('div').removeClass('has-success').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });

    $('#venue').click(function () {
        $('#locationpicker-default').locationpicker({
            location: {latitude: latitude, longitude: longitude},
            radius: 300,
            inputBinding: {
                latitudeInput: $('#latitude'),
                longitudeInput: $('#longitude'),
                radiusInput: $('#us2-radius'),
                locationNameInput: $('#address')
            },
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                let addressComponents = $(this).locationpicker('map').location.addressComponents;
                $("#latitude").val(currentLocation.latitude);
                $("#longitude").val(currentLocation.longitude);
                updateControls(addressComponents);

            }, oninitialized: function (component) {

                $('#venue_name').val(venue.venue_name);
                $('#address').val(venue.address);
                $('#details').val(venue.details);
                $('#city').val(venue.city);
                $('#CP').val(venue.CP);
                $('#state').val(venue.state);
                $('#latitude').val(venue.latitude);
                $('#longitude').val(venue.longitude);
            }

        });


    });





    function updateControls(addressComponents) {
        $('#city').val(addressComponents.city);
        $('#CP').val(addressComponents.postalCode);
        $('#state').val(addressComponents.stateOrProvince);

    }

    $('input[name="hasEncho"]').on('switchChange.bootstrapSwitch', function (event, state) {
        let isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="enchoQty"]').prop('disabled', !isChecked);
        $(this).closest('form').find('[name="enchoDuration"]').prop('disabled', !isChecked);
        $(this).closest('form').find('[name="enchoTimeLimitless"]').prop('disabled', !isChecked);
    });
    $('input[name="hasPreliminary"]').on('switchChange.bootstrapSwitch', function (event, state) {
        let isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="preliminaryGroupSize"]').prop('disabled', !isChecked);
        $(this).closest('form').find('[name="preliminaryWinner"]').prop('disabled', !isChecked);

    });
    $('input[name="hasHantei"]').on('switchChange.bootstrapSwitch', function (event, state) {
        let isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="hanteiLimit"]').prop('disabled', !isChecked);
    });

// EDIT TOURNAMENT
    $('.btn-update-tour').on('click', function (e) {
        e.preventDefault();
        let inputData = $(this).parents('form:first').serialize();
        let name = $('#name');

        if (name.val() == '' || name.val().length < 6) {
            name.closest('div').removeClass('has-success').addClass('has-error');
        } else {
            name.closest('div').removeClass('has-error').addClass('has-success');
        }
        $(this).find('i').addClass('icon-spinner spinner position-left');
        $(this).prop("disabled", true);
        let btnUpdateTour = $('.btn-update-tour');

        $.ajax(
            {
                type: 'PUT',
                url: url_edit,
                data: inputData,

                success: function (data) {

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
                        let tournamentType = $('[name="type"]').is(':checked');
                        if (tournamentType) $('#share_tournament').show();
                        else $('#share_tournament').hide();

                        // Set Venue Badge
                        let venueSize = $('[name="venue_name"]').val().length;
                        let latSize = $('[name="latitude"]').val().length;
                        let longSize = $('[name="longitude"]').val().length;

                        if (venueSize > 0 && latSize > 0 && longSize > 0) {
                            $('#venue-status').show();
                        } else {
                            $('#venue-status').hide();
                        }


                    } else {
                        btnUpdateTour.prop("disabled", false);
                        btnUpdateTour.find('i').removeClass('icon-spinner spinner position-left');
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'warning',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: url_edit,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                    }

                },
                error: function (data) {
                    let text = "";
                    let json = data.responseText;
                    let obj = null;
                    try {
                        obj = jQuery.parseJSON(json);
                        if (obj.hasOwnProperty('venue_name')) {
                            text += obj.venue_name[0] + "<br/>";
                        }
                        if (obj.hasOwnProperty('CP')) {
                            text += obj.CP[0] + "<br/>";
                        }
                    } catch (err) {
                        text = "Server Error";
                    }

                    btnUpdateTour.prop("disabled", false);
                    btnUpdateTour.find('i').removeClass('icon-spinner spinner position-left');
                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'error',
                        width: 200,
                        dataType: 'json',
                        dismissQueue: true,
                        timeout: 5000,
                        text: text,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

                    });


                }
            }
        );
    });

//EDIT CATEGORIES
    let categoriesSize = null;

    $('.save_category').on('click', function (e) {
        e.preventDefault();
        let inputData = $('.save_category').serialize();
        let form = $(this).parents('form:first');
        inputData = form.serialize();
        // let tournamentId = form.data('tournament');
        let championshipId = form.data('championship');
        let settingId = form.data('setting');

        $(this).find('i').removeClass();
        $(this).find('i').addClass('icon-spinner spinner position-left');
        $(this).prop("disabled", true);
        let panel = $(this).closest('.panel');

        let method = null;
        let url = null;
        if ((typeof settingId === "undefined")) {
            method = 'POST';
            url = url_api_root + '/championships/' + championshipId + '/settings';
        } else {
            method = 'PUT';
            url = url_api_root + '/championships/' + championshipId + '/settings/' + settingId;

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
                        let catsize = $(".category-size");
                        if (method == 'POST') {
                            categoriesSize = parseInt(catsize.text(), 10) + 1;
                            catsize.html(categoriesSize)
                        }
                        if (categoriesSize == allCategoriesSize) {
                            $('#categories-status').removeClass().addClass('badge badge-success');
                            // Show Add Competitors Button
                            $('#add_competitors').removeClass('hide');
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
        infoText: '',
        nonSelectedListLabel: 'Non-selected',
        selectedListLabel: 'Selected',

    });

    $(".switch").bootstrapSwitch();


    let $input = $('.dateFin').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: ''
    });
    let $input2 = $('.dateLimit').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: ''
    });

    let pickerFin = $input.pickadate('picker');
    let pickerLimit = $input2.pickadate('picker');

    $('.dateIni').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: '',

        onSet: function () {
            if (this.get('select') != null) {
                pickerFin.set('min', this.get('select'));
                pickerLimit.set('min', this.get('select'));
            }

            if (pickerFin.get() < this.get()) {
                pickerFin.clear();
            }
            if (pickerLimit.get() < this.get()) {
                pickerLimit.clear();
            }

        }

    });

    $('.datelimit').pickadate({
        min: ['<?php echo e($year); ?>', '<?php echo e($month); ?>', '<?php echo e($day); ?>'],
        format: 'yyyy-mm-dd',
        today: '',
        clear: '',
        close: ''
    });

})
;
