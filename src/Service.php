<?php

namespace Articstudio\IcebergApp\Service\Slim;

use Articstudio\IcebergApp\Service\AbstractService;
use Slim\App as SlimApp;
use Articstudio\IcebergApp\Service\Slim\Provider\DefaultsProvider;
use Articstudio\IcebergApp\Service\Slim\Provider\Manager as ProvidersManager;
use Articstudio\IcebergApp\Service\Slim\Middleware\Manager as MiddlewareManager;
use Articstudio\IcebergApp\Service\Slim\Route\Manager as RouteManager;

class Service extends AbstractService {

    public function load(Array $settings = []) {
        $service_app = new SlimApp($settings);
        $this->setServiceApp($service_app);
    }

    public function config() {
        $this->registerProviders();
        $this->registerMiddlewares();
        $this->registerRoutes();
    }

    public function run() {
        $this->setServiceApp()->run();
    }

    public function getServiceContainer() {
        return $this->getServiceApp()->getContainer();
    }

    private function registerProviders() {
        $container = $this->getServiceContainer();
        $defaults = new DefaultsProvider;
        $container->register($defaults);
        $providers = $container->has('providers') ? $container->get('providers') : [];
        if (is_array($providers) && !empty($providers)) {
            $manager = new ProvidersManager($providers);
            $manager->register($container);
        }
    }

    private function registerMiddlewares() {
        $service_app = $this->getServiceApp();
        $container = $this->getServiceContainer();
        $middlewares = $container->has('middlewares') ? $container->get('middlewares') : [];
        if (is_array($middlewares) && !empty($middlewares)) {
            $manager = new MiddlewareManager($middlewares);
            $manager->add($service_app);
        }
    }

    private function registerRoutes() {
        $service_app = $this->getServiceApp();
        $container = $this->getServiceContainer();
        $routes = $container->has('routes') ? $container->get('routes') : [];
        if (is_array($routes) && !empty($routes)) {
            $manager = new RouteManager($routes);
            $manager->add($service_app);
        }
    }

}
