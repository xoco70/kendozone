/* ------------------------------------------------------------------------------
*
*  # Horizontal mega menu
*
*  Specific JS code additions for navigation_horizontal_mega.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Drill down menu
    // ------------------------------

    // If menu has child levels, add selector class
    $('.menu-list').find('li').has('ul').parents('.menu-list').addClass('has-children');


    // Attach drill down menu to menu list with child levels
    $('.has-children').dcDrilldown({
        defaultText: 'Back to parent',
        saveState: true
    });


    // Destroy nicescroll on mobile and use native scroll instead
    $(window).on('resize', function() {
        setTimeout(function() {
            if($(window).width() <= 768) {
                $('.menu-list, .menu-list ul').getNiceScroll().remove();
                $(".menu-list, .menu-list ul").removeAttr('style').removeAttr('tabindex');
            }
            else {
                $(".menu-list, .menu-list ul").niceScroll({
                    mousescrollstep: 100,
                    cursorcolor: '#ccc',
                    cursorborder: '',
                    cursorwidth: 3,
                    hidecursordelay: 200,
                    autohidemode: 'scroll',
                    railpadding: { right: 0.5 }
                });
            }
        }, 200);
    }).resize();



    // Components
    // ------------------------------

    // Styled checkboxes and radios
    $(".styled").uniform();


	// Select2 select
	$('.select').select2({
	    minimumResultsForSearch: "-1",
	    width: '100%'
	});


	// Switchery toggles
	var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
	elems.forEach(function(html) {
		var switchery = new Switchery(html);
	});
	
});
