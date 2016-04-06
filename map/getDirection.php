<!DOCTYPE html>
<?php
$lat = $_GET{'lat'};
$lng = $_GET{'lng'};
?>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
</head>
<body>
<div id="floating-panel">
    <b>Mode of Travel: </b>
    <select id="mode">
        <option value="DRIVING">Driving</option>
        <option value="WALKING">Walking</option>
        <option value="BICYCLING">Bicycling</option>
        <option value="TRANSIT">Transit</option>
    </select><br>
    <button id="direct">Get Direction</button>
<!--    <button id="reset">Reset</button>-->
</div>
<div id="map"></div>
<script>
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var startLat;
        var startLng;
        var endLat = <?php echo $lat;?>;
        var endLng = <?php echo $lng;?>;
        var pos;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {lat: -37.8141, lng: 144.9633}
        });
        directionsDisplay.setMap(map);

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                startLat = position.coords.latitude;
                startLng = position.coords.longitude;

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                });
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }


        var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay, pos, endLat, endLng);

        };
        document.getElementById('direct').addEventListener('click', onChangeHandler);
        //document.getElementById('reset').addEventListener('click', initMap);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay, pos, endLat, endLng) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
            origin: pos,
            destination: {lat:endLat, lng:endLng},
            travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                if (status == 'ZERO_RESULTS') {
                    window.alert('Directions request failed due to ' + status);
                }
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFO12yfon9WbQBqtdK_lnmY6uAiDXmB0s&callback=initMap">
</script>
</body>
</html>