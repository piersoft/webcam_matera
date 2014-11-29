<?php

$file=$_GET['file'];
$baseurl=$_GET['baseurl'];

?>

<html>

 <body style="color: black; background-color: black;" alink="white" link="#ffcc33" vlink="#996666" >
 
<div class="webcam" style="margin:auto; position:relative; top:-5; left:-10; color: black; background-color: black;" >
<script type="text/javascript" src="http://www.sassiland.com/javascript/webcam_map/annimg.js">
</script>

<script language="JavaScript">

var ImageReloaded = 0;

//var BaseURL = "http://www.sassiland.com/webcam_matera/";
// This is the path to the image generating asp file.
//var File = "read_image_2_luglio.asp";

var BaseURL="<?php  printf($baseurl);  ?>";
var File="<?php  printf($file);  ?>";
//alert(File);
//alert(BaseURL);
//	var BaseURL = "http://www.sassiland.com/webcam_palazzo_annunziata/";
//	var File = "read_image_annunziata.asp";
	

// Force an immediate image load
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




document.write('<img name="theImage" onload="ImageLoaded()" usemap="#imgmap" class="annotated" src="" height="120" style="background-color: black;" ');
document.write('width="200" alt="Webcam a Matera - Refresh ogni 1 secondi">');
</script>