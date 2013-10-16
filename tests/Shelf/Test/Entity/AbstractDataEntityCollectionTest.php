<?php

namespace Shelf\Test\Entity;

use Shelf\Entity\AbstractDataEntityCollection;
use Shelf\Entity\Boardgame;

class AbstractDataEntityCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $entity;

    public function setUp()
    {
        $this->entity = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractDataEntityCollection'
        );
        $this->entity
            ->expects($this->any())
            ->method('getChildClass')
            ->will($this->returnValue('\Shelf\Entity\Boardgame'));
    }

    protected function getChild()
    {
        return Boardgame::factory(
            array(
                'name' => 'test',
            )
        );
    }

    public function testAdd()
    {
        $this->assertCount(0, $this->entity);

        $this->entity->add($this->getChild());
        $this->entity->add($this->getChild(), 'agricola');

        $this->assertCount(2, $this->entity);
    }

    public function testToArray()
    {
        $this->entity->add($this->getChild());
        $this->entity->add($this->getChild(), 'agricola');

        $expectedResult = array(
            array('name' => 'test'),
            array('name' => 'test'),
        );

        $this->assertEquals($expectedResult, $this->entity->toArray());
    }

    public function testToPublicArray()
    {
        $privateChild = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractDataEntity',
            array(),
            '',
            true,
            true,
            true,
            array('getPrivateKeys')
        );
        $privateChild
            ->expects($this->any())
            ->method('getPrivateKeys')
            ->will($this->returnValue(array('private_id')));

        $privateChild->setName('test');
        $privateChild->setPrivateId('2');

        $this->entity->add($privateChild);

        $expectedResult = array(
            array('name' => 'test'),
        );

        $this->assertEquals($expectedResult, $this->entity->toPublicArray());
    }

    public function testToJson()
    {
        $this->entity->add($this->getChild());
        $this->entity->add($this->getChild(), 'agricola');

        $expectedResult = array(
            array('name' => 'test'),
            array('name' => 'test'),
        );

        $this->assertEquals(json_encode($expectedResult), $this->entity->toJson());
    }

    public function testToPublicJson()
    {
        $privateChild = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractDataEntity',
            array(),
            '',
            true,
            true,
            true,
            array('getPrivateKeys')
        );
        $privateChild
            ->expects($this->any())
            ->method('getPrivateKeys')
            ->will($this->returnValue(array('private_id')));

        $privateChild->setName('test');
        $privateChild->setPrivateId('2');

        $this->entity->add($privateChild);

        $expectedResult = array(
            array('name' => 'test'),
        );

        $this->assertEquals(json_encode($expectedResult), $this->entity->toPublicJson());
    }

    public function testSerialize()
    {
        $this->entity->add($this->getChild());
        $this->entity->add($this->getChild(), 'agricola');

        $serializedObject = serialize($this->entity);
        $newObject = unserialize($serializedObject);

        $this->assertEquals($this->entity->toArray(), $newObject->toArray());
    }

    public function testOffsetSet()
    {
        $this->entity[] = $this->getChild();
        $this->entity['agricola'] = $this->getChild();

        $this->assertCount(2, $this->entity);
    }

    public function testOffsetExists()
    {
        $this->entity[] = $this->getChild();
        $this->entity['agricola'] = $this->getChild();

        $this->assertTrue(isset($this->entity[0]));
        $this->assertTrue(isset($this->entity['agricola']));
    }

    public function testOffsetUnset()
    {
        $this->entity[] = $this->getChild();
        $this->entity['agricola'] = $this->getChild();

        $this->assertCount(2, $this->entity);

        unset($this->entity[0]);
        unset($this->entity['agricola']);

        $this->assertCount(0, $this->entity);
    }

    public function testOffsetGet()
    {
        $noKeyChild = $this->getChild();
        $keyChild = $this->getChild();

        $this->entity[] = $noKeyChild;
        $this->entity['agricola'] = $keyChild;

        $this->assertSame($this->entity[0], $noKeyChild);
        $this->assertSame($this->entity['agricola'], $keyChild);
    }

    public function testCount()
    {
        $this->assertCount(0, $this->entity);

        $this->entity->add($this->getChild());
        $this->entity->add($this->getChild(), 'agricola');

        $this->assertCount(2, $this->entity);
    }
}
