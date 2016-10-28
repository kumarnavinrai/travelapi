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

namespace Amadeus\Client\Struct\Fare;

use Amadeus\Client\RequestCreator\MessageVersionUnsupportedException;
use Amadeus\Client\RequestOptions\Fare\PricePnr\AwardPricing;
use Amadeus\Client\RequestOptions\Fare\PricePnr\ExemptTax;
use Amadeus\Client\RequestOptions\Fare\PricePnr\FareBasis;
use Amadeus\Client\RequestOptions\Fare\PricePnr\ObFee;
use Amadeus\Client\RequestOptions\Fare\PricePnr\PaxSegRef;
use Amadeus\Client\RequestOptions\Fare\PricePnr\Tax;
use Amadeus\Client\RequestOptions\FarePricePnrWithBookingClassOptions;
use Amadeus\Client\RequestOptions\FarePricePnrWithLowerFaresOptions as LowerFareOpt;
use Amadeus\Client\RequestOptions\FarePricePnrWithLowestFareOptions as LowestFareOpt;
use Amadeus\Client\Struct\BaseWsMessage;
use Amadeus\Client\Struct\Fare\PricePnr13\CarrierInformation;
use Amadeus\Client\Struct\Fare\PricePnr13\Currency;
use Amadeus\Client\Struct\Fare\PricePnr13\DateInformation;
use Amadeus\Client\Struct\Fare\PricePnr13\FirstCurrencyDetails;
use Amadeus\Client\Struct\Fare\PricePnr13\FrequentFlyerInformation;
use Amadeus\Client\Struct\Fare\PricePnr13\FrequentTravellerDetails;
use Amadeus\Client\Struct\Fare\PricePnr13\LocationInformation;
use Amadeus\Client\Struct\Fare\PricePnr13\OptionDetail;
use Amadeus\Client\Struct\Fare\PricePnr13\PaxSegTstReference;
use Amadeus\Client\Struct\Fare\PricePnr13\PenDisInformation;
use Amadeus\Client\Struct\Fare\PricePnr13\PricingOptionGroup;
use Amadeus\Client\Struct\Fare\PricePnr13\PricingOptionKey;
use Amadeus\Client\Struct\Fare\PricePnr13\TaxData;
use Amadeus\Client\Struct\Fare\PricePnr13\TaxInformation;

/**
 * Fare_PricePNRWithBookingClass v 13 and higher structure
 *
 * @package Amadeus\Client\Struct\Fare
 * @author dieter <dieter.devlieghere@benelux.amadeus.com>
 */
class PricePNRWithBookingClass13 extends BaseWsMessage
{
    /**
     * @var PricePnr13\PricingOptionGroup[]
     */
    public $pricingOptionGroup = [];

    /**
     * PricePNRWithBookingClass13 constructor.
     *
     * @param FarePricePnrWithBookingClassOptions|LowerFareOpt|LowestFareOpt|null $options
     * @throws MessageVersionUnsupportedException
     */
    public function __construct($options)
    {
        if (!is_null($options)) {
            $this->pricingOptionGroup = $this->loadPricingOptionsFromRequestOptions($options);
        }
    }

    /**
     * Load an array of PricingOptionGroup objects from the Pricing request options.
     *
     * Extracted because this method is also used in the InformativePricingWithoutPnr messages.
     *
     * @param FarePricePnrWithBookingClassOptions|LowerFareOpt|LowestFareOpt $options
     * @return PricingOptionGroup[]
     */
    public static function loadPricingOptionsFromRequestOptions($options)
    {
        $priceOptions = [];

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::makePricingOptionForValidatingCarrier($options->validatingCarrier)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::makePricingOptionForCurrencyOverride($options->currencyOverride)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::makePricingOptionFareBasisOverride($options->pricingsFareBasis)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::makeOverrideOptions($options->overrideOptions, $priceOptions)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadCorpNegoFare($options->corporateNegoFare)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadCorpUniFares($options->corporateUniFares, $options->awardPricing)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadObFees($options->obFees, $options->obFeeRefs)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadPaxDiscount($options->paxDiscountCodes, $options->paxDiscountCodeRefs)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadPointOverrides(
                $options->pointOfSaleOverride,
                $options->pointOfTicketingOverride
            )
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadPricingLogic($options->pricingLogic)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadTicketType($options->ticketType)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadTaxes($options->taxes)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadExemptTaxes($options->exemptTaxes)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadPastDate($options->pastDatePricing)
        );

        $priceOptions = self::mergeOptions(
            $priceOptions,
            self::loadReferences($options->references)
        );

        // All options processed, no options found:
        if (empty($priceOptions)) {
            $priceOptions[] = new PricingOptionGroup(PricingOptionKey::OPTION_NO_OPTION);
        }

        return $priceOptions;
    }

    /**
     * @param string[] $overrideOptions
     * @param PricingOptionGroup[] $priceOptions
     * @return PricingOptionGroup[]
     */
    protected static function makeOverrideOptions($overrideOptions, $priceOptions)
    {
        $opt = [];

        foreach ($overrideOptions as $overrideOption) {
            if (!self::hasPricingGroup($overrideOption, $priceOptions)) {
                $opt[] = new PricingOptionGroup($overrideOption);
            }
        }

        return $opt;
    }

    /**
     * @param string|null $validatingCarrier
     * @return PricePnr13\PricingOptionGroup[]
     */
    protected static function makePricingOptionForValidatingCarrier($validatingCarrier)
    {
        $opt = [];

        if ($validatingCarrier !== null) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_VALIDATING_CARRIER);

            $po->carrierInformation = new CarrierInformation($validatingCarrier);

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param string|null $currency
     * @return PricePnr13\PricingOptionGroup[]
     */
    protected static function makePricingOptionForCurrencyOverride($currency)
    {
        $opt = [];

        if ($currency !== null) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_FARE_CURRENCY_OVERRIDE);

            $po->currency = new Currency($currency, FirstCurrencyDetails::QUAL_CURRENCY_OVERRIDE);

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param FareBasis[] $pricingsFareBasis
     * @return PricePnr13\PricingOptionGroup[]
     */
    protected static function makePricingOptionFareBasisOverride($pricingsFareBasis)
    {
        $opt = [];

        if ($pricingsFareBasis !== null) {
            foreach ($pricingsFareBasis as $pricingFareBasis) {
                $po = new PricingOptionGroup(PricingOptionKey::OPTION_FARE_BASIS_SIMPLE_OVERRIDE);

                //Support for legacy fareBasisPrimaryCode to be removed when breaking BC:
                $po->optionDetail = new OptionDetail(
                    $pricingFareBasis->fareBasisPrimaryCode.$pricingFareBasis->fareBasisCode
                );

                //Support for legacy segmentReference to be removed when breaking BC:
                $po->paxSegTstReference = new PaxSegTstReference(
                    $pricingFareBasis->segmentReference,
                    $pricingFareBasis->references
                );

                $opt[] = $po;
            }
        }

        return $opt;
    }

    /**
     * Load corporate negofare
     *
     * @param string|null $corporateNegoFare
     * @return PricingOptionGroup[]
     */
    protected static function loadCorpNegoFare($corporateNegoFare)
    {
        $opt = [];

        if ($corporateNegoFare !== null) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_CORPORATE_NEGOTIATED_FARES);

            $po->optionDetail = new OptionDetail($corporateNegoFare);

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * Load corporate unifares
     *
     * @param string[] $corporateUniFares
     * @param AwardPricing|null $awardPricing
     * @return PricingOptionGroup[]
     */
    protected static function loadCorpUniFares($corporateUniFares, $awardPricing)
    {
        $opt = [];

        if (!empty($corporateUniFares)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_CORPORATE_UNIFARES);
            $po->optionDetail = new OptionDetail($corporateUniFares);
            $opt[] = $po;

            if (!empty($awardPricing)) {
                $opt[] = self::loadAwardPricing($awardPricing);
            }
        }

        return $opt;
    }

    /**
     * @param AwardPricing $awardPricing
     * @return PricingOptionGroup
     */
    protected static function loadAwardPricing($awardPricing)
    {
        $po = new PricingOptionGroup(PricingOptionKey::OPTION_AWARD_PRICING);

        $po->carrierInformation = new CarrierInformation($awardPricing->carrier);

        $po->frequentFlyerInformation = new FrequentFlyerInformation();
        $po->frequentFlyerInformation->frequentTravellerDetails[] = new FrequentTravellerDetails(
            $awardPricing->tierLevel
        );

        return $po;
    }

    /**
     * Load OB Fees
     *
     * @param ObFee[] $obFees
     * @param PaxSegRef[] $obFeeRefs
     * @return PricingOptionGroup[]
     */
    protected static function loadObFees($obFees, $obFeeRefs)
    {
        $opt = [];

        if (!empty($obFees)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_OB_FEES);

            $po->penDisInformation = new PenDisInformation(
                PenDisInformation::QUAL_OB_FEES,
                $obFees
            );

            if (!empty($obFeeRefs)) {
                $po->paxSegTstReference = new PaxSegTstReference(null, $obFeeRefs);
            }

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param string[] $paxDiscount
     * @param PaxSegRef[] $paxDiscountCodeRefs
     * @return PricingOptionGroup[]
     */
    protected static function loadPaxDiscount($paxDiscount, $paxDiscountCodeRefs)
    {
        $opt = [];

        if (!empty($paxDiscount)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_PASSENGER_DISCOUNT_PTC);

            $po->penDisInformation = new PenDisInformation(
                PenDisInformation::QUAL_DISCOUNT,
                $paxDiscount
            );

            if (!empty($paxDiscountCodeRefs)) {
                $po->paxSegTstReference = new PaxSegTstReference(null, $paxDiscountCodeRefs);
            }

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param string|null $posOverride
     * @param string|null $potOverride
     * @return PricingOptionGroup[]
     */
    protected static function loadPointOverrides($posOverride, $potOverride)
    {
        $opt = [];

        if (!empty($posOverride)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_POINT_OF_SALE_OVERRIDE);

            $po->locationInformation = new LocationInformation(
                LocationInformation::TYPE_POINT_OF_SALE,
                $posOverride
            );

            $opt[] = $po;
        }

        if (!empty($potOverride)) {
            $po2 = new PricingOptionGroup(PricingOptionKey::OPTION_POINT_OF_TICKETING_OVERRIDE);

            $po2->locationInformation = new LocationInformation(
                LocationInformation::TYPE_POINT_OF_TICKETING,
                $potOverride
            );

            $opt[] = $po2;
        }

        return $opt;
    }

    /**
     * @param string|null $pricingLogic
     * @return PricingOptionGroup[]
     */
    protected static function loadPricingLogic($pricingLogic)
    {
        $opt = [];

        if (!empty($pricingLogic)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_PRICING_LOGIC);
            $po->optionDetail = new OptionDetail($pricingLogic);
            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param string|null $ticketType
     * @return PricingOptionGroup[]
     */
    protected static function loadTicketType($ticketType)
    {
        $opt = [];

        if (!empty($ticketType)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_TICKET_TYPE);

            $po->optionDetail = new OptionDetail($ticketType);

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param Tax[] $taxes
     * @return PricingOptionGroup[]
     */
    protected static function loadTaxes($taxes)
    {
        $opt = [];

        if (!empty($taxes)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_ADD_TAX);

            foreach ($taxes as $tax) {
                $qualifier = (!empty($tax->amount)) ? TaxData::QUALIFIER_AMOUNT : TaxData::QUALIFIER_PERCENTAGE;
                $rate = (!empty($tax->amount)) ? $tax->amount : $tax->percentage;

                $po->taxInformation[] = new TaxInformation(
                    $tax->countryCode,
                    $tax->taxNature,
                    $qualifier,
                    $rate
                );
            }
            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param ExemptTax[] $exemptTaxes
     * @return PricingOptionGroup[]
     */
    protected static function loadExemptTaxes($exemptTaxes)
    {
        $opt = [];

        if (!empty($exemptTaxes)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_EXEMPT_FROM_TAX);

            foreach ($exemptTaxes as $tax) {
                $po->taxInformation[] = new TaxInformation(
                    $tax->countryCode,
                    $tax->taxNature
                );
            }

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param \DateTime|null $pastDate
     * @return PricingOptionGroup[]
     */
    protected static function loadPastDate($pastDate)
    {
        $opt = [];

        if ($pastDate instanceof \DateTime) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_PAST_DATE_PRICING);

            $po->dateInformation = new DateInformation(
                DateInformation::OPT_DATE_OVERRIDE,
                $pastDate
            );

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * @param PaxSegRef[] $references
     * @return PricingOptionGroup[]
     */
    protected static function loadReferences($references)
    {
        $opt = [];

        if (!empty($references)) {
            $po = new PricingOptionGroup(PricingOptionKey::OPTION_PAX_SEGMENT_TST_SELECTION);

            $po->paxSegTstReference = new PaxSegTstReference(null, $references);

            $opt[] = $po;
        }

        return $opt;
    }

    /**
     * Avoid double pricing groups when combining an explicitly provided override option with a specific parameter
     * that uses the same override option.
     *
     * Backwards compatibility with PricePnrWithBookingClass12
     *
     * @param string $optionKey
     * @param PricingOptionGroup[] $priceOptions
     * @return bool
     */
    protected static function hasPricingGroup($optionKey, $priceOptions)
    {
        $found = false;

        foreach ($priceOptions as $pog) {
            if ($pog->pricingOptionKey->pricingOptionKey === $optionKey) {
                $found = true;
            }
        }

        return $found;
    }

    /**
     * Merges Pricing options
     *
     * @param PricingOptionGroup[] $existingOptions
     * @param PricingOptionGroup[] $newOptions
     * @return PricingOptionGroup[] merged array
     */
    protected static function mergeOptions($existingOptions, $newOptions)
    {
        if (!empty($newOptions)) {
            $existingOptions = array_merge(
                $existingOptions,
                $newOptions
            );
        }

        return $existingOptions;
    }
}
