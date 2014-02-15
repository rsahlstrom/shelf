<?php

namespace Shelf\Entity\Boardgame;

use Shelf\Entity\AbstractDataEntity;
use Shelf\Entity\Boardgame\Poll\ResultCollection;
use Shelf\Entity\Boardgame\Poll\SuggestedNumPlayersPoll;
use Shelf\Entity\Boardgame\Poll\SuggestedPlayerAgePoll;
use Shelf\Entity\Boardgame\Poll\LanguageDependencePoll;

/**
 * Class used to represent a poll for a board game and its results
 */
class Poll extends AbstractDataEntity
{
    /**
     * Collection of Results
     *
     * @var ResultCollection
     */
    protected $resultCollection = null;

    /**
     * Returns the results of a poll as a collection
     *
     * @return ResultCollection
     */
    public function getResults()
    {
        if ($this->resultCollection === null) {
            $this->resultCollection = ResultCollection::factory(parent::getResults());
        }

        return $this->resultCollection;
    }

    /**
     * Returns the winning options for the poll
     *
     * @return OptionCollection
     */
    public function getWinningOptions()
    {
        return $this->getResults()->first()->getWinningOptions();
    }

    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        switch (strtolower($data['name'])) {
            case 'suggested_numplayers':
                return new SuggestedNumPlayersPoll($data);
                break;
            case 'suggested_playerage':
                return new SuggestedPlayerAgePoll($data);
                break;
            case 'language_dependence':
                return new LanguageDependencePoll($data);
                break;
            default:
                return new static($data);
        }
    }
}
