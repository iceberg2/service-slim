<?php

namespace IcebergServiceSlim\Contracts\Middleware;

use SlimInterfaces\Contracts\Middleware as MiddlewareContract;
use Interop\Container\ContainerInterface as ContainerContract;

interface Middleware extends MiddlewareContract
{

  public function __construct(ContainerContract $container);

  public function getContainer();

  public function setContainer(ContainerContract $container);
}
