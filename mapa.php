<?php
  include('ubicacion.php');
  $ubi = new ubicacion();
  $datos = $ubi->obtener();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>
    <script>
    //<?php echo "alert('hola');"?>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -19.04032, lng: -65.2509},
      zoom: 15
      });


      //var infoWindow = new google.maps.InfoWindow;
        //var posicion = { lat: -19.04032,lng: -65.2509};
	    //addMarket(posicion,map);
	    <?php
      foreach ($datos as $d) {
         echo "var posicion = { lat: ".$d['latitud'].",lng: ".$d['longitud']."};";
         echo "addMarket(posicion,map);";
       } 
      ?>
//////////////////////////////////////////////////////////////////////////////////////////////////////////      
      
    }
    function addMarket(location,map){
      //var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
      var marker= new google.maps.Marker({
        position: location,
        map: map
        //icon: image
      });

      marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8H6qXUge91rtU1oPEKqWQc5oZXn4CIyI&callback=initMap" async defer></script>
  </body>
</html>