<?php

namespace Shelf\Entity;

use Shelf\Entity\Boardgame\LinkCollection;
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
     * Collection of links
     *
     * @var LinkCollection
     */
    protected $linkCollection = null;

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
     * Returns the links associated with a boardgame
     *
     * @return LinkCollection
     */
    public function getLinks()
    {
        if ($this->linkCollection === null) {
            $this->linkCollection = LinkCollection::factory(parent::getLinks());
        }

        return $this->linkCollection;
    }

    /**
     * Returns a collection of categories associated with a game
     *
     * @return LinkCollection
     */
    public function getCategories()
    {
        return $this->getLinks()->getCategories();
    }

    /**
     * Returns a collection of mechanics associated with a game
     *
     * @return LinkCollection
     */
    public function getMechanics()
    {
        return $this->getLinks()->getMechanics();
    }

    /**
     * Returns a collection of designers associated with a game
     *
     * @return LinkCollection
     */
    public function getDesigners()
    {
        return $this->getLinks()->getDesigners();
    }

    /**
     * Returns a collection of artists associated with a game
     *
     * @return LinkCollection
     */
    public function getArtists()
    {
        return $this->getLinks()->getArtists();
    }

    /**
     * Returns a collection of publishers associated with a game
     *
     * @return LinkCollection
     */
    public function getPublishers()
    {
        return $this->getLinks()->getPublishers();
    }

    /**
     * Returns a collection of families associated with a game
     *
     * @return LinkCollection
     */
    public function getFamilies()
    {
        return $this->getLinks()->getFamilies();
    }

    /**
     * Returns a collection of expansions associated with a game
     *
     * @return LinkCollection
     */
    public function getExpansions()
    {
        return $this->getLinks()->getExpansions();
    }

    /**
     * Returns a collection of implementations associated with a game
     *
     * @return LinkCollection
     */
    public function getImplementations()
    {
        return $this->getLinks()->getImplementations();
    }

    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return BoardgameFactory::fromArray($data);
    }
}
