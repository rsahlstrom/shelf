<?php

namespace Shelf\Entity\Boardgame;

use Shelf\Entity\AbstractDataEntity;

/**
 * Class used to represent the name of a board game and the various properties
 * associated with that name
 */
class Name extends AbstractDataEntity
{
    /**
     * Returns true if the name is considered to be the primary name
     *
     * @return boolean
     */
    public function isPrimary()
    {
        return $this->getType() == 'primary';
    }

    /**
     * Returns the value starting with the sort index
     *
     * @param $appendPreSort OPTIONAL Controls whether the characters pre-sort
     *                                index are appended to returned result
     *
     * @return string
     */
    public function getSortValue($appendPreSort = true)
    {
        $value = $this->getValue();
        $sortIndex = $this->getSortIndex();

        $sortValue = substr($value, $sortIndex);
        if ($appendPreSort) {
            $sortValue .= ', ' . substr($value, 0, $sortIndex - 1);
        }
        return $sortValue;
    }
}
