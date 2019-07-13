<?php

namespace Bringo;

class HomeController
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function home($request, $response)
    {
        return $this->container->renderer->render($response, 'index.phtml');
    }
}
