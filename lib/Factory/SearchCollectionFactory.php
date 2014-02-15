<?php

namespace Shelf\Factory;

use Shelf\Entity\SearchCollection;
use Shelf\Factory\SearchFactory;

/**
 * Factory to convert raw data into a SearchCollection Entity
 */
class SearchCollectionFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public static function fromBggXml(\SimpleXMLElement $rawItems)
    {
        return static::fromArray(static::convertXmlItems($rawItems));
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $itemRows)
    {
        return SearchCollection::factory($itemRows);
    }

    /**
     * Converts items from the XML API into an array
     *
     * @param SimpleXMLElement $xmlItems
     *
     * @return array
     */
    protected static function convertXmlItems(\SimpleXMLElement $xmlItems)
    {
        $arrayItems = array();
        foreach ($xmlItems->item as $xmlItem) {
            $arrayItems[] = SearchFactory::convertXmlItem($xmlItem);
        }
        return $arrayItems;
    }
}
