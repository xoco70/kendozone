/* ------------------------------------------------------------------------------
*
*  # Bootstrap multiple file uploader
*
*  Specific JS code additions for uploader_bootstrap.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Basic example
    $('.file-input').fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });


    // With preview
    $(".file-input-preview").fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialPreview: [
            "<img src='assets/images/demo/images/1.png' class='file-preview-image' alt=''>",
            "<img src='assets/images/demo/images/2.png' class='file-preview-image' alt=''>",
        ],
        overwriteInitial: false,
        maxFileSize: 100
    });


    // Display preview on load
    $(".file-input-overwrite").fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialPreview: [
            "<img src='assets/images/demo/images/1.png' class='file-preview-image' alt=''>",
            "<img src='assets/images/demo/images/2.png' class='file-preview-image' alt=''>",
        ],
        overwriteInitial: true
    });


    // Custom layout
    $('.file-input-custom').fileinput({
        previewFileType: 'image',
        browseLabel: 'Select',
        browseClass: 'btn bg-slate-700',
        browseIcon: '<i class="icon-image2 position-left"></i> ',
        removeLabel: 'Remove',
        removeClass: 'btn btn-danger',
        removeIcon: '<i class="icon-cancel-square position-left"></i> ',
        uploadClass: 'btn bg-teal-400',
        uploadIcon: '<i class="icon-file-upload position-left"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });


    // Advanced example
    $('.file-input-advanced').fileinput({
        browseLabel: 'Browse',
        browseClass: 'btn btn-default',
        removeLabel: '',
        uploadLabel: '',
        browseIcon: '<i class="icon-plus22 position-left"></i> ',
        uploadClass: 'btn btn-primary btn-icon',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        initialCaption: "No file selected",
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>',
            main1: "{preview}\n" +
            "<div class='input-group {class}'>\n" +
            "   <div class='input-group-btn'>\n" +
            "       {browse}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "   <div class='input-group-btn'>\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "</div>"
        }
    });


    // Disable/enable button
    $("#btn-modify").on("click", function() {
        $btn = $(this);
        if ($btn.text() == "Disable file input") {
            $("#file-input-methods").fileinput("disable");
            $btn.html("Enable file input");
            alert("Hurray! I have disabled the input and hidden the upload button.");
        }
        else {
            $("#file-input-methods").fileinput("enable");
            $btn.html("Disable file input");
            alert("Hurray! I have reverted back the input to enabled with the upload button.");
        }
    });


    // Custom file extensions
    $(".file-input-extensions").fileinput({
        browseLabel: 'Browse',
        browseClass: 'btn btn-primary',
        removeLabel: '',
        browseIcon: '<i class="icon-plus22 position-left"></i> ',
        uploadIcon: '<i class="icon-file-upload position-left"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected",
        maxFilesNum: 10,
        allowedFileExtensions: ["jpg", "gif", "png", "txt"]
    });
    
});
