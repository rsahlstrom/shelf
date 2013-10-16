<?php

namespace Shelf\Entity;

/**
 * Abstract class that makes it easier to work with a collection of abstract data
 * entity objects
 */
abstract class AbstractDataEntityCollection implements
    \IteratorAggregate,
    \ArrayAccess,
    \Countable,
    \Serializable
{
    /**
     * Children in the collection
     *
     * @var array
     */
    protected $children = array();

    /**
     * Adds a child to the collection
     *
     * @param AbstractDataEntity $object
     * @param int $key
     */
    public function add(AbstractDataEntity $object, $key = null)
    {
        if ($key === null) {
            $this->children[] = $object;
        } else {
            $this->children[$key] = $object;
        }
    }

    /**
     * Returns the collection as an array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();

        foreach ($this as $child) {
            $array[] = $child->toArray();
        }

        return $array;
    }

    /**
     * Returns the collection as a public array
     *
     * @return array
     */
    public function toPublicArray()
    {
        $array = array();

        foreach ($this as $child) {
            $array[] = $child->toPublicArray();
        }

        return $array;
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
        return serialize($this->children);
    }

    /**
     * Unserializes the object
     *
     * @param string $data
     */
    public function unserialize($data)
    {
        $this->children = unserialize($data);
    }

    /**
     * Returns the class name used to make child objects
     *
     * @return string
     */
    abstract public function getChildClass();

    /**
     * Static method to create the collection from an array
     *
     * @param array $children
     *
     * @return AbstractDataEntityCollection
     */
    public static function factory(array $children)
    {
        $collection = new static();

        $childClass = $collection->getChildClass();
        foreach ($children as $childData) {
            $child = $childClass::factory($childData);
            $collection->add($child);
        }

        return $collection;
    }

    /**
     * Get an iterator object
     *
     * @return array
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * Adds a value to the collection
     *
     * @param int|null $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->add($value, $offset);
    }

    /**
     * Checks to see if an offset exists
     *
     * @param int $offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->children);
    }

    /**
     * Removes an offset from the children
     *
     * @param int $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->children[$offset]);
    }

    /**
     * Gets a specific offset
     *
     * @param int $offset
     *
     * @return AbstractDataEntity
     */
    public function offsetGet($offset)
    {
        return array_key_exists($offset, $this->children) ? $this->children[$offset] : null;
    }

    /**
     * Returns the number of children in the collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->children);
    }
}
