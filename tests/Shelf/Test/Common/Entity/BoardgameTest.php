<?php

namespace Shelf\Test\Common\Entity;

use Shelf\Common\Entity\Boardgame;
use Shelf\V2\Factory\BoardgameFactory;

class BoardgameTest extends \PHPUnit_Framework_TestCase
{
    protected $game;

    public function setUp()
    {
        $fixtureDir = __DIR__ . '/../../V2/Fixture/Thing';
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
