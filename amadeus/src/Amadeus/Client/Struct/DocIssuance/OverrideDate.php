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

namespace Amadeus\Client\Struct\DocIssuance;

/**
 * OverrideDate
 *
 * @package Amadeus\Client\Struct\DocIssuance
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class OverrideDate
{
    const OPT_ALTERNATE_DATE_VALIDATION = "ADV";

    const OPT_OVERRIDE_PAST_DATE_TST = "OPD";

    /**
     * self::OPT_*
     *
     * @var string
     */
    public $businessSemantic;

    /**
     * @var DocIssuanceDateTime
     */
    public $dateTime;

    /**
     * OverrideDate constructor.
     *
     * @param string $option self::OPT_*
     * @param \DateTime|null $date
     */
    public function __construct($option, $date = null)
    {
        $this->businessSemantic = $option;
        if ($date instanceof \DateTime) {
            $this->dateTime = new DocIssuanceDateTime($date);
        }
    }
}
