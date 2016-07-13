<?php

namespace IcebergServiceSlim\Route;

use IcebergServiceSlim\Contracts\Route\Controller as ControllerContract;
use Interop\Container\ContainerInterface as ContainerContract;

abstract class AbstractController implements ControllerContract
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
