<?php

$pathoffile = realpath("./");
$pathoffile = $pathoffile."\/";

set_include_path(get_include_path()."." . PATH_SEPARATOR . $pathoffile);
   
include_once $pathoffile.'workflow/Activity.php';
include_once $pathoffile.'soap/SACSSoapClient.php';
//include_once 'soap_activities/PassengerDetailsNameOnlyActivity.php';
include_once $pathoffile.'soap/XMLSerializer.php';

class VerifyCcSoapActivity implements Activity {

    private $config;
    
    public function __construct($data) {
        $this->config = SACSConfig::getInstance();
        $this->code=current($data);
        $this->cardcode=next($data);
        $this->expiry=next($data);
        $this->ccnum=next($data);
        $this->price=next($data); 

        $this->price=explode(".",$this->price);
        $this->price=reset($this->price);

        $this->expiry=str_replace(" ", "", $this->expiry);
    
        $this->expiry="01/".$this->expiry; 
        $this->expiry=date('Y-m',strtotime($this->expiry));
        
       
        
    }
    
    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("CreditVerificationLLSRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("CreditVerificationRQ", $xmlRequest);
        $sharedContext->addResult("CreditVerificationRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
    }

    private function getRequest() {


        /*$reqxml = '<CreditVerificationRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" Version="2.2.0" >';
        $reqxml .= '<Credit>';
        $reqxml .= '<CC_Info>';
        $reqxml .= '<PaymentCard AirlineCode="'.$this->code.'" Code="'.$this->cardcode.'" ExpireDate="'.$this->expiry.'" Number="'.$this->ccnum.'" />';
        $reqxml .= '</CC_Info>';
        $reqxml .= '<ItinTotalFare>';
        $reqxml .= '<TotalFare Amount="'.$this->price.'" CurrencyCode="USD" />';
        $reqxml .= '</ItinTotalFare>';
        $reqxml .= '</Credit>';
        $reqxml .= '</CreditVerificationRQ>';*/
         $reqxml = '<CreditVerificationRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" Version="2.2.0">';
        $reqxml .= '<Credit>';
        $reqxml .= '<CC_Info>';
        //$reqxml .= '<PaymentCard AirlineCode="LH" Code="VI" ExpireDate="2017-01" Number="1234567896587456" />';
        $reqxml .= '<PaymentCard AirlineCode="'.$this->code.'" Code="'.$this->cardcode.'" ExpireDate="'.$this->expiry.'" Number="'.$this->ccnum.'" />';
        $reqxml .= '</CC_Info>';
        $reqxml .= '<ItinTotalFare>';
        $reqxml .= '<TotalFare Amount="300" CurrencyCode="USD" />';
        $reqxml .= '</ItinTotalFare>';
        $reqxml .= '</Credit>';
        $reqxml .= '</CreditVerificationRQ>';
        //echo $reqxml; die;
        return $reqxml;

        return XMLSerializer::generateValidXmlFromArray($request);
    }

}
