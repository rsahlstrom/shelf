<?php

namespace Shelf\Common\Entity\Boardgame;

use Shelf\Common\Entity\AbstractDataEntityCollection;
use Shelf\Exception\OutOfBoundsException;

class NameCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\Common\Entity\Boardgame\Name';
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
