<?php

namespace Shelf\V2\Response;

use Shelf\V2\Model\Boardgame as BoardgameModel;
use Shelf\V2\Model\Boardgame\Name as BoardgameName;

class Boardgame extends Thing
{
    protected $boardgames = array();

    public function process()
    {
        if ($this->isProcessed()) {
            return;
        }

        $this->boardgames = array();
        foreach ($this->rawXml->item as $rawGame) {
            $this->boardgames[] = $this->processBoardgame($rawGame);
        }

        $this->processed = true;
    }

    public function processBoardgame(\SimpleXMLElement $rawGame)
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

    public function getBoardgames()
    {
        if (!$this->isProcessed()) {
            $this->process();
        }

        return $this->boardgames;
    }
}
