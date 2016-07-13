<?php

namespace IcebergServiceSlim\Service;

use IcebergApp\Service\AbstractManager as AbstractServiceManager;
use Slim\App as SlimApp;
use IcebergServiceSlim\Provider\Provider AS ServiceProvider;
use IcebergServiceSlim\Contracts\Middleware\Manager as MiddlewareManagerContract;
use IcebergServiceSlim\Contracts\Middleware\Middleware as MiddlewareContract;
use IcebergServiceSlim\Contracts\Route\Manager as RouteManagerContract;
use IcebergServiceSlim\Contracts\Route\Route as RouteContract;

class Manager extends AbstractServiceManager
{

  public function load(Array $settings = [])
  {
    $service = new SlimApp($settings);
    $provider = new ServiceProvider();
    $provider->register($service->getContainer());
    $this->setService($service);
  }

  public function middleware(Array $middlewares = [])
  {
    foreach ($middlewares as $middleware)
    {
      $middleware = new $middleware($this->getService()->getContainer());
      if ($middleware instanceof MiddlewareContract)
      {
        $this->getService()->add($middleware);
      }
      else if ($middleware instanceof MiddlewareManagerContract)
      {
        $middleware->add($this->getService());
      }
      else
      {
        throw new \InvalidArgumentException('Middleware injection expects \IcebergServiceSlim\Contracts\Middleware\Manager or \IcebergServiceSlim\Contracts\Middleware\Middleware');
      }
    }
  }

  public function config(Array $routes = [])
  {
    foreach ($routes as $route)
    {
      $route = new $route($this->getService()->getContainer());
      if ($route instanceof RouteContract)
      {
        $this->getService()->map($route::getMethods(), $route::getPattern(), $route);
      }
      else if ($route instanceof RouteManagerContract)
      {
        $route->add($this->getService());
      }
      else
      {
        throw new \InvalidArgumentException('Middleware injection expects \IcebergServiceSlim\Contracts\Middleware\Manager or \IcebergServiceSlim\Contracts\Middleware\Middleware');
      }
    }
  }

  public function run(Array $settings = [])
  {
    $this->getService()->run();
  }

  public function getServiceContainer()
  {
    return $this->getService()->getContainer();
  }

}
