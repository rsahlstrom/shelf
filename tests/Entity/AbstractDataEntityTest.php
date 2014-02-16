<?php

namespace Shelf\Test\Entity;

class AbstractDataEntityTest extends \PHPUnit_Framework_TestCase
{
    protected $entity;

    public function setUp()
    {
        $this->entity = $this->getMockForAbstractClass(
            'Shelf\Entity\AbstractDataEntity',
            array(),
            '',
            true,
            true,
            true,
            array('getPrivateKeys')
        );
    }

    public function testSetDataFromArray()
    {
        $test = array(
            'catan' => 'settlers',
            'ticket' => 'ride',
        );
        $this->entity->setDataFromArray($test);

        $this->assertEquals($test['catan'], $this->entity->getCatan());
        $this->assertEquals($test['ticket'], $this->entity->getTicket());
    }

    public function testToArray()
    {
        $this->entity->setCatan('settlers');
        $this->entity->setTicket('ride');
        $this->entity->setRoadsAndBoats('awesome');

        $this->assertEquals(
            array(
                'catan' => 'settlers',
                'ticket' => 'ride',
                'roads_and_boats' => 'awesome',
            ),
            $this->entity->toArray()
        );
    }

    public function testToPublicArray()
    {
        $this->entity
            ->expects($this->any())
            ->method('getPrivateKeys')
            ->will($this->returnValue(array('catan')));

        $this->entity->setCatan('settlers');
        $this->entity->setTicket('ride');
        $this->entity->setRoadsAndBoats('awesome');

        $this->assertEquals(
            array(
                'ticket' => 'ride',
                'roads_and_boats' => 'awesome',
            ),
            $this->entity->toPublicArray()
        );
    }

    public function testToJson()
    {
        $data = array(
            'catan' => 'settlers',
            'ticket' => 'ride'
        );
        $this->entity->setDataFromArray($data);

        $this->assertEquals(json_encode($data), $this->entity->toJson());
    }

    public function testToPublicJson()
    {
        $this->entity
            ->expects($this->any())
            ->method('getPrivateKeys')
            ->will($this->returnValue(array('catan')));

        $data = array(
            'catan' => 'settlers',
            'ticket' => 'ride',
            'roads_and_boats' => 'awesome',
        );
        $this->entity->setDataFromArray($data);

        $publicData = $data;
        unset($publicData['catan']);

        $this->assertEquals(json_encode($publicData), $this->entity->toPublicJson());
    }

    public function testSerialize()
    {
        $data = array(
            'catan' => 'settlers',
            'ticket' => 'ride'
        );
        $this->entity->setDataFromArray($data);

        $serializedObject = serialize($this->entity);
        $newObject = unserialize($serializedObject);

        $this->assertEquals($this->entity->toArray(), $newObject->toArray());
    }

    public function testGetValid()
    {
        $data = array(
            'catan' => 'settlers',
            'ticket' => 'ride'
        );
        $this->entity->setDataFromArray($data);

        $this->assertEquals($data['catan'], $this->entity->getCatan());
        $this->assertEquals($data['ticket'], $this->entity->getTicket());
    }

    /**
     * @expectedException Shelf\Exception\BadMethodCallException
     */
    public function testGetInvalid()
    {
        $data = array(
            'catan' => 'settlers',
            'ticket' => 'ride'
        );
        $this->entity->setDataFromArray($data);

        $this->entity->getRoadsAndBoats();
    }

    public function testSet()
    {
        $this->entity->setAgricola('farmers');

        $this->assertEquals('farmers', $this->entity->getAgricola());
    }

    /**
     * @expectedException Shelf\Exception\BadMethodCallException
     */
    public function testSetInvalid()
    {
        $this->entity->setAgricola();
    }

    public function testHas()
    {
        $data = array(
            'catan' => 'settlers',
            'ticket' => 'ride'
        );
        $this->entity->setDataFromArray($data);

        $this->assertTrue($this->entity->hasCatan());
        $this->assertFalse($this->entity->hasRoadsAndBoats());
    }

    /**
     * @expectedException Shelf\Exception\BadMethodCallException
     */
    public function testBadMagicMethod()
    {
        $this->entity->badMagicMethodCall();
    }
}
