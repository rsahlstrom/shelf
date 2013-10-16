<?php

namespace Shelf\Test\Entity;

use Shelf\Entity\BoardgameCollection;
use Shelf\Factory\BoardgameCollectionFactory;

class BoardgameCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $games;

    public function setUp()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';

        $xmlGame = simplexml_load_file($fixtureDir . '/TierCatanArabianBasic.xml');
        $this->games = BoardgameCollectionFactory::fromBggXml($xmlGame);
    }

    public function testCollectionFactoryResults()
    {
        $this->assertEquals(3, count($this->games));

        $this->assertEquals('Animal Upon Animal', $this->games[0]->getPrimaryName()->getValue());
        $this->assertEquals('The Settlers of Catan', $this->games[1]->getPrimaryName()->getValue());
        $this->assertEquals('Tales of the Arabian Nights', $this->games[2]->getPrimaryName()->getValue());
    }
}
