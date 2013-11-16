<?php

namespace Shelf\Test\Entity;

use Shelf\Factory\CollectionFactory;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $collection = CollectionFactory::fromArray(array(
            'name' => array(
                'value' => 'Roads and Boats',
                'sort_index' => 1,
            )
        ));
        $name = $collection->getName();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Collection\\Name',
            $name
        );

        $this->assertEquals('Roads and Boats', $name->getValue());
    }
}
