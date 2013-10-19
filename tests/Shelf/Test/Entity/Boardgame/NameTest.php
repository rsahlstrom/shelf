<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Entity\Boardgame\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    protected $primaryName;
    protected $alternateName;

    public function setUp()
    {
        $this->primaryName = Name::factory(
            array(
                'value' => 'The Primary Name',
                'type' => 'primary',
                'sort_index' => 5,
            )
        );

        $this->alternateName = Name::factory(
            array(
                'value' => 'An Alternate Name',
                'type' => 'alternate',
                'sort_index' => 4,
            )
        );
    }

    public function testIsPrimary()
    {
        $this->assertTrue($this->primaryName->isPrimary());
        $this->assertFalse($this->alternateName->isPrimary());
    }

    public function testGetSortIndex()
    {
        $this->assertEquals(5, $this->primaryName->getSortIndex());
        $this->assertEquals(5, $this->primaryName->getSortIndex(false));
        $this->assertEquals(4, $this->primaryName->getSortIndex(true));
    }

    public function testGetSortValue()
    {
        $this->assertEquals('Primary Name, The', $this->primaryName->getSortValue());
        $this->assertEquals('Primary Name, The', $this->primaryName->getSortValue(true));

        $this->assertEquals('Alternate Name, An', $this->alternateName->getSortValue());
        $this->assertEquals('Alternate Name, An', $this->alternateName->getSortValue(true));
    }

    public function testGetSortValueNoAppend()
    {
        $this->assertEquals('Primary Name', $this->primaryName->getSortValue(false));
        $this->assertEquals('Alternate Name', $this->alternateName->getSortValue(false));
    }
}
