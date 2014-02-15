<?php

namespace Shelf\Entity;

use Shelf\Entity\Search\Name;
use Shelf\Factory\SearchFactory;

/**
 * Representation of a Search result from Board Game Geek with methods to access
 * that data
 */
class Search extends AbstractDataEntity
{
    /**
     * Entity to represent the name of a search
     *
     * @var Name
     */
    protected $nameEntity = null;

    /**
     * Returns a name entity
     *
     * @return Name
     */
    public function getName()
    {
        if ($this->nameEntity === null) {
            $this->nameEntity = Name::factory(parent::getName());
        }

        return $this->nameEntity;
    }

    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return SearchFactory::fromArray($data);
    }
}
