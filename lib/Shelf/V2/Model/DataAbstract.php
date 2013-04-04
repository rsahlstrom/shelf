<?php

namespace Shelf\V2\Model;

abstract class DataAbstract
{
    protected $data = array();

    public function __construct(array $data = array())
    {
        $this->setDataFromArray($data);
    }

    public function setDataFromArray($data)
    {
        $this->data = $data;
    }

    protected function get($name, $default = null)
    {
        if (!array_key_exists($name, $this->data)) {
            return $default;
        }

        return $this->data[$name];
    }

    protected function set($name, $value)
    {
        $this->data[$name] = $value;
    }
}
