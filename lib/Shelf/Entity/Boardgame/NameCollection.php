<?php

namespace Shelf\Entity\Boardgame;

use Shelf\Entity\AbstractDataEntityCollection;
use Shelf\Exception\OutOfBoundsException;

class NameCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Entity\Boardgame\Name';
    }

    /**
     * Returns the primary name from the collection
     *
     * @return Name
     */
    public function getPrimaryName()
    {
        foreach ($this as $name) {
            if ($name->isPrimary()) {
                return $name;
            }
        }

        throw new OutOfBoundsException('No Primary Name Found!');
    }
}
