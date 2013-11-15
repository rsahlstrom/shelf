<?php

namespace Shelf\Test\Factory;

use Shelf\Entity\Collection;
use Shelf\Factory\CollectionFactory;

class CollectionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFromBggXml()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBasic.xml');

        $collection = CollectionFactory::fromBggXml($xmlCollection->item[0]);

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection',
            $collection
        );
    }

    public function testFromArray()
    {
        $collection = CollectionFactory::fromArray(
            array('bgg_id' => 8257)
        );

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection',
            $collection
        );
    }

    public function testConvertXmlItem()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBasic.xml');

        $itemArray = CollectionFactory::convertXmlItem($xmlCollection->item[0]);
        $expectedArray = array(
            'bgg_id' => 8257,
            'type' => 'thing',
            'subtype' => 'boardgame',
            'coll_id' => 3736695,
            'name' => array(
                'value' => '& Cetera',
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
        );

        $this->assertEquals($expectedArray, $itemArray);
    }

    public function testConvertXmlItemWithComment()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBasic.xml');

        $itemArray = CollectionFactory::convertXmlItem($xmlCollection->item[2]);
        $expectedArray = array(
            'bgg_id' => 5867,
            'type' => 'thing',
            'subtype' => 'boardgame',
            'coll_id' => 3119312,
            'name' => array(
                'value' => '10 Days in Europe',
                'sort_index' => 1,
            ),
            'year_published' => 2003,
            'bgg_image_url' => 'http://cf.geekdo-images.com/images/pic1229641.jpg',
            'bgg_thumbnail_url' => 'http://cf.geekdo-images.com/images/pic1229641_t.jpg',
            'own' => true,
            'previously_owned' => false,
            'for_trade' => false,
            'want' => false,
            'want_to_play' => false,
            'want_to_buy' => false,
            'wishlist' => false,
            'wishlist_priority' => null,
            'preordered' => false,
            'last_modified' => new \DateTime('2006-12-02 01:30:51'),
            'num_plays' => 12,
            'comment' => 'Played this with my Mom over Thanksgiving 2005 and we both thought it was very interesting. Don\'t let the game fool you. It\'s a thinking game and an excellent brain burner (at least for us).

I\'ve played this several times after with different people and it\'s usually a pretty big hit.',
        );

        $this->assertEquals($expectedArray, $itemArray);
    }

    public function testConvertXmlItemWithWishlist()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBasic.xml');

        $itemArray = CollectionFactory::convertXmlItem($xmlCollection->item[28]);
        $expectedArray = array(
            'bgg_id' => 48726,
            'type' => 'thing',
            'subtype' => 'boardgame',
            'coll_id' => 11694686,
            'name' => array(
                'value' => 'Alien Frontiers',
                'sort_index' => 1,
            ),
            'year_published' => 2010,
            'bgg_image_url' => 'http://cf.geekdo-images.com/images/pic1657833.jpg',
            'bgg_thumbnail_url' => 'http://cf.geekdo-images.com/images/pic1657833_t.jpg',
            'own' => false,
            'previously_owned' => false,
            'for_trade' => false,
            'want' => false,
            'want_to_play' => false,
            'want_to_buy' => false,
            'wishlist' => true,
            'wishlist_priority' => 3,
            'preordered' => false,
            'last_modified' => new \DateTime('2012-10-29 13:07:44'),
            'num_plays' => 0,
            'comment' => null,
        );

        $this->assertEquals($expectedArray, $itemArray);
    }

    public function testConvertXmlItemBrief()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivBrief.xml');

        $itemArray = CollectionFactory::convertXmlItem($xmlCollection->item[0]);
        $expectedArray = array(
            'bgg_id' => 8257,
            'type' => 'thing',
            'subtype' => 'boardgame',
            'coll_id' => 3736695,
            'name' => array(
                'value' => '& Cetera',
                'sort_index' => 1,
            ),
            'year_published' => null,
            'bgg_image_url' => null,
            'bgg_thumbnail_url' => null,
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
            'num_plays' => null,
            'comment' => null,
        );

        $this->assertEquals($expectedArray, $itemArray);
    }
}
