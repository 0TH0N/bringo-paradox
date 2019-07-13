<?php

namespace Bringo;

class DoorsGenerator
{
    protected $chosenDoor;
    protected $gsch;

    public function __construct($chosenDoor)
    {
        $this->chosenDoor = $chosenDoor;
        $this->gsch = new GSCHWithoutZero(2);
    }

    public function generate()
    {
        $doorWithCar = $this->gsch->generate();
        $unvaliableDoors = [$this->chosenDoor, $doorWithCar];
        $openedDoor = $this->chosenDoor;
        while (in_array($openedDoor, $unvaliableDoors)) {
            $openedDoor = $this->gsch->generate();
        };
        $nextDoor = $this->chosenDoor;
        $unvaliableDoors = [$this->chosenDoor, $openedDoor];
        while (in_array($nextDoor, $unvaliableDoors)) {
            $nextDoor = $this->gsch->generate();
        };
        $stateOfDoors = [
            'chosenDoor' => $this->chosenDoor,
            'openedDoor' => $openedDoor,
            'nextDoor' => $nextDoor,
            'doorWithCar' => $doorWithCar
        ];
        return $stateOfDoors;
    }
}
