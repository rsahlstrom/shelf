<?php

namespace Shelf\Test\Common\Entity\Boadgame;

use Shelf\Common\Entity\Boardgame\Name;

class BoardgameTest extends \PHPUnit_Framework_TestCase
{
    protected $primaryName;
    protected $secondaryName;

    public function setUp()
    {
        $this->primaryName = Name::factory(
            array(
                'name' => 'Primary Name',
                'type' => 'primary',
                'sort_index' => 0,
            )
        );

        $this->secondaryName = Name::factory(
            array(
                'name' => 'Secondary Name',
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
