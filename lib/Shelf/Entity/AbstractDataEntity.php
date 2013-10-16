<?php

namespace Shelf\Entity;

use Shelf\Utility\Inflector;

/**
 * Abstract class that has basic getters and setters for accessing data from a
 * protected array
 *
 * If we switch to php 5.4+, then we can convert this to a trait and implement
 * jsonSerialize
 */
abstract class AbstractDataEntity implements \Serializable
{
    /**
     * An array that holds all of the objects data
     *
     * @var array
     */
    protected $data = array();

    /**
     * Keys that are allowed to be empty and are still considered to exist
     *
     * @var array
     */
    protected $allowableEmptyKeys = array();

    /**
     * Returns the inflector used to inflect function names and normalize the data
     * keys
     *
     * @var Inflector
     */
    protected $inflector = null;

    /**
     * Construct that accepts an array of data and loads it into the object
     *
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->setDataFromArray($data);
    }

    /**
     * Sets the data array used by the ojbect
     *
     * @param array $data
     */
    public function setDataFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $setFunction = $this->getFunctionName('set_' . $key);
            $this->$setFunction($value);
        }
    }

    /**
     * Returns the object as an array
     *
     * @return array
     */
    public function toArray()
    {
        // We don't return $this->data directly to make sure we go through any
        // custom getters that have been set.

        $keys = array_keys($this->data);
        $data = array();
        foreach ($keys as $key) {
            $getFunction = $this->getFunctionName('get_' . $key);
            $data[$key] = $this->$getFunction();
        }
        return $data;
    }

    /**
     * Returns an array with all private keys removed
     *
     * @return array
     */
    public function toPublicArray()
    {
        $data = $this->toArray();
        $privateKeys = $this->getPrivateKeys();
        foreach ($privateKeys as $privateKey) {
            unset($data[$privateKey]);
        }
        return $data;
    }

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

    /**
     * Serializes the object
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this->toArray());
    }

    /**
     * Unserializes the object
     *
     * @param string $data
     */
    public function unserialize($data)
    {
        $this->setDataFromArray(unserialize($data));
    }

    /**
     * Returns the private keys that should be excluded from the public array
     *
     * @return array
     */
    protected function getPrivateKeys()
    {
        return array();
    }

    /**
     * Checks for undefined get and set method calls
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     *
     * @throws \BadMethodCallException if method does not exist
     */
    public function __call($method, $arguments)
    {
        if (strpos($method, 'get') === 0) {
            $name = substr($method, 3);
            return $this->get($name);
        } elseif (strpos($method, 'set') === 0) {
            if (!array_key_exists(0, $arguments)) {
                throw new \InvalidArgumentException('You must pass a value to ' . $method);
            }

            $name = substr($method, 3);
            return $this->set($name, $arguments[0]);
        } elseif (strpos($method, 'has') === 0) {
            $name = substr($method, 3);
            return $this->has($name);
        }

        throw new \BadMethodCallException(sprintf('The method %s does not exist in %s!', $method, get_class($this)));
    }

    /**
     * Checks to see if a key exists but does not care about its value
     *
     * @param string $name
     *
     * @return boolean
     */
    protected function hasKey($name)
    {
        $normalizedName = $this->normalizeDataName($name);
        return array_key_exists($normalizedName, $this->data);
    }

    /**
     * Returns a boolean if the entity has the specified property
     *
     * @param string $name
     *
     * @return boolean
     */
    protected function has($name)
    {
        $normalizedName = $this->normalizeDataName($name);
        if (!array_key_exists($normalizedName, $this->data)) {
            return false;
        }

        if (empty($this->data[$normalizedName]) && !$this->allowsEmpty($name)) {
            return false;
        }

        return true;
    }

    /**
     * Checks if a key supports empty values
     *
     * @param string $name
     *
     * @return boolean
     */
    protected function allowsEmpty($name)
    {
        $normalizedName = $this->normalizeDataName($name);
        return in_array($normalizedName, $this->allowableEmptyKeys);
    }

    /**
     * Returns the requested value
     *
     * @param string $name
     *
     * @return mixed
     */
    protected function get($name)
    {
        $normalizedName = $this->normalizeDataName($name);
        if (!array_key_exists($normalizedName, $this->data)) {
            throw new \InvalidArgumentException($name . ' does not exist in the data array!');
        }

        return $this->data[$normalizedName];
    }

    /**
     * Sets the requested value
     *
     * @param string $name
     * @param mixed $value
     */
    protected function set($name, $value)
    {
        $normalizedName = $this->normalizeDataName($name);
        $this->data[$normalizedName] = $value;
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
     * Returns the normalized data key for a specified string
     *
     * @param string $name
     *
     * @return string
     */
    protected function normalizeDataName($name)
    {
        $inflector = $this->getInflector();
        return $inflector->underscore($name);
    }

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
     * Creates the entity based on an array of data passed to it
     *
     * @param array $data
     *
     * @return AbstractDataEntity
     */
    public static function factory(array $data)
    {
        return new static($data);
    }
}
