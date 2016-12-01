<?php

include_once 'workflow/Activity.php';
include_once 'rest/RestClient.php';

class AlterAirActivity implements Activity {

    public function run(&$sharedContext) {

        $call = new RestClient();
        $origin = "";//$sharedContext->getResult("origin");
        $destination = "";//$sharedContext->getResult("destination");
        $departureDate = "";//$sharedContext->getResult("departureDate");
        $result = $call->executePostCall("/v1.9.7/shop/altairports/flights?mode=live", $this->getRequest());
        $sharedContext->addResult("AlterAir", $result);
        return null;
    }

    private function getRequest() {
        $request = '{
  "OTA_AirLowFareSearchRQ": {
    "POS": {
      "Source": [{
        "PseudoCityCode": "B30I",
        "RequestorID": {
          "Type": "1",
          "ID": "1",
          "CompanyName": {
            "content": "TN"
          }
        }
      }]
    },
    "OriginDestinationInformation": [{
      "RPH": "1",
      "DepartureDateTime": "2017-01-17T00:00:00",
      "OriginLocation": {
        "LocationCode": "JFK"
      },
      "DestinationLocation": {
        "LocationCode": "LAX"
      },
      "TPA_Extensions": {
        "SisterOriginLocation": [{
          "LocationCode": "LGA"
        },
        {
          "LocationCode": "EWR"
        }],
        "SegmentType": {
          "Code": "O"
        },
        "CabinPref": {
          "Cabin": "Y",
          "PreferLevel": "Preferred"
        }
      }
    },
    {
      "RPH": "2",
      "DepartureDateTime": "2017-01-27T00:00:00",
      "OriginLocation": {
        "LocationCode": "LAX"
      },
      "DestinationLocation": {
        "LocationCode": "JFK"
      },
      "TPA_Extensions": {
        "SisterDestinationLocation": [{
          "LocationCode": "LGA"
        },
        {
          "LocationCode": "EWR"
        }],
        "SegmentType": {
          "Code": "O"
        }
      }
    }],
    "TravelerInfoSummary": {
      "SeatsRequested": [1],
      "AirTravelerAvail": [{
        "PassengerTypeQuantity": [{
          "Code": "ADT",
          "Quantity": 1
        }]
      }]
    },
    "TPA_Extensions": {
      "IntelliSellTransaction": {
        
      }
    }
  }
}';
        return $request;
    }

}
