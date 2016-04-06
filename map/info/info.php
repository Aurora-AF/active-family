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



</body>
</html>