<?php

namespace Shelf\Entity\Boardgame\Poll;

use Shelf\Entity\AbstractDataEntityCollection;

/**
 * A collection of results belonging to a poll
 */
class ResultCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\\Entity\\Boardgame\\Poll\\Result';
    }
}
