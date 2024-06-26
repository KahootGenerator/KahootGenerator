<?php

namespace App;

use App\Core\Route;
use App\Controllers\ViewController;
use Exception;

class Router
{
    private string $url;
    private array $routes = [];

    public function __construct(string $url)
    {
        $this->setUrl($url);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function setRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    public function get(string $path, string $callable): Route
    {
        $route = new Route($path, $callable);
        $currentRoutes = $this->getRoutes();

        $currentRoutes["GET"][] = $route;

        $newRoutes = $currentRoutes;

        $this->setRoutes($newRoutes);

        return $route;
    }

    public function post(string $path, string $callable): Route
    {
        $route = new Route($path, $callable);
        $currentRoutes = $this->getRoutes();

        $currentRoutes["POST"][] = $route;

        $newRoutes = $currentRoutes;

        $this->setRoutes($newRoutes);

        return $route;
    }
    public function run(): Route|null
    {
        if (!isset($this->getRoutes()[$_SERVER['REQUEST_METHOD']])) {
            throw new Exception('REQUEST_METHOD does not exist');
        }

        foreach ($this->getRoutes()[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->getUrl())) {
                return $route->call();
            }
        }
        $vm = new ViewController();
        $vm->render('errors/404', ['title' => '404', 'backgroundName' => '404']);

        return null;
    }
}