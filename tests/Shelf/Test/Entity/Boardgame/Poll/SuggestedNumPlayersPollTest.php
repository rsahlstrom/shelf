<?php

namespace Shelf\Test\Entity\Boadgame\Poll;

use Shelf\Factory\BoardgameFactory;

class SuggestedNumPlayersPollTest extends \PHPUnit_Framework_TestCase
{
    public static $poll;

    public static function setUpBeforeClass()
    {
        $xmlGame = simplexml_load_file(FIXTURE_DIR . '/Thing/arabianBasic.xml');
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
