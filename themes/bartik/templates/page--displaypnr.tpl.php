<?php 
      $themeurl = file_create_url(path_to_theme());
      global $base_url;
     
       
      if(isset($_REQUEST['pnrid']) && $_REQUEST['pnrid'])
      {
        $url = $base_url."/phpsaber/getpnr.php";
        $params = array('pnrid'=>$_REQUEST['pnrid']); 
        $datatodisplay = getData($url, $params); 
        $datatodisplay =json_decode($datatodisplay);
       //echo "<pre>dfsdfsfs"; print_r($datatodisplay); die;
        $key = "tir38:TravelItinerary";
        $keycust = 'tir38:CustomerInfo';
        $keyitinery = 'tir38:ItineraryInfo';

        $customerinfo = (array)$datatodisplay->$key->$keycust;
        $customerinfo = objectToArray($customerinfo);

        $ItineraryInfo = (array)$datatodisplay->$key->$keyitinery;
        $ItineraryInfo = objectToArray($ItineraryInfo);

        if(isset($ItineraryInfo["tir38:ItineraryPricing"]))
        {
          if(isset($ItineraryInfo["tir38:ItineraryPricing"]["tir38:PriceQuote"]))
          {
            $priceQuote = $ItineraryInfo["tir38:ItineraryPricing"]["tir38:PriceQuote"]; 
            
            if($priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"])
            {
              $AirItineraryPricingInfo = $priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"];

              if($priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"]["tir38:ItinTotalFare"])
              {
                $basefare = $priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"]["tir38:ItinTotalFare"]["tir38:BaseFare"]["@attributes"]["Amount"];
                $basefareCurrency = $priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"]["tir38:ItinTotalFare"]["tir38:BaseFare"]["@attributes"]["CurrencyCode"];
                $taxes = $priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"]["tir38:ItinTotalFare"]["tir38:Taxes"];
                $ItinTotalFare =$priceQuote["tir38:PricedItinerary"]["tir38:AirItineraryPricingInfo"]["tir38:ItinTotalFare"];
                
              }
              
            }
            if(isset($ItineraryInfo["tir38:ItineraryPricing"]["tir38:PriceQuote"]["tir38:MiscInformation"]))
            {
              if(isset($ItineraryInfo["tir38:ItineraryPricing"]["tir38:PriceQuote"]["tir38:MiscInformation"]["tir38:BaggageFees"]))
              {

                $baggageinfo = $ItineraryInfo["tir38:ItineraryPricing"]["tir38:PriceQuote"]["tir38:MiscInformation"]["tir38:BaggageFees"]["tir38:Text"];
              }  
            }  
          }  
        }  

        //echo "<pre>"; print_r($customerinfo); print_r($ItineraryInfo); die;
        /*$out = array2table($customerinfo, true, '&nbsp;');
        $custinfo = str_replace("tir38:", "", $out);
        $out = array2table($ItineraryInfo, true, '&nbsp;');
        
        $custinfo = str_replace("tir38:", "", $custinfo);
        while(strpos($custinfo, "@value") != false )
        {
          $custinfo = str_replace("@value", "", $custinfo); 
        }

        while(strpos($custinfo, "@attributes") != false )
        {
          $custinfo = str_replace("@attributes", "", $custinfo);
        }

        $ItineraryInfo = str_replace("tir38:", "", $out);
        while(strpos($ItineraryInfo, "@value") != false )
        {
          $ItineraryInfo = str_replace("@value", "", $ItineraryInfo); 
        }

        while(strpos($ItineraryInfo, "@attributes") != false )
        {
          $ItineraryInfo = str_replace("@attributes", "", $ItineraryInfo);
        }*/
        
        
    
        //getData($url, $params=array()) 
      }

function array2table($array, $recursive = false, $null = '&nbsp;')
{ 
    // Sanity check
    if (empty($array) || !is_array($array)) { 
        return false;
    }

    if (!isset($array[0]) || !is_array($array[0])) {
        $array = array($array);
    }

    // Start the table
    $table = "<table>\n";

    // The header
    $table .= "\t<tr>"; 
    // Take the keys from the first row as the headings
    foreach (array_keys($array[0]) as $heading) {
        // $table .= '<th>' . $heading . '</th>';
       $table .= '<th>' . $heading . '</th>';
    }
    $table .= "</tr>\n";

    // The body
    foreach ($array as $row) {
        $table .= "\t<tr>" ;
        foreach ($row as $cell) {
            $table .= '<td>';

            // Cast objects
            if (is_object($cell)) { $cell = (array) $cell; }
            
            if ($recursive === true && is_array($cell) && !empty($cell)) {
                // Recursive mode
                $table .= "\n" . array2table($cell, true, true) . "\n";
            } else {
                $table .= (strlen($cell) > 0) ?
                    htmlspecialchars((string) $cell) :
                    $null;
            }

            $table .= '</td>';
        }

        $table .= "</tr>\n";
    }

    $table .= '</table>';
    return $table;
}
     



function objectToArray($d) 
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
} 
   
 ?>
 

  
 <div class="gap"></div>
 <div class="container">
   <div class="row row-wrap">
      
      <div class="col-md-12">
         <h1>DISPLAY PNR</h1>
         
         
         <!-- <div id="abhiFlightDetails">
            <?php 
                 /*if(isset($customerinfo))
                 { 
                    //echo "<pre>"; print_r($customerinfo); die;
                    //contactnumbers
                    $contactnumbers = $customerinfo["tir38:ContactNumbers"];
                    if(isset($contactnumbers[0]))
                    {  
                      foreach ($contactnumbers as $key => $value) 
                      {
                        echo "Phone: ".$value["@attributes"]["Phone"]."</br>";
                      }
                    }else
                    {
                      echo "Phone: ".$contactnumbers["tir38:ContactNumber"]["@attributes"]["Phone"]."</br>";  
                    }  

                    $names = $customerinfo["tir38:PersonName"];
                    if(isset($names[0]))
                    {
                      foreach ($names as $key => $value) 
                      {
                        echo "GivenName: ".$value["tir38:GivenName"]."</br>";
                        echo "Surname: ".$value["tir38:Surname"]."</br>";
                        echo "WithInfant: ".$value["@attributes"]["WithInfant"]."</br>";
                        echo "NameReference: ".$value["@attributes"]["NameReference"]."</br>";
                      }
                    }else
                    {
                      echo "GivenName: ".$names["tir38:GivenName"]."</br>";
                      echo "Surname: ".$names["tir38:Surname"]."</br>";
                      echo "WithInfant: ".$names["@attributes"]["WithInfant"]."</br>";
                      echo "NameReference: ".$names["@attributes"]["NameReference"]."</br>";
                    }
                    //echo "<pre>sss"; print_r($customerinfo); die;
                   

                 }*/
            ?> 

            <?php 
                /* if(isset($ItineraryInfo))
                 { 
                    //echo "<pre>sss"; print_r($ItineraryInfo); die;
                    $Itinerary = $ItineraryInfo["tir38:ReservationItems"]["tir38:Item"];
                    if(isset($Itinerary[0]))
                    {
                      foreach ($Itinerary as $key => $value) {
                        echo "DestinationLocation LocationCode: ".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["LocationCode"]."</br>";
                        echo "DestinationLocation Terminal: ".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["Terminal"]."</br>";
                        echo "TerminalCode: ".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["TerminalCode"]."</br>";
                        echo "Equipment AirEquipType: ".$value["tir38:FlightSegment"]["tir38:Equipment"]["@attributes"]["AirEquipType"]."</br>";
                        echo "MarketingAirline Banner: ".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["tir38:Banner"]."</br>";
                        echo "MarketingAirline Code: ".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["Code"]."</br>";
                        echo "MarketingAirline FlightNumber: ".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["FlightNumber"]."</br>";
                        echo "OperatingAirline Banner: ".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["tir38:Banner"]."</br>";
                        echo "OperatingAirline Code: ".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["Code"]."</br>";
                        echo "OperatingAirline FlightNumber: ".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["FlightNumber"]."</br>";
                        echo "OriginLocation LocationCode: ".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["LocationCode"]."</br>";
                        echo "OriginLocation Terminal: ".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["Terminal"]."</br>";
                        echo "OriginLocation LocationCode: ".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["TerminalCode"]."</br>";
                        echo "AirMilesFlown: ".$value["tir38:FlightSegment"]["@attributes"]["AirMilesFlown"]."</br>";
                        echo "ArrivalDateTime: ".$value["tir38:FlightSegment"]["@attributes"]["ArrivalDateTime"]."</br>";
                        echo "DayOfWeekInd: ".$value["tir38:FlightSegment"]["@attributes"]["DayOfWeekInd"]."</br>";
                        echo "DepartureDateTime: ".$value["tir38:FlightSegment"]["@attributes"]["DepartureDateTime"]."</br>";
                        echo "ElapsedTime: ".$value["tir38:FlightSegment"]["@attributes"]["ElapsedTime"]."</br>";
                        echo "FlightNumber: ".$value["tir38:FlightSegment"]["@attributes"]["FlightNumber"]."</br>";
                        echo "NumberInParty: ".$value["tir38:FlightSegment"]["@attributes"]["NumberInParty"]."</br>";
                        echo "SmokingAllowed: ".$value["tir38:FlightSegment"]["@attributes"]["SmokingAllowed"]."</br>";
                        echo "SpecialMeal: ".$value["tir38:FlightSegment"]["@attributes"]["SpecialMeal"]."</br>";
                      }
                    }else
                    {
                      $value = $Itinerary;
                      echo "DestinationLocation LocationCode: ".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["LocationCode"]."</br>";
                        echo "DestinationLocation Terminal: ".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["Terminal"]."</br>";
                        echo "TerminalCode: ".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["TerminalCode"]."</br>";
                        echo "Equipment AirEquipType: ".$value["tir38:FlightSegment"]["tir38:Equipment"]["@attributes"]["AirEquipType"]."</br>";
                        echo "MarketingAirline Banner: ".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["tir38:Banner"]."</br>";
                        echo "MarketingAirline Code: ".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["Code"]."</br>";
                        echo "MarketingAirline FlightNumber: ".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["FlightNumber"]."</br>";
                        echo "OperatingAirline Banner: ".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["tir38:Banner"]."</br>";
                        echo "OperatingAirline Code: ".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["Code"]."</br>";
                        echo "OperatingAirline FlightNumber: ".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["FlightNumber"]."</br>";
                        echo "OriginLocation LocationCode: ".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["LocationCode"]."</br>";
                        echo "OriginLocation Terminal: ".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["Terminal"]."</br>";
                        echo "OriginLocation LocationCode: ".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["TerminalCode"]."</br>";
                        echo "AirMilesFlown: ".$value["tir38:FlightSegment"]["@attributes"]["AirMilesFlown"]."</br>";
                        echo "ArrivalDateTime: ".$value["tir38:FlightSegment"]["@attributes"]["ArrivalDateTime"]."</br>";
                        echo "DayOfWeekInd: ".$value["tir38:FlightSegment"]["@attributes"]["DayOfWeekInd"]."</br>";
                        echo "DepartureDateTime: ".$value["tir38:FlightSegment"]["@attributes"]["DepartureDateTime"]."</br>";
                        echo "ElapsedTime: ".$value["tir38:FlightSegment"]["@attributes"]["ElapsedTime"]."</br>";
                        echo "FlightNumber: ".$value["tir38:FlightSegment"]["@attributes"]["FlightNumber"]."</br>";
                        echo "NumberInParty: ".$value["tir38:FlightSegment"]["@attributes"]["NumberInParty"]."</br>";
                        echo "SmokingAllowed: ".$value["tir38:FlightSegment"]["@attributes"]["SmokingAllowed"]."</br>";
                        echo "SpecialMeal: ".$value["tir38:FlightSegment"]["@attributes"]["SpecialMeal"]."</br>";
                    }
                 }


                 if(isset($baggageinfo))
                 {
                  echo "Baggage Info: ";
                  foreach ($baggageinfo as $key => $value) {
                    echo $value."</br>";
                  }
                 }

                 if(isset($basefare) && isset($basefareCurrency))
                 {
                  echo "Base Fare: ".$basefare."</br>";
                  echo "Base Fare Currency: ".$basefareCurrency."</br>";
                  echo "Tax Amount: ".$taxes["tir38:Tax"]["@attributes"]["Amount"]."</br>";
                  echo "TaxCode: ".$taxes["tir38:Tax"]["@attributes"]["TaxCode"]."</br>";
                  echo "TotalFare: ".$ItinTotalFare["tir38:TotalFare"]["@attributes"]["Amount"]."</br>";
                  echo "Currency Code: ".$ItinTotalFare["tir38:TotalFare"]["@attributes"]["CurrencyCode"]."</br>";
                  
                 }

                 if(isset($AirItineraryPricingInfo))
                 {
                  echo "Passenger Code: ".$AirItineraryPricingInfo["tir38:PassengerTypeQuantity"]["@attributes"]["Code"]."</br>";
                  echo "Passenger Quantity: ".$AirItineraryPricingInfo["tir38:PassengerTypeQuantity"]["@attributes"]["Quantity"]."</br>";
                 }*/
            ?> 
            <?php //print render($page['content']); ?>
            <div id="abhiOrigin" class="abhiOriginDestination"><?php  //$top = field_get_items('node', $node, 'field_from'); print $top[0]['value']; ?></div>
            <div id="abhiarrowHtml" class="abhiarrowHtml"></div>
            <div id="abhiDestination" class="abhiOriginDestination"><?php // $top = field_get_items('node', $node, 'field_to'); print $top[0]['value']; ?></div>
            <div id="abhiFromTxt"></div>
            <div class="abhifarePrice" id="abhifarePrice0A"></div>
            <div style="clear: both;"></div>
         </div> -->
         <div class="abhi_city_detail">
            <?php  //$top = field_get_items('node', $node, 'field_top'); print $top[0]['value']; ?>
         </div>
      </div>
      
   </div>
</div>
<!-- END TOP AREA  -->

<div class="container">
    
      <div class="row">
      
      <div class="col-md-12">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">PNR Details</h3>
            <div class="pull-right">
              <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                <i class="glyphicon glyphicon-filter"></i>
              </span>
            </div>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
          </div>
          <table class="table table-hover" id="task-table">
       
            <tbody>
            <?php 
                 if(isset($customerinfo))
                 { 
                    //echo "<pre>"; print_r($customerinfo); die;
                    //contactnumbers
                    $contactnumbers = $customerinfo["tir38:ContactNumbers"];
                    if(isset($contactnumbers[0]))
                    {  
                      foreach ($contactnumbers as $key => $value) 
                      {
                        echo '<tr>';
                          echo '<td>Phone: </td>';
                          echo '<td>'.$value["@attributes"]["Phone"].'</td>';
                        echo '</tr>';
                        
                      }
                    }else
                    {
                      echo '<tr>';
                          echo '<td>Phone: </td>';
                          echo '<td>'.$contactnumbers["tir38:ContactNumber"]["@attributes"]["Phone"].'</td>';
                        echo '</tr>';
                      
                    }  

                    $names = $customerinfo["tir38:PersonName"];
                    if(isset($names[0]))
                    {
                      foreach ($names as $key => $value) 
                      {
                         echo '<tr>';
                          echo '<td>GivenName: </td>';
                          echo '<td>'.$value["tir38:GivenName"].'</td>';
                        echo '</tr>';

                        echo '<tr>';
                          echo '<td>Surname: </td>';
                          echo '<td>'.$value["tir38:Surname"].'</td>';
                        echo '</tr>';
                        
                        echo '<tr>';
                          echo '<td>WithInfant: </td>';
                          echo '<td>'.$value["@attributes"]["WithInfant"].'</td>';
                        echo '</tr>';

                        echo '<tr>';
                          echo '<td>NameReference: </td>';
                          echo '<td>'.$value["@attributes"]["NameReference"].'</td>';
                        echo '</tr>';
                        
                        
                        
                      }
                    }else
                    {

                       echo '<tr>';
                          echo '<td>GivenName: </td>';
                          echo '<td>'.$names["tir38:GivenName"].'</td>';
                        echo '</tr>';

                        echo '<tr>';
                          echo '<td>Surname: </td>';
                          echo '<td>'.$names["tir38:Surname"].'</td>';
                        echo '</tr>';
                        
                        echo '<tr>';
                          echo '<td>WithInfant: </td>';
                          echo '<td>'.$names["@attributes"]["WithInfant"].'</td>';
                        echo '</tr>';

                        echo '<tr>';
                          echo '<td>NameReference: </td>';
                          echo '<td>'.$names["@attributes"]["NameReference"].'</td>';
                        echo '</tr>';
                      


                    }
                    //echo "<pre>sss"; print_r($customerinfo); die;
                    //payment info
                    /*$paymentinfo = $customerinfo["tir38:PaymentInfo"]["tir38:Payment"]["tir38:Form"]["tir38:Text"];
                    echo "<pre>sss"; print_r($customerinfo); die;*/
                    //person name

                 }
            ?> 

            <?php 
                 if(isset($ItineraryInfo))
                 { 
                    //echo "<pre>sss"; print_r($ItineraryInfo); die;
                    $Itinerary = $ItineraryInfo["tir38:ReservationItems"]["tir38:Item"];
                    if(isset($Itinerary[0]))
                    {
                      foreach ($Itinerary as $key => $value) {
                          if(isset($value["tir38:FlightSegment"]))
                          {
                            echo '<tr>';
                              echo '<td>DestinationLocation LocationCode: </td>';
                              echo '<td>'.$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["LocationCode"].'</td>';
                            echo '</tr>';

                            if(isset($value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["Terminal"]))
                            {
                              echo '<tr>';
                                echo '<td>DestinationLocation Terminal: </td>';
                                echo '<td>'.$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["Terminal"].'</td>';
                              echo '</tr>';
                            }  

                            if(isset($value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["TerminalCode"]))
                            {
                              echo '<tr>';
                                echo '<td>TerminalCode: </td>';
                                echo "<td>".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["TerminalCode"]."</td>";
                              echo '</tr>';
                            }

                            echo '<tr>';
                              echo '<td>Equipment AirEquipType: </td>';
                              echo "<td>".$value["tir38:FlightSegment"]["tir38:Equipment"]["@attributes"]["AirEquipType"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>MarketingAirline Banner: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["tir38:Banner"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>MarketingAirline Code: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["Code"]."</td>";

                            echo '<tr>';
                            echo '<td>MarketingAirline FlightNumber: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["FlightNumber"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OperatingAirline Banner: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["tir38:Banner"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OperatingAirline Code:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["Code"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OperatingAirline FlightNumber:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["FlightNumber"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OriginLocation LocationCode:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["LocationCode"]."</td>";
                            echo '</tr>';

                            if(isset($value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["Terminal"]))
                            {  
                              echo '<tr>';
                              echo '<td>OriginLocation Terminal: </td>';
                              echo "<td>".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["Terminal"]."</td>";
                              echo '</tr>';
                            } 
                            
                            if(isset($value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["TerminalCode"]))
                            { 
                              echo '<tr>';
                              echo '<td>OriginLocation LocationCode: </td>';
                              echo "<td>".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["TerminalCode"]."</td>";
                              echo '</tr>';
                            }  

                            echo '<tr>';
                            echo '<td>AirMilesFlown:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["AirMilesFlown"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>ArrivalDateTime:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["ArrivalDateTime"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>DayOfWeekInd:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["DayOfWeekInd"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>DepartureDateTime:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["DepartureDateTime"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>ElapsedTime: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["ElapsedTime"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>FlightNumber: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["FlightNumber"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>NumberInParty: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["NumberInParty"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>SmokingAllowed: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["SmokingAllowed"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>SpecialMeal: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["SpecialMeal"]."</td>";
                            echo '</tr>';
                          }  

                      }
                    }else
                    {
                      $value = $Itinerary;
                      if(isset($value["tir38:FlightSegment"]))
                          {
                            echo '<tr>';
                              echo '<td>DestinationLocation LocationCode: </td>';
                              echo '<td>'.$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["LocationCode"].'</td>';
                            echo '</tr>';

                            if(isset($value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["Terminal"]))
                            {
                              echo '<tr>';
                                echo '<td>DestinationLocation Terminal: </td>';
                                echo '<td>'.$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["Terminal"].'</td>';
                              echo '</tr>';
                            }  

                            if(isset($value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["TerminalCode"]))
                            {
                              echo '<tr>';
                                echo '<td>TerminalCode: </td>';
                                echo "<td>".$value["tir38:FlightSegment"]["tir38:DestinationLocation"]["@attributes"]["TerminalCode"]."</td>";
                              echo '</tr>';
                            }

                            echo '<tr>';
                              echo '<td>Equipment AirEquipType: </td>';
                              echo "<td>".$value["tir38:FlightSegment"]["tir38:Equipment"]["@attributes"]["AirEquipType"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>MarketingAirline Banner: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["tir38:Banner"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>MarketingAirline Code: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["Code"]."</td>";

                            echo '<tr>';
                            echo '<td>MarketingAirline FlightNumber: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:MarketingAirline"]["@attributes"]["FlightNumber"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OperatingAirline Banner: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["tir38:Banner"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OperatingAirline Code:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["Code"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OperatingAirline FlightNumber:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OperatingAirline"]["@attributes"]["FlightNumber"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OriginLocation LocationCode:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["LocationCode"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OriginLocation Terminal: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["Terminal"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>OriginLocation LocationCode: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["tir38:OriginLocation"]["@attributes"]["TerminalCode"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>AirMilesFlown:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["AirMilesFlown"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>ArrivalDateTime:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["ArrivalDateTime"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>DayOfWeekInd:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["DayOfWeekInd"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>DepartureDateTime:  </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["DepartureDateTime"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>ElapsedTime: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["ElapsedTime"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>FlightNumber: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["FlightNumber"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>NumberInParty: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["NumberInParty"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>SmokingAllowed: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["SmokingAllowed"]."</td>";
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td>SpecialMeal: </td>';
                            echo "<td>".$value["tir38:FlightSegment"]["@attributes"]["SpecialMeal"]."</td>";
                            echo '</tr>';
                          }
                    }
                 }


                 if(isset($baggageinfo))
                 {
                  echo '<tr>';
                  echo '<td>Baggage Info: </td>';
                  echo "<td>";
                  foreach ($baggageinfo as $key => $value) {
                    echo $value."</br>";
                  }
                  echo "</td>";
                  echo '</tr>';
                 }

                 if(isset($basefare) && isset($basefareCurrency))
                 {
                   echo '<tr>';
                    echo '<td>Base Fare: </td>';
                    echo "<td>".$basefare."</td>";
                   echo '</tr>';

                   echo '<tr>';
                    echo '<td>Base Fare Currency: </td>';
                    echo "<td>".$basefareCurrency."</td>";
                   echo '</tr>';

                   echo '<tr>';
                    echo '<td>Tax Amount: </td>';
                    echo "<td>".$taxes["tir38:Tax"]["@attributes"]["Amount"]."</td>";
                   echo '</tr>';                  

                    echo '<tr>';
                    echo '<td>TaxCode: </td>';
                    echo "<td>".$taxes["tir38:Tax"]["@attributes"]["TaxCode"]."</td>";
                   echo '</tr>';  

                    echo '<tr>';
                    echo '<td>TotalFare: </td>';
                    echo "<td>".$ItinTotalFare["tir38:TotalFare"]["@attributes"]["Amount"]."</td>";
                   echo '</tr>';

                    echo '<tr>';
                    echo '<td>Currency Code: </td>';
                    echo "<td>".$ItinTotalFare["tir38:TotalFare"]["@attributes"]["CurrencyCode"]."</td>";
                   echo '</tr>';
                  
                  
                  
                  
                  
                 }

                 if(isset($AirItineraryPricingInfo))
                 {

                   echo '<tr>';
                    echo '<td>Passenger Code: </td>';
                    echo "<td>".$AirItineraryPricingInfo["tir38:PassengerTypeQuantity"]["@attributes"]["Code"]."</td>";
                   echo '</tr>';

                   echo '<tr>';
                    echo '<td>Passenger Quantity: </td>';
                    echo "<td>".$AirItineraryPricingInfo["tir38:PassengerTypeQuantity"]["@attributes"]["Quantity"]."</td>";
                   echo '</tr>';

                  
                  
                 }
            ?>
             
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <style type="text/css">
  
    .clickable{
        cursor: pointer;   
    }

    .panel-heading div {
      margin-top: -18px;
      font-size: 15px;
    }
    .panel-heading div span{
      margin-left:5px;
    }
    .panel-body{
      display: none;
    }
  </style>
  <script type="text/javascript">
    /**
*   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
*   but will likely encounter performance issues on larger tables.
*
*   <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
*   $(input-element).filterTable()
*   
* The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
*/
(function(){
    'use strict';
  var $ = jQuery;
  $.fn.extend({
    filterTable: function(){
      return this.each(function(){
        $(this).on('keyup', function(e){
          $('.filterTable_no_results').remove();
          var $this = $(this), 
                        search = $this.val().toLowerCase(), 
                        target = $this.attr('data-filters'), 
                        $target = $(target), 
                        $rows = $target.find('tbody tr');
                        
          if(search == '') {
            $rows.show(); 
          } else {
            $rows.each(function(){
              var $this = $(this);
              $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
            })
            if($target.find('tbody tr:visible').size() === 0) {
              var col_count = $target.find('tr').first().find('td').size();
              var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
              $target.find('tbody').append(no_results);
            }
          }
        });
      });
    }
  });
  $('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
  $('[data-action="filter"]').filterTable();
  
  $('.container').on('click', '.panel-heading span.filter', function(e){
    var $this = $(this), 
      $panel = $this.parents('.panel');
    
    $panel.find('.panel-body').slideToggle();
    if($this.css('display') != 'none') {
      $panel.find('.panel-body input').focus();
    }
  });
  $('[data-toggle="tooltip"]').tooltip();
})
  </script>
