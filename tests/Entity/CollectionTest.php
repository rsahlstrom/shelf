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

    public function testGetStats()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivStats.xml');
        $collection = CollectionFactory::fromBggXml($xmlCollection->item[2]);

        $stats = $collection->getStats();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection\\Stats',
            $stats
        );
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

    public function testToArrayWithStats()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivStats.xml');
        $collection = CollectionFactory::fromBggXml($xmlCollection->item[2]);

        $expectedArray = array(
            'bgg_id' => 5867,
            'type' => 'thing',
            'subtype' => 'boardgame',
            'coll_id' => 3119312,
            'name' => array(
                'value' => '10 Days in Europe',
                'type' => 'primary',
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
            'stats' => array(
                'min_players' => 2,
                'max_players' => 4,
                'playing_time' => 30,
                'num_owned' => 1469,
                'rating' => array(
                    'personal' => 7.0,
                    'users_rated' => 1282,
                    'average' => 6.62885,
                    'bayes_average' => 6.29207,
                    'std_dev' => 1.19299,
                    'median' => 0.0,
                ),
                'ranks' => array(
                    array(
                        'type' => 'subtype',
                        'id' => 1,
                        'name' => 'boardgame',
                        'friendly_name' => 'Board Game Rank',
                        'value' => 982,
                        'bayes_average' => 6.29207
                    ),
                    array(
                        'type' => 'family',
                        'id' => 5499,
                        'name' => 'familygames',
                        'friendly_name' => 'Family Game Rank',
                        'value' => 238,
                        'bayes_average' => 6.38257
                    ),
                ),
            ),
        );

        $this->assertEquals($expectedArray, $collection->toArray());
    }
}
