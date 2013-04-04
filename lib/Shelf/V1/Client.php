<?php

namespace Shelf\V1;

use Shelf\Common\Version;

use Guzzle\Service\Client as ServiceClient;
use Guzzle\Service\Description\ServiceDescription;

class Client extends ServiceClient
{
    public static function factory($config = array())
    {
        $client = new self();
        $description = ServiceDescription::factory(__DIR__ . '/Config/service.json');
        $client->setDescription($description);

        $client->setUserAgent('Shelf/' . Version::VERSION, true);
        return $client;
    }
}
