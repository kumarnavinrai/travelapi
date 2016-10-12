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

?>
<script type="text/javascript">
  $(document).ready(function(){
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
<!--<div ng-show="appState == undefined" class="spinner">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
</div> -->
<div class="container" ng-show="appState !== undefined" ng-model="appState" ng-cloak>
            <!-- search form start -->
            <?php ?>
            <?php 
              $pathoffile = realpath(__DIR__);
              //echo $pathoffile; die;
              require_once $pathoffile."\/"."searchformdialog.php"
            ?>
            <?php ?>
            <!-- search form ends -->
            <?php
            
                require_once realpath(__DIR__).'/../../../phpsaber/data/listofairport.php';
                require_once realpath(__DIR__).'/../../../phpsaber/data/listwithcode.php';

              

                if(isset($_POST['from']) && $_POST['from'] != "" && isset($_POST['to']) && $_POST['to'] != "")
                { 

                  $fromairportcode = explode("-",$_POST['from']);
                  $fromairportcode = reset($fromairportcode);
                  $fromairportcode = trim($fromairportcode);
                  
                  $toairportcode  = explode("-",$_POST['to']);
                  $toairportcode = reset($toairportcode);
                  $toairportcode = trim($toairportcode);

                 
                }  

            ?>


            <h3 class="booking-title"><span class="totalnoofresultsfound" ng-if="totalnoofresultsfound!='NaN'">{{totalnoofresultsfound}}</span> Flights from <?php if(!isset($_REQUEST['origfrom'])){ echo isset($_REQUEST['from'])?$_REQUEST['from']:""; echo isset($_REQUEST['rfrom'])?$_REQUEST['rfrom']:""; } if(isset($_REQUEST['origfrom'])){ echo isset($_REQUEST['origfrom'])?$_REQUEST['origfrom']:""; }  ?> to <?php if(!isset($_REQUEST['origto'])){ echo isset($_REQUEST['to'])?$_REQUEST['to']:""; echo isset($_REQUEST['tfrom'])?$_REQUEST['tfrom']:""; } if(isset($_REQUEST['origto'])){ echo isset($_REQUEST['origto'])?$_REQUEST['origto']:""; }  ?> for <?php  if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] ==""){ echo isset($_REQUEST['adult'])&&$_REQUEST['adult']?$_REQUEST['adult']:0; } ?><?php  if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] !=""){ echo isset($_REQUEST['adultow'])&&$_REQUEST['adultow']?$_REQUEST['adultow']:0; } ?> Adults , <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] == "" ){ echo isset($_REQUEST['children'])&&$_REQUEST['children']?$_REQUEST['children']:0; } ?><?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] != "" ){ echo isset($_REQUEST['childrenow'])&&$_REQUEST['childrenow']?$_REQUEST['childrenow']:0; } ?>  Children<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Change search</a></small></h3>

             <!-- pagination start -->
             <div class="row">
                    <div  class="col-xs-12 col-md-12 col-lg-12 text-center">
                      <h6 style="display: none;>Current Page: {{ currentPage }}</h6>
                      <label style="display: none;" for="search">Search:</label>
                      <input style="display: none;" ng-model="q" id="search" class="form-control" placeholder="Filter text">
                    </div>
                    <div style="display: none;" class="col-xs-4">
                      <label for="search">items per page:</label>
                      <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
                    </div>
              </div>      
              <!-- pagination ends -->
            <div class="row">
                <div class="col-md-3">
                    <aside class="booking-filters text-white">
                   
                        <h3>Filter By<!--:<button class="btn btn-primary fliter_apply">Apply</button>--></h3>
                        <ul class="list booking-filters-list">
                            <li class="checkboxesli">
                                <h5 class="booking-filters-title">Stops <small></small></h5>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_stops" type="checkbox" ng-click="filterFunc(0)" value="0" />Non-stop<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_stops" type="checkbox" ng-click="filterFunc(1)"  value="1" />1 Stop<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_stops" type="checkbox" ng-click="filterFunc(2)"  value="2" />2 Stops<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_stops" type="checkbox" ng-click="filterFunc(3)"  value="3" />3 Stops<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_stops" type="checkbox" ng-click="filterFunc(4)"  value="4" />4 Stops<span class="pull-right"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="departtimecheckboxes">
                                <h5 class="booking-filters-title">Departure Time</h5>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_dt" value="05001159" ng-click="filterFuncTime('05001159')" type="checkbox" />Morning (5:00a - 11:59a)</label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_dt" value="12001759" ng-click="filterFuncTime('12001759')" type="checkbox" />Afternoon (12:00p - 5:59p)</label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check checkbox_dt" value="18002359" ng-click="filterFuncTime('18002359')" type="checkbox" />Evening (6:00p - 11:59p)</label>
                                </div>
                            </li>
                            <!--<li>
                                <h5 class="booking-filters-title">Layover Time</h5>
                                <input type="text" id="price-slider">
                            </li>-->
                            <li class="liforairline">
                                <h5 class="booking-filters-title">Airlines <small></small></h5>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check cls_airline" type="checkbox" ng-click="filterFuncAirlines('VX')" value="VX" />Virgin America<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check cls_airline" type="checkbox" ng-click="filterFuncAirlines('DL')" value="DL" />Delta Air Lines<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check cls_airline" type="checkbox" ng-click="filterFuncAirlines('UA')" value="UA" />United Airlines<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check cls_airline" type="checkbox" ng-click="filterFuncAirlines('AA')" value="AA" />American Airlines<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check cls_airline" type="checkbox" ng-click="filterFuncAirlines('B6')" value="B6" />jetBlue Airways<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check cls_airline" type="checkbox" ng-click="filterFuncAirlines('AC')" value="AC" />Air Canada<span class="pull-right"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="layoverli">
                                <h5 class="booking-filters-title">Waiting Time <small></small></h5>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(1)" value="1" />1hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(2)" value="2" />2hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(3)" value="3" />3hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(4)" value="4" />4hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(5)" value="5" />5hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(6)" value="6" />6hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(7)" value="7" />7hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(8)" value="8" />8hr<span class="pull-right"></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check layoverchkbox" type="checkbox" ng-click="filterFuncLayover(9)" value="9" />9hr<span class="pull-right"></span>
                                    </label>
                                </div>
                            </li>
                            
                            
                        </ul>
                    </aside>
                </div>
        <div class="col-md-9">
  
          
          <div class="booking-item-container">
                                <div class="sukh_container">
                                    <div class="row">
                                        <div class="col-md-12 mtrx__wrapper main hidden-xs" style="display:none">
                                        <!--{{lpc}}-->
        <table id="mtrx_table" class="mtrx__table animation-fast" ng-if="lpcfound != false">
            <thead>
                <tr id="mtrxRow" class="mtrx__row">
                    <th id="_allFares" class="mtrx__show-all disabled" style="min-width: 126.286px;">
                        <a href="javascript:ClearAllFilters();">
                            <span>All Fares</span>
                        </a>
                    </th>

                        <th class="mtrx__cell is--airline" scope="col" style="min-width: 123.286px; max-width: 123.286px;" ng-repeat="xyz in lpc" >
                                <a href="" title="{{xyz.lowestfareairlinecode}}">
                                    <img class="air__logo"  src="<?php echo $themeurl; ?>/img/airlineslogo/{{xyz.lowestairlinecodelogo}}" alt="{{xyz.lowestfareairlinecode}}">
                                    <span class="air__title" ng-bind="xyz.lowestfareairlinecode" title="{{xyz.lowestfareairlinecode}}">{{xyz.lowestfareairlinecode}}</span>
                                        <i class="icon ic-flights-airlines hidden"></i>
                                </a>
                        </th>
                        
                       
                        
                        
                  </tr>
                    
          <tr class="mtrx__row">
                        <th id="tr_6" class="mtrx__cell-header" scope="row" style="min-width: 126.286px;">
                            <a title="1+ stop flights" href="">
                                <span>Non Stops</span>
                            </a>
                        </th>

                            <td class="mtrx__cell" id="td_NKFalseFalse6" style="min-width: 123.286px; max-width: 123.286px;" ng-repeat="xyz in lpc" >
                                <span id="alternettrack_6" title="False"></span>
                                <a href="" class="mtrx__price">
                                        <span class="base-price">
                                            <span class="currency" >
                                              ${{xyz.lowestfareairlinefare}}
                                            </span>
                                            <span class="fpSuper">
                                              <sup>.{{xyz.lowestfareairlinefaresup}}</sup>
                                            </span>
                                        </span>
                                        <em title="Full price incl. taxes and fees" class="total-price">
                                          <span>Total</span>
                                            <b class="currency" title="{{xyz.lowestfareairlinefare}}" defaultvalue="{{xyz.lowestfareairlinefare}}">
                                              ${{xyz.lowestfareairlinefare}}
                                            </b>
                                            <span class="fpSuper" title="{{xyz.lowestfareairlinefare}}" defaultvalue="{{xyz.lowestfareairlinefare}}">
                                              <sup>.{{xyz.lowestfareairlinefaresup}}</sup>
                                            </span>
                                        </em>
                                    </a>
                            </td>
            </tr>
            </tbody>
        </table>
    <div class="row sukh_p">
      <div class="container">
    <p>Fares for our carriers are round trip, incl. all taxes and all fees. Airfares include applied Booking Bonus. Additional baggage fees may apply. Some flights displayed may be for alternate dates and/or airports. Certain results may be outside your search criteria.</p>
    </div></div>
                                        </div>
                  </div>
                </div>
          </div>
                      <!-- pagination start -->
                      <div ng-controller="OtherController" class="other-controller">
                        <!--<small>this is in "OtherController"</small>-->
                        <div class="text-center">
                        <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo $themeurl; ?>/templates/dirPagination.tpl.html"></dir-pagination-controls>
                        </div>
                      </div>
                      <!-- pagination ends -->
                           
                    <div class="nav-drop booking-sort">
                        <h5 class="booking-sort-title"><a href="#">Sort by Price, Stops, Waiting Time <i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a></h5>
                        <ul class="nav-drop-menu">
                            <li><a class="high-to-low-price sortingcls" href="#">Price (high to low)</a>
                            </li>
                            <li><a class="low-to-high-price sortingcls" href="#">Price (low to high)</a>
                            </li>
                            <li><a class="waiting-duration-up sortingcls" href="#">Waiting Duration up</a>
                            </li>
                            <li><a class="waiting-duration-dn sortingcls" href="#">Waiting Duration dn</a>
                            </li>
                            <li><a class="noofstopsasc sortingcls" href="#">Stops Asc</a>
                            </li>
                            <li><a class="noofstopsdecs sortingcls" href="#">Stops Desc</a>
                            </li>
                           
                        </ul>
                        <?php
                          $showifsorteddatamsg = array();
                          $showifsorteddatamsg["high-to-low-price"] = "Flights are sorted from High to Low Price.";
                          $showifsorteddatamsg["low-to-high-price"] = "Flights are sorted from Low to High Price.";
                          $showifsorteddatamsg["waiting-duration-up"] = "Flights are sorted By max Waiting time in a trip from low to high waiting time.";
                          $showifsorteddatamsg["waiting-duration-dn"] = "Flights are sorted By max Waiting time in a trip from high to low waiting time.";
                          $showifsorteddatamsg["noofstopsasc"] = "Flights are sorted By max number of stops in a trip from low to high.";
                          $showifsorteddatamsg["noofstopsdecs"] = "Flights are sorted By max number of stops in a trip from high to low.";
                        ?>
                        <h5 class="booking-sort-title"><?php if(isset($_REQUEST["sortbyval"])){ echo $showifsorteddatamsg[$_REQUEST["sortbyval"]]; } ?></h5>

                    </div>
                    <ul ng-if="hasanyresultfound == 'no'">
                      <li class="sukh_list">
                        <img src="<?php echo $themeurl; ?>/img/tp.png" alt="Travel Painters" >
                       </li>
                      <li class="sukh_list">        
                          <h1 align="center"> OOPS !!!</h1>
                      </li>
                      <li class="sukh_list">      
                        <h2 align="center">There are no flights found for your entered search criteria please change the origin or destination and search again.</h2>
                        
                      </li>
                      <li class="sukh_list" style="text-align: center;" >      
                         <a href="<?php global $base_url; echo $base_url; ?>"><button class="btn btn-primary btn-lg mt5 btn-sukh">Search Again</button></a>
                      </li>
                      
                    </ul>

                    <ul class="booking-list allresult">
                   
                    <!-- Amadeus search serch start -->
                    <h1 style="display:none;">Amadeus</h1>
                                       <!-- new design start -->
                    <li class="amadeusresult" dir-paginate="xy in dataforamadeus | filter:q | itemsPerPage: pageSize" current-page="currentPage">
                    <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] == ""){ ?>
                    <span ng-init="xy.adult=<?php echo isset($_REQUEST['adult'])&&$_REQUEST['adult']?$_REQUEST['adult']:0; ?>"></span>
                    <?php } ?>
                    <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] != ""){ ?>
                    <span ng-init="xy.adult=<?php echo isset($_REQUEST['adultow'])&&$_REQUEST['adult']?$_REQUEST['adultow']:0; ?>"></span>
                    <?php } ?>
                    <div class="booking-item-container">
                      <div class="booking-item">
                        <span whoami="{{xy.whoami}}" style="display:none;" >{{xy}}</span>
                        <!-- Repeat this row for showing no of flights from des for no of stops -->
                        <div class="container-sukh" ng-repeat="x in xy.inoutflightarr" >
                            <div class="row price_row" ng-if="x.counterfornoofflights==1" >
                            
                              <div class="col-md-5 col-sm-12 col-xs-12">
                                <a class="btn btn-primary btn-lg btn_sukh clsselectedbycustomer" ng-if="x.counterfornoofflights==1"  onclick="bookme(this)" >Select</a>  
                              </div>
                              <div class="col-md-7 col-sm-12 col-xs-12 text-algn-sukh-right">
                                <h4 style="color:#fff;padding:10px;">
                                  ${{xy.totalbeforetax}}<small>(Base Price)+ </small>${{xy.totaltax}}<small>(taxes)</small>= ${{xy.totalfare}}<small>(Total)</small>
                                </h4>
                              </div>
                            </div>
                          
                              <div class="row">
                                <div class="col-md-2">
                                  <div class="booking-item-airline-logo">
                                    <img  src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoofmarketingairline}}" alt="{{x.marketingairlinefullname}}" title="{{x.marketingairlinefullname}}" />
                                    <p >{{x.marketingairlinefullname}}</p>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="booking-item-flight-details">
                                      <div class="booking-item-departure">
                                        <i class="fa fa-plane"></i>
                                        <span class="nav_time">{{x.departtime | amDateFormat:'ddd, MMM D , h:mm a'}}</span>
                                        <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                        <p class="booking-item-destination nav_time">{{x.departureairportfullname}}</p>
                                      </div>
                                      <div class="booking-item-arrival">
                                        <i class="fa fa-plane fa-flip-vertical"></i>
                                        <span class="nav_time">{{x.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</span>
                                        <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                        <p class="booking-item-destination nav_time">{{x.destinationairportfullname}}</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                     <h5 >Flight No.{{x.flightno}}</h5>
                                     <p >{{x.stopornonstop}}</p>
                                  </div>
                                  <div class="col-md-2">
                                    <span class="booking-item-price">Class: {{x.travelclass}}</span>
                                    <p class="booking-item-flight-class" ng-if="x.layovertime!=0" >Waiting Time: {{x.layovertime}}</p>
                                  </div>
                                </div>
                                <hr>
                                </div><!-- sukh container -->
                            </div><!-- booking item -->
                          </div><!-- booking item container -->
                        </li>

                  <!-- new design ends -->
                  <?php /* ?>
                     <li class="amadeusresult" dir-paginate="xy in dataforamadeus | filter:q | itemsPerPage: pageSize" current-page="currentPage">
                   
                    <!--<li class="amadeusresult"  ng-repeat="xy in dataforamadeus" >-->
                        <!--<h4>{{x.TotalFlightTime}}</h4>-->
                        <!--<h4>{{x.AllFlightsdataInOneOption}}</h4>-->
                        
                        <!--<h4>{{xy}}</h4>-->
                        <!--<h4>{{xy.insideflightdata}}</h4>-->
                          <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] == ""){ ?>
                          <span ng-init="xy.adult=<?php echo isset($_REQUEST['adult'])&&$_REQUEST['adult']?$_REQUEST['adult']:0; ?>"></span>
                          <?php } ?>
                          <?php if(isset($_REQUEST['rfrom']) && $_REQUEST['rfrom'] != ""){ ?>
                          <span ng-init="xy.adult=<?php echo isset($_REQUEST['adultow'])&&$_REQUEST['adult']?$_REQUEST['adultow']:0; ?>"></span>
                          <?php } ?>
                          
                           <div class="booking-item-container" >
                                <div class="booking-item">
                                <span whoami="{{xy.whoami}}" style="display:none;" >{{xy}}</span>
                                <!-- Repeat this row for showing no of flights from des for no of stops -->
                                    <div class="row"  ng-repeat="x in xy.inoutflightarr" >
                                    
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img  src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoofmarketingairline}}" alt="{{x.marketingairlinefullname}}" title="{{x.marketingairlinefullname}}" />
                                                <p >{{x.marketingairlinefullname}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5" >
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{x.departtime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{x.departureairportfullname}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{x.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{x.destinationairportfullname}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-md-2">
                                            <h5 >Flight No.{{x.flightno}}</h5>
                                            <p >{{x.stopornonstop}}</p>
                                        </div>
                                        <div class="col-md-3" >
                                         
                                        <span class="booking-item-price" ng-if="x.counterfornoofflights==1" >${{xy.totalfare}}</span><span class="booking-item-flight-class" ng-if="x.counterfornoofflights==1">${{xy.totaltax}}(Tax)+${{xy.totalbeforetax}}(Fare)=${{xy.totalfare}}</span>
                                            <p class="booking-item-flight-class layoverpaddingclass" ng-if="x.layovertime!=0" >Layover Time: {{x.layovertime}}</p>
                                            <p class="booking-item-flight-class" >Class: {{x.travelclass}}</p>
                                        <a class="btn btn-primary clsselectedbycustomer" ng-if="x.counterfornoofflights==xy.totalflightcounter"  onclick="bookme(this)" >Select</a>     
                                        </div>

                                        <!-- row rpeate first step ends here -->  
                                    <div class="col-md-12 connectingflight" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img ng-if="donotshowthis !== undefined" src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p ng-if="donotshowthis !== undefined">{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->  
                                    </div>
                                  <!-- main loop row ends here -->

                                <!-- Repeat this row for showing no of flights from des for no of stops -->
                                    <div class="row amadeusrtn"  ng-repeat="x in xy.insideflightdatainbound" >
                                    <span class="amadeusoperatinglinecodereturn" style="display:none;">{{x.operatinglinecode}}</span>
                                      <span class="amadeusflightnoreturn" style="display:none;">{{x.flightno}}</span>

                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img ng-if="x.counterfornoofflightsinflights==0" src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.marketingairlinecode}}.png" alt="{{x.marketingairline}}" title="{{x.marketingairline}}" />
                                                <p ng-if="x.counterfornoofflightsinflights==0">{{x.marketingairline}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5" >
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{x.departs_at | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{x.originairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{x.arrives_at | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{x.destinationairport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-md-2">
                                            <h5 >Flight No.{{x.flightno}}</h5>
                                            <p ng-if="x.counterfornoofflightsinflights==0">{{x.nonstopofstop}}</p>
                                        </div>
                                        <div class="col-md-3" ><span class="booking-item-price" ng-if="x.returnorarrvial == 0" >${{xy.totalfareInUsd}}</span><span ng-if="x.counterfornoofflightsinflights==0">/person</span>
                                            <p class="booking-item-flight-class" ng-if="x.counterfornoofflightsinflights==0" >Layover Time: {{x.layovertime}}</p>
                                            <p class="booking-item-flight-class" ng-if="x.counterfornoofflightsinflights==0" >Class: {{x.booking_info.travel_class}}</p>
                                            <a class="btn btn-primary clsselectedbycustomer" ng-if="x.returnorarrvial == 1" ng-click="calljsfunction(xy.noofrest)" onclick="bookme(this)" >Select</a>
                                        </div>

                                        <!-- row rpeate first step ends here -->  
                                    <div class="col-md-12 connectingflight" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img ng-if="donotshowthis !== undefined" src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p ng-if="donotshowthis !== undefined">{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->  
                                    </div>
                                  <!-- main loop row ends here -->
                                  <!-- row rpeate first step ends here -->  
                                    <div class="row" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p>{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->      
                                </div>
                                <!-- booking item ends here -->
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> 
                        <?php */ ?>
                        <div ng-controller="OtherController" class="other-controller">
                          <!--<small>this is in "OtherController"</small>-->
                          <div class="text-center">
                          <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo $themeurl; ?>/templates/dirPagination.tpl.html"></dir-pagination-controls>
                          </div>
                        </div>
                          
                        <!-- Amadeus search ends -->
                        <h1 style="display:none;">Saber</h1>
                        <!-- Instant flight search start -->
                         <li class="saberresult" style="display:none;" ng-repeat="xy in DisplayDatainstantflights track by $index" ng-if="xy.logoOfmarketingAirine !== undefined">
                        <!--<h4>{{x.TotalFlightTime}}</h4>-->
                        <!--<h4>{{x.AllFlightsdataInOneOption}}</h4>-->
                      
                        <!--<h4>{{x}}</h4>-->
                           <div class="booking-item-container" >
                                <div class="booking-item">
                                <span class="{{xy.noofrest}}" style="display:none;" >{{xy}}</span>
                                <!-- Repeat this row for showing no of flights from des for no of stops -->
                                    <div class="row"  ng-repeat="x in xy.datatoshownew" ng-init="parentIndex = $index" >
                                    
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p>{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <span ng-repeat="y in x.AllFlightsdataInOneOption">
                                        <div class="col-md-5 datahere"  ng-if="y.flightSeq == 0">
                                        <span class="saberfare" style="display:none;">{{xy.totalfareInUsd}}</span>
                                        <span class="saberstops" style="display:none;">{{x.nonStopOrwithStop}}</span>
                                        <span class="saberdepartturetime" style="display:none;">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</span>
                                        <span class="saberairlines" style="display:none;">{{x.MarketingAirlineCode}}</span>
                                        <span class="saberlayover" style="display:none;">{{x.LayoverTime}}</span>
                                        <span class="saberflightno" style="display:none;">{{y.oafn}}</span>
                                        <span class="saberoperatinglinecode" style="display:none;">{{x.OperatingAirlineCode}}</span>
                                        <span class="saberflightnoreturn" ng-if="parentIndex == 1" style="display:none;">{{y.oafn}}</span>
                                        <span class="saberoperatinglinecodereturn" ng-if="parentIndex == 1" style="display:none;">{{x.OperatingAirlineCode}}</span>
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-2">
                                            <h5 ng-if="y.flightSeq == 0">Flight No.{{y.oafn}}</h5>
                                            <p ng-if="y.flightSeq == 0">{{x.nonStopOrwithStop}}</p>
                                        </div>
                                        </span>
                                        <div class="col-md-3"><span class="booking-item-price" ng-if="x.returnorarrvial == 0" >${{xy.totalfareInUsd}}</span><span>/person</span>
                                            <p class="booking-item-flight-class" ng-if="x.LayoverTime !== '0m'">Layover Time: {{x.LayoverTime}}</p>
                                            <p class="booking-item-flight-class">Class: {{x.searchedClass}}</p>
                                            <a class="btn btn-primary clsselectedbycustomer" ng-if="x.returnorarrvial == 0" ng-click="calljsfunction(xy.noofrest)" onclick="bookme(this)" >Select</a>
                                        </div>

                                        <!-- row rpeate first step ends here -->  
                                    <div class="col-md-12 connectingflight" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img ng-if="donotshowthis !== undefined" src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p ng-if="donotshowthis !== undefined">{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" ng-if="y.flightSeq >= 1">
                                            <h5>Flight No.{{y.oafn}}</h5>
                                            
                                        </div>
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->  
                                    </div>
                                  <!-- main loop row ends here -->
                                  <!-- row rpeate first step ends here -->  
                                    <div class="row" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p>{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->      
                                </div>
                                <!-- booking item ends here -->
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> 
                        <!-- Instant flight search ends -->
                        
                        <li style="display:none;" ><h1>Bargain Finder </h1></li>
                        <!-- Bargain max finder start -->
                        <li  class="bargainfinderresult" ng-repeat="xy in DisplayData" ng-if="xy.logoOfmarketingAirine !== undefined">
                        <!--<h4>{{x.TotalFlightTime}}</h4>-->
                        <!--<h4>{{x.AllFlightsdataInOneOption}}</h4>-->
                        

                        <!--<h4>{{xy.datatoshownew}}</h4>-->
                            <div class="booking-item-container" >
                                <div class="booking-item">
                                <span class="{{xy.noofrest}}" style="display:none;" >{{xy}}</span>
                                <!-- Repeat this row for showing no of flights from des for no of stops -->
                                    <div class="row"  ng-repeat="x in xy.datatoshownew" ng-init="parentIndex = $index" >
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p>{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 datahere" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq == 0">
                                        <span class="saberfare" style="display:none;">{{xy.totalfareInUsd}}</span>
                                        <span class="saberstops" style="display:none;">{{x.nonStopOrwithStop}}</span>
                                        <span class="saberdepartturetime" style="display:none;">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</span>
                                        <span class="saberairlines" style="display:none;">{{y.MarketingAirline}}</span>
                                        <span class="saberlayover" style="display:none;">{{x.LayoverTime}}</span>
                                        <span class="saberflightno" style="display:none;">{{y.FlightNumber}}</span>
                                        <span class="saberoperatinglinecode" style="display:none;">{{y.OperatingAirline.Code}}</span>

                                        <span class="saberflightnoreturn" ng-if="parentIndex == 1" style="display:none;">{{y.oafn}}</span>

                                        <span class="saberoperatinglinecodereturn" ng-if="parentIndex == 1" style="display:none;">{{x.OperatingAirlineCode}}</span>

                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5></h5>
                                            <p>{{x.nonStopOrwithStop}}</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price" ng-if="x.returnorarrvial == 0" >${{xy.totalfareInUsd}}</span><span>/person</span>
                                            <p class="booking-item-flight-class" ng-if="x.LayoverTime !== '0m'">Layover Time: {{x.LayoverTime}}</p>
                                            <p class="booking-item-flight-class">Class: {{x.searchedClass}}</p>
                                            <a class="btn btn-primary clsselectedbycustomer" ng-if="x.returnorarrvial == 0" ng-click="calljsfunction(xy.noofrest)" onclick="bookme(this)" >Select</a>
                                        </div>

                                        <!-- row rpeate first step ends here -->  
                                    <div class="col-md-12 connectingflight" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img ng-if="donotshowthis !== undefined" src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p ng-if="donotshowthis !== undefined">{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->  
                                    </div>
                                  <!-- main loop row ends here -->
                                  <!-- row rpeate first step ends here -->  
                                    <div class="row" ng-repeat="y in x.AllFlightsdataInOneOption" ng-if="y.flightSeq >= 1">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/{{x.logoOfmarketingAirine}}" alt="{{x.logoOfmarketingAirine}}" title="{{x.logoOfmarketingAirine}}" />
                                                <p>{{x.nameOfmarketingAirine}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">{{y.departuretime | amDateFormat:'ddd, MMM D , h:mm a'}}</p>-->
                                                    <p class="booking-item-destination">{{y.departureairport}}</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>{{y.arrivaltime | amDateFormat:'ddd, MMM D , h:mm a'}}</h5>
                                                    <!--<p class="booking-item-date">Sat, Mar 23</p>-->
                                                    <p class="booking-item-destination">{{y.arrivalaiport}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <!-- row rpeate last step ends here step ends here -->      
                                </div>
                                <!-- booking item ends here -->
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- booking container enda here -->
                        </li>
                        <!-- Bargain max finder ends -->
                        <!--
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/lufthansa.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Lufthansa</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>2 stops</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$486</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airfrance.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Airfrance</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>non-stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$474</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/lufthansa.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Lufthansa</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>1 stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$195</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: First</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/american-airlines.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>American Airlines</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>non-stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$317</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: First</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/american-airlines.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>American Airlines</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>non-stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$291</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Economy</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/airfrance.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Airfrance</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>2 stops</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$278</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/aircanada.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Air Canada</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>non-stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$392</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/delta.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Delta</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>1 stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$161</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/american-airlines.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>American Airlines</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>non-stop</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$219</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: Economy</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <img src="<?php echo $themeurl; ?>/img/croatia.jpg" alt="Image Alternative text" title="Image Title" />
                                                <p>Croatia Airlines</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5>10:25 PM</h5>
                                                    <p class="booking-item-date">Sun, Mar 22</p>
                                                    <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5>12:25 PM</h5>
                                                    <p class="booking-item-date">Sat, Mar 23</p>
                                                    <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>22h 50m</h5>
                                            <p>2 stops</p>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price">$447</span><span>/person</span>
                                            <p class="booking-item-flight-class">Class: First</p><a class="btn btn-primary" href="#">Select</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-item-details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Flight Details</p>
                                            <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                            <ul class="list">
                                                <li>US Airways 731</li>
                                                <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                                <li>Depart 09:55 Arrive 15:10</li>
                                                <li>Duration: 9h 15m</li>
                                            </ul>
                                            <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                            <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                            <ul class="list">
                                                <li>US Airways 1873</li>
                                                <li>Economy / Coach Class ( M), Airbus A321</li>
                                                <li>Depart 22:11 Arrive 23:53</li>
                                                <li>Duration: 1h 42m</li>
                                            </ul>
                                            <p>Total trip time: 17h 58m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>-->
                    </ul>
                    
                </div>
            </div>
            <div class="gap"></div>
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
        
    });
  });
</script>