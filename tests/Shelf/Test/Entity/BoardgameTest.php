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

    public function testGetNames()
    {
        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\NameCollection',
            $this->game->getNames()
        );

        $this->assertCount(1, $this->game->getNames());
        $this->assertCount(28, $this->expansion->getNames());
    }

    public function testGetPrimaryName()
    {
        $this->assertSame('Tales of the Arabian Nights', $this->game->getPrimaryName()->getValue());
        $this->assertSame('Catan: Cities & Knights', $this->expansion->getPrimaryName()->getValue());
    }

    public function testIsExpansion()
    {
        $this->assertFalse($this->game->isExpansion());
        $this->assertTrue($this->expansion->isExpansion());
    }

    public function testSupportsPlayers()
    {
        $this->assertTrue($this->game->supportsPlayers(1));
        $this->assertTrue($this->game->supportsPlayers(2));
        $this->assertTrue($this->game->supportsPlayers(3));
        $this->assertTrue($this->game->supportsPlayers(4));
        $this->assertTrue($this->game->supportsPlayers(5));
        $this->assertTrue($this->game->supportsPlayers(6));

        $this->assertFalse($this->game->supportsPlayers(0));
        $this->assertFalse($this->game->supportsPlayers(7));
    }

    public function testSupportsAge()
    {
        $this->assertFalse($this->game->supportsAge(0));
        $this->assertFalse($this->game->supportsAge(11));

        $this->assertTrue($this->game->supportsAge(12));
        $this->assertTrue($this->game->supportsAge(15));
        $this->assertTrue($this->game->supportsAge(99));
        $this->assertTrue($this->game->supportsAge(1072));
    }
}
