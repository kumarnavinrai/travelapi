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

namespace Amadeus\Client\Struct\Offer\ConfirmHotel;

/**
 * Reservation
 *
 * @package Amadeus\Client\Struct\Offer\ConfirmHotel
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class Reservation
{
    const CONTROLTYPE_PNR_IDENTIFICATION = "P";
    /**
     * 1A Amadeus
     *
     * @var string
     */
    public $companyId;

    /**
     * @var string
     */
    public $controlNumber;

    /**
     * 2 Confirmation Reference
     * P PNR Identification
     * X Cancellation Reference
     *
     * @var string
     */
    public $controlType;

    /**
     * Reservation constructor.
     *
     * @param string $recordLocator
     * @param string|null $company
     * @param string|null $controlType
     */
    public function __construct($recordLocator, $company = null, $controlType = null)
    {
        $this->controlNumber = $recordLocator;
        $this->companyId = $company;
        $this->controlType = $controlType;
    }
}
