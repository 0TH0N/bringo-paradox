<?php

namespace Bringo;

class RunController
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function run($request, $response)
    {
        return $this->container->renderer->render($response, 'monti-hall.phtml');
    }
}
