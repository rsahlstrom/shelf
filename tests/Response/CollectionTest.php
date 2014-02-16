<?php

namespace Shelf\Test\Response;

use Shelf\Response\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTotalItems()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBasic.xml');
        $response = new Collection($xmlCollection);
        $this->assertEquals(824, $response->getTotalItems());
    }
}
