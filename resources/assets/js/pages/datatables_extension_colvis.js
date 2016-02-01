/* ------------------------------------------------------------------------------
*
*  # Columns Visibility extension for Datatables
*
*  Specific JS code additions for datatable_extension_colvis.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fCl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            $.uniform.update();
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    
    // Basic ColVis example
    $('.datatable-colvis-basic').DataTable({
        colVis: {
            buttonText: "<i class='icon-three-bars'></i> <span class='caret'></span>",
            align: "right",
            overlayFade: 200,
            showAll: "Show all",
            showNone: "Hide all"
        }
    });


    // Exclude columns
    $('.datatable-colvis-exclude').DataTable({
        colVis: {
            buttonText: "<i class='icon-three-bars'></i> <span class='caret'></span>",
            align: "right",
            overlayFade: 200,
            exclude: [ 0 ],
            showAll: "Show all",
            showNone: "Hide all"
        }
    });


    // Button ordering
    $('.datatable-colvis-ordering').DataTable({
        colVis: {
            buttonText: "<i class='icon-three-bars'></i> <span class='caret'></span>",
            align: "right",
            overlayFade: 200,
            order: 'alpha',
            showAll: "Show all",
            showNone: "Hide all"
        }
    });


    // Mouseover activation
    $('.datatable-colvis-mouseover').DataTable({
        colVis: {
            buttonText: "<i class='icon-three-bars'></i> <span class='caret'></span>",
            align: "right",
            overlayFade: 200,
            activate: "mouseover",
            showAll: "Show all",
            showNone: "Hide all"
        }
    });



    // External table additions
    // ------------------------------

    // Launch Uniform styling for checkboxes
    $('.ColVis_Button').addClass('btn btn-primary btn-icon').on('click mouseover', function() {
        $('.ColVis_collection input').uniform();
    });


    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
    
});
