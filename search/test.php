<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="map" style="height:600px;">


</div>



<script src="https://maps.googleapis.com/maps/api/js?"></script>

     
 <script type="text/javascript">
 						 	   
							   
							   
							   var geocoder;
  var map;
  
   
  
 /*
 * use google maps api built-in mechanism to attach dom events
 */
 function viewmap() {



  /*
   * create map
   */
  var map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(17.3700, 78.4800),
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });


var addr = 'dilsukhnagar';//document.getElementById("prefill").value;
   
   var address = addr;
 
    var position;
   geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        
            map.setCenter(results[0].geometry.location);
          
            position = results[0].geometry.location;
       
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  /*
   * create infowindow (which will be used by markers)
   */
  var infowindow = new google.maps.InfoWindow();

  /*
   * marker creater function (acts as a closure for html parameter)
   */
  function createMarker(options, html) {
    var marker = new google.maps.Marker(options);
    if (html) {
      google.maps.event.addListener(marker, "click", function () {
        infowindow.setContent(html);
        infowindow.open(options.map, this);
      });
    }
    return marker;
  }

  /*
   * add markers to map
   */
   
   				 image = 'http://1.bp.blogspot.com/_GZzKwf6g1o8/S6xwK6CSghI/AAAAAAAAA98/_iA3r4Ehclk/s1600/marker-green.png';
								
			var marker0 = 	createMarker({
    position: new google.maps.LatLng(17.3693209, 17.3693209),
    map: map,
	title: 'Brilliant Grammar High School',
    icon: image
  }, '<div class="map_content"><h5  class="map_heading" onClick="viewSchool(\'32123212\');">Brilliant Grammar High School</h5><div class="map_body">Dilsukhnagar, Hyderabad</div></div>');

				  
  google.maps.event.addListener(marker0,'mouseover', (function(marker0,mapcontent,infowindow){ 
        return function() {
          
           infowindow.setContent( marker0.content);
           infowindow.open(map,marker0);
        };
    })(marker0,content,infowindow)); 
								
			var marker1 = 	createMarker({
    position: new google.maps.LatLng(17.3685349, 17.3685349),
    map: map,
	title: 'Pragathi Vidyalayam',
    icon: image
  }, '<div class="map_content"><h5  class="map_heading" onClick="viewSchool(\'32123215\');">Pragathi Vidyalayam</h5><div class="map_body">Dilsukhnagar, Hyderabad</div></div>');

				  
  google.maps.event.addListener(marker1,'mouseover', (function(marker1,mapcontent,infowindow){ 
        return function() {
          
           infowindow.setContent( marker1.content);
           infowindow.open(map,marker1);
        };
    })(marker1,content,infowindow)); 
					
  
}  
	viewmap();
 </script>
 
</body>
</html>