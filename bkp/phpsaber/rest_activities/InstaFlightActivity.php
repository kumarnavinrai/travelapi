<?php
include_once 'workflow/Activity.php';
include_once 'rest_activities/BargainFinderMaxActivity.php';

class InstaFlightActivity implements Activity {

    
    
    public function run(&$sharedContext) {
        
        $call = new RestClient();
        $lpcResult = $sharedContext->getResult("LeadPriceCalendar");
        
        $origin = $sharedContext->getResult("origin");
    	$destination = $sharedContext->getResult("destination");
		$departureDate = $sharedContext->getResult("departureDate");
		$departuredate = $sharedContext->getResult("departureDate");
		$returndate = $sharedContext->getResult("returndate");
		$limit = $sharedContext->getResult("limit");
		$outboundflightstops = $sharedContext->getResult("outboundflightstops");
		$outbounddeparturewindow = $sharedContext->getResult("outbounddeparturewindow");
		$includedcarriers = $sharedContext->getResult("includedcarriers");
		$inboundstopduration = $sharedContext->getResult("inboundstopduration");
		$outboundstopduration = $sharedContext->getResult("inboundstopduration");
		$passengercount = $sharedContext->getResult("passengercount");
		$lengthofstay = $sharedContext->getResult("lengthofstay");


		if($returndate != ""){
			$returndate = "&returndate=".$returndate;
		}else{
			$returndate = "";
		}

		$outboundflightstops;
		$inboundflightstops;
		if($outboundflightstops != ""){
			$outboundflightstops = "&outboundflightstops=".$outboundflightstops;
			$inboundflightstops = "&inboundflightstops=".$outboundflightstops;
		}else{
			$outboundflightstops = "";
			$inboundflightstops = "";
		}

		$outbounddeparturewindow;
		$inbounddeparturewindow;
		if($outbounddeparturewindow != ""){
			$outbounddeparturewindow = "&outbounddeparturewindow=".$outbounddeparturewindow;
			$inbounddeparturewindow = "&inbounddeparturewindow=".$outbounddeparturewindow;
		}else{
			$outbounddeparturewindow = "";
			$inbounddeparturewindow = "";
		}

		$includedcarriers;
		if($includedcarriers != ""){
			$includedcarriers = "&includedcarriers=".$includedcarriers;
		}else{
			$includedcarriers = "";
		}
		
		$inboundstopduration;
		$outboundstopduration;
		if($inboundstopduration != "" && $inboundstopduration != 0){
			$inboundstopduration = "&inboundstopduration=".$inboundstopduration;
			$outboundstopduration = "&outboundstopduration=".$inboundstopduration;
		}else{
			$inboundstopduration = "";
			$outboundstopduration = "";
		}

		$limit;
		if($limit != ""){
			$limit = "&limit=".$limit;
		}else{
			$limit = "";
		}
		$passengercount;
		if(isset($passengercount)&&$passengercount != 0){
			$passengercount = "&passengercount=".$passengercount;
		}
		
		//var durl = "https://api.sabre.com/v1/shop/flights?origin="+formValue.origin+"&destination="+formValue.destination+"&departuredate="+formValue.departuredate+returndate+outboundflightstops+inboundflightstops+outbounddeparturewindow+inbounddeparturewindow+includedcarriers+inboundstopduration+outboundstopduration+"&onlineitinerariesonly=N"+limit+"&offset=1&eticketsonly=Y&sortby=totalfare&order=asc&sortby2=departuretime&order2=asc&pointofsalecountry=US";
		$durl = "https://api.sabre.com/v1/shop/flights?origin=".$origin."&destination=".$destination."&departuredate=".$departuredate.$returndate.$outboundflightstops.$inboundflightstops.$outbounddeparturewindow.$inbounddeparturewindow.$includedcarriers.$inboundstopduration.$outboundstopduration.$limit."&offset=1&sortby=totalfare&order=asc&sortby2=departuretime&order2=asc&pointofsalecountry=US".$passengercount;
		

        //$url = $lpcResult->FareInfo[0]->Links[0]->href;
        $url = $durl;
        
        //echo $url; die; 
        $result = $call->executeGetCall($url, null);
       
        $sharedContext->addResult("InstaFlight", $result);
        
        return null;	
        //return new BargainFinderMaxActivity();
    }

}
