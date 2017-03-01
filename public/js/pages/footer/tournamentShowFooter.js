$(function () {
    function initialize() {

        // Set coordinates
        let myLatlng = new google.maps.LatLng(latitude, longitude);

        // Options
        let mapOptions = {
            zoom: 5,
            center: myLatlng
        };

        // Apply options
        let map = new google.maps.Map($('.map-basic')[0], mapOptions);


        // Add marker
        let marker = new google.maps.Marker({
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

//# sourceMappingURL=tournamentShowFooter.js.map
