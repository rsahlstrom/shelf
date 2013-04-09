<?php

namespace Shelf\Common\Filter;

/**
 * Filter to turn arrays into comma delimited strings and comma delimited strings
 * into arrays.
 */
class CommaDelimited
{
    /**
     * Turns an array into a string
     *
     * @param array $values
     *
     * @return string
     */
    public static function implode(array $values)
    {
        return implode(',', $values);
    }

    /**
     * Turns a string into an array
     *
     * @param string $value
     *
     * @return array
     */
    public static function explode($value)
    {
        return explode(',', $value);
    }
}
