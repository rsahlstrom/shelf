<?php

namespace Shelf\Test\Response;

use Shelf\Response\Search;

class SearchTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTotalResults()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Search/carcassonne.xml');
        $response = new Search($xmlCollection);
        $this->assertEquals(104, $response->getTotalResults());
    }
}
