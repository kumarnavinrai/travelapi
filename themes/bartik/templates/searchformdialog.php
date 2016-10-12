<div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog">
                <h3>Search for Flight</h3>
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
                                    <input class="form-control" placeholder="yyyy-mm-dd" id="from_datepicker" name="start" type="text" />
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                    <label>Returning</label>
                                    <input class="form-control" placeholder="yyyy-mm-dd" id="to_datepicker" name="end" type="text" />
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
                                    <label>Child(0-17)</label>
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
              </script>       
              <a href="#" id="attach_box">Advance Search<i class="fa fa-sort-desc sukh" aria-hidden="true"></i></a><br /><br />
              <div id="sukh_buton" class="col-md-4" style="display:none;">
                            <div class="form-group form-group-lg form-group-icon-left "><i class="fa fa-plane input-icon input-icon-highlight"></i>
                            <label>Class</label>
                                <select name="rclass" class="form-control" >
                                  <option value="economy" class="su_option">Economy</option>
                                  <option value="premiumeco">Premium Economy</option>
                                  <option value="business">Business</option>
                                  <option value="first">First</option>
                                </select>
                            </div>
                            </div>        
              </div>
              
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
                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                            <label>Departing</label>
                                            <input class="date-pick form-control" id="ow_date" name="departing" placeholder="yyyy-mm-dd" data-date-format="M d, D" type="text" />
                                        </div>
                                    </div>
                                   <div class="col-md-2">
                                                                            <div class="form-group form-group-lg">
                                                                                
                                                                                
                                         <label>Adults</label>
                                        <select name="adultow" class="form-control">
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                        </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                <label>Child(0-11)</label>
                                                <select name="childrenow" class="form-control widthofowsel">
                                                  <option value="0">0</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                </select>
                                      </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg bt-change-search" type="submit">Search for Flights</button>
                </form>
            </div>