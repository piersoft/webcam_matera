
<!DOCTYPE html>
<html lang="it-IT">
<head>
<meta charset="utf-8"/>
<title>Matera WebCam Map</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>

<script type="text/javascript" src="http://www.sassiland.com/javascript/webcam_map/annimg.js">
</script>

<script language="JavaScript">

var ImageReloaded = 0;

var BaseURL='';
var File='';
	//var BaseURL = "http://www.sassiland.com/webcam2luglio/";
	//var File = "readimage2luglio.asp";
	

var theTimer = setTimeout('reloadImage()', 1);

// This function will stop unneeded reloads if client has slow bandwidth
function ImageLoaded() 
{
  ImageReloaded = 1;
}


function reloadImage()
{
  // Reload the image every one second (1000 ms)
  theTimer = setTimeout('reloadImage()', 1000);

  // Here we load the image
  if (ImageReloaded=1)
   {   
     theDate = new Date();
     var url = BaseURL;
     url += File;
     url += '?dummy=' + theDate.getTime().toString(10);
     // The dummy above enforces a bypass of the browser image cache

     document.theImage.src = url;
     ImageReloaded = 0;
   }   
}




</script>
<style>
*
{
font-family:Verdana;
margin: 0;
padding: 0;
}
#sidebar{
    position:fixed;
    width:40%;
    bottom:10px;
    left:10px;
    background-color:rgba(255,255,255,0.5);
    padding:5px;
}
#map
{
  position:fixed;
  top:0px;
  bottom:0px;
  right:0px;
  left:0px;
}
.small{
font-size:8pt;
}
</style>
</head>

<body>
<div id="map"></div>
<div id="sidebar">
    <h3>Webcam a Matera REALTIME</h3>
    <p>Webcam sparse per la Città di Matera a cura <a href="http://www.sassiland.com" target="_blank">SassiLand.com</a> e <a href="http://www.epitech-srl.it" target="_blank">Epitech srl</a> | Pin CC BY-SA <a href="http://mapicons.nicolasmollet.com/">Mapicons</a>| by <a href="http://www.twitter.com/piersoft">Piersoft</a></p>
</div>

<script type="text/javascript">
//https://code.google.com/p/microajax/
function microAjax(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else{if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("X-Requested-With","XMLHttpRequest"); C.setRequestHeader("Content-type","application/x-www-form-urlencoded");C.setRequestHeader("Connection","close")}else{C.open("GET",B,true)}C.send(this.postBody)}};
</script>

<script type="text/javascript">
var map = L.map('map').setView([40.6665,16.6012], 15);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var ico=L.icon({iconUrl:'webcam.png', iconSize:[36,45],iconAnchor:[18,36],popupAnchor:[0,-36]});

microAjax('webcam.geojson',function (res) {
var feat=JSON.parse(res);
		var geojson = L.geoJson(feat,{
			onEachFeature:function onEachFeature(feature, layer) {

				if (feature.properties && feature.properties.name) {

					layer.bindPopup("<p style='font-weight:bold'>"+feature.properties.name+"</p><p><iframe src='webcam.php?baseurl="+feature.properties.url+"&file="+feature.properties.file+"' width='200' height='126' scrolling='no'></iframe></p>");
				}
			},
			pointToLayer: function (feature, latlng) {
				var marker=L.marker(latlng, {icon:ico});
                marker.addTo(map);
				return marker;
			}
		});
 });
</script>
</body>
</html>
