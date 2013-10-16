<?php

namespace Shelf\Factory;

use Shelf\Entity\Boardgame;

/**
 * Factory to convert raw data into Boardgame Entities
 */
class BoardgameFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * Transforms a raw xml item from the BGG API to a board game entity
     *
     * @param \SimpleXMLElement $rawXml
     *
     * @return Boardgame
     */
    public static function fromBggXml(\SimpleXMLElement $rawItem)
    {
        return self::fromArray(self::convertXmlItem($rawItem));
    }

    /**
     * Transforms an array into a boardgame entity
     *
     * @param array $itemRow
     *
     * @return Boardgame
     */
    public static function fromArray(array $itemRow)
    {
        return static::processBoardgame($itemRow);
    }

    /**
     * Converts an item from the XML API into an array
     *
     * @param SimpleXMLElement $xmlItem
     *
     * @return array
     */
    protected static function convertXmlItem(\SimpleXMLElement $xmlItem)
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
            $name = array(
                'id' => (string) $xmlLink['id'],
                'value' => (int) $xmlLink['value'],
                'type' => (string) $xmlLink['type'],
            );
            $arrayItem['links'][] = $name;
        }

        return $arrayItem;
    }

    /**
     * Process a single game from the xml response
     *
     * @param array $gameRow
     *
     * @return Boardgame
     */
    protected static function processBoardgame(array $gameRow)
    {
        if (array_key_exists('links', $gameRow)) {
            $linksByType = array();
            foreach ($gameRow['links'] as $link) {
                $type = $link['type'];

                if (!array_key_exists($type, $linksByType)) {
                    $linksByType[$type] = array();
                }

                $linksByType[$type][$link['id']] = $link['value'];
            }

            foreach ($linksByType as $type => $links) {
                $type = preg_replace('/^boardgame/', '', $type);
                $gameRow[$type] = $links;
            }
        }

        //@TODO: Add support for polls

        return new Boardgame($gameRow);
    }
}
