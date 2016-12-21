<?php

// Include and instantiate the class.
$pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
require_once $pathoffile."/mobile/".'Mobile_Detect.php';


$detect = new Mobile_Detect;
global $base_url;   // Will point to http://www.example.com
global $base_path;  // Will point to at least "/" or the subdirectory where the drupal in installed.
$sitelink = $base_url . $base_path;

// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {

	echo "<pre>"; print_r($base_url); die;
	if(strpos($base_url, "m.flyoticket.com"))
	{
	  echo "<pre>"; print_r($base_url); die;
	  header('Location: http://m.flyoticket.com/');
	  die;
	}
}
 
// Any tablet device.
if( $detect->isTablet() ){

	echo "<pre>"; print_r($base_url); die;
	if(strpos($base_url, "m.flyoticket.com"))
	{
	  echo "<pre>"; print_r($base_url); die;	
	  header('Location: http://m.flyoticket.com/');
	  die;
	}
 
}
 
// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet() ){

/*	if(strpos($base_url, "m.flyoticket.com"))
	{
	  header('Location: http://m.flyoticket.com/');
	  die;
	}*/
}
 
// Check for a specific platform with the help of the magic methods:
if( $detect->isiOS() ){


/*	if(strpos($base_url, "m.flyoticket.com"))
	{
	  header('Location: http://m.flyoticket.com/');
	  die;
	}
*/ 
}
 
if( $detect->isAndroidOS() ){
 
 	/*if(!strpos($base_url, "m.flyoticket.com"))
	{
	  header('Location: http://m.flyoticket.com/');
	  die;
	}*/
}
 
// Alternative method is() for checking specific properties.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->is('Chrome');
$detect->is('iOS');
$detect->is('UC Browser');
// [...]
 
// Batch mode using setUserAgent():
$userAgents = array(
'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',
// [...]
);
foreach($userAgents as $userAgent){
 
  $detect->setUserAgent($userAgent);
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  // Use the force however you want.
 
}
 
// Get the version() of components.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->version('iPad'); // 4.3 (float)
$detect->version('iPhone'); // 3.1 (float)
$detect->version('Android'); // 2.1 (float)
$detect->version('Opera Mini'); // 5.0 (float)
// [...]

?>