<?php

namespace Shelf\Entity;

use Shelf\Factory\CollectionFactory;

/**
 * Representation of a collection item from Board Game Geek with methods to access
 * that data
 */
class Collection extends AbstractDataEntity
{
    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return CollectionFactory::fromArray($data);
    }
}
