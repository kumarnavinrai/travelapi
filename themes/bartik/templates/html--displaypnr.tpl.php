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
  $pathoffile = realpath(__DIR__);
  //echo $pathoffile; die;
  require_once $pathoffile."/"."serverconfig.php";


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
  <?php 
        $pathoffile = realpath(__DIR__);
        //echo $pathoffile; die;
        require_once $pathoffile."/common/"."titleandcssincludes.php"
   ?>
   
  <?php /* print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; */?>
  <script type="text/javascript">
    <?php if(strpos($base_url, "flyoticket.com"))
          { ?>
      //var urlforapi = "http://127.0.0.1:1337/";
      var urlforapi = "http://104.168.102.222:1337/";
    <?php } ?>  
    <?php if(strpos($base_url, "travelpainters.local"))
          { ?>
      var urlforapi = "http://127.0.0.1:1337/";
      //var urlforapi = "http://104.168.102.222:1337/";
    <?php } ?>  
  </script>
  <style type="text/css">
    .form-type-password .description a{ display: none; }
   
  </style>
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
        <script src="<?php echo $themeurl; ?>/js/slimmenu.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo $themeurl; ?>/js/bootstrap-timepicker.js"></script>
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
        
        <script src="<?php echo $themeurl; ?>/js/switcher.js"></script>
          <script src="<?php echo $themeurl; ?>/js/moment.min.js"></script>
        <script src="<?php echo $themeurl; ?>/js/angular-moment.min.js"></script>

                <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script src="<?php echo $themeurl; ?>/js/custom.js"></script>
        <script>
          $(document).ready(function(){
            $("#workflow-form").submit(function(event) { 
              var over = '<div id="overlay">' +
                      '<img id="loading" src="http://www.swellalerts.com/img/plane_loading.gif"/>' +
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

</body>
</html>
