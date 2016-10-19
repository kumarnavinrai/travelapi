<?php

$pathoffile = realpath("./");
$pathoffile = $pathoffile."\/";

set_include_path(get_include_path()."." . PATH_SEPARATOR . $pathoffile);
   
include_once $pathoffile.'workflow/Activity.php';
include_once $pathoffile.'soap/SACSSoapClient.php';
//include_once 'soap_activities/PassengerDetailsNameOnlyActivity.php';
include_once $pathoffile.'soap/XMLSerializer.php';

class GetFlightDetailsSoapActivity implements Activity {

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
        $soapClient = new SACSSoapClient("OTA_AirFlifoLLSRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("OTA_AirFlifoRQ", $xmlRequest);
        $sharedContext->addResult("OTA_AirFlifoRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
    }

    private function getRequest() {

        $reqxml = '<OTA_AirFlifoRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" Version="2.0.0" >';
        $reqxml .= '<OriginDestinationInformation>';
        $reqxml .= '<FlightSegment FlightNumber="'.$this->flightno.'">';
        $reqxml .= '<MarketingAirline Code="'.$this->marketingairline.'" FlightNumber="'.$this->flightno.'" />';
        $reqxml .= '</FlightSegment>';
        $reqxml .= '</OriginDestinationInformation>';
        $reqxml .= '</OTA_AirFlifoRQ>';
        //echo $reqxml; die;
        return $reqxml;

        return XMLSerializer::generateValidXmlFromArray($request);
    }

}
