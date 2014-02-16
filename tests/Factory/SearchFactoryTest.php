<?php

namespace Shelf\Test\Factory;

use Shelf\Entity\Search;
use Shelf\Factory\SearchFactory;

class SearchFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFromBggXml()
    {
        $xmlSearch = simplexml_load_file(FIXTURE_DIR . '/Search/carcassonne.xml');

        $search = SearchFactory::fromBggXml($xmlSearch->item[0]);

        $this->assertInstanceOf(
            'Shelf\\Entity\\Search',
            $search
        );
    }

    public function testFromArray()
    {
        $search = SearchFactory::fromArray(
            array('bgg_id' => 8257)
        );

        $this->assertInstanceOf(
            'Shelf\\Entity\\Search',
            $search
        );
    }

    public function testConvertXmlItem()
    {
        $xmlSearch = simplexml_load_file(FIXTURE_DIR . '/Search/carcassonne.xml');

        $itemArray = SearchFactory::convertXmlItem($xmlSearch->item[0]);
        $expectedArray = array(
            'bgg_id' => 822,
            'type' => 'boardgame',
            'name' => array(
                'value' => 'Carcassonne',
                'type' => 'primary',
                'sort_index' => 1,
            ),
            'year_published' => 2000,
        );

        $this->assertEquals($expectedArray, $itemArray);
    }

    public function testConvertXmlItemAlternate()
    {
        $xmlSearch = simplexml_load_file(FIXTURE_DIR . '/Search/carcassonne.xml');

        $itemArray = SearchFactory::convertXmlItem($xmlSearch->item[5]);
        $expectedArray = array(
            'bgg_id' => 58798,
            'type' => 'boardgame',
            'name' => array(
                'value' => 'Carcassonne Korttipeli',
                'type' => 'alternate',
                'sort_index' => 1,
            ),
            'year_published' => 2009,
        );

        $this->assertEquals($expectedArray, $itemArray);
    }
}
