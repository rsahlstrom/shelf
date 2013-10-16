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
}
