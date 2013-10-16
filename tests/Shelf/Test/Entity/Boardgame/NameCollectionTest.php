<?php

namespace Shelf\Test\Entity\Boadgame;

use Shelf\Entity\Boardgame\NameCollection;

class NameCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $nameCollection;

    public function setUp()
    {
        $this->nameCollection = NameCollection::factory(
            array(
                array(
                    'value' => 'Nights of Arabian Tales',
                    'type' => 'secondary',
                    'sort_index' => 0,
                ),
                array(
                    'value' => 'Tales of Arabian Nights',
                    'type' => 'primary',
                    'sort_index' => 0,
                ),
                array(
                    'value' => 'Arabian Nights of Tales',
                    'type' => 'secondary',
                    'sort_index' => 0,
                ),
            )
        );
    }

    public function testGetPrimaryName()
    {
        $this->assertEquals(
            'Tales of Arabian Nights',
            $this->nameCollection->getPrimaryName()->getValue()
        );
    }

    /**
     * @expectedException Shelf\Exception\OutOfBoundsException
     */
    public function testGetPrimaryNameNoPrimary()
    {
        $nameCollectionNoPrimary = NameCollection::factory(
            array(
                array(
                    'value' => 'Nights of Arabian Tales',
                    'type' => 'secondary',
                    'sort_index' => 0,
                ),
                array(
                    'value' => 'Tales of Arabian Nights',
                    'type' => 'secondary',
                    'sort_index' => 0,
                ),
                array(
                    'value' => 'Arabian Nights of Tales',
                    'type' => 'secondary',
                    'sort_index' => 0,
                ),
            )
        );

        $nameCollectionNoPrimary->getPrimaryName()->getValue();
    }
}
