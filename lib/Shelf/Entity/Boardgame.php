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
    /**
     * Collection of names
     *
     * @var NameCollection
     */
    protected $nameCollection = null;

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
     * Returns a boolean showing whether a game supports a requested number of
     * players
     *
     * @param int $numPlayers
     *
     * @return boolean
     */
    public function supportsPlayers($numPlayers)
    {
        return $numPlayers >= $this->getMinPlayers()
            && $numPlayers <= $this->getMaxPlayers();
    }

    /**
     * Returns a boolean showing whether a game supports a requested age
     *
     * @param int $age
     *
     * @return boolean
     */
    public function supportsAge($age)
    {
        return $age >= $this->getMinAge();
    }

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
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return BoardgameFactory::fromArray($data);
    }
}
