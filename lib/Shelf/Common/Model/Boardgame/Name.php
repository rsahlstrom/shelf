<?php

namespace Shelf\Common\Model\Boardgame;

use Shelf\Common\Model\DataAbstract;

/**
 * Class used to represent the name of a board game and the various properties
 * associated with that name
 */
class Name extends DataAbstract
{
    /**
     * Constructs the name object
     *
     * @param string $name
     * @param boolean $primary
     */
    public function __construct($name, $primary = false)
    {
        $this->set('name', $name);
        $this->set('primary', $primary);
    }

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Returns a substring of the name based on the sort index
     *
     * @return string
     */
    public function getSortName()
    {
        return substr($this->getName(), $this->getSortIndex());
    }

    /**
     * Checks to see if this is the primary name
     *
     * @return boolean
     */
    public function isPrimary()
    {
        return $this->get('primary');
    }

    /**
     * Sets the sort index for a name
     *
     * @param int $index
     */
    public function setSortIndex($index)
    {
        $this->set('sortindex', $index);
    }

    /**
     * Returns the sort index for a name
     *
     * @return int
     */
    public function getSortIndex()
    {
        return $this->get('sortindex', 0);
    }
}
