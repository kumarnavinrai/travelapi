<?php
include_once 'workflow/Activity.php';
include_once 'rest/RestClient.php';
include_once 'rest_activities/InstaFlightActivity.php';

class LeadPriceCalendarActivity implements Activity {

    private $origin, $destination, $departureDate, $returndate, $limit, $outboundflightstops, $outbounddeparturewindow, $includedcarriers, $inboundstopduration, $outboundstopduration, $passengercount, $lengthofstay;
    
    public function __construct($origin, $destination, $departureDate, $returndate, $limit, $outboundflightstops, $outbounddeparturewindow, $includedcarriers, $inboundstopduration, $outboundstopduration, $passengercount, $lengthofstay) {

        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
        $this->returndate = $returndate;
        $this->limit = $limit; 
        $this->outboundflightstops = $outboundflightstops; 
        $this->outbounddeparturewindow =  $outbounddeparturewindow;
        $this->includedcarriers = $includedcarriers;
        $this->inboundstopduration = $inboundstopduration; 
        $this->outboundstopduration = $outboundstopduration;
        $this->passengercount = $passengercount; 
        $this->lengthofstay = $lengthofstay;
    }
    
    public function run(&$sharedContext) {

        $sharedContext->addResult("origin", $this->origin);
        $sharedContext->addResult("destination", $this->destination);
        $sharedContext->addResult("departureDate", $this->departureDate);
        $sharedContext->addResult("returndate", $this->returndate);
        $sharedContext->addResult("limit", $this->limit);
        $sharedContext->addResult("outboundflightstops", $this->outboundflightstops);
        $sharedContext->addResult("outbounddeparturewindow", $this->outbounddeparturewindow);
        $sharedContext->addResult("includedcarriers", $this->includedcarriers);
        $sharedContext->addResult("inboundstopduration", $this->inboundstopduration);
        $sharedContext->addResult("outboundstopduration", $this->outboundstopduration);
        $sharedContext->addResult("passengercount", $this->passengercount);
        $sharedContext->addResult("lengthofstay", $this->lengthofstay);


        $call = new RestClient();
        $result = $call->executeGetCall("/v2/shop/flights/fares", $this->getRequest($this->origin, $this->destination, $this->departureDate, $this->returndate, $this->limit, $this->outboundflightstops, $this->outbounddeparturewindow, $this->includedcarriers, $this->inboundstopduration, $this->outboundstopduration, $this->passengercount, $this->lengthofstay));
        $sharedContext->addResult("LeadPriceCalendar", $result);
        return new InstaFlightActivity();
    }
    
    private function getRequest($origin, $destination, $departureDate, $returndate, $limit, $outboundflightstops, $outbounddeparturewindow, $includedcarriers, $inboundstopduration, $outboundstopduration, $passengercount, $lengthofstay) {
        $request = array(
                "lengthofstay" => $lengthofstay,
                "pointofsalecountry" => "US",
                "origin" => $origin,
                "destination" => $destination,
                "departuredate" => $departureDate,
                "returndate" => $returndate,
                "limit" => $limit,
                "outboundflightstops" => $outboundflightstops,
                "outbounddeparturewindow" => $outbounddeparturewindow,
                "inboundstopduration" => $inboundstopduration,
                "outboundstopduration" => $outboundstopduration,
                "passengercount" => $passengercount

        );
        
        return $request;
    }
}
