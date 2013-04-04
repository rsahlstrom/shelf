<?php

namespace Shelf;

use Guzzle\Service\Builder\ServiceBuilder;

class Builder extends ServiceBuilder
{
    public static function factory($config = null, array $globalParameters = array())
    {
        if ($config === null) {
            $config = __DIR__ . '/Config/services.json';
        }
        return parent::factory($config, $globalParameters);
    }
}
