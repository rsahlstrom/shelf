<?php

namespace Shelf\V2\Factory;

use Shelf\Common\Model\Boardgame as BoardgameModel;
use Shelf\Common\Model\Boardgame\Name as BoardgameName;

/**
 * Factory to convert raw data into Boardgame Models
 */
class Boardgame implements FactoryInterface
{
    /**
     * Transforms a raw xml response from the BGG API to an array of Boardgame
     * Models
     *
     * @param \SimpleXMLElement $rawXml
     *
     * @return Shelf\Common\Model\Boardgame[]
     */
    public function fromBggXml(\SimpleXMLElement $rawXml)
    {
        $boardgames = array();
        foreach ($rawXml->item as $rawGame) {
            $boardgames[] = $this->processBoardgame($rawGame);
        }
        return $boardgames;
    }

    /**
     * Process a single game from the xml response
     *
     * @param \SimpleXMLElement $rawGame
     *
     * @return Boardgame
     */
    protected function processBoardgame(\SimpleXMLElement $rawGame)
    {
        $data = array();
        $data['bgg_id'] = (int) $rawGame['id'];
        $data['is_expansion'] = (string) $rawGame['type'] == 'boardgameexpansion';
        $data['description'] = $this->processString((string) $rawGame->description);
        $data['bgg_image_url'] = (string) $rawGame->image;
        $data['bgg_thumbnail_url'] = (string) $rawGame->thumbnail;
        $data['min_players'] = (int) $rawGame->minplayers['value'];
        $data['max_players'] = (int) $rawGame->maxplayers['value'];
        $data['min_age'] = (int) $rawGame->minage['value'];
        $data['year_published'] = (int) $rawGame->yearpublished['value'];
        $data['playing_time'] = (int) $rawGame->playingtime['value'];
        $data['names'] = array();
        foreach ($rawGame->name as $rawName) {
            $name = new BoardgameName(
                (string) $rawName['value'],
                (string) $rawName['type'] == 'primary'
            );
            $name->setSortIndex((int) $rawName['sortIndex']);
            $data['names'][] = $name;
        }

        $linksByType = array();
        foreach ($rawGame->link as $rawLink) {
            $type = (string) $rawLink['type'];

            if (!array_key_exists($type, $linksByType)) {
                $linksByType[$type] = array();
            }

            $linksByType[$type][(int) $rawLink['id']] = (string) $rawLink['value'];
        }

        foreach ($linksByType as $type => $links) {
            $type = preg_replace('/^boardgame/', '', $type);
            $processMethod = 'process' . ucwords($type);
            if (is_callable(array($this, $processMethod), false)) {
                $links = $this->$processMethod($links);
            }
            $data[$type] = $links;
        }

        //@TODO: Add support for polls

        return new BoardgameModel($data);
    }

    /**
     * Process a string from the xml api to remove entities, trim the result, and
     * run any other needed methods
     *
     * @param string $string
     *
     * @return string
     */
    protected function processString($string)
    {
        return trim(html_entity_decode($string));
    }
}
