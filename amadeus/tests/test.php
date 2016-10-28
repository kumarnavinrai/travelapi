<?php

use Amadeus\Client;
use Amadeus\Client\Params;
use Amadeus\Client\Result;
use Amadeus\Client\RequestOptions\PnrRetrieveOptions;

//Set up the client with necessary parameters:

$params = new Params([
    'sessionHandlerParams' => [
        'soapHeaderVersion' => Client::HEADER_V4, //This is the default value, can be omitted.
        //'wsdl' => '/home/user/mytestproject/data/amadeuswsdl/1ASIWXXXXXX_PDT_20160101_080000.wsdl', //Points to the location of the WSDL file for your WSAP. Make sure the associated XSD's are also available.
        'wsdl' => 'C:\wamp\www\travelapi\amadeus\tests\1ASIWOTANA4_PDT_20150828_175832\1ASIWOTANA4_PDT_20150828_175830.wsdl', //Points to the location 
        'stateful' => true, //Enable stateful messages by default - can be changed at will to switch between stateless & stateful.
        'logger' => new Psr\Log\NullLogger(),
        'authParams' => [
            'officeId' => '1ASIWOTANA4', //The Amadeus Office Id you want to sign in to - must be open on your WSAP.
            'userId' => 'WSNA4OTA', //Also known as 'Originator' for Soap Header 1 & 2 WSDL's
            'passwordData' => 'uYTzW' // **base 64 encoded** password
        ]
    ],
    'requestCreatorParams' => [
        'receivedFrom' => '6flyoticket' // The "Received From" string that will be visible in PNR History
    ]
]);

$client = new Client($params);

$pnrResult = $client->pnrRetrieve(
    new PnrRetrieveOptions(['recordLocator' => 'ABC123'])
);

if ($pnrResult->status === Result::STATUS_OK) {
    echo "Successfully retrieved PNR, no errors in PNR found!";
    echo "PNR XML string received: <pre>" . $pnrResult->responseXml . "</pre>";
}