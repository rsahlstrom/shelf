<?php

namespace Shelf\V2\Factory;

/**
 * Interface to ensure that all factories provide a similar set of required methods
 */
interface FactoryInterface
{
    /**
     * Transforms a raw xml response from the BGG API to a Common Model object
     *
     * @param \SimpleXMLElement $rawItem
     *
     * @return Shelf\Common\Model\DataAbstract
     */

    public static function fromBggXml(\SimpleXMLElement $rawItem);

    /**
     * Transforms an array to a Common Model object
     *
     * @param array $itemRow
     *
     * @return Shelf\Common\Model\DataAbstract
     */
    public static function fromArray(array $itemRow);
}
