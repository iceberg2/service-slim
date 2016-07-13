<?php

namespace IcebergServiceSlim\Route;

use IcebergServiceSlim\Contracts\Route\Manager as ManagerContract;
use Interop\Container\ContainerInterface as ContainerContract;

abstract class AbstractManager implements ManagerContract
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
