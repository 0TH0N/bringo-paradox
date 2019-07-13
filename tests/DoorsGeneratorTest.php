<?php

namespace Bringo\Tests;

use \PHPUnit\Framework\TestCase;

class DoorsGeneratorTest extends TestCase
{
    protected $doorsGenerator;

    public function setUp(): void
    {
        $this->doorsGenerator = new \Bringo\DoorsGenerator(1);
    }

    public function testRun()
    {
        $stateOfDoors = $this->doorsGenerator->generate();
        $this->assertIsArray($stateOfDoors);
        $this->assertCount(4, $stateOfDoors);
        $range = [1, 2, 3];
        $this->assertContains($stateOfDoors['chosenDoor'], $range);
        $this->assertContains($stateOfDoors['openedDoor'], $range);
        $this->assertContains($stateOfDoors['nextDoor'], $range);
        $this->assertContains($stateOfDoors['doorWithCar'], $range);
    }
}
