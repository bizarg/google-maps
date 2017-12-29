<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
            width: 90%;
            margin: 0 auto;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .link {
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="link">
    <a href="manage.php">Manage users</a>
</div>

<div id="map"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(49.988350, 36.231576),
            zoom: 18
        });
        var infoWindow = new google.maps.InfoWindow;

        $.ajax({
            url: "xml.php",
            type: "post",
            success: function(result){
                var markers = result.documentElement.getElementsByTagName('marker');

                Array.prototype.forEach.call(markers, function(markerElem) {
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);

                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                    });
                    marker.addListener('click', function() {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                });
            }
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfAQL5sya4cdgtHC1o9YKIQHweHy5Jbfg&callback=initMap"
        async defer></script>
</body>
</html>