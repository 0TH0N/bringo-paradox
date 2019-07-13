<?php

namespace Bringo;

class RunController
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function showDoors($request, $response)
    {
        return $this->container->renderer->render($response, 'step-1.phtml');
    }

    public function handle($request, $response)
    {
        $chosenDoor = $request->getQueryParam('door');
        $generator = new DoorsGenerator($chosenDoor);
        $stateOfDoors = $generator->generate();
        $repository = new RoundsRepository();
        $repository->insertRound($stateOfDoors);
        return $this->container->renderer->render($response, 'step-1.phtml');
    }
}
