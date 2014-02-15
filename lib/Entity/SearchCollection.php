<?php

namespace Shelf\Entity;

use Shelf\Entity\AbstractDataEntityCollection;

/**
 * A collection of Search entities
 */
class SearchCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Entity\Search';
    }
}
