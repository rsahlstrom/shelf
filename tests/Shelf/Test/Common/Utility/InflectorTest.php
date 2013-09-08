<?php

namespace Shelf\Test\Common\Utility;

use Shelf\Common\Utility\Inflector;

class InflectorTest extends \PHPUnit_Framework_TestCase
{
    public function testCamelCase()
    {
        $this->assertEquals('roadsAndBoats', Inflector::camelcase('roads_and_boats'));
        $this->assertEquals('RoadsAndBoats', Inflector::camelcase('roads_and_boats', false));

        $this->assertEquals('agricola', Inflector::camelcase('agricola'));

        $this->assertEquals('settlersOfCatan', Inflector::camelcase('settlers__of__catan'));

        $this->assertEquals('ticketToRide', Inflector::camelcase('ticket to ride'));

        $this->assertEquals('24', Inflector::camelcase('24'));
        $this->assertEquals('24', Inflector::camelcase('24', true));
        $this->assertEquals('20Questions', Inflector::camelcase('20 Questions'));
        $this->assertEquals('theMagic8Ball', Inflector::camelcase('The Magic 8 Ball'));
        $this->assertEquals('theMagic8Ball', Inflector::camelcase('the_magic_8_ball'));

        $this->assertEquals('CTRMan', Inflector::camelcase('CTR Man', false));

        $this->assertEquals(
            'theEmperorsNewClothesARatherSillyGame',
            Inflector::camelcase('The Emperor\'s New Clothes: A Rather Silly Game')
        );
    }

    public function testUnderscore()
    {
        $this->assertEquals('roads_and_boats', Inflector::underscore('roadsAndBoats'));
        $this->assertEquals('roads_and_boats', Inflector::underscore('Roads and Boats'));

        $this->assertEquals('agricola', Inflector::underscore('agricola'));

        $this->assertEquals('settlers__of__catan', Inflector::underscore('settlers__of__catan'));

        $this->assertEquals('ticket_to_ride', Inflector::underscore('ticket to ride'));

        $this->assertEquals('24', Inflector::underscore('24'));
        $this->assertEquals('24', Inflector::underscore('24', true));
        $this->assertEquals('20_questions', Inflector::underscore('20 Questions'));
        $this->assertEquals('the_magic_8_ball', Inflector::underscore('The Magic 8 Ball'));
        $this->assertEquals('the_magic_8_ball', Inflector::underscore('theMagic8Ball'));

        $this->assertEquals('ctr_man', Inflector::underscore('CTR Man'));

        $this->assertEquals(
            'the_emperors_new_clothes_a_rather_silly_game',
            Inflector::underscore('The Emperor\'s New Clothes: A Rather Silly Game')
        );
    }

    public function testHumanize()
    {
        $this->assertEquals('roads and boats', Inflector::humanize('roadsAndBoats'));
        $this->assertEquals('Roads And Boats', Inflector::humanize('roadsAndBoats', true));
        $this->assertEquals('roads and boats', Inflector::humanize('roads_and_boats'));

        $this->assertEquals('agricola', Inflector::humanize('agricola'));

        $this->assertEquals('settlers of catan', Inflector::humanize('settlers__of__catan'));

        $this->assertEquals('ticket to ride', Inflector::humanize('ticket to ride'));

        $this->assertEquals('24', Inflector::humanize('24'));
        $this->assertEquals('24', Inflector::humanize('24', true));
        $this->assertEquals('20 questions', Inflector::humanize('20_questions'));
        $this->assertEquals('the magic 8 ball', Inflector::humanize('the_magic_8_ball'));
        $this->assertEquals('the magic 8 ball', Inflector::humanize('theMagic8Ball'));

        $this->assertEquals('ctr man', Inflector::humanize('ctr_man'));

        $this->assertEquals(
            'the emperors new clothes a rather silly game',
            Inflector::humanize('the_emperors_new_clothes_a_rather_silly_game')
        );

        $this->assertEquals('game', Inflector::humanize('game_id'));
        $this->assertEquals('id game', Inflector::humanize('id_game'));
    }
}
