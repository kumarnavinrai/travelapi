<?php

include_once 'soap/SACSSoapClient.php';
include_once 'soap_activities/TravelItineraryReadActivity.php';

class PassengerDetailsActivity implements Activity {
    
    private $config;
    
    public function __construct() {
        $this->config = SACSConfig::getInstance();
    }

    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("PassengerDetailsRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $sharedContext->addResult("PassengerDetailsRQ", $xmlRequest);
        $sharedContext->addResult("PassengerDetailsRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return new TravelItineraryReadActivity();
    }
    
    private function getRequest() {
        $requestArray = array(
            "PassengerDetailsRQ" => array(
                "_namespace" => "http://services.sabre.com/sp/pd/v3_2",
                "_attributes" => array(
                    "HaltOnError" => "true",
                    "IgnoreOnError" => "false",
                    "version" => $this->config->getSoapProperty("PassengerDetailsRQVersion")
                ),
                "PostProcessing" => array(
                    "_attributes" => array("RedisplayReservation" => "true"),
                    "EndTransactionRQ" => array(
                        "EndTransaction" => array(
                            "_attributes" => array("Ind" => "true")
                            //"_attributes" => array("Ind" => "E")
                        ),
                        "Source" => array(
                           // "_attributes" => array("ReceivedFrom" => "SACSTesting")
                             "_attributes" => array("ReceivedFrom" => "6travelpainters")
                        )
                    )
                ),
                "SpecialReqDetails" => array(
                    "AddRemarkRQ" => array(
                        "RemarkInfo" => array(
                            "FOP_Remark" => array(
                                "_attributes" => array("Type" => "CASH"),
                            ),
                            "1" => array( //<Remark>
                                "_attributes" => array("Type" => "General"),
                                "Text" => "TEST GENERAL REMARK"
                            ),
                            "2" => array( //<Remark>
                                "_attributes" => array("Type" => "Hidden"),
                                "Text" => "TEST HIDDEN REMARK"
                            ),
                            "3" => array( //<Remark>
                                "_attributes" => array("Type" => "Historical"),
                                "Text" => "TEST HISTORICAL REMARK"
                            )
                        )
                    )
                ),
                "TravelItineraryAddInfoRQ" => array(
                    "AgencyInfo" => array(
                        "Ticketing" => array(
                            "_attributes" => array("TicketType" => "7T-A")
                        )
                    )
                )
            )
        );

        //echo XMLSerializer::generateValidXmlFromArray($requestArray, null, "Remark"); die;
        return XMLSerializer::generateValidXmlFromArray($requestArray, null, "Remark");
    }
}
