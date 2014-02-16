<?php

namespace Shelf\Test\Filter;

use Shelf\Filter\CommaDelimited;

class CommaDelimitedTest extends \PHPUnit_Framework_TestCase
{
    public function testImplode()
    {
        $array = array('1', '2', '3');
        $this->assertSame(implode(',', $array), CommaDelimited::implode($array));
    }

    public function testExplode()
    {
        $string = '1,2,3';
        $this->assertSame(explode(',', $string), CommaDelimited::explode($string));
    }
}
