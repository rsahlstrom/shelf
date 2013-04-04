<?php

namespace Shelf\V2\Model\Boardgame;

use Shelf\V2\Model\DataAbstract;

class Name extends DataAbstract
{
    public function __construct($name, $primary = false)
    {
        $this->set('name', $name);
        $this->set('primary', $primary);
    }

    public function getName()
    {
        return $this->get('name');
    }

    public function getSortName()
    {
        return substr($this->getName(), $this->getSortIndex());
    }

    public function isPrimary()
    {
        return $this->get('primary');
    }

    public function setSortIndex($index)
    {
        $this->set('sortindex', $index);
    }

    public function getSortIndex()
    {
        return $this->get('sortindex', 0);
    }
}
