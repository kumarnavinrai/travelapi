<?php

$pathoffile = realpath("./");
$pathoffile = $pathoffile."\/";

set_include_path(get_include_path()."." . PATH_SEPARATOR . $pathoffile);
   
include_once $pathoffile.'workflow/Activity.php';
include_once $pathoffile.'soap/SACSSoapClient.php';
//include_once 'soap_activities/PassengerDetailsNameOnlyActivity.php';
include_once $pathoffile.'soap/XMLSerializer.php';

class VerifyFlightDetailsSoapActivity implements Activity {

    private $config;
    
    public function __construct($data) {
        $this->config = SACSConfig::getInstance();
        $this->departuretime=$data["departuretime"];
        $this->flightno=$data["flightno"];
        $this->destinationlocation=$data["destinationlocation"];
        $this->originlocation=$data["originlocation"];
        $this->marketingairline=$data["marketingairline"];
    }
    
    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("VerifyFlightDetailsLLSRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("VerifyFlightDetailsRQ", $xmlRequest);
        $sharedContext->addResult("VerifyFlightDetailsRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
    }

    private function getRequest() {
        

//$datetime = date("Y-m-d h:i:s", strtotime(date("Y-m-d h:i:s"))); 
//$datetime = str_replace(" ", "T", $datetime);
//Version="1.9.2"  xmlns="http://www.opentravel.org/OTA/2003/05"
//xmlns="http://services.sabre.com/sp/pd/v3_2"        
        $reqxml = '<VerifyFlightDetailsRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" Version="2.0.0" >';
        $reqxml .= '<OriginDestinationInformation>';
        $reqxml .= '<FlightSegment DepartureDateTime="'.$this->departuretime.'" FlightNumber="'.$this->flightno.'">';
        $reqxml .= '<DestinationLocation LocationCode="'.$this->destinationlocation.'"/>';
        $reqxml .= '<MarketingAirline Code="'.$this->marketingairline.'"/>';
        $reqxml .= '<OriginLocation LocationCode="'.$this->originlocation.'"/>';
        $reqxml .= '</FlightSegment>';
        $reqxml .= '</OriginDestinationInformation>';
        $reqxml .= '</VerifyFlightDetailsRQ>';
        //echo $reqxml; die;
        return $reqxml;

        return XMLSerializer::generateValidXmlFromArray($request);
    }

}
