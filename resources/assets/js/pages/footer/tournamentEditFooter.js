$(function () {
    $.ajaxSetup({cache: true});
    $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: facebook_id,
            version: 'v2.7' // or v2.1, v2.2, v2.3, ...
        });
        $('#loginbutton,#feedbutton').removeAttr('disabled');
        FB.getLoginStatus(function () {
            // Your logic here
        });
    });
    document.getElementById('shareBtn').onclick = function () {
        FB.ui({
            method: 'share',
            display: 'popup',
            href: url_register,
        }, function (response) {
        });
    };

    document.getElementById('shareBtnShow').onclick = function () {
        FB.ui({
            method: 'share',
            display: 'popup',
            href: url_show_tournament,
        }, function (response) {
        });
    };


    var dateFin = $('#dateFin').val();
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        jqXHR.setRequestHeader('X-CSRF-Token', csrfToken);
    });

    var currentTabId = '"#' + activeTab + '"';
    $('.nav-tabs a[href=' + currentTabId + ']').tab('show');

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
        var name = $(this).val();
        if (!name || name < 6) {
            $(this).closest('div').removeClass('has-success').addClass('has-error');
        } else {
            $(this).closest('div').removeClass('has-error').addClass('has-success');
        }
    });

    $('#dateIni').blur(function () {
        var dateIni = $(this).val();
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
                var addressComponents = $(this).locationpicker('map').location.addressComponents;
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


    $('input[name="hasPreliminary"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var isChecked = $(this).is(':checked');
        $(this).closest('form').find('[name="preliminaryGroupSize"]').prop('disabled', !isChecked);
        $(this).closest('form').find('[name="preliminaryWinner"]').prop('disabled', !isChecked);

    });


// EDIT TOURNAMENT
    $('.btn-update-tour').on('click', function (e) {
        e.preventDefault();
        var inputData = $(this).parents('form:first').serialize();
        var name = $('#name');

        if (name.val() == '' || name.val().length < 6) {
            name.closest('div').removeClass('has-success').addClass('has-error');
        } else {
            name.closest('div').removeClass('has-error').addClass('has-success');
        }
        $(this).find('i').addClass('icon-spinner spinner position-left');
        $(this).prop("disabled", true);
        var btnUpdateTour = $('.btn-update-tour');
        axios.put(url_edit, inputData)
            .then(function (response) {
                console.log(response.data.msg);
                if (response.data !== null && response.data.status === "success") {
                    flash(response.data.msg);
                    $('.btn-update-tour').prop("disabled", false);
                    $('.btn-update-tour').find('i').removeClass('icon-spinner spinner position-left');

                    // Show / Hide Share Tournament Link
                    var tournamentType = $('[name="type"]').is(':checked');
                    if (tournamentType) $('#share_tournament').show();
                    else $('#share_tournament').hide();

                    // Set Venue Badge
                    var venueSize = $('[name="venue_name"]').val().length;
                    var latSize = $('[name="latitude"]').val().length;
                    var longSize = $('[name="longitude"]').val().length;

                    if (venueSize > 0 && latSize > 0 && longSize > 0) {
                        $('#venue-status').show();
                    } else {
                        $('#venue-status').hide();
                    }


                } else {
                    btnUpdateTour.prop("disabled", false);
                    btnUpdateTour.find('i').removeClass('icon-spinner spinner position-left');
                    flash(response.data.msg, 'error');
                }
            })
            .catch(function (error) {
                btnUpdateTour.prop("disabled", false);
                btnUpdateTour.find('i').removeClass('icon-spinner spinner position-left');
                flash("You must not leave venue name empty", 'error');
            });

    });

//EDIT CATEGORIES
//     var categoriesSize = null;

    // $('.save_category').on('click', function (e) {
    //     e.preventDefault();
    //     var inputData = $('.save_category').serialize();
    //     var form = $(this).parents('form:first');
    //     inputData = form.serialize();
    //     var championshipId = form.data('championship');
    //     var settingId = form.data('setting');
    //
    //     $(this).find('i').removeClass();
    //     $(this).find('i').addClass('icon-spinner spinner position-left');
    //     $(this).prop("disabled", true);
    //     var panel = $(this).closest('.panel');
    //
    //     var method = null;
    //     var url = null;
    //     if ((typeof settingId === "undefined")) {
    //         method = 'POST';
    //         url = url_api_root + '/championships/' + championshipId + '/settings';
    //     } else {
    //         method = 'PUT';
    //         url = url_api_root + '/championships/' + championshipId + '/settings/' + settingId;
    //
    //     }
    //
    //
    //     $.ajax(
    //         {
    //             type: method,
    //             url: url,
    //             data: inputData,
    //             success: function (data) {
    //                 if (data != null && data.status == 'success') {
    //                     flash(data.msg);
    //                     panel.find('.status-icon').removeClass().addClass('glyphicon glyphicon-ok  status-icon');
    //                     panel.find('.text-orange-600').removeClass().addClass('text-success');
    //                     panel.find('.cat-state').text(configured);
    //
    //                     form.attr('data-setting', data.settingId);
    //                     var catsize = $(".category-size");
    //                     if (method == 'POST') {
    //                         categoriesSize = parseInt(catsize.text(), 10) + 1;
    //                         catsize.html(categoriesSize)
    //                     }
    //                     if (categoriesSize == allCategoriesSize) {
    //                         $('#categories-status').removeClass().addClass('badge badge-success');
    //                         // Show Add Competitors Button
    //                         $('#add_competitors').removeClass('hide');
    //                     }
    //                 } else {
    //                     flash(data.msg, 'error');
    //                 }
    //                 $('.save_category').prop("disabled", false);
    //                 $('.save_category').find('i').removeClass('icon-spinner spinner position-left');
    //             },
    //             error: function (data) {
    //                 data = JSON.parse(data.responseText);
    //                 flash(data.responseText, 'error');
    //                 $('.save_category').prop("disabled", false);
    //                 $('.save_category').find('i').removeClass('icon-spinner spinner position-left');
    //             }
    //
    //         }
    //     )
    //
    // });

    dualList = $('.listbox-filter-disabled').bootstrapDualListbox({
        showFilterInputs: false,
        infoTextEmpty: '',
        infoText: '',
        nonSelectedListLabel: 'Non-selected',
        selectedListLabel: 'Selected',

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
