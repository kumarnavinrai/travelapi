<?php

/*$domainarray[] = 'http://travelpainters.local';
$domainarray[] = 'https://flyoticket.com';
$domainarray[] = 'http://cheapflyfare.com';

$http_origin = $_SERVER['HTTP_ORIGIN'];

if (in_array($http_origin, $domainarray))
{  
    header("Access-Control-Allow-Origin: $http_origin");
} 
 

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Access-Control-Allow-Origin, Access-Control-Allow-Methods");*/


include_once 'workflow/Workflow.php';
include_once 'soap_activities/HotelFinderSoapActivity.php';
include_once 'data/listofairport.php';
include_once 'data/listwithcode.php';
//echo "<pre>";print_r($_REQUEST); die;
  $workflow = new Workflow(new HotelFinderSoapActivity());
        
  $resulthotel = $workflow->runWorkflow();
  
  $resulthotel = (array) $resulthotel; 

function takeOutAirportCode($data)
{
  $fromairportcode = explode("-",$data);
  $fromairportcode = reset($fromairportcode);
  $fromairportcode = trim($fromairportcode);
  return $fromairportcode;
}

function changeFalseTrue($data)
{ 
   if($data=='false')
   {
      return 0;
   }

   if($data=='true')
   {
      return 1;
   }
   return NULL;
}


     
      $arrayhotel =array();
      $arraytoprint = array();
      $hotelcodes = array();

      /* code for multi city starts */

      if(isset($resulthotel) && $resulthotel)
      {
        

          if($resulthotel)
          {
                $datatoaddbyamadeus = array();
                               
                $bypassfirstelementofarraybfmml = reset($resulthotel);

                
                $requestofxmlbfmml = $bypassfirstelementofarraybfmml['OTA_HotelAvailRQ'];

                             

                $responseofbfmml = $bypassfirstelementofarraybfmml['OTA_HotelAvailRS'];

                
                $responseofbfmml = explode('<AdditionalAvail Ind="true"/>', $responseofbfmml);

                $responseofbfmml = next($responseofbfmml);

                $responseofbfmml = str_replace("</OTA_HotelAvailRS></soap-env:Body></soap-env:Envelope>", "", $responseofbfmml);

                $arrayhotel = json_decode(json_encode((array)simplexml_load_string($responseofbfmml)),1);
                

                if(isset($arrayhotel['AvailabilityOption']) && $arrayhotel['AvailabilityOption'])
                {
                   $arrayhoteltemp = array();
                  foreach ($arrayhotel['AvailabilityOption'] as $key => $value) 
                  { 

                    $arrayhoteltemp[] = $value;

                  }
                  $arrayhotel = $arrayhoteltemp;
                }
              }  

              if($arrayhotel)
              {
                $i = 0;
                foreach ($arrayhotel as $key => $value) {
                  //echo "<pre>"; print_r($value); die;                  
                  
                  $arraytoprint[$i]['HotelName'] = $value['BasicPropertyInfo']['@attributes']['HotelName'];
                  $arraytoprint[$i]['Address'] = $value['BasicPropertyInfo']['Address']['AddressLine'][0]." ".$value['BasicPropertyInfo']['Address']['AddressLine'][1];
                  $arraytoprint[$i]['Smoking'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SmokeFree']['@attributes']['Ind'];
                  $arraytoprint[$i]['Rate'] = isset($value['BasicPropertyInfo']['RateRange']['@attributes']['Min'])?$value['BasicPropertyInfo']['RateRange']['@attributes']['Min']:"call";
                  $temprate = explode(".", $arraytoprint[$i]['Rate']);
                  $arraytoprint[$i]['Rate'] = current($temprate);
                  $arraytoprint[$i]['RateDecimal'] = next($temprate);
                 
                  $arraytoprint[$i]['Rating'] = isset($value['BasicPropertyInfo']['Property']['Text'])?$value['BasicPropertyInfo']['Property']['Text']:"";
                  $arraytoprint[$i]['Rating'] = str_replace("CROWN", "", $arraytoprint[$i]['Rating']);
                  $arraytoprint[$i]['Rating'] = str_replace(" ", "", $arraytoprint[$i]['Rating']);
                  
                  $arraytoprint[$i]['ADA_Accessible'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['ADA_Accessible']['@attributes']['Ind'];
                  $arraytoprint[$i]['ADA_Accessible']=changeFalseTrue($arraytoprint[$i]['ADA_Accessible']);


                  $arraytoprint[$i]['AdultsOnly'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['AdultsOnly']['@attributes']['Ind'];
                  $arraytoprint[$i]['AdultsOnly']=changeFalseTrue($arraytoprint[$i]['AdultsOnly']);

                  $arraytoprint[$i]['Breakfast'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Breakfast']['@attributes']['Ind'];
                  $arraytoprint[$i]['Breakfast']=changeFalseTrue($arraytoprint[$i]['Breakfast']);

                  $arraytoprint[$i]['Wheelchair'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Wheelchair']['@attributes']['Ind'];
                  $arraytoprint[$i]['Wheelchair']=changeFalseTrue($arraytoprint[$i]['Wheelchair']);

                  $arraytoprint[$i]['BeachFront'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['BeachFront']['@attributes']['Ind'];
                  $arraytoprint[$i]['BeachFront']=changeFalseTrue($arraytoprint[$i]['BeachFront']);

                  $arraytoprint[$i]['Dining'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Dining']['@attributes']['Ind'];
                  $arraytoprint[$i]['Dining']=changeFalseTrue($arraytoprint[$i]['Dining']);

                  $arraytoprint[$i]['DryClean'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['DryClean']['@attributes']['Ind'];
                  $arraytoprint[$i]['DryClean']=changeFalseTrue($arraytoprint[$i]['DryClean']);

                  $arraytoprint[$i]['FitnessCenter'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FitnessCenter']['@attributes']['Ind'];
                  $arraytoprint[$i]['FitnessCenter']=changeFalseTrue($arraytoprint[$i]['FitnessCenter']);

                  $arraytoprint[$i]['FreeParking'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FreeParking']['@attributes']['Ind'];
                  $arraytoprint[$i]['FreeParking']=changeFalseTrue($arraytoprint[$i]['FreeParking']);

                  $arraytoprint[$i]['FreeShuttle'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FreeShuttle']['@attributes']['Ind'];
                  $arraytoprint[$i]['FreeShuttle']=changeFalseTrue($arraytoprint[$i]['FreeShuttle']);

                  $arraytoprint[$i]['FreeWifiInMeetingRooms'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FreeWifiInMeetingRooms']['@attributes']['Ind'];
                  $arraytoprint[$i]['FreeWifiInMeetingRooms']=changeFalseTrue($arraytoprint[$i]['FreeWifiInMeetingRooms']);

                  $arraytoprint[$i]['FreeWifiInPublicSpaces'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FreeWifiInPublicSpaces']['@attributes']['Ind'];
                  $arraytoprint[$i]['FreeWifiInPublicSpaces']=changeFalseTrue($arraytoprint[$i]['FreeWifiInPublicSpaces']);

                  $arraytoprint[$i]['FreeWifiInRooms'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FreeWifiInRooms']['@attributes']['Ind'];
                  $arraytoprint[$i]['FreeWifiInRooms']=changeFalseTrue($arraytoprint[$i]['FreeWifiInRooms']);

                  $arraytoprint[$i]['FullServiceSpa'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['FullServiceSpa']['@attributes']['Ind'];
                  $arraytoprint[$i]['FullServiceSpa']=changeFalseTrue($arraytoprint[$i]['FullServiceSpa']);

                  $arraytoprint[$i]['GameFacilities'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['GameFacilities']['@attributes']['Ind'];
                  $arraytoprint[$i]['GameFacilities']=changeFalseTrue($arraytoprint[$i]['GameFacilities']);

                  $arraytoprint[$i]['Golf'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Golf']['@attributes']['Ind'];
                  $arraytoprint[$i]['Golf']=changeFalseTrue($arraytoprint[$i]['Golf']);

                  $arraytoprint[$i]['IndoorPool'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['IndoorPool']['@attributes']['Ind'];
                  $arraytoprint[$i]['IndoorPool']=changeFalseTrue($arraytoprint[$i]['IndoorPool']);

                  $arraytoprint[$i]['InRoomMiniBar'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['InRoomMiniBar']['@attributes']['Ind'];
                  $arraytoprint[$i]['InRoomMiniBar']=changeFalseTrue($arraytoprint[$i]['InRoomMiniBar']);

                  $arraytoprint[$i]['Jacuzzi'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Jacuzzi']['@attributes']['Ind'];
                  $arraytoprint[$i]['Jacuzzi']=changeFalseTrue($arraytoprint[$i]['Jacuzzi']);

                  $arraytoprint[$i]['MeetingFacilities'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['MeetingFacilities']['@attributes']['Ind'];
                  $arraytoprint[$i]['MeetingFacilities']=changeFalseTrue($arraytoprint[$i]['MeetingFacilities']);

                  $arraytoprint[$i]['NonSmoking'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['NonSmoking']['@attributes']['Ind'];
                  $arraytoprint[$i]['NonSmoking']=changeFalseTrue($arraytoprint[$i]['NonSmoking']);

                  $arraytoprint[$i]['SmokingRoomsAvail'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SmokingRoomsAvail']['@attributes']['Ind'];
                  $arraytoprint[$i]['SmokingRoomsAvail']=changeFalseTrue($arraytoprint[$i]['SmokingRoomsAvail']);

                  $arraytoprint[$i]['SmokeFree'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SmokeFree']['@attributes']['Ind'];
                  $arraytoprint[$i]['SmokeFree']=changeFalseTrue($arraytoprint[$i]['SmokeFree']);

                  $arraytoprint[$i]['RoomsWithBalcony'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['RoomsWithBalcony']['@attributes']['Ind'];
                  $arraytoprint[$i]['RoomsWithBalcony']=changeFalseTrue($arraytoprint[$i]['RoomsWithBalcony']);

                  $arraytoprint[$i]['RoomService24Hours'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['RoomService24Hours']['@attributes']['Ind'];
                  $arraytoprint[$i]['RoomService24Hours']=changeFalseTrue($arraytoprint[$i]['RoomService24Hours']);

                  $arraytoprint[$i]['SkiInOutProperty'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SkiInOutProperty']['@attributes']['Ind'];
                  $arraytoprint[$i]['SkiInOutProperty']=changeFalseTrue($arraytoprint[$i]['SkiInOutProperty']);

                  $arraytoprint[$i]['OutdoorPool'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['OutdoorPool']['@attributes']['Ind'];
                  $arraytoprint[$i]['OutdoorPool']=changeFalseTrue($arraytoprint[$i]['OutdoorPool']);

                  $arraytoprint[$i]['Pets'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Pets']['@attributes']['Ind'];
                  $arraytoprint[$i]['Pets']=changeFalseTrue($arraytoprint[$i]['Pets']);

                  $arraytoprint[$i]['Pool'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Pool']['@attributes']['Ind'];
                  $arraytoprint[$i]['Pool']=changeFalseTrue($arraytoprint[$i]['Pool']);

                  $arraytoprint[$i]['SmokeFree'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SmokeFree']['@attributes']['Ind'];
                  $arraytoprint[$i]['SmokeFree']=changeFalseTrue($arraytoprint[$i]['SmokeFree']);

                  $arraytoprint[$i]['Tennis'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Tennis']['@attributes']['Ind'];
                  $arraytoprint[$i]['Tennis']=changeFalseTrue($arraytoprint[$i]['Tennis']);

                  $arraytoprint[$i]['Wheelchair'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['Wheelchair']['@attributes']['Ind'];
                  $arraytoprint[$i]['Wheelchair']=changeFalseTrue($arraytoprint[$i]['Wheelchair']);

                  $arraytoprint[$i]['RoomService24Hours'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['RoomService24Hours']['@attributes']['Ind'];
                  $arraytoprint[$i]['RoomService24Hours']=changeFalseTrue($arraytoprint[$i]['RoomService24Hours']);

                  $arraytoprint[$i]['RoomsWithBalcony'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['RoomsWithBalcony']['@attributes']['Ind'];
                  $arraytoprint[$i]['RoomsWithBalcony']=changeFalseTrue($arraytoprint[$i]['RoomsWithBalcony']);

                  $arraytoprint[$i]['RoomsWithBalcony'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['RoomsWithBalcony']['@attributes']['Ind'];
                  $arraytoprint[$i]['RoomsWithBalcony']=changeFalseTrue($arraytoprint[$i]['RoomsWithBalcony']);

                  $arraytoprint[$i]['SmokeFree'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SmokeFree']['@attributes']['Ind'];
                  $arraytoprint[$i]['SmokeFree']=changeFalseTrue($arraytoprint[$i]['SmokeFree']);

                  $arraytoprint[$i]['SmokingRoomsAvail'] = $value['BasicPropertyInfo']['PropertyOptionInfo']['SmokingRoomsAvail']['@attributes']['Ind'];
                  $arraytoprint[$i]['SmokingRoomsAvail']=changeFalseTrue($arraytoprint[$i]['SmokingRoomsAvail']);



                  $arraytoprint[$i]['WholeData'] = $value;

                  $hotelcodes[$i] = $value['BasicPropertyInfo']['@attributes']['HotelCode']; 
                  
                  $i++;  
                }
              }



              if(isset($_REQUEST['amenities']) && $_REQUEST['amenities'])
              {   
           
                 $tempamenities = explode("-", $_REQUEST['amenities']); 
                 unset($tempamenities[0]);
                 $_REQUEST['amenities'] =  $tempamenities;
          
                  $stringtopass = '';  
                  $z=0;
                  foreach ($_REQUEST['amenities'] as $keyn => $valuen) {
                    if($z==0)
                    {
                      $stringtopass .= '$a["'.$valuen.'"] == 1';
                    }else
                    {
                      $stringtopass .= ' && $a["'.$valuen.'"] == 1';
                    }
                    $z++;  
                  }

      
                  $_SESSION['stringtopasstocompare'] = $stringtopass;
                  $arraytoprint = array_filter($arraytoprint,function($a) { $xyz=$_SESSION['stringtopasstocompare']; if(eval("return $xyz;")){ return true; } else{ return false; } });
                  $_SESSION['stringtopasstocompare'] = '';

                  if(is_array($arraytoprint))
                  {
                    $i=0;
                    $temparray = array();
                    foreach ($arraytoprint as $key => $value) 
                    {
                      $temparray[$i] = $value;
                      $i++;
                    }
                    $arraytoprint = $temparray;
                  }  
              }


              if(isset($_REQUEST['price']) && $_REQUEST['price'] != 'undefined')
              {   
                  

                 $_REQUEST['price'] = str_replace("$", "", $_REQUEST['price']);
                 $_REQUEST['price'] = str_replace(" ", "", $_REQUEST['price']);

                 $tempamenities = explode("-", $_REQUEST['price']); 
                
                 $_REQUEST['price'] =  $tempamenities;
                  
                $_SESSION['pricemin'] = current($_REQUEST['price']);
                $_SESSION['pricemax'] = next($_REQUEST['price']);

                  $arraytoprint = array_filter($arraytoprint,function($a) { if($a['Rate'] >= $_SESSION['pricemin'] && $a['Rate'] <= $_SESSION['pricemax']){ return true; }else{ return false; } });
                  
                $_SESSION['pricemin'] = "";
                $_SESSION['pricemax'] = "";                

                  if(is_array($arraytoprint))
                  {
                    $i=0;
                    $temparray = array();
                    foreach ($arraytoprint as $key => $value) 
                    {
                      $temparray[$i] = $value;
                      $i++;
                    }
                    $arraytoprint = $temparray;
                  }  
              }
              
              

              /*if($hotelcodes)
              {
                include_once 'soap_activities/HotelImageFinderSoapActivity.php';

                 $workflow = new Workflow(new HotelImageFinderSoapActivity($hotelcodes));
        
                  $resulthotelimg = $workflow->runWorkflow();

                  echo "<pre>"; print_r($resulthotelimg); die;
  
              }*/
//echo "<pre>"; print_r($arraytoprint); die;

              echo json_encode($arraytoprint);
              die;

             

              echo "<pre>"; print_r($arraybfmresponsearrayml); die;
        $counterforinoutflightarray = 0;
          foreach ($bfmtresultsml as $keyitinerary => $value) 
          {
                
                $fareinfo = $value['AirItineraryPricingInfo'];  
               
                $fareinfoforcabin = $fareinfo['FareInfos']['FareInfo'];
                //echo "<pre>"; print_r($fareinfoforcabin); die;
                $fareall = $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                $fareinfosimplefied = $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                if(!isset($fareinfosimplefied['PassengerFare']))
                {
                  //save all fares in variable
                  $ptcfarebreakdown = $fareinfosimplefied;

                  $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown'] = reset($fareinfosimplefied);
                  $pcode['ADT'] = 'adultfare';
                  $pcode['CNN'] = 'childfare';
                  $pcode['INF'] = 'infantfare';


                  foreach ($ptcfarebreakdown as $keyptc => $valueptc) 
                  {
                    
                    $codeptc = $valueptc['PassengerTypeQuantity']['@attributes']['Code'];
                    //isset is for infant as no tax or fare is comming
                    $taxptc = isset($valueptc['PassengerFare']['Taxes'])?$valueptc['PassengerFare']['Taxes']['TotalTax']['@attributes']['Amount']:0;
                    $fareptc = isset($valueptc['PassengerFare']['TotalFare'])?$valueptc['PassengerFare']['TotalFare']['@attributes']['Amount']:0;
                    $datatoaddbyamadeus[$keyitinerary][$pcode[$codeptc]]['fare']=$fareptc;
                    $datatoaddbyamadeus[$keyitinerary][$pcode[$codeptc]]['tax']=$taxptc;
                    //echo "<pre>"; print_r($valueptc); exit;    
                  }
                  //and change adt fare to after reset for normal processing
                  //echo "<pre>"; print_r($temp); die;
                }

                
                $fareinfosimplefied = $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown']['PassengerFare'];
                $value = $value['AirItinerary'];  
                
                $datatoaddbyamadeus[$keyitinerary]['adult'] = $passengercount;
                $datatoaddbyamadeus[$keyitinerary]['wholedataofamadeusoneitinerary'] = $value;
                $datatoaddbyamadeus[$keyitinerary]['whoami'] = "sabrebfm";
                $datatoaddbyamadeus[$keyitinerary]['fareall'] = $fareall;
                $datatoaddbyamadeus[$keyitinerary]['totalfare'] = $fareinfosimplefied['TotalFare']['@attributes']['Amount'];
                $datatoaddbyamadeus[$keyitinerary]['totaltax'] = $fareinfosimplefied['Taxes']['TotalTax']['@attributes']['Amount'];
                $datatoaddbyamadeus[$keyitinerary]['totalbeforetax'] = $fareinfosimplefied['FareConstruction']['@attributes']['Amount'];

                $counterfornoofflights = 1;
                  //outbound flights
                  
                $flightsegment = $value['OriginDestinationOptions']['OriginDestinationOption'];
                  
                $manyflightsegement = $flightsegment;

                
                $allmlflights = array(); 
                $counterml = 0;
                if($manyflightsegement)
                {
                  foreach ($manyflightsegement as $keyml => $valueml) 
                  {  

                     //case one outbound flighs have no of flights
                      if(isset($valueml['FlightSegment']) && isset($valueml['FlightSegment']['DepartureAirport'])) 
                      {
                        $allmlflights[$counterml] = $valueml;
                        $allmlflights[$counterml]['nooffl'] = 1;
                      //case two outbound flighs have one flight 
                      }elseif(isset($valueml['FlightSegment']) && isset($valueml['FlightSegment'][0]['DepartureAirport'])){ 

                        $allmlflights[$counterml] = $valueml['FlightSegment'];
                        $allmlflights[$counterml]['nooffl'] = count($valueml['FlightSegment']);
                      }
                    $counterml++;  
                  }
                }  

                

                /* outbound starts here */

                /* looping through flight segements start */
                $singleresult = $flightsegment;
                
                
                
                $outbound = $singleresult;
                
                //one way flight
                //case one outbound flighs have no of flights
                  if(isset($outbound['FlightSegment']) && isset($outbound['FlightSegment']['DepartureAirport'])) 
                  {

                    $outboundtochecknonstop = array(0=>$outbound['FlightSegment']);
                    $outbound = array(0=>$outbound['FlightSegment']);
                  //case two outbound flighs have one flight 
                  }elseif(isset($outbound['FlightSegment']) && isset($outbound['FlightSegment'][0]['DepartureAirport'])){ 
                    
                                       
                    $outbound = $outbound['FlightSegment'];
                  }


                //return flight  
                  //case one outbound flighs have no of flights
                  if(isset($outbound[0]['FlightSegment']) && isset($outbound[0]['FlightSegment']['DepartureAirport'])) //direct flight
                  {

                    $outboundtochecknonstop = array(0=>$outbound[0]['FlightSegment']);
                    $outbound = array(0=>$outbound[0]['FlightSegment']);
                  //case two outbound flighs have one flight 
                  }elseif(isset($outbound[0]['FlightSegment']) && isset($outbound[0]['FlightSegment'][0]['DepartureAirport'])){ //not direct flight
                    
                    $outbound = reset($singleresult);
                    
                    $outbound = $outbound['FlightSegment'];
                  }


                $inbound = isset($singleresult[1])?next($singleresult):array();

                if($inbound)
                {  
                  $inboundtochecknonstop = isset($singleresult[1])&&isset($inbound['FlightSegment'])&&isset($inbound['FlightSegment']['DepartureAirport'])?array(0=>$inbound['FlightSegment']):$inbound['FlightSegment'];
                  $inbound = isset($singleresult[1])&&isset($inbound['FlightSegment'])&&isset($inbound['FlightSegment']['DepartureAirport'])?array(0=>$inbound['FlightSegment']):$inbound['FlightSegment'];
                }  
                else
                {
                  $inboundtochecknonstop = array();
                  $inbound = array();

                }
             
                $datatoaddbyamadeus[$keyitinerary]['nonstoporwithstopoutbound'] = " Stop";
                $datatoaddbyamadeus[$keyitinerary]['nonstoporwithstopinbound'] = "Non Stop";

                $outboundml = $allmlflights;
                //filter for no of stops
                $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = 0;

                  $forfiltercheck = 1;
                  $counterforoutbound =0;
                 
                  foreach ($outboundml as $keymlsingle => $valuemlsingle) 
                  {
                    
                    /* run another loopto get all flight from ml one set on journey start */
                    $outbound = $outboundml;
                    if(count($valuemlsingle)>1)
                    {
                      $outbound = $valuemlsingle;
                    }

                    foreach ($outbound as $keyout => $valueout) 
                    {
                       
                        //echo "<pre>"; print_r($valueout); die;

                        if(isset($valueout['@attributes']['FlightNumber']))
                        {
                            
                            //for unique identification
                            $keyforflightno = 'outfn'.$keyout;
                            $datatoaddbyamadeus[$keyitinerary][$keyforflightno] = $valueout['@attributes']['FlightNumber'];
                        
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['operatingairlinecode'] = $valueout['OperatingAirline']['@attributes']['Code'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['counterfornoofflights'] = $counterfornoofflights;
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinefullname'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                            //$datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]; 
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $valueout['DepartureAirport']['@attributes']['LocationCode']; 
                   
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['destinationairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];

                            //getting each flight class
                            $saberclassarray = array();
                            $saberclassarray['P'] = strtoupper("Premium");

                            $saberclassarray['F'] = strtoupper("First");

                            $saberclassarray['J'] = strtoupper("Premium Business");

                            $saberclassarray['C'] = strtoupper("Business");

                            $saberclassarray['S'] = strtoupper("Premium Economy");

                            $saberclassarray['Y'] = "ECONOMY";
                            
                            $classofflight = isset($fareinfoforcabin[$keymlsingle])?$fareinfoforcabin[$keymlsingle]['TPA_Extensions']['Cabin']['@attributes']['Cabin']:"";
                           
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['travelclass'] = $classofflight!=""?$saberclassarray[$classofflight]:"";
                           
                            //layovertime
                              $layovertime=0;
                              $layovertimeinseconds=0;
                              //if outbound has count 1 means non connection flight means no layovertime
                              if(count($outbound)>1)
                              {
                                
                                  $currentflight =   $valueout;
                                  $nextflight = isset($outbound[$counterforoutbound+1])?$outbound[$counterforoutbound+1]:array();
                                  if($nextflight)
                                  {
                                    $currentflightarraiveat = strtotime($currentflight['@attributes']['ArrivalDateTime']);
                                    $nextflightdepartat = strtotime($nextflight['@attributes']['DepartureDateTime']); 
                                    $layovertime=$nextflightdepartat-$currentflightarraiveat;
                                    $layovertimeinseconds=$layovertime;
                                    $timearray = secondsToTime($layovertime);
                                    $layovertime  = reset($timearray)."h".next($timearray)."m";
                                  }
                                $counterforoutbound++;  
                              }

                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertime'] = $layovertime;
                           
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinecode'] = $valueout['MarketingAirline']['@attributes']['Code'];
                         
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightseq'] = $keyout+1; 
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['logoofmarketingairline'] = $valueout['MarketingAirline']['@attributes']['Code'].".png"; 
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['nameofmarketingairline'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departtime'] = $valueout['@attributes']['DepartureDateTime']; 
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departureairportfullname'] = isset($listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]:$valueout['DepartureAirport']['@attributes']['LocationCode'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivalairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivaltime'] = $valueout['@attributes']['ArrivalDateTime'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['stopornonstop'] = $outboundml[$keymlsingle]['nooffl']==1?"Non Stop":($outboundml[$keymlsingle]['nooffl']-1)." Stop";

                            
                           //echo "<pre>"; print_r($outboundml[$keymlsingle]['nooffl']); die;
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['returnorarrival'] = "outbound";
                            $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertimeinsec'] = $layovertimeinseconds;

                            //filter for no of stops
                            $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] + 1;

                            //layover time in sec for filter  
                            $datatoaddbyamadeus[$keyitinerary]['layovertimeinsec'][] = $layovertimeinseconds;

                            //gathering data for array unique
                            $datatoaddbyamadeus[$keyitinerary]['flightnoarray'][] = $valueout['@attributes']['FlightNumber'];  
                            $datatoaddbyamadeus[$keyitinerary]['marketingairlinearray'][] = $valueout['MarketingAirline']['@attributes']['Code'];  
                            $datatoaddbyamadeus[$keyitinerary]['originarray'][] = $valueout['DepartureAirport']['@attributes']['LocationCode'];
                            $datatoaddbyamadeus[$keyitinerary]['destinationarray'][] = $valueout['ArrivalAirport']['@attributes']['LocationCode'];  

                            if($forfiltercheck==1)
                            {  
                              //filter for departure date
                              $datatoaddbyamadeus[$keyitinerary]['outdeparturedate'] = strtotime($valueout['@attributes']['DepartureDateTime']);
                              $datatoaddbyamadeus[$keyitinerary]['marketingairlinecodeout'] = $valueout['MarketingAirline']['@attributes']['Code'];
                            }
                            
                            $forfiltercheck++;
                            $counterforinoutflightarray++;
                            $counterfornoofflights++;
                        }//if ends check attribute flight number exists  

                      }  
                    /* run another loopto get all flight from ml one set on journey ends */  
                   
                  }//foreach out bound ends here

                // echo "<pre>"; print_r($datatoaddbyamadeus); die; 
                  /* outbound ends here */



                     //loop for inbound flights  
                  $forfiltercheck  = 0;
                  $counterforoutbound =0;
                  $inbound = array();
                  foreach ($inbound as $keyout => $valueout) 
                  {
                  
                    //for unique identification
                    $keyforflightno = 'infn'.$keyout;
                    $datatoaddbyamadeus[$keyitinerary][$keyforflightno] = $valueout['@attributes']['FlightNumber'];


                     
                  $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['operatingairlinecode'] = $valueout['OperatingAirline']['@attributes']['Code'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['counterfornoofflights'] = $counterfornoofflights;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinefullname'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                    //$datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $valueout['DepartureAirport']['@attributes']['LocationCode']; 
           
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['destinationairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];

                     //getting each flight class
                    $saberclassarray = array();
                    $saberclassarray['P'] = strtoupper("Premium");

                    $saberclassarray['F'] = strtoupper("First");

                    $saberclassarray['J'] = strtoupper("Premium Business");

                    $saberclassarray['C'] = strtoupper("Business");

                    $saberclassarray['S'] = strtoupper("Premium Economy");

                    $saberclassarray['Y'] = "ECONOMY";
                    
                    $classofflight = isset($fareinfoforcabin[$keyout])?$fareinfoforcabin[$keyout]['TPA_Extensions']['Cabin']['@attributes']['Cabin']:"";

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['travelclass'] = $classofflight!=""?$saberclassarray[$classofflight]:"";
                   
                 
                       //layovertime
                      $layovertime=0;
                      $layovertimeinseconds=0;
                      //if outbound has count 1 means non connection flight means no layovertime
                      if(count($inbound)>1)
                      {
                        
                          $currentflight =   $valueout;
                          $nextflight = isset($inbound[$counterforoutbound+1])?$inbound[$counterforoutbound+1]:array();
                          if($nextflight)
                          {
                            $currentflightarraiveat = strtotime($currentflight['@attributes']['ArrivalDateTime']);
                            $nextflightdepartat = strtotime($nextflight['@attributes']['DepartureDateTime']); 
                            $layovertime=$nextflightdepartat-$currentflightarraiveat;
                            $layovertimeinseconds=$layovertime;
                            $timearray = secondsToTime($layovertime);
                            $layovertime  = reset($timearray)."h".next($timearray)."m";
                          }
                        $counterforoutbound++;  
                      }

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertime'] = $layovertime;
                   
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinecode'] = $valueout['MarketingAirline']['@attributes']['Code'];
                 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightseq'] = $keyout+1; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['logoofmarketingairline'] = $valueout['MarketingAirline']['@attributes']['Code'].".png"; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['nameofmarketingairline'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departtime'] = $valueout['@attributes']['DepartureDateTime']; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departureairportfullname'] = isset($listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]:$valueout['DepartureAirport']['@attributes']['LocationCode'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivalairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivaltime'] = $valueout['@attributes']['ArrivalDateTime'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['stopornonstop'] = count($inbound)==1?"Non Stop":(count($inbound)-1)." Stop";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['returnorarrival'] = "inbound";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertimeinsec'] = $layovertimeinseconds;

                    //filter for no of stops
                    $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] + 1;

                    //layover time in sec for filter  
                    $datatoaddbyamadeus[$keyitinerary]['layovertimeinsec'][] = $layovertimeinseconds;

                    //gathering data for array unique
                    $datatoaddbyamadeus[$keyitinerary]['flightnoarray'][] = $valueout['@attributes']['FlightNumber'];  
                    $datatoaddbyamadeus[$keyitinerary]['marketingairlinearray'][] = $valueout['MarketingAirline']['@attributes']['Code'];  
                    $datatoaddbyamadeus[$keyitinerary]['originarray'][] = $valueout['DepartureAirport']['@attributes']['LocationCode'];
                    $datatoaddbyamadeus[$keyitinerary]['destinationarray'][] = $valueout['ArrivalAirport']['@attributes']['LocationCode'];  
                                      

                     if($forfiltercheck==1)
                     {  
                       //filter for departure date
                       $datatoaddbyamadeus[$keyitinerary]['indeparturedate'] = strtotime($valueout['@attributes']['DepartureDateTime']);
                       $datatoaddbyamadeus[$keyitinerary]['marketingairlinecodein'] = $valueout['MarketingAirline']['@attributes']['Code'];

                     }
                    $forfiltercheck++;
                    $counterforinoutflightarray++;
                    $counterfornoofflights++;
                  }//inbound flights loop 
                  
                   $datatoaddbyamadeus[$keyitinerary]['totalflightcounter'] = $counterfornoofflights-1;
                
          }//for each for bfm results

          $mainarrayorresulresults['amadeusresult'] = array_merge($mainarrayorresulresults['amadeusresult'], $datatoaddbyamadeus);
          
      }//if ending $_REQUEST['origin1']

      /* code for multi city ends */

      //running saber api and getting results lead price calander and insta flights
      //insta flight is not searching class except economy and child and infant fares
      if(isset($donotruninstaflights) && isset($paramsforamadeus['travel_class']) && $paramsforamadeus['travel_class'] == 'ECONOMY'
         && isset($paramsforamadeus['children']) && $paramsforamadeus['children'] == 0 
         && isset($paramsforamadeus['infant']) && $paramsforamadeus['infant'] == 0)
      {
		    $result = $workflow->runWorkflow();
      }else{
        $result = array();
      }

		  $arrayofres = (array) $result;

		  if($arrayofres)
		  {
		   	
  			$bypassfirstelementofarray = reset($arrayofres);
  			$leadpricecalanderresult = $bypassfirstelementofarray['LeadPriceCalendar'];
        $resultofinstaflights = $bypassfirstelementofarray['InstaFlight'];

        if(!isset($resultofinstaflights->errorCode))
        { 
          $datatoaddbyamadeus = array();
          $instaflightresults = $resultofinstaflights->PricedItineraries;
          $counterforinoutflightarray = 0;
          foreach ($instaflightresults as $keyitinerary => $value) 
          {

                  $value = (array)$value;

                  $fareinfo = $value['AirItineraryPricingInfo'];  
                  $fareinfoforcabin = $fareinfo->FareInfos->FareInfo;
                 
                  $fareinfosimplefied = $fareinfo->PTC_FareBreakdowns->PTC_FareBreakdown->PassengerFare;
                  $value = $value['AirItinerary'];  
                  
                  $datatoaddbyamadeus[$keyitinerary]['adult'] = $passengercount;
                  $datatoaddbyamadeus[$keyitinerary]['wholedataofamadeusoneitinerary'] = $value;
                  $datatoaddbyamadeus[$keyitinerary]['whoami'] = "sabreinsta";
                  $datatoaddbyamadeus[$keyitinerary]['fareall'] = $fareinfo;
                  $datatoaddbyamadeus[$keyitinerary]['totalfare'] = $fareinfosimplefied->TotalFare->Amount;
                  $datatoaddbyamadeus[$keyitinerary]['totaltax'] = $fareinfosimplefied->Taxes->TotalTax->Amount;
                  $datatoaddbyamadeus[$keyitinerary]['totalbeforetax'] = $fareinfosimplefied->FareConstruction->Amount;
                  
                  $counterfornoofflights = 1;
                  //outbound flights
                  
                  $flightsegment = $value->OriginDestinationOptions->OriginDestinationOption;
                  
                  
                  $singleresult = $flightsegment;
                  $outbound = reset($singleresult);
                  $outboundtochecknonstop = $outbound;
                  $outbound = $outbound->FlightSegment;
                  $inbound = isset($singleresult[1])?next($singleresult):array();
                  $inboundtochecknonstop = $inbound; 
                  $inbound = isset($singleresult[1])?$inbound->FlightSegment:array();
                  
                  $datatoaddbyamadeus[$keyitinerary]['nonstoporwithstopoutbound'] = count($outboundtochecknonstop->FlightSegment)>1?(count($outboundtochecknonstop->FlightSegment)-1)." Stop":"Non Stop";
                  $datatoaddbyamadeus[$keyitinerary]['nonstoporwithstopinbound'] = count($inboundtochecknonstop->FlightSegment)>1?(count($inboundtochecknonstop->FlightSegment)-1)." Stop":"Non Stop";

                  $outboundcheckstopnonstop = $outboundtochecknonstop->FlightSegment;
                  $inboundstopnonstopcheck = $inboundtochecknonstop->FlightSegment;

                  //filter for no of stops
                  $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = 0;
                 
                  
                  $forfiltercheck=1;
                  $counterforoutbound =0;
                  foreach ($outbound as $keyout => $valueout) 
                  {
                    
                    //for unique identification
                    $keyforflightno = 'outfn'.$keyout;
                    $datatoaddbyamadeus[$keyitinerary][$keyforflightno] = $valueout->FlightNumber;

                     //print_r($outbound); die;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout->FlightNumber;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['operatingairlinecode'] = $valueout->OperatingAirline->Code;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['counterfornoofflights'] = $counterfornoofflights;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinefullname'] = isset($listofairports[$valueout->MarketingAirline->Code])?$listofairports[$valueout->MarketingAirline->Code]:$valueout->MarketingAirline->Code;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = isset($listwithcode[$valueout->DepartureAirport->LocationCode])?$listwithcode[$valueout->DepartureAirport->LocationCode]:$valueout->DepartureAirport->LocationCode; 
           
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['destinationairportfullname'] = isset($listwithcode[$valueout->ArrivalAirport->LocationCode])?$listwithcode[$valueout->ArrivalAirport->LocationCode]:$valueout->ArrivalAirport->LocationCode;

                    //getting each flight class
                    $saberclassarray = array();
                    $saberclassarray['P'] = strtoupper("PREMIUM ECONOMY");

                    $saberclassarray['F'] = strtoupper("FIRST");

                    $saberclassarray['J'] = strtoupper("Premium Business");

                    $saberclassarray['C'] = strtoupper("BUSINESS");

                    $saberclassarray['S'] = strtoupper("Premium Economy");

                    $saberclassarray['Y'] = "ECONOMY";

                    $classofflight = isset($fareinfoforcabin[$keyout])?$fareinfoforcabin[$keyout]->TPA_Extensions->Cabin->Cabin:"";

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['travelclass'] = $classofflight!=""?$saberclassarray[$classofflight]:"";
                   
                    $totaltimeinthisflightsegment = isset($singleresult[$counterforinoutflightarray])?$singleresult[$counterforinoutflightarray]->ElapsedTime:0;
                    
                      //layovertime
                      $layovertime=0;
                      $layovertimeinseconds=0;
                      //if outbound has count 1 means non connection flight means no layovertime
                    
                      if(count($outbound)>1)
                      {
                        
                          $currentflight =   $valueout;
                          $nextflight = isset($outbound[$counterforoutbound+1])?$outbound[$counterforoutbound+1]:array();
                      
                          if($nextflight)
                          {
                            $currentflightarraiveat = strtotime($currentflight->ArrivalDateTime);
                            $nextflightdepartat = strtotime($nextflight->DepartureDateTime); 
                            $layovertime=$nextflightdepartat-$currentflightarraiveat;
                            $layovertimeinseconds=$layovertime;
                            $timearray = secondsToTime($layovertime);
                            $layovertime  = reset($timearray)."h".next($timearray)."m";
                          }
                        $counterforoutbound++;  
                      }

                     
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertime'] = $layovertime;

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinecode'] = $valueout->MarketingAirline->Code;
                 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightseq'] = $keyout+1; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['logoofmarketingairline'] = $valueout->MarketingAirline->Code.".png"; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['nameofmarketingairline'] = isset($listofairports[$valueout->MarketingAirline->Code])?$listofairports[$valueout->MarketingAirline->Code]:$valueout->MarketingAirline->Code;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departtime'] = $valueout->DepartureDateTime; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departureairportfullname'] = isset($listwithcode[$valueout->DepartureAirport->LocationCode])?$listwithcode[$valueout->DepartureAirport->LocationCode]:$valueout->DepartureAirport->LocationCode;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivalairportfullname'] = isset($listwithcode[$valueout->ArrivalAirport->LocationCode])?$listwithcode[$valueout->ArrivalAirport->LocationCode]:$valueout->ArrivalAirport->LocationCode;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivaltime'] = $valueout->ArrivalDateTime;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout->FlightNumber;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['stopornonstop'] = count($outboundcheckstopnonstop)>1?(count($outboundcheckstopnonstop)-1)." Stop":"Non Stop";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['returnorarrival'] = "outbound";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertimeinsec'] = $layovertimeinseconds;

                    //filter for no of stops
                    $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] + 1;

                    //layover time in sec for filter  
                    $datatoaddbyamadeus[$keyitinerary]['layovertimeinsec'][] = $layovertimeinseconds;

                    //gathering data for array unique
                    $datatoaddbyamadeus[$keyitinerary]['flightnoarray'][] = $valueout->FlightNumber;  
                    $datatoaddbyamadeus[$keyitinerary]['marketingairlinearray'][] = $valueout->MarketingAirline->Code;  
                    $datatoaddbyamadeus[$keyitinerary]['originarray'][] = $valueout->DepartureAirport->LocationCode;
                    $datatoaddbyamadeus[$keyitinerary]['destinationarray'][] = $valueout->ArrivalAirport->LocationCode;


                    if($forfiltercheck==1)
                    {  
                      //filter for departure date
                      $datatoaddbyamadeus[$keyitinerary]['outdeparturedate'] = strtotime($valueout->DepartureDateTime);
                      $datatoaddbyamadeus[$keyitinerary]['marketingairlinecodeout'] = $valueout->MarketingAirline->Code;
                    }
                    
                    $forfiltercheck++;
                    $counterforinoutflightarray++;
                    $counterfornoofflights++;
                  }//outbound flights loop  

                  $forfiltercheck=1;
                  //loop for inbound flights  
                  $counterforoutbound =0;
                  foreach ($inbound as $keyout => $valueout) 
                  {
                    
                    //for unique identification
                    $keyforflightno = 'infn'.$keyout;
                    $datatoaddbyamadeus[$keyitinerary][$keyforflightno] = $valueout->FlightNumber;
                     
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout->FlightNumber;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['operatingairlinecode'] = $valueout->OperatingAirline->Code;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['counterfornoofflights'] = $counterfornoofflights;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinefullname'] = isset($listofairports[$valueout->MarketingAirline->Code])?$listofairports[$valueout->MarketingAirline->Code]:$valueout->MarketingAirline->Code;

                   $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = isset($listwithcode[$valueout->DepartureAirport->LocationCode])?$listwithcode[$valueout->DepartureAirport->LocationCode]:$valueout->DepartureAirport->LocationCode; 
           
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['destinationairportfullname'] = isset($listwithcode[$valueout->ArrivalAirport->LocationCode])?$listwithcode[$valueout->ArrivalAirport->LocationCode]:$valueout->ArrivalAirport->LocationCode;

                    //getting each flight class
                    $saberclassarray = array();
                    $saberclassarray['P'] = strtoupper("Premium");

                    $saberclassarray['F'] = strtoupper("First");

                    $saberclassarray['J'] = strtoupper("Premium Business");

                    $saberclassarray['C'] = strtoupper("Business");

                    $saberclassarray['S'] = strtoupper("Premium Economy");

                    $saberclassarray['Y'] = "ECONOMY";

                    $classofflight = isset($fareinfoforcabin[$keyout])?$fareinfoforcabin[$keyout]->TPA_Extensions->Cabin->Cabin:"";

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['travelclass'] = $classofflight!=""?$saberclassarray[$classofflight]:"";
                   
                    $totaltimeinthisflightsegment = isset($singleresult[$counterforinoutflightarray])?$singleresult[$counterforinoutflightarray]->ElapsedTime:0;
                   
                      //layovertime
                      $layovertime=0;
                      $layovertimeinseconds=0;
                      //if outbound has count 1 means non connection flight means no layovertime
                      if(count($inbound)>1)
                      {
                        
                          $currentflight =   $valueout;
                          $nextflight = isset($inbound[$counterforoutbound+1])?$inbound[$counterforoutbound+1]:array();
                          if($nextflight)
                          {
                            $currentflightarraiveat = strtotime($currentflight->ArrivalDateTime);
                            $nextflightdepartat = strtotime($nextflight->DepartureDateTime); 
                            $layovertime=$nextflightdepartat-$currentflightarraiveat;
                            $layovertimeinseconds=$layovertime;
                            $timearray = secondsToTime($layovertime);
                            $layovertime  = reset($timearray)."h".next($timearray)."m";
                          }
                        $counterforoutbound++;  
                      }

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertime'] = $layovertime;

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinecode'] = $valueout->MarketingAirline->Code;
                 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightseq'] = $keyout+1; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['logoofmarketingairline'] = $valueout->MarketingAirline->Code.".png"; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['nameofmarketingairline'] = isset($listofairports[$valueout->MarketingAirline->Code])?$listofairports[$valueout->MarketingAirline->Code]:$valueout->MarketingAirline->Code;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departtime'] = $valueout->DepartureDateTime; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departureairportfullname'] = isset($listwithcode[$valueout->DepartureAirport->LocationCode])?$listwithcode[$valueout->DepartureAirport->LocationCode]:$valueout->DepartureAirport->LocationCode;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivalairportfullname'] = isset($listwithcode[$valueout->ArrivalAirport->LocationCode])?$listwithcode[$valueout->ArrivalAirport->LocationCode]:$valueout->ArrivalAirport->LocationCode;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivaltime'] = $valueout->ArrivalDateTime;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout->FlightNumber;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['stopornonstop'] = count($inboundstopnonstopcheck)>1?(count($inboundstopnonstopcheck)-1)." Stop":"Non Stop";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['returnorarrival'] = "inbound";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertimeinsec'] = $layovertimeinseconds;

                    //filter for no of stops
                    $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] + 1;

                    //layover time in sec for filter  
                    $datatoaddbyamadeus[$keyitinerary]['layovertimeinsec'][] = $layovertimeinseconds;

                    //gathering data for array unique
                    $datatoaddbyamadeus[$keyitinerary]['flightnoarray'][] = $valueout->FlightNumber;  
                    $datatoaddbyamadeus[$keyitinerary]['marketingairlinearray'][] = $valueout->MarketingAirline->Code;  
                    $datatoaddbyamadeus[$keyitinerary]['originarray'][] = $valueout->DepartureAirport->LocationCode;
                    $datatoaddbyamadeus[$keyitinerary]['destinationarray'][] = $valueout->ArrivalAirport->LocationCode;


                    if($forfiltercheck==1)
                    {  
                      //filter for departure date
                      $datatoaddbyamadeus[$keyitinerary]['indeparturedate'] = strtotime($valueout->DepartureDateTime);
                      $datatoaddbyamadeus[$keyitinerary]['marketingairlinecodein'] = $valueout->MarketingAirline->Code;
                    }
                    
                    $forfiltercheck++;
                    $counterforinoutflightarray++;
                    $counterfornoofflights++;
                  }//inbound flights loop 
                 
                 $datatoaddbyamadeus[$keyitinerary]['totalflightcounter'] = $counterfornoofflights-1;
            
          }//for each ofinsta flights
        }//if instan flight error code
  			//echo json_encode($leadpricecalanderresult);
        //echo count($mainarrayorresulresults['amadeusresult']);
        //echo count($datatoaddbyamadeus);
        $mainarrayorresulresults['amadeusresult'] = array_merge($mainarrayorresulresults['amadeusresult'], $datatoaddbyamadeus);
        //echo count($mainarrayorresulresults['amadeusresult']);
        //print_r($datatoaddbyamadeus);

        
		  }//if arrayofres ends here


   
      //bargain finder max started

      include_once 'soap_activities/BargainFinderMaxSoapActivity.php';


      if(isset($origin) && $origin != "")
      {
        $workflow = new Workflow(new BargainFinderMaxSoapActivity());
        $resultbfm = $workflow->runWorkflow();

        $arrayofresbfm = (array) $resultbfm; 
      }else{
        $arrayofresbfm = array(); 
      }  

      if($arrayofresbfm)
      {

        $datatoaddbyamadeus = array();
       
        $bypassfirstelementofarraybfm = reset($arrayofresbfm);
         
        //echo "<pre>"; print_r($bypassfirstelementofarraybfm); die; 

        $requestofxmlbfm = $bypassfirstelementofarraybfm['BargainFinderMaxRQ'];
        
        $arraybfmrequestarray = XML2Array::createArray($requestofxmlbfm);

        $responseofbfm = $bypassfirstelementofarraybfm['BargainFinderMaxRS'];

        $arraybfmresponsearray = XML2Array::createArray($responseofbfm);
        
        $arraybfmresponsearray = reset($arraybfmresponsearray);  //[SOAP-ENV:Envelope]

        $arraybfmresponsearray = $arraybfmresponsearray['SOAP-ENV:Body'];
       
        $arraybfmresponsearray = reset($arraybfmresponsearray); // [OTA_AirLowFareSearchRS]
        
        if(isset($arraybfmresponsearray['PricedItineraries']))
        {  
          $arraybfmresponsearray = $arraybfmresponsearray['PricedItineraries']; 
          $arraybfmresponsearray = $arraybfmresponsearray['PricedItinerary']; 
          
          $bfmtresults = $arraybfmresponsearray;
        }else{ $bfmtresults = array(); }  

          $counterforinoutflightarray = 0;
          foreach ($bfmtresults as $keyitinerary => $value) 
          {
                
                $fareinfo = $value['AirItineraryPricingInfo'];  
               
                $fareinfoforcabin = $fareinfo['FareInfos']['FareInfo'];

                $fareall = $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                $fareinfosimplefied = $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];

                if(!isset($fareinfosimplefied['PassengerFare']))
                {
                  //save all fares in variable
                  $ptcfarebreakdown = $fareinfosimplefied;
                  $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown'] = reset($fareinfosimplefied);
                  $pcode['ADT'] = 'adultfare';
                  $pcode['CNN'] = 'childfare';
                  $pcode['INF'] = 'infantfare';
                  foreach ($ptcfarebreakdown as $keyptc => $valueptc) 
                  {
                    
                    $codeptc = $valueptc['PassengerTypeQuantity']['@attributes']['Code'];
                    //isset is for infant as no tax or fare is comming
                    $taxptc = isset($valueptc['PassengerFare']['Taxes'])?$valueptc['PassengerFare']['Taxes']['TotalTax']['@attributes']['Amount']:0;
                    $fareptc = isset($valueptc['PassengerFare']['TotalFare'])?$valueptc['PassengerFare']['TotalFare']['@attributes']['Amount']:0;
                    $datatoaddbyamadeus[$keyitinerary][$pcode[$codeptc]]['fare']=$fareptc;
                    $datatoaddbyamadeus[$keyitinerary][$pcode[$codeptc]]['tax']=$taxptc;
                    //echo "<pre>"; print_r($valueptc); exit;    
                  }
                  //and change adt fare to after reset for normal processing
                  //echo "<pre>"; print_r($temp); die;
                }
                $fareinfosimplefied = $fareinfo['PTC_FareBreakdowns']['PTC_FareBreakdown']['PassengerFare'];
                $value = $value['AirItinerary'];  
                
                $datatoaddbyamadeus[$keyitinerary]['adult'] = $passengercount;
                $datatoaddbyamadeus[$keyitinerary]['wholedataofamadeusoneitinerary'] = $value;
                $datatoaddbyamadeus[$keyitinerary]['whoami'] = "sabrebfm";
                $datatoaddbyamadeus[$keyitinerary]['fareall'] = $fareall;
                $datatoaddbyamadeus[$keyitinerary]['totalfare'] = $fareinfosimplefied['TotalFare']['@attributes']['Amount'];
                $datatoaddbyamadeus[$keyitinerary]['totaltax'] = $fareinfosimplefied['Taxes']['TotalTax']['@attributes']['Amount'];
                $datatoaddbyamadeus[$keyitinerary]['totalbeforetax'] = $fareinfosimplefied['FareConstruction']['@attributes']['Amount'];

                $counterfornoofflights = 1;
                  //outbound flights
                  
                $flightsegment = $value['OriginDestinationOptions']['OriginDestinationOption'];
                  
                 
                $singleresult = $flightsegment;
                
                
                
                $outbound = $singleresult;
              
                //one way flight
                //case one outbound flighs have no of flights
                  if(isset($outbound['FlightSegment']) && isset($outbound['FlightSegment']['DepartureAirport'])) //direct flight
                  {

                    $outboundtochecknonstop = array(0=>$outbound['FlightSegment']);
                    $outbound = array(0=>$outbound['FlightSegment']);
                  //case two outbound flighs have one flight 
                  }elseif(isset($outbound['FlightSegment']) && isset($outbound['FlightSegment'][0]['DepartureAirport'])){ //not direct flight
                    
                                       
                    $outbound = $outbound['FlightSegment'];
                  }
                //return flight  
                  //case one outbound flighs have no of flights
                  if(isset($outbound[0]['FlightSegment']) && isset($outbound[0]['FlightSegment']['DepartureAirport'])) //direct flight
                  {

                    $outboundtochecknonstop = array(0=>$outbound[0]['FlightSegment']);
                    $outbound = array(0=>$outbound[0]['FlightSegment']);
                  //case two outbound flighs have one flight 
                  }elseif(isset($outbound[0]['FlightSegment']) && isset($outbound[0]['FlightSegment'][0]['DepartureAirport'])){ //not direct flight
                    
                    $outbound = reset($singleresult);
                    
                    $outbound = $outbound['FlightSegment'];
                  }


                $inbound = isset($singleresult[1])?next($singleresult):array();//yes reaturn flight there

                if($inbound)
                {  
                  $inboundtochecknonstop = isset($singleresult[1])&&isset($inbound['FlightSegment'])&&isset($inbound['FlightSegment']['DepartureAirport'])?array(0=>$inbound['FlightSegment']):$inbound['FlightSegment'];
                  $inbound = isset($singleresult[1])&&isset($inbound['FlightSegment'])&&isset($inbound['FlightSegment']['DepartureAirport'])?array(0=>$inbound['FlightSegment']):$inbound['FlightSegment'];
                }  
                else
                {
                  $inboundtochecknonstop = array();
                  $inbound = array();

                }
             
                $datatoaddbyamadeus[$keyitinerary]['nonstoporwithstopoutbound'] = " Stop";
                $datatoaddbyamadeus[$keyitinerary]['nonstoporwithstopinbound'] = "Non Stop";

                //filter for no of stops
                $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = 0;

                  $forfiltercheck = 1;
                  $counterforoutbound =0;
                  foreach ($outbound as $keyout => $valueout) 
                  {
                    
                    if(isset($valueout['@attributes']['FlightNumber']))
                    {
                        
                        //for unique identification
                        $keyforflightno = 'outfn'.$keyout;
                        $datatoaddbyamadeus[$keyitinerary][$keyforflightno] = $valueout['@attributes']['FlightNumber'];
                    
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['operatingairlinecode'] = $valueout['OperatingAirline']['@attributes']['Code'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['counterfornoofflights'] = $counterfornoofflights;
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinefullname'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                        //$datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]; 
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $valueout['DepartureAirport']['@attributes']['LocationCode']; 
               
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['destinationairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];

                        //getting each flight class
                        $saberclassarray = array();
                        $saberclassarray['P'] = strtoupper("Premium");

                        $saberclassarray['F'] = strtoupper("First");

                        $saberclassarray['J'] = strtoupper("Premium Business");

                        $saberclassarray['C'] = strtoupper("Business");

                        $saberclassarray['S'] = strtoupper("Premium Economy");

                        $saberclassarray['Y'] = "ECONOMY";
                        
                        $classofflight = isset($fareinfoforcabin[$keyout])?$fareinfoforcabin[$keyout]['TPA_Extensions']['Cabin']['@attributes']['Cabin']:"";

                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['travelclass'] = $classofflight!=""?$saberclassarray[$classofflight]:"";
                       
                        //layovertime
                          $layovertime=0;
                          $layovertimeinseconds=0;
                          //if outbound has count 1 means non connection flight means no layovertime
                          if(count($outbound)>1)
                          {
                            
                              $currentflight =   $valueout;
                              $nextflight = isset($outbound[$counterforoutbound+1])?$outbound[$counterforoutbound+1]:array();
                              if($nextflight)
                              {
                                $currentflightarraiveat = strtotime($currentflight['@attributes']['ArrivalDateTime']);
                                $nextflightdepartat = strtotime($nextflight['@attributes']['DepartureDateTime']); 
                                $layovertime=$nextflightdepartat-$currentflightarraiveat;
                                $layovertimeinseconds=$layovertime;
                                $timearray = secondsToTime($layovertime);
                                $layovertime  = reset($timearray)."h".next($timearray)."m";
                              }
                            $counterforoutbound++;  
                          }

                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertime'] = $layovertime;
                       
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinecode'] = $valueout['MarketingAirline']['@attributes']['Code'];
                     
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightseq'] = $keyout+1; 
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['logoofmarketingairline'] = $valueout['MarketingAirline']['@attributes']['Code'].".png"; 
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['nameofmarketingairline'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departtime'] = $valueout['@attributes']['DepartureDateTime']; 
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departureairportfullname'] = isset($listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]:$valueout['DepartureAirport']['@attributes']['LocationCode'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivalairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivaltime'] = $valueout['@attributes']['ArrivalDateTime'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['stopornonstop'] = count($outbound)==1?"Non Stop":(count($outbound)-1)." Stop";
                       
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['returnorarrival'] = "outbound";
                        $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertimeinsec'] = $layovertimeinseconds;

                        //filter for no of stops
                        $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] + 1;

                        //layover time in sec for filter  
                        $datatoaddbyamadeus[$keyitinerary]['layovertimeinsec'][] = $layovertimeinseconds;

                        //gathering data for array unique
                        $datatoaddbyamadeus[$keyitinerary]['flightnoarray'][] = $valueout['@attributes']['FlightNumber'];  
                        $datatoaddbyamadeus[$keyitinerary]['marketingairlinearray'][] = $valueout['MarketingAirline']['@attributes']['Code'];  
                        $datatoaddbyamadeus[$keyitinerary]['originarray'][] = $valueout['DepartureAirport']['@attributes']['LocationCode'];
                        $datatoaddbyamadeus[$keyitinerary]['destinationarray'][] = $valueout['ArrivalAirport']['@attributes']['LocationCode'];  

                        if($forfiltercheck==1)
                        {  
                          //filter for departure date
                          $datatoaddbyamadeus[$keyitinerary]['outdeparturedate'] = strtotime($valueout['@attributes']['DepartureDateTime']);
                          $datatoaddbyamadeus[$keyitinerary]['marketingairlinecodeout'] = $valueout['MarketingAirline']['@attributes']['Code'];
                        }
                        
                        $forfiltercheck++;
                        $counterforinoutflightarray++;
                        $counterfornoofflights++;
                    }//if ends check attribute flight number exists    
                   
                  }//foreach out bound ends here


                     //loop for inbound flights  
                  $forfiltercheck  = 0;
                  $counterforoutbound =0;
                  foreach ($inbound as $keyout => $valueout) 
                  {
                  
                    //for unique identification
                    $keyforflightno = 'infn'.$keyout;
                    $datatoaddbyamadeus[$keyitinerary][$keyforflightno] = $valueout['@attributes']['FlightNumber'];


                     
                  $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['operatingairlinecode'] = $valueout['OperatingAirline']['@attributes']['Code'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['counterfornoofflights'] = $counterfornoofflights;
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinefullname'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                    //$datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['originairportfullname'] = $valueout['DepartureAirport']['@attributes']['LocationCode']; 
           
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['destinationairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];

                     //getting each flight class
                    $saberclassarray = array();
                    $saberclassarray['P'] = strtoupper("Premium");

                    $saberclassarray['F'] = strtoupper("First");

                    $saberclassarray['J'] = strtoupper("Premium Business");

                    $saberclassarray['C'] = strtoupper("Business");

                    $saberclassarray['S'] = strtoupper("Premium Economy");

                    $saberclassarray['Y'] = "ECONOMY";
                    
                    $classofflight = isset($fareinfoforcabin[$keyout])?$fareinfoforcabin[$keyout]['TPA_Extensions']['Cabin']['@attributes']['Cabin']:"";

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['travelclass'] = $classofflight!=""?$saberclassarray[$classofflight]:"";
                   
                 
                       //layovertime
                      $layovertime=0;
                      $layovertimeinseconds=0;
                      //if outbound has count 1 means non connection flight means no layovertime
                      if(count($inbound)>1)
                      {
                        
                          $currentflight =   $valueout;
                          $nextflight = isset($inbound[$counterforoutbound+1])?$inbound[$counterforoutbound+1]:array();
                          if($nextflight)
                          {
                            $currentflightarraiveat = strtotime($currentflight['@attributes']['ArrivalDateTime']);
                            $nextflightdepartat = strtotime($nextflight['@attributes']['DepartureDateTime']); 
                            $layovertime=$nextflightdepartat-$currentflightarraiveat;
                            $layovertimeinseconds=$layovertime;
                            $timearray = secondsToTime($layovertime);
                            $layovertime  = reset($timearray)."h".next($timearray)."m";
                          }
                        $counterforoutbound++;  
                      }

                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertime'] = $layovertime;
                   
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['marketingairlinecode'] = $valueout['MarketingAirline']['@attributes']['Code'];
                 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightseq'] = $keyout+1; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['logoofmarketingairline'] = $valueout['MarketingAirline']['@attributes']['Code'].".png"; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['nameofmarketingairline'] = isset($listofairports[$valueout['MarketingAirline']['@attributes']['Code']])?$listofairports[$valueout['MarketingAirline']['@attributes']['Code']]:$valueout['MarketingAirline']['@attributes']['Code'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departtime'] = $valueout['@attributes']['DepartureDateTime']; 
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['departureairportfullname'] = isset($listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['DepartureAirport']['@attributes']['LocationCode']]:$valueout['DepartureAirport']['@attributes']['LocationCode'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivalairportfullname'] = isset($listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']])?$listwithcode[$valueout['ArrivalAirport']['@attributes']['LocationCode']]:$valueout['ArrivalAirport']['@attributes']['LocationCode'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['arrivaltime'] = $valueout['@attributes']['ArrivalDateTime'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['flightno'] = $valueout['@attributes']['FlightNumber'];
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['stopornonstop'] = count($inbound)==1?"Non Stop":(count($inbound)-1)." Stop";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['returnorarrival'] = "inbound";
                    $datatoaddbyamadeus[$keyitinerary]['inoutflightarr'][$counterforinoutflightarray]['layovertimeinsec'] = $layovertimeinseconds;

                    //filter for no of stops
                    $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] = $datatoaddbyamadeus[$keyitinerary]['filternoofstops'] + 1;

                    //layover time in sec for filter  
                    $datatoaddbyamadeus[$keyitinerary]['layovertimeinsec'][] = $layovertimeinseconds;

                    //gathering data for array unique
                    $datatoaddbyamadeus[$keyitinerary]['flightnoarray'][] = $valueout['@attributes']['FlightNumber'];  
                    $datatoaddbyamadeus[$keyitinerary]['marketingairlinearray'][] = $valueout['MarketingAirline']['@attributes']['Code'];  
                    $datatoaddbyamadeus[$keyitinerary]['originarray'][] = $valueout['DepartureAirport']['@attributes']['LocationCode'];
                    $datatoaddbyamadeus[$keyitinerary]['destinationarray'][] = $valueout['ArrivalAirport']['@attributes']['LocationCode'];  
                                      

                     if($forfiltercheck==1)
                     {  
                       //filter for departure date
                       $datatoaddbyamadeus[$keyitinerary]['indeparturedate'] = strtotime($valueout['@attributes']['DepartureDateTime']);
                       $datatoaddbyamadeus[$keyitinerary]['marketingairlinecodein'] = $valueout['MarketingAirline']['@attributes']['Code'];

                     }
                    $forfiltercheck++;
                    $counterforinoutflightarray++;
                    $counterfornoofflights++;
                  }//inbound flights loop 
                  
                   $datatoaddbyamadeus[$keyitinerary]['totalflightcounter'] = $counterfornoofflights-1;
                
          }//for each for bfm results
        

         $mainarrayorresulresults['amadeusresult'] = array_merge($mainarrayorresulresults['amadeusresult'], $datatoaddbyamadeus);        
      }//if bmf $arrayofresbfm if ends here


      //bargain finder max ends
//echo "<pre>"; print_r($mainarrayorresulresults['amadeusresult']); die;        
        //remove duplicate flights
        //$mainarrayorresulresults['amadeusresult']= super_unique($mainarrayorresulresults['amadeusresult']);
        //$mainarrayorresulresults['amadeusresult'] = array_unique($mainarrayorresulresults['amadeusresult']);
//echo "<pre>"; print_r($mainarrayorresulresults['amadeusresult']); die;


      //login to make array unique starts here
      if($mainarrayorresulresults['amadeusresult'])
      {
        $arraytomakeunique = array();
        foreach ($mainarrayorresulresults['amadeusresult'] as $key => $value) 
        {

           if(isset($value["indeparturedate"]) && isset($value["marketingairlinecodein"]) )
           { 
            $arraytomakeunique[$key] = array($value["totalfare"],$value["totaltax"],$value["filternoofstops"],$value["flightnoarray"],$value["marketingairlinearray"],$value["outdeparturedate"],$value["indeparturedate"],$value["marketingairlinecodeout"],$value["marketingairlinecodein"]);
          }
          else
          {
            $arraytomakeunique[$key] = array($value["totalfare"],$value["totaltax"],$value["filternoofstops"],$value["flightnoarray"],$value["marketingairlinearray"],$value["outdeparturedate"],$value["marketingairlinecodeout"]);
          }
            
           

        }

      }
      //make array unique
      //$mainarrayorresulresults['amadeusresult'] = array_unique($mainarrayorresulresults['amadeusresult'], SORT_REGULAR);

      if(isset($arraytomakeunique))
      {
        
        $arrayafterunique = array();

        $arrayafterunique = array_unique($arraytomakeunique, SORT_REGULAR);  

        if($arrayafterunique)
        {
          $arraytoprintafteruniqueaminarray = array();
          foreach ($arrayafterunique as $key => $value) {
            
            
            $arraytoprintafteruniqueaminarray['amadeusresult'][] = $mainarrayorresulresults['amadeusresult'][$key];

          }

          $mainarrayorresulresults['amadeusresult'] = $arraytoprintafteruniqueaminarray['amadeusresult'];

        }

      }
      
      //login to make array unique ends here



     



        if(isset($outboundflightstops) && $outboundflightstops != "")
        {
          
          if($outboundflightstops == 0)
          {
//filter for non stop            
$mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { return $a['filternoofstops'] <= 2;});
          }
          elseif($outboundflightstops == 1)
          {
//filter for 1 stop
$mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { return $a['filternoofstops'] <= 4;});
          }
          elseif($outboundflightstops == 2)
          {

//filter for 2 stop
$mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { return $a['filternoofstops'] <= 6;});
          }
          elseif($outboundflightstops == 3)
          {
//filter for 3 stop
$mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { return $a['filternoofstops'] <= 8;});

          }
          elseif($outboundflightstops == 4)
          {
//filter for 4 stop
$mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { return $a['filternoofstops'] <= 10;});
          }
        
  
        }  
       






      //filter for departure time  
      if(isset($outbounddeparturewindow) && $outbounddeparturewindow != "")
      {
        $str = substr($outbounddeparturewindow,4,4);
        $lowerstr = substr($outbounddeparturewindow,0,4);
        $time = $str;
        $time = substr($time,0,2).':'.substr($time,2,2);

        $timelow = $lowerstr;
        $timelow = substr($timelow,0,2).':'.substr($timelow,2,2);
        
        //console.log(output);
        $filterdatelow = $departuredate ."T". $timelow;

        $filterdatelow = strtotime($filterdatelow);
        $_SESSION['filterdatelow'] = $filterdatelow;

        //console.log(output);
        $filterdate = $departuredate ."T". $time;

        $filterdate = strtotime($filterdate);
        $_SESSION['filterdate'] = $filterdate;
//outdeparturedate
//indeparturedate
$mainarrayorresulresults['filterdate'] =   $filterdate;      
$mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { 
 if(isset($a['indeparturedate'])){ return (( $a['outdeparturedate'] >=$_SESSION['filterdatelow'] && $a['outdeparturedate'] <= $_SESSION['filterdate']) || ($a['indeparturedate']>=$_SESSION['filterdatelow']&&$a['indeparturedate'] <= $_SESSION['filterdate'])); }else{
  return ($a['outdeparturedate']>=$_SESSION['filterdatelow']&&$a['outdeparturedate'] <= $_SESSION['filterdate']);
 }
});
        $_SESSION['filterdate'] = "";
        $_SESSION['filterdatelow']  = "";
      } 
       
        
     
      //filter for flight carrier
      //$includedcarriers 
      if(isset($includedcarriers) && $includedcarriers!="")
      {

        $arrayofcarrier = explode(",", $includedcarriers);
        $_SESSION['arrayofcarrier'] = $arrayofcarrier;
        
        $mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { 
        if(isset($a['marketingairlinecodein'])){ return (in_array($a['marketingairlinecodeout'], $_SESSION['arrayofcarrier']) && in_array($a['marketingairlinecodein'], $_SESSION['arrayofcarrier'])); }else{ return (in_array($a['marketingairlinecodeout'], $_SESSION['arrayofcarrier'])); }
        });

        $_SESSION['arrayofcarrier'] = "";
      }  

      //filter for lay over time
      if(isset($inboundstopduration) && $inboundstopduration!="")
      {

        $_SESSION['layovertimeinseconds'] = $inboundstopduration * 3600;

        //layovertimeinsec
        $mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { 
        return (isset($a['layovertimeinsec']) && $a['layovertimeinsec']!='0m' && (max($a['layovertimeinsec']) <=$_SESSION['layovertimeinseconds']));
        });

        $_SESSION['layovertimeinseconds'] = "";
      }  


        //sort by price
        $price = array();
        foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
        {
            
            $price[$key] = $row['totalfare'];
        }
        array_multisort($price, SORT_ASC, $mainarrayorresulresults['amadeusresult']);

        if(isset($sortingvalue)&&$sortingvalue!= "")
        {
          if($sortingvalue == "high-to-low-price")
          {
            //sort by price
            $price = array();
            foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
            {
                
                $price[$key] = $row['totalfare'];
            }
            array_multisort($price, SORT_DESC, $mainarrayorresulresults['amadeusresult']);

          }
          elseif($sortingvalue == "low-to-high-price")
          {
            //sort by price
            $price = array();
            foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
            {
                
                $price[$key] = $row['totalfare'];
            }
            array_multisort($price, SORT_ASC, $mainarrayorresulresults['amadeusresult']);
            
          }
          elseif($sortingvalue == "waiting-duration-up")
          {
            //sort by waiting
            $waitingtime = array();
            foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
            {
                if(isset($row['layovertimeinsec']))
                {
                  $waitingtime[$key] = max($row['layovertimeinsec']);  
                }
                
                
            }
            array_multisort($waitingtime, SORT_ASC, $mainarrayorresulresults['amadeusresult']);
          }
          elseif($sortingvalue == "waiting-duration-dn")
          {

            //sort by price
            $waitingtime = array();
            foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
            {
                if(isset($row['layovertimeinsec']))
                {
                  $waitingtime[$key] = max($row['layovertimeinsec']);  
                }
               
                
            }
            array_multisort($waitingtime, SORT_DESC, $mainarrayorresulresults['amadeusresult']);
            
          }
          elseif($sortingvalue == "noofstopsasc")
          {

             //sort by price
            $noofstops = array();
            foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
            {
                if(isset($row['filternoofstops']))
                {
                  $noofstops[$key] = $row['filternoofstops'];  
                }
               
                
            }
            array_multisort($noofstops, SORT_ASC, $mainarrayorresulresults['amadeusresult']);
            
          }
          elseif($sortingvalue == "noofstopsdecs")
          {
              //sort by price
            $noofstops = array();
            foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
            {
                if(isset($row['filternoofstops']))
                {
                  $noofstops[$key] = $row['filternoofstops'];  
                }
               
                
            }
            array_multisort($noofstops, SORT_DESC, $mainarrayorresulresults['amadeusresult']);
          }
        }




        echo json_encode($mainarrayorresulresults);

        //$new = array_filter($old,function($a) {return $a >= 6;});
die;
/////////////////////////////////////////////////////////////////////////////////////////////////////////

 $price = array();
        foreach ($mainarrayorresulresults['amadeusresult'] as $key => $row)
        {
            
            $price[$key] = $row['totalfare'];
        }
        array_multisort($price, SORT_ASC, $mainarrayorresulresults['amadeusresult']);
        //echo json_encode($mainarrayorresulresults);

        $mainarrayorresulresults['amadeusresult'] = array_filter($mainarrayorresulresults['amadeusresult'],function($a) { return $a['filternoofstops'] <= 222;});

        echo json_encode($mainarrayorresulresults);
die;

      //Bargain BargainFinderMax start
      //include_once 'workflow/Workflow.php';
      include_once 'soap_activities/BargainFinderMaxSoapActivity.php';


      $workflow = new Workflow(new BargainFinderMaxSoapActivity());
      $resultbfm = $workflow->runWorkflow();

      $arrayofresbfm = (array) $resultbfm;
      if($arrayofresbfm)
      {

       
        $bypassfirstelementofarraybfm = reset($arrayofresbfm);
         

        $requestofxmlbfm = $bypassfirstelementofarraybfm['BargainFinderMaxRQ'];
        
        $arraybfmrequestarray = XML2Array::createArray($requestofxmlbfm);

        $responseofbfm = $bypassfirstelementofarraybfm['BargainFinderMaxRS'];

        $arraybfmresponsearray = XML2Array::createArray($responseofbfm);
        
        echo "<pre>";
        print_r($arraybfmresponsearray);
        die;
        print_r($bypassfirstelementofarraybfm); 
        echo "xml printing here";

        die;
      }
      
      //Bargain BargainFinderMax ends

//print_r($result{'results:SharedContext:private'}['LeadPriceCalendar']);
//print_r($result['results:SharedContext:private']['InstaFlight']);
//print_r($result['results:SharedContext:private']['BargainFinderMax']);


die;
/*ob_start();
var_dump($result);
$dump = ob_get_clean();
echo $dump;
flush();*/


function super_unique($array)
{
  $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

  foreach ($result as $key => $value)
  {
    if ( is_array($value) )
    {
      $result[$key] = super_unique($value);
    }
  }

  return $result;
}


function getamadeus($url, $params=array()) 
{	
    
    $url = $url.'?'.http_build_query($params, '', '&');
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
    $response = curl_exec($ch);
    
    curl_close($ch);
    
    return $response;
}


function secondsToTime($seconds) {

  // extract hours
  $hours = floor($seconds / (60 * 60));

  // extract minutes
  $divisor_for_minutes = $seconds % (60 * 60);
  $minutes = floor($divisor_for_minutes / 60);

  // extract the remaining seconds
  $divisor_for_seconds = $divisor_for_minutes % 60;
  $seconds = ceil($divisor_for_seconds);

  // return the final array
  $obj = array(
      "h" => (int) $hours,
      "m" => (int) $minutes,
      "s" => (int) $seconds,
   );

  return $obj;
}

/**
 * XML2Array: A class to convert XML to array in PHP
 * It returns the array which can be converted back to XML using the Array2XML script
 * It takes an XML string or a DOMDocument object as an input.
 *
 * See Array2XML: http://www.lalit.org/lab/convert-php-array-to-xml-with-attributes
 *
 * Author : Lalit Patel
 * Website: http://www.lalit.org/lab/convert-xml-to-array-in-php-xml2array
 * License: Apache License 2.0
 *          http://www.apache.org/licenses/LICENSE-2.0
 * Version: 0.1 (07 Dec 2011)
 * Version: 0.2 (04 Mar 2012)
 *      Fixed typo 'DomDocument' to 'DOMDocument'
 *
 * Usage:
 *       $array = XML2Array::createArray($xml);
 */

class XML2Array {

    private static $xml = null;
  private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DOMDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
    self::$encoding = $encoding;
    }

    /**
     * Convert an XML to Array
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMDocument
     */
    public static function &createArray($input_xml) {
        $xml = self::getXMLRoot();
    if(is_string($input_xml)) {
      $parsed = $xml->loadXML($input_xml);
      if(!$parsed) {
        throw new Exception('[XML2Array] Error parsing the XML string.');
      }
    } else {
      if(get_class($input_xml) != 'DOMDocument') {
        throw new Exception('[XML2Array] The input XML object should be of type: DOMDocument.');
      }
      $xml = self::$xml = $input_xml;
    }
    $array[$xml->documentElement->tagName] = self::convert($xml->documentElement);
        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $array;
    }

    /**
     * Convert an Array to XML
     * @param mixed $node - XML as a string or as an object of DOMDocument
     * @return mixed
     */
    private static function &convert($node) {
    $output = array();

    switch ($node->nodeType) {
      case XML_CDATA_SECTION_NODE:
        $output['@cdata'] = trim($node->textContent);
        break;

      case XML_TEXT_NODE:
        $output = trim($node->textContent);
        break;

      case XML_ELEMENT_NODE:

        // for each child node, call the covert function recursively
        for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
          $child = $node->childNodes->item($i);
          $v = self::convert($child);
          if(isset($child->tagName)) {
            $t = $child->tagName;

            // assume more nodes of same kind are coming
            if(!isset($output[$t])) {
              $output[$t] = array();
            }
            $output[$t][] = $v;
          } else {
            //check if it is not an empty text node
            if($v !== '') {
              $output = $v;
            }
          }
        }

        if(is_array($output)) {
          // if only one node of its kind, assign it directly instead if array($value);
          foreach ($output as $t => $v) {
            if(is_array($v) && count($v)==1) {
              $output[$t] = $v[0];
            }
          }
          if(empty($output)) {
            //for empty nodes
            $output = '';
          }
        }

        // loop through the attributes and collect them
        if($node->attributes->length) {
          $a = array();
          foreach($node->attributes as $attrName => $attrNode) {
            $a[$attrName] = (string) $attrNode->value;
          }
          // if its an leaf node, store the value in @value instead of directly storing it.
          if(!is_array($output)) {
            $output = array('@value' => $output);
          }
          $output['@attributes'] = $a;
        }
        break;
    }
    return $output;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }
}


