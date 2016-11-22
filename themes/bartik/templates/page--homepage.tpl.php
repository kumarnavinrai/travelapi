<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
$themeurl = file_create_url(path_to_theme());
global $base_url;
?>


<div class="top-area show-onload">
  <div class="bg-holder full">
    <div class="bg-mask"></div>
    <div class="bg-img" style="background:#000;"></div>
    <!-- <div class="bg-img" style="background-image:url(<?php echo $themeurl; ?>/img/196_365_2048x1365.jpg);"></div> -->
    <video class="bg-video hidden-sm hidden-xs" preload="auto" autoplay="true" loop="loop" muted="muted" poster="img/video-bg.jpg">
    <source src="<?php echo $themeurl; ?>/media/travelpainters-header-vid.mp4" type="video/mp4" />
    </video>
   
    <div class="bg-content">
      <div class="container">
        <div class="row">
          <?php if ($messages): ?>
              <div id="messages"><div class="section clearfix">
              
                <?php $source = explode("</div>", $messages); 
                      $messageofmailcame = "no";
                      foreach ($source as $key => $value) {
                        $source = str_replace('<p>', '&lt;p&gt;', $value);
                        $source = strip_tags($source);
                        if(strpos($source, "Unable to send e-mail. Contact the site administrator if the problem persists.") !== false)
                        {
                          $messageofmailcame = "yes";
                        }
                      }
                        
                     
                      if($messageofmailcame=='yes')
                      {
                       if($_SESSION['userregisteredmessage'] != "")
                       { 
                          echo '<div class="messages status"><i class="fa fa-check round box-icon-large box-icon-left mb30 box-icon-success"></i><h2 class="element-invisible">Success !!</h2>'.$_SESSION['userregisteredmessage'].'</div>'; $_SESSION['userregisteredmessage'] = ""; 
                       } 
                      }else{
                        echo $messages; 
                      }
                       ?>
                      
              </div></div> <!-- /.section, /#messages -->
          <?php endif; ?>  
          <!-- search form start -->    
          <?php  ?>  
          <?php 
            $pathoffile = realpath(__DIR__);
            //echo $pathoffile; die;
            require_once $pathoffile."/"."searchform.php";
          ?>
        <?php  ?>
        <!-- search form ends -->
        <div class="col-md-6">
          <div class="loc-info text-right text-right-sukh hidden-xs hidden-sm">
            <h3  style="padding: 20px; background-color: rgba(0, 0, 0, 0.6); text-align:center; color:#FFFFFF">
              <!--<img src="img/flags/32/fr.png" alt="Image Alternative text" title="Image Title" />Paris--><!-- <img src="
                <?php // echo $themeurl; ?>/img/travel-painters_logo_lastt-.png" /> -->FIND YOUR PERFECT TRIP
            </h3>
            <p style="padding: 0px 20px 9px 20px; margin: 0 !important; background-color: rgba(0, 0, 0, 0.6); text-align:center">Traveling - it leaves you speechless, then turns you into a storyteller. Everyone loves stories, and here at Flyoticket, we believe that at the end of the day the experiences you've had, the stories you've shared (and the ones you've yet to share) are some of the most important moments in life.</p>
             <img style="padding: 0px 20px 35px 20px; background-color: rgba(0, 0, 0, 0.6);" src="<?php echo $themeurl; ?>/img/united-states-flag.png" />
              <br />
              <br />
             <!--  <img src="
                <?php // echo $themeurl; ?>/img/travel-painters_logo_lastt-.png" /> -->
              </div>
            </div>
          </div>
        </div>
        <div class="gap"></div>
        <div class="row row-wrap sukh-row-bckr-opcty" data-gutter="60">
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header">
            <i class="fa fa-dollar box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
          </header>
          <div class="thumb-caption">
            <h5 class="thumb-title">
              <a class="text-darken clr-wht" href="#">BEST SELECTION</a>
            </h5>
            <p class="thumb-desc sukh-desc clr-wht">Find our lowest price to destinations worldwide, guaranteed</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header">
            <i class="fa fa-lock box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
          </header>
          <div class="thumb-caption">
            <h5 class="thumb-title">
              <a class="text-darken clr-wht" href="<?php echo $base_url; ?>/content/cancellationpolicy">CANCELLATION POLICY</a>
            </h5>
            <p class="thumb-desc sukh-desc clr-wht">Flyoticket offers Cancellation to its entire booking users.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header">
            <i class="fa fa-thumbs-o-up box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
          </header>
          <div class="thumb-caption">
            <h5 class="thumb-title">
              <a class="text-darken clr-wht" href="#">24/7 SUPPORT</a>
            </h5>
            <p class="thumb-desc sukh-desc clr-wht">Get award-winning service and special deals by calling <br>1-888-417-0446</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header">
            <i class="fa fa-calendar box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
          </header>
          <div class="thumb-caption">
            <h5 class="thumb-title">
              <a class="text-darken clr-wht" href="#">EASY BOOKING</a>
            </h5>
            <p class="thumb-desc sukh-desc clr-wht">Search, select and save - the fastest way to book your trip</p>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="gap gap-small"></div>  -->
  </div>
        <!-- <div class="col-md-12">
          <div class="gap"></div>
        </div> -->
      </div>
    </div>
  </div>
  <!-- END TOP AREA  -->
  <h3 class="text-center sukh-hdr-top">Recent Flight Detail</h3>
  <div class="bg-holder">
    <div class="bg-mask"></div>
    <!-- <div class="bg-parallax" style="background:#fff;"> </div> -->
    <div class="bg-parallax" style="background-image:url(<?php echo $themeurl; ?>/img/flgt-bck.jpg);"> </div> 
    <div class="bg-content">
    <div class="container">
      <div class="gap gap-big text-center text-white">
        <div class="col-md-4">
          <div class="loc-info text-right sukh-bckgrd-img" style="background-image:url(<?php echo $themeurl; ?>/img/flight-offer2.jpg);">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="hedr-text" colspan="2" bgcolor="#FFBB06">Today's Flight Deals*</th>
                </tr>
              </thead>
              <tbody>
                <tr class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Aruba </span></td>
                  <td>$ 305*</td>
                </tr>
                <tr  class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Panama City </span></td>
                  <td>$ 289*</td>
                </tr>
                <tr class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Aruba</span> </td>
                  <td>$ 305*</td>
                </tr>
                <tr  class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Melbourne</span></td>
                  <td>$ 901*</td>
                </tr>
                <tr  class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Panama City </span></td>
                  <td>$ 289*</td>
                </tr>
                <tr class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Aruba </span></td>
                  <td>$ 305*</td>
                </tr>
                <tr  class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Melbourne</span></td>
                  <td>$ 901*</td>
                </tr>
                <tr  class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Panama City </span></td>
                  <td>$ 289*</td>
                </tr>
                <tr class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Aruba </span></td>
                  <td>$ 305*</td>
                </tr>
                <tr  class="colr-text-sukh">
                  <td><span class="txt-skh">New York &rarr; Melbourne</span></td>
                  <td>$ 901*</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <div class="loc-info text-right sukh-bckgrd-img" style="background-image:url(<?php echo $themeurl; ?>/img/flight-offer1.jpg); height:431px;">
            <table class="table">
              <thead>
                <tr>
                  <th class="hedr-text" colspan="2" bgcolor="#FFBB06" >Featured Offers*</th>
                </tr>
              </thead>
              <tr>
                <td colspan="2" style="padding: 12em 6em;"><button class="btn btn-primary center">Plan your Trip</button></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <table class="table table-bordered" style="width: 100%;margin-bottom: 1px;margin-top: 47px;">
            <thead>
              <tr>
                <th class="hedr-text" colspan="2" bgcolor="#FFBB06">Today's Flight Deals*</th>
              </tr>
            </thead>
          </table>
          <figure style="display: block; background-image: url(<?php echo $themeurl;?>/img/last-minute-img.jpg);" class="deals-block__featured-img lazy" > </figure>
          <ul>
            <li class="deals-block__single-deal"> <a href="#"> <b class="sukh-b">Last Minute Flights </b><em class="icon arrow"></em> </a> </li>
            <li class="deals-block__single-deal"> <a href="#"> <b class="sukh-b">Domestic Flights</b><em class="icon ic-arw-r"></em> </a> </li>
            <li class="deals-block__single-deal"> <a href="#"> <b class="sukh-b">Round Trip Flights</b><em class="icon icons8-Arrow"></em> </a> </li>
            <li class="deals-block__single-deal"> <a href="#"> <b class="sukh-b">Flights Under $199</b><em class="icon ic-arw-r"></em> </a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

    
  </div>
  <div class="container">
<!--sukh new content -->
<div class="gap"></div>




	
  <h3 class="text-center">Top Destinations</h3>
  <div class="gap">
    <div class="row row-wrap">
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header"> <a class="hover-img curved" href="#"> <img src="<?php echo $themeurl; ?>/img/cuba_havana.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i> </a> </header>
          <div class="thumb-caption">
            <h4 class="thumb-title">Cuba</h4>
            <p class="thumb-desc">Want to book a holiday to Cuba? Whether you're off for a romantic holiday, family trip, or an all-inclusive holiday, Cuba holiday packages on We make planning your trip simple and affordable.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header"> <a class="hover-img curved" href="#"> <img src="<?php echo $themeurl; ?>/img/London_img.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park"><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i> </a> </header>
          <div class="thumb-caption">
            <h4 class="thumb-title">Europe</h4>
            <p class="thumb-desc">London is expensive and not as much a convenience culture as America (most black cabs do not take cards). Plan ahead to get the best deals, and book restaurants and theater tickets well in advance.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header"> <a class="hover-img curved" href="#"> <img src="<?php echo $themeurl; ?>/img/Dubai-img.jpg" alt="Image Alternative text" title="people on the beach"><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i> </a> </header>
          <div class="thumb-caption">
            <h4 class="thumb-title">Dubai</h4>
            <p class="thumb-desc">Your adventure begins with an exciting journey to the mysterious and magical desert, leaving behind the hustle bustle of the city.Once reached the desert.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header"> <a class="hover-img curved" href="#"> <img src="<?php echo $themeurl; ?>/img/rometravel_img.jpg" alt="Image Alternative text" title="lack of blue depresses me"><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i> </a> </header>
          <div class="thumb-caption">
            <h4 class="thumb-title">Rome</h4>
            <p class="thumb-desc">It was once considered the centre of the universe, when all roads lead there. Now the Italian capital is a living museum, with all the trimmings of a cosmopolitan city.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php /* ?>
<div id="page-wrapper"><div id="page">

  <div id="header" class="<?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>"><div class="section clearfix">

    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?>

    <?php if ($site_name || $site_slogan): ?>
      <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>

        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
              <strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong>
            </div>
          <?php else:  ?>
            <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>>
            <?php print $site_slogan; ?>
          </div>
        <?php endif; ?>

      </div> <!-- /#name-and-slogan -->
    <?php endif; ?>

    <?php print render($page['header']); ?>

    <?php if ($main_menu): ?>
      <div id="main-menu" class="navigation">
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => 'main-menu-links',
            'class' => array('links', 'clearfix'),
          ),
          'heading' => array(
            'text' => t('Main menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </div> <!-- /#main-menu -->
    <?php endif; ?>

    <?php if ($secondary_menu): ?>
      <div id="secondary-menu" class="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'id' => 'secondary-menu-links',
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => t('Secondary menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </div> <!-- /#secondary-menu -->
    <?php endif; ?>

  </div></div> <!-- /.section, /#header -->

  <?php if ($messages): ?>
    <div id="messages"><div class="section clearfix">
      <?php print $messages; ?>
    </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>

  <?php if ($page['featured']): ?>
    <div id="featured"><div class="section clearfix">
      <?php print render($page['featured']); ?>
    </div></div> <!-- /.section, /#featured -->
  <?php endif; ?>

  <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix">

    <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
    <?php endif; ?>

    <?php if ($page['sidebar_first']): ?>
      <div id="sidebar-first" class="column sidebar"><div class="section">
        <?php print render($page['sidebar_first']); ?>
      </div></div> <!-- /.section, /#sidebar-first -->
    <?php endif; ?>

    <div id="content" class="column"><div class="section">
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if ($tabs): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>

    </div></div> <!-- /.section, /#content -->

    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-second" class="column sidebar"><div class="section">
        <?php print render($page['sidebar_second']); ?>
      </div></div> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>

  </div></div> <!-- /#main, /#main-wrapper -->

  <?php if ($page['triptych_first'] || $page['triptych_middle'] || $page['triptych_last']): ?>
    <div id="triptych-wrapper"><div id="triptych" class="clearfix">
      <?php print render($page['triptych_first']); ?>
      <?php print render($page['triptych_middle']); ?>
      <?php print render($page['triptych_last']); ?>
    </div></div> <!-- /#triptych, /#triptych-wrapper -->
  <?php endif; ?>

  <div id="footer-wrapper"><div class="section">

    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
      <div id="footer-columns" class="clearfix">
        <?php print render($page['footer_firstcolumn']); ?>
        <?php print render($page['footer_secondcolumn']); ?>
        <?php print render($page['footer_thirdcolumn']); ?>
        <?php print render($page['footer_fourthcolumn']); ?>
      </div> <!-- /#footer-columns -->
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <div id="footer" class="clearfix">
        <?php print render($page['footer']); ?>
      </div> <!-- /#footer -->
    <?php endif; ?>

  </div></div> <!-- /.section, /#footer-wrapper -->

</div></div> <!-- /#page, /#page-wrapper -->
<?php */ ?>
<script type="text/javascript">
  $(document).ready(function(){
  
  
    		$('.rtripandowselectorow').on('click',function(e)
				{
					$('.tocity').hide();
					$('.fromcity').hide();
					$('.startdate').hide();
					$('.enddate').hide();
				});
				
			$('.rtripandowselectorrt').on('click',function(e)
				{
					$('.tocity').hide();
					$('.fromcity').hide();
					$('.startdate').hide();
					$('.enddate').hide();
				});

 
			
					
    $('.nav_search_for_flights').on('click',function(e){
     if ($('#flight-search-1').hasClass('active')){
	
		/* Added to handle and display the form so that user inputs all the required information to process successfully */
  
        
		if($("input[name=from]").val() == "" && $("input[name=to]").val() == "" && $("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
          $(".fromcity").fadeIn();
		  $(".tocity").fadeIn();
		  $(".startdate").fadeIn(); 
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=from]").val() == "" && $("input[name=to]").val() == "" && $("input[name=start]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
          $(".fromcity").fadeIn();
		  $(".tocity").fadeIn();
		  $(".startdate").fadeIn(); 	  
          e.preventDefault();
        }
		
		else if($("input[name=from]").val() == "" && $("input[name=to]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
          $(".fromcity").fadeIn();
		  $(".tocity").fadeIn();
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }

		else if($("input[name=from]").val() == "" && $("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
          $(".fromcity").fadeIn();
		  $(".startdate").fadeIn();
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }

		else if($("input[name=to]").val() == "" && $("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
          $(".tocity").fadeIn();
		  $(".startdate").fadeIn();
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }			
		
		else if($("input[name=from]").val() == "" && $("input[name=to]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		
          $(".fromcity").fadeIn();
		  $(".tocity").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".startdate").fadeIn();	
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=from]").val() == "" && $("input[name=start]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".fromcity").fadeIn();	
		  $(".startdate").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=from]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".fromcity").fadeIn();	
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=to]").val() == "" && $("input[name=start]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".tocity").fadeIn();	
		  $(".startdate").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=to]").val() == "" && $("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".tocity").fadeIn();	
		  $(".enddate").fadeIn();	  
          e.preventDefault();
        }
	
		else if($("input[name=from]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".fromcity").fadeIn();  
          e.preventDefault();
        }
		
		else if($("input[name=to]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".tocity").fadeIn();  
          e.preventDefault();
        }
		
		else if($("input[name=start]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".startdate").fadeIn();  
          e.preventDefault();
        }
		
		else if($("input[name=end]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".enddate").fadeIn();  
          e.preventDefault();
        }
 /* End here*/	
	
        $("input[name=rfrom]").val("");
        $("input[name=tfrom]").val("");
      }    

		
    if ($('#flight-search-2').hasClass('active')){
	  
	  		/* Added to handle and display the form so that user inputs all the required information to process successfully */
  
        
		if($("input[name=rfrom]").val() == "" && $("input[name=tfrom]").val() == "" && $("input[name=departing]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  
          $(".fromcity").fadeIn();
		  $(".tocity").fadeIn();
		  $(".startdate").fadeIn(); 	  
          e.preventDefault();
        }
				
		else if($("input[name=rfrom]").val() == "" && $("input[name=tfrom]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		
          $(".fromcity").fadeIn();
		  $(".tocity").fadeIn();	  
          e.preventDefault();
        }
		
		else if($("input[name=rfrom]").val() == "" && $("input[name=departing]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  
		  $(".fromcity").fadeIn();
		  $(".startdate").fadeIn();	
 
          e.preventDefault();
        }
		
		else if($("input[name=tfrom]").val() == "" && $("input[name=departing]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  
		  $(".tocity").fadeIn();	
		  $(".startdate").fadeIn();	  
          e.preventDefault();
        }
		
	
		else if($("input[name=rfrom]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".fromcity").fadeIn();  
          e.preventDefault();
        }
		
		else if($("input[name=tfrom]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".tocity").fadeIn();  
          e.preventDefault();
        }
		
		else if($("input[name=departing]").val() == "")
        {
		  $(".fromcity").hide();
		  $(".tocity").hide();
		  $(".startdate").hide(); 
		  $(".enddate").hide();
		  
		  $(".startdate").fadeIn();  
          e.preventDefault();
        }
		
 /* End here*/	
		

        $("input[name=from]").val("");
        $("input[name=to]").val("");
      }

       if ($('#flight-search-3').hasClass('active')){  
         
        console.log("this is working");
        var anytextboxempty = 'no';
        $('.mlrow').each(function (index, value) { 
          
          
          if($(this).is(":visible")===true)
          {
            
            //console.log('div' + index + ':' + $(this).attr('class')); 
            $(this).find('input:text').each(function() {
                //console.log($(this).attr('name'));
                if($(this).attr('name') !== undefined && $(this).val()==="")
                {
                  console.log('empty');
                  anytextboxempty = 'yes';
                  return false;
                }
            });

          }

        });
        if(anytextboxempty == 'yes')
        {
           //console.log(anytextboxempty);
           $('.mlrow').each(function (index, value) { 
              if($(this).is(":visible")===true)
              {
                var divthis = $(this);
                $(this).find('input:text').each(function() {
                    if($(this).attr('name') !== undefined && $(this).val()==="")
                    {
                      divthis.find('.isa_error').remove();
                      var phtml = '<div class="isa_error"> <i class="fa fa-times-circle"></i> Please fill From, To, and Departing .</div>';
                      divthis.prepend(phtml);
                      e.preventDefault(); 
                      return false;
                    }
                });
              }
            });
            
        }
        
       }
        
    });
  });
</script>