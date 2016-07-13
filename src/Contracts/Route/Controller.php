<?php

namespace IcebergServiceSlim\Contracts\Route;

use Interop\Container\ContainerInterface as ContainerContract;

interface Controller
{

  public function __construct(ContainerContract $container);

  public function getContainer();

  public function setContainer(ContainerContract $container);
}
