<?php

namespace Shelf\Entity;

use Shelf\Entity\Collection\Name;
use Shelf\Entity\Collection\Stats;
use Shelf\Factory\CollectionFactory;

/**
 * Representation of a collection item from Board Game Geek with methods to access
 * that data
 */
class Collection extends AbstractDataEntity
{
    /**
     * Entity to represent the name of a collection
     *
     * @var Name
     */
    protected $nameEntity = null;

    /**
     * Entity to represent the stats of a collection
     *
     * @var Stats
     */
    protected $statsEntity = null;

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
     * Returns a stats entity
     *
     * @return Stats
     */
    public function getStats()
    {
        if (!$this->hasStats()) {
            return null;
        }

        if ($this->statsEntity === null) {
            $this->statsEntity = Stats::factory(parent::getStats());
        }

        return $this->statsEntity;
    }

    /**
     * {@inheritDoc}
     */
    public static function factory(array $data)
    {
        return CollectionFactory::fromArray($data);
    }
}
