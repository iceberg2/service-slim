<?php

namespace IcebergServiceSlim\Provider;

use Pimple\ServiceProviderInterface;
use Pimple\Container AS PimpleContainer;
use IcebergApp\Container\Container AS AppContainer;

class Provider implements ServiceProviderInterface
{

  public function register(PimpleContainer $container)
  {
    if (!isset($container['db']))
    {
      $container['db'] = function ($container)
      {
        return AppContainer::getInstance()->db;
      };
    }
    if (!isset($container['token']))
    {
      $container['token'] = function ($container)
      {
        return AppContainer::getInstance()->token;
      };
    }
    if (!isset($container['env']))
    {
      $container['env'] = function ($container)
      {
        return AppContainer::getInstance()->env;
      };
    }
    if (!isset($container['hash']))
    {
      $container['hash'] = function ($container)
      {
        return AppContainer::getInstance()->hash;
      };
    }
  }

}
