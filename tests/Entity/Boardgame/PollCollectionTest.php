<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Factory\BoardgameFactory;

class PollCollectionTest extends \PHPUnit_Framework_TestCase
{
    public static $pollCollection;

    public static function setUpBeforeClass()
    {
        $xmlGame = simplexml_load_file(FIXTURE_DIR . '/Thing/arabianBasic.xml');
        $game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        self::$pollCollection = $game->getPolls();
    }

    public function testGetSuggestedNumPlayersPoll()
    {
        $poll = self::$pollCollection->getSuggestedNumPlayersPoll();
        $this->assertEquals('suggested_numplayers', $poll->getName());
    }

    public function testGetSuggestedPlayerAgePoll()
    {
        $poll = self::$pollCollection->getSuggestedPlayerAgePoll();
        $this->assertEquals('suggested_playerage', $poll->getName());
    }

    public function testGetLanguageDependencePoll()
    {
        $poll = self::$pollCollection->getLanguageDependencePoll();
        $this->assertEquals('language_dependence', $poll->getName());
    }
}
