<?php

namespace Shelf\Entity\Boardgame;

use Shelf\Entity\AbstractDataEntityCollection;
use Shelf\Exception\OutOfBoundsException;

/**
 * A collection of polls belonging to a board game
 */
class PollCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\\Entity\\Boardgame\\Poll';
    }

    /**
     * Returns the SuggestedNumPlayers Poll
     *
     * @return Poll
     */
    public function getSuggestedNumPlayersPoll()
    {
        return $this->findByName('suggested_numplayers');
    }

    /**
     * Returns the SuggestedPlayerAge Poll
     *
     * @return Poll
     */
    public function getSuggestedPlayerAgePoll()
    {
        return $this->findByName('suggested_playerage');
    }

    /**
     * Returns the LanguageDependence Poll
     *
     * @return Poll
     */
    public function getLanguageDependencePoll()
    {
        return $this->findByName('language_dependence');
    }
}
