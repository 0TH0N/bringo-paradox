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
        $password = $request->getParsedBodyParam('password');
        $this->model->clearTable($password) ? 'true' : 'false';
        return $response->withRedirect('/doors', 301);
    }

    public function showAbout($request, $response)
    {
        return $this->container->renderer->render($response, 'about.phtml');
    }
}
