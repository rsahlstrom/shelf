<?php

namespace Shelf\Test\Entity;

use Shelf\Factory\CollectionFactory;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $collection = CollectionFactory::fromArray(array(
            'name' => array(
                'value' => 'Roads and Boats',
                'type' => 'primary',
                'sort_index' => 1,
            )
        ));
        $name = $collection->getName();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection\\Name',
            $name
        );

        $this->assertEquals('Roads and Boats', $name->getValue());
    }

    public function testToArray()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBasic.xml');
        $collection = CollectionFactory::fromBggXml($xmlCollection->item[0]);

        $expectedArray = array(
            'bgg_id' => 8257,
            'type' => 'thing',
            'subtype' => 'boardgame',
            'coll_id' => 3736695,
            'name' => array(
                'value' => '& Cetera',
                'type' => 'primary',
                'sort_index' => 1,
            ),
            'year_published' => 2003,
            'bgg_image_url' => 'http://cf.geekdo-images.com/images/pic50966.jpg',
            'bgg_thumbnail_url' => 'http://cf.geekdo-images.com/images/pic50966_t.jpg',
            'own' => true,
            'previously_owned' => false,
            'for_trade' => false,
            'want' => false,
            'want_to_play' => false,
            'want_to_buy' => false,
            'wishlist' => false,
            'wishlist_priority' => null,
            'preordered' => false,
            'last_modified' => new \DateTime('2006-08-23 19:05:18'),
            'num_plays' => 0,
            'comment' => null,
            'stats' => null
        );

        $this->assertEquals($expectedArray, $collection->toArray());
    }
}
