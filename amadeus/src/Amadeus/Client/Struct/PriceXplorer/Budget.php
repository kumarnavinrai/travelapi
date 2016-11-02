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

namespace Amadeus\Client\Struct\PriceXplorer;

/**
 * Structure class for the Budget message part for PriceXplorer_* messages
 *
 * @package Amadeus\Client\Struct\PriceXplorer
 * @author  Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class Budget
{
    /**
     * @var MonetaryDetails[]
     */
    public $monetaryDetails = [];

    /**
     * When providing MAX or MIN you MUST specify currency
     *
     * @param double|int|string|null $maxBudget
     * @param double|int|string|null $minBudget
     * @param string|null $currency
     */
    public function __construct($maxBudget = null, $minBudget = null, $currency = null)
    {
        if ($maxBudget !== null && $currency !== null) {
            $this->monetaryDetails[] = new MonetaryDetails(
                $maxBudget,
                MonetaryDetails::QUAL_MAX_BUDGET,
                $currency
            );
        }

        if ($minBudget !== null && $currency !== null) {
            $this->monetaryDetails[] = new MonetaryDetails(
                $minBudget,
                MonetaryDetails::QUAL_MIN_BUDGET,
                $currency
            );
        }
    }
}
