<?php

namespace Articstudio\IcebergApp\Service\Slim\Middleware;

use Slim\App as SlimApp;
use Articstudio\IcebergApp\Service\Slim\Exception\Middleware\NotFoundException;

class Manager {

    private $middlewares;

    public function __construct(array $middlewares = []) {
        $this->middlewares = $middlewares;
    }

    public function add(SlimApp $app) {
        foreach ($this->middlewares as $middleware) {
            $this->addMiddleware($app, $middleware);
        }
    }

    private function addMiddleware(SlimApp $app, $middleware_class_name) {
        if (!is_string($middleware_class_name) || !class_exists($middleware_class_name)) {
            throw new NotFoundException(sprintf('Slim middleware error while retrieving "%s"', $middleware_class_name));
        }
        try {
            $middleware = new $middleware_class_name;
            $app->add($middleware);
        } catch (Exception $exception) {
            throw new NotFoundException(sprintf('Slim middleware error while retrieving "%s"', $middleware_class_name), null, $exception);
        } catch (Throwable $exception) {
            throw new NotFoundException(sprintf('Slim middleware error while retrieving "%s"', $middleware_class_name), null, $exception);
        }
    }

}
