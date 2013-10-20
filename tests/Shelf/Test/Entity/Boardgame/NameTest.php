<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Entity\Boardgame\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    public static $primaryName;
    public static $alternateName;

    public static function setUpBeforeClass()
    {
        self::$primaryName = Name::factory(
            array(
                'value' => 'The Primary Name',
                'type' => 'primary',
                'sort_index' => 5,
            )
        );

        self::$alternateName = Name::factory(
            array(
                'value' => 'An Alternate Name',
                'type' => 'alternate',
                'sort_index' => 4,
            )
        );
    }

    public function testIsPrimary()
    {
        $this->assertTrue(self::$primaryName->isPrimary());
        $this->assertFalse(self::$alternateName->isPrimary());
    }

    public function testGetSortIndex()
    {
        $this->assertEquals(5, self::$primaryName->getSortIndex());
        $this->assertEquals(5, self::$primaryName->getSortIndex(false));
        $this->assertEquals(4, self::$primaryName->getSortIndex(true));
    }

    public function testGetSortValue()
    {
        $this->assertEquals('Primary Name, The', self::$primaryName->getSortValue());
        $this->assertEquals('Primary Name, The', self::$primaryName->getSortValue(true));

        $this->assertEquals('Alternate Name, An', self::$alternateName->getSortValue());
        $this->assertEquals('Alternate Name, An', self::$alternateName->getSortValue(true));
    }

    public function testGetSortValueNoAppend()
    {
        $this->assertEquals('Primary Name', self::$primaryName->getSortValue(false));
        $this->assertEquals('Alternate Name', self::$alternateName->getSortValue(false));
    }
}
