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

namespace Amadeus\Client\Struct\Queue;

use Amadeus\Client\RequestOptions\Queue;
use Amadeus\Client\Struct\BaseWsMessage;

/**
 * Structure class for representing the Queue_PlacePnr request message
 *
 * @package Amadeus\Client\Struct\Queue
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class PlacePnr extends BaseWsMessage
{
    /**
     * @var PlacementOption
     */
    public $placementOption;
    /**
     * @var TargetDetails[]
     */
    public $targetDetails = [];
    /**
     * @var RecordLocator
     */
    public $recordLocator;

    /**
     * @param string $recordLocator
     * @param string $sourceOfficeId
     * @param Queue $targetQueue
     */
    public function __construct($recordLocator, $sourceOfficeId, $targetQueue)
    {
        $this->placementOption = new PlacementOption(SelectionDetails::PLACEPNR_OPTION_QUEUE);

        $this->targetDetails[] = new TargetDetails($targetQueue, [], $sourceOfficeId);

        $this->recordLocator = new RecordLocator($recordLocator);
    }
}
