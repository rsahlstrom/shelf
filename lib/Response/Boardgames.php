<?php

namespace Shelf\Response;

use Shelf\Factory\BoardgameCollectionFactory;

/**
 * Boardgames class to handle responses from the thing api endpoint with multiple items
 * with a type of boardgame or boardgameexpansion
 */
class Boardgames extends AbstractResponse
{
    /**
     * Returns a default factory to be used in processing
     *
     * @return BoardgameCollectionFactory
     */
    public function getDefaultFactory()
    {
        return new BoardgameCollectionFactory();
    }

    /**
     * Returns a BoardgameCollection entity from the processed response
     *
     * @return Shelf\Entity\BoardgameCollection
     */
    public function getBoardgames()
    {
        return parent::getProcessedData();
    }
}
