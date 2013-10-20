<?php

namespace Shelf\Factory;

use Shelf\Entity\Boardgame;

/**
 * Factory to convert raw data into a Boardgame Entity
 */
class BoardgameFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * Transforms a raw xml item from the BGG API to a board game entity
     *
     * @param \SimpleXMLElement $rawItem
     *
     * @return Boardgame
     */
    public static function fromBggXml(\SimpleXMLElement $rawItem)
    {
        return static::fromArray(static::convertXmlItem($rawItem));
    }

    /**
     * Transforms an array into a Boardgame entity
     *
     * @param array $itemRow
     *
     * @return Boardgame
     */
    public static function fromArray(array $itemRow)
    {
        return new Boardgame($itemRow);
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
            'description' => self::processXmlApiString((string) $xmlItem->description),
            'bgg_image_url' => (string) $xmlItem->image,
            'bgg_thumbnail_url' => (string) $xmlItem->thumbnail,
            'min_players' => (int) $xmlItem->minplayers['value'],
            'max_players' => (int) $xmlItem->maxplayers['value'],
            'min_age' => (int) $xmlItem->minage['value'],
            'year_published' => (int) $xmlItem->yearpublished['value'],
            'playing_time' => (int) $xmlItem->playingtime['value'],
        );

        $arrayItem['names'] = array();
        foreach ($xmlItem->name as $xmlName) {
            $name = array(
                'value' => (string) $xmlName['value'],
                'type' => (string) $xmlName['type'],
                'sort_index' => (int) $xmlName['sortIndex'],
            );
            $arrayItem['names'][] = $name;
        }

        $arrayItem['links'] = array();
        foreach ($xmlItem->link as $xmlLink) {
            $type = (string) $xmlLink['type'];
            $type = preg_replace('/^boardgame/', '', $type);

            $link = array(
                'id' => (int) $xmlLink['id'],
                'value' => (string) $xmlLink['value'],
                'type' => $type,
            );
            if (array_key_exists('inbound', $xmlLink)) {
                $link['inbound'] = (bool) $xmlLink['inbound'];
            }
            $arrayItem['links'][] = $link;
        }

        //@TODO: Add support for polls

        return $arrayItem;
    }
}
