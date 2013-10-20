<?php

namespace Shelf\Test\Factory;

use Shelf\Entity\Boardgame;
use Shelf\Factory\BoardgameFactory;

class BoardgameFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFromBggXml()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';
        $xmlGame = simplexml_load_file($fixtureDir . '/arabianBasic.xml');

        $boardgame = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame',
            $boardgame
        );
    }

    public function testFromArray()
    {
        $boardgame = BoardgameFactory::fromArray(
            array('bgg_id' => 34119)
        );

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame',
            $boardgame
        );
    }

    public function testConvertXmlItem()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';
        $xmlGame = simplexml_load_file($fixtureDir . '/arabianBasic.xml');

        $itemArray = BoardgameFactory::convertXmlItem($xmlGame->item[0]);
        $expectedArray = array(
            'bgg_id' => 34119,
            'type' => 'boardgame',
            'description' => 'From Z-Man Games Webpage:

In Tales of the Arabian Nights, you are the hero or heroine in a story of adventure and wonder just like those told by Scheherazade to her spellbound sultan! You will travel the land seeking your own destiny and fortune. You will learn stories and gain wisdom to share with others. Will you be the first to fulfill your destiny? The next Tale is yours to tell! There is, of course, a winner in Tales of the Arabian Nights, but the point of the game is less to see who wins and more to enjoy the unfolding and telling of a great story!

In this new edition of the groundbreaking storytelling game, you enter the lands of the Arabian Nights alongside Sindbad, Ali Baba, and the other legendary heroes of the tales. Travel the world encountering imprisoned princesses, powerful \'efreets, evil viziers, and such marvels as the Magnetic Mountain and the fabled Elephant\'s Graveyard.

Choose your actions carefully and the skills you possess will reward you: become beloved, wealthy, mighty - even become sultan of a great land. Choose foolishly, however, and become a beggar, or be cursed with a beast\'s form or become insane from terror! YOU will bring to life the stories of the inestimable Book of Tales in this vastly replayable board game with over 2002 tales that will challenge, amuse, astound and spellbind you for years to come.

Re-implements:

    Tales of the Arabian Nights',
            'bgg_image_url' => 'http://cf.geekdo-images.com/images/pic486114.jpg',
            'bgg_thumbnail_url' => 'http://cf.geekdo-images.com/images/pic486114_t.jpg',
            'min_players' => 1,
            'max_players' => 6,
            'min_age' => 12,
            'year_published' => 2009,
            'playing_time' => 120,
            'names' => array(
                array(
                    'value' => 'Tales of the Arabian Nights',
                    'type' => 'primary',
                    'sort_index' => 1
                )
            ),
            'links' => array(
                array(
                    'id' => 1022,
                    'value' => 'Adventure',
                    'type' => 'category',
                ),
                array(
                    'id' => 1052,
                    'value' => 'Arabian',
                    'type' => 'category',
                ),
                array(
                    'id' => 1010,
                    'value' => 'Fantasy',
                    'type' => 'category',
                ),
                array(
                    'id' => 2072,
                    'value' => 'Dice Rolling',
                    'type' => 'mechanic',
                ),
                array(
                    'id' => 2078,
                    'value' => 'Point to Point Movement',
                    'type' => 'mechanic',
                ),
                array(
                    'id' => 2028,
                    'value' => 'Role Playing',
                    'type' => 'mechanic',
                ),
                array(
                    'id' => 2027,
                    'value' => 'Storytelling',
                    'type' => 'mechanic',
                ),
                array(
                    'id' => 2015,
                    'value' => 'Variable Player Powers',
                    'type' => 'mechanic',
                ),
                array(
                    'id' => 5666,
                    'value' => 'Solitaire Games',
                    'type' => 'family',
                ),
                array(
                    'id' => 788,
                    'value' => 'Tales of the Arabian Nights',
                    'type' => 'implementation',
                    'inbound' => true,
                ),
                array(
                    'id' => 2341,
                    'value' => 'Anthony J. Gallela',
                    'type' => 'designer',
                ),
                array(
                    'id' => 169,
                    'value' => 'Eric Goldberg',
                    'type' => 'designer',
                ),
                array(
                    'id' => 39260,
                    'value' => 'Kevin Maroney',
                    'type' => 'designer',
                ),
                array(
                    'id' => 5610,
                    'value' => 'Zev Shlasinger',
                    'type' => 'designer',
                ),
                array(
                    'id' => 12058,
                    'value' => 'Peter Gifford',
                    'type' => 'artist',
                ),
                array(
                    'id' => 12034,
                    'value' => 'Dan Harding',
                    'type' => 'artist',
                ),
                array(
                    'id' => 538,
                    'value' => 'Z-Man Games',
                    'type' => 'publisher',
                ),
            ),
        );

        $this->assertEquals($expectedArray, $itemArray);
    }
}
