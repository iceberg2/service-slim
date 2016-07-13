<?php

namespace IcebergServiceSlim\Route;

use IcebergServiceSlim\Contracts\Route\Route as RouteContract;
use Interop\Container\ContainerInterface as ContainerContract;

abstract class AbstractRoute implements RouteContract
{

  private $container;
  protected static $METHODS = [];
  protected static $PATTERN = '';

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

  public static function getMethods()
  {
    return static::$METHODS;
  }

  public static function getPattern()
  {
    return static::$PATTERN;
  }

}
