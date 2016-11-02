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

namespace Amadeus\Client\Struct\Pnr\AddMultiElements;

/**
 * PnrActions - Structure class for the pnrActions message part for PNR_AddMultiElements messages
 *
 * @package Amadeus\Client\Struct\Pnr\AddMultiElements
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class PnrActions
{
    /**
     * PNR action option: no special processing
     *
     * See documentation Amadeus Core webservices
     * Functional documentation PNR_AddMultiElements
     * [Option element codesets (Ref: 106P 1A 00.1.2)]
     * @var int
     */
    const ACTIONOPTION_NO_SPECIAL_PROCESSING = 0;
    /**
     * PNR action option: End Transact
     *
     * See documentation Amadeus Core webservices
     * Functional documentation PNR_AddMultiElements
     * [Option element codesets (Ref: 106P 1A 00.1.2)]
     * @var int
     */
    const ACTIONOPTION_END_TRANSACT = 10;
    /**
     * PNR action option: End transact with retrieve
     *
     * See documentation Amadeus Core webservices
     * Functional documentation PNR_AddMultiElements
     * [Option element codesets (Ref: 106P 1A 00.1.2)]
     * @var int
     */
    const ACTIONOPTION_END_TRANSACT_W_RETRIEVE = 11;
    /**
     * PNR Action Option: Ignore PNR
     *
     * See documentation Amadeus Core webservices
     * Functional documentation PNR_AddMultiElements
     * [Option element codesets (Ref: 106P 1A 00.1.2)]
     * @var int
     */
    const ACTIONOPTION_IGNORE = 20;
    /**
     * PNR Action Option: Ignore PNR and retrieve
     *
     * See documentation Amadeus Core webservices
     * Functional documentation PNR_AddMultiElements
     * [Option element codesets (Ref: 106P 1A 00.1.2)]
     * @var int
     */
    const ACTIONOPTION_IGNORE_W_RETRIEVE = 21;

    /**
     * PNR_AddMultiElements/pnrActions/optionCode
     *
     * 0 No special processing
     * 10 End transact (ET)
     * 11 End transact with retrieve (ER)
     * 12 End transact and change advice codes (ETK)
     * 13 End transact with retrieve and change advice codes (ERK)
     * 14 End transact split PNR (EF)
     * 15 Cancel the itinerary for all PNRs connected by the AXR and end transact (ETX)
     * 16 Cancel the itinerary for all PNRs connected by the AXR and end transact with retrieve (ERX)
     * 20 Ignore (IG)
     * 21 Ignore and retrieve (IR)
     * 267 Stop EOT if segment sell error
     * 30 Show warnings at first EOT
     * 50 Reply with short message
     *
     * @see https://webservices.amadeus.com/extranet/structures/viewMessageStructure.do?id=5313&serviceVersionId=4268
     * @var int
     */
    public $optionCode;

    /**
     * @param int $actionCode self::ACTIONOPTION_* or one of the defined option codes
     */
    public function __construct($actionCode = self::ACTIONOPTION_NO_SPECIAL_PROCESSING)
    {
        $this->optionCode = $actionCode;
    }
}
