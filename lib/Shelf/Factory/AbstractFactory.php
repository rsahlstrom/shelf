<?php

namespace Shelf\Factory;

class AbstractFactory
{
    /**
     * Process a string from the xml api to remove entities, trim the result, and
     * run any other needed methods
     *
     * @param string $string
     *
     * @return string
     */
    protected static function processXmlApiString($string)
    {
        return trim(html_entity_decode($string));
    }
}
