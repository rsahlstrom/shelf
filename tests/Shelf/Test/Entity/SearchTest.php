<?php

namespace Shelf\Test\Entity;

use Shelf\Factory\SearchFactory;

class SearchTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $search = SearchFactory::fromArray(array(
            'name' => array(
                'value' => 'Roads and Boats',
                'sort_index' => 1,
            )
        ));
        $name = $search->getName();

        $this->assertInstanceOf(
            'Shelf\\Entity\\Search\\Name',
            $name
        );

        $this->assertEquals('Roads and Boats', $name->getValue());
    }
}
