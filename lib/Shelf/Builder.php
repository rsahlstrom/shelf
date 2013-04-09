<?php

namespace Shelf;

use Guzzle\Service\Builder\ServiceBuilder;

/**
 * Builder is an extension of Guzzle's ServiceBuilder and is used to load up the
 * various API's of Board Game Geek
 */
class Builder extends ServiceBuilder
{
    /**
     * Factory method to create a builder with the necessary config file to find
     * the various api clients.
     *
     * @param array|string $config Location of config file to load
     * @param array $globalParameters Parameters to pass to all clients created by the Builder
     *
     * @return Builder
     */
    public static function factory($config = null, array $globalParameters = array())
    {
        if ($config === null) {
            $config = __DIR__ . '/Config/services.json';
        }
        return parent::factory($config, $globalParameters);
    }
}
