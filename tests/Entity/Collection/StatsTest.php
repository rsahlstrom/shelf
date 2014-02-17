<?php

namespace Shelf\Test\Entity\Collection;

use Shelf\Factory\CollectionFactory;

class StatsTest extends \PHPUnit_Framework_TestCase
{
    public static $stats;

    public static function setUpBeforeClass()
    {
        $xmlGame = simplexml_load_file(FIXTURE_DIR . '/Collection/janivStats.xml');
        $collection = CollectionFactory::fromBggXml($xmlGame->item[2]);
        self::$stats = $collection->getStats();
    }

    public function testSupportsPlayers()
    {
        $this->assertTrue(self::$stats->supportsPlayers(2));
        $this->assertTrue(self::$stats->supportsPlayers(3));
        $this->assertTrue(self::$stats->supportsPlayers(4));

        $this->assertFalse(self::$stats->supportsPlayers(1));
        $this->assertFalse(self::$stats->supportsPlayers(5));
    }

    public function testCanFinishIn()
    {
        $this->assertFalse(self::$stats->canFinishIn(10));
        $this->assertTrue(self::$stats->canFinishIn(30));
        $this->assertTrue(self::$stats->canFinishIn(60));
    }

    public function testGetRating()
    {
        $rating = self::$stats->getRating();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection\\Stats\\Rating',
            $rating
        );
    }

    public function testGetRanks()
    {
        $ranks = self::$stats->getRanks();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection\\Stats\\RankCollection',
            $ranks
        );
    }
}
