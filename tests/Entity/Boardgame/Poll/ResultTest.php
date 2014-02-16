<?php

namespace Shelf\Test\Entity\Boadgame\Poll;

use Shelf\Factory\BoardgameFactory;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    public static $result;

    public static function setUpBeforeClass()
    {
        $xmlGame = simplexml_load_file(FIXTURE_DIR . '/Thing/arabianBasic.xml');
        $game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        self::$result = $game->getSuggestedPlayerAgePoll()->getResults()->first();
    }

    public function testGetOptions()
    {
        $optionCollection = self::$result->getOptions();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\OptionCollection',
            $optionCollection
        );
    }

    public function testGetWinningOptions()
    {
        $winningOptions = self::$result->getWinningOptions();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\OptionCollection',
            $winningOptions
        );
        $this->assertEquals('12', $winningOptions->first()->getValue());
    }
}
