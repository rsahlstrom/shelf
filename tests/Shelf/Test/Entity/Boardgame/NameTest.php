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
}
