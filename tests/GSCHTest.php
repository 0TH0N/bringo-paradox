<?php

namespace Bringo\Tests;

use PHPUnit\Framework\TestCase;

class TestGSCHWithoutZero extends TestCase
{
    public function testGenerate2()
    {
        $gsch = new \Bringo\GSCHWithoutZero(2);
        for ($i = 0; $i < 100; $i++) {
            $number = $gsch->generate();
            $this->assertContains($number, [1, 2, 3]);
        }
    }

    public function testGenerate4()
    {
        $gsch = new \Bringo\GSCHWithoutZero(4);
        for ($i = 0; $i < 100; $i++) {
            $number = $gsch->generate();
            $this->assertContains($number, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]);
        }
    }
}
