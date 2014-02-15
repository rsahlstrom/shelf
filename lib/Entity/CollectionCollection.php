<?php

namespace Shelf\Entity;

use Shelf\Entity\AbstractDataEntityCollection;

/**
 * A collection of Collection entities
 */
class CollectionCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Entity\Collection';
    }
}
