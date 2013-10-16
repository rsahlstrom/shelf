<?php

namespace Shelf\Test\Entity;

use Shelf\Entity\Boardgame;
use Shelf\Factory\BoardgameFactory;

class BoardgameTest extends \PHPUnit_Framework_TestCase
{
    protected $game;

    public function setUp()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';
        $xmlGames = simplexml_load_file($fixtureDir . '/arabianBasic.xml');
        $this->game = BoardgameFactory::fromBggXml($xmlGames->item[0]);
    }

    public function testIsExpansion()
    {
        $this->assertFalse($this->game->isExpansion());
    }

    public function testGetPrimaryName()
    {
        $this->assertSame('Tales of the Arabian Nights', $this->game->getPrimaryName()->getValue());
    }
}
