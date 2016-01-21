<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maps Directions</title>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wzIkFk79DCKaqn5-sjNgjsngtHQSeRM&signed_in=true"></script>
</head>

<body>

<div id="mapPointers" style="width:600;height:400px;" >

</div>


<div > 
                           <a onClick="$('#directions-panel').slideToggle();"><i class="fa fa-plus"></i> Directions</a>
                           <div id="directions-panel" style="display:none;">
                           </div>
                           </div>

 



<script type="text/javascript">
 						     
							   
							   var geocoder;
  var map;
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
 
  
 // initialize();
  
  function initialize() {
	   
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(17.3700, 78.4800);
    var mapOptions = {
      zoom: 16,
      center: latlng,
       mapTypeId : google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("mapPointers"), mapOptions);
     directionsDisplay.setMap(map);

    initMap();
}
		
 function initMap(){
     
 var addr = '<?php echo $_GET['location'].','. $_GET['city'];?>';
  // addr_list = addr.split(",");
   
   var address = addr;
 
    var position;
 
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        
            map.setCenter(results[0].geometry.location);
       
            
            position = results[0].geometry.location;
       
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  
      var waypts = [];
	 
	 <?php
	 
	   $transportation = $_GET['transportation'];
	 
	 
	     if(strlen($transportation) > 0){
			
		   $rt = explode(',',$transportation);	
		 
		  
		    if(count($rt) > 0){
				for($i=1;$i < (count($rt)-1);$i++){
			   	?>
					 waypts.push({
	    					location: '<?php echo $rt[$i];?>,<?php echo $_GET['location'];?>,<?php echo $_GET['city'];?>',
     						stopover: true
					 });
				<?php
				}
			
			?>
		
		
			  directionsService.route({
    origin: '<?php echo $rt[0];?>,<?php echo $_GET['location'];?>,<?php echo $_GET['city'];?>',
    destination: '<?php echo end($rt);?>,<?php echo $_GET['location'];?>,<?php echo $_GET['city'];?>',
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
            '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
		
		
		
			<?php
			}
		}
	 
	 
	 ?>
     
	 
	 
	 
    
 }
 
 initialize();

 

	 
 </script>
</body>
</html>
