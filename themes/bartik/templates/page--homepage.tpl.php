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
        
<div class="top-area show-onload">
  <div class="bg-holder full">
    <div class="bg-mask"></div>
    <div class="bg-parallax" style="background-image:url(
      <?php echo $themeurl; ?>/img/196_365_2048x1365.jpg);">
    </div>
    <div class="bg-content">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="search-tabs search-tabs-bg mt50">
              <h1>Find Your Perfect Trip</h1>
              <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                    <a href="#tab-2" data-toggle="tab">
                      <i class="fa fa-plane"></i>
                      <span >Flights</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab-1" data-toggle="tab">
                      <i class="fa fa-building-o"></i>
                      <span >Hotels</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab-3" data-toggle="tab">
                      <i class="fa fa-home"></i>
                      <span >Insurance</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab-4" data-toggle="tab">
                      <i class="fa fa-car"></i>
                      <span >Cars</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab-5" data-toggle="tab">
                      <i class="fa fa-bolt"></i>
                      <span >Activities</span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab-2">
                    <h2>Search for Cheap Flights</h2>
                    <form method="POST" action="<?php echo $_SESSION['urlforform']; ?>searchresult">
                      <div class="tabbable">
                        <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                          <li class="active">
                            <a href="#flight-search-1" class="rtripandowselectorrt" data-toggle="tab">Round Trip</a>
                          </li>
                          <li>
                            <a href="#flight-search-2" class="rtripandowselectorow" data-toggle="tab">One Way</a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="flight-search-1">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-group form-group-lg form-group-icon-left">
                                  <i class="fa fa-map-marker input-icon"></i>
                                  <label>From</label>
                                  <input class="typeahead form-control nav_from" name="from" placeholder="City, Airport" type="text" />
                                </div>
                              </div>
                              <div class="col-md-2 imgdiv">
                                <span class="imgplaces">
                                  <img class="arw" src="<?php echo $themeurl; ?>/img/arrow.png" />
                                </span>  
                              </div>
                              <div class="col-md-5">
                                <div class="form-group form-group-lg form-group-icon-left">
                                  <i class="fa fa-map-marker input-icon"></i>
                                  <label>To</label>
                                  <input class="typeahead form-control nav_to" name="to" placeholder="City, Airport" type="text" />
                                </div>
                              </div>
                            </div>
                            <div class="input-daterange" data-date-format="M d, D">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                    <label>Departing</label>
                                    <input class="form-control" name="start" type="text" />
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                    <label>Returning</label>
                                    <input class="form-control" name="end" type="text" />
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group form-group-lg">
                                    <label>Adults(+18)</label>
                                    <select name="adult" class="form-control" >
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="3">4</option>
                                      <option value="3">5</option>
                                      <option value="3">6</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group form-group-lg form-group-select-plus">
                                    <label>Childs(0-17)</label>
                                    <select name="children" class="form-control" >
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="3">4</option>
                                      <option value="3">5</option>
                                      <option value="3">6</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <script type="text/javascript"> 
                                 $(document).ready(function() {
                                     $('#attach_box').click(function(e) {
                                         e.preventDefault();   
                                         $('#sukh_buton').toggle();
                                     });
                                     $('.rtripandowselectorrt').on('click',function(){
                                        $('#attach_box').show();
                                     }); 
                                     $('.rtripandowselectorow').on('click',function(){
                                        $('#attach_box').hide();
                                     });        
                                 });
                              </script>
                              <a href="#" id="attach_box">Advance Search
                                <i class="fa fa-sort-desc sukh" aria-hidden="true"></i>
                              </a>
                              <br />
                              <br />
                            </div>
                            <div id="sukh_buton" class="col-md-4" style="display:none;">
                              <div class="form-group form-group-lg form-group-icon-left ">
                                <i class="fa fa-plane input-icon input-icon-highlight"></i>
                                <label>Class</label>
                                <select name="pclass" class="form-control" >
                                  <option value="economy" class="su_option">Economy
                                  </p>
                                </option>
                                <option value="premiumeco">premium Economy</option>
                                <option value="business">Business</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="flight-search-2">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-map-marker input-icon"></i>
                                <label>From</label>
                                <input class="typeahead form-control" name="rfrom" placeholder="City, Airport, U.S. Zip" type="text" />
                              </div>
                            </div>
                            <div class="col-md-2 imgdiv">
                                <span class="imgplacesow">
                                  <img class="arw" src="<?php echo $themeurl; ?>/img/arrow.png" />
                                </span>  
                              </div>
                            <div class="col-md-5">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-map-marker input-icon"></i>
                                <label>To</label>
                                <input class="typeahead form-control" name="tfrom" placeholder="City, Airport, U.S. Zip" type="text" />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                <label>Departing</label>
                                <input class="date-pick form-control" name="departing" data-date-format="M d, D" type="text" />
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-plane input-icon input-icon-highlight"></i>
                                <label>Class</label>
                                <select name="rclass" class="form-control" >
                                  <option value="economy">Economy</option>
                                  <option value="premiumeco">Premium Economy</option>
                                  <option value="business">Business</option>
                                </select>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group form-group-lg">
                                  <div class="widthofowsel col-md-6">  
                                    <label>Adults(+18)</label>
                                    <select name="adultow" class="form-control">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="3">4</option>
                                      <option value="3">5</option>
                                      <option value="3">6</option>
                                    </select>
                                  </div>
                                  <div class="widthofowsel col-md-6">  
                                    <label>Childs(0-17)</label>
                                    <select name="childrenow" class="form-control widthofowsel">
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="3">4</option>
                                      <option value="3">5</option>
                                      <option value="3">6</option>
                                    </select>
                                  </div>  

                                  </div>
                              </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-lg nav_search_for_flights" type="submit">Search for Flights</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="tab-1">
                  <h2>Search and Save on Hotels</h2>
                  <form method="POST" action="http://travelpainters.local/searchresult">
                    <div class="form-group form-group-lg form-group-icon-left">
                      <i class="fa fa-map-marker input-icon"></i>
                      <label>Where are you going?</label>
                      <input class="typeahead form-control" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" />
                    </div>
                    <div class="input-daterange" data-date-format="M d, D">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <label>Check-in</label>
                            <input class="form-control" name="start" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <label>Check-out</label>
                            <input class="form-control" name="end" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-select-plus">
                            <label>Rooms</label>
                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                              <label class="btn btn-primary active">
                                <input type="radio" name="options" />1
                              </label>
                              <label class="btn btn-primary">
                                <input type="radio" name="options" />2
                              </label>
                              <label class="btn btn-primary">
                                <input type="radio" name="options" />3
                              </label>
                              <label class="btn btn-primary">
                                <input type="radio" name="options" />3+
                              </label>
                            </div>
                            <select class="form-control hidden">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option selected="selected">4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>
                              <option>10</option>
                              <option>11</option>
                              <option>12</option>
                              <option>13</option>
                              <option>14</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-select-plus">
                            <label>Guests</label>
                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                              <label class="btn btn-primary active">
                                <input type="radio" name="options" />1
                              </label>
                              <label class="btn btn-primary">
                                <input type="radio" name="options" />2
                              </label>
                              <label class="btn btn-primary">
                                <input type="radio" name="options" />3
                              </label>
                              <label class="btn btn-primary">
                                <input type="radio" name="options" />3+
                              </label>
                            </div>
                            <select class="form-control hidden">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option selected="selected">4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>
                              <option>10</option>
                              <option>11</option>
                              <option>12</option>
                              <option>13</option>
                              <option>14</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit">Search for Hotels</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="tab-3">
                  <h2>Find Your Perfect Insurance</h2>
                  <form>
                    <div class="form-group form-group-lg form-group-icon-left">
                      <i class="fa fa-map-marker input-icon"></i>
                      <label>Which Plan is Suitable for you?</label>
                      <input class="typeahead form-control" placeholder="Select Insurance Plan" type="text" />
                    </div>
                    <div class="input-daterange" data-date-format="M d, D"></div>
                    <button class="btn btn-primary btn-lg" type="submit">Search for Insurance</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="tab-4">
                  <h2>Search for Cheap Rental Cars</h2>
                  <form>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group form-group-lg form-group-icon-left">
                          <i class="fa fa-map-marker input-icon"></i>
                          <label>Pick-up Location</label>
                          <input class="typeahead form-control" placeholder="City, Airport, U.S. Zip" type="text" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-lg form-group-icon-left">
                          <i class="fa fa-map-marker input-icon"></i>
                          <label>Drop-off Location</label>
                          <input class="typeahead form-control" placeholder="City, Airport, U.S. Zip" type="text" />
                        </div>
                      </div>
                    </div>
                    <div class="input-daterange" data-date-format="M d, D">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <label>Pick-up Date</label>
                            <input class="form-control" name="start" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                            <label>Pick-up Time</label>
                            <input class="time-pick form-control" value="12:00 AM" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <label>Drop-off Date</label>
                            <input class="form-control" name="end" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                            <label>Drop-off Time</label>
                            <input class="time-pick form-control" value="12:00 AM" type="text" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit">Search for Rental Cars</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="tab-5">
                  <h2>Search for Activities</h2>
                  <form>
                    <div class="input-daterange" data-date-format="M d, D">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-map-marker input-icon"></i>
                            <label>Where are you going?</label>
                            <input class="typeahead form-control" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <label>From</label>
                            <input class="form-control" name="start" type="text" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <label>To</label>
                            <input class="form-control" name="end" type="text" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit">Search for Activities</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="loc-info text-right hidden-xs hidden-sm">
            <h3  style="text-align:center; color:#FFFFFF">
              <!--<img src="img/flags/32/fr.png" alt="Image Alternative text" title="Image Title" />Paris-->Travel Painters
            </h3>
            <p style="text-align:center">Traveling - it leaves you speechless, then turns you into a storyteller.Everyone loves stories, and here at TravelPainters, we believe that at the end of the day the experiences you've had, the stories you've shared (and the ones you've yet to share) are some of the most important moments in life.</p>
            <img src="
              <?php echo $themeurl; ?>/img/united-states-flag.png" />
              <br />
              <br />
              <img src="
                <?php echo $themeurl; ?>/img/travel-painters_logo_lastt-.png" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TOP AREA  -->
  <div class="gap"></div>
  <div class="container">
    <div class="row row-wrap" data-gutter="60">
      <div class="col-md-3">
        <div class="thumb">
          <header class="thumb-header">
            <i class="fa fa-dollar box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
          </header>
          <div class="thumb-caption">
            <h5 class="thumb-title">
              <a class="text-darken" href="#">PRICE GUARANTEED</a>
            </h5>
            <p class="thumb-desc">Find our lowest price to destinations worldwide, guaranteed</p>
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
              <a class="text-darken" href="#">FREE CANCELLATION WITHIN 12 HOURS</a>
            </h5>
            <p class="thumb-desc">Travel Painters offers Free Cancellation to its entire booking users.</p>
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
              <a class="text-darken" href="#">24/7 Customer Care</a>
            </h5>
            <p class="thumb-desc">Get award-winning service and special deals by calling 1-888-417-0446</p>
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
              <a class="text-darken" href="#">EASY ONLINE BOOKING</a>
            </h5>
            <p class="thumb-desc">Search, select and save - the fastest way to book your trip</p>
          </div>
        </div>
      </div>
    </div>
    <div class="gap gap-small"></div>
  </div>
  <div class="bg-holder">
    <div class="bg-mask"></div>
    <div class="bg-parallax" style="background-image:url(
      <?php echo $themeurl; ?>/img/hotel_the_cliff_bay_spa_suite_2048x1310.jpg);">
    </div>
    <div class="bg-content">
      <div class="container">
        <div class="gap gap-big text-center text-white">
          <h2 class="text-uc mb20">DURING TRAVEL HOTELS</h2>
          <ul class="icon-list list-inline-block mb0 last-minute-rating">
            <li>
              <i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i>
            </li>
          </ul>
          <h5 class="last-minute-title">The Peninsula - New York</h5>
          <p class="last-minute-date">Fri 14 Sep - Sun 16 sep</p>
          <p class="mb20">
            <b>$120</b> / person
          </p>
          <a class="btn btn-lg btn-white btn-ghost" href="#">Book Now 
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="gap"></div>
    <h2 class="text-center">Top Destinations</h2>
    <div class="gap">
      <div class="row row-wrap">
        <div class="col-md-3">
          <div class="thumb">
            <header class="thumb-header">
              <a class="hover-img curved" href="#">
                <img src="
                  <?php echo $themeurl; ?>/img/cuba_havana.jpg" alt="Image Alternative text" title="the journey home" />
                  <i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                </a>
              </header>
              <div class="thumb-caption">
                <h4 class="thumb-title">Cuba</h4>
                <p class="thumb-desc">Want to book a holiday to Cuba? Whether you're off for a romantic holiday, family trip, or an all-inclusive holiday, Cuba holiday packages on We make planning your trip simple and affordable.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="thumb">
              <header class="thumb-header">
                <a class="hover-img curved" href="#">
                  <img src="
                    <?php echo $themeurl; ?>/img/London_img.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" />
                    <i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                  </a>
                </header>
                <div class="thumb-caption">
                  <h4 class="thumb-title">Europe</h4>
                  <p class="thumb-desc">London is expensive and not as much a convenience culture as America (most black cabs do not take cards). Plan ahead to get the best deals, and book restaurants and theater tickets well in advance.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="thumb">
                <header class="thumb-header">
                  <a class="hover-img curved" href="#">
                    <img src="
                      <?php echo $themeurl; ?>/img/Dubai-img.jpg" alt="Image Alternative text" title="people on the beach" />
                      <i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                    </a>
                  </header>
                  <div class="thumb-caption">
                    <h4 class="thumb-title">Dubai</h4>
                    <p class="thumb-desc">Your adventure begins with an exciting journey to the mysterious and magical desert, leaving behind the hustle bustle of the city.Once reached the desert.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="thumb">
                  <header class="thumb-header">
                    <a class="hover-img curved" href="#">
                      <img src="
                        <?php echo $themeurl; ?>/img/rometravel_img.jpg" alt="Image Alternative text" title="lack of blue depresses me" />
                        <i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                      </a>
                    </header>
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
    $('.nav_search_for_flights').on('click',function(e){
      if ($('#flight-search-1').hasClass('active')){
        if($("input[name=from]").val() == "" || $("input[name=to]").val() == "")
        {
          alert('Please select origin or desitanation for flights.');
          e.preventDefault();
        }

        if($("input[name=start]").val() == "" || $("input[name=end]").val() == "")
        {
          alert('Please select Departing or Returning Dates for flights.');
          e.preventDefault();
        }

        $("input[name=rfrom]").val("");
        $("input[name=tfrom]").val("");
      }    

      if ($('#flight-search-2').hasClass('active')){
        if($("input[name=rfrom]").val() == "" || $("input[name=tfrom]").val() == "")
        {
          alert('Please select origin or desitanation for flights.');
          e.preventDefault();
        }

        if($("input[name=departing]").val() == "")
        {
          alert('Please select departing date for flights.');
          e.preventDefault();
        }
        
        $("input[name=from]").val("");
        $("input[name=to]").val("");
      }    
        
    });
  });
</script>