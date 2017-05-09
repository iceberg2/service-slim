<?php

namespace Articstudio\IcebergApp\Service\Slim\Provider;

use Pimple\ServiceProviderInterface as ServiceProviderContract;
use Slim\Container as SlimContainer;
use Articstudio\IcebergApp\Application as IcebergApp;

class DefaultsProvider implements ServiceProviderContract {

    public function register(SlimContainer $container) {
        $app_container = IcebergApp::getInstance()->getContainer();
        if (!isset($container['env'])) {
            $container['env'] = $app_container->env;
        }
        if (!isset($container['db'])) {
            $container['db'] = $app_container->db;
        }
        if (!isset($container['hash'])) {
            $container['hash'] = $app_container->hash;
        }
        if (!isset($container['token'])) {
            $container['token'] = $app_container->token;
        }
    }

}
