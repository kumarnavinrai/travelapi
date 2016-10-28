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

namespace Amadeus\Client\Struct\Fare\PricePnr12;

use Amadeus\Client\RequestOptions\Fare\PricePnr\FareBasis;

/**
 * PricingFareBase
 *
 * @package Amadeus\Client\Struct\Fare\PricePnr12
 * @author dieter <dieter.devlieghere@benelux.amadeus.com>
 */
class PricingFareBase
{
    /**
     * @var FareBasisOptions
     */
    public $fareBasisOptions;
    /**
     * @var FareBasisSegReference[]
     */
    public $fareBasisSegReference = [];
    /**
     * @var array
     */
    public $fareBasisDates = [];

    /**
     * PricingFareBase constructor.
     *
     * @param FareBasis $options
     */
    public function __construct(FareBasis $options)
    {
        if (empty($options->fareBasisPrimaryCode)) {
            //Support for legacy input format - to be removed when breaking BC
            $fareBasisPrimaryCode = substr($options->fareBasisCode, 0, 3);
            $fareBasisCode = substr($options->fareBasisCode, 3);
        } else {
            $fareBasisPrimaryCode = $options->fareBasisPrimaryCode;
            $fareBasisCode = $options->fareBasisCode;
        }

        $this->fareBasisOptions = new FareBasisOptions($fareBasisPrimaryCode, $fareBasisCode);

        //Support legacy segment reference format - to be removed when breaking BC
        foreach ($options->segmentReference as $segNum => $segQual) {
            $this->fareBasisSegReference[] = new FareBasisSegReference($segNum, $segQual);
        }

        foreach ($options->references as $reference) {
            $this->fareBasisSegReference[] = new FareBasisSegReference($reference->reference, $reference->type);
        }
    }
}
