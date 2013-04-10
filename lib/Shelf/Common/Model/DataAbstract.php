<?php

namespace Shelf\Common\Model;

/**
 * Abstract class that has basic getters and setters for access data from a
 * protected array
 *
 * If this library ever goes php 5.4+, then we can convert this to a trait
 */
abstract class DataAbstract
{
    /**
     * An array that holds all of the objects data
     *
     * @var array
     */
    protected $data = array();

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
        // @TODO: Should we merge the arrays instead of overwrite?
        $this->data = $data;
    }

    /**
     * Returns the requested value or the default if the value is not found in
     * the data array
     *
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    protected function get($name, $default = null)
    {
        if (!array_key_exists($name, $this->data)) {
            return $default;
        }

        return $this->data[$name];
    }

    /**
     * Sets the requested value
     *
     * @param string $name
     * @param mixed $value
     */
    protected function set($name, $value)
    {
        $this->data[$name] = $value;
    }
}
