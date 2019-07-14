<?php

namespace Bringo;

class RunController
{
    protected $container;
    protected $repository;

    public function __construct($container)
    {
        $this->container = $container;
        $this->repository = new RoundsRepository();
    }

    public function showDoors($request, $response)
    {
        $this->repository->createRoundsTable();
        
        $numberOfAllGoodRounds = $this->repository->calculateGoodRounds();
        $numberOfAllRounds = $this->repository->calculateAllRounds();
        $allGoodPersent = ($numberOfAllGoodRounds / $numberOfAllRounds) * 100;
        $roundedAllPersent = round($allGoodPersent, 2);

        $sessionId = session_id();
        $numberOfSessionGoodRounds = $this->repository->calculateSessionGoodRounds($sessionId);
        $numberOfSessionRounds = $this->repository->calculateSessionAllRounds($sessionId);
        $sessionGoodPersent = ($numberOfSessionGoodRounds / $numberOfSessionRounds) * 100;
        $roundedSessionPersent = round($sessionGoodPersent, 2);

        $params = [
            'numberOfAllGoodRounds' => $numberOfAllGoodRounds,
            'numberOfAllRounds' => $numberOfAllRounds,
            'roundedAllPersent' => $roundedAllPersent,
            'numberOfSessionGoodRounds' => $numberOfSessionGoodRounds,
            'numberOfSessionRounds' => $numberOfSessionRounds,
            'roundedSessionPersent' => $roundedSessionPersent,
        ];
        return $this->container->renderer->render($response, 'step-1.phtml', $params);
    }

    public function handle($request, $response)
    {
        $chosenDoor = $request->getQueryParam('door');
        $generator = new DoorsGenerator($chosenDoor);
        $stateOfDoors = $generator->generate();
        $this->repository->insertRound($stateOfDoors);
        return $response->withRedirect('/doors', 301);
    }

    public function destroy($request, $response)
    {
        $this->repository->clearTable();
        return $response->withRedirect('/', 301);
    }
}
