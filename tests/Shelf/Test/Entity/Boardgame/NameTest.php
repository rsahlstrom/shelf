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
                'value' => 'Primary Name',
                'type' => 'primary',
                'sort_index' => 0,
            )
        );

        $this->secondaryName = Name::factory(
            array(
                'value' => 'Secondary Name',
                'type' => 'secondary',
                'sort_index' => 0,
            )
        );
    }

    public function testIsPrimary()
    {
        $this->assertTrue($this->primaryName->isPrimary());
        $this->assertFalse($this->secondaryName->isPrimary());
    }
}
