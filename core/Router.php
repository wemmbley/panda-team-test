<?php

declare(strict_types=1);

namespace Core;

class Router
{
    private string $httpMethod;
    private string $uri;

    public function __construct()
    {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function init()
    {
        $this->stripHttpQuery();
        $this->dispatch();
    }

    public function stripHttpQuery()
    {
        if (false !== $pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }
        $this->uri = rawurldecode($this->uri);
    }

    public function dispatch()
    {
        require_once '../app/routes.php';

        $routeInfo = $dispatcher->dispatch($this->httpMethod, $this->uri);

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                echo 404; die;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                echo 'Method not allowed'; die;
            case \FastRoute\Dispatcher::FOUND:
                $handler = explode('@', $routeInfo[1]);
                $vars = $routeInfo[2];

                $controllerName = 'App\Controller\\' . $handler[0];
                $controller = new $controllerName();
                $action = $handler[1];
                $controller->$action(extract($vars));

                break;
        }
    }
}