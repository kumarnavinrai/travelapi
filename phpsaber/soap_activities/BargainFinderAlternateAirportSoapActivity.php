<?php
include_once 'workflow/Activity.php';
include_once 'soap/SACSSoapClient.php';
include_once 'soap/XMLSerializer.php';

class BargainFinderAlternateAirportSoapActivity implements Activity {

    private $config;
    
    public function __construct($nearairposr) {
        $this->config = SACSConfig::getInstance();
        $this->nearairposr = $nearairposr;
    }
    
    public function run(&$sharedContext) {
     

      if(isset($_REQUEST['origin']) && $_REQUEST['origin'] != "")
      {
                  
          $origin = filter_input(INPUT_POST, "origin"); //filter_input($_REQUEST['origin']);
          $destination = filter_input(INPUT_POST, "destination"); //filter_input($_REQUEST['destination']);
          $departureDate = filter_input(INPUT_POST, "departureDate"); //filter_input($_REQUEST['departureDate']);
          $departuredate = filter_input(INPUT_POST, "departureDate"); //filter_input($_REQUEST['departureDate']);
          $returndate = filter_input(INPUT_POST, "returndate"); //filter_input($_REQUEST['returndate']);
          $limit = filter_input(INPUT_POST, "limit"); //filter_input($_REQUEST['limit']);
          $outboundflightstops = filter_input(INPUT_POST, "outboundflightstops"); //filter_input($_REQUEST['outboundflightstops']);
          $outbounddeparturewindow = filter_input(INPUT_POST, "outbounddeparturewindow"); //filter_input($_REQUEST['outbounddeparturewindow']);
          $includedcarriers = filter_input(INPUT_POST, "includedcarriers"); //filter_input($_REQUEST['includedcarriers']);
          $inboundstopduration = filter_input(INPUT_POST, "inboundstopduration"); //filter_input($inboundstopduration);
          $outboundstopduration = filter_input(INPUT_POST, "inboundstopduration"); //filter_input($inboundstopduration);
          $passengercount = filter_input(INPUT_POST, "passengercount"); //filter_input($_REQUEST['passengercount']);
          $lengthofstay = filter_input(INPUT_POST, "lengthofstay"); //filter_input($_REQUEST['lengthofstay']);
          $children = filter_input(INPUT_POST, "children");
          $infant = filter_input(INPUT_POST, "infant");
          $travel_class = filter_input(INPUT_POST, "travel_class");
        
      } 



        $soapClient = new SACSSoapClient("BargainFinderMaxRQ");
        $soapClient->setLastInFlow(false);
        //$xmlRequest = $this->getRequest();
        $xmlRequest = $this->getRequest($origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class);
        $sharedContext->addResult("BargainFinderMaxRQ", $xmlRequest);
        $sharedContext->addResult("BargainFinderMaxRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
        //return new PassengerDetailsNameOnlyActivity();
    }

    private function getRequest($origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class) {

/*$rtn = '<OTA_AirLowFareSearchRQ xmlns="http://www.opentravel.org/OTA/2003/05" Version="1.9.2" ResponseType="OTA" ResponseVersion="1.9.2">
  <POS>
    <Source PseudoCityCode="B30I" >

      <RequestorID ID="1" Type="1" >
        <CompanyName Code="TN" />
      </RequestorID>
    </Source>
  </POS>
  <OriginDestinationInformation RPH="1">
    <DepartureDateTime>2017-01-27T00:00:00</DepartureDateTime>
    <OriginLocation LocationCode="JFK" />
    <DestinationLocation LocationCode="LAX" />
    <TPA_Extensions>
      <SisterDestinationLocation LocationCode="LGA" />
      <SisterDestinationLocation LocationCode="EWR" />
      <SegmentType Code="O" />
    </TPA_Extensions>
  </OriginDestinationInformation>
  <OriginDestinationInformation RPH="2">
    <DepartureDateTime>2017-01-30T00:00:00</DepartureDateTime>
    <OriginLocation LocationCode="LAX" />
    <DestinationLocation LocationCode="JFK" />
    <TPA_Extensions>
      <SisterDestinationLocation LocationCode="LGA" />
      <SisterDestinationLocation LocationCode="EWR" />
      <SegmentType Code="O" />
    </TPA_Extensions>
  </OriginDestinationInformation>
  <TravelPreferences ValidInterlineTicket="false" >
    <CabinPref PreferLevel="Preferred" Cabin="Y"/>
  </TravelPreferences>
  <TravelerInfoSummary>
    <SeatsRequested>1</SeatsRequested>
    <AirTravelerAvail>
      <PassengerTypeQuantity Code="ADT" Quantity="1"/> 
    </AirTravelerAvail>
  </TravelerInfoSummary>
  <TPA_Extensions>
    <IntelliSellTransaction>
      <RequestType Name="100ITINS"/> 
    </IntelliSellTransaction>
  </TPA_Extensions>
</OTA_AirLowFareSearchRQ>';
return $rtn;*/

      /*$rtn = '<OTA_AirLowFareSearchRQ xmlns="http://www.opentravel.org/OTA/2003/05" Version="1.9.7" ResponseType="OTA" ResponseVersion="1.9.7">
    <POS>
        <Source PseudoCityCode="B30I">
        <RequestorID ID="1" Type="1">
            <CompanyName Code="TN"></CompanyName>
        </RequestorID>
        </Source>
    </POS>
    <OriginDestinationInformation RPH="1">
        <DepartureDateTime>2016-12-16T00:00:00</DepartureDateTime>
        <OriginLocation LocationCode="LHR" />
        <DestinationLocation LocationCode="BOM" />
        <TPA_Extensions>
            <SisterOriginLocation LocationCode="LTN" />
            <SisterOriginLocation LocationCode="LGW" />
            <SegmentType Code="O" />
            <CabinPref Cabin="Y" PreferLevel="Preferred" />
        </TPA_Extensions>
    </OriginDestinationInformation>
    <OriginDestinationInformation RPH="2">
        <DepartureDateTime>2016-12-26T00:00:00</DepartureDateTime>
        <OriginLocation LocationCode="BOM" />
        <DestinationLocation LocationCode="LHR" />
        <TPA_Extensions>
            <SisterDestinationLocation LocationCode="LTN" />
            <SisterDestinationLocation LocationCode="LGW" />
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>
    <TravelerInfoSummary>
        <SeatsRequested>1</SeatsRequested>
        <AirTravelerAvail>
            <PassengerTypeQuantity Code="ADT" Quantity="1" />
        </AirTravelerAvail>
        
    </TravelerInfoSummary>
    <TPA_Extensions>
        <IntelliSellTransaction>
        </IntelliSellTransaction>
    </TPA_Extensions>
</OTA_AirLowFareSearchRQ>';
return $rtn;*/
      
      $firstnearairport = current($this->nearairposr);
      $secondnearairport = next($this->nearairposr); 

      //getting each flight class
      $saberclassarray = array();
      $saberclassarray['PREMIUM_ECONOMY'] = 'S';
      $saberclassarray['FIRST'] = 'F';
      $saberclassarray['BUSINESS'] = 'C';
      $saberclassarray['ECONOMY'] = 'Y';
      $travel_class_to_pass = $saberclassarray[$travel_class];

      if($returndate == "")
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
            $onewayxml .= '<OriginLocation LocationCode="'.$firstnearairport.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
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
      if($returndate != "")
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
          $onewayxml .= '<OriginDestinationInformation RPH="1">';
            $onewayxml .= '<DepartureDateTime>'.$departuredate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$firstnearairport.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
          $onewayxml .= '</OriginDestinationInformation>';
             $onewayxml .= '<OriginDestinationInformation RPH="2">';
            $onewayxml .= '<DepartureDateTime>'.$returndate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$destination.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$firstnearairport.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
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


class BargainFinderAlternateAirportTwoSoapActivity implements Activity {

    private $config;
    
    public function __construct($nearairposr) {
        $this->config = SACSConfig::getInstance();
        $this->nearairposr = $nearairposr;
    }
    
    public function run(&$sharedContext) {
     

      if(isset($_REQUEST['origin']) && $_REQUEST['origin'] != "")
      {
                  
          $origin = filter_input(INPUT_POST, "origin"); //filter_input($_REQUEST['origin']);
          $destination = filter_input(INPUT_POST, "destination"); //filter_input($_REQUEST['destination']);
          $departureDate = filter_input(INPUT_POST, "departureDate"); //filter_input($_REQUEST['departureDate']);
          $departuredate = filter_input(INPUT_POST, "departureDate"); //filter_input($_REQUEST['departureDate']);
          $returndate = filter_input(INPUT_POST, "returndate"); //filter_input($_REQUEST['returndate']);
          $limit = filter_input(INPUT_POST, "limit"); //filter_input($_REQUEST['limit']);
          $outboundflightstops = filter_input(INPUT_POST, "outboundflightstops"); //filter_input($_REQUEST['outboundflightstops']);
          $outbounddeparturewindow = filter_input(INPUT_POST, "outbounddeparturewindow"); //filter_input($_REQUEST['outbounddeparturewindow']);
          $includedcarriers = filter_input(INPUT_POST, "includedcarriers"); //filter_input($_REQUEST['includedcarriers']);
          $inboundstopduration = filter_input(INPUT_POST, "inboundstopduration"); //filter_input($inboundstopduration);
          $outboundstopduration = filter_input(INPUT_POST, "inboundstopduration"); //filter_input($inboundstopduration);
          $passengercount = filter_input(INPUT_POST, "passengercount"); //filter_input($_REQUEST['passengercount']);
          $lengthofstay = filter_input(INPUT_POST, "lengthofstay"); //filter_input($_REQUEST['lengthofstay']);
          $children = filter_input(INPUT_POST, "children");
          $infant = filter_input(INPUT_POST, "infant");
          $travel_class = filter_input(INPUT_POST, "travel_class");
        
      } 



        $soapClient = new SACSSoapClient("BargainFinderMaxRQ");
        $soapClient->setLastInFlow(false);
        //$xmlRequest = $this->getRequest();
        $xmlRequest = $this->getRequest($origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class);
        $sharedContext->addResult("BargainFinderMaxRQ", $xmlRequest);
        $sharedContext->addResult("BargainFinderMaxRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
        //return new PassengerDetailsNameOnlyActivity();
    }

    private function getRequest($origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class) {


      
      $firstnearairport = current($this->nearairposr);
      $secondnearairport = next($this->nearairposr); 

      //getting each flight class
      $saberclassarray = array();
      $saberclassarray['PREMIUM_ECONOMY'] = 'S';
      $saberclassarray['FIRST'] = 'F';
      $saberclassarray['BUSINESS'] = 'C';
      $saberclassarray['ECONOMY'] = 'Y';
      $travel_class_to_pass = $saberclassarray[$travel_class];

      if($returndate == "")
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
            $onewayxml .= '<OriginLocation LocationCode="'.$secondnearairport.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
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
      if($returndate != "")
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
          $onewayxml .= '<OriginDestinationInformation RPH="1">';
            $onewayxml .= '<DepartureDateTime>'.$departuredate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$secondnearairport.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
          $onewayxml .= '</OriginDestinationInformation>';
             $onewayxml .= '<OriginDestinationInformation RPH="2">';
            $onewayxml .= '<DepartureDateTime>'.$returndate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$destination.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$secondnearairport.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
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
   
  
    }

}


class BargainFinderAlternateAirportThreeSoapActivity implements Activity {

    private $config;
    
    public function __construct($nearairposr) {
        $this->config = SACSConfig::getInstance();
        $this->nearairposr = $nearairposr;
    }
    
    public function run(&$sharedContext) {
     

      if(isset($_REQUEST['origin']) && $_REQUEST['origin'] != "")
      {
                  
          $origin = filter_input(INPUT_POST, "origin"); //filter_input($_REQUEST['origin']);
          $destination = filter_input(INPUT_POST, "destination"); //filter_input($_REQUEST['destination']);
          $departureDate = filter_input(INPUT_POST, "departureDate"); //filter_input($_REQUEST['departureDate']);
          $departuredate = filter_input(INPUT_POST, "departureDate"); //filter_input($_REQUEST['departureDate']);
          $returndate = filter_input(INPUT_POST, "returndate"); //filter_input($_REQUEST['returndate']);
          $limit = filter_input(INPUT_POST, "limit"); //filter_input($_REQUEST['limit']);
          $outboundflightstops = filter_input(INPUT_POST, "outboundflightstops"); //filter_input($_REQUEST['outboundflightstops']);
          $outbounddeparturewindow = filter_input(INPUT_POST, "outbounddeparturewindow"); //filter_input($_REQUEST['outbounddeparturewindow']);
          $includedcarriers = filter_input(INPUT_POST, "includedcarriers"); //filter_input($_REQUEST['includedcarriers']);
          $inboundstopduration = filter_input(INPUT_POST, "inboundstopduration"); //filter_input($inboundstopduration);
          $outboundstopduration = filter_input(INPUT_POST, "inboundstopduration"); //filter_input($inboundstopduration);
          $passengercount = filter_input(INPUT_POST, "passengercount"); //filter_input($_REQUEST['passengercount']);
          $lengthofstay = filter_input(INPUT_POST, "lengthofstay"); //filter_input($_REQUEST['lengthofstay']);
          $children = filter_input(INPUT_POST, "children");
          $infant = filter_input(INPUT_POST, "infant");
          $travel_class = filter_input(INPUT_POST, "travel_class");
        
      } 



        $soapClient = new SACSSoapClient("BargainFinderMaxRQ");
        $soapClient->setLastInFlow(false);
        //$xmlRequest = $this->getRequest();
        $xmlRequest = $this->getRequest($origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class);
        $sharedContext->addResult("BargainFinderMaxRQ", $xmlRequest);
        $sharedContext->addResult("BargainFinderMaxRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
        //return new PassengerDetailsNameOnlyActivity();
    }

    private function getRequest($origin,$destination,$departuredate,$returndate,$limit,$outboundflightstops,$outbounddeparturewindow,$includedcarriers,$inboundstopduration,$passengercount,$lengthofstay,$children,$infant,$travel_class) {


      
      $firstnearairport = current($this->nearairposr);
      $secondnearairport = next($this->nearairposr);
      $thirdnearairport = next($this->nearairposr); 
      $fourthnearairport = next($this->nearairposr); 

      //getting each flight class
      $saberclassarray = array();
      $saberclassarray['PREMIUM_ECONOMY'] = 'S';
      $saberclassarray['FIRST'] = 'F';
      $saberclassarray['BUSINESS'] = 'C';
      $saberclassarray['ECONOMY'] = 'Y';
      $travel_class_to_pass = $saberclassarray[$travel_class];

      if($returndate == "")
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
            $onewayxml .= '<OriginLocation LocationCode="'.$thirdnearairport.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
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
      if($returndate != "")
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
          $onewayxml .= '<OriginDestinationInformation RPH="1">';
            $onewayxml .= '<DepartureDateTime>'.$departuredate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$thirdnearairport.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$destination.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
          $onewayxml .= '</OriginDestinationInformation>';
             $onewayxml .= '<OriginDestinationInformation RPH="2">';
            $onewayxml .= '<DepartureDateTime>'.$returndate.'T00:00:00</DepartureDateTime>';
            $onewayxml .= '<OriginLocation LocationCode="'.$destination.'" ></OriginLocation>';
            $onewayxml .= '<DestinationLocation LocationCode="'.$thirdnearairport.'" ></DestinationLocation>';
            $onewayxml .= '<TPA_Extensions><SisterDestinationLocation LocationCode="'.$firstnearairport.'" /><SisterDestinationLocation LocationCode="'.$secondnearairport.'" /><SegmentType Code="O" ></SegmentType></TPA_Extensions>';
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
   
  
    }

}
