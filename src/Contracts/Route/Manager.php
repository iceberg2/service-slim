<?php

namespace IcebergServiceSlim\Contracts\Route;

use Interop\Container\ContainerInterface as ContainerContract;
use Slim\App AS SlimApp;

interface Manager
{

  public function __construct(ContainerContract $container);

  public function getContainer();

  public function setContainer(ContainerContract $container);

  public function add(SlimApp $app);
}
