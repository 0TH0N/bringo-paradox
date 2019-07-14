<?php

namespace Bringo;

class Model
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RoundsRepository();
    }

    public function getStatistic()
    {
        $numberOfAllGoodRounds = $this->repository->calculateGoodRounds();
        $numberOfAllRounds = $this->repository->calculateAllRounds();
        $allGoodPersent = ($numberOfAllGoodRounds / $numberOfAllRounds) * 100;
        $roundedAllPersent = round($allGoodPersent, 2);

        $sessionId = session_id();
        $numberOfSessionGoodRounds = $this->repository->calculateSessionGoodRounds($sessionId);
        $numberOfSessionRounds = $this->repository->calculateSessionAllRounds($sessionId);
        $sessionGoodPersent = ($numberOfSessionGoodRounds / $numberOfSessionRounds) * 100;
        $roundedSessionPersent = round($sessionGoodPersent, 2);

        $statistic = [
            'numberOfAllGoodRounds' => $numberOfAllGoodRounds,
            'numberOfAllRounds' => $numberOfAllRounds,
            'roundedAllPersent' => $roundedAllPersent,
            'numberOfSessionGoodRounds' => $numberOfSessionGoodRounds,
            'numberOfSessionRounds' => $numberOfSessionRounds,
            'roundedSessionPersent' => $roundedSessionPersent,
        ];
        return $statistic;
    }

    public function makeDoors($chosenDoor)
    {
        $generator = new DoorsGenerator($chosenDoor);
        $stateOfDoors = $generator->generate();
        $this->repository->insertRound($stateOfDoors);
        return $stateOfDoors;
    }
}
