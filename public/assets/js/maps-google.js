$(function () {

    var simple_map;
    var styled_map;
    var route_map;
    var cluster_map;
    var geocoding_map;


    geocoding_map = new GMaps({
        el: '#geocoding-map',
        lat: -12.043333,
        lng: -77.028333
    });

    $('#geocoding_form').submit(function (e) {
        e.preventDefault();
        GMaps.geocode({
            address: $('#address').val().trim(),
            callback: function (results, status) {
                if (status == 'OK') {
                    var latlng = results[0].geometry.location;
                    geocoding_map.setCenter(latlng.lat(), latlng.lng());
                    geocoding_map.addMarker({
                        lat: latlng.lat(),
                        lng: latlng.lng()
                    });
                }
            }
        });
    });

});