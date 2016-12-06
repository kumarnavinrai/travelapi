<?php
include_once 'workflow/Activity.php';
include_once 'soap/SACSSoapClient.php';
include_once 'soap_activities/PassengerDetailsNameOnlyActivity.php';
include_once 'soap/XMLSerializer.php';

class HotelFinderSoapActivity implements Activity {

    private $config;
    
    public function __construct() {
        $this->config = SACSConfig::getInstance();
    }
    
    public function run(&$sharedContext) {
     

        $soapClient = new SACSSoapClient("OTA_HotelAvailLLSRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        
        $sharedContext->addResult("OTA_HotelAvailRQ", $xmlRequest);
        $sharedContext->addResult("OTA_HotelAvailRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
        //return new PassengerDetailsNameOnlyActivity();
    }

    //private function getRequest($origin1,$destination1,$departuredate1,$origin2,$destination2,$departuredate2,$origin3,$destination3,$departuredate3,$origin4,$destination4,$departuredate4,$origin5,$destination5,$departuredate5,$origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class) {
    private function getRequest() {
        
        
        if(isset($_REQUEST['origin']) && $_REQUEST['origin'] != "")
        {
          $origin = $_REQUEST['origin'];
          $arr = explode("(", $origin);
          $firstele = explode(")",$arr[1]);
          $secondele = explode(")",$arr[2]);
          $citycode = reset($firstele);
          $countrycode = reset($secondele);
          $start = explode("-", $_REQUEST['departureDate']);
          $start = next($start)."-".next($start);
          $end = explode("-", $_REQUEST['returndate']);
          $end = next($end)."-".next($end);
          $adult = $_REQUEST['adult'];


          $rtn = '<OTA_HotelAvailRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Version="2.2.1">
          <AvailRequestSegment>
          <GuestCounts Count="'.$adult.'"/>
          <HotelSearchCriteria>
          <Criterion>
          <Address>
          <CountryCode>'.$countrycode.'</CountryCode>
          </Address>
          <HotelRef HotelCityCode="'.$citycode.'"/>
          </Criterion>
          </HotelSearchCriteria>
          <TimeSpan End="'.$end.'" Start="'.$start.'"/>
          </AvailRequestSegment>
          </OTA_HotelAvailRQ>';

          return $rtn;
         }

         return null;                
      //getting each flight class
      $saberclassarray = array();
      $saberclassarray['PREMIUM_ECONOMY'] = 'S';
      $saberclassarray['FIRST'] = 'F';
      $saberclassarray['BUSINESS'] = 'C';
      $saberclassarray['ECONOMY'] = 'Y';
      $travel_class_to_pass = $saberclassarray[$travel_class];

      if(isset($donotrunthis) && $returndate == "")
      {  
        $onewayxml = '<OTA_AirLowFareSearchRQ Version="1.9.2"  xmlns="http://www.opentravel.org/OTA/2003/05">';
          $onewayxml .= '<POS>';
            $onewayxml .= '<Source PseudoCityCode="B30I" >';
              $onewayxml .= '<RequestorID ID="1" Type="1" >';
                $onewayxml .= '<CompanyName Code="TN" >';
                $onewayxml .= '</CompanyName>';
              $onewayxml .= '</RequestorID>';
            $onewayxml .= '</Source>';
          $onewayxml .= '</POS>';
          $onewayxml .= '<OriginDestinationInformation>';
            $onewayxml .= '<DepartureDateTime>'.$departuredate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$origin.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
          $onewayxml .= '</OriginDestinationInformation>';
          $onewayxml .= '<TravelPreferences ValidInterlineTicket="true" >';
            //$onewayxml .= '<CabinPref Cabin="'.$travel_class_to_pass.'" PreferLevel="Preferred" ></CabinPref>';
            $onewayxml .= '<CabinPref Cabin="'.$travel_class_to_pass.'" PreferLevel="Only" ></CabinPref>';
          $onewayxml .= '</TravelPreferences>';
          $onewayxml .= '<TravelerInfoSummary>';
            $onewayxml .= '<SeatsRequested>1</SeatsRequested>';
            $onewayxml .= '<AirTravelerAvail>';
              $onewayxml .= '<PassengerTypeQuantity Code="ADT" Quantity="1" ></PassengerTypeQuantity>';
              //$children,$infant
              if(isset($children) && $children != 0){
                //$onewayxml .= '<PassengerTypeQuantity Code="CNN" Quantity="1" ></PassengerTypeQuantity>';
                $onewayxml .= '<PassengerTypeQuantity Code="CNN" Quantity="1" ></PassengerTypeQuantity>';
              }
              if(isset($infant) && $infant != 0){  
                //$onewayxml .= '<PassengerTypeQuantity Code="INF" Quantity="1" ></PassengerTypeQuantity>';
                $onewayxml .= '<PassengerTypeQuantity Code="INF" Quantity="1" ></PassengerTypeQuantity>';
              }
            $onewayxml .= '</AirTravelerAvail>';
          $onewayxml .= '</TravelerInfoSummary>';
          $onewayxml .= '<TPA_Extensions>';
            $onewayxml .= '<IntelliSellTransaction><RequestType Name="100ITINS" ></RequestType></IntelliSellTransaction>';
          $onewayxml .= '</TPA_Extensions>';
        $onewayxml .= '</OTA_AirLowFareSearchRQ>';
        return $onewayxml;
      }  
///////////////////////////////////////////////////////
      if($origin1 != "")
      {  
        $onewayxml = '<OTA_AirLowFareSearchRQ Version="1.9.2"  xmlns="http://www.opentravel.org/OTA/2003/05">';
          $onewayxml .= '<POS>';
            $onewayxml .= '<Source PseudoCityCode="B30I" >';
              $onewayxml .= '<RequestorID ID="1" Type="1" >';
                $onewayxml .= '<CompanyName Code="TN" >';
                $onewayxml .= '</CompanyName>';
              $onewayxml .= '</RequestorID>';
            $onewayxml .= '</Source>';
          $onewayxml .= '</POS>';
          if($origin1 != "")
          {
            $onewayxml .= '<OriginDestinationInformation RPH="1">';
              $onewayxml .= '<DepartureDateTime>'.$departuredate1.'T00:00:00</DepartureDateTime>';
              $onewayxml .= '<OriginLocation LocationCode="'.$origin1.'" ></OriginLocation>';
              $onewayxml .= '<DestinationLocation LocationCode="'.$destination1.'" ></DestinationLocation>';
              $onewayxml .= '<TPA_Extensions><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
            $onewayxml .= '</OriginDestinationInformation>';
          }
          
          if($origin2 != "")
          {
            $onewayxml .= '<OriginDestinationInformation RPH="2">';
              $onewayxml .= '<DepartureDateTime>'.$departuredate2.'T00:00:00</DepartureDateTime>';
              $onewayxml .= '<OriginLocation LocationCode="'.$origin2.'" ></OriginLocation>';
              $onewayxml .= '<DestinationLocation LocationCode="'.$destination2.'" ></DestinationLocation>';
              $onewayxml .= '<TPA_Extensions><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
            $onewayxml .= '</OriginDestinationInformation>';
          }

          if($origin3 != "")
          {
            $onewayxml .= '<OriginDestinationInformation RPH="3">';
              $onewayxml .= '<DepartureDateTime>'.$departuredate3.'T00:00:00</DepartureDateTime>';
              $onewayxml .= '<OriginLocation LocationCode="'.$origin3.'" ></OriginLocation>';
              $onewayxml .= '<DestinationLocation LocationCode="'.$destination3.'" ></DestinationLocation>';
              $onewayxml .= '<TPA_Extensions><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
            $onewayxml .= '</OriginDestinationInformation>';
          }

          if($origin4 != "")
          {
            $onewayxml .= '<OriginDestinationInformation RPH="4">';
              $onewayxml .= '<DepartureDateTime>'.$departuredate4.'T00:00:00</DepartureDateTime>';
              $onewayxml .= '<OriginLocation LocationCode="'.$origin4.'" ></OriginLocation>';
              $onewayxml .= '<DestinationLocation LocationCode="'.$destination4.'" ></DestinationLocation>';
              $onewayxml .= '<TPA_Extensions><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
            $onewayxml .= '</OriginDestinationInformation>';
          }

          if($origin5 != "")
          {
            $onewayxml .= '<OriginDestinationInformation RPH="5">';
              $onewayxml .= '<DepartureDateTime>'.$departuredate5.'T00:00:00</DepartureDateTime>';
              $onewayxml .= '<OriginLocation LocationCode="'.$origin5.'" ></OriginLocation>';
              $onewayxml .= '<DestinationLocation LocationCode="'.$destination5.'" ></DestinationLocation>';
              $onewayxml .= '<TPA_Extensions><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
            $onewayxml .= '</OriginDestinationInformation>';
          }

          $onewayxml .= '<TravelPreferences ValidInterlineTicket="true" >';
            //$onewayxml .= '<CabinPref Cabin="'.$travel_class_to_pass.'" PreferLevel="Preferred" ></CabinPref>';
            $onewayxml .= '<CabinPref Cabin="'.$travel_class_to_pass.'" PreferLevel="Only" ></CabinPref>';
          $onewayxml .= '</TravelPreferences>';
          $onewayxml .= '<TravelerInfoSummary>';
            $onewayxml .= '<SeatsRequested>1</SeatsRequested>';
            $onewayxml .= '<AirTravelerAvail>';
              $onewayxml .= '<PassengerTypeQuantity Code="ADT" Quantity="1" ></PassengerTypeQuantity>';
              //$children,$infant
              //$children,$infant
              if(isset($children) && $children != 0){
                //$onewayxml .= '<PassengerTypeQuantity Code="CNN" Quantity="1" ></PassengerTypeQuantity>';
                $onewayxml .= '<PassengerTypeQuantity Code="CNN" Quantity="1" ></PassengerTypeQuantity>';
              }
              if(isset($infant) && $infant != 0){  
                //$onewayxml .= '<PassengerTypeQuantity Code="INF" Quantity="1" ></PassengerTypeQuantity>';
                $onewayxml .= '<PassengerTypeQuantity Code="INF" Quantity="1" ></PassengerTypeQuantity>';
              }
              //$onewayxml .= '<PassengerTypeQuantity Code="CNN" Quantity="1" ></PassengerTypeQuantity>';
              //$onewayxml .= '<PassengerTypeQuantity Code="INF" Quantity="1" ></PassengerTypeQuantity>';
            $onewayxml .= '</AirTravelerAvail>';
          $onewayxml .= '</TravelerInfoSummary>';
          $onewayxml .= '<TPA_Extensions>';
            $onewayxml .= '<IntelliSellTransaction><RequestType Name="100ITINS" ></RequestType></IntelliSellTransaction>';
          $onewayxml .= '</TPA_Extensions>';
        $onewayxml .= '</OTA_AirLowFareSearchRQ>';
        return $onewayxml;
      }


   return null;   
     

  //return $xmlofbfmtosend;
        //echo $xmltoshow = XMLSerializer::generateValidXmlFromArray($request); die;
        //echo $xmlofbfmtosend; die;
        //return $xmlofbfmtosend;
        //return XMLSerializer::generateValidXmlFromArray($request);   

$trythis = '<OTA_AirLowFareSearchRQ Version="1.9.2"  xmlns="http://www.opentravel.org/OTA/2003/05">';
    $trythis .= '<Target>Production</Target>';
    $trythis .= '<POS>';
      $trythis .= '<Source>';
        $trythis .= '<PseudoCityCode>B30I</PseudoCityCode>';
        $trythis .= '<RequestorID>';
          $trythis .= '<Type>1</Type>';
          $trythis .= '<ID>1</ID>';
          $trythis .= '<CompanyName />';
        $trythis .= '</RequestorID>';
      $trythis .= '</Source>';
    $trythis .= '</POS>';
    $trythis .= '<OriginDestinationInformation>';
      $trythis .= '<RPH>1</RPH>';
      $trythis .= '<DepartureDateTime>2016-10-18T00:00:00</DepartureDateTime>';
      $trythis .= '<OriginLocation>';
        $trythis .= '<LocationCode>LAX</LocationCode>';
      $trythis .= '</OriginLocation>';
      $trythis .= '<DestinationLocation>';
        $trythis .= '<LocationCode>JFK</LocationCode>';
      $trythis .= '</DestinationLocation>';
      $trythis .= '<TPA_Extensions>';
        $trythis .= '<SegmentType>';
          $trythis .= '<Code>O</Code>';
        $trythis .= '</SegmentType>';
      $trythis .= '</TPA_Extensions>';
    $trythis .= '</OriginDestinationInformation>';
    $trythis .= '<OriginDestinationInformation>';
      $trythis .= '<RPH>2</RPH>';
      $trythis .= '<DepartureDateTime>2016-10-28T00:00:00</DepartureDateTime>';
      $trythis .= '<OriginLocation>';
        $trythis .= '<LocationCode>LAX</LocationCode>';
      $trythis .= '</OriginLocation>';
      $trythis .= '<DestinationLocation>';
        $trythis .= '<LocationCode>JFK</LocationCode>';
      $trythis .= '</DestinationLocation>';
      $trythis .= '<TPA_Extensions>';
        $trythis .= '<SegmentType>';
          $trythis .= '<Code>O</Code>';
        $trythis .= '</SegmentType>';
      $trythis .= '</TPA_Extensions>';
    $trythis .= '</OriginDestinationInformation>';
    $trythis .= '<TravelPreferences>';
      $trythis .= '<ValidInterlineTicket>true</ValidInterlineTicket>';
      $trythis .= '<CabinPref>';
        $trythis .= '<Cabin>Y</Cabin>';
        $trythis .= '<PreferLevel>Preferred</PreferLevel>';
      $trythis .= '</CabinPref>';
      $trythis .= '<TPA_Extensions>';
        $trythis .= '<TripType>';
          $trythis .= '<Value>Return</Value>';
        $trythis .= '</TripType>';
        $trythis .= '<LongConnectTime>';
          $trythis .= '<Min>780</Min>';
          $trythis .= '<Max>1200</Max>';
          $trythis .= '<Enable>true</Enable>';
        $trythis .= '</LongConnectTime>';
        $trythis .= '<ExcludeCallDirectCarriers>';
          $trythis .= '<Enabled>true</Enabled>';
        $trythis .= '</ExcludeCallDirectCarriers>';
      $trythis .= '</TPA_Extensions>';
    $trythis .= '</TravelPreferences>';
    $trythis .= '<TravelerInfoSummary>';
      $trythis .= '<SeatsRequested>1</SeatsRequested>';
      $trythis .= '<AirTravelerAvail>';
        $trythis .= '<PassengerTypeQuantity>';
          $trythis .= '<Code>ADT</Code>';
          $trythis .= '<Quantity>1</Quantity>';
        $trythis .= '</PassengerTypeQuantity>';
      $trythis .= '</AirTravelerAvail>';
    $trythis .= '</TravelerInfoSummary>';
    $trythis .= '<TPA_Extensions>';
      $trythis .= '<IntelliSellTransaction>';
        $trythis .= '<RequestType>';
          $trythis .= '<Name>50ITINS</Name>';
        $trythis .= '</RequestType>';
      $trythis .= '</IntelliSellTransaction>';
    $trythis .= '</TPA_Extensions>';
  $trythis .= '</OTA_AirLowFareSearchRQ>';
return $trythis;

       $xmlofbfmtosend = '<OTA_AirLowFareSearchRQ Version="1.9.2"  xmlns="http://www.opentravel.org/OTA/2003/05">';
        $xmlofbfmtosend .= '<POS>';
          $xmlofbfmtosend .= '<Source PseudoCityCode="B30I"/>';
        $xmlofbfmtosend .= '</POS>';
        $xmlofbfmtosend .= '<OriginDestinationInformation>';
          $xmlofbfmtosend .= '<DepartureDateTime>2011-11-20T00:00:00</DepartureDateTime>';
          $xmlofbfmtosend .= '<ReturnDateTime>2011-11-26T00:00:00</ReturnDateTime>';
          $xmlofbfmtosend .= '<OriginLocation LocationCode="LHR" />';
          $xmlofbfmtosend .= '<DestinationLocation LocationCode="VIE"/>';
          $xmlofbfmtosend .= '<TPA_Extensions>';
            $xmlofbfmtosend .= '<SegmentType Code="O"/>';
          $xmlofbfmtosend .= '</TPA_Extensions>';
        $xmlofbfmtosend .= '</OriginDestinationInformation>';
        $xmlofbfmtosend .= '<TravelPreferences MaxStopsQuantity="0">';
        $xmlofbfmtosend .= '<CabinPref Code="Y" RPH="1"/>';
          $xmlofbfmtosend .= '<TPA_Extensions>';
            $xmlofbfmtosend .= '<NumTrips Number="19"/>';
        $xmlofbfmtosend .= '</TPA_Extensions>';
        $xmlofbfmtosend .= '</TravelPreferences>';
        $xmlofbfmtosend .= '<TravelerInformation>';
          $xmlofbfmtosend .= '<PassengerTypeQuantity Code="ADT" Quantity="1"/>';
        $xmlofbfmtosend .= '</TravelerInformation>';
        $xmlofbfmtosend .= '<PriceRequestInformation CurrencyCode="USD">';
         $xmlofbfmtosend .= '<TPA_Extensions>';
          $xmlofbfmtosend .= '<FareCalc Ind="true">';
            $xmlofbfmtosend .= '<FareBasis SegmentsOnly="true"/>';
          $xmlofbfmtosend .= '</FareCalc>';
          $xmlofbfmtosend .= '<PublicFare Ind="true"/>';
          $xmlofbfmtosend .= '<Priority>';
            $xmlofbfmtosend .= '<Price Priority="1"/>';
            $xmlofbfmtosend .= '<DirectFlights Priority="2"/>';
            $xmlofbfmtosend .= '<Time Priority="3"/>';
            $xmlofbfmtosend .= '<Vendor Priority="4"/>';
         $xmlofbfmtosend .= '</Priority>';
        $xmlofbfmtosend .= '</TPA_Extensions>';
       $xmlofbfmtosend .= '</PriceRequestInformation>';
       $xmlofbfmtosend .= '</OTA_AirLowFareSearchRQ>';
       //return $xmlofbfmtosend;
        //echo $xmltoshow = XMLSerializer::generateValidXmlFromArray($request); die;
        //echo $xmlofbfmtosend; die;
        //return $xmlofbfmtosend;
        return XMLSerializer::generateValidXmlFromArray($request);
    }

}
