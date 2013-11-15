<?php

namespace Shelf\Entity\Boardgame;

use Shelf\Entity\AbstractName;

/**
 * Class used to represent the name of a board game and the various properties
 * associated with that name
 */
class Name extends AbstractName
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
}
