<?php

namespace Framework\Test\Config;

use Framework\Config\Config;
use PHPUnit_Framework_TestCase as TestCase;

class ConfigTest extends TestCase
{
    /**
     *
     */
    public function testIteratorWithFalseValues()
    {
        $data = [
            'a' => 'A',
            'b' => false,
            'c' => 'C'
        ];

        $config = new Config($data);

        $count = 0;

        foreach($config as $k => $v) {
            ++$count;
        }

        $this->assertTrue($count == count($data));
    }
}
