<?php

namespace Shelf\Entity;

use Shelf\Entity\Boardgame\LinkCollection;
use Shelf\Entity\Boardgame\NameCollection;
use Shelf\Entity\Boardgame\PollCollection;
use Shelf\Factory\BoardgameFactory;

/**
 * Representation of a board game from Board Game Geek with methods to access
 * that data
 */
class Boardgame extends AbstractDataEntity
{
    /**
     * Collection of links
     *
     * @var LinkCollection
     */
    protected $linkCollection = null;

    /**
     * Collection of names
     *
     * @var NameCollection
     */
    protected $nameCollection = null;

    /**
     * Collection of polls
     *
     * @var PollCollection
     */
    protected $pollCollection = null;

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
     * Returns a boolean if you can finish a game in less minutes than the amount
     * specified
     *
     * @param int $minutes
     *
     * @return boolean
     */
    public function canFinishIn($minutes)
    {
        return $minutes >= $this->getPlayingTime();
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
     * Returns a boolean if a link of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasLink($value)
    {
        $links = $this->getLinks()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean if a category of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasCategory($value)
    {
        $links = $this->getCategories()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean if a mechanic of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasMechanic($value)
    {
        $links = $this->getMechanics()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean if a designer of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasDesigner($value)
    {
        $links = $this->getDesigners()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean if an artist of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasArtist($value)
    {
        $links = $this->getArtists()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean if a publisher of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasPublisher($value)
    {
        $links = $this->getPublishers()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean if a family of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasFamily($value)
    {
        $links = $this->getFamilies()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean showing whether the game has any expansions
     *
     * @return boolean
     */
    public function hasExpansions()
    {
        return count($this->getExpansions()) > 0;
    }

    /**
     * Returns a boolean if an expansion of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasExpansion($value)
    {
        $links = $this->getExpansions()->filterByValue($value);
        return count($links) > 0;
    }

    /**
     * Returns a collection of compilations associated with a game
     *
     * @return LinkCollection
     */
    public function getCompilations()
    {
        return $this->getLinks()->getCompilations();
    }

    /**
     * Returns a boolean showing whether the game has any compilations
     *
     * @return boolean
     */
    public function hasCompilations()
    {
        return count($this->getCompilations()) > 0;
    }

    /**
     * Returns a boolean if a compilation of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasCompilation($value)
    {
        $links = $this->getCompilations()->filterByValue($value);
        return count($links) > 0;
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
     * Returns a boolean showing whether the game has any expansions
     *
     * @return boolean
     */
    public function hasImplementations()
    {
        return count($this->getImplementations()) > 0;
    }

    /**
     * Returns a boolean if an implementation of the specified value is present on the game
     *
     * @param string $value
     *
     * @return boolean
     */
    public function hasImplementation($value)
    {
        $links = $this->getImplementations()->filterByValue($value);
        return count($links) > 0;
    }

    /**
     * Returns the polls associated with a boardgame
     *
     * @return PollCollection
     */
    public function getPolls()
    {
        if ($this->pollCollection === null) {
            $this->pollCollection = PollCollection::factory(parent::getPolls());
        }

        return $this->pollCollection;
    }

    /**
     * Returns the SuggestedNumPlayers Poll
     *
     * @return SuggestedNumPlayersPoll
     */
    public function getSuggestedNumPlayersPoll()
    {
        return $this->getPolls()->getSuggestedNumPlayersPoll();
    }

    /**
     * Returns the suggested num players option with the highest vote
     *
     * @return Option
     */
    public function getSuggestedNumPlayers()
    {
        return $this->getSuggestedNumPlayersPoll()->getWinningOptions()->first();
    }

    /**
     * Returns the SuggestedPlayerAge Poll
     *
     * @return SuggestedPlayerAgePoll
     */
    public function getSuggestedPlayerAgePoll()
    {
        return $this->getPolls()->getSuggestedPlayerAgePoll();
    }

    /**
     * Returns the suggested player option with the highest vote
     *
     * @return Option
     */
    public function getSuggestedPlayerAge()
    {
        return $this->getSuggestedPlayerAgePoll()->getWinningOptions()->first();
    }

    /**
     * Returns the LanguageDependence Poll
     *
     * @return LanguageDependencePoll
     */
    public function getLanguageDependencePoll()
    {
        return $this->getPolls()->getLanguageDependencePoll();
    }

    /**
     * Returns the language dependence option with the highest vote
     *
     * @return Option
     */
    public function getLanguageDependence()
    {
        return $this->getLanguageDependencePoll()->getWinningOptions()->first();
    }

    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return BoardgameFactory::fromArray($data);
    }
}
