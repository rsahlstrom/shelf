<?php

namespace Shelf\Entity;

use Shelf\Entity\Boardgame\NameCollection;
use Shelf\Factory\BoardgameFactory;

/**
 * Representation of a board game from Board Game Geek with methods to access
 * that data
 */
class Boardgame extends AbstractDataEntity
{
    protected $nameCollection = null;

    /**
     * Returns true if the game is an expansion
     *
     * @return boolean
     */
    public function isExpansion()
    {
        return $this->getType() == 'boardgameexpansion';
    }

    /**
     * Returns a collection of board game names
     *
     * @return NameCollection
     */
    public function getNames()
    {
        if ($this->nameCollection === null) {
            $this->nameCollection = NameCollection::factory(parent::getNames());
        }

        return $this->nameCollection;
    }

    /**
     * Returns the primary name of the board game
     *
     * @return string
     */
    public function getPrimaryName()
    {
        return $this->getNames()->getPrimaryName();
    }

    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return BoardgameFactory::fromArray($data);
    }
}
