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
                    'type' => 'alternate',
                    'sort_index' => 1,
                ),
                array(
                    'value' => 'Tales of Arabian Nights',
                    'type' => 'primary',
                    'sort_index' => 1,
                ),
                array(
                    'value' => 'Arabian Nights of Tales',
                    'type' => 'alternate',
                    'sort_index' => 1,
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
                    'type' => 'alternate',
                    'sort_index' => 1,
                ),
                array(
                    'value' => 'Tales of Arabian Nights',
                    'type' => 'alternate',
                    'sort_index' => 1,
                ),
                array(
                    'value' => 'Arabian Nights of Tales',
                    'type' => 'alternate',
                    'sort_index' => 1,
                ),
            )
        );

        $nameCollectionNoPrimary->getPrimaryName()->getValue();
    }


    public function testSortByValue()
    {
        $this->nameCollection->sortByValue();

        $this->assertEquals('Arabian Nights of Tales', $this->nameCollection[0]->getValue());
        $this->assertEquals('Nights of Arabian Tales', $this->nameCollection[1]->getValue());
        $this->assertEquals('Tales of Arabian Nights', $this->nameCollection[2]->getValue());
    }
}
