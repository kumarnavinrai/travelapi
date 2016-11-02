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
 * Structure class for the LocationInfo message part for PriceXplorer_* messages
 *
 * @package Amadeus\Client\Struct\PriceXplorer
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class LocationInfo
{
    /**
     * Location Types:
     * 25     City
     * 26     Country
     * A     Airport
     * R     Region
     */
    const LOC_CITY = 25;

    const LOC_COUNTRY = 26;

    const LOC_AIRPORT = "A";

    const LOC_REGION = "R";

    /**
     * @var int|string
     */
    public $locationType;
    /**
     * @var LocationIdentificationType
     */
    public $locationDescription;

    /**
     * @param string|int $locationType One of the constants self::LOC_*
     */
    public function __construct($locationType)
    {
        $this->locationType = $locationType;
    }
}
