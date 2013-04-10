<?php

namespace Shelf\V2\Factory;

/**
 * Interface to ensure that all factories provide a similar set of required methods
 */
interface FactoryInterface
{
    /**
     * Transforms a raw xml response from the BGG API to a Common Model object
     *
     * @param \SimpleXMLElement $rawXml
     *
     * @return Shelf\Common\Model\DataAbstract[]
     */
    public function fromBggXml(\SimpleXMLElement $rawXml);
}
