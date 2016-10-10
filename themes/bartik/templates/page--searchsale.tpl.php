   <?php

        if(isset($_REQUEST["saledata"]) && $_REQUEST["saledata"] != array()){
        $themeurl = file_create_url(path_to_theme());
        $adult = 0;
        $children = 0;

        $bookingdata = json_decode($_REQUEST['saledata']); 
        $adult = isset($bookingdata->adult)?$bookingdata->adult:0;
        $children = isset($bookingdata->children)?$bookingdata->children:0;
        
        $nameofmktairline = "";
        $flightarray = array();
        $flightarrayoutbound = array();

        if(isset($bookingdata->inoutflightarr) && $bookingdata->inoutflightarr)
        {
            //amadeus data
            $ikey = 0;
            foreach ( $bookingdata->inoutflightarr as $key => $value) {  //echo "<pre>"; print_r($value); die;
                $nameofmktairline = $value->marketingairlinefullname;
                

                $flightarray[$ikey]['logoofairline'] = $value->logoofmarketingairline;
                $flightarray[$ikey]['nameofairline'] = $value->marketingairlinefullname;
                $flightarray[$ikey]['depart'] = $value->departtime;
                $flightarray[$ikey]['originairport'] = $value->departureairportfullname;
                $flightarray[$ikey]['arrives'] = $value->arrivaltime;
                $flightarray[$ikey]['destinationairport'] = $value->arrivalairportfullname;
                $flightarray[$ikey]['flightno'] = $value->flightno;
                $flightarray[$ikey]['stops'] = $value->stopornonstop;
                $flightarray[$ikey]['fare'] = $bookingdata->totalfare;
                $flightarray[$ikey]['travelclass'] = $value->travelclass;
                $flightarray[$ikey]['layovertime'] = $value->layovertime;

                $totalprice = $bookingdata->totalfare;
                $priceperadulttotalfare = $bookingdata->totalbeforetax;
                $priceperadulttax = $bookingdata->totaltax;

                $ikey++;
            }

          
        }

        if(isset($bookingdata->datatoshownew) && $bookingdata->datatoshownew){
            
            foreach ( $bookingdata->datatoshownew as $key => $value) 
            {   
                $nameofmktairline = $value->nameOfmarketingAirine; 
                
                if($key == 0)
                {    
					if($adult == 0 || $children == 0)
					{
						$adult = isset($value->adults)?$value->adults:0;
						$children = isset($value->children)?$value->children:0;
					}
                    foreach ($value->AllFlightsdataInOneOption as $keynext => $valuenext) 
                    {
                        $flightarray[$keynext]['logoofairline'] = $value->logoOfmarketingAirine;
                        $flightarray[$keynext]['nameofairline'] = $value->nameOfmarketingAirine;
                        $flightarray[$keynext]['stops'] = $value->nonStopOrwithStop;
                        $flightarray[$keynext]['layovertime'] = $value->LayoverTime;
                        $flightarray[$keynext]['travelclass'] = $value->searchedClass;
                        $flightarray[$keynext]['fare'] = $bookingdata->totalfareInUsd;
                        $flightarray[$keynext]['depart'] = $valuenext->departuretime;
                        $flightarray[$keynext]['originairport'] = $valuenext->departureairport;
                        $flightarray[$keynext]['arrives'] = $valuenext->arrivaltime;
                        $flightarray[$keynext]['destinationairport'] = $valuenext->arrivalaiport;
                        $flightarray[$keynext]['flightno'] = $valuenext->oafn;
					}	
						
                }else
                { 
                    

                    foreach ($value->AllFlightsdataInOneOption as $keynext => $valuenext) 
					{

                        $flightarrayoutbound[$keynext]['logoofairline'] = $value->logoOfmarketingAirine;
                        $flightarrayoutbound[$keynext]['nameofairline'] = $value->nameOfmarketingAirine;
                        $flightarrayoutbound[$keynext]['stops'] = $value->nonStopOrwithStop;
                        $flightarrayoutbound[$keynext]['layovertime'] = $value->LayoverTime;
                        $flightarrayoutbound[$keynext]['travelclass'] = $value->searchedClass;
                        $flightarrayoutbound[$keynext]['fare'] = $bookingdata->totalfareInUsd;
                        $flightarrayoutbound[$keynext]['depart'] = $valuenext->departuretime;
                        $flightarrayoutbound[$keynext]['originairport'] = $valuenext->departureairport;
                        $flightarrayoutbound[$keynext]['arrives'] = $valuenext->arrivaltime;
                        $flightarrayoutbound[$keynext]['destinationairport'] = $valuenext->arrivalaiport;
                        $flightarrayoutbound[$keynext]['flightno'] = $valuenext->oafn;
                    }

                }
                
            }  


            //saber price details
            if(isset($bookingdata->alldataofsaberoneflight)&& $bookingdata->alldataofsaberoneflight)
            {
                
                $totalprice = $bookingdata->alldataofsaberoneflight->AirItineraryPricingInfo->PTC_FareBreakdowns->PTC_FareBreakdown->PassengerFare->TotalFare->Amount;

                $priceperadulttotalfare = $bookingdata->alldataofsaberoneflight->AirItineraryPricingInfo->PTC_FareBreakdowns->PTC_FareBreakdown->PassengerFare->TotalFare->Amount;
                $priceperadulttax = $bookingdata->alldataofsaberoneflight->AirItineraryPricingInfo->PTC_FareBreakdowns->PTC_FareBreakdown->PassengerFare->Taxes->TotalTax->Amount;
            }
        }

        global $user;
        $user = user_load($user->uid);
        //echo "<pre>"; print_r($user); die;
        if(isset($user->field_streetuser['und']))
        {    
            $userstreet = $user->field_streetuser['und'][0]['value'];
            $usercity = $user->field_cityuser['und'][0]['value'];
            $userzipcode = $user->field_zipcodeuser['und'][0]['value'];
            $userbillingphone = $user->field_billing_phone['und'][0]['value'];
            $usermobilephone = $user->field_mobile_phoneuser['und'][0]['value'];
            $usermail = $user->mail; 
        }
        else
        {
            $userstreet = "";
            $usercity = "";
            $userzipcode = "";
            $userbillingphone = "";
            $usermobilephone = "";
            $usermail = ""; 
        }    

    
        if(isset($flightarray) && $flightarray)
        {
            $firstflightdetails = reset($flightarray);
            
                $flightnotopass = $firstflightdetails["flightno"];
                $departuretimetopass =  substr($firstflightdetails["depart"],5,12);
                $arrivaltimetopass = substr($firstflightdetails["arrives"],5,12);;
                $mktairlinepass = explode(".", $firstflightdetails["logoofairline"]);
                $mktairlinepass = reset($mktairlinepass);
                $originalocationtopass = substr($firstflightdetails["originairport"],strpos($firstflightdetails["originairport"], "(")+1,3);
                $destinationlocationtopass = substr($firstflightdetails["destinationairport"],strpos($firstflightdetails["destinationairport"], "(")+1,3);

                //$pathoffile = realpath("./");
                //$pathoffile = $pathoffile."\/"."phpsaber"."\/";
                //require_once $pathoffile.'workflow\/Workflow.php';
                //require_once $pathoffile.'soap_activities\/VerifyFlightDetailsSoapActivity.php';

                $datatopass = array("departuretime"=>$departuretimetopass,"flightno"=>$flightnotopass,"destinationlocation"=>$destinationlocationtopass,"originlocation"=>$originalocationtopass,"marketingairline"=>$mktairlinepass);
                
                global $base_url;
                
                $urltosendrequest = $base_url."/phpsaber/validateflight.php";
                
                $urltosendrequest = $urltosendrequest.'?'.http_build_query($datatopass, '', '&');
                $result = file_get_contents($urltosendrequest);
                
                $flightdetailsresponse = json_decode($result);

                //$urltosendrequest = $base_url."/phpsaber/getflightdetails.php";
                
                //$urltosendrequest = $urltosendrequest.'?'.http_build_query($datatopass, '', '&');
                //$result = file_get_contents($urltosendrequest);
                
                //echo "<pre>"; print_r($flightdetailsresponse); die;                
        }    


        
       //if(!isset($flightdetailsresponse))
       //{
        //echo "<h1>Please try another flight as this flight is fully booked. !!!</h1>"; die;
       //}    


      
   ?>
    <div class="gap"></div>
    <div class="container">

    <div class="row">
        <div class="col-md-10">
        <?php
           global $user;

          if ( $user->uid ) 
          { ?>
            <h3>Traveler Details</h3>
           <?php
          }
          elseif(!$user->uid) 
          {
            ?>
            <h3>Traveler Details</h3>
            <p>Sign in to your <a href="/user">Travel Painter Account</a> for fast booking.</p>
          <?php  
          }
        ?>
        
        
    </div>
    
    <div class="row">
    
            <div class="col-md-10">
                    <div class="booking-item-payment">
                        <header class="clearfix">
                            <h4 class="mb0"><strong><?php echo $nameofmktairline; ?></strong></h4>
                        </header>
                                                
                        <div class="booking-item-container">
                                <div class="booking-item">
                                    <?php if(isset($flightarray) && $flightarray){ ?>
                                    <?php foreach ($flightarray as $key => $value) { //echo "<pre>"; echo $key; print_r($value); die; ?>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/<?php echo $value['logoofairline']; ?>" alt="Image Alternative text" title="Image Title">
                                                <p><?php echo $value['nameofairline']; ?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('h:i A',strtotime($value['depart'])) ?></h5>
                                                    <p class="booking-item-date"><?php echo date('l, F d ',strtotime($value['depart'])) ?></p>
                                                    <p class="booking-item-destination"><?php echo $value['originairport']; ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('h:i A',strtotime($value['arrives'])) ?></h5>
                                                    <p class="booking-item-date"><?php echo date('l, F d ',strtotime($value['arrives'])) ?></p>
                                                    <p class="booking-item-destination"><?php echo $value['destinationairport']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>Flight No.<?php echo $value['flightno']; ?></h5>
                                            <p><?php echo $value['stops']; ?></p>
                                        </div>
                                        
                                        <div class="col-md-3"><span class="booking-item-price" <?php if($key == 0){ ?>ng-init="faretopass='<?php echo $value['fare']; ?>'"<?php } ?> ><?php if($key == 0){ ?>$<?php echo $value['fare']; ?><?php } ?></span>

                                        <span></span><br>
                                        <span><?php if($value['layovertime']!=0){ ?>Layover: <?php echo $value['layovertime']; ?><?php } ?></span><br>
                                            <p class="booking-item-flight-class">Class: <?php echo $value['travelclass']; ?></p>
                                        </div>
                                        
                                    </div>
                                    <?php } ?>
                                    <?php } //flight array ?>
                                    <?php if(isset($flightarrayoutbound) && $flightarrayoutbound){ ?>
                                    <?php foreach ($flightarrayoutbound as $key => $value) { ?>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="booking-item-airline-logo">
                                                <?php if($key == 0){ ?>
                                                <img src="<?php echo $themeurl; ?>/img/airlineslogo/<?php echo $value['logoofairline']; ?>" alt="Image Alternative text" title="Image Title">
                                                <p><?php echo $value['nameofairline']; ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('h:i A',strtotime($value['depart'])) ?></h5>
                                                    <p class="booking-item-date"><?php echo date('l, F d ',strtotime($value['depart'])) ?></p>
                                                    <p class="booking-item-destination"><?php echo $value['originairport']; ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('h:i A',strtotime($value['arrives'])) ?></h5>
                                                    <p class="booking-item-date"><?php echo date('l, F d ',strtotime($value['arrives'])) ?></p>
                                                    <p class="booking-item-destination"><?php echo $value['destinationairport']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>Flight No.<?php echo $value['flightno']; ?></h5>
                                            <?php if($key == 0){ ?><p><?php echo $value['stops']; ?></p><?php } ?>
                                        </div>
                                        <div class="col-md-3"><span class="booking-item-price"></span><span></span>
                                        <?php if($key == 0){ ?><span>Layover: <?php echo $value['layovertime']; ?></span><?php } ?>
                                            <p class="booking-item-flight-class"></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php } //flight array ?>
                                
                                </div>
                            </div>
                     </div>
                </div>
            </div>
            <!---flight detail end--->
    
            <!---Passengers detail-->
           
            <div class="gap gap-small"></div>
    <div class="row">
        <div class="col-md-10">
            <div class="booking-item-payment">
                    <header class="clearfix">
                    <h4 class="mb0"><strong>Passengers</strong></h4>
                    </header>
                    <form name="userForm" class="userFormcls">
                     <input type="text" class="form-control donotshowthis userFormValid" name="v<?php echo 1; ?>" ng-model="userForm.$invalid" value="{{userForm.$invalid}}" />
                    <ul class="list booking-item-passengers">
                      
                    <style> .donotshowthis { display: none; } </style>       
                    <input class="donotshowthis" name="allflightdata" value="<?php echo isset($_REQUEST["saledata"])?str_replace('"', "'", $_REQUEST["saledata"]):""; ?>" type="text" />

                    <?php $totalpassenger = $adult+$children;?>

                    <?php for ($i=0; $i < $totalpassenger ; $i++) {  ?>
                    <li>
                            <div class="row">
                                    <div class="col-md-12 sukh_height">
                                <div class="col-md-2">
                                   <div class="form-group">
                                        <label>Traveler <?php echo $i+1; ?></label>
                                        <select>
                                        <option>Adult</option>
                                        <option>Senior</option>
                                        <option>Child</option>
                                        <option>Seat Infant</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                 <div class="col-md-2">
                                    <div class="form-group">
                                         <label>First Name</label>
                                        <input type="text" class="form-control" name="fn<?php echo $i+1; ?>" ng-model="user.fn<?php echo $i+1; ?>" ng-minlength="3" ng-maxlength="18" required />
                                       
                                        <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userForm.fn<?php echo $i+1; ?>.$error.minlength">Firstname is too short.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userForm.fn<?php echo $i+1; ?>.$error.maxlength">Firstname is too long.</p>

                                        <!-- show an error if this isn't filled in -->
                                        <p class="sukh_alert" ng-show="userForm.fn<?php echo $i+1; ?>.$error.required">Your Firstname is required.</p>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        
                                         <input type="text" class="form-control" name="mn<?php echo $i+1; ?>" ng-model="user.mn<?php echo $i+1; ?>" ng-minlength="3" ng-maxlength="18" required />

                                        <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userForm.mn<?php echo $i+1; ?>.$error.minlength">Middle name is too short.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userForm.mn<?php echo $i+1; ?>.$error.maxlength">Middle name is too long.</p>

                                        <!-- show an error if this isn't filled in -->
                                        <p class="sukh_alert" ng-show="userForm.mn<?php echo $i+1; ?>.$error.required">Your Middle name is required.</p>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                             <label>Last Name</label>
                                         
                                            <input type="text" class="form-control" name="ln<?php echo $i+1; ?>" ng-model="user.ln<?php echo $i+1; ?>" ng-minlength="3" ng-maxlength="18" required />

                                            <!-- show an error if username is too short -->
                                            <p class="sukh_alert" ng-show="userForm.ln<?php echo $i+1; ?>.$error.minlength">Last name is too short.</p>

                                            <!-- show an error if username is too long -->
                                            <p class="sukh_alert" ng-show="userForm.ln<?php echo $i+1; ?>.$error.maxlength">Last name is too long.</p>

                                            <!-- show an error if this isn't filled in -->
                                            <p class="sukh_alert" ng-show="userForm.ln<?php echo $i+1; ?>.$error.required">Your Last name is required.</p>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input ng-model="user.dobx<?php echo $i+1; ?>" class="date-pick-years form-control" name="dob<?php echo $i+1; ?>" type="text" required/>
                                        <!-- show an error if this isn't filled in -->
                                        <p class="sukh_alert" ng-show="userForm.dob<?php echo $i+1; ?>.$error.required">DOB is required.</p>
                                       
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="sex<?php echo $i+1; ?>">
                                        <option>Male</option>
                                        <option>Female</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <!--<a class="add_field_button"><img class="sukh_icon" src="img/plus.png" alt="Travel Painters" /></a>-->
                                    
                                </div>
                            
                            </div>
                        </div>
           </li>
           <?php } ?>
                        

                    <!--<li>
                            <div class="row">
                                    <div class="col-md-12">
                                <div class="col-md-2">
                                   <div class="form-group">
                                        <label class="donotshowthis">Traveler 2</label>
                                        <select class="donotshowthis">
                                        <option>Adult</option>
                                        <option>Senior</option>
                                        <option>Child</option>
                                        <option>Seat Infant</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="donotshowthis">First Name</label>
                                        <input  class="donotshowthis form-control" type="text" />
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="donotshowthis">Middle Name</label>
                                        <input class="form-control donotshowthis" type="text" />
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="donotshowthis">Last Name</label>
                                        <input class="form-control donotshowthis" type="text" />
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="donotshowthis">Date of Birth</label>
                                        <input class="date-pick-years form-control donotshowthis donotshowthis" type="text" />
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group donotshowthis">
                                        <label>Gender</label>
                                        <select>
                                        <option>Male</option>
                                        <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
           </li>      -->
                        
                    </ul>
                    </form>
              
                    </div>
                    </div>
                    </div>
                    
                    <!---Passengers detail end-->
                    
                    <div class="gap gap-small"></div>
        
        <!---Price detail-->
        
            <div class="row">
                 <div class="col-md-10">
                        <div class="booking-item-payment">
                                    <header class="clearfix">
                                    <h4 class="mb0"><strong>Price Details (USD)</strong></h4>
                                    </header>
                                        
                                        <div class="col-md-12">
                                            <div class="clearfix col-md-6">
                                                <h5> Total Traveler</h5>
                                                <h5>Best Price</h5>
                                                <h5>Taxes & Fees:</h5>
                                               
                                            </div>
                                            <div class="clearfix col-md-6">
                                                <h5><?php echo isset($adult)?$adult:""; ?> Adult<?php if(isset($children)){ ?>, <?php echo isset($children)?$children:""; ?> Children<?php } ?></h5>
                                                
                                                <h5>$<?php echo number_format((float)$totalprice-$priceperadulttax, 2, '.', ''); ?></h5>
                                                <h5>$<?php echo number_format((float)$priceperadulttax, 2, '.', ''); ?></h5>
                                                
                                            </div>
                                        </div>
                                        
                                <div class="row sukh-color">    
                                     <div class="col-md-10 col-sm-8">
                                        
                                        <h5 class="sukh-clr">Final Total Price:</h5>
                                     </div>
                                        
                                        <div class="col-md-2 col-sm-4">
                                        <h5 class="sukh-clr">$<?php echo ($totalprice*$adult); ?></h5>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">Please note: All fares are quoted in USD. Some airlines may charge baggage fees.</div>
                                            <div class="col-md-1"></div>
                                        </div>
                        
                                        
                    </div>              
                </div>
            </div>
            
            <!---Price detail end-->
            
                    <div class="gap gap-small"></div>
            
            <!---Payment Info detail-->
            
            <div class="row row_abhi">
                <div class="col-md-10">
                        <div class="booking-item-payment">
                            <header class="clearfix">
                            <h4 class="mb0"><strong>Payment Info (Secure SSL Encrypted Transaction)</strong></h4>
                            </header>
                            
                            <form name="userFormcc" class="cc-form userFormcccls">
                            <input type="text" class="form-control donotshowthis userFormccValid" name="userFormccfv" ng-model="userFormcc.$invalid" value="{{userFormcc.$invalid}}" />
                                <div class="clearfix col-md-12" >
                                    <div class="form-group form-group-cc-number col-md-6">
                                        <label ng-init="user.typepfcard='VI'">Payment Method</label>
                                        <select name="typepfcard" ng-model="user.typepfcard" required class="form-control">
                                        <option value="VI">Visa</option>
                                        <option value="CA">Master Card</option>
                                        <option value="AX">American Express</option>
                                        <option value="DS">Discover</option>
                                        <option value="DC">Diners Club</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="spnCardImg" id="cards">
                                            <a style="border: none;"class="pvisa grayscale" id="VI_3"></a>
                                            <a class="pmaster grayscale"  style="border: none;"></a>
                                            <a class="pamerican grayscale" style="border: none;"></a>
                                            <a class="grayscale" style="border: none;"></a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                    <div ng-init="baseurlofd = '<?php echo $base_url; ?>'" class="clearfix col-md-8">
                    
                                <div ng-init="ccvalid='no'" class="form-group form-group-cc-number col-md-6">
                                  <label ng-init="ccairline='<?php echo $mktairlinepass; ?>'">Credit or Debit Card Number</label>
                                  <input type="text" class="form-control donotshowthis" name="userFormccfv" ng-model="userFormcc.$invalid" value="{{userFormcc.$invalid}}" />
                                  <input class="form-control" placeholder="xxxx xxxx xxxx xxxx" name="cc" type="text"   ng-model="user.cc" ng-minlength="19" ng-maxlength="19" validate-cc-remotely required />
                                  
                                   
                                    <p class="sukh_alert" ng-show="ccvalid=='no'">
                                      Credit card must be valid. !!
                                   </p>
                                   <p class="sukh_alert" ng-hide="ccvalid=='yes'" ng-show="ccmsg!=undefined">
                                      {{ccmsg}}
                                   </p>
                                   
                                    <!-- show an error if username is too short -->
                                    <p class="sukh_alert" ng-show="userFormcc.cc.$error.minlength">16 digit cc no. required.</p>

                                    <!-- show an error if username is too long -->
                                    <p class="sukh_alert" ng-show="userFormcc.cc.$error.maxlength">16 digit cc no. required.</p>

                                    <!-- show an error if this isn't filled in -->
                                     <p class="sukh_alert" ng-show="userFormcc.cc.$error.required">Please check your 16 digit cc no.</p>
                                  <span class="cc-card-icon"></span>

                                    </div>
                                    
                                    <div class="form-group form-group-cc-cvc col-md-6">
                                        <label>CVV</label>
                                        
                                        <input class="form-control" placeholder="xxxx" name="ccv" type="text"  ng-model="user.ccv" ng-minlength="3" ng-maxlength="4"  required />
                                  
                                   

                                        <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormcc.ccv.$error.minlength">3 digit CCV no. required.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormcc.ccv.$error.maxlength">3 digit CCV no. required.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormcc.ccv.$error.required">Please check CCV no.</p>
                                    </div>
                                    
                    </div>
                                
                                <div class="clearfix " style="padding-left: 14px;">
                                    <div class="form-group form-group-cc-name col-md-6">
                                        <label>Cardholder Name</label>
                                        <input class="form-control" placeholder="Card Holder Name." name="ccn" type="text"  ng-model="user.ccn" ng-minlength="3" ng-maxlength="25" required />
                                  

                                        <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormcc.ccn.$error.minlength">Card holder name min 3 characters.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormcc.ccn.$error.maxlength">Card holder name max 25 characters.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormcc.ccn.$error.required">Card holder name required.</p>
                                    </div>
                                    
                                    <div class="form-group form-group-cc-date col-md-6">
                                        <label>Valid Thru</label>
                                        <input class="form-control" placeholder="mm/yy" type="text" name="ccvth" ng-model="user.ccvth" ng-minlength="7" ng-maxlength="10" validate-cc-remotely required />
                                               <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormcc.ccvth.$error.minlength">CC Valid Till required.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormcc.ccvth.$error.maxlength">Please check CC Valid Till.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormcc.ccvth.$error.required">Enter CC Valid Till in right format.</p>
                                    </div>
                                </div>
                                
                                
                                 <div class="clearfix sukh-height ">
                                    <div class="form-group form-group-cc-name col-md-10">
                                      
                                    </div>
                                    <div class="form-group form-group-cc-date col-md-2">
                                        <a href="#" class="verisign"></a>
                                    </div>
                                </div>
                               
                            </form>     
                        </div>
                    </div>
                </div>
                
                <!---Payment Info detail end--> 
                    
                    <div class="gap gap-small"></div>


    <!---Payment Info detail end--> 
<div class="row row_abhi">
        <div class="col-md-10">
            <div class="booking-item-payment">
                    <header class="clearfix">
                    <h4 class="mb0"><strong >Billing & Contact Information</strong></h4></header>
                    <strong class="sukh_header">Credit Card Billing Address:</strong>
                            <form name="userFormd" class="cc-form userFormdcls">
                                <input type="text" class="form-control donotshowthis userFormdValid" name="userFormdfv" ng-model="userFormd.$invalid" value="{{userFormd.$invalid}}" />
                                <div class="clearfix col-md-8">
                                    <div class="form-group form-group-cc-number ">
                                        <label>Country</label>

                                        <select name="country" class="form-control">
                                        <!--<option value="AF">Afghanistan</option>
                                        <option value="AX">Aland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia, Plurinational State of</option>
                                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Côte d'Ivoire</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CW">Curaçao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran, Islamic Republic of</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao</option>
                                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestinian Territory, Occupied</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Réunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="BL">Saint Barthélemy</option>
                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin (French part)</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SX">Sint Maarten (Dutch part)</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>-->
                                        <option value="AU">Australia</option>
                                        <option value="CA">Canada</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <!--<option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands, British</option>
                                        <option value="VI">Virgin Islands, U.S.</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>-->
                                        </select>
                                    </div>
                                    
                                   
                                </div>
                                
                                <div class="clearfix col-md-8">
                                    <div class="form-group form-group-cc-name">
                                        <label>Street</label>
                                        
                                        <input class="form-control" placeholder="Street" type="text" name="street" ng-model="user.street" ng-minlength="3" ng-maxlength="50" ng-init="user.street='<?php echo $userstreet ?>'"  required />
                                               <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormd.street.$error.minlength">Street min of 3 characters.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormd.street.$error.maxlength">Street max of 25 characters.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormd.street.$error.required">Street is required.</p>

                                    </div>
                                   
                                </div>
                                 <div class="clearfix col-md-8">
                                    <div class="form-group form-group-cc-name">
                                        <label>City</label>
                                        
                                        <input class="form-control" placeholder="(example: Chicago)" type="text" name="city" ng-model="user.city" ng-minlength="3" ng-maxlength="50" ng-init="user.city='<?php echo $usercity; ?>'" required />
                                               <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormd.city.$error.minlength">City min of 3 characters.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormd.city.$error.maxlength">City max of 25 characters.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormd.city.$error.required">City is required.</p>
                                    </div>
                                </div>
                                <div class="clearfix col-md-8">
                                    <div class="form-group form-group-cc-name">
                                        <label>State</label>
                                         <select name="state" class="form-control">
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix ">
                                    <div class="form-group form-group-cc-name col-md-8">
                                        <label>Zip</label>
                                        
                                        <input class="form-control" placeholder="Zipcode" type="text" name="zipcode" ng-model="user.zipcode" ng-minlength="3" ng-maxlength="6" ng-init="user.zipcode='<?php echo $userzipcode; ?>'" required />
                                               <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormd.zipcode.$error.minlength">Zipcode too short.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormd.zipcode.$error.maxlength">Zipcode too long.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormd.zipcode.$error.required">Zipcode required.</p>
                                    </div>
                                </div>
                              <strong class="sukh_header">Contact Information:</strong>
                                <div class="clearfix">
                                    <div class="form-group form-group-cc-name col-md-8">
                                        <label>Billing Phone:</label>
                                       
                                        <input class="form-control" placeholder="Billing Phone" type="text" name="bp" ng-model="user.bp" ng-minlength="3" ng-maxlength="16" ng-init="user.bp='<?php echo $userbillingphone; ?>'" required />
                                               <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormd.bp.$error.minlength">Billing Phone too short.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormd.bp.$error.maxlength">Billing Phone too long.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormd.bp.$error.required">Billing Phone required.</p>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="form-group form-group-cc-name col-md-8">
                                        <label>Mobile Phone</label>
                                     
                                        <input class="form-control" type="text" name="mp" placeholder="Mobile Phone" ng-minlength="3" ng-maxlength="16" ng-model="user.mobilephone" ng-init="user.mobilephone='<?php echo $usermobilephone; ?>'" required />  
                                               <!-- show an error if username is too short -->
                                        <p class="sukh_alert" ng-show="userFormd.mp.$error.minlength">Mobile Phone too short.</p>

                                        <!-- show an error if username is too long -->
                                        <p class="sukh_alert" ng-show="userFormd.mp.$error.maxlength">Mobile Phone too long.</p>

                                        <!-- show an error if this isn't filled in -->
                                         <p class="sukh_alert" ng-show="userFormd.mp.$error.required">Mobile Phone required.</p> 
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="form-group form-group-cc-name col-md-8">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" ng-model="user.email" ng-init="user.email='<?php echo $usermail; ?>'"  required/>    
                                       
                                          <br/>
                                          <span class="sukh_alert error" ng-show="userFormd.email.$error.required">
                                            Email Required!</span>
                                          <span class="sukh_alert error" ng-show="userFormd.email.$error.email">
                                            Check your email entered!</span>
                                         
                                            
                                </div>
                                </div>
                                <div class="clearfix">
                                    <div class="form-group form-group-cc-name col-md-8">
                                        <label>Confirm Email</label>
                                        
                                        <input class="form-control" type="email" name="emailc" ng-model="user.emailc" ng-init="user.emailc='<?php echo $usermail; ?>'"  required/>    
                                       
                                          <br/>
                                          <span class="sukh_alert error" ng-show="userFormd.emailc.$error.required">
                                            Confirm Email Required!</span>
                                          <span class="sukh_alert error" ng-show="userFormd.emailc.$error.email">
                                            Check your email entered!</span>  
                                            
                                </div>
                                </div>
                            </form> 
                                
                        </div>
                
                    </div>
               </div></div>
                
                
                        <div class="gap"></div>
            <div class="col-md-12">
            <p class="double">
            Please confirm that the names of travelers are accurate: Traveler 1 (N/A), Traveler 2 (N/A), Traveler 3 (N/A), Traveler 4 (N/A), Traveler 5 (N/A). (make changes)
Please also confirm that the dates and times of flight departures are accurate. Tickets are non-transferable and name changes on tickets are not permitted. Ticket cost for most airlines is non-refundable (see Fare Rules) and our service fees are non-refundable. All our service fees and taxes are included in the total ticket cost. However, tickets may be refunded if requested within four (4) hours from the time of purchase at no cost, and within twenty-four (24) hours from the time of purchase for a fee . Date and routing changes will be subject to airline penalties and our service fees. Fares are not guaranteed until ticketed.

            </p>
            <p class="double">
            MACP (Major Airlines Cancelation Policy), is a customer protection program offered by Travel Painters that assures total customer satisfaction with each airfare purchase. You can now cancel your flight booking within 24 hours - 100% free of charge. With LookUpFare you can enjoy the benefits of MACP), and can cancel your ticket with a full refund within 24 hours after booking - no questions asked! For the low price of $14.99, you can rest easy as Travelpainters will refund 100% of the ticket cost. Key Features of MACP Allows you to cancel your booking for any reason within 24 hours without any penalty Cancel & reebok your flights within the same day without any penalty if there is a drop in price Free Seat Assignments for certain Airlines, qualifying rules and regulations apply Name changes are not allowed according to Airlines Policies, but some airlines allow minor corrections, usually involving 2-3 characters free of charge (Specific airline conditions applies) Low cost for high convenience - just $14.99 per person! MACP Terms & Conditions MACP Fees are added per pax and not per ticket This program is available to all Travelpainters customers If you are not interested in the program you can just click the 'NO' button, the extra charge of $14.99 won't be calculated in your total ticket fare If you are cancelling your flight ticket within 24 hours of the booking, 100% of your ticket value is refunded, (excluding $14.99 the MACP Fee) By adding the MACP, you also agree to all of Travelpainters Terms and Conditions: This program is not applicable if your flight is with a low cost carrier (ticketless carrier) like Spirit Airlines or Frontier Airlines and if your travel is scheduled in the next 7 days You can apply for a cancelation and refund with us if the fare rules are applicable Refunds are not applicable if you're a "no show". "No Show" refers to the state where the passenger at the time of boarding does not show up and provides no warning to the airlines. We can accept refund requests only if we are able to secure waivers from the Airline to confirm that the following conditions have been met.
            </p>
            <P align="center">By clicking BOOK, I agree that I have read and accepted Travelpainters.com's Terms and Conditions and Privacy Policy.</P>
            <P align="center">If you do not see Book Flight button check your credit card and its validity.</P>
             <input class="btn btn-primary book_btn" type="submit" ng-show="ccvalid=='yes'" value="Book" />
            </div>
            <div class="gap"></div>
            
        </div>
        </div>
        

<?php } ?>