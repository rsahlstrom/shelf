<?php

namespace Shelf\Entity\Boardgame;

use Shelf\Entity\AbstractDataEntityCollection;

/**
 * A collection of links belonging to a board game
 */
class LinkCollection extends AbstractDataEntityCollection
{
    /**
     * {@inheritDoc}
     */
    public function getChildClass()
    {
        return 'Shelf\\Entity\\Boardgame\\Link';
    }

    /**
     * Returns the links with a type of category
     *
     * @return LinkCollection
     */
    public function getCategories()
    {
        return $this->filterByType('category');
    }

    /**
     * Returns the links with a type of mechanic
     *
     * @return LinkCollection
     */
    public function getMechanics()
    {
        return $this->filterByType('mechanic');
    }

    /**
     * Returns the links with a type of designer
     *
     * @return LinkCollection
     */
    public function getDesigners()
    {
        return $this->filterByType('designer');
    }

    /**
     * Returns the links with a type of artist
     *
     * @return LinkCollection
     */
    public function getArtists()
    {
        return $this->filterByType('artist');
    }

    /**
     * Returns the links with a type of publisher
     *
     * @return LinkCollection
     */
    public function getPublishers()
    {
        return $this->filterByType('publisher');
    }

    /**
     * Returns the links with a type of family
     *
     * @return LinkCollection
     */
    public function getFamilies()
    {
        return $this->filterByType('family');
    }

    /**
     * Returns the links with a type of expansion
     *
     * @return LinkCollection
     */
    public function getExpansions()
    {
        return $this->filterByType('expansion');
    }

    /**
     * Returns the links with a type of implementation
     *
     * @return LinkCollection
     */
    public function getImplementations()
    {
        return $this->filterByType('implementation');
    }
}
