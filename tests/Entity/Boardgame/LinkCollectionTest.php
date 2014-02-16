<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Entity\Boardgame\LinkCollection;

class LinkCollectionTest extends \PHPUnit_Framework_TestCase
{
    public static $linkCollection;

    public static function setUpBeforeClass()
    {
        self::$linkCollection = LinkCollection::factory(
            array(
                array(
                    'id' => 1,
                    'type' => 'category',
                    'value' => 'category a',
                ),
                array(
                    'id' => 2,
                    'type' => 'mechanic',
                    'value' => 'mechanic a',
                ),
                array(
                    'id' => 3,
                    'type' => 'designer',
                    'value' => 'designer a',
                ),
                array(
                    'id' => 4,
                    'type' => 'artist',
                    'value' => 'artist a',
                ),
                array(
                    'id' => 5,
                    'type' => 'publisher',
                    'value' => 'publisher a',
                ),
                array(
                    'id' => 6,
                    'type' => 'family',
                    'value' => 'family a',
                ),
                array(
                    'id' => 7,
                    'type' => 'expansion',
                    'value' => 'expansion a',
                ),
                array(
                    'id' => 17,
                    'type' => 'compilation',
                    'value' => 'compilation a',
                ),
                array(
                    'id' => 8,
                    'type' => 'implementation',
                    'value' => 'implementation a',
                ),
                array(
                    'id' => 9,
                    'type' => 'category',
                    'value' => 'category b',
                ),
                array(
                    'id' => 10,
                    'type' => 'mechanic',
                    'value' => 'mechanic b',
                ),
                array(
                    'id' => 11,
                    'type' => 'designer',
                    'value' => 'designer b',
                ),
                array(
                    'id' => 12,
                    'type' => 'artist',
                    'value' => 'artist b',
                ),
                array(
                    'id' => 13,
                    'type' => 'publisher',
                    'value' => 'publisher b',
                ),
                array(
                    'id' => 14,
                    'type' => 'family',
                    'value' => 'family b',
                ),
                array(
                    'id' => 15,
                    'type' => 'expansion',
                    'value' => 'expansion b',
                ),
                array(
                    'id' => 18,
                    'type' => 'compilation',
                    'value' => 'compilation b',
                ),
                array(
                    'id' => 16,
                    'type' => 'implementation',
                    'value' => 'implementation b',
                ),
            )
        );
    }

    public function testGetCategories()
    {
        $this->assertEquals(
            array(
                'category a',
                'category b'
            ),
            self::$linkCollection->getCategories()->getValue()
        );
    }

    public function testGetMechanics()
    {
        $this->assertEquals(
            array(
                'mechanic a',
                'mechanic b'
            ),
            self::$linkCollection->getMechanics()->getValue()
        );
    }

    public function testGetDesigners()
    {
        $this->assertEquals(
            array(
                'designer a',
                'designer b'
            ),
            self::$linkCollection->getDesigners()->getValue()
        );
    }

    public function testGetArtists()
    {
        $this->assertEquals(
            array(
                'artist a',
                'artist b'
            ),
            self::$linkCollection->getArtists()->getValue()
        );
    }

    public function testGetPublishers()
    {
        $this->assertEquals(
            array(
                'publisher a',
                'publisher b'
            ),
            self::$linkCollection->getPublishers()->getValue()
        );
    }

    public function testGetFamilies()
    {
        $this->assertEquals(
            array(
                'family a',
                'family b'
            ),
            self::$linkCollection->getFamilies()->getValue()
        );
    }

    public function testGetExpansions()
    {
        $this->assertEquals(
            array(
                'expansion a',
                'expansion b'
            ),
            self::$linkCollection->getExpansions()->getValue()
        );
    }

    public function testGetCompilations()
    {
        $this->assertEquals(
            array(
                'compilation a',
                'compilation b'
            ),
            self::$linkCollection->getCompilations()->getValue()
        );
    }

    public function testGetImplementations()
    {
        $this->assertEquals(
            array(
                'implementation a',
                'implementation b'
            ),
            self::$linkCollection->getImplementations()->getValue()
        );
    }
}
