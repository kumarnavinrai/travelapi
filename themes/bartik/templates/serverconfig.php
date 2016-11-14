<?php



$themeurl = file_create_url(path_to_theme());

global $base_url;   // Will point to http://www.example.com
global $base_path;  // Will point to at least "/" or the subdirectory where the drupal in installed.
$sitelink = $base_url . $base_path;



if(strpos($base_url, "travelpainters.local"))
{
  $urlofwp = "http://travelpainters.local/"; 
  $_SESSION['urlforform'] = "http://travelpainters.local/";
  $sitelink = $_SESSION['urlforform'];
  //$urltoGetFilghts = "http://flyoticket.com/phpsaber/start_rest_workflow.php";
  $urltoGetFilghts = "http://travelpainters.local/phpsaber/start_rest_workflow.php";
  //$urltoGetFilghts = "http://127.0.0.1:1337/fs/";
  //$urltoGetFilghts = "http://104.168.102.222:1337/fs/";
}
elseif(strpos($base_url, "flyoticket.com"))
{
  //$urlofwp = "http://travelpainters.com/";  
  $urlofwp = "https://flyoticket.com/";  
  //$_SESSION['urlforform'] = "http://travelpainters.com/";
  $_SESSION['urlforform'] = "https://flyoticket.com/";

  $sitelink = $_SESSION['urlforform'];
  //$urltoGetFilghts = "http://127.0.0.1:1337/fs/";
  //$urltoGetFilghts = "http://travelpainters.com/phpsaber/start_rest_workflow.php";
  $urltoGetFilghts = "https://flyoticket.com/phpsaber/start_rest_workflow.php";
  
}


$noofresultonpage = 100;

?>