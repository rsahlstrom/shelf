<?php

namespace Shelf\Factory;

use Shelf\Entity\BoardgameCollection;
use Shelf\Factory\BoardgameFactory;

/**
 * Factory to convert raw data into a BoardgameCollection Entity
 */
class BoardgameCollectionFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * Transforms a raw xml item from the BGG API to a board game entity
     *
     * @param \SimpleXMLElement $rawItems
     *
     * @return BoardgameCollection
     */
    public static function fromBggXml(\SimpleXMLElement $rawItems)
    {
        return static::fromArray(static::convertXmlItems($rawItems));
    }

    /**
     * Transforms an array into a BoardgameCollection entity
     *
     * @param array $itemRows
     *
     * @return BoardgameCollection
     */
    public static function fromArray(array $itemRows)
    {
        return BoardgameCollection::factory($itemRows);
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
            $arrayItems[] = BoardgameFactory::convertXmlItem($xmlItem);
        }
        return $arrayItems;
    }
}
