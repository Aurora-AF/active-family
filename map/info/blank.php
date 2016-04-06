<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Active Family</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="../assets/css/styles.css">
     <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/custom.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head> 

<body class="features-page">    
    <!-- ******HEADER****** --> 
    <header id="header" class="header navbar-fixed-top">  
        <div class="container">       
            <h1 class="logo">
                <a href="http://active-family.net"><span class="logo-icon"></span><span class="text">Active Family</span></a>
            </h1><!--//logo-->
            <nav class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
                                       <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="http://active-family.net/">Home</a></li>
                        <li class="active nav-item"><a href="http://active-family.net/map/">Venues</a></li>
                        <li class="nav-item"><a href="http://active-family.net/about.html">About Us</a></li>
                        <li class="nav-item"><a href="#">Log in</a></li>
                        <li class="nav-item nav-item-cta last"><a class="btn btn-cta btn-cta-secondary" href="#">Sign Up Free</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->                     
        </div><!--//container-->
    </header><!--//header-->
    

    
    <!-- ******Steps Section****** --> 
    <section class="steps section">
        <div class="container">
        
        <!--testing -->
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
    <link href="map.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
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
            margin-left: 21%;
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
        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
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

            <div id="menu">
                <div id="container">
                    <div class="phd"> </div>
                    <div class="pbd">
                        <div class="sidebar">
                            <div class="box01">
                                <div class="top">
                                    <h4>Information List</h4>
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



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="pfd"> </div>
                </div>
            </div>

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

            <div id="event">
                <script src="http://www.eventsvictoria.com/Scripts/atdw-dist-min/v2-1/Default/widget/widget.min.js" type="text/javascript"></script><div class="atdw-event-widget"></div><script type="text/javascript">window.atdw.myevents.widget.load({
                        mode:'List',
                        locations:{all:false,regions:'',councils:'QUEE',postcodes:''},
                        types:{business:false,leisure:true},
                        tags:'FAMILY',
                        businessTypes:'',
                        freeOnly:false,
                        size:{width:232,height:300},
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
<!--                                        content: "<a href=http://localhost:8888/active_v3/Information_page/map.php?lat="  + lat1 + "&lng=" + lng1 + ">" + "show Info" + "</a>",-->
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
<!--                                        content: "<a href=http://localhost:8888/active_v3/Information_page/map.php?lat="  + lat2 + "&lng=" + lng2 + ">" + "show Info" + "</a>",-->
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
<!--                                        content: "<a href=http://localhost:8888/active_v3/Information_page/map.php?lat="  + lat3 + "&lng=" + lng3 + ">" + "show Info" + "</a>",-->
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
<!--                                        content: "<a href=http://localhost:8888/active_v3/Information_page/map.php?lat="  + lat4 + "&lng=" + lng4 + ">" + "show Info" + "</a>",-->
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
        <!--testing-->
   

        </div><!--//container-->        
    </section><!--//steps-->
    
        <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                
                <div class="row has-divider">
                    <div class="footer-col download col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-col-inner">
                            
                        </div><!--//footer-col-inner-->
                    </div><!--//download-->
                    <div class="footer-col contact col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-col-inner">
                            <h3 class="title">Contact us</h3>                          
                            <p class="adr clearfix">
                                <i class="fa fa-map-marker pull-left"></i>        
                                <span class="adr-group pull-left">       
                                    <span class="street-address">Monash University</span><br>
                                    <span class="region">900 Dandenong Rd</span><br>
                                    <span class="postal-code">Caulfield East VIC 3145</span><br>
                                    <span class="country-name">Au</span>
                                </span>
                            </p>
                            <p class="email"><i class="fa fa-envelope-o"></i><a href="#">enquires@active-family.net</a></p> 
                            <a href="https://twitter.com/activeFamily4" class="twitter-follow-button" data-show-count="false">Follow @activeFamily4</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>                        
                        </div><!--//footer-col-inner-->
                    </div><!--//contact-->
                </div>
            </div><!--//container-->
        </div><!--//footer-content-->
        <div class="bottom-bar">
            <div class="container">
                <small class="copyright">Copyright @ 2016 <a href="http://active-family.net/" target="_blank">Active family</a></small>                
            </div><!--//container-->
        </div><!--//bottom-bar-->
    </footer><!--//footer-->
    
    <!-- Video Modal -->
    <div class="modal modal-video" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 id="videoModalLabel" class="modal-title sr-only">Video Tour</h4>
                </div>
                <div class="modal-body">
                    <div class="video-container">
                        <iframe id="vimeo-video" src="//player.vimeo.com/video/28872840?color=ffffff&amp;wmode=transparent" width="720" height="405" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div><!--//video-container-->
                </div><!--//modal-body-->
            </div><!--//modal-content-->
        </div><!--//modal-dialog-->
    </div><!--//modal-->
    
    <!-- *****CONFIGURE STYLE****** -->  
    <div class="config-wrapper">
        <div class="config-wrapper-inner">
            <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-cog"></i></a>
            <div id="config-panel" class="config-panel">
                <h5>Choose Colour</h5>
                <ul id="color-options" class="list-unstyled list-inline">
                    <li class="theme-1 active" ><a data-style="../assets/css/styles.css" href="#"></a></li>
                    <li class="theme-2"><a data-style="../assets/css/styles-2.css" href="#"></a></li>
                    <li class="theme-3"><a data-style="../assets/css/styles-3.css" href="#"></a></li>
                    <li class="theme-4"><a data-style="../assets/css/styles-4.css" href="#"></a></li>                   
                    <li class="theme-5"><a data-style="../assets/css/styles-5.css" href="#"></a></li>                     
                    <li class="theme-6"><a data-style="../assets/css/styles-6.css" href="#"></a></li>
                    <li class="theme-7"><a data-style="../assets/css/styles-7.css" href="#"></a></li>
                    <li class="theme-8"><a data-style="../assets/css/styles-8.css" href="#"></a></li>                    
                    <li class="theme-9"><a data-style="../assets/css/styles-9.css" href="#"></a></li>
                    <li class="theme-10"><a data-style="../assets/css/styles-10.css" href="#"></a></li>
                </ul><!--//color-options-->
                <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
            </div><!--//configure-panel-->
        </div><!--//config-wrapper-inner-->
    </div><!--//config-wrapper-->
 
 <script type="text/javascript" src="../assets/plugins/bootstrap/js/"></script> 
   <script type="text/javascript" src="../assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="../assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="../assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script type="text/javascript" src="../assets/plugins/flexslider/jquery.flexslider-min.js"></script>   
  <script type="text/javascript" src="../assets/js/main.js"></script> 
    
            
</body>
</html> 

