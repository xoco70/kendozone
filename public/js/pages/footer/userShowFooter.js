$(function () {

    function initialize() {

        // Set coordinates
        var myLatlng = new google.maps.LatLng(latitude, longitude);

        // Options
        var mapOptions = {
            zoom: 5,
            center: myLatlng
        };

        // Apply options
        var map = new google.maps.Map($('.map-basic')[0], mapOptions);


        // Add marker
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });

        // Attach click event
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });

    }

    // Initialize map on window load
    google.maps.event.addDomListener(window, 'load', initialize);


});

//# sourceMappingURL=userShowFooter.js.map
