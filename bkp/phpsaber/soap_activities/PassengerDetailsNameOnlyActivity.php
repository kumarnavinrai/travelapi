<?php
include_once 'workflow/Activity.php';
include_once 'soap/SACSSoapClient.php';
include_once 'soap_activities/EnhancedAirBookActivity.php';

class PassengerDetailsNameOnlyActivity implements Activity {

    private $config;
    
    public function __construct($data) {
        $this->config = SACSConfig::getInstance();
        $this->pdata = $data; 
    }

    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("PassengerDetailsRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("PassengerDetailsNameOnlyRQ", $xmlRequest);
        $sharedContext->addResult("PassengerDetailsNameOnlyRS", $soapClient->doCall($sharedContext, $xmlRequest));
        //return null;
        return new EnhancedAirBookActivity();
    }

    private function getRequest() {
       

       /*

         $custxml = '<PassengerDetailsRQ HaltOnError="true" IgnoreOnError="false" version="3.2.0" xmlns="http://services.sabre.com/sp/pd/v3_2">';
        $custxml .= '<TravelItineraryAddInfoRQ>';
        $custxml .= '<CustomerInfo>';
        $custxml .= '<ContactNumbers>';
        $custxml .= '<ContactNumber LocationCode="DFW" NameNumber="1.1" Phone="817-555-1212" PhoneUseType="H" ></ContactNumber>';
        $custxml .= '<ContactNumber LocationCode="DFW" NameNumber="1.1" Phone="682-555-1212" PhoneUseType="O" ></ContactNumber>';
        $custxml .= '</ContactNumbers>';
        $custxml .= '<Email Address="webservices.support@sabre.com" NameNumber="1.1" ></Email>';
        $custxml .= '<PersonName NameNumber="1.1" >';
        $custxml .= '<GivenName>SACSdcsri</GivenName>';
        $custxml .= '<Surname>TESTzbdqc</Surname>';
        $custxml .= '</PersonName>';
        $custxml .= '<PersonName NameNumber="1.1" >';
        $custxml .= '<GivenName>SACSdcsdri</GivenName>';
        $custxml .= '<Surname>TESTzbddqc</Surname>';
        $custxml .= '</PersonName>';
        $custxml .= '</CustomerInfo>';
        $custxml .= '</TravelItineraryAddInfoRQ>';
        $custxml .= '</PassengerDetailsRQ>';


       */
        
        $custxml = '<PassengerDetailsRQ HaltOnError="true" IgnoreOnError="false" version="3.2.0" xmlns="http://services.sabre.com/sp/pd/v3_2">';
        $custxml .= '<TravelItineraryAddInfoRQ>';
        $custxml .= '<CustomerInfo>';
        $custxml .= '<ContactNumbers>';
        $custxml .= '<ContactNumber  NameNumber="1.1" Phone="'.$this->pdata['custinfo']['bp'].'" PhoneUseType="H" ></ContactNumber>';
        $custxml .= '<ContactNumber  NameNumber="1.1" Phone="'.$this->pdata['custinfo']['mp'].'" PhoneUseType="O" ></ContactNumber>';
        $custxml .= '</ContactNumbers>';
        $custxml .= '<Email Address="'.$this->pdata['custinfo']['email'].'" NameNumber="1.1" ></Email>';
       
        unset($this->pdata['custinfo']);
        unset($this->pdata['numberofflights']);
        foreach ($this->pdata as $key => $value) 
        {
            
        
            $custxml .= '<PersonName NameNumber="1.1" >';
            $custxml .= '<GivenName>'.reset($value).'</GivenName>';
            next($value);
            $custxml .= '<Surname>'.next($value).'</Surname>';
            $custxml .= '</PersonName>';
           

        }   
        $custxml .= '</CustomerInfo>';
        $custxml .= '</TravelItineraryAddInfoRQ>';
        $custxml .= '</PassengerDetailsRQ>';
        //echo $custxml; die;
        return $custxml;
        echo XMLSerializer::generateValidXmlFromArray($requestArray, null, "ContactNumber"); die;
        return XMLSerializer::generateValidXmlFromArray($requestArray, null, "ContactNumber");
    }

    private function generatePseudoRandomString($length) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

}
