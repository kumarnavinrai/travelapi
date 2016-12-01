<?php

header('Access-Control-Allow-Origin: *');
//echo "<pre>"; print_r($_REQUEST); die;
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

  $pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
  require_once $pathoffile."/"."serverconfig.php";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?> ng-app="myApp" id="filghtCtrlId" ng-controller="filghtCtrl" >

<head profile="<?php print $grddl_profile; ?>">
  <title>Flyoticket</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Flyoticket,Car,hotel,flight,booking flight" />
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
  <?php
    $pathoffile = realpath(__DIR__);
    //echo $pathoffile; die;
    require_once $pathoffile."/common/"."callext.php";
  ?>
</head>
<body data-ng-init="init()"  class="<?php print $classes; ?>" <?php print $attributes;?>>
<?php
  $pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
  require_once $pathoffile."/common/"."cclick.php";
?>
<?php
  $pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
  require_once $pathoffile."/common/"."analyticstracking.php";
?>
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

<?php 
  $pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
  require_once $pathoffile."/"."menu.php"
?>
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
        <button style="display:none;" onclick="maskedfuncoff()">Click Me</button>
  <div id="bloadify" style="display:none;"> <a href="#" id="bload">Bload</a></div>      
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  <?php 
        $pathoffile = realpath(__DIR__);
        //echo $pathoffile; die;
        require_once $pathoffile."/"."footer.php";
        
  ?>
        <script type="text/javascript">
        var carrayblod;
        function maskedfunc(){
                        $('#bloadify').bload({
                            fadeInSpeed: 300, // The speed the loading screen fades in.
                            maskOpacity: .6, // Opacity of the mask. 
                            imagePath: "<?php echo $themeurl; ?>/img/plane_loading.gif", // Path to the a difference loading image.
                            imagePadding: 16, // Padding around the loading image.
                            imageDims: {w:160,h:20}, // Width and Height of the image.
                            fullScreen: true, // Enables full screen mode. 
                            overlay : { 
                            show: true, // Show an overlay over the entire area to mask.
                            color: '#000', // Color of the overlay. 
                            /*'background-color' : 'rgba(0, 0, 0, 0)',*/
                            opacity: .2 // Opacity of the overlay
                            }
                        
                    },
                    function(bload){
                        //setTimeout(function(){
                        //bload.hide();
                        //},30000);
                        carrayblod = bload;

                    });
            }    

            function maskedfuncoff(){
                
                setTimeout(function(){
                       
                      carrayblod.hide();
                      $('.bargainfinderresult').hide();
                      
                     

                },1000);
                
               
                
            }   


            //totalnoofresultsfound

        </script>
        <script src="<?php echo $themeurl; ?>/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap.js"></script>
        <script src="<?php echo $themeurl; ?>/js/slimmenu.js"></script>
        <!--<script src="<?php echo $themeurl; ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap-timepicker.js"></script>-->
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
        
        <script src="<?php echo $themeurl; ?>/js/moment.min.js"></script>
                <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

        <script src="<?php echo $themeurl; ?>/js/angular-moment.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/underscore-min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/dirPagination.js"></script>
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <script src="<?php echo $themeurl; ?>/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo $themeurl; ?>/bload/bload.js"></script>
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
                        var elementoscheckbox = $(this).siblings('.checkbox_stops');
                        $('.cls_stops').val(valueofcheckedcheckbox);
                        //filghtCtrlId
                        //calling angular function here
                        if(elementoscheckbox.is(':checked')===true){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFunc(valueofcheckedcheckbox);
                        }else if(elementoscheckbox.is(':checked')===false){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFunc("");
                        }

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

                        var elementoscheckbox = $(this).siblings('.checkbox_dt');
                        $('.cls_departure').val(valueofcheckedcheckbox);

                        //filghtCtrlId
                        //calling angular function here
                        if(elementoscheckbox.is(':checked')===true){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFuncTime(valueofcheckedcheckbox);
                        }else if(elementoscheckbox.is(':checked')===false){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFuncTime("");
                        }
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
                        var elementoscheckbox = $(this).siblings('.cls_airline');
                        //filghtCtrlId
                        //calling angular function here
                        if(elementoscheckbox.is(':checked')===true){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFuncAirlines(valueofcheckedcheckbox);
                        }else if(elementoscheckbox.is(':checked')===false){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFuncAirlines("");
                        }
                                                
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
                        var elementoscheckbox = $(this).siblings('.layoverchkbox');
                        //filghtCtrlId
                        //calling angular function here
                        if(elementoscheckbox.is(':checked')===true){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFuncLayover(valueofcheckedcheckbox);
                        }else if(elementoscheckbox.is(':checked')===false){
                          angular.element(document.getElementById('filghtCtrlId')).scope().filterFuncLayover("");
                        }
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

                    if($('.cls_stops').val() != "" || $('.cls_departure').val() != "" || $('.cls_airlines').val() != "" || $('.cls_layover').val() != ""){
                       // $('.formforfilters').submit();
                    }

                });
                $('.fliter_apply').on('click',function(){
                    if($('.cls_stops').val() != "" || $('.cls_departure').val() != "" || $('.cls_airlines').val() != "" || $('.cls_layover').val() != ""){
                        //$('.formforfilters').submit();
                    }else{
                        alert("Please select a filter");
                    }
                });

                $('.sortingcls').on('click',function(e){
                  e.preventDefault();
                  var element = $(this);
                  var classesinthiscls = $(this).attr('class');
                  var sortingdata = classesinthiscls.replace("sortingcls", '');
                  sortingdata = sortingdata.replace(/ /g,'')
                  console.log(sortingdata);
                  $('.cls_sortbyval').val(sortingdata);
                  if(sortingdata){
                    angular.element(document.getElementById('filghtCtrlId')).scope().sortFunc(sortingdata);
                  }else if(!sortingdata){
                    angular.element(document.getElementById('filghtCtrlId')).scope().sortFunc("");
                  }
                  //sortFunc
                  //$('.formforfilters').submit();

                });

            });
//sortingcls cls_sortbyval
            function bookaflight(id){
                var clsname = id;    
                console.log(document.getElementsByClassName(clsname)[0].innerHTML);
                document.getElementsByName('saledata')[0].value = document.getElementsByClassName(clsname)[0].innerHTML;
                document.getElementById("idformforselect").submit();
                
            }

            function bookme(ele){
                //console.log($(ele).closest('li.amadeusresult').children('div').children('div').children('span').html());
                $('.saledata').val($(ele).closest('li.amadeusresult').children('div').children('div').children('span').html());
                $("#idformforselect").submit();
            }
        </script>
        <!--      ######################################################################################################################################################################################################################################################       -->
        <script type="text/javascript">
          
          var app = angular.module('myApp', ['angularMoment','angularUtils.directives.dirPagination']);

          function OtherController($scope) {
            $scope.pageChangeHandler = function(num) {
              console.log('going to page ' + num);
            };
          }

          //myApp.controller('MyController', MyController);
          app.controller('OtherController', OtherController);

          app.controller('filghtCtrl', ['$scope', '$log', 'flightServiceNew' , 'getFlightDataService', 'getFlightBmf', 'flightServiceNewAlter', 'flightServiceNewAlterAirport',  function($scope, $log, flightServiceNew, getFlightDataService, getFlightBmf, flightServiceNewAlter, flightServiceNewAlterAirport)  { 
            <?php 
                if(isset($_POST['from']) && $_POST['from'] != "" && isset($_POST['to']) && $_POST['to'] != "")
                { 

                  $fromairportcode = explode("-",$_POST['from']);
                  $fromairportcode = reset($fromairportcode);
                  $fromairportcode = trim($fromairportcode);
                  
                  $toairportcode  = explode("-",$_POST['to']);
                  $toairportcode = reset($toairportcode);
                  $toairportcode = trim($toairportcode);

                  $startdate = date('Y-m-d',strtotime($_POST['start']));
                  $todate = date('Y-m-d',strtotime($_POST['end']));
                }  

                 if(isset($_POST['rfrom']) && $_POST['rfrom'] != "" && isset($_POST['tfrom']) && $_POST['tfrom'] != "")
                {    
                  $fromairportcode = explode("-",$_POST['rfrom']);
                  $fromairportcode = reset($fromairportcode);
                  $fromairportcode = trim($fromairportcode);
                  
                  $toairportcode  = explode("-",$_POST['tfrom']);
                  $toairportcode = reset($toairportcode);
                  $toairportcode = trim($toairportcode);

                  $startdate = date('Y-m-d',strtotime($_POST['departing']));
                  $todate = "";
                }  
              

            ?>
              maskedfunc();
              <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] == ""){ ?>
              $scope.adult = "<?php echo isset($_REQUEST['adult'])&&$_REQUEST['adult']?$_REQUEST['adult']:0; ?>";
              $scope.children = "<?php echo isset($_REQUEST['children'])&&$_REQUEST['children']?$_REQUEST['children']:0; ?>";
              $scope.infant = "<?php echo isset($_REQUEST['infant'])&&$_REQUEST['infant']?$_REQUEST['infant']:0; ?>";
              $scope.pclass = "<?php echo isset($_REQUEST['pclass'])&&$_REQUEST['pclass']?$_REQUEST['pclass']:0; ?>";
              <?php } ?>
              <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] != ""){ ?>
              $scope.adult = "<?php echo isset($_REQUEST['adultow'])&&$_REQUEST['adultow']?$_REQUEST['adultow']:0; ?>";
              $scope.children = "<?php echo isset($_REQUEST['childrenow'])&&$_REQUEST['childrenow']?$_REQUEST['childrenow']:0; ?>";
              $scope.infant = "<?php echo isset($_REQUEST['infantow'])&&$_REQUEST['infantow']?$_REQUEST['infantow']:0; ?>";
              $scope.pclass = "<?php echo isset($_REQUEST['rclass'])&&$_REQUEST['rclass']?$_REQUEST['rclass']:0; ?>";
              <?php } ?>
              
              
              
              $scope.origin = "<?php echo $fromairportcode; ?>";
              $scope.origin = "<?php echo $fromairportcode; ?>";
              $scope.destination = "<?php echo $toairportcode ?>";
              $scope.departureDate = "<?php echo $startdate ?>";
              $scope.returnDate = "<?php echo $todate ?>";
              $scope.lengthofstay = "2,4,6,8,16"; //"
              $scope.searchedclass = "<?php echo $_POST["rclass"]; ?>";
              $scope.limit = <?php echo $noofresultonpage; ?>;
              $scope.outboundflightstops = "<?php echo isset($_REQUEST['outboundflightstops'])?$_REQUEST['outboundflightstops']:""; ?>";
              $scope.outbounddeparturewindow = "<?php echo isset($_REQUEST['outbounddeparturewindow'])?$_REQUEST['outbounddeparturewindow']:""; ?>"; 
              $scope.includedcarriers = "<?php echo isset($_REQUEST['includedcarriers'])?$_REQUEST['includedcarriers']:""; ?>";
              $scope.inboundstopduration = "<?php echo isset($_REQUEST['inboundstopduration'])?$_REQUEST['inboundstopduration']:""; ?>";
              $scope.sortbyval = "<?php echo isset($_REQUEST['sortbyval'])?$_REQUEST['sortbyval']:""; ?>";

              /* code for multi city start */
              $scope.origin1 = "<?php echo isset($_REQUEST['from1'])?$_REQUEST['from1']:""; ?>";
              $scope.origin2 = "<?php echo isset($_REQUEST['from2'])?$_REQUEST['from2']:""; ?>";
              $scope.origin3 = "<?php echo isset($_REQUEST['from3'])?$_REQUEST['from3']:""; ?>";
              $scope.origin4 = "<?php echo isset($_REQUEST['from4'])?$_REQUEST['from4']:""; ?>";
              $scope.origin5 = "<?php echo isset($_REQUEST['from5'])?$_REQUEST['from5']:""; ?>";

              $scope.destination1 = "<?php echo isset($_REQUEST['to1'])?$_REQUEST['to1']:""; ?>";
              $scope.destination2 = "<?php echo isset($_REQUEST['to2'])?$_REQUEST['to2']:""; ?>";
              $scope.destination3 = "<?php echo isset($_REQUEST['to3'])?$_REQUEST['to3']:""; ?>";
              $scope.destination4 = "<?php echo isset($_REQUEST['to4'])?$_REQUEST['to4']:""; ?>";
              $scope.destination5 = "<?php echo isset($_REQUEST['to5'])?$_REQUEST['to5']:""; ?>";

              $scope.startml1 = "<?php echo isset($_REQUEST['startml1'])?$_REQUEST['startml1']:""; ?>";
              $scope.startml2 = "<?php echo isset($_REQUEST['startml2'])?$_REQUEST['startml2']:""; ?>";
              $scope.startml3 = "<?php echo isset($_REQUEST['startml3'])?$_REQUEST['startml3']:""; ?>";
              $scope.startml4 = "<?php echo isset($_REQUEST['startml4'])?$_REQUEST['startml4']:""; ?>";
              $scope.startml5 = "<?php echo isset($_REQUEST['startml5'])?$_REQUEST['startml5']:""; ?>";
              /* code for multi city ends */

              //sortbyval
              //limit
              <?php //print_r($_POST); die; ?>

                $scope.pageChangeHandler = function(num) {
                    console.log('meals page changed to ' + num);
                };

               $scope.filterFunc = function (data) {
                  console.log(data);
                  $scope.dataforamadeus = {};
                  $scope.outboundflightstops = data;
                  maskedfunc();
                  $scope.init();
                  console.log("----------i am navin-----------");
               };

               $scope.filterFuncTime = function(data){

                console.log(data);
                $scope.dataforamadeus = {};
                $scope.outbounddeparturewindow = data;
                maskedfunc();
                $scope.init();
                console.log("----------i am navin-----------");

               };

               $scope.filterFuncAirlines = function(data){

                console.log(data);
                $scope.dataforamadeus = {};
                $scope.includedcarriers = data;
                maskedfunc();
                $scope.init();
                console.log("----------i am navin-----------");

               };

               $scope.filterFuncLayover = function(data){

                console.log(data);
                $scope.dataforamadeus = {};
                $scope.inboundstopduration = data;
                maskedfunc();
                $scope.init();
                console.log("----------i am navin-----------");

               };

                $scope.sortFunc = function(data){

                console.log(data);
                $scope.dataforamadeus = {};
                $scope.sortbyval = data;
                maskedfunc();
                $scope.init();
                console.log("----------i am navin-----------");

               };

              $scope.init = function () {

                $scope.currentPage = 1;
                $scope.pageSize = 20;

                // check if there is query in url
                // and fire search in case its value is not empty
                var urltogetFlights = '<?php echo $urltoGetFilghts; ?>';
                var urltoGetFilghtsAlter = '<?php echo $urltoGetFilghtsAlter; ?>';
                var urltoGetFilghtsAlterAirport = '<?php echo $urltoGetFilghtsAlterAirport; ?>';
                var postData;
                 postData = {origin:$scope.origin,destination:$scope.destination,departureDate:$scope.departureDate,returndate:$scope.returnDate,lengthofstay:$scope.lengthofstay,limit:$scope.limit,outboundflightstops:$scope.outboundflightstops,outbounddeparturewindow:$scope.outbounddeparturewindow,includedcarriers:$scope.includedcarriers,inboundstopduration:$scope.inboundstopduration,adult:$scope.adult,children:$scope.children,infant:$scope.infant,pclass:$scope.pclass,sortbyval:$scope.sortbyval,origin1:$scope.origin1,destination1:$scope.destination1,departureDate1:$scope.startml1,origin2:$scope.origin2,destination2:$scope.destination2,departureDate2:$scope.startml2,origin3:$scope.origin3,destination3:$scope.destination3,departureDate3:$scope.startml3,origin4:$scope.origin4,destination4:$scope.destination4,departureDate4:$scope.startml4,origin5:$scope.origin5,destination5:$scope.destination5,departureDate5:$scope.startml5}; 
//return;
                console.log(postData);

                $scope.calljsfunction = function(Id){
                  console.log("Task Id is "+Id);
                  bookaflight(Id);
                  
                };

                $scope.mySplit = function(string, nb) {
                    var array = string.split('.');
                    return array[nb];
                }

                flightServiceNew.loadDataFromUrls(urltogetFlights,postData).then(function (datanew) {
                    maskedfuncoff();
                    $scope.totalnoofresultsfound = 0;
                   
                    if(datanew[0] != undefined && datanew[0].data != undefined && datanew[0].data.amadeusresult != undefined){
                      $scope.dataforamadeus = datanew[0].data.amadeusresult;
                      $scope.filterdate = datanew[0].data.filterdate;
                      
                      console.log($scope.dataforamadeus);
                    }
                   
                        
                    //Decision for no data found in amadeus and saber in insta flights and bargain max
                    var singlearrayofallapi = {};
                    $scope.hasanyresultfound = "no";
         
                    if($scope.dataforamadeus!=undefined && $scope.dataforamadeus.length != 0){  
                      $scope.hasanyresultfound = "yes";
                      $scope.totalnoofresultsfound = $scope.dataforamadeus.length;
                      //console.log($scope.DisplayDatainstantflights.length);
                    }

                    //$scope.$apply();
                    console.log("---------------------------------###------------------------------------------------");
                      
                }); //flight service ends here


                console.log(urltoGetFilghtsAlter+"--------urltoGetFilghtsAlter-------");
                /* alter flight search for dates start */
                flightServiceNewAlter.loadDataFromUrls(urltoGetFilghtsAlter,postData).then(function (datanew) {
                   
                   
                   
                    if(datanew[0] != undefined && datanew[0].data != undefined && datanew[0].data.amadeusresult != undefined){
                      $scope.dataforamadeusalter = datanew[0].data.amadeusresult;
                      $scope.filterdate = datanew[0].data.filterdate;
                      
                      console.log($scope.dataforamadeus);
                    }
                   
                });

                flightServiceNewAlterAirport.loadDataFromUrls(urltoGetFilghtsAlterAirport,postData).then(function (datanew) {
                   
                 
                   
                    if(datanew[0] != undefined && datanew[0].data != undefined && datanew[0].data.amadeusresult != undefined){
                      $scope.dataforamadeusalterairport = datanew[0].data.amadeusresult;
                      $scope.filterdate = datanew[0].data.filterdate;
                      
                      console.log("alternate airport");
                      console.log($scope.dataforamadeusalterairport);
                    }
                   
                });
                /* alter flight search for dates ends */

                /*urltogetFlights = urltogetFlights.replace("start_rest_workflow","start_rest_workflow_d")

           
                getFlightBmf.loadDataFromUrls(urltogetFlights,postData).then(function (datanew) {

                    if(datanew[0] != undefined && datanew[0].data != undefined && datanew[0].data.amadeusresult != undefined){
                      $scope.dataforamadeus = datanew[0].data.amadeusresult;
                      $scope.filterdate = datanew[0].data.filterdate;
                      
                      console.log($scope.dataforamadeus);
                    }

                });*/

                
                  
               
                  $scope.appState = true;

                
            }; //scope init function ends heres

          }]);//controller ends here

        </script>
        <script type="text/javascript">
            
            function runbargainfindersortout(){
              setTimeout(function(){
                  
                        var arrayofsaberbargain = [];
                        var arrayofsaberforcomparebargain = [];
                        var arrayofsaberforcomparewithindexbargain = [];
                        $.each($(".bargainfinderresult"), function(index, value) { 
                            var ele = $(this).children('div').children('div').children('div').children('.datahere');
                            var fare = ele.children('.saberfare').html();
                            
                            var stops = ele.children('.saberstops').html();
                            var departuretime = ele.children('.saberdepartturetime').html();
                            var airlines = ele.children('.saberairlines').html();
                            var layover = ele.children('.saberlayover').html();
                            var flightno = ele.children('.saberflightno').html();
                            var operatingairline = ele.children('.saberoperatinglinecode').html();
                            var flightnoreturn = "";
                            if($(this).find(".saberflightnoreturn").html()!=undefined){
                                flightnoreturn = $(this).find(".saberflightnoreturn").html();
                            }
                            
                            var operatingairlinereturn = "";
                            if($(this).find(".saberoperatinglinecodereturn").html() != undefined){
                                operatingairlinereturn = $(this).find(".saberoperatinglinecodereturn").html();
                            }
                            

                            var allarray = {stops:stops,departuretime:departuretime,airlines:airlines,layover:layover,flightno:flightno,operatingairline:operatingairline,index:index,fare:fare,flightnoreturn:flightnoreturn,operatingairlinereturn:operatingairlinereturn};

                            arrayofsaberforcomparebargain.push(allarray);
                            
                            var valtocompare = airlines+"-"+flightno+"-"+operatingairline+"-"+fare+"-"+flightnoreturn+"-"+operatingairlinereturn;
                            
                            arrayofsaberforcomparewithindexbargain.push(valtocompare);
                        });
 
                        console.log(arrayofsaberforcomparebargain);
                        console.log(arrayofsaberforcomparewithindexbargain);


              },2000);
            }

            function getYoutubeLikeToDisplay(millisec) {
                var seconds = (millisec / 1000).toFixed(0);
                var minutes = Math.floor(seconds / 60);
                var hours = "";
                if (minutes > 59) {
                    hours = Math.floor(minutes / 60);
                    hours = (hours >= 10) ? hours : "0" + hours;
                    minutes = minutes - (hours * 60);
                    minutes = (minutes >= 10) ? minutes : "0" + minutes;
                }

                seconds = Math.floor(seconds % 60);
                seconds = (seconds >= 10) ? seconds : "0" + seconds;
                if (hours != "") {
                    return hours + "h" + minutes + "m";
                }
                return minutes + "m" ;
            }


          
        </script>
        <form method="POST" id="idformforselect" class="formforselect" style="display:none;" action="<?php echo $_SESSION['urlforform']; ?>searchsale">
            <label>Data</label>
            <input class="saledata" name="saledata" value="" />
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
                    <label>Sort By</label>
                    <input name="sortbyval" class="cls_sortbyval"  value="<?php echo isset($_REQUEST['sortbyval'])?$_REQUEST['sortbyval']:""; ?>" />
                    <input name="origfrom" value="<?php if(!isset($_REQUEST['origfrom'])){ echo isset($_REQUEST['from'])?$_REQUEST['from']:""; } if(isset($_REQUEST['origfrom'])){ echo isset($_REQUEST['origfrom'])?$_REQUEST['origfrom']:""; }  ?>" />
                    <input name="origto" value="<?php if(!isset($_REQUEST['origto'])){ echo isset($_REQUEST['to'])?$_REQUEST['to']:""; } if(isset($_REQUEST['origto'])){ echo isset($_REQUEST['origto'])?$_REQUEST['origto']:""; }  ?>" />
                  </form>
                <?php
                }  

                 if(isset($_POST['rfrom']) && $_POST['rfrom'] != "" && isset($_POST['tfrom']) && $_POST['tfrom'] != "")
                {    ?>
                  <form method="POST" class="formforfilters" style="display:none;"  action="<?php echo $_SESSION['urlforform']; ?>searchresult">
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
                    <label>Sort By</label>
                    <input name="sortbyval" class="cls_sortbyval"  value="<?php echo isset($_REQUEST['sortbyval'])?$_REQUEST['sortbyval']:""; ?>" />
                    <input name="origfrom" value="<?php if(!isset($_REQUEST['origfrom'])){ echo isset($_REQUEST['from'])?$_REQUEST['from']:""; } if(isset($_REQUEST['origfrom'])){ echo isset($_REQUEST['origfrom'])?$_REQUEST['origfrom']:""; }  ?>" />
                    <input name="origto" value="<?php if(!isset($_REQUEST['origto'])){ echo isset($_REQUEST['to'])?$_REQUEST['to']:""; } if(isset($_REQUEST['origto'])){ echo isset($_REQUEST['origto'])?$_REQUEST['origto']:""; }  ?>" />

                  </form>
                <?php
                }  
             ?>   
              
              
        <script src="<?php echo $themeurl; ?>/js/controllers.js"></script>
       
    </div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>
