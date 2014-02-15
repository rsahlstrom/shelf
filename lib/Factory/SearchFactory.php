<?php

namespace Shelf\Factory;

use Shelf\Entity\Search;

/**
 * Factory to convert raw data into a Search Entity
 */
class SearchFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public static function fromBggXml(\SimpleXMLElement $rawItem)
    {
        return static::fromArray(static::convertXmlItem($rawItem));
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $itemRow)
    {
        return new Search($itemRow);
    }

    /**
     * Converts an item from the XML API into an array
     *
     * @param SimpleXMLElement $xmlItem
     *
     * @return array
     */
    public static function convertXmlItem(\SimpleXMLElement $xmlItem)
    {
        $arrayItem = array(
            'bgg_id' => (int) $xmlItem['id'],
            'type' => (string) $xmlItem['type'],
            'name' => array(
                'value' => (string) $xmlItem->name['value'],
                'type' => (string) $xmlItem->name['type'],
                'sort_index' => 1,
            ),
            'year_published' => (int) $xmlItem->yearpublished['value'],
        );

        return $arrayItem;
    }
}
