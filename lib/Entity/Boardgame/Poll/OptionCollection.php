<?php

namespace Shelf\Entity\Boardgame\Poll;

use Shelf\Entity\AbstractDataEntityCollection;

/**
 * A collection of options belonging to a poll
 */
class OptionCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\\Entity\\Boardgame\\Poll\\Option';
    }
}
