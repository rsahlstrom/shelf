<?php

namespace Shelf\Factory;

use Shelf\Entity\CollectionCollection;
use Shelf\Factory\CollectionFactory;

/**
 * Factory to convert raw data into a CollectionCollection Entity
 */
class CollectionCollectionFactory extends AbstractFactory implements FactoryInterface
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
        return CollectionCollection::factory($itemRows);
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
            $arrayItems[] = CollectionFactory::convertXmlItem($xmlItem);
        }
        return $arrayItems;
    }
}
