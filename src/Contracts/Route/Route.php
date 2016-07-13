<?php

namespace IcebergServiceSlim\Contracts\Route;

use SlimInterfaces\Contracts\Route as RouteContract;
use Interop\Container\ContainerInterface as ContainerContract;

interface Route extends RouteContract
{

  public function __construct(ContainerContract $container);

  public function getContainer();

  public function setContainer(ContainerContract $container);

  public static function getMethods();

  public static function getPattern();
}
