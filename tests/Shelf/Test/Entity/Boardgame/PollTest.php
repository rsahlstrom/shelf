<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Entity\Boardgame\Poll;
use Shelf\Factory\BoardgameFactory;

class PollTest extends \PHPUnit_Framework_TestCase
{
    public static $poll;

    public static function setUpBeforeClass()
    {
        $xmlGame = simplexml_load_file(FIXTURE_DIR . '/Thing/arabianBasic.xml');
        $game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        self::$poll = $game->getSuggestedPlayerAgePoll();
    }

    public function testGetResults()
    {
        $resultCollection = self::$poll->getResults();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\ResultCollection',
            $resultCollection
        );
    }

    public function testGetWinningOptions()
    {
        $winningOption = self::$poll->getWinningOptions();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\OptionCollection',
            $winningOption
        );
        $this->assertEquals('12', $winningOption->first()->getValue());
    }

    public function testFactorySuggestedNumPlayers()
    {
        $poll = Poll::factory(array('name' => 'suggested_numplayers'));

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll',
            $poll
        );

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\SuggestedNumPlayersPoll',
            $poll
        );
    }

    public function testFactorySuggestedPlayerAge()
    {
        $poll = Poll::factory(array('name' => 'suggested_playerage'));

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll',
            $poll
        );

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\SuggestedPlayerAgePoll',
            $poll
        );
    }

    public function testFactoryLanguageDependence()
    {
        $poll = Poll::factory(array('name' => 'language_dependence'));

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll',
            $poll
        );

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll\\LanguageDependencePoll',
            $poll
        );
    }

    public function testFactoryUnknown()
    {
        $poll = Poll::factory(array('name' => 'unknown_poll'));

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\Poll',
            $poll
        );
    }
}
