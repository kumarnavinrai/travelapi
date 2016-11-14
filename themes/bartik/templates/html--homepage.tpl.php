<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */

header('Access-Control-Allow-Origin: *');

  $pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
  require_once $pathoffile."/"."serverconfig.php";

//echo $IP = get_client_ip(); 
//$a = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=00d1e4556a00293951daa9b637d7c10d8221ec43f900de0c85ebfc1bbde73734&ip=116.193.161.27&format=json");
//echo $a; 
//die;

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';


    if($ipaddress == 'UNKNOWN')
    {
      $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    
    }  
    return $ipaddress;
}

//AIzaSyBGtM0dY8A7JgqvCN9TydLeNIVhWZnJ1K8


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>"  ng-app="myApp" id="filghtCtrlHomeId" ng-controller="filghtCtrlHome"  version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
  <title>Flyoticket</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Flyoticket,Travel Painters,Car,hotel,flight,booking flight" />
    <meta name="description" content="Flyoticket - A Premium Booking for travel">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/mystyles.css">
    <script src="<?php echo $themeurl; ?>/js/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	<!--Added for destinations -->
	<link rel="stylesheet" href="<?php echo $themeurl; ?>/css/dest.min.css">
	<link rel="stylesheet" href="<?php echo $themeurl; ?>/css/default.css">
	<link rel="stylesheet" href="<?php echo $themeurl; ?>/css/component.css">
	<script src="<?php echo $themeurl; ?>/js/modernizr.custom.js"></script>
	
	<!--Added for error messages to be displayed -->
	<link rel="stylesheet" href="<?php echo $themeurl; ?>/css/errormessages.css">

    
      <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/ab-style.css" />
     <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/menu-style.css" />
     <!--
     <link rel="stylesheet" href="<?php //echo $themeurl; ?>/css/switcher.css" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/bright-turquoise.css" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/turkish-rose.css" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/salem.css" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/hippie-blue.css" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/mandy.css" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/green-smoke.css" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/horizon.css" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/cerise.css" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/brick-red.css" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/de-york.css" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/shamrock.css" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/studio.css" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/leather.css" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/denim.css" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php //echo $themeurl; ?>/css/schemes/scarlet.css" title="scarlet" media="all" />
    -->
  <?php /* print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; */?>

  <script type="text/javascript">
  <?php if(strpos($base_url, "flyoticket.com"))
        { ?>
    //var urlforapi = "http://127.0.0.1:1337/";
    //var urlforapi = "http://104.168.102.222:1337/";
    var urlforapi = "https://flyoticket.com/phpsaber/autoc.php";
  <?php } ?>  
  <?php if(strpos($base_url, "travelpainters.local"))
        { ?>
    //var urlforapi = "http://127.0.0.1:1337/";
    var urlforapi = "http://travelpainters.local/phpsaber/autoc.php";
    //var urlforapi = "http://flyoticket.com:1337/";
  <?php } ?>  
    
  </script>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<header id="main-header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">

                            <a class="logo" href="<?php echo $base_url; ?>">

                                <img src="<?php echo $themeurl; ?>/img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </div>
                        
                        <!-- user menu and phone number in common -->
                        <?php 
                          $pathoffile = realpath(__DIR__);
                          //echo $pathoffile; die;
                          require_once $pathoffile."/common/"."menuandphone.php"
                        ?>
                        
                        <!-- user menu and number in common -->
                    </div>
                </div>
            </div>
           <div class="container sukh-menu">
               <nav class="navbar navbar-default">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>


    <div class="collapse navbar-collapse js-navbar-collapse">
      <?php 
        $pathoffile = realpath(__DIR__);
        //echo $pathoffile; die;
        require_once $pathoffile."/"."menu.php"
      ?>
   
    </div>
    <!-- /.nav-collapse -->
  </nav>
            </div>
        </header>

  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  <?php 
        $pathoffile = realpath(__DIR__);
        //echo $pathoffile; die;
        require_once $pathoffile."/"."footer.php"
  ?>
 

        <script src="<?php echo $themeurl; ?>/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/slimmenu.js"></script>
        <!--<script src="<?php echo $themeurl; ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap-timepicker.js"></script>-->
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

        <script src="<?php echo $themeurl; ?>/js/nicescroll.js"></script>
        <script src="<?php echo $themeurl; ?>/js/dropit.js"></script>
        <script src="<?php echo $themeurl; ?>/js/ionrangeslider.js"></script>
        <script src="<?php echo $themeurl; ?>/js/icheck.js"></script>
        <script src="<?php echo $themeurl; ?>/js/fotorama.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script src="<?php echo $themeurl; ?>/js/typeahead.js"></script>
        <script src="<?php echo $themeurl; ?>/js/card-payment.js"></script>
        <script src="<?php echo $themeurl; ?>/js/magnific.js"></script>
        <script src="<?php echo $themeurl; ?>/js/owl-carousel.js"></script>
        <script src="<?php echo $themeurl; ?>/js/fitvids.js"></script>
        <script src="<?php echo $themeurl; ?>/js/tweet.js"></script>
        <script src="<?php echo $themeurl; ?>/js/countdown.js"></script>
        <script src="<?php echo $themeurl; ?>/js/gridrotator.js"></script>
        <script src="<?php echo $themeurl; ?>/js/custom.js"></script>
        <script src="<?php echo $themeurl; ?>/js/switcher.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="//google.com/jsapi?key=AIzaSyBGtM0dY8A7JgqvCN9TydLeNIVhWZnJ1K8"></script>
        <script type="text/javascript">
          google.load("maps", "2.x", {callback: initialize});

          var lat = "";
          var long = "";

          function initialize() {
            if (google.loader.ClientLocation) {
                var lat = google.loader.ClientLocation.latitude;
                var long = google.loader.ClientLocation.longitude;
                angular.element(document.getElementById('filghtCtrlHomeId')).scope().init(lat,long);
                //alert ("lat: " + lat + "\nlong: " + long);
             }
             else { console.log("not available"); }
           }
         </script>

        <script>
          
          var app = angular.module('myApp', []);

          app.controller('filghtCtrlHome', ['$scope', '$log', '$http','flightServiceNew' , 'getFlightDataService', 'getFlightBmf',  function($scope, $log, $http, flightServiceNew, getFlightDataService, getFlightBmf)  { 

            $scope.init = function (lat,long) {
              console.log("init");console.log(lat);console.log(long);
                if(lat !== undefined && long !== undefined && lat != "" && long != "")
                { 

                    var url  = "<?php echo $base_url; ?>"+"/phpsaber/popularratesforhome.php?lat="+lat+"&long="+long;
                    //var url  = "<?php echo $base_url; ?>"+"/phpsaber/popularratesforhome.php?lat=46.6734&long=-71.7412";
                    $http.get(url).then(function(value) {
                        $scope.example2 = value.status;
                    });

                }

            }    


          }]); //controller ends
          


          $(document).ready(function(){
            $("#workflow-form").submit(function(event) { 
              var over = '<div id="overlay">' +
                      '<img id="loading" src="//swellalerts.com/img/plane_loading.gif"/>' +
                      '</div>';
                  $(over).appendTo('body');
                  return false;
              $.post($(this).attr('action'), $(this).serialize(), function(json) {
                $("#results").text(JSON.stringify(json, null, 2));
                $('#overlay').remove();
              }, 'json');
              return false;
            });

            $('.imgplaces').on('click',function(){
                var fromval = $("input[name=from]").val();
                var toval = $("input[name=to]").val();
                $("input[name=from]").val(toval);
                $("input[name=to]").val(fromval);
            });

            $('.imgplacesow').on('click',function(){
                var fromval = $("input[name=rfrom]").val();
                var toval = $("input[name=tfrom]").val();
                $("input[name=rfrom]").val(toval);
                $("input[name=tfrom]").val(fromval);
            });

          });   
        </script>
    </div>
  <script src="<?php echo $themeurl; ?>/js/controllers.js"></script>  
</body>
</html>
