<?php

namespace Shelf\Entity\Collection;

use Shelf\Entity\Collection\Stats\Rating;
use Shelf\Entity\Collection\Stats\RankCollection;
use Shelf\Entity\AbstractDataEntity;

/**
 * Stats of a collection item from Board Game Geek with methods
 * to access that data
 */
class Stats extends AbstractDataEntity
{
    /**
     * Entity to represent the rating of the stats
     *
     * @var Rating
     */
    protected $ratingEntity = null;

    /**
     * Collection of ranks associated with the stats
     *
     * @var RankCollection
     */
    protected $rankCollection = null;

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
     * Returns the rating entity associated with the stats
     *
     * @return Rating
     */
    public function getRating()
    {
        if ($this->ratingEntity === null) {
            $this->ratingEntity = Rating::factory(parent::getRating());
        }

        return $this->ratingEntity;
    }

    /**
     * Returns the ranks associated with the stats
     *
     * @return RankCollection
     */
    public function getRanks()
    {
        if ($this->rankCollection === null) {
            $this->rankCollection = RankCollection::factory(parent::getRanks());
        }

        return $this->rankCollection;
    }
}
