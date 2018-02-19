<?php $db = mysql_connect("localhost","wp","swadesh0");
 mysql_select_db("shop", $db); ?>

<script type="text/javascript"
  src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng(37.386339,-122.085823);
    var myOptions = {
    zoom: 13,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var WalkingPathCoordinates = [];
    <?php  $coordinates="SELECT * FROM gps_location";
            $Result1 = mysql_query($coordinates, $db)or die(mysql_error());  
            while(list($id,$latitude,$longitude) = mysql_fetch_row($Result1))
                { 
                echo "var latlng = new google.maps.LatLng(".$lat.",".$long.")\n";
                echo "WalkingPathCoordinates.push(latlng);\n";
                }  
    ?> 
var WalkingPath = new google.maps.Polyline({
    path: WalkingPathCoordinates,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2
    });

WalkingPath.setMap(map);
  }
</script>