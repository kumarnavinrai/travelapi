<div class="col-md-6">
            <div class="search-tabs search-tabs-bg mt50">
              <!-- <h2>Find Your Perfect Trip</h2> -->
              <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                    <a href="#tab-2" data-toggle="tab">
                      <i class="fa fa-plane"></i>
                      <span class="text-tab-sukh" >Flights</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab-1" data-toggle="tab">
                      <i class="fa fa-building-o"></i>
                      <span  class="text-tab-sukh" >Hotels</span>
                    </a>
                  </li>
                  <!--<li>
                    <a href="#tab-3" data-toggle="tab">
                      <i class="fa fa-home"></i>
                      <span >Rails</span>
                    </a>
                  </li>-->
                  <li>
                    <a href="#tab-4" data-toggle="tab">
                      <i class="fa fa-car"></i>
                      <span class="text-tab-sukh">Cars</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab-5" data-toggle="tab">
                      <i class="fa fa-bolt"></i>
                      <span  class="text-tab-sukh" >Vacations</span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab-2">
                    <h3 class="margin-btm-sukh">Search for Cheap Flights</h3>
                    <form method="POST" action="<?php echo isset($_SESSION['urlforform'])?$_SESSION['urlforform']:""; ?>searchresult">		
                      <div class="tabbable">
					  
                        <!-- Added to handle the form -->					  
                        <div id="messages" class="fromcity" style="display:none;" >
                        From city is required
                        </div>	
                        <div id="messages" class="tocity" style="display:none;" >
                        To city is required
                        </div>	
                        <div id="messages" class="startdate" style="display:none;" >
                        Please choose a start date
                        </div>
                        <div id="messages" class="enddate" style="display:none;" >
                        Please choose a end date
                        </div>		
                        <p></p>	
                        <!-- Finish Here -->		  
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
                                  <input  class="typeahead form-control nav_to" name="to" placeholder="City, Airport" type="text" />
                                </div>
                              </div>
                            </div>
                            <div class="input-daterange" data-date-format="M d, D">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fa fa-calendar input-icon input-icon-highlight icon-setting-sukh"></i>
                                    <label>Departing</label>
                                    <input id="from_datepicker" class="form-control date-setting-sukh " class="clsstart" placeholder="yyyy-mm-dd" name="start" type="text" />
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fa fa-calendar input-icon input-icon-highlight icon-setting-sukh"></i>
                                    <label>Returning</label>
                                    <input id="to_datepicker" class="form-control date-setting-sukh" class="clsend" placeholder="yyyy-mm-dd" name="end" type="text" />
                                  </div>
                                </div>
                                <div class="col-md-6">    
                                    <div class="col-md-4">
                                      <div class="form-group form-group-lg">
                                        <label class="lbl-text-sukh">Adults</label>
                                        <select name="adult" class="form-control box-setting-sukh" >
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group form-group-lg form-group-select-plus form-btm-sukh">
                                        <label class="lbl-text-sukh">Child</label>
                                        <select name="children" class="form-control box-setting-sukh" >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        </select>
                                         <label class="text-year-sukh">(2-11 Years)</label>
                                      </div>
                                    </div>
                                     <div class="col-md-4">
                                      <div class="form-group form-group-lg form-group-select-plus form-btm-sukh">
                                        <label class="lbl-text-sukh">Infant</label>
                                        <select name="infant" class="form-control box-setting-sukh" >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        </select>
                                        <label class="text-year-sukh">(0-2 Years)</label>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <!-- <div class="col-md-12">
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
                            </div> -->
                             <script type="text/javascript"> 
                                 $(document).ready(function() {
                                     $('#attach_box').click(function(e) {
                                         e.preventDefault();   
                                         $('#sukh_buton').toggle();
                                     });
                                     $('.rtripandowselectorrt').on('click',function(){
                                        $('#sukh_buton').show();
                                     }); 
                                     $('.rtripandowselectorow').on('click',function(){
                                        $('#sukh_buton').hide();
                                     });        
                                 });
                              </script> 
                            <div id="sukh_buton" class="col-md-4">
                              <div class="form-group form-group-lg form-group-icon-left ">
                                <i class="fa fa-plane input-icon input-icon-highlight"></i>
                                <label>Class</label>
                                <select name="pclass" class="form-control" >
                                  <option value="ECONOMY" class="su_option">Economy</option>
                                  <option value="PREMIUM_ECONOMY">Premium Economy</option>
                                  <option value="BUSINESS">Business</option>
                                  <option value="FIRST">First</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-8"></div>
                        </div>
                        <div class="tab-pane fade" id="flight-search-2">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-map-marker input-icon"></i>
                                <label>From</label>
                                <input class="typeahead form-control" name="rfrom" placeholder="City, Airport" type="text" />
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
                                <input class="typeahead form-control" name="tfrom" placeholder="City, Airport" type="text" />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-calendar input-icon input-icon-highlight icon-setting-sukh"></i>
                                <label>Departing</label>
                                <input id="ow_date" class="date-pick form-control date-setting-sukh" name="departing" placeholder="yyyy-mm-dd" data-date-format="M d, D" type="text" />
                              </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-group-lg">
                                  <div class="widthofowsel">  
                                    <label>Adults</label>
                                    <select name="adultow" class="form-control">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                    </select>
                                  </div>
                                </div>
                            </div>
                            <div class="widthofowsel col-md-3">  
                                <label>Child(2-11)</label>
                                  <select name="childrenow" class="form-control widthofowsel">
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                  </select>
                            </div>  
                            <div class="widthofowsel col-md-3">  
                                <label>Infant(0-2)</label>
                                  <select name="infantnow" class="form-control widthofowsel">
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                  </select>
                            </div>  
                          </div><!--row  end-->
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group form-group-lg form-group-icon-left">
                                <i class="fa fa-plane input-icon input-icon-highlight"></i>
                                <label>Class</label>
                                <select name="rclass" class="form-control" >
                                  <!-- <option value="economy" class="su_option">Economy</option>
                                  <option value="premiumeco">Premium Economy</option>
                                  <option value="business">Business</option>
                                  <option value="first">First</option> -->

                                  <option value="ECONOMY" class="su_option">Economy</option>
                                  <option value="PREMIUM_ECONOMY">Premium Economy</option>
                                  <option value="BUSINESS">Business</option>
                                  <option value="FIRST">First</option>

                                </select>
                              </div>
                            </div>
                            <div class="col-md-8"></div>
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
                <!--<div class="tab-pane fade" id="tab-3">
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
                </div>-->
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
        