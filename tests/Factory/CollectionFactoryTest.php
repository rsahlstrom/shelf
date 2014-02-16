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
            'stats' => null,
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
            'stats' => null,
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
                'type' => 'primary',
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
            'stats' => null,
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
                'type' => 'primary',
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
            'stats' => null,
        );

        $this->assertEquals($expectedArray, $itemArray);
    }

    public function testConvertXmlItemWithStats()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivStats.xml');

        $itemArray = CollectionFactory::convertXmlItem($xmlCollection->item[2]);
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

        $this->assertEquals($expectedArray, $itemArray);
    }

    public function testConvertXmlItemWithStatsNoRatingOrRanking()
    {
        $xmlCollection = simplexml_load_file(FIXTURE_DIR . '/Collection/janivStats.xml');

        $itemArray = CollectionFactory::convertXmlItem($xmlCollection->item[0]);
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
            'stats' => array(
                'min_players' => 1,
                'max_players' => 6,
                'playing_time' => 240,
                'num_owned' => 1000,
                'rating' => array(
                    'personal' => null,
                    'users_rated' => 158,
                    'average' => 7.77652,
                    'bayes_average' => 6.03286,
                    'std_dev' => 1.23528,
                    'median' => 0.0,
                ),
                'ranks' => array(
                    array(
                        'type' => 'subtype',
                        'id' => 1,
                        'name' => 'boardgame',
                        'friendly_name' => 'Board Game Rank',
                        'value' => null,
                        'bayes_average' => 6.03286
                    ),
                    array(
                        'type' => 'family',
                        'id' => 5497,
                        'name' => 'strategygames',
                        'friendly_name' => 'Strategy Game Rank',
                        'value' => null,
                        'bayes_average' => 6.21333
                    ),
                ),
            ),
        );

        $this->assertEquals($expectedArray, $itemArray);
    }
}
