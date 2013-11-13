<?php

namespace Shelf\Test\Entity;

use Shelf\Factory\BoardgameFactory;

class BoardgameTest extends \PHPUnit_Framework_TestCase
{
    public static $game;
    public static $expansion;

    public static function setUpBeforeClass()
    {
        $fixtureDir = __DIR__ . '/../Fixture/Thing';

        $xmlGame = simplexml_load_file($fixtureDir . '/arabianBasic.xml');
        self::$game = BoardgameFactory::fromBggXml($xmlGame->item[0]);

        $xmlExpansion = simplexml_load_file($fixtureDir . '/catanCitiesAndKnightsBasic.xml');
        self::$expansion = BoardgameFactory::fromBggXml($xmlExpansion->item[0]);
    }

    public function testGetNames()
    {
        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\NameCollection',
            self::$game->getNames()
        );

        $this->assertCount(1, self::$game->getNames());
        $this->assertCount(28, self::$expansion->getNames());
    }

    public function testGetPrimaryName()
    {
        $this->assertSame('Tales of the Arabian Nights', self::$game->getPrimaryName()->getValue());
        $this->assertSame('Catan: Cities & Knights', self::$expansion->getPrimaryName()->getValue());
    }

    public function testSupportsPlayers()
    {
        $this->assertTrue(self::$game->supportsPlayers(1));
        $this->assertTrue(self::$game->supportsPlayers(2));
        $this->assertTrue(self::$game->supportsPlayers(3));
        $this->assertTrue(self::$game->supportsPlayers(4));
        $this->assertTrue(self::$game->supportsPlayers(5));
        $this->assertTrue(self::$game->supportsPlayers(6));

        $this->assertFalse(self::$game->supportsPlayers(0));
        $this->assertFalse(self::$game->supportsPlayers(7));
    }

    public function testSupportsAge()
    {
        $this->assertFalse(self::$game->supportsAge(0));
        $this->assertFalse(self::$game->supportsAge(11));

        $this->assertTrue(self::$game->supportsAge(12));
        $this->assertTrue(self::$game->supportsAge(15));
        $this->assertTrue(self::$game->supportsAge(99));
        $this->assertTrue(self::$game->supportsAge(1072));
    }

    public function testCanFinishIn()
    {
        $this->assertFalse(self::$game->canFinishIn(30));
        $this->assertTrue(self::$game->canFinishIn(120));
        $this->assertTrue(self::$game->canFinishIn(180));
    }

    public function testIsExpansion()
    {
        $this->assertFalse(self::$game->isExpansion());
        $this->assertTrue(self::$expansion->isExpansion());
    }

    public function testGetLinks()
    {
        $linkCollection = self::$game->getLinks();

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

    public function testHasLink()
    {
        $this->assertTrue(self::$game->hasLink('Role Playing'));
        $this->assertTrue(self::$game->hasLink('role playing'));
        $this->assertTrue(self::$game->hasLink('Z-Man Games'));
        $this->assertFalse(self::$game->hasLink('Negotiation'));
    }

    public function testGetCategories()
    {
        $linkCollection = self::$game->getCategories();

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

    public function testHasCategory()
    {
        $this->assertTrue(self::$game->hasCategory('Adventure'));
        $this->assertTrue(self::$game->hasCategory('adventure'));
        $this->assertTrue(self::$game->hasCategory('Fantasy'));
        $this->assertFalse(self::$game->hasCategory('Dice Rolling'));
        $this->assertFalse(self::$game->hasCategory('Negotiation'));
    }

    public function testGetMechanics()
    {
        $linkCollection = self::$game->getMechanics();

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

    public function testHasMechanics()
    {
        $this->assertTrue(self::$game->hasMechanic('Role Playing'));
        $this->assertTrue(self::$game->hasMechanic('role playing'));
        $this->assertFalse(self::$game->hasMechanic('Arabian'));
        $this->assertFalse(self::$game->hasMechanic('Hand Management'));
    }

    public function testGetDesigners()
    {
        $linkCollection = self::$game->getDesigners();

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

    public function testHasDesigner()
    {
        $this->assertTrue(self::$game->hasDesigner('Zev Shlasinger'));
        $this->assertTrue(self::$game->hasDesigner('zev shlasinger'));
        $this->assertFalse(self::$game->hasDesigner('Dan Harding'));
        $this->assertFalse(self::$game->hasDesigner('Russell Ahlstrom'));
    }

    public function testGetArtists()
    {
        $linkCollection = self::$game->getArtists();

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

    public function testHasArtist()
    {
        $this->assertTrue(self::$game->hasArtist('Peter Gifford'));
        $this->assertTrue(self::$game->hasArtist('peter gifford'));
        $this->assertFalse(self::$game->hasArtist('Solitaire Games'));
        $this->assertFalse(self::$game->hasArtist('Russell Ahlstrom'));
    }

    public function testGetPublishers()
    {
        $linkCollection = self::$game->getPublishers();

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

    public function testHasPublisher()
    {
        $this->assertTrue(self::$game->hasPublisher('Z-Man Games'));
        $this->assertTrue(self::$game->hasPublisher('z-man games'));
        $this->assertFalse(self::$game->hasPublisher('Eric Goldberg'));
        $this->assertFalse(self::$game->hasPublisher('Days of Wonder'));
    }

    public function testGetFamilies()
    {
        $linkCollection = self::$game->getFamilies();

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

    public function testHasFamily()
    {
        $this->assertTrue(self::$game->hasFamily('Solitaire Games'));
        $this->assertTrue(self::$game->hasFamily('solitaire games'));
        $this->assertFalse(self::$game->hasFamily('Storytelling'));
        $this->assertFalse(self::$game->hasFamily('Kickstarter'));
    }

    public function testGetExpansions()
    {
        $linkCollection = self::$expansion->getExpansions();

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

    public function testHasExpanions()
    {
        $this->assertFalse(self::$game->hasExpansions());
        $this->assertTrue(self::$expansion->hasExpansions());
    }

    public function testHasExpansion()
    {
        $this->assertTrue(self::$expansion->hasExpansion('Catan: Cities & Knights - 5-6 Player Extension'));
        $this->assertTrue(self::$expansion->hasExpansion('catan: cities & knights - 5-6 player extension'));
        $this->assertFalse(self::$expansion->hasExpansion('Medieval'));
        $this->assertFalse(self::$expansion->hasExpansion('Catan: Seafarers - 5-6'));

        $this->assertFalse(self::$game->hasExpansion('Untold Stories of the Arabian Nights'));
    }

    public function testGetCompilations()
    {
        $linkCollection = self::$expansion->getCompilations();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\LinkCollection',
            $linkCollection
        );

        $this->assertEquals(
            array(
                'CATAN 3D Collector\'s Edition',
            ),
            $linkCollection->getValue()
        );
    }

    public function testHasCompilations()
    {
        $this->assertTrue(self::$expansion->hasCompilations());
        $this->assertFalse(self::$game->hasCompilations());
    }

    public function testHasCompilation()
    {
        $this->assertTrue(self::$expansion->hasCompilation('CATAN 3D Collector\'s Edition'));
        $this->assertTrue(self::$expansion->hasCompilation('catan 3d collector\'s edition'));
        $this->assertFalse(self::$expansion->hasCompilation('Catan: Cities & Knights - 5-6 Player Extension'));
        $this->assertFalse(self::$expansion->hasCompilation('Carcassonne Big Box'));
    }

    public function testGetImplementations()
    {
        $linkCollection = self::$game->getImplementations();

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

    public function testHasImplementations()
    {
        $this->assertTrue(self::$game->hasImplementations());
        $this->assertFalse(self::$expansion->hasImplementations());
    }

    public function testHasImplementation()
    {
        $this->assertTrue(self::$game->hasImplementation('Tales of the Arabian Nights'));
        $this->assertTrue(self::$game->hasImplementation('tales of the arabian nights'));
        $this->assertFalse(self::$game->hasImplementation('Dice Rolling'));
        $this->assertFalse(self::$game->hasImplementation('The Settlers of Catan'));
    }

    public function testGetPolls()
    {
        $pollCollection = self::$game->getPolls();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Boardgame\\PollCollection',
            $pollCollection
        );
    }

    public function testGetSuggestedNumPlayersPoll()
    {
        $poll = self::$game->getSuggestedNumPlayersPoll();
        $this->assertEquals('suggested_numplayers', $poll->getName());
    }

    public function testGetSuggestedPlayerAgePoll()
    {
        $poll = self::$game->getSuggestedPlayerAgePoll();
        $this->assertEquals('suggested_playerage', $poll->getName());
    }

    public function testGetLanguageDependencePoll()
    {
        $poll = self::$game->getLanguageDependencePoll();
        $this->assertEquals('language_dependence', $poll->getName());
    }
}
