<?php

namespace IcebergServiceSlim\Middleware;

use IcebergServiceSlim\Contracts\Middleware\Middleware AS MiddlewareContract;
use Interop\Container\ContainerInterface as ContainerContract;

abstract class AbstractMiddleware implements MiddlewareContract
{

  private $container;

  public function __construct(ContainerContract $container)
  {
    $this->setContainer($container);
  }

  public function getContainer()
  {
    return $this->container;
  }

  public function setContainer(ContainerContract $container)
  {
    $this->container = $container;
  }

}
