<?php

namespace Shelf\Entity\Boardgame\Poll;

use Shelf\Entity\Boardgame\Poll;

/**
 * Suggested Num Players Poll
 */
class SuggestedNumPlayersPoll extends Poll
{
    /**
     * {@inheritDoc}
     */
    public function getWinningOptions()
    {
        $optionsArray = array();
        foreach ($this->getResults() as $result) {
            $optionsArray[] = array(
                'value' => $result->getNumPlayers(),
                'num_votes' => $result->getOptions()->findByValue('best')->getNumVotes(),
            );
        }

        $result = Result::factory(array('options' => $optionsArray));
        return $result->getWinningOptions();
    }
}
