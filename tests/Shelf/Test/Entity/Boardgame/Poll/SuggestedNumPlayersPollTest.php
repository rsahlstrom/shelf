<?php

namespace Shelf\Test\Entity\Boadgame\Poll;

use Shelf\Factory\BoardgameFactory;

class SuggestedNumPlayersPollTest extends \PHPUnit_Framework_TestCase
{
    public static $poll;

    public static function setUpBeforeClass()
    {
        $fixtureDir = __DIR__ . '/../../../Fixture/Thing';

        $xmlGame = simplexml_load_file($fixtureDir . '/arabianBasic.xml');
        $game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        self::$poll = $game->getSuggestedNumPlayersPoll();
    }

    public function testGetWinningOptions()
    {
        $winningOptions = self::$poll->getWinningOptions();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\OptionCollection',
            $winningOptions
        );
        $this->assertEquals('3', $winningOptions->first()->getValue());
    }
}
