<?php

include_once 'workflow/Activity.php';
include_once 'rest/RestClient.php';

class GetCodeActivity implements Activity {

    public function run(&$sharedContext) {

        $call = new RestClient();
        $origin = "";//$sharedContext->getResult("origin");
        $destination = "";//$sharedContext->getResult("destination");
        $departureDate = "";//$sharedContext->getResult("departureDate");
        $result = $call->executePostCall("/v1/lists/utilities/geocode/locations/", $this->getRequest());
        $sharedContext->addResult("GeoCode", $result);
        return null;
    }

    private function getRequest() {
        $request = '[{
  "GeoCodeRQ":{
    "PlaceById":{
      "Id":"JFK",
      "BrowseCategory": {
        "name": "AIR"
      }
    }
  }
},
{
  "GeoCodeRQ":{
    "PlaceById":{
      "Id":"ATL",
      "BrowseCategory": {
        "name": "AIR"
      }
    }
  }
}]';
        return $request;
    }

}
