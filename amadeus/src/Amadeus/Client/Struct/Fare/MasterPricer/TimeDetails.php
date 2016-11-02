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

namespace Amadeus\Client\Struct\Fare\MasterPricer;

use Amadeus\Client\RequestOptions\Fare\MPDate;

/**
 * TimeDetails
 *
 * @package Amadeus\Client\Struct\Fare\MasterPricer
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class TimeDetails
{
    /**
     * @var FirstDateTimeDetail
     */
    public $firstDateTimeDetail;
    /**
     * @var RangeOfDate
     */
    public $rangeOfDate;
    /**
     * @var TripDetails
     */
    public $tripDetails;

    /**
     * TimeDetails constructor.
     *
     * @param MPDate $theDate
     */
    public function __construct(MPDate $theDate)
    {
        $this->firstDateTimeDetail = new FirstDateTimeDetail(
            $this->makeDateString($theDate->dateTime, $theDate->date)
        );

        $timeString = $this->makeTimeString($theDate->dateTime, $theDate->time);
        if ($timeString !== '0000') {
            $this->firstDateTimeDetail->time = $timeString;

            if ($theDate->isDeparture) {
                $this->firstDateTimeDetail->timeQualifier = FirstDateTimeDetail::TIMEQUAL_DEPART_FROM;
            } else {
                $this->firstDateTimeDetail->timeQualifier = FirstDateTimeDetail::TIMEQUAL_ARRIVAL_BY;
            }
        }

        if (is_int($theDate->timeWindow)) {
            $this->firstDateTimeDetail->timeWindow = $theDate->timeWindow;
        }

        if (!is_null($theDate->range) && !is_null($theDate->rangeMode)) {
            $this->rangeOfDate = new RangeOfDate(
                $theDate->rangeMode,
                $theDate->range
            );
        }
    }

    /**
     * @param \DateTime|null $dateTime
     * @param \DateTime|null $date
     * @return string
     */
    protected function makeDateString($dateTime, $date)
    {
        $dateStr = '000000';

        if ($dateTime instanceof \DateTime) {
            $dateStr = $dateTime->format('dmy');
        } elseif ($date instanceof \DateTime) {
            $dateStr = $date->format('dmy');
        }

        return $dateStr;
    }

    /**
     * @param \DateTime|null $dateTime
     * @param \DateTime|null $time
     * @return string
     */
    protected function makeTimeString($dateTime, $time)
    {
        $timeStr = '0000';

        if ($dateTime instanceof \DateTime) {
            $timeStr = $dateTime->format('Hi');
        } elseif ($time instanceof \DateTime) {
            $timeStr = $time->format('Hi');
        }

        return $timeStr;
    }
}
