<?php

namespace Shelf\Entity;

use Shelf\Utility\Inflector;

/**
 * Abstract entity has basic classes for working with an inflector and converting
 * to an array or json.
 *
 * All the inflector logic could probably be moved to a trait if we got PHP 5.4+
 */
abstract class AbstractEntity
{
    /**
     * Returns the inflector used to inflect function names and normalize the data
     * keys
     *
     * @var Inflector
     */
    protected $inflector = null;

    /**
     * Returns the inflector set on the object
     *
     * @return Inflector
     */
    protected function getInflector()
    {
        if ($this->inflector === null) {
            $this->inflector = new Inflector();
        }
        return $this->inflector;
    }

    /**
     * Sets the inflector to be used by the object when converting function names
     * and normalizing data keys
     *
     * @param Inflector $inflector
     */
    protected function setInflector(Inflector $inflector)
    {
        $this->inflector = $inflector;
    }

    /**
     * Returns a function name for a requested string
     *
     * @param string $functionName
     *
     * @return string
     */
    protected function getFunctionName($functionName)
    {
        $inflector = $this->getInflector();
        return lcfirst($inflector->camelcase($functionName));
    }

    /**
     * Converts the entity to an array
     *
     * @return array
     */
    abstract public function toArray();

    /**
     * Converts the entity to an array with all private keys removed
     *
     * @return array
     */
    abstract public function toPublicArray();

    /**
     * Returns the object as a json string
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Returns the object as a json string with all private keys removed
     *
     * @return string
     */
    public function toPublicJson()
    {
        return json_encode($this->toPublicArray());
    }
}
