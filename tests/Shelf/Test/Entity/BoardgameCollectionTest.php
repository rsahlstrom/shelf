<?php

namespace Shelf\Test\Entity;

use Shelf\Entity\BoardgameCollection;
use Shelf\Factory\BoardgameCollectionFactory;

class BoardgameCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $games;

    public function setUp()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';

        $xmlGame = simplexml_load_file($fixtureDir . '/TierCatanArabianBasic.xml');
        $this->games = BoardgameCollectionFactory::fromBggXml($xmlGame);
    }

    public function testCollectionFactoryResults()
    {
        $this->assertEquals(3, count($this->games));

        $this->assertEquals('Animal Upon Animal', $this->games[0]->getPrimaryName()->getValue());
        $this->assertEquals('The Settlers of Catan', $this->games[1]->getPrimaryName()->getValue());
        $this->assertEquals('Tales of the Arabian Nights', $this->games[2]->getPrimaryName()->getValue());
    }

    public function testPrimaryNameSort()
    {
        $collection = BoardgameCollectionFactory::fromArray(
            array(
                array(
                    'bgg_id' => 1,
                    'names' => array(
                        array(
                            'value' => 'The Settlers of Catan',
                            'type' => 'primary',
                            'sort_index' => '5',
                        ),
                        array(
                            'value' => 'Catan',
                            'type' => 'alternate',
                            'sort_index' => '1',
                        ),
                    ),
                ),
                array(
                    'bgg_id' => 2,
                    'names' => array(
                        array(
                            'value' => 'Animal Upon Animal',
                            'type' => 'primary',
                            'sort_index' => '1',
                        ),
                        array(
                            'value' => 'Tier auf Tier',
                            'type' => 'alternate',
                            'sort_index' => '1',
                        ),
                    ),
                ),
                array(
                    'bgg_id' => 3,
                    'names' => array(
                        array(
                            'value' => 'Taxi Drivers',
                            'type' => 'alternate',
                            'sort_index' => '1',
                        ),
                        array(
                            'value' => 'Taxi',
                            'type' => 'primary',
                            'sort_index' => '1',
                        ),
                    ),
                ),
            )
        );

        $this->assertEquals('The Settlers of Catan', $collection[0]->getPrimaryName()->getValue());
        $this->assertEquals('Animal Upon Animal', $collection[1]->getPrimaryName()->getValue());
        $this->assertEquals('Taxi', $collection[2]->getPrimaryName()->getValue());

        $collection->sortByPrimaryName();

        $this->assertEquals('Animal Upon Animal', $collection[0]->getPrimaryName()->getValue());
        $this->assertEquals('The Settlers of Catan', $collection[1]->getPrimaryName()->getValue());
        $this->assertEquals('Taxi', $collection[2]->getPrimaryName()->getValue());
    }
}
