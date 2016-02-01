/* ------------------------------------------------------------------------------
*
*  # TableTools extension for Datatables
*
*  Specific JS code additions for datatable_extension_tools.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Override defaults
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fTl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    // Define default path for DataTables SWF file
    $.fn.dataTable.TableTools.defaults.sSwfPath = "assets/swf/datatables/copy_csv_xls_pdf.swf"


    // Tabletools defaults
    $.extend(true, $.fn.DataTable.TableTools.classes, {
        "container" : "btn-group DTTT_container", // buttons container
        "buttons" : {
            "normal" : "btn btn-default", // default button classes
            "disabled" : "disabled" // disabled button classes
        },
        "collection" : {
            "container" : "dropdown-menu" // collection container to take dropdown menu styling
        },
        "select" : {
            "row" : "success" // selected row class
        }
    });


    // Collection dropdown defaults
    $.extend(true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
        collection: {
            container: "ul",
            button: "li",
            liner: "a"
        }
    });



    // Table setup
    // ------------------------------

    // Basic TableTools example
    $('.datatable-tools-basic').DataTable();


    // Single row select
    $('.datatable-tools-select-single').DataTable({
        tableTools: {
            sRowSelect: "single",
            aButtons: ["csv", "xls", "pdf"]
        }
    });


    // Multiple rows select
    $('.datatable-tools-select-multiple').DataTable({
        tableTools: {
            sRowSelect: "multi",
            aButtons: ["select_all", "select_none"]
        }
    });


    // Operating system select
    $('.datatable-tools-select-os').DataTable({
        tableTools: {
            sRowSelect: "os",
            aButtons: ["select_all", "select_none"]
        }
    });



    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
    
});
