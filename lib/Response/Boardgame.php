<?php

namespace Shelf\Response;

use Shelf\Factory\BoardgameFactory;

/**
 * Boardgame class to handle responses from the thing api endpoint with a type of
 * boardgame or boardgameexpansion
 */
class Boardgame extends AbstractResponse
{
    /**
     * {@inheritDoc}
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->rawData = $xml->item[0];
    }

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
     * Returns the Boardgame entity from the processed response
     *
     * @return Shelf\Entity\Boardgame
     */
    public function getBoardgame()
    {
        return parent::getProcessedData();
    }
}
