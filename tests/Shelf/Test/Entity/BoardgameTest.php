<?php

namespace Shelf\Test\Entity;

use Shelf\Factory\BoardgameFactory;

class BoardgameTest extends \PHPUnit_Framework_TestCase
{
    protected $game;
    protected $expansion;

    public function setUp()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';

        $xmlGame = simplexml_load_file($fixtureDir . '/arabianBasic.xml');
        $this->game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        $xmlExpansion = simplexml_load_file($fixtureDir . '/catanCitiesAndKnightsBasic.xml');
        $this->expansion = BoardgameFactory::fromBggXml($xmlExpansion->item[0]);
    }

    public function testGetNames()
    {
        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\NameCollection',
            $this->game->getNames()
        );

        $this->assertCount(1, $this->game->getNames());
        $this->assertCount(28, $this->expansion->getNames());
    }

    public function testGetPrimaryName()
    {
        $this->assertSame('Tales of the Arabian Nights', $this->game->getPrimaryName()->getValue());
        $this->assertSame('Catan: Cities & Knights', $this->expansion->getPrimaryName()->getValue());
    }

    public function testSupportsPlayers()
    {
        $this->assertTrue($this->game->supportsPlayers(1));
        $this->assertTrue($this->game->supportsPlayers(2));
        $this->assertTrue($this->game->supportsPlayers(3));
        $this->assertTrue($this->game->supportsPlayers(4));
        $this->assertTrue($this->game->supportsPlayers(5));
        $this->assertTrue($this->game->supportsPlayers(6));

        $this->assertFalse($this->game->supportsPlayers(0));
        $this->assertFalse($this->game->supportsPlayers(7));
    }

    public function testSupportsAge()
    {
        $this->assertFalse($this->game->supportsAge(0));
        $this->assertFalse($this->game->supportsAge(11));

        $this->assertTrue($this->game->supportsAge(12));
        $this->assertTrue($this->game->supportsAge(15));
        $this->assertTrue($this->game->supportsAge(99));
        $this->assertTrue($this->game->supportsAge(1072));
    }

    public function testIsExpansion()
    {
        $this->assertFalse($this->game->isExpansion());
        $this->assertTrue($this->expansion->isExpansion());
    }

    public function testGetLinks()
    {
        $linkCollection = $this->game->getLinks();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Adventure',
                'Arabian',
                'Fantasy',
                'Dice Rolling',
                'Point to Point Movement',
                'Role Playing',
                'Storytelling',
                'Variable Player Powers',
                'Solitaire Games',
                'Tales of the Arabian Nights',
                'Anthony J. Gallela',
                'Eric Goldberg',
                'Kevin Maroney',
                'Zev Shlasinger',
                'Peter Gifford',
                'Dan Harding',
                'Z-Man Games',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetCategories()
    {
        $linkCollection = $this->game->getCategories();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Adventure',
                'Arabian',
                'Fantasy',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetMechanics()
    {
        $linkCollection = $this->game->getMechanics();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Dice Rolling',
                'Point to Point Movement',
                'Role Playing',
                'Storytelling',
                'Variable Player Powers',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetDesigners()
    {
        $linkCollection = $this->game->getDesigners();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Anthony J. Gallela',
                'Eric Goldberg',
                'Kevin Maroney',
                'Zev Shlasinger',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetArtists()
    {
        $linkCollection = $this->game->getArtists();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Peter Gifford',
                'Dan Harding',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetPublishers()
    {
        $linkCollection = $this->game->getPublishers();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Z-Man Games',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetFamilies()
    {
        $linkCollection = $this->game->getFamilies();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Solitaire Games',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetExpansions()
    {
        $linkCollection = $this->expansion->getExpansions();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Catan: Cities & Knights - 5-6 Player Extension',
                'Der Hafenmeister',
                'Hexen, Zauberer & Drachen (Fan expansion to Catan: Cities and Knights)',
                'Kirche, Glaube & Reformation (Fan expansion to Catan: Cities and Knights)',
                'Die Siedler von Catan: Die Pioniere (fan expansion for The Settlers of Catan)',
                'The Settlers of Catan',
            ),
            $linkCollection->getValue()
        );
    }

    public function testGetImplementations()
    {
        $linkCollection = $this->game->getImplementations();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'Tales of the Arabian Nights',
            ),
            $linkCollection->getValue()
        );
    }
}
