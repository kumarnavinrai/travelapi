<?php

header('Access-Control-Allow-Origin: *');

include_once 'workflow/Activity.php';
include_once 'rest/RestClient.php';

class AutocActivity implements Activity {

    public function __construct($origin) {
        $this->origin = $origin;
    }

     public function run(&$sharedContext) {
        
        $call = new RestClient();
        $url = "https://api.sabre.com/v1/lists/utilities/geoservices/autocomplete?query=".$this->origin."&category=AIR&limit=30";
        $result = $call->executeGetCall($url, null);
        //echo "<pre>"; print_r($result); die;
        $sharedContext->addResult("Autocres", $result);
        
        return null;
    }

}
