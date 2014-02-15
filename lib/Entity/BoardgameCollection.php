<?php

namespace Shelf\Entity;

use Shelf\Entity\AbstractDataEntityCollection;

class BoardgameCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Entity\Boardgame';
    }

    /**
     * Sorts the games in the collection by their primary name
     */
    public function sortByPrimaryName()
    {
        usort($this->children, array($this, 'primaryNameSort'));
    }

    /**
     * Sorts two games by their primary names
     *
     * @param Boardgame $gameA
     * @param Boardgame $gameB
     *
     * @return boolean
     */
    protected function primaryNameSort(Boardgame $gameA, Boardgame $gameB)
    {
        return strcasecmp(
            $gameA->getPrimaryName()->getSortValue(),
            $gameB->getPrimaryName()->getSortValue()
        );
    }
}
