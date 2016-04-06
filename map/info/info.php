<?php
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true";
$json = file_get_contents($url);
$data = json_decode($json);
$address = $data->results['0']->formatted_address;
$locality = $data->results['0']->address_components['2']->long_name;
$postcode = $data->results['0']->address_components['5']->long_name;
?>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 52%;
            width: 60%;
            border-style: solid;
            border-width: 5px;
            margin-left: 25%;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

    </style>
    <style>

    </style>
    <title>Places Searchbox</title>
    <link href="/apis/fusiontables/docs/samples/style/default.css"
          rel="stylesheet" type="text/css">
    <style>
        #target {
            width: 345px;
        }
    </style>


</head>
<body>

<!--    <input id="pac-input" class="controls" type="text" placeholder="Search Box">-->
<!--    <select id="type" onchange="filterMarkers(this.value);">-->
<!--        <option value="">Please select category</option>-->
<!--        <option value="BBQ">BBQ</option>-->
<!--        <option value="Bicycle Rails">Bicycle Rails</option>-->
<!--        <option value="Drinking Fountains">Drinking Fountains</option>-->
<!--        <option value="Information Pillars">Information Pillars</option>-->
<!--        <option value="Picnic">Picnic</option>-->
<!--        <option value="Reset">Reset</option>-->
<!--    </select>-->
<!---->
    <table>
        <tr>
            <div id="menu">
                <div id="container">
                    <div class="phd"> </div>
                    <div class="pbd">
                        <div class="sidebar">
                            <div class="box01">
                                <div class="top">
                                    <h4><span><a href="#">More</a></span>Information List</h4>
                                </div>
                                <div class="mid">
                                    <div id="acc"> <b class="nav"><span>Address Detail</span></b>
                                        <div class="sub"><p><?php echo $address;?></p></div>
                                        <b  class="nav"><span>Weather</span></b>
                                        <div class="sub1"><a><script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_current.jsp?postcode=<?php echo $postcode;?>&locality=<?php echo $locality;?>"></script></a>
                                            <a><script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_forecast.jsp?postcode=<?php echo $postcode;?>&locality=<?php echo $locality;?>"></script></a></div>
                                        <b class="nav"><span>Rate</span></b>
                                        <div class="sub"> </div>
                                        <b  class="nav"><span>Comments</span></b>
                                        <div class="sub"> </div>
                                        <b  class="nav"><span>Get Direction</span></b>
                                        <div class="sub"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="pfd"> </div>
                </div>
            </div>
            <div id=""></div>
        </tr>
        </table>

        <div>
            <script src="http://www.eventsvictoria.com/Scripts/atdw-dist-min/v2-1/Default/widget/widget.min.js" type="text/javascript"></script><div class="atdw-event-widget"></div><script type="text/javascript">window.atdw.myevents.widget.load({
  mode:'List',
  locations:{all:true,regions:'',councils:'',postcodes:''},
  types:{business:false,leisure:true},
  tags:'FAMILY,LIVEMUSIC',
  businessTypes:'',
  freeOnly:false,
  size:{width:300,height:350},
  theme:'BLUE'
});</script>
        </div>




<!--            <div id="map"/>-->
<!--        </tr>-->
<!---->
<!--    </table>-->
<!--                <script>-->
<!--                    // This example adds a search box to a map, using the Google Place Autocomplete-->
<!--                    // feature. People can enter geographical searches. The search box will return a-->
<!--                    // pick list containing a mix of places and predicted search terms.-->
<!---->
<!--                    function initAutocomplete() {-->
<!---->
<!--                        var map = new google.maps.Map(document.getElementById('map'), {-->
<!--                            zoom: 11,-->
<!--                            center: {lat: -37.8140000, lng: 144.9633200}-->
<!--                        });-->
<!--                        var layer1;-->
<!--                        var layer2;-->
<!--                        var layer3;-->
<!--                        var layer4;-->
<!--                        var lat1;-->
<!--                        var lat2;-->
<!--                        var lat3;-->
<!--                        var lat4;-->
<!--                        var lng1;-->
<!--                        var lng2;-->
<!--                        var lng3;-->
<!--                        var lng4;-->
<!--                        filterMarkers = function (category) {-->
<!--                            if (category == 'BBQ') {-->
<!--                                layer1 = new google.maps.FusionTablesLayer({-->
<!--                                    query: {-->
<!--                                        select: 'location',-->
<!--                                        from: '1JBxYQ3W9JZKvy7nTeOiak-cI1E0vbNpxCltpAcX8',-->
<!--                                    },-->
<!--                                    styles: [{-->
<!--                                        markerOptions: {-->
<!--                                            iconName: "large_green"-->
<!--                                        }-->
<!---->
<!--                                    }],-->
<!--                                    suppressInfoWindows: false-->
<!--                                });-->
<!--                                layer1.setMap(map);-->
<!--                                var infoWindow = new google.maps.InfoWindow();-->
<!--                                google.maps.event.addListener(layer1, 'click', function(e) {-->
<!--                                    windowControl(e, infoWindow, map);-->
<!--                                });-->
<!--                                function windowControl(e, infoWindow, map) {-->
<!--                                    var myLatLng = e.latLng;-->
<!--                                    lat1 = e.latLng.lat();-->
<!--                                    lng1 = e.latLng.lng();-->
<!--                                    infoWindow.setOptions({-->
<!--                                        content: "<a href=http://active-family.net/map/info/map.php?lat="  + lat1 + "&lng=" + lng1 + ">" + "show Info" + "</a>",-->
<!--                                        position: e.latLng,-->
<!--                                        pixelOffset: e.pixelOffset-->
<!--                                    });-->
<!--                                    infoWindow.open(map);-->
<!--                                }-->
<!--                            }-->
<!--                            if (category == 'Bicycle Rails') {-->
<!---->
<!--                            }-->
<!--                            if (category == 'Dog Friendly') {-->
<!--                                layer2 = new google.maps.FusionTablesLayer({-->
<!--                                    query: {-->
<!--                                        select: 'location',-->
<!--                                        from: '18NjiGhN4FXvJMn0pU-m9pFB3uwATv_urgQ43EDi3',-->
<!--                                    },-->
<!--                                    styles: [{-->
<!--                                        markerOptions: {-->
<!--                                            iconName: "large_green"-->
<!--                                        }-->
<!---->
<!--                                    }],-->
<!--                                    suppressInfoWindows: true-->
<!--                                });-->
<!--                                layer2.setMap(map);-->
<!--                                var infoWindow = new google.maps.InfoWindow();-->
<!--                                google.maps.event.addListener(layer2, 'click', function(e) {-->
<!--                                    windowControl(e, infoWindow, map);-->
<!--                                });-->
<!--                                function windowControl(e, infoWindow, map) {-->
<!--                                    var myLatLng = e.latLng;-->
<!--                                    lat2 = e.latLng.lat();-->
<!--                                    lng2 = e.latLng.lng();-->
<!--                                    infoWindow.setOptions({-->
<!--                                        content: "<a href=http://active-family.net/map/info/map.php?lat="  + lat2 + "&lng=" + lng2 + ">" + "show Info" + "</a>",-->
<!--                                        position: e.latLng,-->
<!--                                        pixelOffset: e.pixelOffset-->
<!--                                    });-->
<!--                                    infoWindow.open(map);-->
<!--                                }-->
<!--                            }-->
<!--                            if (category == 'Drinking Fountains') {-->
<!--                                layer3 = new google.maps.FusionTablesLayer({-->
<!--                                    query: {-->
<!--                                        select: 'location',-->
<!--                                        from: '1BhdWLllVcSGCJBrOC0a2kZMv0pevA6Apc0H96z5w',-->
<!--                                    },-->
<!--                                    styles: [{-->
<!--                                        markerOptions: {-->
<!--                                            iconName: "large_blue"-->
<!--                                        }-->
<!---->
<!--                                    }],-->
<!--                                    suppressInfoWindows: true-->
<!--                                });-->
<!--                                layer3.setMap(map);-->
<!--                                var infoWindow = new google.maps.InfoWindow();-->
<!--                                google.maps.event.addListener(layer3, 'click', function(e) {-->
<!--                                    windowControl(e, infoWindow, map);-->
<!--                                });-->
<!--                                function windowControl(e, infoWindow, map) {-->
<!--                                    var myLatLng = e.latLng;-->
<!--                                    lat3 = e.latLng.lat();-->
<!--                                    lng3 = e.latLng.lng();-->
<!--                                    infoWindow.setOptions({-->
<!--                                        content: "<a href=http://active-family.net/map/info/map.php?lat="  + lat3 + "&lng=" + lng3 + ">" + "show Info" + "</a>",-->
<!--                                        position: e.latLng,-->
<!--                                        pixelOffset: e.pixelOffset-->
<!--                                    });-->
<!--                                    infoWindow.open(map);-->
<!--                                }-->
<!---->
<!--                            }-->
<!---->
<!--                            if (category == 'Information Pillars') {-->
<!--                                layer4 = new google.maps.FusionTablesLayer({-->
<!--                                    query: {-->
<!--                                        select: 'location',-->
<!--                                        from: '1BhdWLllVcSGCJBrOC0a2kZMv0pevA6Apc0H96z5w',-->
<!--                                    },-->
<!--                                    styles: [{-->
<!--                                        markerOptions: {-->
<!--                                            iconName: "large_blue"-->
<!--                                        }-->
<!---->
<!--                                    }],-->
<!--                                    suppressInfoWindows: true-->
<!--                                });-->
<!--                                layer4.setMap(map);-->
<!--                                var infoWindow = new google.maps.InfoWindow();-->
<!--                                google.maps.event.addListener(layer4, 'click', function(e) {-->
<!--                                    windowControl(e, infoWindow, map);-->
<!--                                });-->
<!--                                function windowControl(e, infoWindow, map) {-->
<!--                                    var myLatLng = e.latLng;-->
<!--                                    lat4 = e.latLng.lat();-->
<!--                                    lng4 = e.latLng.lng();-->
<!--                                    infoWindow.setOptions({-->
<!--                                        content: "<a href=http://active-family.net/map/info/map.php?lat="  + lat4 + "&lng=" + lng4 + ">" + "show Info" + "</a>",-->
<!--                                        position: e.latLng,-->
<!--                                        pixelOffset: e.pixelOffset-->
<!--                                    });-->
<!--                                    infoWindow.open(map);-->
<!--                                }-->
<!---->
<!--                            }-->
<!--                            if (category == 'Picnic') {-->
<!---->
<!--                            }-->
<!---->
<!--                            if (category == 'Reset') {-->
<!--                                location.reload();-->
<!--                            }-->
<!--                        }-->
<!---->
<!--                        // Create the search box and link it to the UI element.-->
<!--                        var input = document.getElementById('pac-input');-->
<!--                        var searchBox = new google.maps.places.SearchBox(input);-->
<!--                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);-->
<!---->
<!--                        // Bias the SearchBox results towards current map's viewport.-->
<!--                        map.addListener('bounds_changed', function() {-->
<!--                            searchBox.setBounds(map.getBounds());-->
<!--                        });-->
<!---->
<!--                        var markers = [];-->
<!--                        // [START region_getplaces]-->
<!--                        // Listen for the event fired when the user selects a prediction and retrieve-->
<!--                        // more details for that place.-->
<!--                        searchBox.addListener('places_changed', function() {-->
<!--                            var places = searchBox.getPlaces();-->
<!---->
<!--                            if (places.length == 0) {-->
<!--                                return;-->
<!--                            }-->
<!---->
<!--                            // Clear out the old markers.-->
<!--                            markers.forEach(function(marker) {-->
<!--                                marker.setMap(null);-->
<!--                            });-->
<!--                            markers = [];-->
<!---->
<!--                            // For each place, get the icon, name and location.-->
<!--                            var bounds = new google.maps.LatLngBounds();-->
<!--                            places.forEach(function(place) {-->
<!--                                var icon = {-->
<!--                                    url: place.icon,-->
<!--                                    size: new google.maps.Size(71, 71),-->
<!--                                    origin: new google.maps.Point(0, 0),-->
<!--                                    anchor: new google.maps.Point(17, 34),-->
<!--                                    scaledSize: new google.maps.Size(25, 25)-->
<!--                                };-->
<!---->
<!--                                // Create a marker for each place.-->
<!--                                markers.push(new google.maps.Marker({-->
<!--                                    map: map,-->
<!--                                    icon: icon,-->
<!--                                    title: place.name,-->
<!--                                    position: place.geometry.location,-->
<!--                                }));-->
<!---->
<!--                                if (place.geometry.viewport) {-->
<!--                                    // Only geocodes have viewport.-->
<!--                                    bounds.union(place.geometry.viewport);-->
<!--                                } else {-->
<!--                                    bounds.extend(place.geometry.location);-->
<!--                                }-->
<!--                            });-->
<!--                            map.fitBounds(bounds);-->
<!--                        });-->
<!--                    }-->
<!---->
<!---->
<!--                </script>-->
<!--                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzH_QCxDbQZoHQpYGUJBmnLeou6-Ddmqk&libraries=places&callback=initAutocomplete"-->
<!--                        async defer></script>-->

</body>
</html>