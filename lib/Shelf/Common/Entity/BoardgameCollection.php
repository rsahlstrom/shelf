<?php

namespace Shelf\Common\Entity;

use Shelf\Common\Entity\AbstractDataEntityCollection;

class BoardgameCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Common\Entity\Boardgame';
    }
}
