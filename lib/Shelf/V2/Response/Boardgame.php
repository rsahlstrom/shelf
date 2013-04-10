<?php

namespace Shelf\V2\Response;

use Shelf\V2\Factory\Boardgame as BoardgameFactory;

/**
 * Boardgame class to handle responses from the api endpoint with a type of
 * boardgame or boardgameexpansion
 */
class Boardgame extends AbstractResponse
{
    /**
     * Returns a default factory to be used in processing
     *
     * @return BoardgameFactory
     */
    public function getDefaultFactory()
    {
        return new BoardgameFactory();
    }

    /**
     * Returns the boardgame objects from the processed response
     *
     * @return Shelf\Common\Model\Boardgame[]
     */
    public function getBoardgames()
    {
        return parent::getProcessedData();
    }
}
