<?php
include_once 'workflow/Activity.php';
include_once 'soap/SACSSoapClient.php';
include_once 'soap_activities/PassengerDetailsActivity.php';

class EnhancedAirBookActivity implements Activity {

    private $config;
    
    public function __construct() {
        $this->config = SACSConfig::getInstance();

    }

    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("EnhancedAirBookRQ");
        $soapClient->setLastInFlow(false);

        //$bfmResult = $sharedContext->getResult("BargainFinderMaxRS");
        //$xmlRequest = $this->getRequest($bfmResult);
        $xmlRequest = $this->getRequest();

        $sharedContext->addResult("EnhancedAirBookRQ", $xmlRequest);
        $res = $soapClient->doCall($sharedContext, $xmlRequest);
       
        $sharedContext->addResult("EnhancedAirBookRS", $res);
        return new PassengerDetailsActivity();
    }
    
    //private function getRequest($bfmResult) {
    private function getRequest() {
        //$bfm = new DOMDocument();
        //$bfm->loadXML($bfmResult);
        
        $flightSegment = json_decode($_REQUEST['bdata']);
        $flightSegment = reset($flightSegment);
        
        $destinationLocation = $flightSegment->destinationLocation;
        $equipment = $flightSegment->equipment;
        $marketingAirlineCode = $flightSegment->marketingAirlineCode;
        $marketingAirlineFlightNumber = $flightSegment->marketingAirlineFlightNumber;
        $operatingAirlineCode = $flightSegment->operatingAirlineCode;
        $originLocation = $flightSegment->originLocation;
        $departureDateTime = $flightSegment->departureDateTime;
        $flightNumber = $flightSegment->flightNumber;
        $numberInParty = $flightSegment->numberInParty;
        $resBookDesigCode = $flightSegment->resBookDesigCode;

        $requestArray = array(
            "EnhancedAirBookRQ" => array(
                "_attributes" => array(
                    "HaltOnError" => "false",
                    "version" => $this->config->getSoapProperty("EnhancedAirBookRQVersion")
                ),
                "_namespace" => "http://services.sabre.com/sp/eab/v3_2",
                "OTA_AirBookRQ" => array(
                    "OriginDestinationInformation" => array(
                        "FlightSegment" => array(
                            "_attributes" => array(
                                "DepartureDateTime" => $departureDateTime,
                                "FlightNumber" => $flightNumber,
                                "NumberInParty" => $numberInParty,
                                "ResBookDesigCode" => $resBookDesigCode,
                                "Status" => "NN"
                            ),
                            "DestinationLocation" => array("_attributes" => array("LocationCode" => $destinationLocation)),
                            "Equipment" => array("_attributes" => array("AirEquipType" => $equipment)),
                            "MarketingAirline" => array("_attributes" => array("Code" => $marketingAirlineCode, "FlightNumber" => $marketingAirlineFlightNumber)),
                            "OperatingAirline" => array("_attributes" => array("Code" => $operatingAirlineCode)),
                            "OriginLocation" => array("_attributes" => array("LocationCode" => $originLocation))
                        )
                    )
                ),
                "OTA_AirPriceRQ" => array(
                    "PriceRequestInformation" => array(
                        "_attributes" => array("Retain" => "true"),
                        "OptionalQualifiers" => array(
                            "PricingQualifiers" => array(
                                "PassengerType" => array("_attributes" => array("Code" => "ADT", "Quantity" => "1"))
                            )
                        )
                    )
                ),
                "PostProcessing" => array(
                    "RedisplayReservation" => array("_attributes" => array("WaitInterval" => "2000"))
                )
            )
        );
        return XMLSerializer::generateValidXmlFromArray($requestArray);
    }
}


/*


        $xmltortn = '<EnhancedAirBookRQ HaltOnError="false" version="3.2.0"  xmlns="http://services.sabre.com/sp/eab/v3_2">';
            $xmltortn .= '<OTA_AirBookRQ>';
                $xmltortn .= '<OriginDestinationInformation>';

                        foreach ($flightSegment as $key => $value) 
                        {
                           $flightSegment = $value;
                           $destinationLocation = $flightSegment->destinationLocation;
                           $equipment = $flightSegment->equipment;
                           $marketingAirlineCode = $flightSegment->marketingAirlineCode;
                           $marketingAirlineFlightNumber = $flightSegment->marketingAirlineFlightNumber;
                           $operatingAirlineCode = $flightSegment->operatingAirlineCode;
                           $originLocation = $flightSegment->originLocation;
                           $departureDateTime = $flightSegment->departureDateTime;
                           $flightNumber = $flightSegment->flightNumber;
                           $numberInParty = $flightSegment->numberInParty;
                           $resBookDesigCode = $flightSegment->resBookDesigCode;


                            $xmltortn .= '<FlightSegment DepartureDateTime="'.$departureDateTime.'" FlightNumber="'.$flightNumber.'" NumberInParty="'.$numberInParty.'" ResBookDesigCode="'.$resBookDesigCode.'" Status="NN" >';
                                $xmltortn .= '<DestinationLocation LocationCode="'.$destinationLocation.'" ></DestinationLocation>';
                                $xmltortn .= '<Equipment AirEquipType="'.$equipment.'" ></Equipment>';
                                $xmltortn .= '<MarketingAirline Code="'.$marketingAirlineCode.'" FlightNumber="'.$marketingAirlineFlightNumber.'" ></MarketingAirline>';
                                $xmltortn .= '<OperatingAirline Code="'.$operatingAirlineCode.'" ></OperatingAirline>';
                                $xmltortn .= '<OriginLocation LocationCode="'.$originLocation.'" ></OriginLocation>';
                            $xmltortn .= '</FlightSegment>';
                        }    
                $xmltortn .= '</OriginDestinationInformation>';
            $xmltortn .= '</OTA_AirBookRQ>';
            $xmltortn .= '<OTA_AirPriceRQ>';
                $xmltortn .= '<PriceRequestInformation Retain="true" >';
                    $xmltortn .= '<OptionalQualifiers>';
                        $xmltortn .= '<PricingQualifiers>';
                        $xmltortn .= '<PassengerType Code="ADT" Quantity="1" ></PassengerType>';
                        $xmltortn .= '</PricingQualifiers>';
                    $xmltortn .= '</OptionalQualifiers>';
                $xmltortn .= '</PriceRequestInformation>';
            $xmltortn .= '</OTA_AirPriceRQ>';
            $xmltortn .= '<PostProcessing>';
            $xmltortn .= '<RedisplayReservation WaitInterval="2000" ></RedisplayReservation>';
            $xmltortn .= '</PostProcessing>';
        $xmltortn .= '</EnhancedAirBookRQ>';

        return $xmltortn; 

*/