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

namespace Test\Amadeus\Client\Struct\Fare\PricePnr12;

use Amadeus\Client\Struct\Fare\PricePnr12\AttributeDetails;
use Amadeus\Client\Struct\Fare\PricePnr12\OverrideInformation;
use Test\Amadeus\BaseTestCase;

/**
 * OverrideInformationTest
 *
 * @package Test\Amadeus\Client\Struct\Fare\PricePnr12
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class OverrideInformationTest extends BaseTestCase
{
    public function testCanConstructWithMainAttribute()
    {
        $overrideInf = new OverrideInformation(AttributeDetails::OVERRIDE_FARETYPE_PUB);

        $this->assertCount(1, $overrideInf->attributeDetails);
        $this->assertEquals(AttributeDetails::OVERRIDE_FARETYPE_PUB, $overrideInf->attributeDetails[0]->attributeType);
    }
}
