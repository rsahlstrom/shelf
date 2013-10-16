<?php

namespace Shelf\Test\Entity;

use Shelf\Factory\BoardgameFactory;

class BoardgameTest extends \PHPUnit_Framework_TestCase
{
    protected $game;
    protected $expansion;

    public function setUp()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';

        $xmlGame = simplexml_load_file($fixtureDir . '/arabianBasic.xml');
        $this->game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        $xmlExpansion = simplexml_load_file($fixtureDir . '/catanCitiesAndKnightsBasic.xml');
        $this->expansion = BoardgameFactory::fromBggXml($xmlExpansion->item[0]);
    }

    public function testIsExpansion()
    {
        $this->assertFalse($this->game->isExpansion());
        $this->assertTrue($this->expansion->isExpansion());
    }

    public function testGetPrimaryName()
    {
        $this->assertSame('Tales of the Arabian Nights', $this->game->getPrimaryName()->getValue());
        $this->assertSame('Catan: Cities & Knights', $this->expansion->getPrimaryName()->getValue());
    }
}
