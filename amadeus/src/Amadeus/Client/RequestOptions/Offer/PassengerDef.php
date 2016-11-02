<?php
/**
 * amadeus-ws-client
 *
 * Copyright 2015 Amadeus Benelux NV
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package Amadeus
 * @license https://opensource.org/licenses/Apache-2.0 Apache 2.0
 */

namespace Amadeus\Client\RequestOptions\Offer;

use Amadeus\Client\LoadParamsFromArray;

/**
 * PassengerDef
 *
 * @package Amadeus\Client\RequestOptions\Offer
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class PassengerDef extends LoadParamsFromArray
{
    /**
     * Type of passenger
     *
     * https://webservices.amadeus.com/extranet/structures/viewMessageStructure.do?id=2326&serviceVersionId=2298&isQuery=true#
     *
     * Offer_CreateOffer/airPricingRecommendation/paxReference/passengerReference/type
     * Reference qualifier codesets
     * Value   Description
     * P       Passenger/traveller reference number
     * PA      Adult Passenger
     * PI      Infant Passenger
     *
     * @var string
     */
    public $passengerType = "P";

    /**
     * Passenger Tattoo
     *
     * @var int
     */
    public $passengerTattoo;
}
