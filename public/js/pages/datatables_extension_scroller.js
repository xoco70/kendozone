/* ------------------------------------------------------------------------------
*
*  # Scroller extension for Datatables
*
*  Specific JS code additions for datatable_extension_scroller.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Override defaults
    // ------------------------------

    // Datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        columnDefs: [
            { 
                width: "100px",
                targets: [ 0 ]
            },
            { 
                width: "23%",
                targets: [ 1, 2, 3, 4 ]
            }
        ],
        dom: '<"datatable-header info-right"fi><"datatable-scroll"tS>',
        ajax: 'assets/demo_data/tables/datatable_2500.json',
        deferRender: true,
        scrollY: 419,
        scrollCollapse: true,
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });


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



    // Table setup
    // ------------------------------

    // Basic scroller demo
    setTimeout(function() {
        $('.datatable-scroller').DataTable();
    }, 100);


    // Scroller with TableTools
    setTimeout(function() {
        $('.datatable-scroller-tools').DataTable({
            dom: '<"datatable-header info-right"fT><"datatable-scroll"tS>',
            tableTools: {
                sSwfPath: "assets/swf/datatables/copy_csv_xls_pdf.swf",
                aButtons: ["copy", "print", "csv", "xls", "pdf"]
            }
        });
    }, 1000);


    // Saving state in scroller
    setTimeout(function() {
        $('.datatable-scroller-state').DataTable({
            stateSave: true
        });
    }, 2000);


    // Using Scroller API
    setTimeout(function() {
        $('.datatable-scroller-api').DataTable({
            stateSave: true,
            initComplete: function () {
                var api = this.api();
                api.scroller().scrollToRow( 1000 );
            }
        });
    }, 3000);
    


    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
    
});
