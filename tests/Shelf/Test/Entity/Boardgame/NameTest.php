<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Entity\Boardgame\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    protected $primaryName;
    protected $secondaryName;

    public function setUp()
    {
        $this->primaryName = Name::factory(
            array(
                'value' => 'The Primary Name',
                'type' => 'primary',
                'sort_index' => 4,
            )
        );

        $this->secondaryName = Name::factory(
            array(
                'value' => 'A Secondary Name',
                'type' => 'secondary',
                'sort_index' => 2,
            )
        );
    }

    public function testIsPrimary()
    {
        $this->assertTrue($this->primaryName->isPrimary());
        $this->assertFalse($this->secondaryName->isPrimary());
    }

    public function testGetSortValue()
    {
        $this->assertEquals('Primary Name, The', $this->primaryName->getSortValue());
        $this->assertEquals('Primary Name, The', $this->primaryName->getSortValue(true));

        $this->assertEquals('Secondary Name, A', $this->secondaryName->getSortValue());
        $this->assertEquals('Secondary Name, A', $this->secondaryName->getSortValue(true));
    }

    public function testGetSortValueNoAppend()
    {
        $this->assertEquals('Primary Name', $this->primaryName->getSortValue(false));
        $this->assertEquals('Secondary Name', $this->secondaryName->getSortValue(false));
    }
}
