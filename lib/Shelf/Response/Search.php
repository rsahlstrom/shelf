<?php

namespace Shelf\Response;

use Shelf\Factory\SearchCollectionFactory;

/**
 * Search class to handle responses from the search api endpoint
 */
class Search extends AbstractResponse
{
    /**
     * {@inheritDoc}
     */
    public function getDefaultFactory()
    {
        return new SearchCollectionFactory();
    }

    /**
     * Returns the total number of search results
     *
     * @return int
     */
    public function getTotalResults()
    {
        return (int) $this->rawData['total'];
    }

    /**
     * Returns a SearchCollection entity from the processed response
     *
     * @return Shelf\Entity\SearchCollection
     */
    public function getResults()
    {
        return parent::getProcessedData();
    }
}
