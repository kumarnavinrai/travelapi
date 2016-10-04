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
$themeurl = file_create_url(path_to_theme());

global $base_url;   // Will point to http://www.example.com
global $base_path;  // Will point to at least "/" or the subdirectory where the drupal in installed.
$sitelink = $base_url . $base_path;



if($base_url == "http://travelpainters.local")
{
  $urlofwp = "http://travelpainters.local/"; 
  $_SESSION['urlforform'] = "http://travelpainters.local/";
  $sitelink = $_SESSION['urlforform'];
  $urltoGetFilghts = "http://127.0.0.1:1337/fs/";
//$urltoGetFilghts = "http://104.168.102.222:1337/fs/";
}
elseif($base_url == "http://travelpainters.com")
{
  $urlofwp = "http://travelpainters.com/";  
  $_SESSION['urlforform'] = "http://travelpainters.com/";
  $sitelink = $_SESSION['urlforform'];
  //$urltoGetFilghts = "http://127.0.0.1:1337/fs/";
  $urltoGetFilghts = "http://104.168.102.222:1337/fs/";
}


$noofresultonpage = 50;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?> ng-app="myApp" ng-controller="filghtBookCtrl" >

<head profile="<?php print $grddl_profile; ?>">
  <title>Travel Painters</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Travelpainters,Travel Painters,Car,hotel,flight,booking flight" />
    <meta name="description" content="Travel Painters - A Premium Booking for travel">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/mystyles.css">
    <script src="<?php echo $themeurl; ?>/js/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/ab-style.css" />
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/menu-style.css" />
    <!--
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/switcher.css" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/bright-turquoise.css" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/turkish-rose.css" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/salem.css" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/hippie-blue.css" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/mandy.css" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/green-smoke.css" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/horizon.css" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/cerise.css" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/brick-red.css" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/de-york.css" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/shamrock.css" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/studio.css" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/leather.css" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/denim.css" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $themeurl; ?>/css/schemes/scarlet.css" title="scarlet" media="all" />
    -->
  <?php /* print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; */?>
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
                        <div class="col-md-3 col-md-offset-2">
                           
                        </div>
                        <div class="col-md-4">
                            <div class="top-user-area clearfix">
                                <ul class="top-user-area-list list list-horizontal list-border">
                                   
                                    <?php
                                       global $user;

                                      if ( $user->uid ) 
                                      { ?>
                                      <li><a href="<?php echo $sitelink; ?>mybookingdetails">Bookings</a>
                                        </li>
                                      <li><a href="<?php echo $sitelink; ?>user/<?php echo $user->uid; ?>/edit">Profile</a>
                                        </li>
                                       <li><a href="<?php echo $sitelink; ?>user/logout">Logout</a>
                                        </li>
                                       <?php
                                      }
                                      elseif(!$user->uid) 
                                      {
                                        ?>
                                        <li><a href="<?php echo $sitelink; ?>user/register">Register</a>
                                        </li>
                                        <li><a href="<?php echo $sitelink; ?>user">Sign in</a>
                                        </li>
                                      <?php  
                                      }
                                    ?>
                                    
                                        </ul>
                                    
                                               
                            </div>
                        </div>
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
      <ul class="nav navbar-nav">
        <li class="dropdown mega-dropdown">
          <a href="<?php echo $urlofwp; ?>destinations" class="dropdown-toggle" data-toggle="dropdown">DESTINATIONS<i class="fa fa-sort-desc sukh" aria-hidden="true"></i></a>

          <ul class="dropdown-menu mega-dropdown-menu row">
           
            <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>destinations-packages/europe/" >Europe</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/amsterdam/">Amsterdam</a></li>
          <li><a href="<?php echo $urlofwp; ?>packages/berlin/">Berlin</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/hallstatt/">Hallstatt</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/lille-france/">Lille,France</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/london/">London</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/sicily-italy/">Sicily,Italy</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/cinque-terre/">Cinque Terre,Italy</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/rome-2/">Rome</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/greek-island/">The Greek Islands</a></li>
              </ul>
            </li>
            <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>destinations-packages/africa/">Africa</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/port-elizabeth/">Port Elizabeth</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/livingstone-island/">Livingstone Islands</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/pyramids-of-giza/">pyramids of Giza</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/mombasa/">Monbasa</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/port-elizabeth">Casablanca</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/alexandria-2/">Alexandria</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/okavango-delta/">Okavango Delta</a></li>
                
              </ul>
            </li>
            <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>destinations-packages/asia/">Aisa</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/andaman-islands/">Andaman islands</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/mie-prefecture-2/">Mie Prefecture</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/taipei-taiwan/">Taipei Taiwan </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/hangzhou/">Hangzhou,China</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/dubai/">Dubai</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/tokyo/">Tokoyo</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/hong-kong/">Hong Kong</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/shanghai/">Shanghai</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/beijing/">Beizing </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/seoul/">Seoul</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/kuala-lumpur/">Kuala Lunpur</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/siberia/">Sideria </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/new-delhi/">New Delhi</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/bangkok-trip/">Bangkok</a></li>
              </ul>
            </li>
       <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>destinations-packages/america/">South America</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/chiloe-chile/">Chiloe,Chile</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/santiago-chile/">Santiago,Chile</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/rio-de-janeiro/">Rio De janeiro </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/mar-del-plata/">Mar Del Plata</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/lake-titicaca/">Lake Titicaca</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/peru/">Peru</a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/venezuela/">Venezuela</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/argentina/">Argentina</a></li>
              </ul>
            </li>
       <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>destinations-packages/america/">North America</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/san-antonio-texas/">San Antonio</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/alcatraz/">Alcatraz</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/volcan-paricutin/">Volcan Paricutin</a></li>
         <li><a href="<?php echo $urlofwp; ?>packages/aspen-and-the-roaring-fork-valley/">Aspen And Fork Velley</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/los-angeles-vacation/">Los Angeless</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/florida-keys-vacation/">Florita </a></li>
         <li><a href="<?php echo $urlofwp; ?>packages/new-york/">New York</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/hearst-san-simeon-state-historic-monument/">Hearst San Simeon</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/cuba/">Cuba </a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/bishop-museum/">Bishop Museum</a></li>
              </ul>
            </li>
       <li class="col-sm-2">
              <ul>
                <li class="dropdown-header"><a href="<?php echo $urlofwp; ?>destinations-packages/oceania/">Oceania</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/tasmania/">Tasmania</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/kangaroo-island/">Kangaroo Islands</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/fraser-island/">Fraser Islands </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/fiji/">Fiji</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/adelaide/">Adelaite,Austrila</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/sydney/">Sydney,Austrila </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/perth/">Perth,Austrila</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/brisbane/">Brisbane,Austrila</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/melbourne/">Melbourne,Austrila </a></li>
        <li><a href="<?php echo $urlofwp; ?>packages/darwin/">Darwin,Austrila</a></li>
                <li><a href="<?php echo $urlofwp; ?>packages/polynesia/">Polynesia</a></li>
              </ul>
            </li>
      </ul>
    </li>
    <li ><a href="#">FLIGHTS</a> </li>
                <li><a href="#">HOTELS</a> </li>
                                <li><a href="<?php echo $urlofwp; ?>insurance/">INSURANCE</a></li>
                                <li><a href="<?php echo $urlofwp; ?>cars/">CARS</a></li>
                                <li><a href="about.php">ABOUT US</a> </li>
                               
                                <li><a href="<?php echo $urlofwp; ?>contacts/">CONTACT US</a></li>
    
    </ul>
   
    </div>
    <!-- /.nav-collapse -->
  </nav>
            </div>
        </header>

  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  <footer id="main-footer">
            <div class="container">
                <div class="row row-wrap">
                    <div class="col-md-3">
                        <a class="logo" href="<?php echo $themeurl; ?>/index.html">
                            <img src="<?php echo $themeurl; ?>/img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                        </a>
                        <p class="mb20">Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
                        <ul class="list list-horizontal list-space">
                            <li>
                                <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="https://www.facebook.com/Travel-Painters-306631056363730/"></a>
                            </li>
                            <li>
                                <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="https://twitter.com/travelpainters"></a>
                            </li>
                            <li>
                                <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href="https://plus.google.com/u/0/102787608504703821299"></a>
                            </li>
                            <li>
                                <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href="https://www.linkedin.com/in/travel-painters-955359128?
trk=nav_responsive_tab_profile"></a>
                            </li>
                            
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h4>Newsletter</h4>
                        <form>
                            <label>Enter your E-mail Address</label>
                            <input type="text" class="form-control">
                            <p class="mt5"><small>*We Never Send Spam</small>
                            </p>
                            <input type="submit" class="btn btn-primary" value="Subscribe">
                        </form>
                    </div>
                    <div class="col-md-2">
                        <ul class="list list-footer">
                            <li><a href="about.php">About US</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Use</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Have Questions?</h4>
                        <h4 class="text-color">1-888-417-0446</h4>
                        <h4><a href="#" class="text-color">support@travelpainters.com</a></h4>
                        <p>24/7 Dedicated Customer Support</p>
                    </div>

                </div>
            </div>
        </footer>

        <script src="<?php echo $themeurl; ?>/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap.js"></script>
        <script src="<?php echo $themeurl; ?>/js/slimmenu.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap-timepicker.js"></script>
        <script src="<?php echo $themeurl; ?>/js/nicescroll.js"></script>
        <script src="<?php echo $themeurl; ?>/js/dropit.js"></script>
        <script src="<?php echo $themeurl; ?>/js/ionrangeslider.js"></script>
        <script src="<?php echo $themeurl; ?>/js/icheck.js"></script>
        <script src="<?php echo $themeurl; ?>/js/fotorama.js"></script>
        <script src="<?php echo $themeurl; ?>/js/typeahead.js"></script>
        <script src="<?php echo $themeurl; ?>/js/card-payment.js"></script>
        <script src="<?php echo $themeurl; ?>/js/magnific.js"></script>
        <script src="<?php echo $themeurl; ?>/js/owl-carousel.js"></script>
        <script src="<?php echo $themeurl; ?>/js/fitvids.js"></script>
        <script src="<?php echo $themeurl; ?>/js/tweet.js"></script>
        <script src="<?php echo $themeurl; ?>/js/countdown.js"></script>
        <script src="<?php echo $themeurl; ?>/js/gridrotator.js"></script>
        <script src="<?php echo $themeurl; ?>/js/switcher.js"></script>
        <script src="<?php echo $themeurl; ?>/js/ac.js"></script>
        <script src="<?php echo $themeurl; ?>/js/custom.js"></script>
        <script src="<?php echo $themeurl; ?>/js/moment.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/angular-moment.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                <?php if(isset($_REQUEST['outboundflightstops']) && $_REQUEST['outboundflightstops'] != ""){ ?>
                    $('.checkboxesli .checkbox_stops').each(function() {
                           if($(this).val() == <?php echo $_REQUEST['outboundflightstops']; ?>){
                                $(this).prop('checked', true);
                                $(this).parent('.i-check').addClass("checked");
                           }
                        });
                <?php } ?>

                <?php if(isset($_REQUEST['outbounddeparturewindow']) && $_REQUEST['outbounddeparturewindow'] != ""){ ?>
                    $('.departtimecheckboxes .checkbox_dt').each(function() {
                           if($(this).val() == "<?php echo $_REQUEST['outbounddeparturewindow']; ?>"){
                                $(this).prop('checked', true);
                                $(this).parent('.i-check').addClass("checked");
                           }
                        });
                <?php } ?>
                
                   <?php if(isset($_REQUEST['includedcarriers']) && $_REQUEST['includedcarriers'] != ""){ ?>
                    var allailinesarr = <?php echo json_encode(explode(",",$_REQUEST['includedcarriers'])); ?>;
                        $('.liforairline .cls_airline').each(function() {
                           if($.inArray($(this).val(),allailinesarr) != -1){
                                $(this).prop('checked', true);
                                $(this).parent('.i-check').addClass("checked");
                           }
                        });
                    <?php } ?>

                    <?php if(isset($_REQUEST['inboundstopduration']) && $_REQUEST['inboundstopduration'] != ""){ ?>
                    $('.layoverli .layoverchkbox').each(function() {
                           if($(this).val() == <?php echo $_REQUEST['inboundstopduration']; ?>){
                                $(this).prop('checked', true);
                                $(this).parent('.i-check').addClass("checked");
                           }
                        });
                    <?php } ?>

                    
                $('.iCheck-helper').on('click',function(){
                
                    if($(this).siblings('.checkbox_stops').length == 1){
                        
                        var valueofcheckedcheckbox = $(this).siblings('.checkbox_stops').val();
                        $('.cls_stops').val(valueofcheckedcheckbox);
                        //$('.formforfilters').submit();
                        $('.checkboxesli .checkbox_stops').each(function() {

                           if($(this).val() != valueofcheckedcheckbox && $(this).parent('.i-check').hasClass("checked")){
                                $(this).prop('checked', false);
                                $(this).parent('.i-check').removeClass("checked");
                           }
                        });
                        var allcheckboxunchecked = "no";
                        $('.checkboxesli .checkbox_stops').each(function() {
                           if($(this).parent('.i-check').hasClass("checked")){
                                allcheckboxunchecked = "yes";
                           }
                        });
                        if(allcheckboxunchecked == "no"){
                           $('.cls_stops').val(""); 
                        }
                    }

                    
                    if($(this).siblings('.checkbox_dt').length == 1){
                        
                        var valueofcheckedcheckbox = $(this).siblings('.checkbox_dt').val();
                        $('.cls_departure').val(valueofcheckedcheckbox);
                        //$('.formforfilters').submit();
                        $('.departtimecheckboxes .checkbox_dt').each(function() {

                           if($(this).val() != valueofcheckedcheckbox && $(this).parent('.i-check').hasClass("checked")){
                                $(this).prop('checked', false);
                                $(this).parent('.i-check').removeClass("checked");
                           }
                        });
                        var allcheckboxunchecked = "no";
                        $('.departtimecheckboxes .checkbox_dt').each(function() {
                           if($(this).parent('.i-check').hasClass("checked")){
                                allcheckboxunchecked = "yes";
                           }
                        });
                        if(allcheckboxunchecked == "no"){
                           $('.cls_departure').val(""); 
                        }
                    }


                    if($(this).siblings('.cls_airline').length == 1){
                        
                        var valueofcheckedcheckbox = $(this).siblings('.cls_airline').val();
                                                
                        if($(this).parent('.i-check').hasClass("checked") && $(this).siblings('.cls_airline').prop("checked") == true){
                            
                            if($('.cls_airlines').val() == ""){
                                $('.cls_airlines').val(valueofcheckedcheckbox);
                            }else{
                                var alradyvalofdepat = $('.cls_airlines').val();
                                valueofcheckedcheckbox = alradyvalofdepat + "," + valueofcheckedcheckbox;
                                $('.cls_airlines').val(valueofcheckedcheckbox);
                            }    
                        }

                        if(!$(this).parent('.i-check').hasClass("checked")){
                            var alradyvalofdepat = $('.cls_airlines').val();
                            
                            alradyvalofdepat = alradyvalofdepat.replace(valueofcheckedcheckbox, '');
                            alradyvalofdepat = alradyvalofdepat.replace(',,', ',');
                            if(alradyvalofdepat.charAt(0) == ","){
                                alradyvalofdepat = alradyvalofdepat.replace(',', '');
                            }

                            var lastChar = alradyvalofdepat.substr(alradyvalofdepat.length - 1);
                            if(lastChar == ","){
                                alradyvalofdepat = alradyvalofdepat.replace(/(\s+)?.$/, '');
                                
                            }
                            $('.cls_airlines').val(alradyvalofdepat);
                        }

                        
                        var allcheckboxunchecked = "no";
                        $('.liforairline .cls_airline').each(function() {
                           if($(this).parent('.i-check').hasClass("checked")){
                                allcheckboxunchecked = "yes";
                           }
                        });
                        if(allcheckboxunchecked == "no"){
                           $('.cls_airlines').val(""); 
                        }
                    }

                    
                    if($(this).siblings('.layoverchkbox').length == 1){
                        
                        var valueofcheckedcheckbox = $(this).siblings('.layoverchkbox').val();
                        $('.cls_layover').val(valueofcheckedcheckbox);
                        //$('.formforfilters').submit();
                        $('.layoverli .layoverchkbox').each(function() {

                           if($(this).val() != valueofcheckedcheckbox && $(this).parent('.i-check').hasClass("checked")){
                                $(this).prop('checked', false);
                                $(this).parent('.i-check').removeClass("checked");
                           }
                        });
                        var allcheckboxunchecked = "no";
                        $('.layoverli .layoverchkbox').each(function() {
                           if($(this).parent('.i-check').hasClass("checked")){
                                allcheckboxunchecked = "yes";
                           }
                        });
                        if(allcheckboxunchecked == "no"){
                           $('.cls_layover').val(""); 
                        }
                    }

                });
                $('.fliter_apply').on('click',function(){
                    if($('.cls_stops').val() != "" || $('.cls_departure').val() != "" || $('.cls_airlines').val() != "" || $('.cls_layover').val() != ""){
                        $('.formforfilters').submit();
                    }else{
                        alert("Please select a filter");
                    }
                });
            });
        </script>
        <script type="text/javascript">
          
          var app = angular.module('myApp', ['angularMoment']);

          app.controller('filghtBookCtrl', ['$scope', '$log', 'getFlightDataService', function($scope, $log, getFlightDataService)  { 
           
         
          }]);

            $(document).ready(function(){
                $('.book_btn').on('click',function(){
              
                    if($('.userFormValid').val()=='true'){
                      alert("Please check passenger information. !!!");
                    }
                    if($('.userFormccValid').val()=='true'){
                      alert("Please Card Details. !!!");
                    }
                    if($('.userFormdValid').val()=='true'){
                      alert("Please check Contact Information. !!!");
                    }

                    if($('.userFormValid').val() == "false" && $('.userFormccValid').val() == "false" && $('.userFormdValid').val() == "false"){
                      //console.log($('.userFormcls').serialize());
                      //console.log($('.userFormcccls').serialize());
                      //console.log($('.userFormdcls').serialize());
                      var datatosub = $('.userFormcls').serialize() + "###" + $('.userFormcccls').serialize() + "###" + $('.userFormdcls').serialize();
                      datatosub = Base64.encode(datatosub);
                      
                      $('<form method="POST" action="<?php echo $_SESSION['urlforform']; ?>shownodes"><input type="text" name="d" value="'+datatosub+'" /></form>').appendTo('body').submit();
                    }
                });
            });



            var Base64 = {


                _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


                encode: function(input) {
                    var output = "";
                    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
                    var i = 0;

                    input = Base64._utf8_encode(input);

                    while (i < input.length) {

                        chr1 = input.charCodeAt(i++);
                        chr2 = input.charCodeAt(i++);
                        chr3 = input.charCodeAt(i++);

                        enc1 = chr1 >> 2;
                        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                        enc4 = chr3 & 63;

                        if (isNaN(chr2)) {
                            enc3 = enc4 = 64;
                        } else if (isNaN(chr3)) {
                            enc4 = 64;
                        }

                        output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

                    }

                    return output;
                },


                decode: function(input) {
                    var output = "";
                    var chr1, chr2, chr3;
                    var enc1, enc2, enc3, enc4;
                    var i = 0;

                    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

                    while (i < input.length) {

                        enc1 = this._keyStr.indexOf(input.charAt(i++));
                        enc2 = this._keyStr.indexOf(input.charAt(i++));
                        enc3 = this._keyStr.indexOf(input.charAt(i++));
                        enc4 = this._keyStr.indexOf(input.charAt(i++));

                        chr1 = (enc1 << 2) | (enc2 >> 4);
                        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                        chr3 = ((enc3 & 3) << 6) | enc4;

                        output = output + String.fromCharCode(chr1);

                        if (enc3 != 64) {
                            output = output + String.fromCharCode(chr2);
                        }
                        if (enc4 != 64) {
                            output = output + String.fromCharCode(chr3);
                        }

                    }

                    output = Base64._utf8_decode(output);

                    return output;

                },

                _utf8_encode: function(string) {
                    string = string.replace(/\r\n/g, "\n");
                    var utftext = "";

                    for (var n = 0; n < string.length; n++) {

                        var c = string.charCodeAt(n);

                        if (c < 128) {
                            utftext += String.fromCharCode(c);
                        }
                        else if ((c > 127) && (c < 2048)) {
                            utftext += String.fromCharCode((c >> 6) | 192);
                            utftext += String.fromCharCode((c & 63) | 128);
                        }
                        else {
                            utftext += String.fromCharCode((c >> 12) | 224);
                            utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                            utftext += String.fromCharCode((c & 63) | 128);
                        }

                    }

                    return utftext;
                },

                _utf8_decode: function(utftext) {
                    var string = "";
                    var i = 0;
                    var c = c1 = c2 = 0;

                    while (i < utftext.length) {

                        c = utftext.charCodeAt(i);

                        if (c < 128) {
                            string += String.fromCharCode(c);
                            i++;
                        }
                        else if ((c > 191) && (c < 224)) {
                            c2 = utftext.charCodeAt(i + 1);
                            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                            i += 2;
                        }
                        else {
                            c2 = utftext.charCodeAt(i + 1);
                            c3 = utftext.charCodeAt(i + 2);
                            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                            i += 3;
                        }

                    }

                    return string;
                }

            }

        </script>
        <form method="POST" class="formforselect" style="display:none;" action="<?php echo $_SESSION['urlforform']; ?>searchsale">
            <label>Data</label>
            <input name="bookdata" value="" />
        </form>
        <?php 
                if(isset($_POST['from']) && $_POST['from'] != "" && isset($_POST['to']) && $_POST['to'] != "")
                {    
                    ?>
                  <form method="POST" class="formforfilters" style="display:none;" action="<?php echo $_SESSION['urlforform']; ?>searchresult">
                    <label>From</label>
                    <input name="from" value="<?php echo $fromairportcode; ?>" />
                    <label>To</label>
                    <input name="to"  value="<?php echo $toairportcode ?>" />
                    <label>Start</label>
                    <input name="start"  value="<?php echo $startdate ?>" />
                    <label>End</label>
                    <input name="end"  value="<?php echo $todate ?>" />
                    <label>Adult</label>
                    <input name="adult"  value="<?php echo isset($_REQUEST['adult'])?$_REQUEST['adult']:""; ?>" />
                    <label>Children</label>
                    <input name="children"  value="<?php echo isset($_REQUEST['children'])?$_REQUEST['children']:""; ?>" />
                    <label>Pclass</label>
                    <input name="pclass"  value="<?php echo isset($_REQUEST['pclass'])?$_REQUEST['pclass']:""; ?>" />
                    <label>Rfrom</label>
                    <input name="rfrom"  value="" />
                    <label>Tfrom</label>
                    <input name="tfrom"  value="" />
                    <label>Departing</label>
                    <input name="departing"  value="" />
                    <label>Rclass</label>
                    <input name="rclass"  value="<?php echo isset($_POST["rclass"])?$_REQUEST['rclass']:""; ?>" />
                    <label>Noofp</label>
                    <input name="noofp"  value="<?php echo isset($_REQUEST['noofp'])?$_REQUEST['noofp']:""; ?>" />
                    <label>Connections</label>
                    <input name="outboundflightstops" class="cls_stops"  value="<?php echo isset($_REQUEST['outboundflightstops'])?$_REQUEST['outboundflightstops']:""; ?>" />
                    <label>Departure</label>
                    <input name="outbounddeparturewindow" class="cls_departure"  value="<?php echo isset($_REQUEST['outbounddeparturewindow'])?$_REQUEST['outbounddeparturewindow']:""; ?>" />
                    <label>Airlines</label>
                    <input name="includedcarriers" class="cls_airlines"  value="<?php echo isset($_REQUEST['includedcarriers'])?$_REQUEST['includedcarriers']:""; ?>" />
                    <label>Layover</label>
                    <input name="inboundstopduration" class="cls_layover"  value="<?php echo isset($_REQUEST['inboundstopduration'])?$_REQUEST['inboundstopduration']:""; ?>" />
                  </form>
                <?php
                }  

                 if(isset($_POST['rfrom']) && $_POST['rfrom'] != "" && isset($_POST['tfrom']) && $_POST['tfrom'] != "")
                {    ?>
                  <form method="POST" class="formforfilters" style="display:none;" action="<?php echo $_SESSION['urlforform']; ?>searchresult">
                    <label>From</label>
                    <input name="from" value="" />
                    <label>To</label>
                    <input name="to"  value="" />
                    <label>Start</label>
                    <input name="start"  value="" />
                    <label>End</label>
                    <input name="end"  value="" />
                    <label>Adult</label>
                    <input name="adult"  value="<?php echo isset($_REQUEST['adult'])?$_REQUEST['adult']:""; ?>" />
                    <label>Children</label>
                    <input name="children"  value="<?php echo isset($_REQUEST['children'])?$_REQUEST['children']:""; ?>" />
                    <label>Pclass</label>
                    <input name="pclass"  value="<?php echo isset($_REQUEST['pclass'])?$_REQUEST['pclass']:""; ?>" />
                    <label>Rfrom</label>
                    <input name="rfrom"  value="<?php echo $fromairportcode; ?>" />
                    <label>Tfrom</label>
                    <input name="tfrom"  value="<?php echo $toairportcode ?>" />
                    <label>Departing</label>
                    <input name="departing"  value="<?php echo $startdate ?>" />
                    <label>Rclass</label>
                    <input name="rclass"  value="<?php echo isset($_POST["rclass"])?$_REQUEST['rclass']:""; ?>" />
                    <label>Noofp</label>
                    <input name="noofp"  value="<?php echo isset($_REQUEST['noofp'])?$_REQUEST['noofp']:""; ?>" />
                    <label>Connections</label>
                    <input name="outboundflightstops" class="cls_stops"  value="<?php echo isset($_REQUEST['outboundflightstops'])?$_REQUEST['outboundflightstops']:""; ?>" />
                    <label>Departure</label>
                    <input name="outbounddeparturewindow" class="cls_departure"  value="<?php echo isset($_REQUEST['outbounddeparturewindow'])?$_REQUEST['outbounddeparturewindow']:""; ?>" />
                    <label>Airlines</label>
                    <input name="includedcarriers" class="cls_airlines"  value="<?php echo isset($_REQUEST['includedcarriers'])?$_REQUEST['includedcarriers']:""; ?>" />
                    <label>Layover</label>
                    <input name="inboundstopduration" class="cls_layover"  value="<?php echo isset($_REQUEST['inboundstopduration'])?$_REQUEST['inboundstopduration']:""; ?>" />
                  </form>
                <?php
                }  
             ?>   
              
              
        <script src="<?php echo $themeurl; ?>/js/controllers.js"></script>
    
    </div>

</body>
</html>