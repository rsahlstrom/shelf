<?php

namespace Shelf\V2\Response;

use Shelf\V2\Model\Boardgame as BoardgameModel;
use Shelf\V2\Model\Boardgame\Name as BoardgameName;

class Boardgame extends Thing
{
    protected $boardgames = array();

    public function getBoardgames()
    {
        if (!$this->isProcessed()) {
            $this->process();
        }

        return $this->boardgames;
    }

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
        $data['names'] = array();
        foreach ($rawGame->name as $rawName) {
            $name = new BoardgameName(
                (string) $rawName['value'],
                (string) $rawName['type'] == 'primary'
            );
            $name->setSortIndex((int) $rawName['sortIndex']);
            $data['names'][] = $name;
        }

        return new BoardgameModel($data);
    }
}
