<?php

namespace Articstudio\IcebergApp\Service\Slim\Route;

use Slim\App as SlimApp;
use Articstudio\IcebergApp\Service\Slim\Exception\Route\NotFoundException;
use Articstudio\SlimInterfaces\Contracts\Route;
use Articstudio\SlimInterfaces\Contracts\RouteGroup;

class Manager {

    private $routes;

    public function __construct(array $routes = []) {
        $this->routes = $routes;
    }

    public function add(SlimApp $app) {
        foreach ($this->routes as $route) {
            $this->addRoute($app, $route);
        }
    }

    private function addRoute(SlimApp $app, $route_class_name) {
        if (!is_string($route_class_name) || !class_exists($route_class_name)) {
            throw new NotFoundException(sprintf('Slim route error while retrieving "%s"', $route_class_name));
        }
        try {
            if (in_array(Route::class, class_implements($route_class_name))) {
                $app->map($route_class_name::getMethods(), $route_class_name::getPattern(), $route_class_name);
            } else if (in_array(RouteGroup::class, class_implements($route_class_name))) {
                $app->group($route_class_name::getPattern(), $route_class_name);
            } else {
                throw new NotFoundException(sprintf('Slim route error while retrieving "%1$s". Expected: %2$s or %3$s', $route_class_name, Route::class, RouteGroup::class));
            }
        } catch (Exception $exception) {
            throw new NotFoundException(sprintf('Slim route error while retrieving "%s"', $route_class_name), null, $exception);
        } catch (Throwable $exception) {
            throw new NotFoundException(sprintf('Slim route error while retrieving "%s"', $route_class_name), null, $exception);
        }
    }

}
