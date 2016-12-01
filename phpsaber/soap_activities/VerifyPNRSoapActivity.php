<?php

$pathoffile = realpath("./");
$pathoffile = $pathoffile."/";

set_include_path(get_include_path()."." . PATH_SEPARATOR . $pathoffile);
   
include_once $pathoffile.'workflow/Activity.php';
include_once $pathoffile.'soap/SACSSoapClient.php';
//include_once 'soap_activities/PassengerDetailsNameOnlyActivity.php';
include_once $pathoffile.'soap/XMLSerializer.php';

class VerifyPNRSoapActivity implements Activity {

    private $config;
    
    public function __construct($data) {
        $this->config = SACSConfig::getInstance();
        $this->PNR=$data;
    }
    
    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("TravelItineraryReadRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("TravelItineraryReadRQ", $xmlRequest);
        $sharedContext->addResult("TravelItineraryReadRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
    }

    private function getRequest() {


        /*<TravelItineraryReadRQ Version="3.8.0" TimeStamp="2012-09-19T10:00:00-06:00" xmlns="http://services.sabre.com/res/tir/v3_8" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:dd="http://webservices.sabre.com/dd2">
    <MessagingDetails>
        <SubjectAreas>
            <SubjectArea>FULL</SubjectArea>
        </SubjectAreas>
    </MessagingDetails>
    <UniqueID ID="WCFHQR" />
    <EchoToken/>
</TravelItineraryReadRQ>*/
         $reqxml = '<TravelItineraryReadRQ Version="3.8.0" xmlns="http://services.sabre.com/res/tir/v3_8" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:dd="http://webservices.sabre.com/dd2">';
        $reqxml .= '<MessagingDetails>';
        $reqxml .= '<SubjectAreas>';
        //$reqxml .= '<PaymentCard AirlineCode="LH" Code="VI" ExpireDate="2017-01" Number="1234567896587456" />';
        $reqxml .= '<SubjectArea>FULL</SubjectArea>';
        $reqxml .= '</SubjectAreas>';
        $reqxml .= '</MessagingDetails>';
        $reqxml .= '<UniqueID ID="'.$this->PNR.'" />';
        $reqxml .= '<EchoToken/>';
        $reqxml .= '</TravelItineraryReadRQ>';
      
        //echo $reqxml; die;
        return $reqxml;

        return XMLSerializer::generateValidXmlFromArray($request);
    }

}
