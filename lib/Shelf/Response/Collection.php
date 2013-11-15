<?php

namespace Shelf\Response;

use Shelf\Factory\CollectionCollectionFactory;

/**
 * Collection class to handle responses from the collection api endpoint
 */
class Collection extends AbstractResponse
{
    /**
     * {@inheritDoc}
     */
    public function getDefaultFactory()
    {
        return new CollectionCollectionFactory();
    }

    /**
     * Returns the total number of items in the collection
     *
     * @return int
     */
    public function getTotalItems()
    {
        return (int) $this->rawData['totalitems'];
    }

    /**
     * Returns a CollectionCollection entity from the processed response
     *
     * @return Shelf\Entity\CollectionCollection
     */
    public function getCollection()
    {
        return parent::getProcessedData();
    }
}
