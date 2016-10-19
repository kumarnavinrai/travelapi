<?php
include_once 'workflow/Workflow.php';
//include_once 'soap_activities/CreditVerificationSoapActivity.php';
include_once 'soap_activities/PassengerDetailsNameOnlyActivity.php';
//header('Content-Type: application/json');
//echo json_encode(array(1,2,3,4,5,6,7,8,9)); die;

$bodycontent = $_REQUEST['btb'];
$data = base64_decode($_REQUEST['btb']);

$data = explode("###", $data);

parse_str($data[0], $noofpassengersandallflightdata);
parse_str($data[1], $creditcarddata);
parse_str($data[2], $customerinfo);
$allflightdata = $noofpassengersandallflightdata['allflightdata'];
$allflightdata = str_replace("'", '"', $allflightdata);

$allflightdatatosave = $allflightdata;

$allflightdata = json_decode($allflightdata);

$bookingdata = $allflightdata;

//echo "<pre>"; 
//print_r($noofpassengersandallflightdata); 
//print_r($creditcarddata); 
//print_r($customerinfo); 

$countofpassenger = 0;
$i=1;
$passengerinfo = array();
for ($i=1; $i < 10 ; $i++) { 
    $fnkey = 'fn'.$i;
    $mnkey = 'mn'.$i;
    $lnkey = 'ln'.$i;
    $dobkey = 'dob'.$i;
    $sexkey = 'sex'.$i;

    $firstname = isset($noofpassengersandallflightdata[$fnkey])?$noofpassengersandallflightdata[$fnkey]:"none";
    $middlename = isset($noofpassengersandallflightdata[$mnkey])?$noofpassengersandallflightdata[$mnkey]:"none";
    $lastname = isset($noofpassengersandallflightdata[$lnkey])?$noofpassengersandallflightdata[$lnkey]:"none";
    $dob = isset($noofpassengersandallflightdata[$dobkey])?$noofpassengersandallflightdata[$dobkey]:"none";
    $sex = isset($noofpassengersandallflightdata[$sexkey])?$noofpassengersandallflightdata[$sexkey]:"none";
    if($firstname  != 'none')
    {
      $passengerinfo[$i] = array($firstname,$middlename,$lastname,$dob,$sex,$countofpassenger);
      $countofpassenger++;
    }
}          

$noofpassengersandallflightdata['allflightdata'] = str_replace("'", '"', $noofpassengersandallflightdata['allflightdata']);
$flightdata = json_decode($noofpassengersandallflightdata['allflightdata']);
//echo "<pre>"; print_r($flightdata); die;

$arrayofallflightsfinal = array();
if(isset($flightdata->wholedataofamadeusoneitinerary->OriginDestinationOptions) && $flightdata->wholedataofamadeusoneitinerary->OriginDestinationOptions)
{
  $arrayofallflightsfinal =  makeDatawithSabre($flightdata,$countofpassenger);  
}
elseif(isset($flightdata->wholedataofamadeusoneitinerary->itineraries) && $flightdata->wholedataofamadeusoneitinerary->itineraries)
{

  $arrayofallflightsfinal = makeamadeusdata($flightdata,$countofpassenger);
}


function makeamadeusdata($flightdata,$countofpassenger)
{
   $rtnanddep = $flightdata->wholedataofamadeusoneitinerary->itineraries;
   $arrayofallflights = array();
   if($rtnanddep)
    {
    
      foreach ($rtnanddep as $keyone => $inoroutbound) 
      {
        $outbount = $inoroutbound->outbound->flights;
        if(isset($outbount) && $outbount)
        {  
          foreach ($outbount as $keynext => $fsegment) 
          { 
            $oneflight = $fsegment;   
            $flightSegment = $oneflight;
            if(isset($flightSegment->departs_at))
            {

              $destinationLocation = $flightSegment->destination->airport;
              $equipment = $flightSegment->aircraft;
              $marketingAirlineCode = $flightSegment->marketing_airline;
              $marketingAirlineFlightNumber = $flightSegment->flight_number;
              $operatingAirlineCode = $flightSegment->operating_airline;
              $originLocation = $flightSegment->origin->airport;
              $departureDateTime = $flightSegment->departs_at;
              $flightNumber = $flightSegment->flight_number;
              $numberInParty = $countofpassenger;
              $resBookDesigCode = $flightSegment->booking_info->booking_code;

              $arrayofallflights[] = array("destinationLocation"=>$destinationLocation,"equipment"=>$equipment,"marketingAirlineCode"=>$marketingAirlineCode,"marketingAirlineFlightNumber"=>$marketingAirlineFlightNumber,"operatingAirlineCode"=>$operatingAirlineCode,"originLocation"=>$originLocation,"departureDateTime"=>$departureDateTime,"flightNumber"=>$flightNumber,"numberInParty"=>$numberInParty,"resBookDesigCode"=>$resBookDesigCode);
            }    
          }
        }

        $outbount = $inoroutbound->inbound->flights;

        if(isset($outbount) && $outbount)
        {  
          foreach ($outbount as $keynext => $fsegment) 
          {
            $oneflight = $fsegment;   
            $flightSegment = $oneflight;
            if(isset($flightSegment->departs_at))
            {

              $destinationLocation = $flightSegment->destination->airport;
              $equipment = $flightSegment->aircraft;
              $marketingAirlineCode = $flightSegment->marketing_airline;
              $marketingAirlineFlightNumber = $flightSegment->flight_number;
              $operatingAirlineCode = $flightSegment->operating_airline;
              $originLocation = $flightSegment->origin->airport;
              $departureDateTime = $flightSegment->departs_at;
              $flightNumber = $flightSegment->flight_number;
              $numberInParty = $countofpassenger;
              $resBookDesigCode = $flightSegment->booking_info->booking_code;


                $arrayofallflights[] = array("destinationLocation"=>$destinationLocation,"equipment"=>$equipment,"marketingAirlineCode"=>$marketingAirlineCode,"marketingAirlineFlightNumber"=>$marketingAirlineFlightNumber,"operatingAirlineCode"=>$operatingAirlineCode,"originLocation"=>$originLocation,"departureDateTime"=>$departureDateTime,"flightNumber"=>$flightNumber,"numberInParty"=>$numberInParty,"resBookDesigCode"=>$resBookDesigCode);
            }    
          }
        }
      }
    }

    return $arrayofallflights;
}

function makeDatawithSabre($flightdata,$countofpassenger)
{

      //this check is for 

    $rtnanddep = $flightdata->wholedataofamadeusoneitinerary->OriginDestinationOptions->OriginDestinationOption;

    if($rtnanddep)
    {
      $arrayofallflights = array();
      foreach ($rtnanddep as $keyone => $inoroutbound) 
      { 
        $tocheck = is_object($inoroutbound->FlightSegment);
        
        $outbount = $tocheck?array(0=>$inoroutbound):$inoroutbound->FlightSegment;   
       
        if(isset($outbount) && $outbount)
        {  
          foreach ($outbount as $keynext => $fsegment) 
          {
              
            
            $oneflight = isset($fsegment->FlightSegment)?$fsegment->FlightSegment:$fsegment;   
            $flightSegment = $oneflight;
            $key = '@attributes';
            
            if(isset($flightSegment->DepartureAirport->$key))
            {  
                $destinationLocation = $flightSegment->ArrivalAirport->$key->LocationCode;
                $equipment = $flightSegment->Equipment->$key->AirEquipType;
                $marketingAirlineCode = $flightSegment->MarketingAirline->$key->Code;
                $marketingAirlineFlightNumber = $flightSegment->$key->FlightNumber;
                $operatingAirlineCode = $flightSegment->OperatingAirline->$key->Code;
                $originLocation = $flightSegment->DepartureAirport->$key->LocationCode;
                $departureDateTime = $flightSegment->$key->DepartureDateTime;
                $flightNumber = $flightSegment->$key->FlightNumber;
                $numberInParty = $countofpassenger;
                $resBookDesigCode = $flightSegment->$key->ResBookDesigCode;
            }
            elseif(!isset($flightSegment->DepartureAirport->$key))
            {

              $destinationLocation = $flightSegment->ArrivalAirport->LocationCode;
              $equipment = $flightSegment->Equipment->AirEquipType;
              $marketingAirlineCode = $flightSegment->MarketingAirline->Code;
              $marketingAirlineFlightNumber = $flightSegment->FlightNumber;
              $operatingAirlineCode = $flightSegment->OperatingAirline->Code;
              $originLocation = $flightSegment->DepartureAirport->LocationCode;
              $departureDateTime = $flightSegment->DepartureDateTime;
              $flightNumber = $flightSegment->FlightNumber;
              $numberInParty = $countofpassenger;
              $resBookDesigCode = $flightSegment->ResBookDesigCode;


            }    

                $arrayofallflights[] = array("destinationLocation"=>$destinationLocation,"equipment"=>$equipment,"marketingAirlineCode"=>$marketingAirlineCode,"marketingAirlineFlightNumber"=>$marketingAirlineFlightNumber,"operatingAirlineCode"=>$operatingAirlineCode,"originLocation"=>$originLocation,"departureDateTime"=>$departureDateTime,"flightNumber"=>$flightNumber,"numberInParty"=>$numberInParty,"resBookDesigCode"=>$resBookDesigCode);

          }
        }    
      }  
    }

    return $arrayofallflights;
}  

$numberofflights = count($arrayofallflightsfinal);  
$passengerinfo['custinfo'] =  $customerinfo; 
$passengerinfo['numberofflights'] =  $numberofflights;  

$_REQUEST['bdata']  = json_encode($arrayofallflightsfinal);

//echo "<pre>";
//print_r($_REQUEST); 
//die;

$workflow = new Workflow(new PassengerDetailsNameOnlyActivity($passengerinfo));
//CreditVerificationRQ$workflow = new Workflow(new PassengerDetailsNameOnlyActivity());
//$workflow = new Workflow(new VerifyFlightDetailsSoapActivity());
//$workflow = new Workflow(new CreditVerificationSoapActivity());
$result = $workflow->runWorkflow();

if(isset($result))
{  
    $resultmain = reset($result);
    $PassengerDetailsNameOnlyRS=array();
    if(isset($resultmain["PassengerDetailsNameOnlyRS"]))
    {
      $result = $resultmain["PassengerDetailsNameOnlyRS"];

      $PassengerDetailsNameOnlyRS = XML2Array::createArray($result);
    }  

    $EnhancedAirBookRS = array();
    if(isset($resultmain["EnhancedAirBookRS"]))
    {
      $result = $resultmain["EnhancedAirBookRS"];

      $EnhancedAirBookRS = XML2Array::createArray($result);
    } 

    $PassengerDetailsRS = array();
    if(isset($resultmain["PassengerDetailsRS"]))
    {
      $result = $resultmain["PassengerDetailsRS"];

      $PassengerDetailsRS = XML2Array::createArray($result);
    }

    $TravelItineraryReadRS = array();
    if(isset($resultmain["TravelItineraryReadRS"]))
    {
      $result = $resultmain["TravelItineraryReadRS"];

      $TravelItineraryReadRS = XML2Array::createArray($result);
    }  

    $response = array("PassengerDetailsNameOnlyRS"=>$PassengerDetailsNameOnlyRS,"EnhancedAirBookRS"=>$EnhancedAirBookRS,"PassengerDetailsRS"=>$PassengerDetailsRS,"TravelItineraryReadRS"=>$TravelItineraryReadRS);

    $jsondata = json_encode($response);
    $datatosend = array("data"=>base64_encode($jsondata));
    echo json_encode($datatosend);
    die;
    

}
else
{
  echo json_encode($response);
  die;
}    

if(!isset($arrayverifyflight["OriginDestinationOptions"]))
{
	echo json_encode(array("Error"=>"Flight invalid"));
	die;
}
else
{
	$terminal = $arrayverifyflight["OriginDestinationOptions"]["OriginDestinationOption"]["FlightSegment"]["DestinationLocation"]["@attributes"]["Terminal"];
	$airequptype = 	$arrayverifyflight["OriginDestinationOptions"]["OriginDestinationOption"]["FlightSegment"]["Equipment"]["@attributes"]["AirEquipType"];
	$mealcodesans = array();
	$mealcodes = $arrayverifyflight["OriginDestinationOptions"]["OriginDestinationOption"]["FlightSegment"]["Meal"];
	foreach ($mealcodes as $key => $value) {
	 	$mealcodesans[]=$value["@attributes"]["Code"];
	 } 
	$airflownmiles = $arrayverifyflight["OriginDestinationOptions"]["OriginDestinationOption"]["FlightSegment"]["@attributes"]["AirMilesFlown"]; 
	echo json_encode(array("terminal"=>$terminal,"airequptype"=>$airequptype,"mealcodes"=>$mealcodes,"airflownmiles"=>$airflownmiles));
	die;
}


echo json_encode(array("Error"=>"Flight invalid"));
die;


/**
 * XML2Array: A class to convert XML to array in PHP
 * It returns the array which can be converted back to XML using the Array2XML script
 * It takes an XML string or a DOMDocument object as an input.
 *
 * See Array2XML: http://www.lalit.org/lab/convert-php-array-to-xml-with-attributes
 *
 * Author : Lalit Patel
 * Website: http://www.lalit.org/lab/convert-xml-to-array-in-php-xml2array
 * License: Apache License 2.0
 *          http://www.apache.org/licenses/LICENSE-2.0
 * Version: 0.1 (07 Dec 2011)
 * Version: 0.2 (04 Mar 2012)
 *      Fixed typo 'DomDocument' to 'DOMDocument'
 *
 * Usage:
 *       $array = XML2Array::createArray($xml);
 */

class XML2Array {

    private static $xml = null;
  private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DOMDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
    self::$encoding = $encoding;
    }

    /**
     * Convert an XML to Array
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMDocument
     */
    public static function &createArray($input_xml) {
        $xml = self::getXMLRoot();
    if(is_string($input_xml)) {
      $parsed = $xml->loadXML($input_xml);
      if(!$parsed) {
        throw new Exception('[XML2Array] Error parsing the XML string.');
      }
    } else {
      if(get_class($input_xml) != 'DOMDocument') {
        throw new Exception('[XML2Array] The input XML object should be of type: DOMDocument.');
      }
      $xml = self::$xml = $input_xml;
    }
    $array[$xml->documentElement->tagName] = self::convert($xml->documentElement);
        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $array;
    }

    /**
     * Convert an Array to XML
     * @param mixed $node - XML as a string or as an object of DOMDocument
     * @return mixed
     */
    private static function &convert($node) {
    $output = array();

    switch ($node->nodeType) {
      case XML_CDATA_SECTION_NODE:
        $output['@cdata'] = trim($node->textContent);
        break;

      case XML_TEXT_NODE:
        $output = trim($node->textContent);
        break;

      case XML_ELEMENT_NODE:

        // for each child node, call the covert function recursively
        for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
          $child = $node->childNodes->item($i);
          $v = self::convert($child);
          if(isset($child->tagName)) {
            $t = $child->tagName;

            // assume more nodes of same kind are coming
            if(!isset($output[$t])) {
              $output[$t] = array();
            }
            $output[$t][] = $v;
          } else {
            //check if it is not an empty text node
            if($v !== '') {
              $output = $v;
            }
          }
        }

        if(is_array($output)) {
          // if only one node of its kind, assign it directly instead if array($value);
          foreach ($output as $t => $v) {
            if(is_array($v) && count($v)==1) {
              $output[$t] = $v[0];
            }
          }
          if(empty($output)) {
            //for empty nodes
            $output = '';
          }
        }

        // loop through the attributes and collect them
        if($node->attributes->length) {
          $a = array();
          foreach($node->attributes as $attrName => $attrNode) {
            $a[$attrName] = (string) $attrNode->value;
          }
          // if its an leaf node, store the value in @value instead of directly storing it.
          if(!is_array($output)) {
            $output = array('@value' => $output);
          }
          $output['@attributes'] = $a;
        }
        break;
    }
    return $output;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }
}