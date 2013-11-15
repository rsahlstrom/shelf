<?php

namespace Shelf\Test\Entity;

class AbstractNameTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSortIndex()
    {
        $name = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractName',
            array(
                array(
                    'value' => 'Roads and Boats',
                    'sort_index' => 1,
                )
            )
        );

        $this->assertEquals(1, $name->getSortIndex());
        $this->assertEquals(1, $name->getSortIndex(false));
        $this->assertEquals(0, $name->getSortIndex(true));
    }

    public function testGetSortValue()
    {
        $name = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractName',
            array(
                array(
                    'value' => 'Roads and Boats',
                    'sort_index' => 1,
                )
            )
        );

        $this->assertEquals('Roads and Boats', $name->getSortValue());
        $this->assertEquals('Roads and Boats', $name->getSortValue(true));
    }

    public function testGetSortValueNoAppend()
    {
        $name = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractName',
            array(
                array(
                    'value' => 'Roads and Boats',
                    'sort_index' => 1,
                )
            )
        );

        $this->assertEquals('Roads and Boats', $name->getSortValue(false));
    }

    public function testGetSortValueWithSortIndex()
    {
        $name = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractName',
            array(
                array(
                    'value' => 'Roads and Boats',
                    'sort_index' => 11,
                )
            )
        );

        $this->assertEquals('Boats, Roads and', $name->getSortValue());
        $this->assertEquals('Boats, Roads and', $name->getSortValue(true));
    }

    public function testGetSortValueWithSortIndexNoAppend()
    {
        $name = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractName',
            array(
                array(
                    'value' => 'Roads and Boats',
                    'sort_index' => 11,
                )
            )
        );

        $this->assertEquals('Boats', $name->getSortValue(false));
    }
}
