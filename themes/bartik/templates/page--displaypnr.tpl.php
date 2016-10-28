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

        $out = array2table($customerinfo, true, '&nbsp;');
        $custinfo = str_replace("tir38:", "", $out);
        $out = array2table($ItineraryInfo, true, '&nbsp;');
        $ItineraryInfo = str_replace("tir38:", "", $out);
    
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
         
         
         <div id="abhiFlightDetails">
            <?php 
                 if(isset($custinfo))
                 { 
                    echo $custinfo;
                 }
            ?> 

            <?php 
                 if(isset($ItineraryInfo))
                 { 
                    echo $ItineraryInfo;
                 }
            ?> 
            <?php //print render($page['content']); ?>
            <div id="abhiOrigin" class="abhiOriginDestination"><?php  //$top = field_get_items('node', $node, 'field_from'); print $top[0]['value']; ?></div>
            <div id="abhiarrowHtml" class="abhiarrowHtml"><!-- &#8594; --></div>
            <div id="abhiDestination" class="abhiOriginDestination"><?php // $top = field_get_items('node', $node, 'field_to'); print $top[0]['value']; ?></div>
            <div id="abhiFromTxt"></div>
            <div class="abhifarePrice" id="abhifarePrice0A"><!-- <a class="searchURL" href="javascript:showDatePicker('A', '0','ACC','NYC','Accra','New York','$ 918');"></a> --></div>
            <div style="clear: both;"></div>
         </div>
         <div class="abhi_city_detail">
            <?php  //$top = field_get_items('node', $node, 'field_top'); print $top[0]['value']; ?>
         </div>
      </div>
      
   </div>
</div>
<!-- END TOP AREA  -->
<div class="gap"></div>

