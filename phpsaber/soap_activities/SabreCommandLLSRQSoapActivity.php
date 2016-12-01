<?php
include_once 'workflow/Activity.php';
include_once 'soap/SACSSoapClient.php';
include_once 'soap/XMLSerializer.php';

class SabreCommandLLSRQSoapActivity implements Activity {

    private $config;
    
    public function __construct() {
        $this->config = SACSConfig::getInstance();
    }
    
    public function run(&$sharedContext) {
     

        $soapClient = new SACSSoapClient("SabreCommandLLSRQ");
        $soapClient->setLastInFlow(false);
        //$xmlRequest = $this->getRequest();
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("SabreCommandLLSRQ", $xmlRequest);
        $sharedContext->addResult("SabreCommandLLSRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
        //return new PassengerDetailsNameOnlyActivity();
    }

    private function getRequest() {

      if(isset($_REQUEST['origin']) && $_REQUEST['origin'] != "")
      {
                  
        $origin = filter_input(INPUT_POST, "origin"); 
       $rtn = '<SabreCommandLLSRQ xmlns="http://webservices.sabre.com/sabreXML/2003/07">
     <Request Output="SCREEN" CDATA="true">
           <HostCommand>W/-AT'.$_REQUEST['origin'].'</HostCommand>
     </Request>
</SabreCommandLLSRQ>';
return $rtn;
      }

      return "";
    }

}
