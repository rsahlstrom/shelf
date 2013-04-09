<?php

namespace Shelf\V2\Model;

use Shelf\V2\Model\Boardgame\Name;

/**
 * Representation of a board game from Board Game Geek with methods to access
 * that data
 */
class Boardgame extends DataAbstract
{
    /**
     * Returns the board game geek id
     *
     * @return int
     */
    public function getBggId()
    {
        return $this->get('bgg_id');
    }

    /**
     * Returns a boolean based on whether this game is classified as an expansion
     *
     * @return boolean
     */
    public function isExpansion()
    {
        return $this->get('is_expansion');
    }

    /**
     * Returns the description of the game
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * Returns a board game geek url for the image
     *
     * @return string
     */
    public function getBggImage()
    {
        return $this->get('bgg_image_url');
    }

    /**
     * Returns a board game geek url for the thumbnail
     *
     * @return string
     */
    public function getBggThumbnail()
    {
        return $this->get('bgg_thumbnail_url');
    }

    /**
     * Gets the minimum number of players
     *
     * @return int
     */
    public function getMinPlayers()
    {
        return $this->get('min_players');
    }

    /**
     * Gets the maximum number of players
     *
     * @return int
     */
    public function getMaxPlayers()
    {
        return $this->get('max_players');
    }

    /**
     * Gets the minimum recommend age
     *
     * @return int
     */
    public function getMinAge()
    {
        return $this->get('min_age');
    }

    /**
     * Gets the age the game was published
     *
     * @return int
     */
    public function getYearPublished()
    {
        return $this->get('year_published');
    }

    /**
     * Gets the games playing time
     *
     * @return int
     */
    public function getPlayingTime()
    {
        return $this->get('playing_time');
    }

    /**
     * Returns a list of all the names associated with a game
     *
     * @return array
     */
    public function getNames()
    {
        $names = $this->get('names', array());

        $listOfNames = array();
        foreach ($names as $name) {
            $listOfNames[] = $name->getName();
        }

        return $listOfNames;
    }

    /**
     * Returns a list of all the names associated with the game. The names are
     * are a substring starting at the specified sort index of a name to remove
     * words such as the, etc.
     *
     * @return array
     */
    public function getSortNames()
    {
        $names = $this->get('names', array());

        $listOfNames = array();
        foreach ($names as $name) {
            $listOfNames[] = $name->getSortName();
        }

        return $listOfNames;
    }

    /**
     * Returns the name of the game. Attempts to first find the primary name. If
     * no primary name can be found, we return the first name.
     *
     * @return string
     */
    public function getName()
    {
        $names = $this->get('names', array());

        foreach ($names as $name) {
            if ($name->isPrimary()) {
                return $name->getName();
            }
        }

        if (count($names) > 0) {
            $name = reset($names);
            return $name->getName();
        }

        return null;
    }

    /**
     * Returns the sort name of the game. Attempts to first find the primary name.
     * If no primary name can be found, we return the first name.
     *
     * @return string
     */
    public function getSortName()
    {
        $names = $this->get('names', array());

        foreach ($names as $name) {
            if ($name->isPrimary()) {
                return $name->getSortName();
            }
        }

        if (count($names) > 0) {
            $name = reset($names);
            return $name->getSortName();
        }

        return null;
    }

    /**
     * Returns an array of categories that the game is associated with
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->get('category', array());
    }

    /**
     * Returns an array of mechanics the game is associated with
     *
     * @return array
     */
    public function getMechanics()
    {
        return $this->get('mechanics', array());
    }

    /**
     * Returns an array of families the game is associated with
     *
     * @return array
     */
    public function getFamilies()
    {
        return $this->get('family', array());
    }

    /**
     * Returns an array of designers the game is associated with
     *
     * @return array
     */
    public function getDesigners()
    {
        return $this->get('designer', array());
    }

    /**
     * Returns an array of artists the game is associated with
     *
     * @return array
     */
    public function getArtists()
    {
        return $this->get('artist', array());
    }

    /**
     * Returns an array of publishers the game is associated with
     *
     * @return array
     */
    public function getPublishers()
    {
        return $this->get('publisher', array());
    }

    /**
     * Returns an array of expansions associated with the game. The array contains
     * board game objects.
     *
     * @return array
     */
    public function getExpansions()
    {
        // @TODO: This should be an object property and not part of data
        if (!$this->get('expansions_processed', false)) {
            $this->processExpansions();
        }

        return $this->get('expansion', array());
    }

    /**
     * Processes the array of raw expansion data into an board game objects
     *
     * @return void
     */
    protected function processExpansions()
    {
        if ($this->get('expansions_processed', false)) {
            return;
        }

        $expansions = $this->get('expansion', array());
        $models = array();
        foreach ($expansions as $id => $name) {
            $models[] = $this->processExpansion($id, $name);
        }

        $this->set('expansion', $models);
    }

    /**
     * Processes a single expansion into a board game object
     *
     * @param int $id
     * @param string $name
     *
     * @return board game
     */
    protected function processExpansion($id, $name)
    {
        // @TODO: Should this call some kind of factory object?
        $data = array();
        $data['bgg_id'] = $id;
        $data['is_expansion'] = true;
        $data['names'] = array(
            new Name($name, true),
        );

        return new static($data);
    }
}
