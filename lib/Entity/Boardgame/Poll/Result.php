<?php

namespace Shelf\Entity\Boardgame\Poll;

use Shelf\Entity\AbstractDataEntity;
use Shelf\Entity\Boardgame\Poll\OptionCollection;

/**
 * Class used to represent a result of a poll
 */
class Result extends AbstractDataEntity
{
    /**
     * Collection of Results
     *
     * @var OptionCollection
     */
    protected $optionCollection = null;

    /**
     * Returns the options of the result
     *
     * @return OptionCollection
     */
    public function getOptions()
    {
        if ($this->optionCollection === null) {
            $this->optionCollection = OptionCollection::factory(parent::getOptions());
        }

        return $this->optionCollection;
    }

    /**
     * Returns the collection of winning options
     *
     * @return OptionCollection
     */
    public function getWinningOptions()
    {
        $groups = $this->getOptions()->groupByNumVotes();
        ksort($groups, SORT_NUMERIC);
        return end($groups);
    }
}
