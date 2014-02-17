<?php

namespace Shelf\Entity\Collection\Stats;

use Shelf\Entity\AbstractDataEntityCollection;

/**
 * A collection of ranks
 */
class RankCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Entity\Collection\Stats\Rank';
    }
}
