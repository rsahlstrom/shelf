<?php

namespace Shelf\Common\Filter;

class CommaDelimited
{
    public static function implode(array $values)
    {
        return implode(',', $values);
    }

    public static function explode($value)
    {
        return explode(',', $value);
    }
}
