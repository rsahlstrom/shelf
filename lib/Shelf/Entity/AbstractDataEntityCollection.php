<?php

namespace Shelf\Entity;

use Shelf\Exception\BadMethodCallException;

/**
 * Abstract class that makes it easier to work with a collection of abstract data
 * entity objects
 */
abstract class AbstractDataEntityCollection extends AbstractEntity implements
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
     * Filters a collection to only contain children that has data matching specific
     * values
     *
     * @param array $filterSets
     * @param boolean $caseSensitive OPTIONAL
     *
     * @return AbstractDataEntityCollection
     */
    public function filterByArray(array $filterSets, $caseSensitive = false)
    {
        $collection = new static();

        foreach ($this as $child) {
            $childMatches = true;
            foreach ($filterSets as $key => $value) {
                $getter = $this->getFunctionName('get_' . $key);
                $childValue = $child->$getter();

                if (!$caseSensitive) {
                    $value = strtolower($value);
                    $childValue = strtolower($childValue);
                }

                if ($childValue != $value) {
                    $childMatches = false;
                    break;
                }
            }

            if ($childMatches) {
                $collection->add($child);
            }
        }

        return $collection;
    }

    /**
     * Magic method to handle unknown method calls. Currently supports get* and
     * filterBy*
     *
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public function __call($method, array $args)
    {
        if (strpos($method, 'get') === 0) {
            return $this->getFromEachChild($method);
        } elseif (strpos($method, 'filterBy') === 0) {
            $filterKey = preg_replace('/^filterBy/i', '', $method);
            $caseSensitive = false;
            if (isset($args[1])) {
                $caseSensitive = $args[1];
            }
            return $this->filterByArray(
                array($filterKey => $args[0]),
                $caseSensitive
            );
        }

        throw new BadMethodCallException('Unrecognized method "'.$method.'()"');
    }

    /**
     * Calls a get method on each child and returns the values as an array
     *
     * @param string $method
     *
     * @return array
     */
    protected function getFromEachChild($method)
    {
        $childValues = array();
        foreach ($this as $child) {
            $childValues[] = $child->$method();
        }
        return $childValues;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
