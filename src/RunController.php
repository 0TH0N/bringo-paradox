<?php

namespace Bringo;

class RunController
{
    protected $container;
    protected $model;

    public function __construct($container)
    {
        $this->container = $container;
        $this->model = new Model();
    }

    public function showDoors($request, $response)
    {
        $params = $this->model->getStatistic();
        return $this->container->renderer->render($response, 'step-1.phtml', $params);
    }

    public function handle($request, $response)
    {
        $chosenDoor = $request->getQueryParam('door');
        $stateOfDoors = $this->model->makeDoors($chosenDoor);
        $statistic = $this->model->getStatistic();
        $params = \array_merge($stateOfDoors, $statistic);
        return $this->container->renderer->render($response, 'step-2.phtml', $params);
    }

    public function destroy($request, $response)
    {
        $this->repository->clearTable();
        return $response->withRedirect('/doors', 301);
    }
}
